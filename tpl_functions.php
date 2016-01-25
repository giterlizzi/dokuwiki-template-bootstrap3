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
 * Create event for tools menues
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
function bootstrap3_toolsevent($toolsname, $items, $view='main', $return = false) {

  $output = '';

  $data = array(
    'view'  => $view,
    'items' => $items
  );

  $hook = 'TEMPLATE_'.strtoupper($toolsname).'_DISPLAY';
  $evt = new Doku_Event($hook, $data);

  $search  = array('<span>', '</span>');

  if ($evt->advise_before()) {

    foreach($evt->data['items'] as $k => $html) {

      switch ($k) {
        case 'export_odt':
          $icon = 'file-text';
          break;
        case 'export_pdf':
          $icon = 'file-pdf-o';
          break;
        case 'plugin_move':
          $icon = 'i-cursor text-muted';
          $html = preg_replace('/<a href=""><span>(.*?)<\/span>/', '<a href="" title="$1"><span>$1</span></a>', $html);
          break;
        default:
          $icon = 'puzzle-piece'; // Unknown
      }

      $replace = array('<i class="fa fa-fw fa-'. $icon .'"></i> ', '');
      $html    = str_replace($search, $replace, $html);
      $output .= $html;

    }
  }

  $evt->advise_after();

  if ($return) return $output;
  echo $output;

}


/**
 * Wrapper for left or right sidebar
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param  string  $sidebar_page
 * @param  string  $sidebar_id
 * @param  string  $sidebar_header
 * @param  string  $sidebar_footer
 */
function bootstrap3_sidebar_wrapper($sidebar_page, $sidebar_id, $sidebar_class, $sidebar_header, $sidebar_footer) {
  global $lang;
  @require('tpl_sidebar.php');
}


/**
 * Include left or right sidebar
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string  $type left or right sidebar
 * @return  boolean
 */
