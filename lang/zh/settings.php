<?php
/**
 * Chinese Language file for config
 *
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @author   <dev@openbdh.com>
 * @author   Bendihua
 * @author   Small_Ku
 * @author   小 恐龙 (lhgtop)
 * @author   杰 冯
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$lang['bootstrapTheme']               = 'Bootstrap 主题';
$lang['bootstrapTheme_o_bootswatch']  = 'Bootswatch.com 主题';
$lang['bootstrapTheme_o_custom']      = '自定义 Bootstrap 主题';
$lang['bootstrapTheme_o_default']     = '香草（Vanilla）Bootstrap 主题';
$lang['bootstrapTheme_o_optional']    = '可选 Bootstrap 主题';
$lang['bootswatchTheme']              = '从 Bootswatch.com 选择一个主题';
$lang['browserTitle']                 = 'DokuWiki 浏览器标题 (默认是 <code>@TITLE@ [@WIKI@]</code>, 当用<code>@TITLE@</code> 占位符替换当前页面标题并用 <code>@WIKI@</code> 替换 DokuWiki 名称时) - 请参阅 <a class="interwiki iw_doku" href="#config___title">标题</a> 配置';
$lang['browserTitleCharSepNS']        = '浏览器标题上命名空间分隔符';
$lang['browserTitleOrderNS']          = '设置命名空间顺序';
$lang['browserTitleShowNS']           = '在当前页的浏览器标题显示上一页名称';
$lang['collapsibleSections']          = 'Collapse 2nd section level (useful in mobile/tablet devices)';
$lang['cookieLawBannerPage']          = 'Cookie 法横幅页名称';
$lang['cookieLawPolicyPage']          = 'Cookie 法律政策页名称';
$lang['customTheme']                  = '插入自定义主题的 URL';
$lang['discussionPage']               = '讨论页名称（默认为 <code>discussion:@ID@</code>，其中的 <code>@ID@</code> 占位符用以代替当前页名称），本字段留空则禁用链接';
$lang['domParserMaxPageSize']         = 'Set the max size of the page content for DOM Parser. The optimal and default value is <code>600000</code> (600KB)';
$lang['fixedTopNavbar']               = '固定导航栏至顶部';
$lang['fluidContainer']               = '启用流体容器（全宽页面）';
$lang['fluidContainerBtn']            = '在导航栏中显示按钮菜单';
$lang['googleAnalyticsAnonymizeIP']   = '匿名访问者的 IP 地址';
$lang['googleAnalyticsNoTrackAdmin']  = '禁止追踪管理员用户';
$lang['googleAnalyticsNoTrackPages']  = '禁止追踪指定页面(插入运算式)';
$lang['googleAnalyticsNoTrackUsers']  = '禁止追踪所有已记录用户';
$lang['googleAnalyticsTrackActions']  = '追踪 Dokuwiki 操作(编辑,搜索等)';
$lang['googleAnalyticsTrackID']       = '追踪 ID';
$lang['gravatarURL']                  = 'Set Gravatar URL <br/> <strong>NOTE:</strong> <br/> - <code>http://www.gravatar.com/avatar</code> (http) <br/> - <code>https://secure.gravatar.com/avatar</code> (https) <br/> - <code>https://www.gravatar.com/avatar</code> (alternative https)';
$lang['hideInThemeSwitcher']          = '在主题切换器中隐藏主题';
$lang['hideLoginLink']                = '隐藏导航栏的登入按钮。这个选项在只读的DokuWiki安装中有用。(例如:网址,个人网站等)';
$lang['homePageURL']                  = 'Use custom URL for home-page links';
$lang['individualTools']              = '在导航栏菜单中单独分割工具';
$lang['inverseNavbar']                = '逆向导航栏';
$lang['landingPages']                 = '载入页面名称(插入运算式)';
$lang['leftSidebarGrid']              = '左侧边栏网格类 <code>col-{xs,sm,md,lg}-x</code>（请参阅 <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap 网格</a>文档）';
$lang['libravatarURL']                = 'Set Libravatar (or compatible API) URL <br/> <strong>NOTE:</strong> <br/> - <code>https://seccdn.libravatar.org/avatar</code> (https) <br/> - <code>http://cdn.libravatar.org/avatar</code> (http)';
$lang['navbarLabels']                 = '显示/隐藏个别标签';
$lang['notifyExtensionsUpdate']       = 'Notify extensions update (for Admin users)';
$lang['office365URL']                 = 'Set Microsoft Office 365 (or EWS) URL <br/> <strong>NOTE:</strong> This service requires login, so this use case is most useful in a corporate installation, where all users have access to Office 365.';
$lang['pageIcons']                    = '选择要显示的图标';
$lang['pageInfo']                     = '显示/隐藏页面信息元素';
$lang['pageInfoDateFormat']           = '日期格式';
$lang['pageInfoDateFormat_o_dformat'] = 'dokuwiki 格式';
$lang['pageInfoDateFormat_o_human']   = '人类可读';
$lang['pageOnPanel']                  = '使面板绕在页面上';
$lang['rightSidebar']                 = '右侧栏页面名称,空字段禁用右侧栏.<br/>显示右侧栏需要 DokuWiki 默认启用<a class="interwiki iw_doku" href="#config___sidebar">侧栏</a> 并且 <code>left</code> 位置 (参阅<a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">侧栏位置</a> 配置). 如果你只想启用右侧栏,设置 <a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">侧栏位置</a> 中设置为<code>right</code> 值';
$lang['rightSidebarGrid']             = '右侧边栏网格类 <code>col-{xs,sm,md,lg}-x</code>（请参阅 <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap 网格</a>文档）';
$lang['schemaOrgType']                = 'Schema.org 类型 (<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>, <code>Recipe</code>)';
$lang['semantic']                     = '启用语义数据';
$lang['showAddNewPage']               = '在导航栏启用添加新页面插件 (需要 <em>Add New Page Plugin</em>)';
$lang['showAddNewPage_o_always']      = '总是';
$lang['showAddNewPage_o_logged']      = '登录时';
$lang['showAddNewPage_o_never']       = '从不';
$lang['showAdminMenu']                = '显示管理员菜单';
$lang['showBadges']                   = '显示标志按钮（DokuWiki，捐赠等）';
$lang['showCookieLawBanner']          = '在页脚中显示 Cookie 法横幅';
$lang['showDiscussion']               = '在工具菜单中显示讨论链接';
$lang['showEditBtn']                  = '在导航栏显示编辑';
$lang['showEditBtn_o_always']         = '总是';
$lang['showEditBtn_o_logged']         = '登录时';
$lang['showEditBtn_o_never']          = '从不';
$lang['showHomePageLink']             = '在导航栏显示主页链接';
$lang['showIndividualTool']           = '在导航栏中启用/禁止单个工具';
$lang['showLandingPage']              = '开启着陆页(不含侧栏和页面周围的面板)';
$lang['showLoginOnFooter']            = '在底部显示一个小小的登入连接。当<code>hideLoginLink</code>开启了的时候,这个选项很有用。';
$lang['showNavbar']                   = '显示导航栏 hook';
$lang['showNavbar_o_always']          = '总是';
$lang['showNavbar_o_logged']          = '登录时';
$lang['showPageIcons']                = '在页面显示常用图标(打印,分享链接,发送邮件等)';
$lang['showPageId']                   = '在顶部显示 dokuwiki 页面名称(pageID)';
$lang['showPageInfo']                 = '显示页面信息（例如日期，作者）';
$lang['showPageTools']                = '启用 dokuwiki 风格页面工具';
$lang['showPageTools_o_always']       = '总是';
$lang['showPageTools_o_logged']       = '登录时';
$lang['showPageTools_o_never']        = '从不';
$lang['showSearchForm']               = '在导航栏显示搜索';
$lang['showSearchForm_o_always']      = '总是';
$lang['showSearchForm_o_logged']      = '登录时';
$lang['showSearchForm_o_never']       = '从不';
$lang['showSemanticPopup']            = '当用户在wikilink上悬停时，显示带有页面提取的弹出窗口(需要<em>Semantic Plugin</em>)';
$lang['showThemeSwitcher']            = '在导航栏中显示 Bootswatch.com 主题切换器';
$lang['showTools']                    = '在导航栏中显示工具';
$lang['showTools_o_always']           = '始终';
$lang['showTools_o_logged']           = '当登录时';
$lang['showTools_o_never']            = '从不';
$lang['showTranslation']              = '显示翻译工具栏（需要<em>翻译插件</em>）';
$lang['showUserHomeLink']             = '在导航栏中显示用户首页链接';
$lang['showWikiInfo']                 = 'Display DokuWiki <a class="interwiki iw_doku" href="#config___title">name</a>, logo and <a class="interwiki iw_doku" href="#config___tagline">tagline</a> on footer';
$lang['sidebarOnNavbar']              = 'Display the sidebar contents inside the navbar (useful on mobile/tablet devices)';
$lang['sidebarPosition']              = 'DokuWiki 侧边栏位置（左侧 <code>left</code> 或右侧 <code>right</code>）';
$lang['sidebarShowPageTitle']         = '显示侧栏页面标题';
$lang['socialShareProviders']         = '显示选择的社交分享链接';
$lang['tableFullWidth']               = '启用 100% 全表格宽度（Bootstrap 默认）';
$lang['tableStyle']                   = '表格样式';
$lang['tagsOnTop']                    = '将所有标签移到网页顶部,网页ID旁边(需要<em>Tag Plugin</em>)';
$lang['themeByNamespace']             = '使用命名空间主题';
$lang['tocAffix']                     = '页面滚动时附加内容目录';
$lang['tocCollapseOnScroll']          = '页面滚动时折叠内容目录';
$lang['tocCollapseSubSections']       = '折叠内容目录中的所有层级以节省空间';
$lang['tocCollapsed']                 = '在任何页面都折叠内容目录';
$lang['tocPosition']                  = '内容目录位置';
$lang['tocLayout']                    = 'TOC layout';
$lang['useACL']                       = 'Use ACL for sidebars (left and right) and for all DokuWiki hooks (eg. <code>:footer</code>, <code>:navbar</code>, etc.) <br/> <strong>NOTE:</strong> Available since "Elenor of Tsort" DokuWiki release';
$lang['useAlternativeToolbarIcons']   = 'Use alternative Material Design Icons for DokuWiki toolbar';
$lang['useAnchorJS']                  = '使用 AnchorJS';
$lang['useAvatar']                    = 'Load the avatar image from Gravatar, Libravatar, Microsoft Office365 or local DokuWiki <code>:user</code> namespace';
$lang['useAvatar_o_gravatar']         = 'Gravatar';
$lang['useAvatar_o_libravatar']       = 'Libravatar';
$lang['useAvatar_o_local']            = 'DokuWiki :user namespace';
$lang['useAvatar_o_off']              = 'Off';
$lang['useAvatar_o_office365']        = 'Office365 (or EWS)';
$lang['useAvatar_o_activedirectory']  = 'Active Directory';
$lang['useGoogleAnalytics']           = '启用谷歌分析';
$lang['useLegacyNavbar']              = '使用旧版和不建议使用的<code>navbar.html</code> hook(以后考虑使用：<code>导航栏</code> hook)';
