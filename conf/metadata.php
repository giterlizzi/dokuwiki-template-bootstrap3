<?php
/*
 * configuration metadata
 *
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */


// Theme
$meta['bootstrapTheme']      = array('multichoice', '_choices' => array('default', 'optional', 'custom', 'bootswatch'));
$meta['bootswatchTheme']     = array('multichoice', '_choices' => array('cerulean', 'cosmo', 'cyborg', 'darkly', 'flatly', 'journal', 'lumen', 'paper', 'readable', 'sandstone', 'simplex', 'solar', 'slate', 'spacelab', 'superhero', 'united', 'yeti'));
$meta['customTheme']         = array('string');
$meta['showThemeSwitcher']   = array('onoff');
$meta['hideInThemeSwitcher'] = array('multicheckbox', '_choices' => $meta['bootswatchTheme']['_choices']);
$meta['themeByNamespace']    = array('onoff');

// Sidebar
$meta['sidebarPosition']      = array('multichoice', '_choices' => array('left', 'right'));
$meta['rightSidebar']         = array('string');
$meta['leftSidebarGrid']      = array('string');
$meta['rightSidebarGrid']     = array('string');
$meta['sidebarOnNavbar']      = array('onoff');
$meta['sidebarShowPageTitle'] = array('onoff');

// Navbar
$meta['inverseNavbar']          = array('onoff');
$meta['fixedTopNavbar']         = array('onoff');
$meta['showTranslation']        = array('onoff');
$meta['showTools']              = array('multichoice', '_choices' => array('never', 'logged', 'always'));
$meta['showHomePageLink']       = array('onoff');
$meta['homePageURL']            = array('string', '_caution' => 'warning');
$meta['showUserHomeLink']       = array('onoff');
$meta['hideLoginLink']          = array('onoff');
$meta['showEditBtn']            = array('multichoice', '_choices' => array('never', 'logged', 'always'));
$meta['individualTools']        = array('onoff');
$meta['showIndividualTool']     = array('multicheckbox', '_choices' => array('user', 'site', 'page'));
$meta['showSearchForm']         = array('multichoice', '_choices' => array('never', 'logged', 'always'));
$meta['showAdminMenu']          = array('onoff');
$meta['showNavbar']             = array('multichoice', '_choices' => array('logged', 'always'));
$meta['navbarLabels']           = array('multicheckbox', '_choices' => array('login', 'register', 'admin', 'tools', 'user', 'site', 'page', 'themes', 'expand', 'profile'));
$meta['showAddNewPage']         = array('multichoice', '_choices' => array('never', 'logged', 'always'));
$meta['notifyExtensionsUpdate'] = array('onoff');
$meta['disableSearchSuggest']   = array('onoff');

// Semantic
$meta['schemaOrgType']       = array('multichoice', '_choices' => array('Article', 'NewsArticle', 'TechArticle', 'BlogPosting', 'Recipe'));
$meta['showSemanticPopup']   = array('onoff');

// Layout
$meta['fluidContainer']         = array('onoff');
$meta['pageOnPanel']            = array('onoff');
$meta['tableFullWidth']         = array('onoff');
$meta['tableStyle']             = array('multicheckbox', '_choices' => array('striped', 'bordered', 'hover', 'condensed', 'responsive'));
$meta['showLandingPage']        = array('onoff');
$meta['landingPages']           = array('regex');
$meta['showPageTools']          = array('multichoice', '_choices' => array('never', 'logged', 'always'));
$meta['showPageId']             = array('onoff');
$meta['showBadges']             = array('onoff');
$meta['showLoginOnFooter']      = array('onoff');
$meta['showWikiInfo']           = array('onoff');

// TOC
$meta['tocAffix']               = array('onoff');
$meta['tocCollapseSubSections'] = array('onoff');
$meta['tocCollapseOnScroll']    = array('onoff');
$meta['tocCollapsed']           = array('onoff');
$meta['tocLayout']              = array('multichoice', '_choices' => array('default', 'navbar'));

// Discussion
$meta['showDiscussion']      = array('onoff');
$meta['discussionPage']      = array('string');

// Avatar
$meta['useAvatar']           = array('multichoice', '_choices' => array('off', 'gravatar', 'libravatar', 'office365', 'activedirectory', 'local'));
$meta['gravatarURL']         = array('string');
$meta['libravatarURL']       = array('string');
$meta['office365URL']        = array('string');

// Cookie Law
$meta['showCookieLawBanner'] = array('onoff');
$meta['cookieLawBannerPage'] = array('string');
$meta['cookieLawPolicyPage'] = array('string');

// Google Analytics
$meta['useGoogleAnalytics']          = array('onoff');
$meta['googleAnalyticsTrackID']      = array('string');
$meta['googleAnalyticsAnonymizeIP']  = array('onoff');
$meta['googleAnalyticsNoTrackAdmin'] = array('onoff');
$meta['googleAnalyticsNoTrackUsers'] = array('onoff');
$meta['googleAnalyticsNoTrackPages'] = array('regex');
$meta['googleAnalyticsTrackActions'] = array('onoff');

// Browser Title
$meta['browserTitle']          = array('string');
$meta['browserTitleShowNS']    = array('onoff');
$meta['browserTitleCharSepNS'] = array('multichoice', '_choices' => array('-', '|', ',', '/', '>'));
$meta['browserTitleOrderNS']   = array('multichoice', '_choices' => array('normal', 'reverse'));

// Page
$meta['showPageInfo']               = array('onoff');
$meta['useACL']                     = array('onoff', '_caution' => 'warning');
$meta['pageInfo']                   = array('multicheckbox', '_choices' => array('filename', 'extension', 'date', 'editor', 'locked'));
$meta['pageInfoDateFormat']         = array('multichoice', '_choices'   => array('dformat', 'human'));
$meta['showPageIcons']              = array('onoff');
$meta['pageIcons']                  = array('multicheckbox', '_choices' => array('social-share', 'feed', 'send-mail', 'permalink', 'print', 'help'));
$meta['socialShareProviders']       = array('multicheckbox', '_choices' => array('facebook', 'linkedin', 'microsoft-teams', 'pinterest', 'whatsapp', 'reddit', 'twitter', 'telegram', 'yammer'));
$meta['useAlternativeToolbarIcons'] = array('onoff');
$meta['tagsOnTop']                  = array('onoff');
$meta['useAnchorJS']                = array('onoff');
$meta['collapsibleSections']        = array('onoff');
$meta['domParserMaxPageSize']       = array('numeric', '_min' => 0);
