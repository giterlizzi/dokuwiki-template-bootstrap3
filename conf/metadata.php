<?php
/*
 * configuration metadata
 * 
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$meta['showTools']           = array('multichoice', '_choices' => array('never', 'logged', 'always'));
$meta['showSearchForm']      = array('multichoice', '_choices' => array('never', 'logged', 'always'));
$meta['individualTools']     = array('onoff');
$meta['showIndividualTool']  = array('multicheckbox', '_choices' => array('user', 'site', 'page'));
$meta['showUserHomeLink']    = array('onoff');
$meta['showLoginOnFooter']   = array('onoff');
$meta['hideLoginLink']       = array('onoff');
$meta['sidebarPosition']     = array('multichoice', '_choices' => array('left', 'right'));
$meta['rightSidebar']        = array('string');
$meta['leftSidebarGrid']     = array('string');
$meta['rightSidebarGrid']    = array('string');
$meta['browserTitle']        = array('string');
$meta['showCookieLawBanner'] = array('onoff');
$meta['cookieLawBannerPage'] = array('string');
$meta['cookieLawPolicyPage'] = array('string');
$meta['showTranslation']     = array('onoff');
$meta['showAdminMenu']       = array('onoff');
$meta['inverseNavbar']       = array('onoff');
$meta['fixedTopNavbar']      = array('onoff');
$meta['fluidContainer']      = array('onoff');
$meta['fluidContainerBtn']   = array('onoff');
$meta['pageOnPanel']         = array('onoff');
$meta['tableFullWidth']      = array('onoff');
$meta['semantic']            = array('onoff');
$meta['schemaOrgType']       = array('multichoice', '_choices' => array('Article', 'NewsArticle', 'TechArticle', 'BlogPosting'));
$meta['bootstrapTheme']      = array('multichoice', '_choices' => array('default', 'optional', 'custom', 'bootswatch'));
$meta['customTheme']         = array('string');
$meta['bootswatchTheme']     = array('multichoice', '_choices' => array('cerulean','cosmo','cyborg','darkly','flatly','journal','lumen','paper','readable','sandstone','simplex','slate','spacelab','superhero','united','yeti'));
$meta['hideInThemeSwitcher'] = array('multicheckbox', '_choices' => array('cerulean','cosmo','cyborg','darkly','flatly','journal','lumen','paper','readable','sandstone','simplex','slate','spacelab','superhero','united','yeti'));
$meta['showThemeSwitcher']   = array('onoff');
$meta['showPageInfo']        = array('onoff');
$meta['showBadges']          = array('onoff');
$meta['showDiscussion']      = array('onoff');
$meta['discussionPage']      = array('string');
