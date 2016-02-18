<?php
/**
 * Chinese Language file for config
 *
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @author   <dev@openbdh.com>
 * @author   Small_Ku
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$lang['discussionPage']      = '讨论页名称（默认为 <code>discussion:@ID@</code>，其中的 <code>@ID@</code> 占位符用以代替当前页名称），本字段留空则禁用链接';
$lang['showDiscussion']      = '在工具菜单中显示讨论链接';
$lang['showLoginOnFooter']   = '在底部显示一个小小的登入连接。当<code>hideLoginLink</code>开启了的时候,这个选项很有用。';
$lang['hideLoginLink']       = '隐藏导航栏的登入按钮。这个选项在只读的DokuWiki安装中有用。(例如:网址,个人网站等)';
$lang['showUserHomeLink']    = '在导航栏中显示用户首页链接';
$lang['showCookieLawBanner'] = '在页脚中显示 Cookie 法横幅';
$lang['cookieLawBannerPage'] = 'Cookie 法横幅页名称';
$lang['cookieLawPolicyPage'] = 'Cookie 法律政策页名称';
$lang['browserTitle']        = 'DokuWiki browser title (default is <code>@TITLE@ [@WIKI@]</code>, where <code>@TITLE@</code> placeholder replace the current page title and <code>@WIKI@</code> replace the DokuWiki name) - see <a class="interwiki iw_doku" href="#config___title">title</a> config';
$lang['showIndividualTool']  = 'Enable/Disable individual tool in navbar';
$lang['showTools']           = '在导航栏中显示工具';
$lang['individualTools']     = 'Split the Tools in individual menu in navbar';
$lang['showTools_o_never']   = '从不';
$lang['showTools_o_logged']  = '当登录时';
$lang['showTools_o_always']  = '始终';
$lang['showSearchForm']      = 'Display Search form in navbar';
$lang['showSearchForm_o_never']  = 'Never';
$lang['showSearchForm_o_logged'] = 'When logged in';
$lang['showSearchForm_o_always'] = 'Always';
$lang['sidebarPosition']     = 'DokuWiki 侧边栏位置（左侧 <code>left</code> 或右侧 <code>right</code>）';
$lang['rightSidebar']        = 'The Right Sidebar page name, empty field disables the right sidebar.<br/>The Right Sidebar is displayed only when the default DokuWiki <a href="#config___sidebar">sidebar</a> is enabled and is on the <code>left</code> position (see the <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a> configuration). If do you want only the DokuWiki sidebar on right position, set the <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a> configuration with <code>right</code> value';
$lang['tableFullWidth']      = '启用 100% 全表格宽度（Bootstrap 默认）';
$lang['semantic']            = '启用语义数据';
$lang['schemaOrgType']       = 'Schema.org 类型（文章 <code>Article</code>，新闻文章 <code>NewsArticle</code>，技术文章 <code>TechArticle</code>，博客文章 <code>BlogPosting</code>）';
$lang['showTranslation']     = '显示翻译工具栏（需要<em>翻译插件</em>）';
$lang['showAdminMenu']       = 'Display Administration menu';
$lang['inverseNavbar']       = '逆向导航栏';
$lang['fixedTopNavbar']      = '固定导航栏至顶部';
$lang['fluidContainer']      = '启用流体容器（全宽页面）';
$lang['fluidContainerBtn']   = 'Display a button in navbar to expand container';
$lang['pageOnPanel']         = '使面板绕在页面上';
$lang['bootstrapTheme']      = 'Bootstrap 主题';
$lang['bootstrapTheme_o_default']    = '香草（Vanilla）Bootstrap 主题';
$lang['bootstrapTheme_o_optional']   = '可选 Bootstrap 主题';
$lang['bootstrapTheme_o_custom']     = '自定义 Bootstrap 主题';
$lang['bootstrapTheme_o_bootswatch'] = 'Bootswatch.com 主题';
$lang['customTheme']         = '插入自定义主题的 URL';
$lang['bootswatchTheme']     = '从 Bootswatch.com 选择一个主题';
$lang['showThemeSwitcher']   = '在导航栏中显示 Bootswatch.com 主题切换器';
$lang['hideInThemeSwitcher'] = 'Hide themes in theme switcher';
$lang['showPageInfo']        = '显示页面信息（例如日期，作者）';
$lang['showBadges']          = '显示标志按钮（DokuWiki，捐赠等）';
$lang['leftSidebarGrid']     = '左侧边栏网格类 <code>col-{xs,sm,md,lg}-x</code>（请参阅 <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap 网格</a>文档）';
$lang['rightSidebarGrid']    = '右侧边栏网格类 <code>col-{xs,sm,md,lg}-x</code>（请参阅 <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap 网格</a>文档）';
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
$lang['useAnchorJS']         = 'Use AnchorJS';
$lang['showHomePageLink']    = 'Display Home-Page link in navbar';
$lang['useLegacyNavbar']     = 'Use legacy and deprecated "navbar.html" hook (consider in the future to use the ":navbar" hook)';
$lang['browserTitleCharSepNS'] = 'Character separator for every namespaces on browser title';
$lang['browserTitleShowNS']    = 'Display the previous page name of current page on the browser title';
$lang['browserTitleOrderNS']   = 'Set the order of namespaces';
$lang['tocCollapseSubSections'] = 'Collapse all sub-sections in TOC to save space';
