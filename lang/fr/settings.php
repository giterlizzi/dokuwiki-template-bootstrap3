<?php
/**
 * French Language file for config
 *
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @author   Cyril
 * @author   Digitalin
 * @author   Dominique HAAS
 * @author   Grègoire Leclercq
 * @author   Keyven
 * @author   Maxime Buque <pep+code@bouah.net>
 * @author   Vincent Lecomte <vincent.lecomte@outlook.be>
 * @author   momo choko
 * @author   Fabrice Dejaigher
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$lang['bootstrapTheme']               = 'Choisissez un thème (thème Bootstrap, thème Bootstrap optionnel, thème de Bootswatch.com ou thème personalisé)';
$lang['bootstrapTheme_o_bootswatch']  = 'Theme Bootswatch.com';
$lang['bootstrapTheme_o_custom']      = 'Thème personnalisé Bootstrap';
$lang['bootstrapTheme_o_default']     = 'Thème Vanilla Bootstrap';
$lang['bootstrapTheme_o_optional']    = 'Thème optionnel Bootstrap';
$lang['bootswatchTheme']              = 'Choisissez un thème de Bootswatch.com';
$lang['browserTitle']                 = 'Le titre du navigateur pour DokuWiki (<code>@TITLE@ [@WIKI@]</code> par défaut, où l\'espace réservé </code>@TITLE@</code> est remplacé par le titre de la page en cours et <code>@WIKI@</code> remplace le nom DokuWiki) - voir la configuration du <a class="interwiki iw_doku" href="#config___title">titre</a>';
$lang['browserTitleCharSepNS']        = 'Caractère pour séparer chaque espace de noms dans le titre du navigateur';
$lang['browserTitleOrderNS']          = 'Définir l\'ordre des espaces de noms';
$lang['browserTitleShowNS']           = 'Afficher le nom précédent de la page actuelle dans le titre du navigateur';
$lang['collapsibleSections']          = 'Réduire au 2ème niveau de section (utile pour les téléphones et les tablettes)';
$lang['cookieLawBannerPage']          = 'Nom de page de la bannière :  "Politique d\'Utilisation des cookies"';
$lang['cookieLawPolicyPage']          = 'Nom de page de la "Politique d\'Utilisation des cookies"';
$lang['customTheme']                  = 'Renseignez l\'URL du thème personalisé';
$lang['discussionPage']               = 'Nom de la page de discussion (<code>discussion:@ID@</code> par défaut, <code>@ID@</code> étant le nom de la page courante). Le lien n\'est pas actif si le champ est laissé vide.';
$lang['domParserMaxPageSize']         = 'Définissez la taille max du contenu de la page pour le parser DOM. La valeur optimale et par défaut est <code>600000</code> (600KB)';
$lang['fixedTopNavbar']               = 'Fixer la barre de navigation en haut de la page';
$lang['fluidContainer']               = 'Activer la classe "fluid-container" (pleine largeur de page)';
$lang['fluidContainerBtn']            = 'Afficher un menu dans la barre de navigation pour développer le conteneur';
$lang['googleAnalyticsAnonymizeIP']   = 'Rendre anonymes les adresses IP des visiteurs';
$lang['googleAnalyticsNoTrackAdmin']  = 'Désactiver le suivi pour les utilisateurs étant administrateurs';
$lang['googleAnalyticsNoTrackPages']  = 'Désactiver le suivi pour les pages spécifiées (insérez une expression régulière)';
$lang['googleAnalyticsNoTrackUsers']  = 'Désactiver le suivi pour tous les utilisateurs connectés';
$lang['googleAnalyticsTrackActions']  = 'Suivre les actions DokuWiki (édition, recherche, etc)';
$lang['googleAnalyticsTrackID']       = 'Identifiant de suivi';
$lang['gravatarURL']                  = 'Saisissez l\'URL Gravatar <br/> <strong>REMARQUE :</strong> <br/> - <code>http://www.gravatar.com/avatar</code> (http) <br/> - <code>https://secure.gravatar.com/avatar</code> (https) <br/> - <code> https://www.gravatar.com/avatar</code> (alternative https)';
$lang['hideInThemeSwitcher']          = 'Ne pas afficher les thèmes dans le menu de thèmes';
$lang['hideLoginLink']                = 'Cacher le bouton de connexion dans la barre de navigation. Cette option est utile quand le DokuWiki est en lecture seule, (e.g., blog, site perso)';
$lang['homePageURL']                  = 'Utiliser une URL personnalisée pour les liens de page d\'accueil';
$lang['individualTools']              = 'Scinder les outils dans le menu personnel dans la barre de navigation';
$lang['inverseNavbar']                = 'Inverser la barre de navigation';
$lang['landingPages']                 = 'Nom de la page d\'accueil - format de page (insérer une regex)';
$lang['leftSidebarGrid']              = 'Les classes de grille pour la sidebar de gauche <code>col-{xs,sm,md,lg}-x</code> (voir la documentation <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grids</a>)';
$lang['libravatarURL']                = 'Saisissez l\'URL Libravatar (ou une API compatible).<br/> <strong>REMARQUE : </strong> <br/> - <code>https://seccdn.libravatar.org/avatar</code> (https) <br/> - <code>http://cdn.libravatar.org/avatar</code> (http).';
$lang['navbarLabels']                 = 'Afficher/Masquer l\'étiquette individuelle';
$lang['notifyExtensionsUpdate']       = 'Notifier les mises à jour d\'extensions (pour  les utilisateurs Admin)';
$lang['office365URL']                 = 'Saisissez l\'URL Microsoft Office 365 (ou EWS)<br/> <strong>REMARQUE : </strong> Ce service requiert une authentification, son utilisation est donc plutôt réservée à une installation en entreprise, où tous les utilisateurs ont accès à Office 365.';
$lang['pageIcons']                    = 'Sélectionnez les icônes à afficher';
$lang['pageInfo']                     = 'Afficher/Cacher les éléments d\'information de la page';
$lang['pageInfoDateFormat']           = 'Format de la date';
$lang['pageInfoDateFormat_o_dformat'] = 'Format DokuWiki';
$lang['pageInfoDateFormat_o_human']   = 'Lisible par un humain';
$lang['pageOnPanel']                  = 'Activer le cadre autour de la page';
$lang['rightSidebar']                 = 'Nom de la page pour la barre latérale droite. Un champ vide désactive la barre latérale de droite.<br/>Celle-ci est affichée uniquement quand la <a class="interwiki iw_doku" href="#config___sidebar">barre latérale</a> par défaut de DokuWiki est activée avec la position <code>left</code> (voir la page de configuration <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a>). Si vous voulez uniquement la barre latérale DokuWiki à droite, définissez le paramètre <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a> avec la valeur <code>right</code>';
$lang['rightSidebarGrid']             = 'Les classes de grille pour la sidebar de droite  <code>col-{xs,sm,md,lg}-x</code> (voir la documentation <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grids</a>)';
$lang['schemaOrgType']                = 'Type Schema.org (<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>, <code>Recipe</code>)';
$lang['semantic']                     = 'Activer les données sémantiques';
$lang['showAddNewPage']               = 'Activer l\'extension Add New Page dans la barre de navigation (nécessite  l\'extension <em>Add New Page</em>)';
$lang['showAddNewPage_o_always']      = 'Toujours';
$lang['showAddNewPage_o_logged']      = 'Une fois identifié';
$lang['showAddNewPage_o_never']       = 'Jamais';
$lang['showAdminMenu']                = 'Afficher le menu d\'administration';
$lang['showBadges']                   = 'Afficher les boutons des badges (Dokuwiki, Don, etc)';
$lang['showCookieLawBanner']          = 'Afficher la bannière "Politique d\'Utilisation des cookies" en pied de page';
$lang['showDiscussion']               = 'Afficher un lien vers la page de discussion dans les outils.';
$lang['showEditBtn']                  = 'Afficher le bouton de modification dans la barre de navigation';
$lang['showEditBtn_o_always']         = 'Toujours';
$lang['showEditBtn_o_logged']         = 'Une fois identifié';
$lang['showEditBtn_o_never']          = 'Jamais';
$lang['showHomePageLink']             = 'Afficher le lien de l\'Accueil dans la barre de navigation';
$lang['showIndividualTool']           = 'Activer/Désactiver l\'outil personnel dans la barre de navigation';
$lang['showLandingPage']              = 'Activer le format de page simple (sans sidebar et sans cadre autour de la page)';
$lang['showLoginOnFooter']            = 'Afficher un "petit" lien vers le login en bas de page. Cette option est utile quand <code>hideLoginLink</code> est actif.';
$lang['showNavbar']                   = 'Afficher l\'attache "Barre de navigation"';
$lang['showNavbar_o_always']          = 'Toujours';
$lang['showNavbar_o_logged']          = 'Une fois connecté';
$lang['showPageIcons']                = 'Afficher des icônes utiles (imprimer, partager, envoyer un e-mail, etc.) sur la page';
$lang['showPageId']                   = 'Afficher l\'identifiant de page Dokuwiki (pageId)  en haut';
$lang['showPageInfo']                 = 'Afficher les informations de page (date, auteur,...)';
$lang['showPageTools']                = 'Activer les outils de page dans le style Dokuwiki';
$lang['showPageTools_o_always']       = 'Toujours';
$lang['showPageTools_o_logged']       = 'Une fois connecté';
$lang['showPageTools_o_never']        = 'Jamais';
$lang['showSearchForm']               = 'Afficher la barre de recherche dans la barre de navigation';
$lang['showSearchForm_o_always']      = 'Toujours';
$lang['showSearchForm_o_logged']      = 'Une fois connecté';
$lang['showSearchForm_o_never']       = 'Jamais';
$lang['showSemanticPopup']            = 'Afficher un menu contextuel avec un extrait de la page quand l\'utilisateur survole les liens wiki (nécessite l\'extension <em>Semantic</em>)';
$lang['showThemeSwitcher']            = 'Afficher un menu pour les thèmes de Bootswatch.com dans la barre de navigation';
$lang['showTools']                    = 'Afficher les outils dans la barre de navigation';
$lang['showTools_o_always']           = 'Toujours';
$lang['showTools_o_logged']           = 'Une fois connecté';
$lang['showTools_o_never']            = 'Jamais';
$lang['showTranslation']              = 'Afficher la barre de langues (nécessite <em>Translation Plugin</em>)';
$lang['showUserHomeLink']             = 'Afficher un lien vers la page utilisateur dans la barre de navigation';
$lang['showWikiInfo']                 = 'Afficher le <a class="interwiki iw_doku" href="#config___title">nom</a>, le logo et le <a class="interwiki iw_doku" href="#config___tagline">slogan</a> en pied de page.';
$lang['sidebarOnNavbar']              = 'Afficher le contenu de la barre latérale (sidebar) dans la barre de navigation (utile pour les smartphone et les tablettes)';
$lang['sidebarPosition']              = 'Position de la barre latérale (sidebar) de DokuWiki (<code>left</code> (gauche) ou <code>right</code> (droite))';
$lang['sidebarShowPageTitle']         = 'Afficher le titre de la page du menu latéral';
$lang['socialShareProviders']         = 'Sélectionnez les réseaux sociaux pour lesquels afficher un lien de partage';
$lang['tableFullWidth']               = 'Activer en pleine largeur, 100% du tableau (Bootstrap par défaut)';
$lang['tableStyle']                   = 'Style de tableau';
$lang['tagsOnTop']                    = 'Déplacer tous les Tags en haut de page, à côté de l\'identifiant de page (nécessite <em> Tag Plugin </em>)';
$lang['themeByNamespace']             = 'Utiliser un thème par espace de noms';
$lang['tocAffix']                     = 'Rendre flottante la table des matières pour accompagner lors du défilement';
$lang['tocCollapseOnScroll']          = 'Réduire la table des matières lors du défilement de la page';
$lang['tocCollapseSubSections']       = 'Réduire toutes les sous-sections dans les TOC pour économiser l\'espace';
$lang['tocCollapsed']                 = 'Réduire la table des matières sur toutes les pages';
$lang['tocPosition']                  = 'Position de la table des matières';
$lang['tocLayout']                    = 'Agencement de la table des matières';
$lang['useACL']                       = 'Utiliser les ACL pour les barres latérales (gauche et droite) et pour tous les "hooks" de Dokuwiki (ex. : <code>:footer</code>, <code>:navbar</code>, etc.) <br/> <strong>REMARQUE : </strong> Disponible depuis la version "Elenor of Tsort" de DokuWiki';
$lang['useAlternativeToolbarIcons']   = 'Use alternative Material Design Icons for DokuWiki toolbar';
$lang['useAnchorJS']                  = 'Activer AnchorJS';
$lang['useAvatar']                    = 'Charger l\'image d\'avatar depuis Gravatar, Libravatar, Microsoft Office 365 ou localement depuis l\'espace de nom <code>:user</code> de DokuWiki';
$lang['useAvatar_o_gravatar']         = 'Gravatar';
$lang['useAvatar_o_libravatar']       = 'Libravatar';
$lang['useAvatar_o_local']            = 'Espace de nom DokuWiki :user';
$lang['useAvatar_o_off']              = 'Désactivé';
$lang['useAvatar_o_office365']        = 'Office365 (ou EWS)';
$lang['useAvatar_o_activedirectory']  = 'Active Directory';
$lang['useGoogleAnalytics']           = 'Activer la fonctionnalité Google Analytics';
$lang['useLegacyNavbar']              = 'Utiliser l\'attache <code>navbar.html</code> héritée de DokuWiki et malheureusement dépréciée (dans le futur, pensez à utiliser l\'attache <code>:navbar</code>)';
