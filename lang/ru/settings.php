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
$lang['browserTitle']                 = 'Заголовок страниц в браузере (по умолчанию <code>@TITLE@ [@WIKI@]</code>, где <code>@TITLE@</code> заменяется на название текущей страницы и <code>@WIKI@</code> заменяется на имя DokuWiki) - см. настройку <a class="interwiki iw_doku" href="#config___title">title</a>';
$lang['browserTitleCharSepNS']        = 'Разделитель для каждого пространства имен в заголовке';
$lang['browserTitleOrderNS']          = 'Установить порядок пространства имен';
$lang['browserTitleShowNS']           = 'Отображать предыдущее название страницы на текущей, в заголовке';
$lang['collapsibleSections']          = 'Collapse 2nd section level (useful in mobile/tablet devices)';
$lang['cookieLawBannerPage']          = 'Страница, которая содержит текст для баннера "закон о cookie файлах"';
$lang['cookieLawPolicyPage']          = 'Страница, которая содержит политику "закон о cookie файлах"';
$lang['customTheme']                  = 'Вставьте адрес графической темы по выбору';
$lang['discussionPage']               = 'Ссылка на страницу обсуждения (по умолчанию<code>discussion:@ID@</code>, где <code>@ID@</code> автоматически заменяется именем текущей страницы), пустое поле выключает функционал';
$lang['domParserMaxPageSize']         = 'Set the max size of the page content for DOM Parser. The optimal and default value is <code>600000</code> (600KB)';
$lang['fixedTopNavbar']               = 'Зафиксировать панель навигации сверху';
$lang['fluidContainer']               = 'Разрешить плавающий контейнер(страница во весь экран)';
$lang['fluidContainerBtn']            = 'Отображать кнопку "расширить страницу" в панели навигации';
$lang['googleAnalyticsAnonymizeIP']   = 'Игнорировать IP-адреса посетителей';
$lang['googleAnalyticsNoTrackAdmin']  = 'Отключить слежение для Администраторов';
$lang['googleAnalyticsNoTrackPages']  = 'Отключить слежение для следующих страниц (используйте регулярные выражения)';
$lang['googleAnalyticsNoTrackUsers']  = 'Отключить слежение для всех вошедших пользователей';
$lang['googleAnalyticsTrackActions']  = 'Отслеживать действия DokuWiki (редактирование, поиск и т.д.)';
$lang['googleAnalyticsTrackID']       = 'Код отслеживания';
$lang['gravatarURL']                  = 'Set Gravatar URL <br/> <strong>NOTE:</strong> <br/> - <code>http://www.gravatar.com/avatar</code> (http) <br/> - <code>https://secure.gravatar.com/avatar</code> (https) <br/> - <code>https://www.gravatar.com/avatar</code> (alternative https)';
$lang['hideInThemeSwitcher']          = 'Спрятать темы в переключателе';
$lang['hideLoginLink']                = 'Спрятать кнопку входа в панели навигации. Эта опция полезна для вики типа "только для чтения" (например: блог, персональный сайт)';
$lang['homePageURL']                  = 'Use custom URL for home-page links';
$lang['individualTools']              = 'Разделить настройки на индивидуальные меню в панели навигации';
$lang['inverseNavbar']                = 'Инверсия цвета меню навигации';
$lang['landingPages']                 = 'Имена целевых страниц (используются регулярные выражения)';
$lang['leftSidebarGrid']              = 'Класс сеточной системы для левого бокового меню <code>col-{xs,sm,md,lg}-x</code> (см. <a href="http://getbootstrap.com/css/#grid" target="_blank">Сетки Bootstrap</a>)';
$lang['libravatarURL']                = 'Set Libravatar (or compatible API) URL <br/> <strong>NOTE:</strong> <br/> - <code>https://seccdn.libravatar.org/avatar</code> (https) <br/> - <code>http://cdn.libravatar.org/avatar</code> (http)';
$lang['navbarLabels']                 = 'Показать/спрятать наименования для индивидуального меню';
$lang['office365URL']                 = 'Set Microsoft Office 365 (or EWS) URL <br/> <strong>NOTE:</strong> This service requires login, so this use case is most useful in a corporate installation, where all users have access to Office 365.';
$lang['pageIcons']                    = 'Выбрать иконку для отображения';
$lang['pageInfo']                     = 'Показать/спрятать элементы информации о странице';
$lang['pageInfoDateFormat']           = 'Формат даты';
$lang['pageInfoDateFormat_o_dformat'] = 'DokuWiki формат';
$lang['pageInfoDateFormat_o_human']   = 'Человекочитаемый';
$lang['pageOnPanel']                  = 'Включить рамку вокруг страницы';
$lang['pageToolsAnimation']           = 'Включить анимацию иконок для DokuWiki инструментов страницы';
$lang['rightSidebar']                 = 'Имя страницы правой боковой панели, пустое поле - отключить правую боковую панель.<br/>Правая боковая панель только тогда, когда стандартная <a class="interwiki iw_doku" href="#config___sidebar">боковая панель</a> DokuWiki включена и находится <code>слева</code> (см. опцию <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a>). Если Вы только хотите переместить боковую панель DokuWiki на правую сторону, то измените  значение <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a> на <code>right</code>';
$lang['rightSidebarGrid']             = 'Класс сеточной системы для правого бокового меню <code>col-{xs,sm,md,lg}-x</code> (см. <a href="http://getbootstrap.com/css/#grid" target="_blank">Сетки Bootstrap</a>)';
$lang['schemaOrgType']                = 'Тип Schema.org(<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>, <code>Recipe</code>)';
$lang['semantic']                     = 'Включить семантические данные Schema.org. Для полной поддержи требуется установка <a href="https://www.dokuwiki.org/plugin:semantic">плагина</a>';
$lang['showAddNewPage']               = 'Включить плагин "Add New Page" в панель навигации (требуется плагин <em>Add New Page</em>)';
$lang['showAddNewPage_o_always']      = 'Всегда';
$lang['showAddNewPage_o_logged']      = 'Когда авторизован';
$lang['showAddNewPage_o_never']       = 'Никогда';
$lang['showAdminMenu']                = 'Отображать меню Администрирование';
$lang['showBadges']                   = 'Отображать значки внизу страницы (DokuWiki, Donate, и т.д.)';
$lang['showCookieLawBanner']          = 'Отображать баннер "закон о cookie файлах" в нижней части';
$lang['showDiscussion']               = 'Отображать ссылку на обсуждения в меню инструментов';
$lang['showEditBtn']                  = 'Отображать кнопку редактирования в панели навигации';
$lang['showEditBtn_o_always']         = 'Всегда';
$lang['showEditBtn_o_logged']         = 'Когда авторизован';
$lang['showEditBtn_o_never']          = 'Никогда';
$lang['showHomePageLink']             = 'Отображать ссылку на Домашнюю страницу в меню навигации';
$lang['showIndividualTool']           = 'Включить/отключить индивидуальные меню в панели навигации';
$lang['showLandingPage']              = 'Включить целевые страницы (без боковых панелей и панелей вокруг страницы)';
$lang['showLoginOnFooter']            = 'Отображать "маленькую" кнопку в нижней части страниц. Эта опция полезна при включенной опции <code>hideLoginLink</code>';
$lang['showNavbar']                   = 'Отображать боковую панель';
$lang['showNavbar_o_always']          = 'Всегда';
$lang['showNavbar_o_logged']          = 'Когда авторизован';
$lang['showPageIcons']                = 'Отображать значки (печать, поделиться, отправить почту, и т.д.) на странице';
$lang['showPageId']                   = 'Отображать имя (ид) страницы DokuWiki сверху';
$lang['showPageInfo']                 = 'Отображать информацию о странице (например, дата, автор)';
$lang['showPageTools']                = 'Показывать DokuWiki инструменты страницы';
$lang['showPageTools_o_always']       = 'Всегда';
$lang['showPageTools_o_logged']       = 'Когда авторизован';
$lang['showPageTools_o_never']        = 'Никогда';
$lang['showPurgePageCache']           = 'Display the "Purge Cache Page" button in Page Tools';
$lang['showPurgePageCache_o_always']  = 'Always';
$lang['showPurgePageCache_o_logged']  = 'When logged in';
$lang['showPurgePageCache_o_never']   = 'Never';
$lang['showSearchForm']               = 'Отображать форму поиска в меню навигации';
$lang['showSearchForm_o_always']      = 'Всегда';
$lang['showSearchForm_o_logged']      = 'Когда авторизован';
$lang['showSearchForm_o_never']       = 'Никогда';
$lang['showSemanticPopup']            = 'Показывать всплывающее окно с фрагментом страницы, когда пользователь наводит на вики-ссылку (требуется плагин <em>Semantic</em)';
$lang['showThemeSwitcher']            = 'Отображать выбор тем Bootswatch.com в панели навигации';
$lang['showTools']                    = 'Отображение инструментов в панели навигации';
$lang['showTools_o_always']           = 'Всегда';
$lang['showTools_o_logged']           = 'Для вошедших пользователей';
$lang['showTools_o_never']            = 'Никогда';
$lang['showTranslation']              = 'Отображать языковую панель (требует установки <a href="https://www.dokuwiki.org/plugin:Translation">плагина</a>)';
$lang['showUserHomeLink']             = 'Показывать кнопку "Домашняя страница пользователя" в панели навигации';
$lang['showWikiInfo']                 = 'Display DokuWiki <a class="interwiki iw_doku" href="#config___title">name</a>, logo and <a class="interwiki iw_doku" href="#config___tagline">tagline</a> on footer';
$lang['sidebarOnNavbar']              = 'Display the sidebar contents inside the navbar (useful on mobile/tablet devices)';
$lang['sidebarPosition']              = 'Позиция боковой панели DokuWiki (<code>слева</code> или <code>справа</code>)';
$lang['sidebarShowPageTitle']         = 'Отображать заголовок для навигационной панели';
$lang['socialShareProviders']         = 'Выберите социальные ссылки для отображения';
$lang['tableFullWidth']               = 'Разрешить таблицы в 100% ширину';
$lang['tableStyle']                   = 'Стиль таблиц';
$lang['tagsOnTop']                    = 'Переместить все теги в верхнюю часть страницы, рядом с идом страницы (требуется плагин <em>Tag</em>)';
$lang['themeByNamespace']             = 'Использовать тему в соответствии с пространством имён';
$lang['tocAffix']                     = 'Закрепить оглавление во время прокрутки страницы';
$lang['tocCollapseOnScroll']          = 'Сворачивать оглавление при прокрутке страницы';
$lang['tocCollapseSubSections']       = 'Сворачивать все подсекции в оглавлении для сохранения места';
$lang['tocCollapsed']                 = 'Сворачивать оглавление на каждой странице';
$lang['tocPosition']                  = 'Позиция оглавления';
$lang['tocLayout']                    = 'TOC layout';
$lang['useACL']                       = 'Use ACL for sidebars (left and right) and for all DokuWiki hooks (eg. <code>:footer</code>, <code>:navbar</code>, etc.) <br/> <strong>NOTE:</strong> Available since "Elenor of Tsort" DokuWiki release';
$lang['useAnchorJS']                  = 'Использовать AnchorJS';
$lang['useAvatar']                    = 'Load the avatar image from Gravatar, Libravatar, Microsoft Office365 or local DokuWiki <code>:user</code> namespace';
$lang['useAvatar_o_gravatar']         = 'Gravatar';
$lang['useAvatar_o_libravatar']       = 'Libravatar';
$lang['useAvatar_o_local']            = 'DokuWiki :user namespace';
$lang['useAvatar_o_off']              = 'Off';
$lang['useAvatar_o_office365']        = 'Office365 (or EWS)';
$lang['useGoogleAnalytics']           = 'Включить Google Analytics';
$lang['useLegacyNavbar']              = 'Использовать устаревший хук <code>navbar.html</code> (вместо хука <code>:navbar</code>)';
$lang['useLocalBootswatch']           = 'Использовать локальную директорию Bootswatch. Эта опция полезна для Dokuwiki используемая в интрасети';

