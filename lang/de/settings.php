<?php
/**
 * German Language file for config
 *
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @author   Dominik Soeldner <soeldner@yteam.de>
 * @author   Marko Šeremet
 * @author   Torsten Widmann
 * @author   Dino Trappenberg
 * @author   kaktux
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$lang['bootstrapTheme']               = 'Bootstrap Design';
$lang['bootstrapTheme_o_bootswatch']  = 'Bootswatch.com Design';
$lang['bootstrapTheme_o_custom']      = 'Individualisiertes Bootstrap Design';
$lang['bootstrapTheme_o_default']     = 'Vanilla Bootstrap Design';
$lang['bootstrapTheme_o_optional']    = 'Optionales Bootstrap Design';
$lang['bootswatchTheme']              = 'Wähle ein Design von Bootswatch.com aus';
$lang['browserTitle']                 = 'DokuWiki Browser Titel (Standard ist <code>@TITLE@ [@WIKI@]</code>, wobei der Platzhalter <code>@TITLE@</code> den aktuellen Seitennamen und <code>@WIKI@</code> den Namen des DokuWiki ersetzt) - siehe <a class="interwiki iw_doku" href="#config___title">Titel</a> Konfiguration.';
$lang['browserTitleCharSepNS']        = 'Trennzeichen der Namensräume im Browser Titel';
$lang['browserTitleOrderNS']          = 'Legt die Reihenfolge der Namensräume fest';
$lang['browserTitleShowNS']           = 'Zeigt den vorherigen Seitennamen der aktuellen Seite im Browser Titel';
$lang['collapsibleSections']          = 'Zweite Ebene zusammenklappen (nützlich für mobile Endgeräte)';
$lang['cookieLawBannerPage']          = 'Name der Cookie-Gesetz Seite';
$lang['cookieLawPolicyPage']          = 'Seitenname der Cookie-Regeln.';
$lang['customTheme']                  = 'Füge die URL des Individuellen Designs ein';
$lang['discussionPage']               = 'Diskussions Seitenname (Standard ist <code>discussion:@ID@</code>, wobei <code>@ID@</code> als Platzhalter den Namen der aktuellen Seite ersetzt), ein leeres Feld deaktiviert den Link.';
$lang['domParserMaxPageSize']         = 'Legt die maximale Größe des Seiteninhalts für den DOM Parser fest. Der optimale und Standardwert ist <code>600000</code> (600KB)';
$lang['fixedTopNavbar']               = 'Fixiert die Navigationsleiste am oberen Bildschirmrand';
$lang['fluidContainer']               = 'Aktiviert den "fluid container" (100% Seitenbreite)';
$lang['fluidContainerBtn']            = 'Zeigt einen Button in der Navigationsleiste um die Seitenbreite zu erweitern (full-width)';
$lang['googleAnalyticsAnonymizeIP']   = 'Anonymisiere die IP Adresse von Besuchern';
$lang['googleAnalyticsNoTrackAdmin']  = 'Deaktiviert Tracking für den Admin Benutzer';
$lang['googleAnalyticsNoTrackPages']  = 'Deaktiviert das Tracking für bestimmte Seiten (Regulären Ausdrücke verwenden)';
$lang['googleAnalyticsNoTrackUsers']  = 'Deaktiviert das Tracking für alle angemeldeten Benutzer';
$lang['googleAnalyticsTrackActions']  = 'Verfolge DokuWiki Aktivitäten (Bearbeiten, suchen, etc)';
$lang['googleAnalyticsTrackID']       = 'Tracking ID';
$lang['gravatarURL']                  = 'Legt die Gravatar-URL fest <br/> <strong>HINWEIS:</strong> <br/> - <code>http://www.gravatar.com/avatar</code> (http) <br/> - <code>https://secure.gravatar.com/avatar</code> (https) <br/> - <code>https://www.gravatar.com/avatar</code> (alternative https)';
$lang['hideInThemeSwitcher']          = 'Verstecke Designs im Design Umschalter';
$lang['hideLoginLink']                = 'Versteckt den Login-Link in der Navigationsleiste. Diese Option ist nützlich bei "read-only" Installationen (zum Beispiel Blog, Persönliches Wiki).';
$lang['homePageURL']                  = 'Verwendet eine benutzerdefinierte URL für den Startseiten-Link';
$lang['individualTools']              = 'Teilt die Werkzeuge in einzelne Menüs in der Navigationsleiste.';
$lang['inverseNavbar']                = 'Umgekehrte Navigationsleiste';
$lang['landingPages']                 = 'Landingpage Name (benutze einen Regulären Ausdruck)';
$lang['leftSidebarGrid']              = 'Linke Seitenleiste Raster Klasse <code>col-{xs,sm,md,lg}-x</code> (siehe <a href="http://holdirbootstrap.de/css/#grid" target="_blank">Bootstrap Raster-System</a> Dokumentation)';
$lang['libravatarURL']                = 'Legt die URL für Libravatar (oder eine kompatible API) fest <br/> <strong>HINWEIS:</strong> <br/> - <code>https://seccdn.libravatar.org/avatar</code> (https) <br/> - <code>http://cdn.libravatar.org/avatar</code> (http)';
$lang['navbarLabels']                 = 'Zeige/verberge Labels';
$lang['notifyExtensionsUpdate']       = 'Benachrichtigung über Erweiterungsupdates (für Administratorenbenutzer)';
$lang['office365URL']                 = 'Legt die Microsoft Office 365- (oder EWS) URL fest <br/> <strong>HINWEIS:</strong> Für diesen Dienst ist eine Anmeldung erforderlich. Daher ist dieser Fall in einer Unternehmensinstallation am nützlichsten, in der alle Benutzer Zugriff auf Office 365 haben';
$lang['pageIcons']                    = 'Wähle die Icons die angezeigt werden solle';
$lang['pageInfo']                     = 'Zeige/Verberge Seiten Info Elemente';
$lang['pageInfoDateFormat']           = 'Datum Format';
$lang['pageInfoDateFormat_o_dformat'] = 'DokuWiki Format';
$lang['pageInfoDateFormat_o_human']   = 'Menschenlesbares Format';
$lang['pageOnPanel']                  = 'Aktiviert einen Rahmen um die Seite';
$lang['rightSidebar']                 = 'Seitenname der rechten Sidebar, ein leeres Feld deaktiviert die Sidebar.<br/>Die rechte Sidebar wird nur angezeigt wenn die Standard DokuWiki <a class="interwiki iw_doku" href="#config___sidebar">Sidebar</a> aktiviert ist und sich auf der <code>linken</code> Seite befindet (Siehe <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a> Einstellung). Wenn nur die Sidebar auf der rechten Seite aktiv sein soll, setze die <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a> Einstellung auf den Wert <code>rechts</code>';
$lang['rightSidebarGrid']             = 'Rechte Seitenleiste Raster Klasse <code>col-{xs,sm,md,lg}-x</code> (siehe <a href="http://holdirbootstrap.de/css/#grid" target="_blank">Bootstrap Raster-System</a> Dokumentation)';
$lang['schemaOrgType']                = 'Schema.org Typ (<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>, <code>Recipe</code>)';
$lang['semantic']                     = 'Aktiviert Semantischen Daten';
$lang['showAddNewPage']               = 'Aktiviert das Plug-In "Neue Seite hinzufügen" in der Navigationsleiste (benötigt das <em>Neue Seite hinzufügen Plugin</em>)';
$lang['showAddNewPage_o_always']      = 'immer';
$lang['showAddNewPage_o_logged']      = 'Wenn angemeldet';
$lang['showAddNewPage_o_never']       = 'Niemals';
$lang['showAdminMenu']                = 'Zeigt das Administrationsmenü';
$lang['showBadges']                   = 'Zeige Links im Fußbereich (DokuWiki, Spenden, etc.)';
$lang['showCookieLawBanner']          = 'Zeigt den Cookie-Gesetz Banner im Fußbereich';
$lang['showDiscussion']               = 'Zeigt den Diskussionslink im Werkzeug Menü';
$lang['showEditBtn']                  = 'Zeigt die Bearbeiten Schaltfläche in der Navigationsleiste';
$lang['showEditBtn_o_always']         = 'Immer';
$lang['showEditBtn_o_logged']         = 'Wenn angemeldet';
$lang['showEditBtn_o_never']          = 'Niemals';
$lang['showHomePageLink']             = 'Zeige den Hompage-Link in der Navbar';
$lang['showIndividualTool']           = 'Aktiviere/Deaktiviere individuelle Werkzeuge in der Navigationsleiste';
$lang['showLandingPage']              = 'Aktiviere die "Landing-Page" (ohne eine Seitenleiste und die Umrandung der Seite)';
$lang['showLoginOnFooter']            = 'Zeigt einen kleinen Loogin-Link im Fußbereich der Seite. Dies ist nützlich wenn die Funktion <code>hideLoginLink</code> aktiviert ist.';
$lang['showNavbar']                   = 'Zeige die Navbar';
$lang['showNavbar_o_always']          = 'Immer';
$lang['showNavbar_o_logged']          = 'Wenn angemeldet';
$lang['showPageIcons']                = 'Zeige nützliche Icons (drucken, Link teilen, E-Mail senden, etc.) auf der Seite';
$lang['showPageId']                   = 'Zeigt den DokuWiki Seitennamen (pageld) im oberen Bereich';
$lang['showPageInfo']                 = 'Zeige Seiteninformationen (zB. Datum, Autor)';
$lang['showPageTools']                = 'Aktiviere die Seiten Werkzeuge im DokuWiki Style';
$lang['showPageTools_o_always']       = 'Immer';
$lang['showPageTools_o_logged']       = 'Wenn angemeldet';
$lang['showPageTools_o_never']        = 'Nie';
$lang['showSearchForm']               = 'Zeigt das Suchformular in der Navigationsleiste';
$lang['showSearchForm_o_always']      = 'Immer';
$lang['showSearchForm_o_logged']      = 'Wenn angemeldet';
$lang['showSearchForm_o_never']       = 'Nie';
$lang['showSemanticPopup']            = 'Zeigt ein Popup mit einem Auszug der Seite an, wenn der Benutzer mit der Maus über einen Wikilink fährt. (benötigt das <em>Semantic Plugin</em>)';
$lang['showThemeSwitcher']            = 'Zeigt den Bootswatch.com Design Umschalter in der Navigationsleiste';
$lang['showTools']                    = 'Zeigt die Werkzeuge in der Navigationsleiste';
$lang['showTools_o_always']           = 'Immer';
$lang['showTools_o_logged']           = 'Wenn angemeldet';
$lang['showTools_o_never']            = 'Nie';
$lang['showTranslation']              = 'Zeige die Übersetzungstoolbar (benötigt das <em>Translation Plugin</em>)';
$lang['showUserHomeLink']             = 'Zeigt den Link zur Benutzerseite in der Navigationsleiste.';
$lang['showWikiInfo']                 = 'Zeige DokuWiki <a class="interwiki iw_doku" href="#config___title">Namen</a>, Logo und <a class="interwiki iw_doku" href="#config___tagline">Slogan</a> im Fußbereich der Seite';
$lang['sidebarOnNavbar']              = 'Zeige die Inhalte der Seitenleiste in der Navigationsleiste. (Nützlich für kleine Endgeräte wie Telefon oder Tablet)';
$lang['sidebarPosition']              = 'Position der DokuWiki Seitenleiste (<code>links</code> oder <code>rechts</code>)';
$lang['sidebarShowPageTitle']         = 'Seitentitel anzeigen';
$lang['socialShareProviders']         = 'Wähle die Social Media Icons die angezeigt werden sollen';
$lang['tableFullWidth']               = 'Aktiviere 100% Tabellenbreite (Bootstrap Standard)';
$lang['tableStyle']                   = 'Tabellendesign';
$lang['tagsOnTop']                    = 'Verschiebt alle Schlagworte von der Oberseite neben die Seiten Bezeichnung (benötigt das <em>Tag Plugin</em>)';
$lang['themeByNamespace']             = 'Use a namespaced theme';
$lang['tocAffix']                     = 'Zeigt das Inhaltsverzeichnis (TOC) während des scrollens';
$lang['tocCollapseOnScroll']          = 'Öffne/schliesse das Inhaltsverzeichnis (TOC) beim Scrollen der Seite.';
$lang['tocCollapseSubSections']       = 'Schließt alle Unterpunkte in TOC um Platz zu sparen';
$lang['tocCollapsed']                 = 'Inhaltsverzeichnis auf allen Seiten schließen';
$lang['tocPosition']                  = 'Position des Inhaltsverzeichnisses (TOC)';
$lang['tocLayout']                    = 'Layout des Inhaltsverzeichnisses';
$lang['useACL']                       = 'Benutze die ACL für die Sidebar (links oder rechts) und für alle DokuWiki Bereiche (wie <code>:footer</code>, <code>:navbar</code>, usw.) <br/> <strong>Hinweis:</strong> Verfügbar ab DokuWiki Version "Elenor of Tsort"';
$lang['useAlternativeToolbarIcons']   = 'Verwendet die alternativen "Material Design" Icons für die DokuWiki-Symbolleiste';
$lang['useAnchorJS']                  = 'Benutze AnchorJS';
$lang['useAvatar']                    = 'Läd das Avatar-Bild aus Gravatar, Libravatar, Microsoft Office365 oder dem lokalen DokuWiki <code>:user</code> Namensraum';
$lang['useAvatar_o_gravatar']         = 'Gravatar';
$lang['useAvatar_o_libravatar']       = 'Libravatar';
$lang['useAvatar_o_local']            = 'DokuWiki :user Namensraum';
$lang['useAvatar_o_off']              = 'Aus';
$lang['useAvatar_o_office365']        = 'Office365 (oder EWS)';
$lang['useAvatar_o_activedirectory']  = 'Active Directory';
$lang['useGoogleAnalytics']           = 'Aktiviere Google Analytics';
$lang['useLegacyNavbar']              = 'Verwende die veraltete <code>navbar.html</code> Methode (Denke daran, in Zukunft die <code>:navbar</code> Methode zu verwenden).';
