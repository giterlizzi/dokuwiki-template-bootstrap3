<?php
/**
 * German Language file for config
 *
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @author   Dominik Soeldner <soeldner@yteam.de>
 * @author   Marko Šeremet
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$lang['discussionPage']      = 'Diskussions Seitenname (Standard ist <code>discussion:@ID@</code>, wobei <code>@ID@</code> als Platzhalter den Namen der aktuellen Seite ersetzt), ein leeres Feld deaktiviert den Link.';
$lang['showDiscussion']      = 'Zeigt den Diskussionslink im Werkzeug Menü';
$lang['showLoginOnFooter']   = 'Zeigt einen kleinen Loogin-Link im Fußbereich der Seite. Dies ist nützlich wenn die Funktion <code>hideLoginLink</code> aktiviert ist.';
$lang['hideLoginLink']       = 'Versteckt den Login-Link in der Navigationsleiste. Diese Option ist nützlich bei "read-only" Installationen (zum Beispiel Blog, Persönliches Wiki).';
$lang['showUserHomeLink']    = 'Zeigt den Link zur Benutzerseite in der Navigationsleiste.';
$lang['showCookieLawBanner'] = 'Zeigt den Cookie-Gesetz Banner im Fußbereich';
$lang['cookieLawBannerPage'] = 'Name der Cookie-Gesetz Seite';
$lang['cookieLawPolicyPage'] = 'Seitenname der Cookie-Regeln.';
$lang['browserTitle']        = 'DokuWiki Browser Titel (Standard ist <code>@TITLE@ [@WIKI@]</code>, wobei der Platzhalter <code>@TITLE@</code> den aktuellen Seitennamen und <code>@WIKI@</code> den Namen des DokuWiki ersetzt) - siehe <a class="interwiki iw_doku" href="#config___title">Titel</a> Konfiguration.';
$lang['showIndividualTool']  = 'Aktiviere/Deaktiviere individuelle Werkzeuge in der Navigationsleiste';
$lang['showTools']           = 'Zeigt die Werkzeuge in der Navigationsleiste';
$lang['individualTools']     = 'Teilt die Werkzeuge in einzelne Menüs in der Navigationsleiste.';
$lang['showTools_o_never']   = 'Nie';
$lang['showTools_o_logged']  = 'Wenn angemeldet';
$lang['showTools_o_always']  = 'Immer';
$lang['showSearchForm']      = 'Zeigt das Suchformular in der Navigationsleiste';
$lang['showSearchForm_o_never']  = 'Nie';
$lang['showSearchForm_o_logged'] = 'Wenn angemeldet';
$lang['showSearchForm_o_always'] = 'Immer';
$lang['sidebarPosition']     = 'Position der DokuWiki Seitenleiste (<code>links</code> oder <code>rechts</code>)';
$lang['rightSidebar']        = 'Name der rechten Seitenleiste, ein leeres Feld deaktiviert die rechte Seitenleiste.<br/>Die rechte Seitenleiste wird nur angezeigt wenn die Standard DokuWiki <a href="#config___sidebar">Seitenleiste</a> aktiviert ist und diese sich auf der <code>linken</code> Position befindet (Siehe dazu die <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">Seiteleisten Positions</a> Einstellung). Möchten Sie die Seitenleiste nur auf der rechten Seite, stellen Sie die <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">Seitenleisten Position</a> auf <code>rechts</code>.';
$lang['tableFullWidth']      = 'Aktiviere 100% Tabellenbreite (Bootstrap Standard)';
$lang['semantic']            = 'Aktiviert Semantischen Daten';
$lang['schemaOrgType']       = 'Schema.org Typ (<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>)';
$lang['showTranslation']     = 'Zeige die Übersetzungstoolbar (benötigt das <em>Translation Plugin</em>)';
$lang['showAdminMenu']       = 'Zeigt das Administrationsmenü';
$lang['inverseNavbar']       = 'Umgekehrte Navigationsleiste';
$lang['fixedTopNavbar']      = 'Fixiert die Navigationsleiste am oberen Bildschirmrand';
$lang['fluidContainer']      = 'Aktiviert den "fluid container" (100% Seitenbreite)';
$lang['fluidContainerBtn']   = 'Zeigt einen Button in der Navigationsleiste um die Seitenbreite zu erweitern (full-width)';
$lang['pageOnPanel']         = 'Aktiviert einen Rahmen um die Seite';
$lang['bootstrapTheme']      = 'Bootstrap Design';
$lang['bootstrapTheme_o_default']    = 'Vanilla Bootstrap Design';
$lang['bootstrapTheme_o_optional']   = 'Optionales Bootstrap Design';
$lang['bootstrapTheme_o_custom']     = 'Individualisiertes Bootstrap Design';
$lang['bootstrapTheme_o_bootswatch'] = 'Bootswatch.com Design';
$lang['customTheme']         = 'Füge die URL des Individuellen Designs ein';
$lang['bootswatchTheme']     = 'Wähle ein Design von Bootswatch.com aus';
$lang['showThemeSwitcher']   = 'Zeigt den Bootswatch.com Design Umschalter in der Navigationsleiste';
$lang['hideInThemeSwitcher'] = 'Verstecke Designs im Design Umschalter';
$lang['showPageInfo']        = 'Zeige Seiteninformationen (zB. Datum, Autor)';
$lang['showBadges']          = 'Zeige Links im Fußbereich (DokuWiki, Spenden, etc.)';
$lang['leftSidebarGrid']     = 'Linke Seitenleiste Raster Klasse <code>col-{xs,sm,md,lg}-x</code> (siehe <a href="http://holdirbootstrap.de/css/#grid" target="_blank">Bootstrap Raster-System</a> Dokumentation)';
$lang['rightSidebarGrid']    = 'Rechte Seitenleiste Raster Klasse <code>col-{xs,sm,md,lg}-x</code> (siehe <a href="http://holdirbootstrap.de/css/#grid" target="_blank">Bootstrap Raster-System</a> Dokumentation)';
$lang['useGravatar']         = 'Lade Gravatar Bilder';
$lang['showLandingPage']     = 'Aktiviere die "Landing-Page" (ohne eine Seitenleiste und die Umrandung der Seite)';
$lang['landingPages']        = 'Landingpage Name (benutze einen Regulären Ausdruck)';
$lang['showPageTools']    = 'Aktiviere die Seiten Werkzeuge im DokuWiki Style';
$lang['showPageTools_o_never']   = 'Nie';
$lang['showPageTools_o_logged']  = 'Wenn angemeldet';
$lang['showPageTools_o_always']  = 'Immer';
$lang['useLocalBootswatch']  = 'Benutze das lokale Bootswatch Verzeichnis. Diese Option ist hilfreich bei Installationen im "Intranet".';
$lang['tableStyle']          = 'Tabellendesign';
$lang['tagsOnTop']           = 'Verschiebt alle Schlagworte von der Oberseite neben die Seiten Bezeichnung (benötigt das <em>Tag Plugin</em>)';
$lang['showPageId']          = 'Zeigt den DokuWiki Seitennamen (pageld) im oberen Bereich';
$lang['useAnchorJS']         = 'Benutze AnchorJS';
$lang['showHomePageLink']    = 'Zeige den Hompage-Link in der Navbar';
$lang['useLegacyNavbar']     = 'Verwende das alte "navbar.html" Verfahren. (In Zukunft sollten Sie das ":navbar" Verfahren verwenden)';
$lang['browserTitleCharSepNS'] = 'Trennzeichen der Namensräume im Browser Titel';
$lang['browserTitleShowNS']    = 'Zeigt den vorherigen Seitennamen der aktuellen Seite im Browser Titel';
$lang['browserTitleOrderNS']   = 'Legt die Reihenfolge der Namensräume fest';
$lang['tocCollapseSubSections'] = 'Schließt alle Unterpunkte in TOC um Platz zu sparen';
