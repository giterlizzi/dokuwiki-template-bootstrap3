<?php
/**
 * Japanese Language file for config
 *
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @author   Hideaki SAWADA <chuno@live.jp>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$lang['discussionPage']      = 'コメントページ名（<code>discussion:@ID@</code> がデフォルト。<code>@ID@</code> は現在ページ名に置き換えるプレースホルダー）。リンクしない場合は空にする。';
$lang['showDiscussion']      = 'ツールメニューにコメントリンクを表示する';
$lang['showLoginOnFooter']   = 'フッターに「小さな」ログインリンクを表示する。<code>hideLoginLink</code> を有効にした場合、便利です。';
$lang['hideLoginLink']       = 'Navbar 上のログインボタンを非表示にする。「読取り専用」の DokuWiki サイト(例：ブログ・個人的な Web サイト)には便利です。';
$lang['showUserHomeLink']    = 'Navbar 内にユーザーのホームページリンクを表示する';
$lang['showCookieLawBanner'] = 'Display the Cookie Law banner on footer';
$lang['cookieLawBannerPage'] = 'Cookie Law banner page name';
$lang['cookieLawPolicyPage'] = 'Cookie Law policy page name';
$lang['browserTitle']        = 'ブラウザー上の DokuWiki の見出し(<code>@TITLE@ [@WIKI@]</code> がデフォルトです。<code>@TITLE@</code> は現在のページ見出しに置換え。<code>@WIKI@</code> は Wiki タイトルに置換え。)<a href="#config___title">title</a> の設定内容を参照して下さい。';
$lang['showIndividualTool']  = 'Navbar 内の個々のツールを有効／無効化する';
$lang['showTools']           = 'Navbar 内にツール表示する';
$lang['individualTools']     = 'Navbar 内のツールを個々のメニューに分割する';
$lang['showTools_o_never']   = '表示しない';
$lang['showTools_o_logged']  = 'ログイン時に表示する';
$lang['showTools_o_always']  = '常に表示する';
$lang['showSearchForm']      = 'Navbar 内に検索フォーム表示する';
$lang['showSearchForm_o_never']  = '表示しない';
$lang['showSearchForm_o_logged'] = 'ログイン時に表示する';
$lang['showSearchForm_o_always'] = '常に表示する';
$lang['sidebarPosition']     = 'DokuWiki サイドバーの配置（<code>left</code> 又は <code>right</code>）';
$lang['rightSidebar']        = '右サイドバーのページ名。空欄で右サイドバー無効。<br/>デフォルトの DokuWiki <a href="#config___sidebar">サイドバー</a>が有効で <code>left</code> に配置している場合(<a href="#config___tpl____bootstrap3____sidebarPosition">tpl»bootstrap3»sidebarPosition</a> 設定を参照)のみ右サイドバーを表示します。DokuWiki サイドバーを右側に配置したい場合、<a href="#config___tpl____bootstrap3____sidebarPosition">tpl»bootstrap3»sidebarPosition</a> 設定を <code>right</code> にしてください。';
$lang['tableFullWidth']      = '100% のテーブル幅を有効にする（Bootstrap のデフォルト）';
$lang['semantic']            = 'semantic データを有効にする';
$lang['schemaOrgType']       = 'Schema.org の型（<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>）';
$lang['showTranslation']     = '翻訳ツールバーを表示する（<em>Translation プラグイン</em>が必要）';
$lang['showAdminMenu']       = '管理者メニューを表示する';
$lang['inverseNavbar']       = 'Navbar の色を反転する';
$lang['fixedTopNavbar']      = 'Navbar を上部に固定する';
$lang['fluidContainer']      = '全幅のコンテナ(ページの全幅)を有効にする';
$lang['fluidContainerBtn']   = 'Navbar 内にコンテナの展開用のボタンを表示する';
$lang['pageOnPanel']         = 'ページ周囲のパネルを有効にする';
$lang['bootstrapTheme']      = 'Bootstrap テーマ';
$lang['bootstrapTheme_o_default']    = 'Vanilla Bootstrap テーマ';
$lang['bootstrapTheme_o_optional']   = 'Optional Bootstrap テーマ';
$lang['bootstrapTheme_o_custom']     = 'custom Bootstrap テーマ';
$lang['bootstrapTheme_o_bootswatch'] = 'Bootswatch.com テーマ';
$lang['customTheme']         = 'custom テーマの URL';
$lang['bootswatchTheme']     = 'Bootswatch.com テーマの選択';
$lang['showThemeSwitcher']   = 'Bootswatch.com テーマ選択を navbar に表示';
$lang['hideInThemeSwitcher'] = 'テーマ選択で表示しないテーマ';
$lang['showPageInfo']        = 'ページのメタデータを表示する（日付、編集者など）';
$lang['showBadges']          = 'バッチボタン(DokuWiki 寄付 等)を表示する';
$lang['leftSidebarGrid']     = '左サイドバーの grid クラス <code>col-{xs,sm,md,lg}-x</code>（<a href="http://bootstrap3.cyberlab.info/css/gridSystem.html" target="_blank">Bootstrap3 日本語リファレンス グリッド・システム</a>を参照）';
$lang['rightSidebarGrid']    = '右サイドバーの grid クラス <code>col-{xs,sm,md,lg}-x</code>（<a href="http://bootstrap3.cyberlab.info/css/gridSystem.html" target="_blank">Bootstrap3 日本語リファレンス グリッド・システム</a>を参照）';
$lang['useGravatar']         = 'Gravatar 画像を利用する';
$lang['showLandingPage']     = '(ページの周囲にサイドバーやパネルがない)ランディングページを有効にする';
$lang['landingPages']        = 'ランディングページ名(正規表現を含む)';
$lang['showPageTools']    = 'DokuWiki 形式のページツールを表示する';
$lang['showPageTools_o_never']   = '表示しない';
$lang['showPageTools_o_logged']  = 'ログイン時に表示する';
$lang['showPageTools_o_always']  = '常に表示する';
$lang['useLocalBootswatch']  = 'ローカルの Bootswatch ディレクトリを使用する。このオプションは "intranet" DokuWiki で役立ちます';
$lang['tableStyle']          = 'Table 形式';
$lang['tagsOnTop']           = '全 Tag をページ上部のページ ID の横に表示する(<em>Tag プラグイン</em>必須)';
$lang['showPageId']          = 'DokuWiki ページ名(ページ ID)を上部に表示する';
$lang['useAnchorJS']         = 'AnchorJS を使用する';
$lang['showHomePageLink']    = 'Navbar 内にホームページリンクを表示する';
$lang['useLegacyNavbar']     = '旧式・非奨励の "navbar.html" フックを使用する(":navbar" フックの使用を再検討して下さい)';
$lang['browserTitleCharSepNS'] = 'ブラウザタイトル上での全名前空間の区切り文字';
$lang['browserTitleShowNS']    = 'ブラウザタイトル上、現在のページの直前のページ名を表示します';
$lang['browserTitleOrderNS']   = '名前空間の順序を設定する';
$lang['tocCollapseSubSections'] = '表示領域を節約するために目次内の全サブセクションを折り畳みます';
