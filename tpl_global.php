<?php
/**
 * DokuWiki Bootstrap3 Template: Global Configurations
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$showTools         = tpl_getConf('showTools') != 'never' &&
                     ( tpl_getConf('showTools') == 'always' || !empty($_SERVER['REMOTE_USER']) );
$showSidebar       = page_findnearest($conf['sidebar']) && ($ACT=='show');
$sidebarPosition   = tpl_getConf('sidebarPosition');
$showRightSidebar  = page_findnearest(tpl_getConf('rightSidebar')) && ($ACT=='show');
$rightSidebar      = tpl_getConf('rightSidebar');
$showThemeSwitcher = tpl_getConf('showThemeSwitcher');
$fixedTopNavbar    = tpl_getConf('fixedTopNavbar');
$inverseNavbar     = tpl_getConf('inverseNavbar');
$bootstrapTheme    = tpl_getConf('bootstrapTheme');
$customTheme       = tpl_getConf('customTheme');
$bootswatchTheme   = tpl_getConf('bootswatchTheme');
$pageOnPanel       = tpl_getConf('pageOnPanel');
$bootstrapStyles   = array();
$fluidContainer    = tpl_getConf('fluidContainer');
$contentClass      = (($showSidebar) ? 'col-sm-9 col-md-10' : 'container' . (($fluidContainer) ? '-fluid' : ''));
$showPageInfo      = tpl_getConf('showPageInfo');
$showBadges        = tpl_getConf('showBadges');
$semantic          = tpl_getConf('semantic');
$schemaOrgType     = tpl_getConf('schemaOrgType');
$tplConfigJSON     = array(
  'tableFullWidth' => tpl_getConf('tableFullWidth'),
);

if ($showSidebar && $showRightSidebar) {
  $contentClass = 'col-sm-6 col-md-8';
}

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
    $bootstrapStyles[] = "https://bootswatch.com/$bootswatchTheme/bootstrap.css";
    break;
  case 'default':
  default:
    $bootstrapStyles[] = DOKU_TPL.'assets/bootstrap/css/bootstrap.min.css';
    break;

}
