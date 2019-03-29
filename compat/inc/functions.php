<?php

/**
 * DokuWiki Bootstrap3 Template: Compatibility functions
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

/**
 * copied from core (available since Greebo)
 */
if (!function_exists('inlineSVG')) {

    function inlineSVG($file, $maxsize = 2048) {
        $file = trim($file);
        if($file === '') return false;
        if(!file_exists($file)) return false;
        if(filesize($file) > $maxsize) return false;
        if(!is_readable($file)) return false;
        $content = file_get_contents($file);
        $content = preg_replace('/<!--.*?(-->)/s','', $content); // comments
        $content = preg_replace('/<\?xml .*?\?>/i', '', $content); // xml header
        $content = preg_replace('/<!DOCTYPE .*?>/i', '', $content); // doc type
        $content = preg_replace('/>\s+</s', '><', $content); // newlines between tags
        $content = trim($content);
        if(substr($content, 0, 5) !== '<svg ') return false;
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

