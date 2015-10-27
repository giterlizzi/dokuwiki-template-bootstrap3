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
$lang['showCookieLawBanner'] = 'Afficher la bannière "Politique d\'Utilisation des cookies" en pied de page';
$lang['cookieLawBannerPage'] = 'Nom de page de la bannière :  "Politique d\'Utilisation des cookies"';
$lang['cookieLawPolicyPage'] = 'Nom de page de la "Politique d\'Utilisation des cookies"';
$lang['browserTitle']        = 'Par défaut, Dokuwiki affiche  comme titre dans la barre de navigation  : <code>@TITLE@ [@WIKI@]</code>, prenant comme valeur de remplissage <code>@TITLE@</code> pour le titre de la page courante et <code>@WIKI@</code> pour le nom du wiki  - voir la configuration <a href="#config___title">title</a>';
$lang['showIndividualTool']  = 'Activer/Désactiver l\'outil personnel dans la barre de navigation';
$lang['showTools']           = 'Afficher les outils dans la barre de navigation';
$lang['individualTools']     = 'Scinder les outils dans le menu personnel dans la barre de navigation';
$lang['showTools_o_never']   = 'Jamais';
$lang['showTools_o_logged']  = 'Une fois loggé';
$lang['showTools_o_always']  = 'Toujours';
$lang['showSearchForm']      = 'Afficher la barre de recherche dans la barre de navigation';
$lang['showSearchForm_o_never']  = 'Jamais';
$lang['showSearchForm_o_logged'] = 'Une fois loggé';
$lang['showSearchForm_o_always'] = 'Toujours';
$lang['sidebarPosition']     = 'Position de la sidebar de DokuWiki (<code>left</code> (gauche) ou <code>right</code> (droite))';
$lang['rightSidebar']        = 'Le nom de page pour la sidebar à droite, un champ laissé vide désactive la sidebar à droite. <br/>
La sidebar à droite ne s\'affiche que si la configuration par défaut de Dokuwiki de la <a href="#config___sidebar">sidebar</a>  est active et en position  <code>gauche</code> (Voir la <a href="#config___tpl____bootstrap3____sidebarPosition">tpl»bootstrap3»sidebarPosition</a> configuration). Si vous souhaitez uniquement  la sidebar à droite, définissez la  <a href="#config___tpl____bootstrap3____sidebarPosition">tpl»bootstrap3»sidebarPosition</a> configuration avec <code>droite</code> comme valeur.';
$lang['tableFullWidth']      = 'Enable 100% full table width (Bootstrap default)';
$lang['semantic']            = 'Activer les données sémantiques';
$lang['schemaOrgType']       = 'Schema.org type (<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>)';
$lang['showTranslation']     = 'Affiche la barre de langues (nécessite <em>Translation Plugin</em>)';
$lang['showAdminMenu']       = 'Afficher le menu d\'administration';
$lang['inverseNavbar']       = 'Inverser la barre de navigation';
$lang['fixedTopNavbar']      = 'Fixer la barre de navigation en haut de la page';
$lang['fluidContainer']      = 'Activer la classe "fluid-container" (pleine largeur de page)';
$lang['fluidContainerBtn']   = 'Afficher un menu dans la barre de navigation pour développer le conteneur';
$lang['pageOnPanel']         = 'Activer le cadre autour de la page';
$lang['bootstrapTheme']      = 'Choisissez un theme (thème Bootstrap, thème Bootstrap optionnel, thème de Bootswatch.com ou thème personalisé)';
$lang['bootstrapTheme_o_default']    = 'Thème Vanilla Bootstrap';
$lang['bootstrapTheme_o_optional']   = 'Thème optionnel Bootstrap';
$lang['bootstrapTheme_o_custom']     = 'Thème personnalisé Bootstrap';
$lang['bootstrapTheme_o_bootswatch'] = 'Theme Bootswatch.com';
$lang['customTheme']         = 'Renseignez l\'URL du thème personalisé';
$lang['bootswatchTheme']     = 'Choisissez un thème de Bootswatch.com';
$lang['showThemeSwitcher']   = 'Afficher un menu pour les thèmes de Bootswatch.com dans la barre de navigation';
$lang['hideInThemeSwitcher'] = 'Ne pas afficher les thèmes dans le menu de thèmes';
$lang['showPageInfo']        = 'Afficher les informations de page (date, auteur,...)';
$lang['showBadges']          = 'Afficher les boutons des badges (Dokuwiki, Don, etc)';
$lang['leftSidebarGrid']     = 'Left sidebar grid classes <code>col-{xs,sm,md,lg}-x</code> (see <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grids</a> documentation)';
$lang['rightSidebarGrid']    = 'Right sidebar grid classes <code>col-{xs,sm,md,lg}-x</code> (see <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grids</a> documentation)';
$lang['useGravatar']         = 'Charger l\'image Gravatar';
$lang['showLandingPage']     = 'Activer un format de page (sans sidebar et sans cadre autour de la page)';
$lang['landingPages']        = 'Nom de la page d\'accueil - format de page (insérer une regex)';
$lang['showPageTools']    = 'Activer les outils de page dans le style Dokuwiki';
$lang['showPageTools_o_never']   = 'Jamais';
$lang['showPageTools_o_logged']  = 'Une fois loggé';
$lang['showPageTools_o_always']  = 'Toujours';
$lang['useLocalBootswatch']  = 'Utiliser le répertoire local de Bootswatch. Cette option est utile pour une installation de Dokuwiki en intranet';
$lang['tableStyle']          = 'Style de tableau';
$lang['tagsOnTop']           = 'Déplacer tous les Tags en haut de page, à côté de l\'identifiant de page (nécessite <em> Tag Plugin </em>)';
$lang['showPageId']          = 'Afficher l\'identifiant de page Dokuwiki (pageId)  en haut';
