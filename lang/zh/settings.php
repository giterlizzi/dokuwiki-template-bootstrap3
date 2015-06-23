<?php
/**
 * Simplified Chinese file for config
 *
 * @author   OpenBDH <dev@openbdh.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$lang['discussionPage']      = '讨论页名称（默认为 <code>discussion:@ID@</code>，其中的 <code>@ID@</code> 占位符用以代替当前页名称），本字段留空则禁用链接';
$lang['showDiscussion']      = '在工具菜单中显示讨论链接';
$lang['showUserHomeLink']    = '在导航栏中显示用户首页链接';
$lang['showCookieLawBanner'] = '在页脚中显示 Cookie 法横幅';
$lang['cookieLawBannerPage'] = 'Cookie 法横幅页名称';
$lang['cookieLawPolicyPage'] = 'Cookie 法律政策页名称';
$lang['showTools']           = '在导航栏中显示工具';
$lang['showTools_o_never']   = '从不';
$lang['showTools_o_logged']  = '当登录时';
$lang['showTools_o_always']  = '始终';
$lang['sidebarPosition']     = 'DokuWiki 侧边栏位置（左侧 <code>left</code> 或右侧 <code>right</code>）';
$lang['rightSidebar']        = '右侧边栏页名称，本字段留空则禁用右侧边栏。<br/>仅当默认的 DokuWiki <a href="#config___sidebar">侧边栏</a>已启用且处于左侧 <code>left</code> 位置（见 <a href="#config___tpl____bootstrap3____sidebarPosition">
tpl»bootstrap3»sidebarPosition</a> 配置）时右侧边栏才会显示。如果您想只让 DokuWiki 侧边栏在右侧位置上，请设置 <a href="#config___tpl____bootstrap3____sidebarPosition">
tpl»bootstrap3»sidebarPosition</a> 配置的值为右侧 <code>right</code>';
$lang['tableFullWidth']      = '启用 100% 全表格宽度（Bootstrap 默认）';
$lang['semantic']            = '启用语义数据';
$lang['schemaOrgType']       = 'Schema.org 类型（文章 <code>Article</code>，新闻文章 <code>NewsArticle</code>，技术文章 <code>TechArticle</code>，博客文章 <code>BlogPosting</code>）';
$lang['showTranslation']     = '显示翻译工具栏（需要<em>翻译插件</em>）';
$lang['inverseNavbar']       = '逆向导航栏';
$lang['fixedTopNavbar']      = '固定导航栏至顶部';
$lang['fluidContainer']      = '启用流体容器（全宽页面）';
$lang['pageOnPanel']         = '使面板绕在页面上';
$lang['bootstrapTheme']      = 'Bootstrap 主题';
$lang['bootstrapTheme_o_default']    = '香草（Vanilla）Bootstrap 主题';
$lang['bootstrapTheme_o_optional']   = '可选 Bootstrap 主题';
$lang['bootstrapTheme_o_custom']     = '自定义 Bootstrap 主题';
$lang['bootstrapTheme_o_bootswatch'] = 'Bootswatch.com 主题';
$lang['customTheme']         = '插入自定义主题的 URL';
$lang['bootswatchTheme']     = '从 Bootswatch.com 选择一个主题';
$lang['showThemeSwitcher']   = '在导航栏中显示 Bootswatch.com 主题切换器';
$lang['showPageInfo']        = '显示页面信息（例如日期，作者）';
$lang['showBadges']          = '显示标志按钮（DokuWiki，捐赠等）';
$lang['leftSidebarGrid']     = '左侧边栏网格类 <code>col-{xs,sm,md,lg}-x</code>（请参阅 <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap 网格</a>文档）';
$lang['rightSidebarGrid']    = '右侧边栏网格类 <code>col-{xs,sm,md,lg}-x</code>（请参阅 <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap 网格</a>文档）';
