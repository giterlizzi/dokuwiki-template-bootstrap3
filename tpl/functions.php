<?php
/**
 * DokuWiki Bootstrap3 Template: Core Functions
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

global $TEMPLATE;

$TEMPLATE = \dokuwiki\template\bootstrap3\Template::getInstance();

if ($pagesize = $TEMPLATE->getConf('domParserMaxPageSize')) {
    define('MAX_FILE_SIZE', $pagesize);
}


include_once template('inc/simple_html_dom.php');

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

/**
 * Create link for DokuWiki actions
 *
 * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param  string          $type action
 * @param  string          $icon class
 * @param  boolean|string  $wrapper
 * @param  boolean         $return
 * @return string
 */
function bootstrap3_action($type, $icon = '', $wrapper = false, $return = false)
{

    global $ACT;
    global $ID;
    global $INPUT;
    global $lang;

    $output = '';

    $custom_actions = array('discussion');

    if (in_array($type, $custom_actions)) {

        if ($wrapper) {
            $output .= "<$wrapper>";
        }

        if ($type == 'discussion') {

            $discuss_page     = str_replace('@ID@', $ID, tpl_getConf('discussionPage'));
            $discuss_page_raw = str_replace('@ID@', '', tpl_getConf('discussionPage'));
            $is_discussPage   = strpos($ID, $discuss_page_raw) !== false;
            $back_id          = ':' . str_replace($discuss_page_raw, '', $ID);

            if ($is_discussPage) {

                $link = html_wikilink($back_id, tpl_getLang('back_to_article'));
                $link = str_replace('title="', 'title="' . tpl_getLang('back_to_article') . ': ', $link);

            } else {

                $link = html_wikilink($discuss_page, tpl_getLang('discussion'));
                $link = str_replace('title="', 'title="' . tpl_getLang('discussion') . ': ', $link);

            }

            $output .= str_replace(array('class="', 'wikilink1', 'wikilink2'),
                array('class="action discussion ', '', ''), $link);

            if ($icon) {
                $output = preg_replace('/(<a (.*?)>)/m', '$1<i class="' . $icon . '"></i> ', $output);
            }

        }

        if ($wrapper) {
            $output .= "</$wrapper>";
        }

    } else {

        $inner = '';

        if (isset($lang['btn_' . $type])) {
            $inner = $lang['btn_' . $type];
        }

        if ($type == 'img_backto') {
            if (strpos($inner, '%s')) {
                $inner = sprintf($inner, $ID);
            }
        }

        if ($type == 'login' && $INPUT->server->has('REMOTE_USER')) {
            $inner = $lang['btn_logout'];
        }

        if ($icon) {
            $inner = '<i class="' . $icon . '"></i> ' . $inner;
        }

        $output .= tpl_actionlink($type, '', '', $inner, true, $wrapper);

        if ($type == $ACT) {
            $output = str_replace('class="action ', 'class="action active ', $output);
        }

    }

    if ($return) {
        return $output;
    }

    echo $output;

}

/**
 * Create event for tools menus
 *
 * @author  Anika Henke <anika@selfthinker.org>
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string   $toolsname name of menu
 * @param   array    $items
 * @param   string   $view e.g. 'main', 'detail', ...
 * @param   boolean  $return
 * @return  string
 */
function bootstrap3_toolsevent($toolsname, $items, $view = 'main', $return = false)
{

    $output = '';

    $data = array(
        'view'  => $view,
        'items' => $items,
    );

    $hook = 'TEMPLATE_' . strtoupper($toolsname) . '_DISPLAY';
    $evt  = new Doku_Event($hook, $data);

    $search = array('<span>', '</span>');

    if ($evt->advise_before()) {

        foreach ($evt->data['items'] as $k => $html) {

            switch ($k) {

                case 'export_odt':
                    $icon = 'file-text';
                    break;

                case 'export_pdf':
                case 'export_odt_pdf':
                    $icon = 'file-pdf-o';
                    break;

                case 'plugin_move':
                    $icon = 'i-cursor text-muted';
                    $html = preg_replace('/<a href=""><span>(.*?)<\/span><\/a>/', '<a href="javascript:void(0)" title="$1"><span>$1</span></a>', $html);
                    break;

                case 'overlay':
                    $icon = 'clone text-muted';
                    $html = str_replace('href="', 'href="javascript:void(0)" onclick="', $html);
                    $html = preg_replace('/<a (.*?)>(.*?)<\/a>/', '<a $1><span>$2</span></a>', $html);
                    break;

                default:
                    $icon = 'puzzle-piece'; // Unknown

            }

            $replace = array('<i class="fa fa-fw fa-' . $icon . '"></i> ', '');
            $html    = str_replace($search, $replace, $html);
            $output .= $html;

        }
    }

    $evt->advise_after();

    if ($return) {
        return $output;
    }

    echo $output;

}


