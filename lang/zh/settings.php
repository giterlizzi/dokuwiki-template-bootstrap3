<?php
/**
 * Chinese Language file for config
 *
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @author   <dev@openbdh.com>
 * @author   Bendihua
 * @author   Small_Ku
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$lang['bootstrapTheme']               = 'Bootstrap 主题';
$lang['bootstrapTheme_o_bootswatch']  = 'Bootswatch.com 主题';
$lang['bootstrapTheme_o_custom']      = '自定义 Bootstrap 主题';
$lang['bootstrapTheme_o_default']     = '香草（Vanilla）Bootstrap 主题';
$lang['bootstrapTheme_o_optional']    = '可选 Bootstrap 主题';
$lang['bootswatchTheme']              = '从 Bootswatch.com 选择一个主题';
$lang['browserTitle']                 = 'DokuWiki browser title (default is <code>@TITLE@ [@WIKI@]</code>, where <code>@TITLE@</code> placeholder replace the current page title and <code>@WIKI@</code> replace the DokuWiki name) - see <a class="interwiki iw_doku" href="#config___title">title</a> config';
$lang['browserTitleCharSepNS']        = 'Character separator for every namespaces on browser title';
$lang['browserTitleOrderNS']          = 'Set the order of namespaces';
$lang['browserTitleShowNS']           = 'Display the previous page name of current page on the browser title';
$lang['collapsibleSections']          = 'Collapse 2nd section level (useful in mobile devices)';
$lang['cookieLawBannerPage']          = 'Cookie 法横幅页名称';
$lang['cookieLawPolicyPage']          = 'Cookie 法律政策页名称';
$lang['customTheme']                  = '插入自定义主题的 URL';
$lang['discussionPage']               = '讨论页名称（默认为 <code>discussion:@ID@</code>，其中的 <code>@ID@</code> 占位符用以代替当前页名称），本字段留空则禁用链接';
$lang['fixedTopNavbar']               = '固定导航栏至顶部';
$lang['fluidContainer']               = '启用流体容器（全宽页面）';
$lang['fluidContainerBtn']            = 'Display a button in navbar to expand container';
$lang['googleAnalyticsAnonymizeIP']   = 'Anonymize the IP address of visitors';
$lang['googleAnalyticsNoTrackAdmin']  = 'Disable tracking for the Admin users';
$lang['googleAnalyticsNoTrackPages']  = 'Disable tracking for specified pages (insert a regex)';
$lang['googleAnalyticsNoTrackUsers']  = 'Disable tracking for all logged users';
$lang['googleAnalyticsTrackActions']  = 'Track DokuWiki actions (edit, search, etc)';
$lang['googleAnalyticsTrackID']       = 'Tracking ID';
$lang['hideInThemeSwitcher']          = 'Hide themes in theme switcher';
$lang['hideLoginLink']                = '隐藏导航栏的登入按钮。这个选项在只读的DokuWiki安装中有用。(例如:网址,个人网站等)';
$lang['individualTools']              = 'Split the Tools in individual menu in navbar';
$lang['inverseNavbar']                = '逆向导航栏';
$lang['landingPages']                 = 'Landing page name (insert a regex)';
$lang['leftSidebarGrid']              = '左侧边栏网格类 <code>col-{xs,sm,md,lg}-x</code>（请参阅 <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap 网格</a>文档）';
$lang['navbarLabels']                 = 'Show/Hide individual label';
$lang['pageIcons']                    = 'Select the icons to display';
$lang['pageInfo']                     = 'Display/Hide page info elements';
$lang['pageInfoDateFormat']           = 'Date format';
$lang['pageInfoDateFormat_o_dformat'] = 'DokuWiki format';
$lang['pageInfoDateFormat_o_human']   = 'Human readable';
$lang['pageOnPanel']                  = '使面板绕在页面上';
$lang['pageToolsAnimation']           = 'Enable the Page Tools animation';
$lang['rightSidebar']                 = 'The Right Sidebar page name, empty field disables the right sidebar.<br/>The Right Sidebar is displayed only when the default DokuWiki <a class="interwiki iw_doku" href="#config___sidebar">sidebar</a> is enabled and is on the <code>left</code> position (see the <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a> configuration). If do you want only the DokuWiki sidebar on right position, set the <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a> configuration with <code>right</code> value';
$lang['rightSidebarGrid']             = '右侧边栏网格类 <code>col-{xs,sm,md,lg}-x</code>（请参阅 <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap 网格</a>文档）';
$lang['schemaOrgType']                = 'Schema.org type (<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>, <code>Recipe</code>)';
$lang['semantic']                     = '启用语义数据';
$lang['showAddNewPage']               = 'Enable the Add New Page plugin in navbar  (require <em>Add New Page Plugin</em>)';
$lang['showAddNewPage_o_always']      = 'Always';
$lang['showAddNewPage_o_logged']      = 'When logged in';
$lang['showAddNewPage_o_never']       = 'Never';
$lang['showAdminMenu']                = 'Display Administration menu';
$lang['showBadges']                   = '显示标志按钮（DokuWiki，捐赠等）';
$lang['showCookieLawBanner']          = '在页脚中显示 Cookie 法横幅';
$lang['showDiscussion']               = '在工具菜单中显示讨论链接';
$lang['showEditBtn']                  = 'Display edit button in navbar';
$lang['showEditBtn_o_always']         = 'Always';
$lang['showEditBtn_o_logged']         = 'When logged in';
$lang['showEditBtn_o_never']          = 'Never';
$lang['showHomePageLink']             = 'Display Home-Page link in navbar';
$lang['showIndividualTool']           = 'Enable/Disable individual tool in navbar';
$lang['showLandingPage']              = 'Enable the landing page (without a sidebar and the panel around the page)';
$lang['showLoginOnFooter']            = '在底部显示一个小小的登入连接。当<code>hideLoginLink</code>开启了的时候,这个选项很有用。';
$lang['showNavbar']                   = 'Display navbar hook';
$lang['showNavbar_o_always']          = 'Always';
$lang['showNavbar_o_logged']          = 'When logged in';
$lang['showPageIcons']                = 'Display useful icons (print, share link, send mail, etc.) on page';
$lang['showPageId']                   = 'Display the DokuWiki page name (pageId) on top';
$lang['showPageInfo']                 = '显示页面信息（例如日期，作者）';
$lang['showPageTools']                = 'Enable the DokuWiki-style Page Tools';
$lang['showPageTools_o_always']       = 'Always';
$lang['showPageTools_o_logged']       = 'When logged in';
$lang['showPageTools_o_never']        = 'Never';
$lang['showSearchButton']             = 'Display search button in navbar';
$lang['showSearchForm']               = 'Display Search form in navbar';
$lang['showSearchForm_o_always']      = 'Always';
$lang['showSearchForm_o_logged']      = 'When logged in';
$lang['showSearchForm_o_never']       = 'Never';
$lang['showSemanticPopup']            = 'Display a popup with an extract of the page when the user hover on wikilink (require <em>Semantic Plugin</em>)';
$lang['showThemeSwitcher']            = '在导航栏中显示 Bootswatch.com 主题切换器';
$lang['showTools']                    = '在导航栏中显示工具';
$lang['showTools_o_always']           = '始终';
$lang['showTools_o_logged']           = '当登录时';
$lang['showTools_o_never']            = '从不';
$lang['showTranslation']              = '显示翻译工具栏（需要<em>翻译插件</em>）';
$lang['showUserHomeLink']             = '在导航栏中显示用户首页链接';
$lang['sidebarOnNavbar']              = 'Display the sidebar contents inside the navbar';
$lang['sidebarPosition']              = 'DokuWiki 侧边栏位置（左侧 <code>left</code> 或右侧 <code>right</code>）';
$lang['sidebarShowPageTitle']         = 'Display Sidebar page title';
$lang['socialShareProviders']         = 'Select the social share links to display';
$lang['tableFullWidth']               = '启用 100% 全表格宽度（Bootstrap 默认）';
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

