<?php
/**
 * Language file for config
 *
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$lang['discussionPage']      = 'Nome della pagina di discussione (di default è <code>discussion:@ID@</code>, dove <code>@ID@</code> è il segnaposto usato per indicare la pagina corrente), svuota il campo se vuoi disabilitare il link';
$lang['showDiscussion']      = 'Mostra il link della discussione del menu degli strumenti';
$lang['showLoginOnFooter']   = 'Mostra un "piccolo" link per la login nel footer. Questa opzione è utile quando <code>hideLoginLink</code> è impostato';
$lang['hideLoginLink']       = 'Nasconde il bottone della login nella barra di navigazione. Questa opzione è utile in installazioni di DokuWiki in "sola lettura" (ad esempio blog, siti personali)';
$lang['showUserHomeLink']    = 'Mostra il link alla Home-Page dell\'utente nella barra di navigazione';
$lang['showCookieLawBanner'] = 'Mostra il banner "Cookie Law" nel footer';
$lang['cookieLawBannerPage'] = 'Nome della pagina del banner "Cookie Law"';
$lang['cookieLawPolicyPage'] = 'Nome della pagina della policy "Cookie Law"';
$lang['browserTitle']        = 'Titolo di DokuWiki del browser (di default è <code>@TITLE@ [@WIKI@]</code>, dove <code>@TITLE@</code> è il segnaposto usato per indicare il titolo della pagina, mentre <code>@WIKI@</code> è il segnaposto usato per indicare il nome di DokuWiki - vedi la configurazione <a href="#config___title">title</a>';
$lang['showIndividualTool']  = 'Enable/Disable individual tool in navbar';
$lang['showTools']           = 'Mostra il menu degli strumenti nella barra di navigazione';
$lang['individualTools']     = 'Divide gli strumenti nella barra di navigazione in menu individuali';
$lang['showTools_o_never']   = 'Mai';
$lang['showTools_o_logged']  = 'Quando si è "loggati"';
$lang['showTools_o_always']  = 'Sempre';
$lang['showSearchForm']      = 'Mostra la form di ricerca nella barra di navigazione';
$lang['showSearchForm_o_never']  = 'Mai';
$lang['showSearchForm_o_logged'] = 'Quando si è "loggati"';
$lang['showSearchForm_o_always'] = 'Sempre';
$lang['sidebarPosition']     = 'Posizione della barra laterale di DokuWiki (<code>left</code> o <code>right</code>)';
$lang['rightSidebar']        = 'The Right Sidebar page name, empty field disables the right sidebar.<br/>The Right Sidebar is displayed only when the default DokuWiki <a href="#config___sidebar">sidebar</a> is enabled and is on the <code>left</code> position (see the <a href="#config___tpl____bootstrap3____sidebarPosition">tpl»bootstrap3»sidebarPosition</a> configuration). If do you want only the DokuWiki sidebar on right position, set the <a href="#config___tpl____bootstrap3____sidebarPosition">tpl»bootstrap3»sidebarPosition</a> configuration with <code>right</code> value';
$lang['tableFullWidth']      = 'Enable 100% full table width (Bootstrap default)';
$lang['semantic']            = 'Abilita i dati semantici';
$lang['schemaOrgType']       = 'Tipo di dato Schema.org (<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>)';
$lang['showTranslation']     = 'Mostra la barra delle traduzioni (richiede <em>Translation Plugin</em>)';
$lang['showAdminMenu']       = 'Display Administration menu';
$lang['inverseNavbar']       = 'Barra di naginazione (navbar) invertita';
$lang['fixedTopNavbar']      = 'Blocca la barra di navigazione in alto';
$lang['fluidContainer']      = 'Abilita il "fluid container" (grandezza massima della pagina)';
$lang['fluidContainerBtn']   = 'Display a button in navbar to expand container';
$lang['pageOnPanel']         = 'Abilita il pannello intorno alla pagina';
$lang['bootstrapTheme']      = 'Tema Bootstrap';
$lang['bootstrapTheme_o_default']    = 'Tema base di Bootstrap';
$lang['bootstrapTheme_o_optional']   = 'Tema opzionale di Bootstrap';
$lang['bootstrapTheme_o_custom']     = 'Tema Bootstrap "customizzato"';
$lang['bootstrapTheme_o_bootswatch'] = 'Tema da Bootswatch.com';
$lang['customTheme']         = 'Inserisci l\'URL del tema custom';
$lang['bootswatchTheme']     = 'Seleziona un tema di Bootswatch.com';
$lang['showThemeSwitcher']   = 'Mostra il selettore dei temi di Bootswatch.com nella barra di navigazione';
$lang['hideInThemeSwitcher'] = 'Nascondi i temi nel selettore dei temi';
$lang['showPageInfo']        = 'Mostra le informazioni sulla pagina (es. data, autore)';
$lang['showBadges']          = 'Mostra i "badge" (DokuWiki, donazione, etc)';
$lang['leftSidebarGrid']     = 'Classi per la grandezza della griglia per la barra laterale "sinistra" <code>col-{xs,sm,md,lg}-x</code> (vedi la documentazione <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grids</a>)';
$lang['rightSidebarGrid']    = 'Classi per la grandezza della griglia per la barra laterale "destra" <code>col-{xs,sm,md,lg}-x</code> (vedi la documentazione <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grids</a>)';
$lang['useGravatar']         = 'Load Gravatar image';
$lang['showLandingPage']     = 'Enable the landing page (without a sidebar and the panel around the page)';
$lang['landingPages']        = 'Landing page name (insert a regex)';
$lang['showPageTools']    = 'Enable the DokuWiki-style Page Tools';
$lang['showPageTools_o_never']   = 'Never';
$lang['showPageTools_o_logged']  = 'When logged in';
$lang['showPageTools_o_always']  = 'Always';
$lang['useLocalBootswatch']  = 'Use the local Bootswatch directory. This option is useful in "intranet" DokuWiki installation';
$lang['tableStyle']          = 'Table style';
$lang['tagsOnTop']           = 'Move all Tags on top of the page, beside the page-id (require <em>Tag Plugin</em>)';
$lang['showPageId']          = 'Display the DokuWiki page name (pageId) on top';