/**
 * Include action link with font-icon
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string   $action
 * @param   string   $icon class
 * @param   boolean  $return
 * @return  string
 */
function bootstrap3_action_item($action, $icon = null, $return = false)
{

    global $ACT;
    global $ID;
    global $TEMPLATE;

    if ($action == 'discussion') {

        if ($TEMPLATE->getConf('showDiscussion')) {
            return bootstrap3_action('discussion', $icon, 'li', true);
        }

        return '';

    }

    if ($link = bootstrap3_action($action, $icon, 'li', true)) {

        # Navbar
        if ($return) {
            return $link;
        }

        # Pagetools
        return '<li' . (($ACT == $action) ? ' class="active"' : '') . '>' . $link . '</li>';

    }

    return '';

}


/**
 * Return all DokuWiki actions for tools menu
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @return  array
 */
function bootstrap3_tools($add_icons = true)
{

    global $ACT;

    $tools['user'] = array(
        'icon'    => 'fa fa-fw fa-user',
        'actions' => array(
            'admin'    => array('icon' => 'fa fa-fw fa-cogs'),
            'profile'  => array('icon' => 'fa fa-fw fa-refresh'),
            'register' => array('icon' => 'fa fa-fw fa-user-plus'),
            'login'    => array('icon' => 'fa fa-fw fa-sign-' . (!empty($_SERVER['REMOTE_USER']) ? 'out' : 'in')),
        ),
    );

    $tools['site'] = array(
        'icon'    => 'fa fa-fw fa-cubes',
        'actions' => array(
            'recent' => array('icon' => 'fa fa-fw fa-list-alt'),
            'media'  => array('icon' => 'fa fa-fw fa-picture-o'),
            'index'  => array('icon' => 'fa fa-fw fa-sitemap'),
        ),
    );

    $tools['page'] = array(
        'icon'    => 'fa fa-fw fa-file',
        'actions' => array(
            'edit'       => array('icon' => 'fa fa-fw fa-' . (($ACT == 'edit') ? 'file-text-o' : 'pencil-square-o')),
            'discussion' => array('icon' => 'fa fa-fw fa-comments'),
            'revert'     => array('icon' => 'fa fa-fw fa-repeat'),
            'revisions'  => array('icon' => 'fa fa-fw fa-clock-o'),
            'backlink'   => array('icon' => 'fa fa-fw fa-link'),
            'subscribe'  => array('icon' => 'fa fa-fw fa-envelope-o'),
            'top'        => array('icon' => 'fa fa-fw fa-chevron-up'),
        ),
    );

    foreach ($tools as $id => $menu) {

        foreach ($menu['actions'] as $action => $item) {
            $tools[$id]['menu'][$action] = bootstrap3_action_item($action, (($add_icons) ? $item['icon'] : false));
        }

        $tools[$id]['dropdown-menu'] = bootstrap3_toolsevent($id . 'tools', $tools[$id]['menu'], 'main', true);

    }

    return $tools;

}

/**
 * Return an array for a tools menu
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @return  array of tools
 */
function bootstrap3_tools_menu($add_icons = true)
{

    global $TEMPLATE;

    $individual = $TEMPLATE->getConf('showIndividualTool');
    $tools      = bootstrap3_tools($add_icons);
    $result     = array();

    foreach ($individual as $tool) {
        if (!isset($_SERVER['REMOTE_USER']) && $tool == 'user') {
            continue;
        }

        $result[$tool] = $tools[$tool];
    }

    return $result;

}