function bootstrap3_sidebar_include($type) {

  if (! bootstrap3_conf('showSidebar')) return false;

  global $conf;

  $left_sidebar       = $conf['sidebar'];
  $right_sidebar      = bootstrap3_conf('rightSidebar');
  $left_sidebar_grid  = bootstrap3_conf('leftSidebarGrid');
  $right_sidebar_grid = bootstrap3_conf('rightSidebarGrid');

  switch ($type) {

    case 'left':

      if (bootstrap3_conf('sidebarPosition') == 'left') {
        bootstrap3_sidebar_wrapper($left_sidebar, 'dokuwiki__aside', $left_sidebar_grid,
                                  'sidebarheader.html', 'sidebarfooter.html');
      }

      return true;

    case 'right':

      if (bootstrap3_conf('sidebarPosition') == 'right') {
        bootstrap3_sidebar_wrapper($left_sidebar, 'dokuwiki__aside', $left_sidebar_grid,
                                  'sidebarheader.html', 'sidebarfooter.html');
      }

      if (   bootstrap3_conf('showRightSidebar')
          && bootstrap3_conf('sidebarPosition') == 'left') {
        bootstrap3_sidebar_wrapper($right_sidebar, 'dokuwiki__rightaside', $right_sidebar_grid,
                                  'rightsidebarheader.html', 'rightsidebarfooter.html');
      }

      return true;
  }

  return false;

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
function bootstrap3_action_item($action, $icon, $return = false) {

  global $ACT;

  if ($action == 'discussion') {

    if (bootstrap3_conf('showDiscussion')) {
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
function bootstrap3_container_grid() {

  global $ACT;
  global $ID;
  global $conf;

  $grids  = array();
  $result = '';

  $showRightSidebar = bootstrap3_conf('showRightSidebar');
  $showLeftSidebar  = bootstrap3_conf('showSidebar');
  $fluidContainer   = bootstrap3_conf('fluidContainer');

  if(bootstrap3_conf('fluidContainerBtn')) {
    $fluidContainer = bootstrap3_fluid_container_button();
  }

  if (   bootstrap3_conf('showLandingPage')
      && (bool) preg_match(bootstrap3_conf('landingPages'), $ID) ) {
    $showLeftSidebar = false;
  }

  if (! $showLeftSidebar) {
    return 'container' . (($fluidContainer) ? '-fluid' : '');
  }

  foreach (explode(' ', bootstrap3_conf('leftSidebarGrid')) as $grid) {
    list($col, $media, $size) = explode('-', $grid);
    $grids[$media]['left'] = (int) $size;
  }

  foreach (explode(' ', bootstrap3_conf('rightSidebarGrid')) as $grid) {
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
function bootstrap3_user_homepage_link() {

  $interwiki = getInterwiki();
  $user_url  = str_replace('{NAME}', $_SERVER['REMOTE_USER'], $interwiki['user']);

  return wl(cleanID($user_url));

}


/**
 * Check if the fluid container button is enabled (from the user cookie)
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @return  boolean
 */
function bootstrap3_fluid_container_button() {

  if (! bootstrap3_conf('fluidContainerBtn')) return false;

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
  $out = str_replace('<h3 class="toggle">', '<h3 class="toggle panel-heading"><span>', $out);
  $out = str_replace('</h3>', '</span></h3>', $out);

  $out = bootstrap3_nav($out, 'pills', true);

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

  $out = bootstrap3_nav($sidebar, 'pills', true);
  $out = preg_replace('/<h([1-6])/', '<h$1 class="page-header"', $out);

  if ($return) return $out;
  echo $out;

}


/**
 * Normalize the DokuWiki list items
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string  $html
 * @return  string
 */
function bootstrap3_lists($html) {

  $output = $html;

  // Save the "curid" inside the anchor with HTML5 data "data-curid"
  $output = str_replace('<span class="curid"><a ', '<span class="curid"><a data-curid="true" ', $output);

  // Remove all <div class="li"/> tags
  $output = preg_replace('/<div class="li">(.*?)<\/div>/', '$1', $output);

  // Remove all <span class="curid"/> tags
  $output = preg_replace('/<span class="curid">(.*?)<\/span>/', '$1', $output);

  // Move the Font-Icon inside the anchor
  $output = preg_replace('/<i (.+?)><\/i> <a (.+?)>(.+?)<\/a>/', '<a $2><i $1></i> $3</a>', $output);

  // Add the "active" class for the list-item <li/> and remove the HTML5 data "data-curid"
  $output = preg_replace('/<li class="level([0-9])"> <a data-curid="true" /', '<li class="level$1 active"> <a ', $output);
  $output = preg_replace('/<li class="level([0-9]) node"> <a data-curid="true" /', '<li class="level$1 node active"> <a ', $output);

  return $output;

}



/**
 * Make a Bootstrap3 Nav
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string   $html
 * @param   string   $type (= pills, tabs, navbar)
 * @param   boolean  $staked
 * @param   string   $optional_class
 * @return  string
 **/
function bootstrap3_nav($html, $type = '', $stacked = false, $optional_class = '') {

  $classes[] = 'nav';
  $classes[] = $optional_class;

  switch ($type) {
    case 'navbar':
    case 'navbar-nav':
      $classes[] = 'navbar-nav';
      break;
    case 'pills':
    case 'tabs':
      $classes[] = "nav-$type";
      break;
  }

  if ($stacked) $classes[] = 'nav-stacked';

  $class = implode(' ', $classes);

  $output = str_replace(array('<ul class="', '<ul>'),
                        array("<ul class=\"$class ", "<ul class=\"$class\">"),
                        $html);

  $output = bootstrap3_lists($output);

  return $output;

}


/**
 * Return a Bootstrap NavBar and or drop-down menu
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @return  string
 */
function bootstrap3_navbar() {

  $navbar = bootstrap3_nav(tpl_include_page('navbar', 0, 1), 'navbar');

  $navbar = str_replace('urlextern', '', $navbar);

  $navbar = preg_replace('/<li class="level([0-9]) node"> (.*)/',
                         '<li class="level$1 node dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">$2 <span class="caret"></span></a>', $navbar);
  $navbar = preg_replace('/<ul class="(.*)">\n<li class="level2(.*)">/',
                         '<ul class="dropdown-menu" role="menu">'. PHP_EOL .'<li class="level2$2">', $navbar);

  return $navbar;

}


/**
 * Return a drop-down page
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string  $page name
 * @return  string
 */
function bootstrap3_dropdown_page($page) {

  $page = page_findnearest($page);

  if (! $page) return;

  $output   = bootstrap3_nav(tpl_include_page($page, 0, 1), 'pills', true);
  $dropdown = '<ul class="nav navbar-nav dw__dropdown_page">' .
              '<li class="dropdown dropdown-large">' .
              '<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="">' .
              p_get_first_heading($page) .
              ' <span class="caret"></span></a>' .
              '<ul class="dropdown-menu dropdown-menu-large" role="menu">' .
              '<li><div class="container">'.
              $output .
              '</div></li></ul></li></ul>';

  return $dropdown;

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
function bootstrap3_tools() {

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

  return $tools;

}


/**
 * Return an array for a tools menu
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @return  array of tools
 */
function bootstrap3_tools_menu() {

  $tools = bootstrap3_tools();

  foreach ($tools as $id => $menu) {
    foreach ($menu['items'] as $action => $item) {
      $tools[$id]['menu'][$action] = bootstrap3_action_item($action, $item['icon']);
    }
  }

  return $tools;

}


/**
 * Return an array for a toolbar
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @return  array of tools
 */
function bootstrap3_toolbar() {

  $tools = _tpl_tools();

  foreach ($tools as $id => $menu) {
    foreach ($menu['items'] as $action => $item) {
      $tools[$id]['menu'][$action] = str_replace('class="action ', 'class="action btn btn-default ', bootstrap3_action_item($action, $item['icon'], 1));
    }
  }

  return $tools;

}


/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param   string  $email  The email address
 * @param   string  $s      Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param   string  $d      Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param   string  $r      Maximum rating (inclusive) [ g | pg | r | x ]
 * @param   boolean $img    True to return a complete IMG tag False for just the URL
 * @param   array   $atts   Optional, additional key/value attributes to include in the IMG tag
 * @return  String containing either just a URL or a complete image tag
 * @source  http://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {

  $url = 'https://www.gravatar.com/avatar/';
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


/**
 * Get the template configuration metadata
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string $key
 * @return  array
 */
function bootstrap3_conf_metadata($key = null) {

  $meta = array();
  $file = tpl_incdir() . 'conf/metadata.php';
  include $file;

  if ($key) return $meta[$key];

  return $meta;

}


/**
 * Simple wrapper for tpl_getConf
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string  $key
 * @param   mixed   $default value
 * @return  mixed
 */
function bootstrap3_conf($key, $default = false) {

  global $ACT, $INFO, $ID, $conf;

  $value = tpl_getConf($key, $default);

  switch ($key) {

    case 'showTools':
    case 'showSearchForm':
    case 'showPageTools':
      return $value !== 'never' && ( $value == 'always' || ! empty($_SERVER['REMOTE_USER']) );

    case 'showIndividualTool':
    case 'hideInThemeSwitcher':
    case 'tableStyle':
      return explode(',', $value);

    case 'showAdminMenu':
      return $value && $INFO['isadmin'];

    case 'hideLoginLink':
    case 'showLoginOnFooter':
      return ($value && ! $_SERVER['REMOTE_USER']);

    case 'showSidebar':
      if (bootstrap3_conf('showLandingPage')) return false;
      return page_findnearest($conf['sidebar']) && ($ACT=='show');

    case 'showRightSidebar':
      return page_findnearest(tpl_getConf('rightSidebar')) && ($ACT=='show');

    case 'landingPages':
      return sprintf('/%s/', $value);

    case 'showLandingPage':
      return ($value && (bool) preg_match_all(bootstrap3_conf('landingPages'), $ID));

    case 'pageOnPanel':
      if (bootstrap3_conf('showLandingPage')) return false;
      return $value;

    case 'showThemeSwitcher':
      return $value && (bootstrap3_conf('bootstrapTheme') == 'bootswatch');

  }

  //$type = bootstrap3_conf_metadata($key);

  //if ($type[0] == 'regex') {
  //  return sprintf('/%s/', $value);
  //}

  return $value;

}


/**
 * Return the Bootswatch.com theme lists defined in metadata.php
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @return  array
 */
function bootstrap3_bootswatch_theme_list() {

  $bootswatch_themes = bootstrap3_conf_metadata('bootswatchTheme');
  return $bootswatch_themes['_choices'];

}


/**
 * Return only the available Bootswatch.com themes
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @return  array
 */
function bootstrap3_bootswatch_themes_available() {
  return array_diff(bootstrap3_bootswatch_theme_list(), bootstrap3_conf('hideInThemeSwitcher'));
}


/**
 * Add a font icon
 *
 * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string   $pack
 * @param   string   $name of icon
 * @param   string   $classes
 * @param   integer  $size
 * @return  string
 */
function bootstrap3_icon($pack, $name, $classes = '', $size = -1) {

  if ($size > 0 && ! preg_match('/(em|px)$/', "$size")) {
    $size = $size.'px';
  }

  $style   = ($size !== -1) ? sprintf(' style="font-size:%s"', $size) : '';

  $class[] = $pack;
  $class[] = "$pack-$name";
  $class[] = $classes;

  $output  = sprintf('<i class="%s"%s></i>', trim(implode(' ', $class)), $style);
  return $output;

}


/**
 * Add a Font-Awesome icon
 *
 * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string        $name of icon
 * @param   string|array  $options
 * @param   string        $classes
 * @param   integer       $size
 * @return  string
 */
function bootstrap3_fa($name, $options = '', $classes = '', $size = -1) {

  if (! is_array($options)) {
    $options = explode(' ', $options);
  }

  foreach ($options as $option) {
    $classes .= " fa-$option ";
  }

  return bootstrap3_icon('fa', $name, trim($classes), $size);
}


/**
 * Add a Font-Awesome stack icon
 *
 * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string   $icon1
 * @param   string   $icon2
 * @param   boolead  $switch the position of icon1 and icon2
 * @return  string
 */
function bootstrap3_fa_stack($icon1, $icon2, $switch = false) {

  $icon2 = str_replace('class="', 'class="fa-stack-1x ', $icon2);
  $icon1 = str_replace('class="', 'class="fa-stack-2x ', $icon1);

  if ($switch) {

    $tmp1  = $icon1;
    $tmp2  = $icon2;

    $icon1 = $tmp2;
    $icon2 = $tmp1;

  }

  return sprintf('<span class="fa-stack fa-lg">%s %s</span>', $icon1, $icon2);

}


/**
 * Add a Glyophicon icon
 *
 * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string  $name of icon
 * @param   string  $classes
 * @param   integer $size
 * @return  string
 */
function bootstrap_glyphicon($name, $classes = '', $size = -1) {
  return bootstrap3_icon('glyphicon', $name, $classes, $size);
}


/**
 * Print the breadcrumbs trace with Bootstrap style
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @return bool
 */
function bootstrap3_breadcrumbs() {

  global $lang;
  global $conf;

  //check if enabled
  if(!$conf['breadcrumbs']) return false;

  $crumbs = breadcrumbs(); //setup crumb trace

  //render crumbs, highlight the last one
  print '<ol class="breadcrumb">';
  print '<li>' . rtrim($lang['breadcrumb'], ':') . '</li>';

  $last = count($crumbs);
  $i    = 0;

  foreach($crumbs as $id => $name) {

    $i++;

    print ($i == $last) ? '<li class="active">' : '<li>';
    tpl_link(wl($id), hsc($name), 'title="'.$id.'"');
    print '</li>';

    if($i == $last) print '</ol>';

  }

  return true;

}


/**
 * Hierarchical breadcrumbs with Bootstrap style
 *
 * This code was suggested as replacement for the usual breadcrumbs.
 * It only makes sense with a deep site structure.
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 * @author Nigel McNie <oracle.shinoda@gmail.com>
 * @author Sean Coates <sean@caedmon.net>
 * @author <fredrik@averpil.com>
 * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @todo   May behave strangely in RTL languages
 *
 * @return bool
 */
function bootstrap3_youarehere() {

    global $conf;
    global $ID;
    global $lang;

    // check if enabled
    if(!$conf['youarehere']) return false;

    $parts = explode(':', $ID);
    $count = count($parts);

    echo '<ol class="breadcrumb">';
    echo '<li>' . rtrim($lang['youarehere'], ':') . '</li>';

    // always print the startpage
    echo '<li>';
    tpl_link(wl($conf['start']), '<i class="fa fa-fw fa-home"></i>', 'title="'. $conf['start'] .'"');
    echo '</li>';

    // print intermediate namespace links
    $part = '';

    for($i = 0; $i < $count - 1; $i++) {

        $part .= $parts[$i].':';
        $page = $part;

        if($page == $conf['start']) continue; // Skip startpage

        // output
        echo '<li>';
        echo str_replace('curid', '', html_wikilink($page));
        echo '</li>';

    }

    // print current page, skipping start page, skipping for namespace index
    resolve_pageid('', $page, $exists);

    if (isset($page) && $page == $part.$parts[$i]) {
      echo '</ol>';
      return true;
    }

    $page = $part.$parts[$i];

    if($page == $conf['start']) {
      echo '</ol>';
      return true;
    }

    echo '<li class="active">';
    echo str_replace('curid', '', html_wikilink($page));
    echo '</li>';

    echo '</ol>';

    return true;

}


/**
 * Include (or override) a TPL file
 *
 * @see require_once()
 * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string $file
 * @return  boolean
 */
function bootstrap3_include($file) {

  $override = dirname(__FILE__) . "/override/$file";

  if (file_exists($override)) {
    require_once($override);
    return true;
  }

  require_once($file);
  return true;

}


function bootstrap3_page_browser_title() {

  global $conf, $ACT, $ID;

  if (bootstrap3_conf('browserTitleShowNS') && $ACT == 'show') {

    $ns_parts     = explode(':', $ID);
    $ns_pages     = array();
    $ns_titles    = array();
    $ns_separator = sprintf(' %s ', bootstrap3_conf('browserTitleCharSepNS'));

    if (useHeading('navigation')) {

      if (count($ns_parts) > 1) {

        foreach ($ns_parts as $ns_part) {
          $ns_page .= "$ns_part:";
          $ns_pages[] = $ns_page;
        }

        $ns_pages = array_unique($ns_pages);

        foreach ($ns_pages as $ns_page) {

          resolve_pageid(getNS($ns_page), $ns_page, $exists);

          $ns_page_title_heading = hsc(p_get_first_heading($ns_page));
          $ns_page_title_page    = noNSorNS($ns_page);
          $ns_page_title         = ($exists) ? $ns_page_title_heading : $ns_page_title_page;

          if ($ns_page_title !== $conf['start']) {
            $ns_titles[] = $ns_page_title;
          }

        }

      }

      resolve_pageid(getNS($ID), $ID, $exists);

      if ($exists) {
        $ns_titles[] = tpl_pagetitle($ID, true);
      }

      $ns_titles = array_filter(array_unique($ns_titles));

    } else {
      $ns_titles = $ns_parts;
    }

    if (bootstrap3_conf('browserTitleOrderNS') == 'normal') {
      $ns_titles = array_reverse($ns_titles);
    }

    $browser_title = implode($ns_separator, $ns_titles);

  } else {
    $browser_title = tpl_pagetitle($ID, true);
  }

  return str_replace(array('@WIKI@', '@TITLE@'),
                      array(strip_tags($conf['title']), $browser_title),
                      bootstrap3_conf('browserTitle'));

}


function bootstrap3_is_fluid_container() {

  $fluid_container     = bootstrap3_conf('fluidContainer');
  $fluid_container_btn = bootstrap3_fluid_container_button();

  if ($fluid_container_btn) {
    $fluid_container = true;
  }

  return $fluid_container;

}

function bootstrap3_is_fluid_navbar() {

  $fluid_container  = bootstrap3_is_fluid_container();
  $fixed_top_nabvar = bootstrap3_conf('fixedTopNavbar');

  return ($fluid_container || ($fluid_container && ! $fixed_top_nabvar) || (! $fluid_container && ! $fixed_top_nabvar));

}
