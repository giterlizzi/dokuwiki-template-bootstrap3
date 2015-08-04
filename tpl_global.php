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
$showSearchForm      = tpl_getConf('showSearchForm') != 'never' &&
                       ( tpl_getConf('showSearchForm') == 'always' || !empty($_SERVER['REMOTE_USER']) );
$individualTools     = tpl_getConf('individualTools');
$showIndividualTool  = tpl_getConf('showIndividualTool');
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
    $bootstrapStyles[] = "//maxcdn.bootstrapcdn.com/bootswatch/3.3.5/$bootswatchTheme/bootstrap.min.css";
    break;
  case 'default':
  default:
    $bootstrapStyles[] = DOKU_TPL.'assets/bootstrap/css/bootstrap.min.css';
    break;

}
