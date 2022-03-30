<?php

/**
 * DokuWiki Bootstrap3 Template: Compatibility functions
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

global $updateVersion;
$dokuwiki_version = floatval($updateVersion);

define('DOKU_VERSION', $dokuwiki_version);
define('DOKU_VERSION_HOGFATHER',          51); // 2020-07-29
define('DOKU_VERSION_GREEBO',             50); // 2018-04-22 (PHP >= 5.6)
define('DOKU_VERSION_FRUSTERICK_MANNERS', 49); // 2017-02-19 (PHP >= 5.4 ???)
define('DOKU_VERSION_ELENOR_OF_TSORT',    48); // 2016-06-26 
define('DOKU_VERSION_DETRITUS',           47); // 2015-08-10 (PHP >= 5.3.3)


// Load compatibility Menu classes for pre-Greebo releases
if (DOKU_VERSION > 0 && DOKU_VERSION < DOKU_VERSION_GREEBO) {

    define('DOKU_INC_COMPAT', realpath(dirname(__FILE__) . '/../') . '/');

    require DOKU_INC_COMPAT . "inc/Menu/MenuInterface.php";
    require DOKU_INC_COMPAT . "inc/Menu/AbstractMenu.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/AbstractItem.php";

    require DOKU_INC_COMPAT . "inc/Menu/UserMenu.php";
    require DOKU_INC_COMPAT . "inc/Menu/MobileMenu.php";
    require DOKU_INC_COMPAT . "inc/Menu/PageMenu.php";
    require DOKU_INC_COMPAT . "inc/Menu/SiteMenu.php";
    require DOKU_INC_COMPAT . "inc/Menu/DetailMenu.php";

    require DOKU_INC_COMPAT . "inc/Menu/Item/ImgBackto.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/Top.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/Edit.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/Profile.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/Revisions.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/Backlink.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/Back.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/Login.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/Index.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/Register.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/MediaManager.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/Subscribe.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/Recent.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/Media.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/Resendpwd.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/Admin.php";
    require DOKU_INC_COMPAT . "inc/Menu/Item/Revert.php";

}

// Load template class for previous "Frusterick Manners" (2017-02-19) releases
if (DOKU_VERSION < DOKU_VERSION_FRUSTERICK_MANNERS) {

    $tpl_incdir = tpl_incdir();

    require $tpl_incdir . 'Template.php';
    require $tpl_incdir . 'SVG.php';

}

/**
 * copied from core (available since Greebo)
 */
if (!function_exists('inlineSVG')) {

    function inlineSVG($file, $maxsize = 2048)
    {
        $file = trim($file);
        if ($file === '') {
            return false;
        }

        if (!file_exists($file)) {
            return false;
        }

        if (filesize($file) > $maxsize) {
            return false;
        }

        if (!is_readable($file)) {
            return false;
        }

        $content = file_get_contents($file);
        $content = preg_replace('/<!--.*?(-->)/s', '', $content); // comments
        $content = preg_replace('/<\?xml .*?\?>/i', '', $content); // xml header
        $content = preg_replace('/<!DOCTYPE .*?>/i', '', $content); // doc type
        $content = preg_replace('/>\s+</s', '><', $content); // newlines between tags
        $content = trim($content);
        if (substr($content, 0, 5) !== '<svg ') {
            return false;
        }

        return $content;
    }

}

/**
 * copied from core (available since Detritus)
 */
if (!function_exists('tpl_toolsevent')) {

    function tpl_toolsevent($toolsname, $items, $view = 'main')
    {
        $data = array(
            'view'  => $view,
            'items' => $items,
        );

        $hook = 'TEMPLATE_' . strtoupper($toolsname) . '_DISPLAY';
        $evt  = new Doku_Event($hook, $data);

        if ($evt->advise_before()) {
            foreach ($evt->data['items'] as $k => $html) {
                echo $html;
            }
        }
        $evt->advise_after();
    }

}

/**
 * copied from core (available since Binky)
 */
if (!function_exists('tpl_classes')) {

    function tpl_classes()
    {
        global $ACT, $conf, $ID, $INFO;

        $classes = array(
            'dokuwiki',
            'mode_' . $ACT,
            'tpl_' . $conf['template'],
            !empty($_SERVER['REMOTE_USER']) ? 'loggedIn' : '',
            $INFO['exists'] ? '' : 'notFound',
            ($ID == $conf['start']) ? 'home' : '',
        );

        return join(' ', $classes);
    }

}

/**
 * copied from core (available since Detritus)
 */
if (!function_exists('plugin_getRequestAdminPlugin')) {

    function plugin_getRequestAdminPlugin()
    {
        static $admin_plugin = false;
        global $ACT, $INPUT, $INFO;

        if ($admin_plugin === false) {
            if (($ACT == 'admin') && ($page = $INPUT->str('page', '', true)) != '') {
                $pluginlist = plugin_list('admin');
                if (in_array($page, $pluginlist)) {
                    // attempt to load the plugin
                    /** @var $admin_plugin DokuWiki_Admin_Plugin */
                    $admin_plugin = plugin_load('admin', $page);
                    // verify
                    if ($admin_plugin && $admin_plugin->forAdminOnly() && !$INFO['isadmin']) {
                        $admin_plugin = null;
                        $INPUT->remove('page');
                        msg('For admins only', -1);
                    }
                }
            }
        }

        return $admin_plugin;
    }

}
