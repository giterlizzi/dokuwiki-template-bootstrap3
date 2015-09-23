<?php
/**
 * Language file for config
 *
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$lang['discussionPage']      = 'Nom de la page de discussion (<code>discussion:@ID@</code> par défaut,  <code>@ID@</code> étant le nom de la page courante). Le lien n\'est pas actif si le champ est laissé vide.';
$lang['showDiscussion']      = 'Afficher un lien vers la page de discussion dans les outils.';
$lang['showLoginOnFooter']   = 'Afficher un "petit" lien vers le login en bas de page. Cette option est utile quand <code>hideLoginLink</code> est actif.';
$lang['hideLoginLink']       = 'Cacher le bouton de login dans la barre de navigation. Cette option est utile quand le DokuWiki est en lecture seule, (e.g., blog, site perso)';
$lang['showUserHomeLink']    = 'Afficher un lien vers la page utilisateur dans la barre de navigation';
$lang['showCookieLawBanner'] = 'Display the Cookie Law banner on footer';
$lang['cookieLawBannerPage'] = 'Cookie Law banner page name';
$lang['cookieLawPolicyPage'] = 'Cookie Law policy page name';
$lang['browserTitle']        = 'DokuWiki browser title (default is <code>@TITLE@ [@WIKI@]</code>, where <code>@TITLE@</code> placeholder replace the current page title and <code>@WIKI@</code> replace the DokuWiki name - see <a href="#config___title">title</a> config';
$lang['showIndividualTool']  = 'Enable/Disable individual tool in navbar';
$lang['showTools']           = 'Afficher les outils dans la barre de navigation';
$lang['individualTools']     = 'Split the Tools in individual menu in navbar';
$lang['showTools_o_never']   = 'Jamais';
$lang['showTools_o_logged']  = 'Une fois loggé';
$lang['showTools_o_always']  = 'Toujours';
$lang['showSearchForm']      = 'Display Search form in navbar';
$lang['showSearchForm_o_never']  = 'Never';
$lang['showSearchForm_o_logged'] = 'When logged in';
$lang['showSearchForm_o_always'] = 'Always';
$lang['sidebarPosition']     = 'Position de la sidebar de DokuWiki (<code>left</code> (gauche) ou <code>right</code> (droite))';
$lang['rightSidebar']        = 'The Right Sidebar page name, empty field disables the right sidebar.<br/>The Right Sidebar is displayed only when the default DokuWiki <a href="#config___sidebar">sidebar</a> is enabled and is on the <code>left</code> position (see the <a href="#config___tpl____bootstrap3____sidebarPosition">tpl»bootstrap3»sidebarPosition</a> configuration). If do you want only the DokuWiki sidebar on right position, set the <a href="#config___tpl____bootstrap3____sidebarPosition">tpl»bootstrap3»sidebarPosition</a> configuration with <code>right</code> value';
$lang['tableFullWidth']      = 'Enable 100% full table width (Bootstrap default)';
$lang['semantic']            = 'Enable semantic data';
$lang['schemaOrgType']       = 'Schema.org type (<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>)';
$lang['showTranslation']     = 'Affiche la barre de langues (nécessite <em>Translation Plugin</em>)';
$lang['showAdminMenu']       = 'Display Administration menu';
$lang['inverseNavbar']       = 'Inverser la barre de navigation';
$lang['fixedTopNavbar']      = 'Fixer la barre de navigation en haut de la page';
$lang['fluidContainer']      = 'Enable the fluid container (full-width of page)';
$lang['fluidContainerBtn']   = 'Display a button in navbar to expand container';
$lang['pageOnPanel']         = 'Enable the panel around the page';
$lang['bootstrapTheme']      = 'Choisissez un theme (thème Bootstrap, thème Bootstrap optionnel, thème de Bootswatch.com ou thème personalisé)';
$lang['bootstrapTheme_o_default']    = 'Vanilla Bootstrap theme';
$lang['bootstrapTheme_o_optional']   = 'Optional Bootstrap theme';
$lang['bootstrapTheme_o_custom']     = 'Customized Bootstrap theme';
$lang['bootstrapTheme_o_bootswatch'] = 'Theme Bootswatch.com';
$lang['customTheme']         = 'Renseignez l\'URL du thème personalisé';
$lang['bootswatchTheme']     = 'Choisissez un thème de Bootswatch.com';
$lang['showThemeSwitcher']   = 'Afficher un menu pour les thèmes de Bootswatch.com dans la barre de navigation';
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