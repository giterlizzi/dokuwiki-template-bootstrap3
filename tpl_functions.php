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

    if ($linkonly) {
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


/**
 * Manipulate DokuWiki TOC to add Bootstrap3 styling
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string   $toc from tpl_toc()
 * @return  string
 */
function bootstrap3_toc($toc) {

  if (! $toc) return false;

  $dom = new DOMDocument('1.0');
  $dom->loadHTML('<?xml version="1.0" encoding="UTF-8"?>' . $toc);

  if ($panel = $dom->getElementsByTagName('div')->item(0)) {

    $panel->setAttribute('class', 'panel panel-default'); 

    $panel_title = $dom->getElementsByTagName('h3')->item(0);
    $panel_title->setAttribute('class', $panel_title->getAttribute('class') . ' panel-heading');

    $panel_body = $dom->getElementsByTagName('div')->item(1);
    $panel_body->setAttribute('class', 'panel-body');

    foreach ($dom->getElementsByTagName('ul') as $ul) {

      $ul->setAttribute('class', $ul->getAttribute('class') . ' nav nav-pills nav-stacked');

      foreach ($ul->getElementsByTagName('li') as $li) {

        if ($div = $li->getElementsByTagName('div')->item(0)) {
          if ($a = $li->getElementsByTagName('a')->item(0)) {
            $div->parentNode->replaceChild($a, $div);
          }
        }

      }

    }

  }

  $html = '';

  if (version_compare(PHP_VERSION, '5.3.6', '>=')) {
    $html = $dom->saveHTML($dom->getElementsByTagName('body')->item(0));
  } else {
    $html = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());
    $html = preg_replace('~<\?xml(.*)\?>~', '', $html);
  }

  echo $html;
  return $html;

}


/**
 * Manipulate Sidebar page to add Bootstrap3 styling
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param   string   $sidebar
 * @return  string
 */
function bootstrap3_sidebar($sidebar) {

  if (! $sidebar) return false;

  $dom = new DOMDocument('1.0');
  $dom->loadHTML('<?xml version="1.0" encoding="UTF-8"?>' . $sidebar);

  foreach ($dom->getElementsByTagName('ul') as $ul) {

    foreach ($ul->getElementsByTagName('li') as $li) {

      $ul->setAttribute('class', 'nav nav-pills nav-stacked');

      if ($curid = $li->getElementsByTagNAme('span')->item(0)) {
        $li->setAttribute('class', $li->getAttribute('class') . ' active');
      }

      if ($div = $li->getElementsByTagName('div')->item(0)) {
        if ($a = $li->getElementsByTagName('a')->item(0)) {
          $div->parentNode->replaceChild($a, $div);
        }
      }

    }

  }

  $html = '';

  if (version_compare(PHP_VERSION, '5.3.6', '>=')) {
    $html = $dom->saveHTML($dom->getElementsByTagName('body')->item(0));
  } else {
    $html = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());
    $html = preg_replace('~<\?xml(.*)\?>~', '', $html);
  }

  echo $html;
  return $html;

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

    print ' <button type="submit" class="btn btn-default" title="'.$lang['btn_search'].'"><i class="glyphicon glyphicon-search"></i><span class="hidden-lg hidden-md hidden-sm"> '.$lang['btn_search'].'</span></button>';

    if ($ajax) print '<div id="qsearch__out" class="panel panel-default ajax_qsearch JSpopup"></div>';
    print '</div></form>';
    
    return true;
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

  return array(
  
    'user' => array(
      'icon'  => 'glyphicon glyphicon-user',
      'items' => array(
        'admin'    => array('icon' => 'glyphicon glyphicon-cog'),
        'profile'  => array('icon' => 'glyphicon glyphicon-refresh'),
        #'register' => array('icon' => 'glyphicon glyphicon-edit'),
        #'login'    => array('icon' => 'glyphicon glyphicon-log-'.(!empty($_SERVER['REMOTE_USER']) ? 'out' : 'in')),
      )
    ),
  
    'site' => array(
      'icon'  => 'glyphicon glyphicon-cog',
      'items' => array(
        'recent' => array('icon' => 'glyphicon glyphicon-list-alt'),
        'media'  => array('icon' => 'glyphicon glyphicon-picture'),
        'index'  => array('icon' => 'glyphicon glyphicon-list'),
      )
    ),
  
    'page' => array(
      'icon'  => 'glyphicon glyphicon-file',
      'items' => array(
        'edit'       => array('icon' => 'glyphicon glyphicon-' . (($ACT == 'edit') ? 'file' : 'edit')),
        'discussion' => array('icon' => 'glyphicon glyphicon-comment'),
        'revert'     => array('icon' => 'glyphicon glyphicon-repeat'),
        'revisions'  => array('icon' => 'glyphicon glyphicon-time'),
        'backlink'   => array('icon' => 'glyphicon glyphicon-link'),
        'subscribe'  => array('icon' => 'glyphicon glyphicon-envelope'),
        'top'        => array('icon' => 'glyphicon glyphicon-chevron-up'),
      )
    ),
  
  );

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

