<?php
/**
 * DokuWiki Bootstrap3 Template: Global Configurations
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$showTools           = tpl_getConf('showTools') != 'never' &&
                       ( tpl_getConf('showTools') == 'always' || !empty($_SERVER['REMOTE_USER']) );
$individualTools     = tpl_getConf('individualTools');
$editOnNavbar        = tpl_getConf('editOnNavbar');
$showUserHomeLink    = tpl_getConf('showUserHomeLink');
$showLoginOnFooter   = tpl_getConf('showLoginOnFooter');
$showLoginLink       = ! tpl_getConf('hideLoginLink') || ! empty($_SERVER['REMOTE_USER']);
$showSidebar         = page_findnearest($conf['sidebar']) && ($ACT=='show');
$sidebarPosition     = tpl_getConf('sidebarPosition');
$showRightSidebar    = page_findnearest(tpl_getConf('rightSidebar')) && ($ACT=='show');
$rightSidebar        = tpl_getConf('rightSidebar');
$showCookieLawBanner = tpl_getConf('showCookieLawBanner');
$cookieLawBannerPage = tpl_getConf('cookieLawBannerPage');
$cookieLawPolicyPage = tpl_getConf('cookieLawPolicyPage');
$browserTitle        = str_replace(array('@WIKI@', '@TITLE@'),
                                   array(strip_tags($conf['title']), tpl_pagetitle(null, true)),
                                   tpl_getConf('browserTitle'));
$showThemeSwitcher   = tpl_getConf('showThemeSwitcher');
$fixedTopNavbar      = tpl_getConf('fixedTopNavbar');
$inverseNavbar       = tpl_getConf('inverseNavbar');
$bootstrapTheme      = tpl_getConf('bootstrapTheme');
$customTheme         = tpl_getConf('customTheme');
$bootswatchTheme     = tpl_getConf('bootswatchTheme');
$pageOnPanel         = tpl_getConf('pageOnPanel');
$fluidContainer      = tpl_getConf('fluidContainer');
$showPageInfo        = tpl_getConf('showPageInfo');
$showBadges          = tpl_getConf('showBadges');
$semantic            = tpl_getConf('semantic');
$schemaOrgType       = tpl_getConf('schemaOrgType');
$leftSidebarGrid     = tpl_getConf('leftSidebarGrid');
$rightSidebarGrid    = tpl_getConf('rightSidebarGrid');
$contentGrid         = _tpl_get_container_grid();
$hideInThemeSwitcher = explode(',', tpl_getConf('hideInThemeSwitcher'));
$bootstrapStyles     = array();
$tplConfigJSON       = array(
  'tableFullWidth' => (int) tpl_getConf('tableFullWidth'),
);


// Tools Menu
$tools = array(

  'user' => array(
    'icon'  => 'glyphicon glyphicon-user',
    'items' => array(
      'admin'    => _tpl_action_item('admin',    'glyphicon glyphicon-cog'),
      'profile'  => _tpl_action_item('profile',  'glyphicon glyphicon-refresh'),
      #'register' => _tpl_action_item('register', 'glyphicon glyphicon-edit'),
      #'login'    => _tpl_action_item('login',    'glyphicon glyphicon-log-'.(!empty($_SERVER['REMOTE_USER']) ? 'out' : 'in')),
    )
  ),

  'site' => array(
    'icon'  => 'glyphicon glyphicon-cog',
    'items' => array(
      'recent' => _tpl_action_item('recent', 'glyphicon glyphicon-list-alt'),
      'media'  => _tpl_action_item('media',  'glyphicon glyphicon-picture'),
      'index'  => _tpl_action_item('index',  'glyphicon glyphicon-list'),
    )
  ),

  'page' => array(
    'icon'  => 'glyphicon glyphicon-file',
    'items' => array(
      'edit'       => _tpl_action_item('edit',       'glyphicon glyphicon-edit'),
      'discussion' => _tpl_action_item('discussion', 'glyphicon glyphicon-comment'),
      'revert'     => _tpl_action_item('revert',     'glyphicon glyphicon-repeat'),
      'revisions'  => _tpl_action_item('revisions',  'glyphicon glyphicon-time'),
      'backlink'   => _tpl_action_item('backlink',   'glyphicon glyphicon-link'),
      'subscribe'  => _tpl_action_item('subscribe',  'glyphicon glyphicon-bookmark'),
      'top'        => _tpl_action_item('top',        'glyphicon glyphicon-chevron-up'),
    )
  ),

);


if ($showThemeSwitcher && $bootstrapTheme == 'bootswatch') {

  if (get_doku_pref('bootswatchTheme', null) !== null && get_doku_pref('bootswatchTheme', null) !== '') {
    $bootswatchTheme = get_doku_pref('bootswatchTheme', null);
  }

  global $INPUT;

  if ($INPUT->str('bootswatchTheme')) {
    $bootswatchTheme = $INPUT->str('bootswatchTheme');
    set_doku_pref('bootswatchTheme', $bootswatchTheme);
  }

}

switch ($bootstrapTheme) {

  case 'optional':
    $bootstrapStyles[] = DOKU_TPL.'assets/bootstrap/css/bootstrap.min.css';
    $bootstrapStyles[] = DOKU_TPL.'assets/bootstrap/css/bootstrap-theme.min.css';
    break;
  case 'custom':
    $bootstrapStyles[] = $customTheme;
    break;
  case 'bootswatch':
    //$bootstrapStyles[] = "//bootswatch.com/$bootswatchTheme/bootstrap.min.css";
    $bootstrapStyles[] = "//maxcdn.bootstrapcdn.com/bootswatch/3.3.5/$bootswatchTheme/bootstrap.min.css";
    break;
  case 'default':
  default:
    $bootstrapStyles[] = DOKU_TPL.'assets/bootstrap/css/bootstrap.min.css';
    break;

}
