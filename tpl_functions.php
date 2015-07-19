<?php
/**
 * Template Functions
 *
 * This file provides template specific custom functions that are
 * not provided by the DokuWiki core.
 * It is common practice to start each function with an underscore
 * to make sure it won't interfere with future core functions.
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

/**
 * Create link/button to discussion page and back
 *
 * @author Anika Henke <anika@selfthinker.org>
 */
function _tpl_discussion($discussionPage, $title, $backTitle, $link=0, $wrapper=0) {
    global $ID;

    $discussPage    = str_replace('@ID@', $ID, $discussionPage);
    $discussPageRaw = str_replace('@ID@', '', $discussionPage);
    $isDiscussPage  = strpos($ID, $discussPageRaw) !== false;
    $backID         = ':'.str_replace($discussPageRaw, '', $ID);

    if ($wrapper) echo "<$wrapper>";

    if ($isDiscussPage) {
        if ($link)
            tpl_pagelink($backID, $backTitle);
        else
            echo html_btn('back2article', $backID, '', array(), 'get', 0, $backTitle);
    } else {
        if ($link)
            tpl_pagelink($discussPage, $title);
        else
            echo html_btn('discussion', $discussPage, '', array(), 'get', 0, $title);
    }

    if ($wrapper) echo "</$wrapper>";
}

/**
 * Create link/button to user page
 *
 * @author Anika Henke <anika@selfthinker.org>
 */
function _tpl_userpage($userPage, $title, $link=0, $wrapper=0) {
    if (empty($_SERVER['REMOTE_USER'])) return;

    global $conf;
    $userPage = str_replace('@USER@', $_SERVER['REMOTE_USER'], $userPage);

    if ($wrapper) echo "<$wrapper>";

    if ($link)
        tpl_pagelink($userPage, $title);
    else
        echo html_btn('userpage', $userPage, '', array(), 'get', 0, $title);

    if ($wrapper) echo "</$wrapper>";
}

/**
 * Wrapper around custom template actions
 *
 * @author Anika Henke <anika@selfthinker.org>
 */
function _tpl_action($type, $link=0, $wrapper=0) {
    switch ($type) {
        case 'discussion':
            if (tpl_getConf('discussionPage')) {
                _tpl_discussion(tpl_getConf('discussionPage'), tpl_getLang('discussion'), tpl_getLang('back_to_article'), $link, $wrapper);
            }
            break;
        case 'userpage':
            if (tpl_getConf('userPage')) {
                _tpl_userpage(tpl_getConf('userPage'), tpl_getLang('userpage'), $link, $wrapper);
            }
            break;
    }
}

/**
 * Create event for tools menues
 *
 * @author Anika Henke <anika@selfthinker.org>
 */
function _tpl_toolsevent($toolsname, $items, $view='main') {
    $data = array(
        'view'  => $view,
        'items' => $items
    );

    $hook = 'TEMPLATE_'.strtoupper($toolsname).'_DISPLAY';
    $evt = new Doku_Event($hook, $data);
    if($evt->advise_before()){
        foreach($evt->data['items'] as $k => $html) echo $html;
    }
    $evt->advise_after();
}

/**
 * copied from core (available since Binky)
 */
if (!function_exists('tpl_classes')) {
    function tpl_classes() {
        global $ACT, $conf, $ID, $INFO;
        $classes = array(
            'dokuwiki',
            'mode_'.$ACT,
            'tpl_'.$conf['template'],
            !empty($_SERVER['REMOTE_USER']) ? 'loggedIn' : '',
            $INFO['exists'] ? '' : 'notFound',
            ($ID == $conf['start']) ? 'home' : '',
        );
        return join(' ', $classes);
    }
}


/**
 * Include left or right sidebar
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param  string  $sidebar_page
 * @param  string  $sidebar_id
 * @param  string  $sidebar_header
 * @param  string  $sidebar_footer
 */
function _tpl_sidebar($sidebar_page, $sidebar_id, $sidebar_class, $sidebar_header, $sidebar_footer) {
  global $lang;
  @require('tpl_sidebar.php');
}


/**
 * Include action link with font-icon
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * 
 * @param   string   $action
 * @param   string   $icon class
 * @param   boolean  $linkonly
 * @return  string
 */
function _tpl_action_item($action, $icon, $linkonly = false) {

  global $ACT;

  if ($action == 'discussion') {
    if (tpl_getConf('showDiscussion')) {
      ob_start();
      _tpl_action('discussion', 1, 'li', $icon);
      $out = ob_get_clean();
      $out = str_replace(array('<bdi>', '</bdi>'), '', $out);
      return preg_replace('/(<a (.*?)>)/m', '$1<i class="'.$icon.'"></i> ', $out);
    }
    return '';
  }

  if ($link = tpl_action($action, 1, 0, 1, '<i class="'.$icon.'"></i> ')) {
    if ($linkonly) return $link;
    return '<li' . (($ACT == $action) ? ' class="active"' : ''). '>' . $link . '</li>';
  }

  return '';
}

/**
 * Calculate automatically the grid size for main container
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @return  string
 */
function _tpl_get_container_grid() {

  global $ACT;
  global $conf;

  $grids  = array();
  $result = '';

  $showRightSidebar = page_findnearest(tpl_getConf('rightSidebar')) && ($ACT=='show');
  $showLeftSidebar  = page_findnearest($conf['sidebar']) && ($ACT=='show');
  $fluidContainer   = tpl_getConf('fluidContainer');

  if (! $showLeftSidebar) {
    return 'container' . (($fluidContainer) ? '-fluid' : '');
  }

  foreach (split(' ', tpl_getConf('leftSidebarGrid')) as $grid) {
    list($col, $media, $size) = split('-', $grid);
    $grids[$media]['left'] = (int) $size;
  }

  foreach (split(' ', tpl_getConf('rightSidebarGrid')) as $grid) {
    list($col, $media, $size) = split('-', $grid);
    $grids[$media]['right'] = (int) $size;
  }

  foreach ($grids as $media => $item) {
    $left    = $item['left'];
    $right   = $item['right'];
    $result .= sprintf('col-%s-%s ', $media, (12 - $left - ($showRightSidebar ? $right : 0)));
  }

  return $result;

}

/**
 * Return the user home-page link
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @return  string
 */
function _tpl_user_homepage_link() {

  $interwiki = getInterwiki();
  $user_url  = str_replace('{NAME}', $_SERVER['REMOTE_USER'], $interwiki['user']);

  return wl(cleanID($user_url));

}
