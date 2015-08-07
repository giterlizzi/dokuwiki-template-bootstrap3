<?php
/**
 * Language file for config
 *
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$lang['discussionPage']      = 'Ссылка на страницу обсуждения (по умолчанию<code>discussion:@ID@</code>, где <code>@ID@</code> автоматически заменяется именем текущей страницы), пустое поле выключает функционал';
$lang['showDiscussion']      = 'Отображать ссылку на обсуждения в меню инструментов';
$lang['showLoginOnFooter']   = 'Display a "little" login link on footer. This option is useful when <code>hideLoginLink</code> is on';
$lang['hideLoginLink']       = 'Hide the login button in navbar. This option is useful in "read-only" DokuWiki installations (eg. blog, personal website)';
$lang['showUserHomeLink']    = 'Display User Home-Page link in navbar';
$lang['showCookieLawBanner'] = 'Display the Cookie Law banner on footer';
$lang['cookieLawBannerPage'] = 'Cookie Law banner page name';
$lang['cookieLawPolicyPage'] = 'Cookie Law policy page name';
$lang['browserTitle']        = 'DokuWiki browser title (default is <code>@TITLE@ [@WIKI@]</code>, where <code>@TITLE@</code> placeholder replace the current page title and <code>@WIKI@</code> replace the DokuWiki name - see <a href="#config___title">title</a> config';
$lang['showIndividualTool']  = 'Enable/Disable individual tool in navbar';
$lang['showTools']           = 'Отображение инструментов в панели навигации';
$lang['individualTools']     = 'Split the Tools in individual menu in navbar';
$lang['showTools_o_never']   = 'Никогда';
$lang['showTools_o_logged']  = 'Для вошедших пользователей';
$lang['showTools_o_always']  = 'Всегда';
$lang['showSearchForm']      = 'Display Search form in navbar';
$lang['showSearchForm_o_never']  = 'Never';
$lang['showSearchForm_o_logged'] = 'When logged in';
$lang['showSearchForm_o_always'] = 'Always';
$lang['sidebarPosition']     = 'Позиция боковой панели DokuWiki (<code>слева</code> или <code>справа</code>)';
$lang['rightSidebar']        = 'The Right Sidebar page name, empty field disables the right sidebar.<br/>The Right Sidebar is displayed only when the default DokuWiki <a href="#config___sidebar">sidebar</a> is enabled and is on the <code>left</code> position (see the <a href="#config___tpl____bootstrap3____sidebarPosition">tpl»bootstrap3»sidebarPosition</a> configuration). If do you want only the DokuWiki sidebar on right position, set the <a href="#config___tpl____bootstrap3____sidebarPosition">tpl»bootstrap3»sidebarPosition</a> configuration with <code>right</code> value';
$lang['tableFullWidth']      = 'Разрешить таблицы в 100% ширину';
$lang['semantic']            = 'Включить семантические данные Schema.org. Для полной поддержи требуется установка <a href="https://www.dokuwiki.org/plugin:semantic">плагина</a>';
$lang['schemaOrgType']       = 'Тип Schema.org данных';
$lang['showTranslation']     = 'Отображать языковую панель (требует установки <a href="https://www.dokuwiki.org/plugin:Translation">плагина</a>)';
$lang['inverseNavbar']       = 'Перевернуть панель навигации';
$lang['fixedTopNavbar']      = 'Зафиксировать панель навигации сверху';
$lang['fluidContainer']      = 'Разрешить плавающий контейнер(страница во весь экран)';
$lang['pageOnPanel']         = 'Включить рамку вокруг страницы';
$lang['bootstrapTheme']      = 'Выберите графическую тему (Bootstrap оригинальная, Bootstrap дополнительная, темы Bootswatch.com или графическая тема по выбору)';
$lang['bootstrapTheme_o_default']    = 'Bootstrap оригинальная';
$lang['bootstrapTheme_o_optional']   = 'Optional Bootstrap theme';
$lang['bootstrapTheme_o_custom']     = 'Графическая тема по выбору';
$lang['bootstrapTheme_o_bootswatch'] = 'Темы Bootswatch.com';
$lang['customTheme']         = 'Вставьте адрес графической темы по выбору';
$lang['bootswatchTheme']     = 'Выберите графическую тему Bootswatch.com';
$lang['showThemeSwitcher']   = 'Отображать выбор тем Bootswatch.com в панели навигации';
$lang['hideInThemeSwitcher'] = 'Hide themes in theme switcher';
$lang['showPageInfo']        = 'Отображать информацию о странице (например, дата, автор)';
$lang['showBadges']          = 'Отображать значки внизу страницы (DokuWiki, Donate, и т.д.)';
$lang['leftSidebarGrid']     = 'Left sidebar grid classes <code>col-{xs,sm,md,lg}-x</code> (see <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grids</a> documentation)';
$lang['rightSidebarGrid']    = 'Right sidebar grid classes <code>col-{xs,sm,md,lg}-x</code> (see <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grids</a> documentation)';
