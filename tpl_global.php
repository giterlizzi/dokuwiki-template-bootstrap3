<?php
/**
 * DokuWiki Bootstrap3 Template: Global Configurations
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

global $ID;

$showTools           = bootstrap3_conf('showTools');
$showSearchForm      = bootstrap3_conf('showSearchForm');
$showPageTools       = bootstrap3_conf('showPageTools');
$showUserHomeLink    = bootstrap3_conf('showUserHomeLink');
$showLoginOnFooter   = bootstrap3_conf('showLoginOnFooter');
$showLoginLink       = bootstrap3_conf('hideLoginLink');
$showSidebar         = bootstrap3_conf('showSidebar');
$sidebarPosition     = bootstrap3_conf('sidebarPosition');
$showRightSidebar    = bootstrap3_conf('showRightSidebar');
$rightSidebar        = bootstrap3_conf('rightSidebar');
$browserTitle        = bootstrap3_conf('browserTitle');
$showThemeSwitcher   = bootstrap3_conf('showThemeSwitcher');
$fixedTopNavbar      = bootstrap3_conf('fixedTopNavbar');
$inverseNavbar       = bootstrap3_conf('inverseNavbar');
$bootstrapTheme      = bootstrap3_conf('bootstrapTheme');
$customTheme         = bootstrap3_conf('customTheme');
$bootswatchTheme     = bootstrap3_conf('bootswatchTheme');
$pageOnPanel         = bootstrap3_conf('pageOnPanel');
$fluidContainer      = bootstrap3_conf('fluidContainer');
$fluidContainerBtn   = bootstrap3_conf('fluidContainerBtn');
$showPageInfo        = bootstrap3_conf('showPageInfo');
$showBadges          = bootstrap3_conf('showBadges');
$semantic            = bootstrap3_conf('semantic');
$schemaOrgType       = bootstrap3_conf('schemaOrgType');
$leftSidebarGrid     = bootstrap3_conf('leftSidebarGrid');
$rightSidebarGrid    = bootstrap3_conf('rightSidebarGrid');
$showLandingPage     = bootstrap3_conf('showLandingPage');
$hideInThemeSwitcher = bootstrap3_conf('hideInThemeSwitcher');
$useLocalBootswatch  = bootstrap3_conf('useLocalBootswatch');
$contentGrid         = bootstrap3_container_grid();
$bootstrapStyles     = array();
$tplConfigJSON       = array(
  'tableFullWidth' => (int) bootstrap3_conf('tableFullWidth'),
  'tableStyle'     => bootstrap3_conf('tableStyle'),
  'tagsOnTop'      => (int) bootstrap3_conf('tagsOnTop'),
);

if($fluidContainerBtn) {
  $fluidContainer = bootstrap3_fluid_container_button();
}

// Display a landing page (set the pageOnPanel and showSidebar config to "off")
if ($showLandingPage && (bool) preg_match_all(bootstrap3_conf('landingPages'), $ID)) {
  $showSidebar = false;
  $pageOnPanel = false;
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
    $url = ($useLocalBootswatch) ? DOKU_TPL.'assets/bootswatch' : '//maxcdn.bootstrapcdn.com/bootswatch/3.3.5';
    $bootstrapStyles[] = "$url/$bootswatchTheme/bootstrap.min.css";
    break;
  case 'default':
  default:
    $bootstrapStyles[] = DOKU_TPL.'assets/bootstrap/css/bootstrap.min.css';
    break;

}
