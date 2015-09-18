<?php
/**
 * Language file for config
 *
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$lang['discussionPage']      = 'Discussion page name (default is <code>discussion:@ID@</code>, where <code>@ID@</code> placeholder replace the current page name), empty field disable the link';
$lang['showDiscussion']      = 'Display discussion link in tools menu';
$lang['showLoginOnFooter']   = 'Display a "little" login link on footer. This option is useful when <code>hideLoginLink</code> is on';
$lang['hideLoginLink']       = 'Hide the login button in navbar. This option is useful in "read-only" DokuWiki installations (eg. blog, personal website)';
$lang['showUserHomeLink']    = 'Display User Home-Page link in navbar';
$lang['showCookieLawBanner'] = 'Display the Cookie Law banner on footer';
$lang['cookieLawBannerPage'] = 'Cookie Law banner page name';
$lang['cookieLawPolicyPage'] = 'Cookie Law policy page name';
$lang['browserTitle']        = 'DokuWiki browser title (default is <code>@TITLE@ [@WIKI@]</code>, where <code>@TITLE@</code> placeholder replace the current page title and <code>@WIKI@</code> replace the DokuWiki name - see <a href="#config___title">title</a> config';
$lang['showIndividualTool']  = 'Enable/Disable individual tool in navbar';
$lang['showTools']           = 'Display Tools in navbar';
$lang['individualTools']     = 'Split the Tools in individual menu in navbar';
$lang['showTools_o_never']   = 'Never';
$lang['showTools_o_logged']  = 'When logged in';
$lang['showTools_o_always']  = 'Always';
$lang['showSearchForm']      = 'Display Search form in navbar';
$lang['showSearchForm_o_never']  = 'Never';
$lang['showSearchForm_o_logged'] = 'When logged in';
$lang['showSearchForm_o_always'] = 'Always';
$lang['sidebarPosition']     = 'DokuWiki Sidebar position (<code>left</code> or <code>right</code>)';
$lang['rightSidebar']        = 'The Right Sidebar page name, empty field disables the right sidebar.<br/>The Right Sidebar is displayed only when the default DokuWiki <a href="#config___sidebar">sidebar</a> is enabled and is on the <code>left</code> position (see the <a href="#config___tpl____bootstrap3____sidebarPosition">tpl»bootstrap3»sidebarPosition</a> configuration). If do you want only the DokuWiki sidebar on right position, set the <a href="#config___tpl____bootstrap3____sidebarPosition">tpl»bootstrap3»sidebarPosition</a> configuration with <code>right</code> value';
$lang['tableFullWidth']      = 'Enable 100% full table width (Bootstrap default)';
$lang['semantic']            = 'Enable semantic data';
$lang['schemaOrgType']       = 'Schema.org type (<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>)';
$lang['showTranslation']     = 'Display translation toolbar (require <em>Translation Plugin</em>)';
$lang['showAdminMenu']       = 'Display Administration menu';
$lang['inverseNavbar']       = 'Inverse navbar';
$lang['fixedTopNavbar']      = 'Fix navbar to top';
$lang['fluidContainer']      = 'Enable the fluid container (full-width of page)';
$lang['fluidContainerBtn']   = 'Display a button in navbar to expand container';
$lang['pageOnPanel']         = 'Enable the panel around the page';
$lang['bootstrapTheme']      = 'Bootstrap theme';
$lang['bootstrapTheme_o_default']    = 'Vanilla Bootstrap theme';
$lang['bootstrapTheme_o_optional']   = 'Optional Bootstrap theme';
$lang['bootstrapTheme_o_custom']     = 'Customized Bootstrap theme';
$lang['bootstrapTheme_o_bootswatch'] = 'Bootswatch.com theme';
$lang['customTheme']         = 'Insert URL of custom theme';
$lang['bootswatchTheme']     = 'Select a theme from Bootswatch.com';
$lang['showThemeSwitcher']   = 'Show Bootswatch.com theme switcher in navbar';
$lang['hideInThemeSwitcher'] = 'Hide themes in theme switcher';
$lang['showPageInfo']        = 'Show page info (e.g., date, author)';
$lang['showBadges']          = 'Show badge buttons (DokuWiki, Donate, etc)';
$lang['leftSidebarGrid']     = 'Left sidebar grid classes <code>col-{xs,sm,md,lg}-x</code> (see <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grids</a> documentation)';
$lang['rightSidebarGrid']    = 'Right sidebar grid classes <code>col-{xs,sm,md,lg}-x</code> (see <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grids</a> documentation)';
$lang['useGravatar']         = 'Load Gravatar image';
$lang['showLandingPage']     = 'Enable the landing page (without a sidebar and the panel around the page)';
$lang['landingPages']        = 'Landing pages (insert a regex)';
$lang['showPageTools']    = 'Enable the DokuWiki-style Page Tools';
$lang['showPageTools_o_never']   = 'Never';
$lang['showPageTools_o_logged']  = 'When logged in';
$lang['showPageTools_o_always']  = 'Always';
$lang['useLocalBootswatch']  = 'Use the local Bootswatch directory. This option is useful in "intranet" DokuWiki installation';
$lang['tableStyle']          = 'Table style';