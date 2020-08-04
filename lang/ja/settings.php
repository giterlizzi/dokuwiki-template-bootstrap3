<?php
/**
 * Japanese Language file for config
 *
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @author   Hideaki SAWADA <chuno@live.jp>
 * @author   Sato Shun
 * @author   Je Feng
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$lang['bootstrapTheme']               = 'Bootstrap テーマ';
$lang['bootstrapTheme_o_bootswatch']  = 'Bootswatch.com テーマ';
$lang['bootstrapTheme_o_custom']      = 'custom Bootstrap テーマ';
$lang['bootstrapTheme_o_default']     = 'Vanilla Bootstrap テーマ';
$lang['bootstrapTheme_o_optional']    = 'Optional Bootstrap テーマ';
$lang['bootswatchTheme']              = 'Bootswatch.com テーマの選択';
$lang['browserTitle']                 = 'ブラウザー上の DokuWiki の見出し(<code>@TITLE@ [@WIKI@]</code> がデフォルトです。<code>@TITLE@</code> は現在のページ見出しに置換え。<code>@WIKI@</code> は Wiki タイトルに置換え。)<a href="#config___title">title</a> の設定内容を参照して下さい。';
$lang['browserTitleCharSepNS']        = 'ブラウザタイトル上での全名前空間の区切り文字';
$lang['browserTitleOrderNS']          = '名前空間の順序を設定する';
$lang['browserTitleShowNS']           = 'ブラウザタイトル上で、現在のページの直前のページ名を表示する';
$lang['collapsibleSections']          = 'セクションの第2レベルを折りたたむ（モバイル・タブレット機器の場合に便利）';
$lang['cookieLawBannerPage']          = 'Cookie法バナーのページ名';
$lang['cookieLawPolicyPage']          = 'Cookie法ポリシーのページ名';
$lang['customTheme']                  = 'custom テーマの URL';
$lang['discussionPage']               = 'コメントページ名（<code>discussion:@ID@</code> がデフォルト。<code>@ID@</code> は現在ページ名に置き換えるプレースホルダー）。リンクしない場合は空にする。';
$lang['domParserMaxPageSize']         = 'DOMパーサー向けのページ内容の最大サイズ<br>最適且つ既定の値は<code>600000</code>(600KB)です。';
$lang['fixedTopNavbar']               = 'ナビゲーション・バーを上部に固定する';
$lang['fluidContainer']               = '全幅のコンテナ(ページの全幅)を有効にする';
$lang['fluidContainerBtn']            = 'ナビゲーション・バー内にコンテナの展開用のボタンを表示する';
$lang['googleAnalyticsAnonymizeIP']   = '訪問者の IP アドレスを匿名化する';
$lang['googleAnalyticsNoTrackAdmin']  = '管理者の追跡を無効にする';
$lang['googleAnalyticsNoTrackPages']  = '追跡を無効にするページを指定（正規表現を入力）';
$lang['googleAnalyticsNoTrackUsers']  = 'ログイン済みのユーザーの追跡を無効にする';
$lang['googleAnalyticsTrackActions']  = 'Dokuwiki の動作 (編集・検索等) を追跡する';
$lang['googleAnalyticsTrackID']       = '追跡用 ID';
$lang['gravatarURL']                  = 'GravatarのURLを設定<br/><strong>注：</strong><br/> - <code>http://www.gravatar.com/avatar</code> (http) <br/> - <code>https://secure.gravatar.com/avatar</code> (https) <br/> - <code>https://www.gravatar.com/avatar</code> (https形式の別のURL)';
$lang['hideInThemeSwitcher']          = 'テーマ選択で表示しないテーマ';
$lang['hideLoginLink']                = 'ナビゲーション・バー上のログインボタンを非表示にする。「読取り専用」の DokuWiki サイト(例：ブログ・個人的な Web サイト)には便利です。';
$lang['homePageURL']                  = 'ホームページリンク用のカスタムURL';
$lang['individualTools']              = 'ナビゲーション・バー内のツールを個々のメニューに分割する';
$lang['inverseNavbar']                = 'ナビゲーション・バーの色を反転する';
$lang['landingPages']                 = 'ランディングページ名(正規表現を入力)';
$lang['leftSidebarGrid']              = '左サイドバーの grid クラス <code>col-{xs,sm,md,lg}-x</code> (<a href="http://bootstrap3.cyberlab.info/css/gridSystem.html" target="_blank">Bootstrap3 日本語リファレンス グリッド・システム</a>を参照)';
$lang['libravatarURL']                = 'Libravatar（あるいは互換性のあるAPI）のURLを指定<br/><strong>注：</strong><br/> - <code>https://seccdn.libravatar.org/avatar</code> (https) <br/> - <code>http://cdn.libravatar.org/avatar</code> (http)';
$lang['navbarLabels']                 = '個々のラベルの表示・非表示';
$lang['notifyExtensionsUpdate']       = 'Notify extensions update (for Admin users)';
$lang['office365URL']                 = 'Microsoft Office 365（もしくはEWS）のURLを指定<br/> <strong>注：</strong> このサービスを使うにはログインが必要なので、全てのユーザーがOffice 365へのアクセス権を有する会社内での利用に適しています。';
$lang['pageIcons']                    = '表示するアイコンを選択する';
$lang['pageInfo']                     = 'ページのメタデータの各要素の表示・非表示';
$lang['pageInfoDateFormat']           = '日付形式';
$lang['pageInfoDateFormat_o_dformat'] = 'DokuWiki 形式';
$lang['pageInfoDateFormat_o_human']   = '人が読める形式';
$lang['pageOnPanel']                  = 'ページ周囲のパネルを有効にする';
$lang['rightSidebar']                 = '右サイドバーのページ名。空欄で右サイドバー無効。<br/>デフォルトの DokuWiki <a class="interwiki iw_doku" href="#config___sidebar">サイドバー</a>が有効で <code>left</code> に配置している場合 (<a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">
sidebarPosition</a> 設定を参照) のみ右サイドバーを表示します。DokuWiki サイドバーを右側に配置したい場合、<a class="interwiki iw_doku" href="#config___tpl____bootstrap3____sidebarPosition">sidebarPosition</a> 設定を <code>right</code> にしてください。';
$lang['rightSidebarGrid']             = '右サイドバーの grid クラス <code>col-{xs,sm,md,lg}-x</code> (<a href="http://bootstrap3.cyberlab.info/css/gridSystem.html" target="_blank">Bootstrap3 日本語リファレンス グリッド・システム</a>を参照)';
$lang['schemaOrgType']                = 'Schema.org の型 (<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>, <code>Recipe</code>)';
$lang['semantic']                     = 'セマンティックデータを有効にする';
$lang['showAddNewPage']               = 'ナビゲーション・バー内に Add New Page プラグインを有効にする(<em>Add New Page プラグイン</em>必須)';
$lang['showAddNewPage_o_always']      = '常に有効にする';
$lang['showAddNewPage_o_logged']      = 'ログイン時に有効にする';
$lang['showAddNewPage_o_never']       = '無効にする';
$lang['showAdminMenu']                = '管理者メニューを表示する';
$lang['showBadges']                   = 'バッチボタン(DokuWikiポータルサイト、寄付 等)を表示する';
$lang['showCookieLawBanner']          = 'Cookie法バナーをフッターに表示する';
$lang['showDiscussion']               = 'ツールメニューにコメントリンクを表示する';
$lang['showEditBtn']                  = 'ナビゲーション・バー内に編集ボタンを表示する';
$lang['showEditBtn_o_always']         = '常に表示する';
$lang['showEditBtn_o_logged']         = 'ログイン時に表示する';
$lang['showEditBtn_o_never']          = '表示しない';
$lang['showHomePageLink']             = 'ナビゲーション・バー内にホームページリンクを表示する';
$lang['showIndividualTool']           = 'ナビゲーション・バー内の個々のツールを有効・無効化する';
$lang['showLandingPage']              = '(ページの周囲にサイドバーやパネルがない)ランディングページを有効にする';
$lang['showLoginOnFooter']            = 'フッターに「小さな」ログインリンクを表示する。<code>hideLoginLink</code> を有効にした場合、便利です。';
$lang['showNavbar']                   = 'ナビゲーション・バー用のフックを表示する';
$lang['showNavbar_o_always']          = '常に表示する';
$lang['showNavbar_o_logged']          = 'ログイン時に表示する';
$lang['showPageIcons']                = 'ページ上に便利なアイコン (印刷・シェアリンク・メール送信等) を表示する';
$lang['showPageId']                   = 'DokuWiki ページ名(ページ ID)を上部に表示する';
$lang['showPageInfo']                 = 'ページのメタデータを表示する（日付、編集者など）';
$lang['showPageTools']                = 'DokuWiki 形式のページツールを表示する';
$lang['showPageTools_o_always']       = '常に表示する';
$lang['showPageTools_o_logged']       = 'ログイン時に表示する';
$lang['showPageTools_o_never']        = '表示しない';
$lang['showSearchForm']               = 'ナビゲーション・バー内に検索フォームを表示する';
$lang['showSearchForm_o_always']      = '常に表示する';
$lang['showSearchForm_o_logged']      = 'ログイン時に表示する';
$lang['showSearchForm_o_never']       = '表示しない';
$lang['showSemanticPopup']            = 'Wiki リンクにカーソルを合わせた場合、ページ抜粋のポップアップを表示する(<em>セマンティックプラグイン</em>必須)';
$lang['showThemeSwitcher']            = 'ナビゲーション・バー内に Bootswatch.com テーマ選択を表示';
$lang['showTools']                    = 'ナビゲーション・バー内にツール表示する';
$lang['showTools_o_always']           = '常に表示する';
$lang['showTools_o_logged']           = 'ログイン時に表示する';
$lang['showTools_o_never']            = '表示しない';
$lang['showTranslation']              = '翻訳ツールバーを表示する（<em>Translation プラグイン</em>が必要）';
$lang['showUserHomeLink']             = 'ナビゲーション・バー内にユーザーのホームページリンクを表示する';
$lang['showWikiInfo']                 = 'このDokuWikiの<a class="interwiki iw_doku" href="#config___title">名前</a>、ロゴ、及び<a class="interwiki iw_doku" href="#config___tagline">キャッチフレーズ</a>をフッターに表示する';
$lang['sidebarOnNavbar']              = 'サイドバーの内容をナビゲーションバー内に表示する（モバイル・タブレット端末からの閲覧の際に便利）';
$lang['sidebarPosition']              = 'DokuWiki サイドバーの配置（<code>left</code> 又は <code>right</code>）';
$lang['sidebarShowPageTitle']         = 'サイドバーのページタイトルを表示する';
$lang['socialShareProviders']         = '表示する SNS シェアリンクを選択する';
$lang['tableFullWidth']               = '100% のテーブル幅を有効にする（Bootstrap のデフォルト）';
$lang['tableStyle']                   = 'Table 形式';
$lang['tagsOnTop']                    = '全 Tag をページ上部のページ ID の横に表示する(<em>Tag プラグイン</em>必須)';
$lang['themeByNamespace']             = '名前空間のテーマを使用する';
$lang['tocAffix']                     = 'ページスクロール中に目次が付いて来るようにする';
$lang['tocCollapseOnScroll']          = 'ページスクロール中に目次を折り畳む';
$lang['tocCollapseSubSections']       = '表示領域を節約するために目次内の全サブセクションを折り畳む';
$lang['tocCollapsed']                 = '全てのページで目次を折り畳む';
$lang['tocPosition']                  = '目次の配置';
$lang['tocLayout']                    = '目次のレイアウト';
$lang['useACL']                       = 'サイドバー（左右）と全てのDokuWikiのフック（<code>:footer</code>、<code>:navbar</code> など）にアクセスコントロールを適用<br/><strong>注： </strong>"Elenor of Tsort"リリース以降で有効です。';
$lang['useAlternativeToolbarIcons']   = 'Use alternative Material Design Icons for DokuWiki toolbar';
$lang['useAnchorJS']                  = 'AnchorJS を使用する';
$lang['useAvatar']                    = 'アバター画像をGravatar、Libravatar、Microsoft Office365、このDokuWikiの名前空間<code>:user</code>のうちどこから読み込むか';
$lang['useAvatar_o_gravatar']         = 'Gravatar';
$lang['useAvatar_o_libravatar']       = 'Libravatar';
$lang['useAvatar_o_local']            = 'DokuWikiの名前空間 :user';
$lang['useAvatar_o_off']              = 'アバターを使用しない';
$lang['useAvatar_o_office365']        = 'Office365（もしくはEWS）';
$lang['useAvatar_o_activedirectory']  = 'Active Directory';
$lang['useGoogleAnalytics']           = 'Google アナリティクスを有効にする';
$lang['useLegacyNavbar']              = '旧式・非奨励の <code>navbar.html</code> フックを使用する　(<code>:navbar</code> フックの使用を再検討して下さい)';
