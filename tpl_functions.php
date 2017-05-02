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
 * copied from core (available since Detritus)
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
 * copied from core (available since Detritus)
 */
if (! function_exists('plugin_getRequestAdminPlugin')) {
  function plugin_getRequestAdminPlugin(){
    static $admin_plugin = false;
    global $ACT,$INPUT,$INFO;

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
            msg('For admins only',-1);
          }
        }
      }
    }

    return $admin_plugin;
  }

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

  global $conf;

  $left_sidebar       = $conf['sidebar'];
  $right_sidebar      = bootstrap3_conf('rightSidebar');
  $left_sidebar_grid  = bootstrap3_conf('leftSidebarGrid');
  $right_sidebar_grid = bootstrap3_conf('rightSidebarGrid');

  if (! bootstrap3_conf('showSidebar')) return false;

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
function bootstrap3_action_item($action, $icon = null, $return = false) {

  global $ACT;

  if ($icon) {
    $icon = '<i class="'.$icon.'"></i> ';
  }

  if ($action == 'discussion') {

    if (bootstrap3_conf('showDiscussion')) {
      $out = _tpl_action('discussion', 1, 'li', 1);
      $out = str_replace(array('<bdi>', '</bdi>'), '', $out);
      return preg_replace('/(<a (.*?)>)/m', '$1'.$icon, $out);
    }

    return '';

  }

  if ($link = tpl_action($action, 1, 0, 1, $icon)) {

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

  $result = '';

  $grids = array(
    'sm' => array('left' => 0, 'right' => 0),
    'md' => array('left' => 0, 'right' => 0),
  );

  $show_right_sidebar = bootstrap3_conf('showRightSidebar');
  $show_left_sidebar  = bootstrap3_conf('showSidebar');
  $fluid_container    = bootstrap3_is_fluid_container();

  if (   bootstrap3_conf('showLandingPage')
      && (bool) preg_match(bootstrap3_conf('landingPages'), $ID) ) {
    $show_left_sidebar = false;
  }

  if (! $show_left_sidebar && ! $show_right_sidebar) {
    return 'container' . (($fluid_container) ? '-fluid' : '');
  }

  if ($show_left_sidebar) {
    foreach (explode(' ', bootstrap3_conf('leftSidebarGrid')) as $grid) {
      list($col, $media, $size) = explode('-', $grid);
      $grids[$media]['left'] = (int) $size;
    }
  }

  if ($show_right_sidebar) {
    foreach (explode(' ', bootstrap3_conf('rightSidebarGrid')) as $grid) {
      list($col, $media, $size) = explode('-', $grid);
      $grids[$media]['right'] = (int) $size;
    }
  }

  foreach ($grids as $media => $position) {
    $left    = $position['left'];
    $right   = $position['right'];
    $result .= sprintf('col-%s-%s ', $media, (12 - $left - $right));
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
  $out = preg_replace('/<h([1-6]) id="(.*)">/', '<h$1 class="page-header" id="$2">', $out);
  $out = preg_replace('/<h([1-6]) class="(.*)" id="(.*)">/', '<h$1 class="$2 page-header" id="$3">', $out);

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

  if (bootstrap3_conf('showNavbar') === 'logged' && ! $_SERVER['REMOTE_USER']) return false;

  global $ID;

  $navbar = bootstrap3_nav(tpl_include_page('navbar', 0, 1, bootstrap3_conf('useACL')), 'navbar');

  $navbar = str_replace('urlextern', '', $navbar);

  $navbar = preg_replace('/<li class="level([0-9]) node"> (.*)/',
                         '<li class="level$1 node dropdown"><a href="'.wl($ID).'" class="dropdown-toggle" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">$2 <span class="caret"></span></a>', $navbar);
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

  $page = page_findnearest($page, bootstrap3_conf('useACL'));

  if (! $page) return;

  $output   = bootstrap3_nav(tpl_include_page($page, 0, 1, bootstrap3_conf('useACL')), 'pills', true);
  $dropdown = '<ul class="nav navbar-nav dw__dropdown_page">' .
              '<li class="dropdown dropdown-large">' .
              '<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="">' .
              p_get_first_heading($page) .
              ' <span class="caret"></span></a>' .
              '<ul class="dropdown-menu dropdown-menu-large" role="menu">' .
              '<li><div class="container small">'.
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
 * @param  bool $ajax
 * @param  bool $autocomplete
 * @return bool
 */
function bootstrap3_searchform($ajax = true, $autocomplete = true) {

    global $lang;
    global $ACT;
    global $QUERY;

    // don't print the search form if search action has been disabled
    if (! actionOK('search')) return false;

    if (! bootstrap3_conf('showSearchForm')) return false;

    print '<form action="'.wl().'" accept-charset="utf-8" class="navbar-form navbar-left search" id="dw__search" method="get" role="search"><div class="no">';

    print '<div class="form-group">';

    print '<input type="hidden" name="do" value="search" />';

    print '<input ';
    if ($ACT == 'search') print 'value="'.htmlspecialchars($QUERY).'" ';
    if (!$autocomplete) print 'autocomplete="off" ';
    print 'id="qsearch__in" type="search" placeholder="'.$lang['btn_search'].'" accesskey="f" name="id" class="edit form-control" title="[F]" />';

    print '</div>';

    if (bootstrap3_conf('showSearchButton')) {
      print ' <button type="submit" class="btn btn-default" title="'.$lang['btn_search'].'"><i class="fa fa-fw fa-search"></i><span class="hidden-lg hidden-md hidden-sm"> '.$lang['btn_search'].'</span></button>';
    }

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

  // Check if translation is outdate
  if (bootstrap3_conf('showTranslation') && $translation = plugin_load('helper','translation')) {
    global $ID;
    if ($translation->istranslatable($ID)) $translation->checkage();
  }

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
function bootstrap3_tools($add_icons = true) {

  global $ACT;

  $tools['user'] = array(
    'icon'    => 'fa fa-fw fa-user',
    'actions' => array(
      'admin'    => array('icon' => 'fa fa-fw fa-cogs'),
      'profile'  => array('icon' => 'fa fa-fw fa-refresh'),
      'register' => array('icon' => 'fa fa-fw fa-user-plus'),
      'login'    => array('icon' => 'fa fa-fw fa-sign-'.(!empty($_SERVER['REMOTE_USER']) ? 'out' : 'in')),
    )
  );

  $tools['site'] = array(
    'icon'    => 'fa fa-fw fa-cubes',
    'actions' => array(
      'recent' => array('icon' => 'fa fa-fw fa-list-alt'),
      'media'  => array('icon' => 'fa fa-fw fa-picture-o'),
      'index'  => array('icon' => 'fa fa-fw fa-sitemap'),
    )
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
    )
  );

  foreach ($tools as $id => $menu) {

    foreach ($menu['actions'] as $action => $item) {
      $tools[$id]['menu'][$action] = bootstrap3_action_item($action, (($add_icons) ? $item['icon'] : false));
    }

    $tools[$id]['dropdown-menu'] = bootstrap3_toolsevent($id.'tools', $tools[$id]['menu'], 'main', true);

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
function bootstrap3_tools_menu($add_icons = true) {

  $individual = bootstrap3_conf('showIndividualTool');
  $tools      = bootstrap3_tools($add_icons);
  $result     = array();

  foreach ($individual as $tool) {
    if (! isset($_SERVER['REMOTE_USER']) && $tool == 'user') continue;
    $result[$tool] = $tools[$tool];
  }

  return $result;

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

  $url = 'https://gravatar.com/avatar/';
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

    case 'bootstrapTheme':
      @list($theme, $bootswatch) = bootstrap3_theme_by_namespace();
      if ($theme) return $theme;
      return $value;

    case 'bootswatchTheme':
      @list($theme, $bootswatch) = bootstrap3_theme_by_namespace();
      if ($bootswatch) return $bootswatch;
      return $value;

    case 'showTools':
    case 'showSearchForm':
    case 'showPageTools':
    case 'showEditBtn':
    case 'showAddNewPage':
      return $value !== 'never' && ( $value == 'always' || ! empty($_SERVER['REMOTE_USER']) );

    case 'showAdminMenu':
      return $value && $INFO['isadmin'];

    case 'hideLoginLink':
    case 'showLoginOnFooter':
      return ($value && ! $_SERVER['REMOTE_USER']);

    case 'showCookieLawBanner':
      return $value && page_findnearest(tpl_getConf('cookieLawBannerPage'), bootstrap3_conf('useACL')) && ($ACT=='show');

    case 'showSidebar':
      if ($ACT !== 'show') return false;
      if (bootstrap3_conf('showLandingPage')) return false;
      return page_findnearest($conf['sidebar'], bootstrap3_conf('useACL'));

    case 'showRightSidebar':
      if ($ACT !== 'show') return false;
      if (bootstrap3_conf('sidebarPosition') == 'right') return false;
      return page_findnearest(tpl_getConf('rightSidebar'), bootstrap3_conf('useACL'));

    case 'showLandingPage':
      return ($value && (bool) preg_match_all(bootstrap3_conf('landingPages'), $ID));

    case 'pageOnPanel':
      if (bootstrap3_conf('showLandingPage')) return false;
      return $value;

    case 'showThemeSwitcher':
      return $value && (bootstrap3_conf('bootstrapTheme') == 'bootswatch');

    case 'tocCollapseSubSections':
      if (! bootstrap3_conf('tocAffix')) return false;
      return $value;

    case 'schemaOrgType':

      if ($semantic = plugin_load('helper', 'semantic')) {
        if (method_exists($semantic, 'getSchemaOrgType')) {
          return $semantic->getSchemaOrgType();
        }
      }

      return $value;

  }

  $metadata = bootstrap3_conf_metadata($key);

  switch ($metadata[0]) {
    case 'regex':
      return sprintf('/%s/', $value);
    case 'multicheckbox':
      return explode(',', $value);
  }

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

    $semantic = bootstrap3_conf('semantic');

    echo '<ol class="breadcrumb"'. ($semantic ? ' itemscope itemtype="http://schema.org/BreadcrumbList"' : '') .'>';
    echo '<li>' . rtrim($lang['youarehere'], ':') . '</li>';

    // always print the startpage
    echo '<li'.($semantic ? ' itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"' : '').'>';

    tpl_link(wl($conf['start']),
             ($semantic ? '<span itemprop="name">' : '') . '<i class="fa fa-fw fa-home"></i>' . ($semantic ? '</span>' : ''),
             ($semantic ? ' itemprop="item" ' : '') . 'title="'. $conf['start'] .'"'
            );

    echo '</li>';

    // print intermediate namespace links
    $part = '';

    for($i = 0; $i < $count - 1; $i++) {

        $part .= $parts[$i].':';
        $page = $part;

        if($page == $conf['start']) continue; // Skip startpage

        // output
        echo '<li'. ($semantic ? ' itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"' : '') .'>';

        $link = html_wikilink($page);
        $link = str_replace(' class="curid"', '', html_wikilink($page));

        if ($semantic) $link = str_replace(array('<a', '<span'), array('<a itemprop="item" ', '<span itemprop="name" '), $link);

        echo $link;
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

    echo '<li class="active"'. ($semantic ? ' itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"' : '') .'>';

    $link = html_wikilink($page);
    $link = str_replace(' class="curid"', '', html_wikilink($page));

    if ($semantic) $link = str_replace(array('<a', '<span'), array('<a itemprop="item" ', '<span itemprop="name" '), $link);

    echo $link;
    echo '</li>';
    echo '</ol>';

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


/**
 * Places the TOC where the function is called
 *
 * If you use this you most probably want to call tpl_content with
 * a false argument
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param bool $return Should the TOC be returned instead to be printed?
 * @return string
 */
function bootstrap3_toc($return = false) {

  global $TOC;
  global $ACT;
  global $ID;
  global $REV;
  global $INFO;
  global $conf;
  global $INPUT;

  $toc = array();

  if(is_array($TOC)) {
    // if a TOC was prepared in global scope, always use it
    $toc = $TOC;
  } elseif(($ACT == 'show' || substr($ACT, 0, 6) == 'export') && !$REV && $INFO['exists']) {
    // get TOC from metadata, render if neccessary
    $meta = p_get_metadata($ID, '', METADATA_RENDER_USING_CACHE);
    if(isset($meta['internal']['toc'])) {
      $tocok = $meta['internal']['toc'];
    } else {
      $tocok = true;
    }
    $toc = isset($meta['description']['tableofcontents']) ? $meta['description']['tableofcontents'] : null;
    if(!$tocok || !is_array($toc) || !$conf['tocminheads'] || count($toc) < $conf['tocminheads']) {
      $toc = array();
    }
  } elseif($ACT == 'admin') {

    // try to load admin plugin TOC
    /** @var $plugin DokuWiki_Admin_Plugin */
    if ($plugin = plugin_getRequestAdminPlugin()) {
      $toc = $plugin->getTOC();
      $TOC = $toc; // avoid later rebuild
    }

  }

  trigger_event('TPL_TOC_RENDER', $toc, null, false);

  if ($ACT == 'admin' && $INPUT->str('page') == 'config') {

    $bootstrap3_sections = array(
      'theme', 'sidebar', 'navbar', 'semantic',
      'layout', 'toc', 'discussion', 'cookie_law',
      'google_analytics', 'browser_title', 'page'
    );

    foreach ($bootstrap3_sections as $id) {
      $toc[] = array(
        'link'  => "#bootstrap3__$id",
        'title' => tpl_getLang("config_$id"),
        'type'  => 'ul',
        'level' => 3
      );
    }

  }

  $html = bootstrap3_html_toc($toc);

  if($return) return $html;
  echo $html;
  return '';

}


/**
 * Return the TOC rendered to XHTML with Bootstrap3 style
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param array $toc
 * @return string html
 */
function bootstrap3_html_toc($toc){

  if (! count($toc)) return '';

  global $lang;

  $out  = '';
  $out .= '<!-- TOC START -->'.DOKU_LF;
  $out .= '<nav id="dw__toc" role="navigation" class="panel panel-default small">'.DOKU_LF;
  $out .= '<h6 data-toggle="collapse" data-target="#dw__toc .toc-body" title="'.$lang['toc'].'" class="panel-heading toc-title"><i class="fa fa-fw fa-th-list"></i> ';
  $out .= '<span>'.$lang['toc'].'</span>';
  $out .= ' <i class="caret"></i></h6>'.DOKU_LF;
  $out .= '<div class="panel-body toc-body collapse '.(! bootstrap3_conf('tocCollapsed') ? 'in': '').'">'.DOKU_LF;
  $out .= bootstrap3_lists(html_buildlist($toc, 'nav toc', 'html_list_toc', 'html_li_default', true)).DOKU_LF;
  $out .= '</div>'.DOKU_LF;
  $out .= '</nav>'.DOKU_LF;
  $out .= '<!-- TOC END -->'.DOKU_LF;

  return $out;

}


/**
 * Add Google Analytics
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @return  string
 */
function bootstrap3_google_analytics() {

  global $INFO;
  global $ID;

  if (! bootstrap3_conf('useGoogleAnalytics')) return false;
  if (! $google_analitycs_id = bootstrap3_conf('googleAnalyticsTrackID')) return false;

  if (bootstrap3_conf('googleAnalyticsNoTrackAdmin') && $INFO['isadmin']) return false;
  if (bootstrap3_conf('googleAnalyticsNoTrackUsers') && isset($_SERVER['REMOTE_USER'])) return false;

  if (tpl_getConf('googleAnalyticsNoTrackPages')) {
    if (preg_match_all(bootstrap3_conf('googleAnalyticsNoTrackPages'), $ID)) return false;
  }

  $out  = '<!-- Google Analytics -->'. DOKU_LF;
  $out .= '<script type="text/javascript">'. DOKU_LF;
  $out .= 'window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;'. DOKU_LF;
  $out .= 'ga("create", "'.$google_analitycs_id.'", "auto");'. DOKU_LF;
  $out .= 'ga("send", "pageview");'. DOKU_LF;

  if (bootstrap3_conf('googleAnalyticsAnonymizeIP')) {
    $out .= 'ga("set", "anonymizeIp", true);'.DOKU_LF;
  }

  if (bootstrap3_conf('googleAnalyticsTrackActions')) {
    $out .= 'ga("send", "event", "DokuWiki", JSINFO.bootstrap3.mode);'.DOKU_LF;
  }

  $out .= '</script>'. DOKU_LF;
  $out .= '<script type="text/javascript" async src="//www.google-analytics.com/analytics.js"></script>'. DOKU_LF;
  $out .= '<!-- End Google Analytics -->'. DOKU_LF;

  print $out;

}


/**
 * Print some info about the current page
 *
 * @author  Andreas Gohr <andi@splitbrain.org>
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   bool $ret return content instead of printing it
 * @return  bool|string
 */
function bootstrap3_pageinfo($ret = false) {

  global $conf;
  global $lang;
  global $INFO;
  global $ID;

  // return if we are not allowed to view the page
  if (!auth_quickaclcheck($ID)) {
    return false;
  }

  // prepare date and path
  $fn = $INFO['filepath'];

  if (!$conf['fullpath']) {

    if ($INFO['rev']) {
      $fn = str_replace(fullpath($conf['olddir']).'/', '', $fn);
    } else {
      $fn = str_replace(fullpath($conf['datadir']).'/', '', $fn);
    }

  }

  $date_format = bootstrap3_conf('pageInfoDateFormat');
  $page_info   = bootstrap3_conf('pageInfo');

  $fn   = utf8_decodeFN($fn);
  $date = (($date_format == 'dformat')
    ? dformat($INFO['lastmod'])
    : datetime_h($INFO['lastmod']));

  // print it
  if ($INFO['exists']) {

    $fn_full = $fn;

    if (! in_array('extension', $page_info)) {
      $fn = str_replace(array('.txt.gz', '.txt'), '', $fn);
    }

    $out = '<ul class="list-inline">';

    if (in_array('filename', $page_info)) {
      $out .= sprintf('<li><i class="fa fa-fw fa-file-text-o text-muted"></i> <span title="%s">%s</span></li>', $fn_full, $fn);
    }

    if (in_array('date', $page_info)) {
      $out .= sprintf('<li><i class="fa fa-fw fa-calendar text-muted"></i> %s <span title="%s">%s</span></li>', $lang['lastmod'],  dformat($INFO['lastmod']), $date);
    }

    if (in_array('editor', $page_info)) {

      if (isset($INFO['editor'])) {

        $user = editorinfo($INFO['editor']);

        if (bootstrap3_conf('useGravatar')) {

          global $auth;
          $user_data = $auth->getUserData($INFO['editor']);

          $gravatar_img = ml(get_gravatar($user_data['mail'], 16).'&.jpg', array('cache' => 'recache', 'w' => 16, 'h' => 16));

          $user_img = sprintf('<img src="%s" alt="" width="16" height="16" class="img-rounded" /> ', $gravatar_img);
          $user     = str_replace(array('iw_user', 'interwiki'), '', $user);
          $user     = $user_img . $user;

        }

        $out .= sprintf('<li class="text-muted">%s %s</li>', $lang['by'], $user);

      } else {
        $out .= sprintf('<li>(%s)</li>', $lang['external_edit']);
      }

    }

    if ($INFO['locked'] && in_array('locked', $page_info)) {
      $out .= sprintf('<li><i class="fa fa-fw fa-lock text-muted"></i> %s %s</li>', $lang['lockedby'], editorinfo($INFO['locked']));
    }

    $out .= '</ul>';

    if ($ret) {
      return $out;
    } else {
      echo $out;
      return true;
    }

  }

  return false;

}


/**
 * Return (and set via cookie) the current Bootswatch theme
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @return  string
 */
function bootstrap3_bootswatch_theme() {

  global $INPUT;

  $bootswatch_theme = bootstrap3_conf('bootswatchTheme');

  if (bootstrap3_conf('showThemeSwitcher')) {

    if (get_doku_pref('bootswatchTheme', null) !== null && get_doku_pref('bootswatchTheme', null) !== '') {
      $bootswatch_theme = get_doku_pref('bootswatchTheme', null);
    }

    if ($INPUT->str('bootswatch-theme')) {
      $bootswatch_theme = $INPUT->str('bootswatch-theme');
    }

  }

  return $bootswatch_theme;

}


/**
 * Load the template assets (Bootstrap, AnchorJS, etc)
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param  Doku_Event $event
 * @param  array $param
 */
function bootstrap3_metaheaders(Doku_Event &$event, $param) {

  global $INPUT;
  global $ACT;

  // Bootstrap Theme
  $bootstrap_styles = array();
  $bootstrap_theme  = bootstrap3_conf('bootstrapTheme');
  $fixed_top_navbar = bootstrap3_conf('fixedTopNavbar');

  switch ($bootstrap_theme) {

    case 'optional':
      $bootstrap_styles[] = tpl_basedir() . 'assets/bootstrap/default/bootstrap.min.css';
      $bootstrap_styles[] = tpl_basedir() . 'assets/bootstrap/default/bootstrap-theme.min.css';
      break;

    case 'custom':
      $bootstrap_styles[] = bootstrap3_conf('customTheme');
      break;

    case 'bootswatch':

      $bootswatch_theme = bootstrap3_bootswatch_theme();
      $bootswatch_url   = (bootstrap3_conf('useLocalBootswatch'))
        ? tpl_basedir() . 'assets/bootstrap'
        : '//maxcdn.bootstrapcdn.com/bootswatch/3.3.6';

      if (file_exists(tpl_incdir() . "assets/fonts/$bootswatch_theme.fonts.css")) {
        $bootstrap_styles[] = tpl_basedir() . "assets/fonts/$bootswatch_theme.fonts.css";
      }

      $bootstrap_styles[] = "$bootswatch_url/$bootswatch_theme/bootstrap.min.css";
      break;

    case 'default':
    default:
      $bootstrap_styles[] = tpl_basedir() . 'assets/bootstrap/default/bootstrap.min.css';
      break;

  }

  foreach ($bootstrap_styles as $style) {
    array_unshift($event->data['link'], array(
      'type' => 'text/css',
      'rel'  => 'stylesheet',
      'href' => $style));
  }

  $event->data['link'][] = array(
    'type' => 'text/css',
    'rel'  => 'stylesheet',
    'href' => tpl_basedir() . 'assets/font-awesome/css/font-awesome.min.css');

  $event->data['script'][] = array(
    'type' => 'text/javascript',
    'src'  => tpl_basedir() . 'assets/bootstrap/js/bootstrap.min.js');

  $event->data['script'][] = array(
    'type' => 'text/javascript',
    'src'  => tpl_basedir() . 'assets/anchorjs/anchor.min.js');


  // Apply some FIX
  if ($ACT || defined('DOKU_MEDIADETAIL')) {

    // Default Padding
    $navbar_padding = 20;

    if ($fixed_top_navbar) {

      if ($bootstrap_theme == 'bootswatch') {

        // Set the navbar height for all Bootswatch Themes (values from @navbar-height in bootswatch/*/variables.less)
        switch (bootstrap3_bootswatch_theme()) {
          case 'simplex':
          case 'superhero':
            $navbar_height = 40;
            break;
          case 'yeti':
            $navbar_height = 45;
            break;
          case 'cerulean':
          case 'cosmo':
          case 'custom':
          case 'cyborg':
          case 'lumen':
          case 'slate':
          case 'spacelab':
          case 'united':
            $navbar_height = 50;
            break;
          case 'darkly':
          case 'flatly':
          case 'journal':
          case 'sandstone':
            $navbar_height = 60;
            break;
          case 'paper':
            $navbar_height = 64;
            break;
          case 'readable':
            $navbar_height = 65;
            break;
          default:
            $navbar_height = 50;
        }

      } else {
        $navbar_height = 50;
      }

      $navbar_padding += $navbar_height;

    }

    $style  = '';
    $style .= '@media screen {';
    $style .= " body { padding-top: {$navbar_padding}px; }" ;
    $style .= ' #dw__toc.affix { top: '.($navbar_padding -10).'px; position: fixed !important; }';

    if (bootstrap3_conf('tocCollapseSubSections')) {
      $style .= ' #dw__toc .nav .nav .nav { display: none; }';
    }

    $style .= '}';

    $event->data['style'][] = array(
      'type'  => 'text/css',
      '_data' => $style
    );

    $js  = '';
    $js .= "jQuery('body').scrollspy({ target: '#dw__toc', offset: ". ($navbar_padding + 10) ." });";

    if (bootstrap3_conf('tocAffix')) {
      $js .= 'jQuery("#dw__toc").affix({ offset: { top: (jQuery("main").position().top), bottom: (jQuery(document).height() - jQuery("main").height()) } });';
    }

    if ($fixed_top_navbar) {
      $js .= "if (location.hash) { setTimeout(function() { scrollBy(0, -$navbar_padding); }, 1); }";
    }

    if (bootstrap3_conf('useAnchorJS')) {
      $js .= "jQuery(document).trigger('bootstrap3:anchorjs');";
    }

    $event->data['script'][] = array(
      'type'  => 'text/javascript',
      '_data' => "jQuery(document).ready(function() { $js });"
    );

  }

}

/**
 * Add Bootstrap classes in DokuWiki Content
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string  $content from tpl_content()
 * @return  string
 * */
function bootstrap3_content($content) {

  global $ACT;
  global $INPUT;

  // Search Hit
  $content = str_replace('<span class="search_hit">', '<span class="mark">', $content);

  // Tabs (Extension Manager)
  $content = str_replace('<ul class="tabs">', '<ul class="nav nav-tabs">', $content);

  // Page Heading (<h[1-2]>)
  $content = preg_replace('/<h([1-2]) id="(.*)">/',              '<h$1 class="page-header" id="$2">',    $content);
  $content = preg_replace('/<h([1-2]) class="(.*)" id="(.*)">/', '<h$1 class="$2 page-header" id="$3">', $content);
  $content = preg_replace('/<h([1-2])>/',                        '<h$1 class="page-header">',            $content);

  // Media Images
  $content = preg_replace('/<img (.*) class="(media|medialeft|mediacenter|mediaright)"/', '<img $1 class="$2 img-responsive"', $content);

  // Alerts
  $content = str_replace('<div class="info">',    '<div class="alert alert-info"><i class="fa fa-fw fa-info-circle"></i>',     $content);
  $content = str_replace('<div class="error">',   '<div class="alert alert-danger"><i class="fa fa-fw fa-times-circle"></i>',  $content);
  $content = str_replace('<div class="success">', '<div class="alert alert-success"><i class="fa fa-fw fa-check-circle"></i>', $content);
  $content = str_replace(array('<div class="notify">', '<div class="msg notify">'), '<div class="alert alert-warning"><i class="fa fa-fw fa-warning"></i>',      $content);


  // Configuration Manager Template Sections
  if ($ACT == 'admin' && $INPUT->str('page') == 'config') {

    $admin_sections = array(
    // Section                      Insert Before           Icon
      'theme'             => array( 'bootstrapTheme',       'fa-tint'      ),
      'sidebar'           => array( 'sidebarPosition',      'fa-columns'   ),
      'navbar'            => array( 'inverseNavbar',        'fa-navicon'   ),
      'semantic'          => array( 'semantic',             'fa-share-alt' ),
      'layout'            => array( 'fluidContainer',       'fa-desktop'   ),
      'toc'               => array( 'tocAffix',             'fa-list'      ),
      'discussion'        => array( 'showDiscussion',       'fa-comments'  ),
      'cookie_law'        => array( 'showCookieLawBanner',  'fa-legal'     ),
      'google_analytics'  => array( 'useGoogleAnalytics',   'fa-google'    ),
      'browser_title'     => array( 'browserTitle',         'fa-header'    ),
      'page'              => array( 'showPageInfo',         'fa-file'      )
    );

    foreach ($admin_sections as $section => $items) {

      $search = $items[0];
      $icon   = $items[1];

      $content = preg_replace('/<tr(.*)>\s+<td(.*)>\s+<span(.*)>(tpl»bootstrap3»'.$search.')<\/span>/',
                              '</table></div></fieldset><fieldset id="bootstrap3__'.$section.'"><legend><i class="fa '.$icon.'"></i> '.tpl_getLang("config_$section").'</legend><div class="table"><table class="inline"><tr$1><td$2><span$3>$4</span>', $content);

    }

  }


  // Revisions & Recents
  if ($ACT == 'revisions' || $ACT == 'recent') {
    $search  = array('class="sizechange positive"', 'class="sizechange negative"', 'class="sizechange"', 'class="minor"');
    $replace = array('class="sizechange positive label label-success"', 'class="sizechange negative label label-danger"', 'class="sizechange label label-default"', 'class="minor text-muted"');
    $content = str_replace($search, $replace, $content);
  }


  // Difference
  if ($ACT == 'diff') {

    $btn_default = 'btn btn-default fa';

    $search  = array('class="diff-deletedline"', 'class="diff-addedline',
                     'class="diffprevrev', 'class="diffnextrev', 'class="diffbothprevrev', 'class="minor"');

    $replace = array('class="diff-deletedline bg-danger text-danger"', 'class="diff-addedline bg-success text-success"',
                     "class=\"diffprevrev $btn_default fa-angle-left\"", "class=\"diffnextrev $btn_default fa-angle-right\"", "class=\"diffbothprevrev $btn_default fa-angle-double-left\"", 'class="minor text-muted"');

    $content = str_replace($search, $replace, $content);

  }

  // Tables
  $table_classes = 'table';

  foreach (bootstrap3_conf('tableStyle') as $class) {
    if ($class == 'responsive') {
      $content = str_replace('<div class="table', '<div class="table table-responsive', $content);
    } else {
      $table_classes .= " table-$class";
    }
  }

  $content = preg_replace('/<table(.*)class="(inline|import_failures)"(.*)>/',
                          sprintf('<table$1class="$2 %s"$3>', $table_classes), $content);

  $content = str_replace('<div class="table ', '<div class="', $content);

  return $content;

}


function bootstrap3_theme_by_namespace() {

  global $ID;

  $themes_filename = DOKU_CONF.'bootstrap3.themes.conf';

  if (! bootstrap3_conf('themeByNamespace')) return array();
  if (! file_exists($themes_filename))       return array();

  $config = confToHash($themes_filename);
  krsort($config);

  foreach ($config as $page => $theme) {

    if (preg_match("/^$page/", "$ID")) {

      list($bootstrap, $bootswatch) = split('/', $theme);

      if ($bootstrap && in_array($bootstrap, array('default', 'optional', 'custom'))) {
        return array($bootstrap, $bootswatch);
      }

      if ($bootstrap == 'bootswatch' && in_array($bootswatch, bootstrap3_bootswatch_theme_list())) {
        return array($bootstrap, $bootswatch);
      }

    }

  }

  return array();

}

/**
 * Return template classes
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @see tpl_classes();
 *
 * @return string
 **/
function bootstrap3_classes() {

  $page_on_panel    = bootstrap3_conf('pageOnPanel');
  $bootstrap_theme  = bootstrap3_conf('bootstrapTheme');
  $bootswatch_theme = bootstrap3_bootswatch_theme();

  $classes   = array();
  $classes[] = (($bootstrap_theme == 'bootswatch')  ? $bootswatch_theme  : $bootstrap_theme);
  $classes[] = trim(tpl_classes());

  if ($page_on_panel)                       $classes[] = 'dw-page-on-panel';
  if (! bootstrap3_conf('tableFullWidth'))  $classes[] = 'dw-table-width';

  return implode(' ', $classes);

}
