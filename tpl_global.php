<?php
/**
 * DokuWiki Bootstrap3 Template: Global Configurations
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */
<<<<<<< HEAD
 
$showTools           = tpl_getConf('showTools') != 'never' &&
                       ( tpl_getConf('showTools') == 'always' || !empty($_SERVER['REMOTE_USER']) );
$showSearchForm      = tpl_getConf('showSearchForm') != 'never' &&
                       ( tpl_getConf('showSearchForm') == 'always' || !empty($_SERVER['REMOTE_USER']) );
$individualTools     = tpl_getConf('individualTools');
$editOnNavbar        = tpl_getConf('editOnNavbar');
$showIndividualTool  = tpl_getConf('showIndividualTool');
$showAdminMenu       = tpl_getConf('showAdminMenu') && $INFO['isadmin'];
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
$fluidContainerBtn   = tpl_getConf('fluidContainerBtn');
$showPageInfo        = tpl_getConf('showPageInfo');
$showBadges          = tpl_getConf('showBadges');
$semantic            = tpl_getConf('semantic');
$schemaOrgType       = tpl_getConf('schemaOrgType');
$leftSidebarGrid     = tpl_getConf('leftSidebarGrid');
$rightSidebarGrid    = tpl_getConf('rightSidebarGrid');
$useGravatar         = tpl_getConf('useGravatar');
$contentGrid         = _tpl_get_container_grid();
$hideInThemeSwitcher = explode(',', tpl_getConf('hideInThemeSwitcher'));
$bootstrapStyles     = array();
$tplConfigJSON       = array(
  'tableFullWidth' => (int) tpl_getConf('tableFullWidth'),
);
=======
>>>>>>> 6983e7ba0beb49ff6d8c5cbeae903f84dbb11204

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

global $ID;
global $JSINFO;
global $INPUT;
global $ACT;
global $EVENT_HANDLER;

// Get the template info (useful for debug)
if ($INFO['isadmin'] && $INPUT->str('do') && $INPUT->str('do') == 'check') {
  $template_info = confToHash(dirname(__FILE__).'/template.info.txt');
  msg('bootstrap3 template version: v' . $template_info['date'], 1, '', '', MSG_ADMINS_ONLY);
}

$EVENT_HANDLER->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', null, 'bootstrap3_metaheaders');

$page_on_panel      = bootstrap3_conf('pageOnPanel');
$bootstrap_theme    = bootstrap3_conf('bootstrapTheme');
$bootswatch_theme   = bootstrap3_bootswatch_theme();
$bootstrap3_configs = array(
  'theme', 'sidebar', 'navbar', 'semantic',
  'layout', 'toc', 'discussion', 'cookie_law',
  'google_analytics', 'browser_title', 'page'
);

$JSINFO['bootstrap3'] = array(
  'mode'   => $ACT,
  'config' => array(
    'tagsOnTop'           => (int) bootstrap3_conf('tagsOnTop'),
    'collapsibleSections' => (int) bootstrap3_conf('collapsibleSections'),
    'tocCollapseOnScroll' => (int) bootstrap3_conf('tocCollapseOnScroll'),
    'tocAffix'            => (int) bootstrap3_conf('tocAffix'),
  ),
);

if ($ACT == 'admin') {

  $JSINFO['bootstrap3']['admin'] = $INPUT->str('page');

  foreach ($bootstrap3_configs as $id) {
    $JSINFO['bootstrap3']['lang']['config'][$id] = tpl_getLang("config_$id");
  }

}

$body_classes   = array();
$body_classes[] = (($bootstrap_theme == 'bootswatch')  ? $bootswatch_theme  : $bootstrap_theme);
$body_classes[] = tpl_classes();

if ($page_on_panel)                       $body_classes[] = 'dw-page-on-panel';
if (! bootstrap3_conf('tableFullWidth'))  $body_classes[] = 'dw-table-width';
