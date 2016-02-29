<?php
/**
 * Italian Language file for config
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
$lang['browserTitle']        = 'Titolo di DokuWiki del browser (di default è <code>@TITLE@ [@WIKI@]</code>, dove <code>@TITLE@</code> è il segnaposto usato per indicare il titolo della pagina, mentre <code>@WIKI@</code> è il segnaposto usato per indicare il nome di DokuWiki)  - vedi la configurazione <a class="interwiki iw_doku" href="#config___title">title</a>';
$lang['showIndividualTool']  = 'Abilita/Disabilita gli Strumenti nella barra di navigazione';
$lang['showTools']           = 'Mostra il menu degli strumenti nella barra di navigazione';
$lang['individualTools']     = 'Divide gli strumenti nella barra di navigazione in menu individuali';
$lang['showTools_o_never']   = 'Mai';
$lang['showTools_o_logged']  = 'Quando l\'utente è autenticato';
$lang['showTools_o_always']  = 'Sempre';
$lang['showSearchForm']      = 'Mostra la form di ricerca nella barra di navigazione';
$lang['showSearchForm_o_never']  = 'Mai';
$lang['showSearchForm_o_logged'] = 'Quando l\'utente è autenticato';
$lang['showSearchForm_o_always'] = 'Sempre';
$lang['sidebarPosition']     = 'Posizione della barra laterale di DokuWiki (<code>left</code> o <code>right</code>)';
$lang['rightSidebar']        = 'The Right Sidebar page name, empty field disables the right sidebar.<br/>The Right Sidebar is displayed only when the default DokuWiki <a href="#config___sidebar">sidebar</a> is enabled and is on the <code>left</code> position (see the <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a> configuration). If do you want only the DokuWiki sidebar on right position, set the <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a> configuration with <code>right</code> value';
$lang['tableFullWidth']      = 'Abilita la larghezza massima (100%) delle tabelle (comportamento di default di Bootstrap)';
$lang['semantic']            = 'Abilita i dati semantici';
$lang['schemaOrgType']       = 'Tipo di dato Schema.org (<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>)';
$lang['showTranslation']     = 'Mostra la barra delle traduzioni (richiede <em>Translation Plugin</em>)';
$lang['showAdminMenu']       = 'Mostra il menu di Amministrazione';
$lang['inverseNavbar']       = 'Barra di naginazione (navbar) invertita';
$lang['fixedTopNavbar']      = 'Blocca la barra di navigazione in alto';
$lang['fluidContainer']      = 'Abilita il "fluid container" (grandezza massima della pagina)';
$lang['fluidContainerBtn']   = 'Mostra il bottone per espandere la pagina nella barra di navigazione';
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
$lang['useGravatar']         = 'Carica le immagini da Gravatar';
$lang['showLandingPage']     = 'Abilita la landing-page (senza sidebar ed il pannello attorno alla pagina)';
$lang['landingPages']        = 'Nome della landing-page (inserisci una regex)';
$lang['showPageTools']    = 'Abilita gli Strumenti Utente in style DokuWiki';
$lang['showPageTools_o_never']   = 'Mai';
$lang['showPageTools_o_logged']  = 'Quando l\'utente è autenticato';
$lang['showPageTools_o_always']  = 'Sempre';
$lang['useLocalBootswatch']  = 'Utilizza la directory locale di Bootswatch. Questa opzione è utile nei casi DokuWiki sia utilizzato in una "intranet"';
$lang['tableStyle']          = 'Stili delle tabelle';
$lang['tagsOnTop']           = 'Sposta tutti i Tag in cima alla pagina, vicino a pageId (richiede <em>Tag Plugin</em>)';
$lang['showPageId']          = 'Mostra il nome della pagina (pageId)';
$lang['useAnchorJS']         = 'Utilizza AnchorJS';
$lang['showHomePageLink']    = 'Mostra il link per l\'Home-Page nella barra di navigazione';
$lang['useLegacyNavbar']     = 'Utilizza la versione "legacy" e deprecata di "navbar.html" (considera in futuro di utilizzare ":navbar")';
$lang['browserTitleCharSepNS'] = 'Carattere separatore di ogni namespace';
$lang['browserTitleShowNS']    = 'Mostra il nome della precedente pagina del namespace corrente';
$lang['browserTitleOrderNS']   = 'Imposta l\'ordine dei namespace';
$lang['tocCollapseSubSections'] = 'Comprimi tutte le sotto-sezioni del TOC per salvare spazio';
