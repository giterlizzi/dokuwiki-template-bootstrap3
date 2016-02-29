<?php
/**
 * Polish Language file for config
 *
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @author   Aleksander Setlak
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$lang['discussionPage']      = 'Nazwa strony dyskusji (domyślnie <code>discussion:@ID@</code>, gdzie <code>@ID@</code> zastępuje obecną nazwę strony), puste pole wyłącza link';
$lang['showDiscussion']      = 'Wyświetl link do dyskusji w menu narzędzi';
$lang['showLoginOnFooter']   = 'Wyświetl w stopce mały link logowania. Ta opcja jest użyteczna gdy <code>hideLoginLink</code> jest włączone';
$lang['hideLoginLink']       = 'Ukryj przycisk logowania na pasku nawigacyjnym. Ta opcja jest użyteczna w instalacjach DokuWiki  „tylko do odczytu” (np. blog, strona prywatna)';
$lang['showUserHomeLink']    = 'Wyświetl w pasku nawigacyjnym link od Strony domowej Użytkownika';
$lang['showCookieLawBanner'] = 'Wyświetl w stopce baner Polityki plików cookies';
$lang['cookieLawBannerPage'] = 'Nazwa strony banera Polityki plików cookies';
$lang['cookieLawPolicyPage'] = 'Nazwa strony Polityki plików cookies';
$lang['browserTitle']        = 'Tytuł DokuWiki w przeglądarce (domyślnie <code>@TITLE@ [@WIKI@]</code>, gdzie <code>@TITLE@</code> oznacza tytuł strony a <code>@WIKI@</code> tytuł  DokuWiki) - zobacz konfigurację <a class="interwiki iw_doku" href="#config___title">title</a>';
$lang['showIndividualTool']  = 'Włącz/wyłącz poszczególne narzędzia w pasku nawigacyjnym';
$lang['showTools']           = 'Wyświetl Narzędzia w pasku nawigacyjnym';
$lang['individualTools']     = 'Rozdziel Narzędzia w indywidualnym menu w pasku nawigacyjnym';
$lang['showTools_o_never']   = 'Nigdy';
$lang['showTools_o_logged']  = 'Gdy zalogowany';
$lang['showTools_o_always']  = 'Zawsze';
$lang['showSearchForm']      = 'Wyświetl wyszukiwarkę w pasku nawigacyjnym';
$lang['showSearchForm_o_never']  = 'Nigdy';
$lang['showSearchForm_o_logged'] = 'Gdy zalogowany';
$lang['showSearchForm_o_always'] = 'Zawsze';
$lang['sidebarPosition']     = 'Pozycja Paska bocznego DokuWiki (<code>left</code> - lewo  lub <code>right</code> - prawo)';
$lang['rightSidebar']        = 'Nazwa Prawego Paska bocznego, puste pole wyłącza prawy pasek boczny.<br/>Prawy pasek boczny jest wyświetlany tylko wtedy gdy domyślny <a href="#config___sidebar">pasek boczny</a> jest włączony i jest ustawiony w pozycji <code>left</code> (zobacz: konfiguracja<a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a>). Jeśli chcesz tylko pasek boczny DokuWiki z prawej strony, ustaw konfigurację  <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a>  na <code>right</code>';
$lang['tableFullWidth']      = 'Włącz pełną szerokość tabeli 100% (domyślnie w Bootstrap)';
$lang['semantic']            = 'Włącz dane semantyczne';
$lang['schemaOrgType']       = 'Typ Schema.org (<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>)';
$lang['showTranslation']     = 'Wyświetl Pasek narzędzi tłumaczenia (wymaga <em>Translation Plugin</em>)';
$lang['showAdminMenu']       = 'Wyświetl menu Administracja';
$lang['inverseNavbar']       = 'Odwrócony Pasek nawigacyjny';
$lang['fixedTopNavbar']      = 'Ustaw Pasek nawigacyjny u góry';
$lang['fluidContainer']      = 'Włącz płynny kontener (pełna szerokości strony)';
$lang['fluidContainerBtn']   = 'Wyświetl w Pasku nawigacyjnym przycisk rozwijania kontenera';
$lang['pageOnPanel']         = 'Włącz panel wokół strony';
$lang['bootstrapTheme']      = 'Motyw Bootstrap';
$lang['bootstrapTheme_o_default']    = 'Motyw Vanilla Bootstrap';
$lang['bootstrapTheme_o_optional']   = 'Opcjonalny motyw Bootstrap';
$lang['bootstrapTheme_o_custom']     = 'Dostosowany motyw Bootstrap';
$lang['bootstrapTheme_o_bootswatch'] = 'Motyw Bootswatch.com';
$lang['customTheme']         = 'Wstaw URL dostosowanego motywu';
$lang['bootswatchTheme']     = 'Wybierz motyw z Bootswatch.com';
$lang['showThemeSwitcher']   = 'Pokaż w Pasku nawigacyjnym przełącznik motywów Bootswatch.com';
$lang['hideInThemeSwitcher'] = 'Ukryj motywy w przełączniku motywów';
$lang['showPageInfo']        = 'Pokaż informacje o stronie (np.: data, autor)';
$lang['showBadges']          = 'Pokaż przyciski odznak (DokuWiki, Donate, itp.)';
$lang['leftSidebarGrid']     = 'Klasy lewego paska bocznego <code>col-{xs,sm,md,lg}-x</code> (zobacz dokumentację <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grids</a>)';
$lang['rightSidebarGrid']    = 'Klasy prawego paska bocznego <code>col-{xs,sm,md,lg}-x</code> (zobacz dokumentację <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grids</a>)';
$lang['useGravatar']         = 'Ładuj Gravatar';
$lang['showLandingPage']     = 'Włącz Stronę produktową (bez paska bocznego i panelu wokół strony)';
$lang['landingPages']        = 'Nazwa Strony produktowej (wstaw regex)';
$lang['showPageTools']    = 'Wyświetl Narzędzia Strony w stylu DokuWiki';
$lang['showPageTools_o_never']   = 'Nigdy';
$lang['showPageTools_o_logged']  = 'Gdy zalogowany';
$lang['showPageTools_o_always']  = 'Zawsze';
$lang['useLocalBootswatch']  = 'Użyj lokalnego katalogu Bootswatch. Ta opcja jest przydatna w „intranetowych” instalacjach DokuWiki';
$lang['tableStyle']          = 'Styl tabeli';
$lang['tagsOnTop']           = 'Przenieś Tagi na górę strony, obok page-id (wymaga <em>Tag Plugin</em>)';
$lang['showPageId']          = 'Wyświetl na górze nazwę strony DokuWiki (pageId)';
$lang['useAnchorJS']         = 'Użyj AnchorJS';
$lang['showHomePageLink']    = 'Wyświetl link do Strony głównej w pasku nawigacyjnym';
$lang['useLegacyNavbar']     = 'Użyj dziedziczonego i przestarzałego haka "navbar.html" (rozważ w przyszłości używanie haka ": navbar")';
$lang['browserTitleCharSepNS'] = 'Znak separatora dla każdej nazwy w tytule przeglądarki';
$lang['browserTitleShowNS']    = 'Wyświetlaj w tytule przeglądarki nazwę strony poprzedzającą aktualną stronę';
$lang['browserTitleOrderNS']   = 'Ustaw kolejność nazw';
$lang['tocCollapseSubSections'] = 'Aby zaoszczędzić miejsce, zwiń wszystkie podsekcje w Spisie treści';
