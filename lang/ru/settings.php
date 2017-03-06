<?php
/**
 * Russian Language file for config
 *
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @author   Andrey Shpak
 * @author   Vadim Balabin
 * @author   Александр Бакунович
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$lang['bootstrapTheme']               = 'Выберите графическую тему (Bootstrap оригинальная, Bootstrap дополнительная, темы Bootswatch.com или графическая тема по выбору)';
$lang['bootstrapTheme_o_bootswatch']  = 'Темы Bootswatch.com';
$lang['bootstrapTheme_o_custom']      = 'Графическая тема по выбору';
$lang['bootstrapTheme_o_default']     = 'Bootstrap оригинальная';
$lang['bootstrapTheme_o_optional']    = 'Необязательные Bootsrap темы';
$lang['bootswatchTheme']              = 'Выберите графическую тему Bootswatch.com';
$lang['browserTitle']                 = 'DokuWiki browser title (default is <code>@TITLE@ [@WIKI@]</code>, where <code>@TITLE@</code> placeholder replace the current page title and <code>@WIKI@</code> replace the DokuWiki name) - see <a class="interwiki iw_doku" href="#config___title">title</a> config';
$lang['browserTitleCharSepNS']        = 'Character separator for every namespaces on browser title';
$lang['browserTitleOrderNS']          = 'Set the order of namespaces';
$lang['browserTitleShowNS']           = 'Display the previous page name of current page on the browser title';
$lang['collapsibleSections']          = 'Сворачивать заголовки 2ого уровня (полезно для мобильных устройств)';
$lang['cookieLawBannerPage']          = 'Cookie Law banner page name';
$lang['cookieLawPolicyPage']          = 'Cookie Law policy page name';
$lang['customTheme']                  = 'Вставьте адрес графической темы по выбору';
$lang['discussionPage']               = 'Ссылка на страницу обсуждения (по умолчанию<code>discussion:@ID@</code>, где <code>@ID@</code> автоматически заменяется именем текущей страницы), пустое поле выключает функционал';
$lang['fixedTopNavbar']               = 'Зафиксировать панель навигации сверху';
$lang['fluidContainer']               = 'Разрешить плавающий контейнер(страница во весь экран)';
$lang['fluidContainerBtn']            = 'Display a button in navbar to expand container';
$lang['googleAnalyticsAnonymizeIP']   = 'Anonymize the IP address of visitors';
$lang['googleAnalyticsNoTrackAdmin']  = 'Отключить слежение для Администраторов';
$lang['googleAnalyticsNoTrackPages']  = 'Отключить слежение для следующих страниц (используйте регулярные выражения)';
$lang['googleAnalyticsNoTrackUsers']  = 'Отключить слежение для всех вошедших пользователей';
$lang['googleAnalyticsTrackActions']  = 'Track DokuWiki actions (edit, search, etc)';
$lang['googleAnalyticsTrackID']       = 'Tracking ID';
$lang['hideInThemeSwitcher']          = 'Hide themes in theme switcher';
$lang['hideLoginLink']                = 'Hide the login button in navbar. This option is useful in "read-only" DokuWiki installations (eg. blog, personal website)';
$lang['individualTools']              = 'Split the Tools in individual menu in navbar';
$lang['inverseNavbar']                = 'Инверсия цвета меню навигации';
$lang['landingPages']                 = 'Landing page name (insert a regex)';
$lang['leftSidebarGrid']              = 'Left sidebar grid classes <code>col-{xs,sm,md,lg}-x</code> (see <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grids</a> documentation)';
$lang['navbarLabels']                 = 'Show/Hide individual label';
$lang['pageIcons']                    = 'Выбрать иконку для отображения';
$lang['pageInfo']                     = 'Display/Hide page info elements';
$lang['pageInfoDateFormat']           = 'Формат даты';
$lang['pageInfoDateFormat_o_dformat'] = 'DokuWiki формат';
$lang['pageInfoDateFormat_o_human']   = 'Human readable';
$lang['pageOnPanel']                  = 'Включить рамку вокруг страницы';
$lang['pageToolsAnimation']           = 'Enable the Page Tools animation';
$lang['rightSidebar']                 = 'The Right Sidebar page name, empty field disables the right sidebar.<br/>The Right Sidebar is displayed only when the default DokuWiki <a class="interwiki iw_doku" href="#config___sidebar">sidebar</a> is enabled and is on the <code>left</code> position (see the <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a> configuration). If do you want only the DokuWiki sidebar on right position, set the <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a> configuration with <code>right</code> value';
$lang['rightSidebarGrid']             = 'Right sidebar grid classes <code>col-{xs,sm,md,lg}-x</code> (see <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grids</a> documentation)';
$lang['schemaOrgType']                = 'Schema.org type (<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>, <code>Recipe</code>)';
$lang['semantic']                     = 'Включить семантические данные Schema.org. Для полной поддержи требуется установка <a href="https://www.dokuwiki.org/plugin:semantic">плагина</a>';
$lang['showAddNewPage']               = 'Enable the Add New Page plugin in navbar  (require <em>Add New Page Plugin</em>)';
$lang['showAddNewPage_o_always']      = 'Always';
$lang['showAddNewPage_o_logged']      = 'When logged in';
$lang['showAddNewPage_o_never']       = 'Never';
$lang['showAdminMenu']                = 'Отображать меню Администрирование';
$lang['showBadges']                   = 'Отображать значки внизу страницы (DokuWiki, Donate, и т.д.)';
$lang['showCookieLawBanner']          = 'Display the Cookie Law banner on footer';
$lang['showDiscussion']               = 'Отображать ссылку на обсуждения в меню инструментов';
$lang['showEditBtn']                  = 'Display edit button in navbar';
$lang['showEditBtn_o_always']         = 'Always';
$lang['showEditBtn_o_logged']         = 'When logged in';
$lang['showEditBtn_o_never']          = 'Never';
$lang['showHomePageLink']             = 'Отображать ссылку на Домашнюю страницу в меню навигации';
$lang['showIndividualTool']           = 'Enable/Disable individual tool in navbar';
$lang['showLandingPage']              = 'Enable the landing page (without a sidebar and the panel around the page)';
$lang['showLoginOnFooter']            = 'Display a "little" login link on footer. This option is useful when <code>hideLoginLink</code> is on';
$lang['showNavbar']                   = 'Display navbar hook';
$lang['showNavbar_o_always']          = 'Всегда';
$lang['showNavbar_o_logged']          = 'When logged in';
$lang['showPageIcons']                = 'Отображать значки (печать, поделиться, отправить почту, и т.д.) на странице';
$lang['showPageId']                   = 'Display the DokuWiki page name (pageId) on top';
$lang['showPageInfo']                 = 'Отображать информацию о странице (например, дата, автор)';
$lang['showPageTools']                = 'Enable the DokuWiki-style Page Tools';
$lang['showPageTools_o_always']       = 'Всегда';
$lang['showPageTools_o_logged']       = 'When logged in';
$lang['showPageTools_o_never']        = 'Никогда';
$lang['showSearchButton']             = 'Display search button in navbar';
$lang['showSearchForm']               = 'Отображать форму поиска в меню навигации';
$lang['showSearchForm_o_always']      = 'Всегда';
$lang['showSearchForm_o_logged']      = 'When logged in';
$lang['showSearchForm_o_never']       = 'Никогда';
$lang['showSemanticPopup']            = 'Display a popup with an extract of the page when the user hover on wikilink (require <em>Semantic Plugin</em>)';
$lang['showThemeSwitcher']            = 'Отображать выбор тем Bootswatch.com в панели навигации';
$lang['showTools']                    = 'Отображение инструментов в панели навигации';
$lang['showTools_o_always']           = 'Всегда';
$lang['showTools_o_logged']           = 'Для вошедших пользователей';
$lang['showTools_o_never']            = 'Никогда';
$lang['showTranslation']              = 'Отображать языковую панель (требует установки <a href="https://www.dokuwiki.org/plugin:Translation">плагина</a>)';
$lang['showUserHomeLink']             = 'Display User Home-Page link in navbar';
$lang['sidebarOnNavbar']              = 'Display the sidebar contents inside the navbar';
$lang['sidebarPosition']              = 'Позиция боковой панели DokuWiki (<code>слева</code> или <code>справа</code>)';
$lang['sidebarShowPageTitle']         = 'Display Sidebar page title';
$lang['socialShareProviders']         = 'Select the social share links to display';
$lang['tableFullWidth']               = 'Разрешить таблицы в 100% ширину';
$lang['tableStyle']                   = 'Table style';
$lang['tagsOnTop']                    = 'Move all Tags on top of the page, beside the page-id (require <em>Tag Plugin</em>)';
$lang['themeByNamespace']             = 'Use a namespaced theme';
$lang['tocAffix']                     = 'Affix the TOC during page scrolling';
$lang['tocCollapseOnScroll']          = 'Collapse TOC during page scrolling';
$lang['tocCollapseSubSections']       = 'Collapse all sub-sections in TOC to save space';
$lang['tocCollapsed']                 = 'Collapse TOC on every pages';
$lang['tocPosition']                  = 'TOC position';
$lang['useACL']                       = 'Use ACL for sidebars (left and right) and for all DokuWiki hooks (eg. <code>:footer</code>, <code>:navbar</code>, etc.) <br/> <strong>NOTE:</strong> Available since "Elenor of Tsort" release';
$lang['useAnchorJS']                  = 'Use AnchorJS';
$lang['useGoogleAnalytics']           = 'Enable Google Analytics';
$lang['useGravatar']                  = 'Load Gravatar image';
$lang['useLegacyNavbar']              = 'Use legacy and deprecated <code>navbar.html</code> hook (consider in the future to use the <code>:navbar</code> hook)';
$lang['useLocalBootswatch']           = 'Use the local Bootswatch directory. This option is useful in "intranet" DokuWiki installation';

