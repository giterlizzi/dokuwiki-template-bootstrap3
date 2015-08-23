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
function _tpl_discussion($discussionPage, $title, $backTitle, $link=0, $wrapper=0, $return=0) {
    global $ID;
    $output = '';
    $discussPage    = str_replace('@ID@', $ID, $discussionPage);
    $discussPageRaw = str_replace('@ID@', '', $discussionPage);
    $isDiscussPage  = strpos($ID, $discussPageRaw) !== false;
    $backID         = ':'.str_replace($discussPageRaw, '', $ID);
    if ($wrapper) $output .= "<$wrapper>";
    if ($isDiscussPage) {
        if ($link) {
            ob_start();
            tpl_pagelink($backID, $backTitle);
            $output .= ob_get_contents();
            ob_end_clean();
        } else {
            $output .= html_btn('back2article', $backID, '', array(), 'get', 0, $backTitle);
        }
    } else {
        if ($link) {
            ob_start();
            tpl_pagelink($discussPage, $title);
            $output .= ob_get_contents();
            ob_end_clean();
        } else {
            $output .= html_btn('discussion', $discussPage, '', array(), 'get', 0, $title);
        }
    }
    if ($wrapper) $output .= "</$wrapper>";
    if ($return) return $output;
    echo $output;
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
function _tpl_action($type, $link=0, $wrapper=0, $return=0) {
    switch ($type) {
        case 'discussion':
            if (tpl_getConf('discussionPage')) {
                $output = _tpl_discussion(tpl_getConf('discussionPage'), tpl_getLang('discussion'), tpl_getLang('back_to_article'), $link, $wrapper, 1);
                if ($return) return $output;
                echo $output;
            }
            break;
        case 'userpage':
            if (tpl_getConf('userPage')) {
                $output = _tpl_userpage(tpl_getConf('userPage'), tpl_getLang('userpage'), $link, $wrapper, 1);
                if ($return) return $output;
                echo $output;
            }
            break;
    }
}


/**
 * copied to core (available since Detritus)
 */
if (!function_exists('tpl_toolsevent')) {
    function tpl_toolsevent($toolsname, $items, $view='main') {
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
 * @param   boolean  $return
 * @return  string
 */
function _tpl_action_item($action, $icon, $return = false) {

  global $ACT;

  if ($action == 'discussion') {

    if (tpl_getConf('showDiscussion')) {
      $out = _tpl_action('discussion', 1, 'li', 1);
      $out = str_replace(array('<bdi>', '</bdi>'), '', $out);
      return preg_replace('/(<a (.*?)>)/m', '$1<i class="'.$icon.'"></i> ', $out);
    }

    return '';

  }

  if ($link = tpl_action($action, 1, 0, 1, '<i class="'.$icon.'"></i> ')) {

    if ($return) {
      if ($ACT == $action) {
        $link = str_replace('class="action ', 'class="action active ', $link);
      }
      return $link;
    }

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

  if(tpl_getConf('fluidContainerBtn')) {
    $fluidContainer = _tpl_fluid_container_button();
  }


  if (! $showLeftSidebar) {
    return 'container' . (($fluidContainer) ? '-fluid' : '');
  }

  foreach (explode(' ', tpl_getConf('leftSidebarGrid')) as $grid) {
    list($col, $media, $size) = explode('-', $grid);
    $grids[$media]['left'] = (int) $size;
  }

  foreach (explode(' ', tpl_getConf('rightSidebarGrid')) as $grid) {
    list($col, $media, $size) = explode('-', $grid);
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


function _tpl_fluid_container_button() {

  if (! tpl_getConf('fluidContainerBtn')) return false;

  if (   get_doku_pref('fluidContainer', null) !== null
      && get_doku_pref('fluidContainer', null) !== ''
      && get_doku_pref('fluidContainer', null) !== '0') {
    return true;
  }

  return false;

}


/**
 * Manipulate DokuWiki TOC to add Bootstrap3 styling
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string   $toc from tpl_toc()
 * @param   boolean  $return
 * @return  string
 */
function bootstrap3_toc($toc, $return = false) {

  $out = str_replace('<div id="', '<div class="panel panel-default" id="', $toc);
  $out = str_replace('<div>', '<div class="panel-body">', $out);
  $out = str_replace('<h3 class="', '<h3 class="panel-heading ', $out);
  $out = str_replace('<ul class="toc">', '<ul class="toc nav nav-pills nav-stacked">', $out);
  $out = preg_replace('/<div class=\"li\">(.*?)<\/div>/', '$1', $out);

  if ($return) return $out;
  echo $out;

}


/**
 * Manipulate Sidebar page to add Bootstrap3 styling
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string   $sidebar
 * @param   boolean  $return
 * @return  string
 */
function bootstrap3_sidebar($sidebar, $return = false) {

  $out = str_replace('<ul>', '<ul class="nav nav-pills nav-stacked">', $sidebar);
  $out = preg_replace('/<div class=\"li\">(.*?)<\/div>/', '$1', $out);
  $out = preg_replace('/<li class="level([0-9]) node"> <span class="curid">/', '<li class="level$1 node active"> <span class="curid">', $out);
  $out = preg_replace('/<li class="level([0-9])"> <span class="curid">/', '<li class="level$1 active"> <span class="curid">', $out);
  $out = preg_replace('/<span class=\"curid\">(.*?)<\/span>/', '$1', $out);

  if ($return) return $out;
  echo $out;

}


/**
 * Print the search form in Bootstrap Style
 *
 * If the first parameter is given a div with the ID 'qsearch_out' will
 * be added which instructs the ajax pagequicksearch to kick in and place
 * its output into this div. The second parameter controls the propritary
 * attribute autocomplete. If set to false this attribute will be set with an
 * value of "off" to instruct the browser to disable it's own built in
 * autocompletion feature (MSIE and Firefox)
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @param bool $ajax
 * @param bool $autocomplete
 * @return bool
 */
function bootstrap3_searchform($ajax = true, $autocomplete = true) {

    global $lang;
    global $ACT;
    global $QUERY;

    // don't print the search form if search action has been disabled
    if (!actionOK('search')) return false;

    print '<form action="'.wl().'" accept-charset="utf-8" class="navbar-form navbar-left search" id="dw__search" method="get" role="search"><div class="no">';

    print '<div class="form-group">';

    print '<input type="hidden" name="do" value="search" />';

    print '<input ';
    if ($ACT == 'search') print 'value="'.htmlspecialchars($QUERY).'" ';
    if (!$autocomplete) print 'autocomplete="off" ';
    print 'id="qsearch__in" type="search" placeholder="'.$lang['btn_search'].'" accesskey="f" name="id" class="edit form-control" title="[F]" />';

    print '</div>';

    print ' <button type="submit" class="btn btn-default" title="'.$lang['btn_search'].'"><i class="fa fa-fw fa-search"></i><span class="hidden-lg hidden-md hidden-sm"> '.$lang['btn_search'].'</span></button>';

    if ($ajax) print '<div id="qsearch__out" class="panel panel-default ajax_qsearch JSpopup"></div>';
    print '</div></form>';

    return true;
}


/**
 * Prints the global message array in Bootstrap style
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 */
function bootstrap3_html_msgarea() {

    global $MSG, $MSG_shown;
    /** @var array $MSG */
    // store if the global $MSG has already been shown and thus HTML output has been started
    $MSG_shown = true;

    if(!isset($MSG)) return;

    $shown = array();

    foreach($MSG as $msg){

        $hash = md5($msg['msg']);
        if(isset($shown[$hash])) continue; // skip double messages

        if(info_msg_allowed($msg)){

            switch ($msg['lvl']) {
              case 'info':
                $level = 'info';
                $icon  = 'fa fa-fw fa-info-circle';
                break;
              case 'error':
                $level = 'danger';
                $icon  = 'fa fa-fw fa-times-circle';
                break;
              case 'notify':
                $level = 'warning';
                $icon  = 'fa fa-fw fa-warning';
                break;
              case 'success':
                $level = 'success';
                $icon  = 'fa fa-fw fa-check-circle';
                break;
            }
            print '<div class="alert alert-'.$level.'">';
            print '<i class="'.$icon.'"></i> ';
            print $msg['msg'];
            print '</div>';

        }

        $shown[$hash] = 1;
    }

    unset($GLOBALS['MSG']);

}


/**
 * Return all DokuWiki actions for tools menu
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @return  array
 */
function _tpl_tools() {

  global $ACT;

  $result = array();
  $tools  = array(

    'user' => array(
      'icon'  => 'fa fa-fw fa-user',
      'items' => array(
        'admin'    => array('icon' => 'fa fa-fw fa-cogs'),
        'profile'  => array('icon' => 'fa fa-fw fa-refresh'),
        #'register' => array('icon' => 'fa fa-fw fa-user-plus'),
        #'login'    => array('icon' => 'fa fa-fw fa-sign-'.(!empty($_SERVER['REMOTE_USER']) ? 'out' : 'in')),
      )
    ),

    'site' => array(
      'icon'  => 'fa fa-fw fa-wrench',
      'items' => array(
        'recent' => array('icon' => 'fa fa-fw fa-list-alt'),
        'media'  => array('icon' => 'fa fa-fw fa-picture-o'),
        'index'  => array('icon' => 'fa fa-fw fa-sitemap'),
      )
    ),

    'page' => array(
      'icon'  => 'fa fa-fw fa-file',
      'items' => array(
        'edit'       => array('icon' => 'fa fa-fw fa-' . (($ACT == 'edit') ? 'file-text-o' : 'pencil-square-o')),
        'discussion' => array('icon' => 'fa fa-fw fa-comments'),
        'revert'     => array('icon' => 'fa fa-fw fa-repeat'),
        'revisions'  => array('icon' => 'fa fa-fw fa-clock-o'),
        'backlink'   => array('icon' => 'fa fa-fw fa-link'),
        'subscribe'  => array('icon' => 'fa fa-fw fa-envelope-o'),
        'top'        => array('icon' => 'fa fa-fw fa-chevron-up'),
      )
    ),

  );

  foreach (explode(',', tpl_getConf('showIndividualTool')) as $tool) {
    $result[$tool] = $tools[$tool];
  }

  return $result;

}


function bootstrap3_tools_menu() {

  $tools = _tpl_tools();

  foreach ($tools as $id => $menu) {
    foreach ($menu['items'] as $action => $item) {
      $tools[$id]['menu'][$action] = _tpl_action_item($action, $item['icon']);
    }
  }

  return $tools;

}


function bootstrap3_toolbar() {

  $tools = _tpl_tools();

  foreach ($tools as $id => $menu) {
    foreach ($menu['items'] as $action => $item) {
      $tools[$id]['menu'][$action] = str_replace('class="action ', 'class="action btn btn-default ', _tpl_action_item($action, $item['icon'], 1));
    }
  }

  return $tools;

}


/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boolean $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source http://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
  $url = 'http://www.gravatar.com/avatar/';
  $url .= md5( strtolower( trim( $email ) ) );
  $url .= "?s=$s&d=$d&r=$r";
  if ( $img ) {
      $url = '<img src="' . $url . '"';
      foreach ( $atts as $key => $val )
          $url .= ' ' . $key . '="' . $val . '"';
      $url .= ' />';
  }
  return $url;
}
