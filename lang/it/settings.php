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
$lang['showTools']           = 'Mostra il menu degli strumenti nella barra di navigazione';
$lang['individualTools']     = 'Divide gli strumenti nella barra di navigazione in menu individuali';
$lang['showTools_o_never']   = 'Mai';
$lang['showTools_o_logged']  = 'Quando si è "loggati"';
$lang['showTools_o_always']  = 'Sempre';
$lang['sidebarPosition']     = 'Posizione della barra laterale di DokuWiki (<code>left</code> o <code>right</code>)';
$lang['rightSidebar']        = 'Il nome della pagina per la barra laterale "destra", svuota il campo per disabilitare. <br/>La barra laterale di "destra" viene visualizzata solo se la <a href="#config___sidebar">barra laterale</a> di DokuWiki è configurata ed è a "sinistra" (vedi la configurazione <a href="#config___tpl____bootstrap3____sidebarPosition">
tpl»bootstrap3»sidebarPosition</a>). Se vuoi solamente la barra laterale di DokuWiki a "destra", imposta la configurazione <a href="#config___tpl____bootstrap3____sidebarPosition">tpl»bootstrap3»sidebarPosition</a> con valore <code>right</code>';
$lang['tableFullWidth']      = 'Enable 100% full table width (Bootstrap default)';
$lang['semantic']            = 'Abilita i dati semantici';
$lang['schemaOrgType']       = 'Tipo di dato Schema.org (<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>)';
$lang['showTranslation']     = 'Mostra la barra delle traduzioni (richiede <em>Translation Plugin</em>)';
$lang['inverseNavbar']       = 'Barra di naginazione (navbar) invertita';
$lang['fixedTopNavbar']      = 'Blocca la barra di navigazione in alto';
$lang['fluidContainer']      = 'Abilita il "fluid container" (grandezza massima della pagina)';
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
