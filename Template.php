<?php

namespace dokuwiki\template\bootstrap3;

/**
 * DokuWiki Bootstrap3 Template: Template Class
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

class Template
{

    private $plugins      = [];
    private $confMetadata = [];
    private $toolsMenu    = [];
    private $handlers;

    public $tplDir  = '';
    public $baseDir = '';

    public function __construct()
    {

        global $JSINFO;
        global $INPUT;
        global $ACT;
        global $INFO;

        $this->tplDir  = tpl_incdir();
        $this->baseDir = tpl_basedir();

        $this->initPlugins();
        $this->initToolsMenu();
        $this->loadConfMetadata();

        // Get the template info (useful for debug)
        if (isset($INFO['isadmin']) && $INPUT->str('do') && $INPUT->str('do') == 'check') {
            msg('Template version ' . $this->getVersion(), 1, '', '', MSG_ADMINS_ONLY);
        }

        // Populate JSINFO object
        $JSINFO['bootstrap3'] = [
            'mode'   => $ACT,
            'toc'    => [],
            'config' => [
                'collapsibleSections'        => (int) $this->getConf('collapsibleSections'),
                'fixedTopNavbar'             => (int) $this->getConf('fixedTopNavbar'),
                'showSemanticPopup'          => (int) $this->getConf('showSemanticPopup'),
                'sidebarOnNavbar'            => (int) $this->getConf('sidebarOnNavbar'),
                'tagsOnTop'                  => (int) $this->getConf('tagsOnTop'),
                'tocAffix'                   => (int) $this->getConf('tocAffix'),
                'tocCollapseOnScroll'        => (int) $this->getConf('tocCollapseOnScroll'),
                'tocCollapsed'               => (int) $this->getConf('tocCollapsed'),
                'tocLayout'                  => $this->getConf('tocLayout'),
                'useAnchorJS'                => (int) $this->getConf('useAnchorJS'),
                'useAlternativeToolbarIcons' => (int) $this->getConf('useAlternativeToolbarIcons'),
                'disableSearchSuggest'       => (int) $this->getConf('disableSearchSuggest'),
            ],
        ];

        if ($ACT == 'admin') {
            $JSINFO['bootstrap3']['admin'] = hsc($INPUT->str('page'));
        }

        if (!defined('MAX_FILE_SIZE') && $pagesize = $this->getConf('domParserMaxPageSize')) {
            define('MAX_FILE_SIZE', $pagesize);
        }

        # Start Event Handlers
        $this->handlers = new EventHandlers($this);

    }

    public function getVersion()
    {
        $template_info    = confToHash($this->tplDir . 'template.info.txt');
        $template_version = 'v' . $template_info['date'];

        if (isset($template_info['build'])) {
            $template_version .= ' (' . $template_info['build'] . ')';
        }

        return $template_version;
    }

    private function initPlugins()
    {
        $plugins = ['tplinc', 'tag', 'userhomepage', 'translation', 'pagelist'];

        foreach ($plugins as $plugin) {
            $this->plugins[$plugin] = plugin_load('helper', $plugin);
        }
    }

    public function getPlugin($plugin)
    {
        if (plugin_isdisabled($plugin)) {
            return false;
        }

        if (!isset($this->plugins[$plugin])) {
            return false;
        }

        return $this->plugins[$plugin];
    }

    /**
     * Get the singleton instance
     *
     * @return Template
     */
    public static function getInstance()
    {
        static $instance = null;

        if ($instance === null) {
            $instance = new self;
        }

        return $instance;
    }

    /**
     * Get the content to include from the tplinc plugin
     *
     * prefix and postfix are only added when there actually is any content
     *
     * @param string $location
     * @return string
     */
    public function includePage($location, $return = false)
    {

        $content = '';

        if ($plugin = $this->getPlugin('tplinc')) {
            $content = $plugin->renderIncludes($location);
        }

        if ($content === '') {
            $content = tpl_include_page($location, 0, 1, $this->getConf('useACL'));
        }

        if ($content === '') {
            return '';
        }

        $content = $this->normalizeContent($content);

        if ($return) {
            return $content;
        }

        echo $content;
        return '';
    }

    /**
     * Get the template configuration metadata
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @param   string $key
     * @return  array|string
     */
    public function getConfMetadata($key = null)
    {
        if ($key && isset($this->confMetadata[$key])) {
            return $this->confMetadata[$key];
        }

        return null;
    }

    private function loadConfMetadata()
    {
        $meta = [];
        $file = $this->tplDir . 'conf/metadata.php';

        include $file;

        $this->confMetadata = $meta;
    }

    /**
     * Simple wrapper for tpl_getConf
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @param   string  $key
     * @param   mixed   $default value
     * @return  mixed
     */
    public function getConf($key, $default = false)
    {
        global $ACT, $INFO, $ID, $conf;

        $value = tpl_getConf($key, $default);

        switch ($key) {
            case 'useAvatar':

                if ($value == 'off') {
                    return false;
                }

                return $value;

            case 'bootstrapTheme':

                @list($theme, $bootswatch) = $this->getThemeForNamespace();
                if ($theme) {
                    return $theme;
                }

                return $value;

            case 'bootswatchTheme':

                @list($theme, $bootswatch) = $this->getThemeForNamespace();
                if ($bootswatch) {
                    return $bootswatch;
                }

                return $value;

            case 'showTools':
            case 'showSearchForm':
            case 'showPageTools':
            case 'showEditBtn':
            case 'showAddNewPage':

                return $value !== 'never' && ($value == 'always' || !empty($_SERVER['REMOTE_USER']));

            case 'showAdminMenu':

                return $value && ($INFO['isadmin'] || $INFO['ismanager']);

            case 'hideLoginLink':
            case 'showLoginOnFooter':

                return ($value && !isset($_SERVER['REMOTE_USER']));

            case 'showCookieLawBanner':

                return $value && page_findnearest(tpl_getConf('cookieLawBannerPage'), $this->getConf('useACL')) && ($ACT == 'show');

            case 'showSidebar':

                if ($ACT !== 'show') {
                    return false;
                }

                if ($this->getConf('showLandingPage')) {
                    return false;
                }

                return page_findnearest($conf['sidebar'], $this->getConf('useACL'));

            case 'showRightSidebar':

                if ($ACT !== 'show') {
                    return false;
                }

                if ($this->getConf('sidebarPosition') == 'right') {
                    return false;
                }

                return page_findnearest(tpl_getConf('rightSidebar'), $this->getConf('useACL'));

            case 'showLandingPage':

                return ($value && (bool) preg_match_all($this->getConf('landingPages'), $ID));

            case 'pageOnPanel':

                if ($this->getConf('showLandingPage')) {
                    return false;
                }

                return $value;

            case 'showThemeSwitcher':

                return $value && ($this->getConf('bootstrapTheme') == 'bootswatch');

            case 'tocCollapseSubSections':

                if (!$this->getConf('tocAffix')) {
                    return false;
                }

                return $value;

            case 'schemaOrgType':

                if ($semantic = plugin_load('helper', 'semantic')) {
                    if (method_exists($semantic, 'getSchemaOrgType')) {
                        return $semantic->getSchemaOrgType();
                    }
                }

                return $value;

            case 'tocCollapseOnScroll':

                if ($this->getConf('tocLayout') !== 'default') {
                    return false;
                }

                return $value;
        }

        $metadata = $this->getConfMetadata($key);

        if (isset($metadata[0])) {
            switch ($metadata[0]) {
                case 'regex':
                    return '/' . $value . '/';
                case 'multicheckbox':
                    return explode(',', $value);
            }
        }

        return $value;
    }

    /**
     * Return the Bootswatch.com theme lists defined in metadata.php
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @return  array
     */
    public function getBootswatchThemeList()
    {
        $bootswatch_themes = $this->getConfMetadata('bootswatchTheme');
        return $bootswatch_themes['_choices'];
    }

    /**
     * Get a Gravatar, Libravatar, Office365/EWS URL or local ":user" DokuWiki namespace
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @param   string  $username  User ID
     * @param   string  $email     The email address
     * @param   string  $size      Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param   string  $d         Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param   string  $r         Maximum rating (inclusive) [ g | pg | r | x ]
     *
     * @return  string
     */
    public function getAvatar($username, $email, $size = 80, $d = 'mm', $r = 'g')
    {
        global $INFO;

        $avatar_url      = '';
        $avatar_provider = $this->getConf('useAvatar');

        if (!$avatar_provider) {
            return false;
        }

        if ($avatar_provider == 'local') {

            $interwiki = getInterwiki();
            $user_url  = str_replace('{NAME}', $username, $interwiki['user']);
            $logo_size = [];
            $logo      = tpl_getMediaFile(["$user_url.png", "$user_url.jpg", 'images/avatar.png'], false, $logo_size);

            return $logo;
        }

        if ($avatar_provider == 'activedirectory') {
            $logo = "data:image/jpeg;base64," . base64_encode($INFO['userinfo']['thumbnailphoto']);

            return $logo;
        }

        $email = strtolower(trim($email));

        if ($avatar_provider == 'office365') {
            $office365_url = rtrim($this->getConf('office365URL'), '/');
            $avatar_url    = $office365_url . '/owa/service.svc/s/GetPersonaPhoto?email=' . $email . '&size=HR' . $size . 'x' . $size;
        }

        if ($avatar_provider == 'gravatar' || $avatar_provider == 'libavatar') {
            $gravatar_url  = rtrim($this->getConf('gravatarURL'), '/') . '/';
            $libavatar_url = rtrim($this->getConf('libavatarURL'), '/') . '/';

            switch ($avatar_provider) {
                case 'gravatar':
                    $avatar_url = $gravatar_url;
                    break;
                case 'libavatar':
                    $avatar_url = $libavatar_url;
                    break;
            }

            $avatar_url .= md5($email);
            $avatar_url .= "?s=$size&d=$d&r=$r";
        }

        if ($avatar_url) {
            $media_link = ml("$avatar_url&.jpg", ['cache' => 'recache', 'w' => $size, 'h' => $size]);
            return $media_link;
        }

        return false;
    }

    /**
     * Return template classes
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     * @see tpl_classes();
     *
     * @return string
     **/
    public function getClasses()
    {
        global $ACT;

        $page_on_panel    = $this->getConf('pageOnPanel');
        $bootstrap_theme  = $this->getConf('bootstrapTheme');
        $bootswatch_theme = $this->getBootswatchTheme();

        $classes   = [];
        $classes[] = (($bootstrap_theme == 'bootswatch') ? $bootswatch_theme : $bootstrap_theme);
        $classes[] = trim(tpl_classes());

        if ($page_on_panel) {
            $classes[] = 'dw-page-on-panel';
        }

        if (!$this->getConf('tableFullWidth')) {
            $classes[] = 'dw-table-width';
        }

        if ($this->isFluidNavbar()) {
            $classes[] = 'dw-fluid-container';
        }

        return implode(' ', $classes);
    }

    /**
     * Return the current Bootswatch theme
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @return  string
     */
    public function getBootswatchTheme()
    {
        global $INPUT;

        $bootswatch_theme = $this->getConf('bootswatchTheme');

        if ($this->getConf('showThemeSwitcher')) {
            if (get_doku_pref('bootswatchTheme', null) !== null && get_doku_pref('bootswatchTheme', null) !== '') {
                $bootswatch_theme = get_doku_pref('bootswatchTheme', null);
            }
        }
        return $bootswatch_theme;
    }

    /**
     * Return only the available Bootswatch.com themes
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @return  array
     */
    public function getAvailableBootswatchThemes()
    {
        return array_diff($this->getBootswatchThemeList(), $this->getConf('hideInThemeSwitcher'));
    }

    /**
     * Return the active theme
     *
     * @return string
     */
    public function getTheme()
    {
        $bootstrap_theme  = $this->getConf('bootstrapTheme');
        $bootswatch_theme = $this->getBootswatchTheme();
        $theme            = (($bootstrap_theme == 'bootswatch') ? $bootswatch_theme : $bootstrap_theme);

        return $theme;
    }

    /**
     * Return the active theme
     *
     * @return string
     */
    public function getThemeFeatures()
    {
        $features = [];

        if ($this->isFluidNavbar()) {
            $features[] = 'fluid-container';
        }

        if ($this->getConf('fixedTopNavbar')) {
            $features[] = 'fixed-top-navbar';
        }

        if ($this->getConf('tocCollapseSubSections')) {
            $features[] = 'toc-cullapse-sub-sections';
        }

        return implode(' ', $features);
    }

    /**
     * Print some info about the current page
     *
     * @author  Andreas Gohr <andi@splitbrain.org>
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @param   bool $ret return content instead of printing it
     * @return  bool|string
     */
    public function getPageInfo($ret = false)
    {
        global $conf;
        global $lang;
        global $INFO;
        global $ID;

        // return if we are not allowed to view the page
        if (!auth_quickaclcheck($ID)) {
            return false;
        }

        // prepare date and path
        $fn = $INFO['filepath'];

        if (!$conf['fullpath']) {
            if ($INFO['rev']) {
                $fn = str_replace(fullpath($conf['olddir']) . '/', '', $fn);
            } else {
                $fn = str_replace(fullpath($conf['datadir']) . '/', '', $fn);
            }
        }

        $date_format = $this->getConf('pageInfoDateFormat');
        $page_info   = $this->getConf('pageInfo');

        $fn   = utf8_decodeFN($fn);
        $date = (($date_format == 'dformat')
            ? dformat($INFO['lastmod'])
            : datetime_h($INFO['lastmod']));

        // print it
        if ($INFO['exists']) {
            $fn_full = $fn;

            if (!in_array('extension', $page_info)) {
                $fn = str_replace(['.txt.gz', '.txt'], '', $fn);
            }

            $out = '<ul class="list-inline">';

            if (in_array('filename', $page_info)) {
                $out .= '<li>' . iconify('mdi:file-document-outline', ['class' => 'text-muted']) . ' <span title="' . $fn_full . '">' . $fn . '</span></li>';
            }

            if (in_array('date', $page_info)) {
                $out .= '<li>' . iconify('mdi:calendar', ['class' => 'text-muted']) . ' ' . $lang['lastmod'] . ' <span title="' . dformat($INFO['lastmod']) . '">' . $date . '</span></li>';
            }

            if (in_array('editor', $page_info)) {
                if (isset($INFO['editor'])) {
                    $user = editorinfo($INFO['editor']);

                    if ($this->getConf('useAvatar')) {
                        global $auth;
                        $user_data = $auth->getUserData($INFO['editor']);

                        $avatar_img = $this->getAvatar($INFO['editor'], $user_data['mail'], 16);
                        $user_img   = '<img src="' . $avatar_img . '" alt="" width="16" height="16" class="img-rounded" /> ';
                        $user       = str_replace(['iw_user', 'interwiki'], '', $user);
                        $user       = $user_img . "<bdi>$user<bdi>";
                    }

                    $out .= '<li class="text-muted">' . $lang['by'] . ' <bdi>' . $user . '</bdi></li>';
                } else {
                    $out .= '<li>(' . $lang['external_edit'] . ')</li>';
                }
            }

            if ($INFO['locked'] && in_array('locked', $page_info)) {
                $out .= '<li>' . iconify('mdi:lock', ['class' => 'text-muted']) . ' ' . $lang['lockedby'] . ' ' . editorinfo($INFO['locked']) . '</li>';
            }

            $out .= '</ul>';

            if ($ret) {
                return $out;
            } else {
                echo $out;
                return true;
            }
        }

        return false;
    }

    /**
     * Prints the global message array in Bootstrap style
     *
     * @author Andreas Gohr <andi@splitbrain.org>
     * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @see html_msgarea()
     */
    public function getMessageArea()
    {

        global $MSG, $MSG_shown;

        /** @var array $MSG */
        // store if the global $MSG has already been shown and thus HTML output has been started
        $MSG_shown = true;

        // Check if translation is outdate
        if ($this->getConf('showTranslation') && $translation = $this->getPlugin('translation')) {
            global $ID;

            if ($translation->istranslatable($ID)) {
                $translation->checkage();
            }
        }

        if (!isset($MSG)) {
            return;
        }

        $shown = [];

        foreach ($MSG as $msg) {
            $hash = md5($msg['msg']);
            if (isset($shown[$hash])) {
                continue;
            }
            // skip double messages

            if (info_msg_allowed($msg)) {
                switch ($msg['lvl']) {
                    case 'info':
                        $level = 'info';
                        $icon  = 'mdi:information';
                        break;

                    case 'error':
                        $level = 'danger';
                        $icon  = 'mdi:alert-octagon';
                        break;

                    case 'notify':
                        $level = 'warning';
                        $icon  = 'mdi:alert';
                        break;

                    case 'success':
                        $level = 'success';
                        $icon  = 'mdi:check-circle';
                        break;
                }

                print '<div class="alert alert-' . $level . '">';
                print iconify($icon, ['class' => 'mr-2']);
                print $msg['msg'];
                print '</div>';
            }

            $shown[$hash] = 1;
        }

        unset($GLOBALS['MSG']);
    }

    /**
     * Get the license (link or image)
     *
     * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @param  string  $type ("link" or "image")
     * @param  integer $size of image
     * @param  bool    $return or print
     * @return string
     */
    public function getLicense($type = 'link', $size = 24, $return = false)
    {

        global $conf, $license, $lang;

        $target = $conf['target']['extern'];
        $lic    = $license[$conf['license']];
        $output = '';

        if (!$lic) {
            return '';
        }

        if ($type == 'link') {
            $output .= $lang['license'] . '<br/>';
        }

        $license_url  = $lic['url'];
        $license_name = $lic['name'];

        $output .= '<a href="' . $license_url . '" title="' . $license_name . '" target="' . $target . '" itemscope itemtype="http://schema.org/CreativeWork" itemprop="license" rel="license" class="license">';

        if ($type == 'image') {
            foreach (explode('-', $conf['license']) as $license_img) {
                if ($license_img == 'publicdomain') {
                    $license_img = 'pd';
                }

                $output .= '<img src="' . tpl_basedir() . "images/license/$license_img.png" . '" width="' . $size . '" height="' . $size . '" alt="' . $license_img . '" /> ';
            }
        } else {
            $output .= $lic['name'];
        }

        $output .= '</a>';

        if ($return) {
            return $output;
        }

        echo $output;
        return '';
    }

    /**
     * Add Google Analytics
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @return  string
     */
    public function getGoogleAnalitycs()
    {
        global $INFO;
        global $ID;

        if (!$this->getConf('useGoogleAnalytics')) {
            return false;
        }

        if (!$google_analitycs_id = $this->getConf('googleAnalyticsTrackID')) {
            return false;
        }

        if ($this->getConf('googleAnalyticsNoTrackAdmin') && $INFO['isadmin']) {
            return false;
        }

        if ($this->getConf('googleAnalyticsNoTrackUsers') && isset($_SERVER['REMOTE_USER'])) {
            return false;
        }

        if (tpl_getConf('googleAnalyticsNoTrackPages')) {
            if (preg_match_all($this->getConf('googleAnalyticsNoTrackPages'), $ID)) {
                return false;
            }
        }

        $out = DOKU_LF;
        $out .= '// Google Analytics' . DOKU_LF;
        $out .= 'window.dataLayer = window.dataLayer || [];' . DOKU_LF;
        $out .= 'function gtag(){dataLayer.push(arguments);}' . DOKU_LF;
        $out .= 'gtag("js", new Date());' . DOKU_LF;

        if ($this->getConf('googleAnalyticsAnonymizeIP')) {
            $out .= 'gtag("config", "' . $google_analitycs_id . '", {"anonimize_ip":true});' . DOKU_LF;
        } else {
            $out .= 'gtag("config", "' . $google_analitycs_id . '");' . DOKU_LF;
        }

        if ($this->getConf('googleAnalyticsTrackActions')) {
            $out .= 'gtag("event", JSINFO.bootstrap3.mode, {"eventCategory":"DokuWiki"});' . DOKU_LF;
        }

        $out .= '// End Google Analytics' . DOKU_LF;

        return $out;
    }

    /**
     * Return the user home-page link
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @return  string
     */
    public function getUserHomePageLink()
    {
        return wl($this->getUserHomePageID());
    }

    /**
     * Return the user home-page ID
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @return  string
     */
    public function getUserHomePageID()
    {
        $interwiki = getInterwiki();
        $page_id   = str_replace('{NAME}', $_SERVER['REMOTE_USER'], $interwiki['user']);

        return cleanID($page_id);
    }

    /**
     * Print the breadcrumbs trace with Bootstrap style
     *
     * @author Andreas Gohr <andi@splitbrain.org>
     * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @return bool
     */
    public function getBreadcrumbs()
    {
        global $lang;
        global $conf;

        //check if enabled
        if (!$conf['breadcrumbs']) {
            return false;
        }

        $crumbs = breadcrumbs(); //setup crumb trace

        //render crumbs, highlight the last one
        print '<ol class="breadcrumb">';
        print '<li>' . rtrim($lang['breadcrumb'], ':') . '</li>';

        $last = count($crumbs);
        $i    = 0;

        foreach ($crumbs as $id => $name) {
            $i++;

            print($i == $last) ? '<li class="active">' : '<li>';
            tpl_link(wl($id), hsc($name), 'title="' . $id . '"');
            print '</li>';

            if ($i == $last) {
                print '</ol>';
            }
        }

        return true;
    }

    /**
     * Hierarchical breadcrumbs with Bootstrap style
     *
     * This code was suggested as replacement for the usual breadcrumbs.
     * It only makes sense with a deep site structure.
     *
     * @author Andreas Gohr <andi@splitbrain.org>
     * @author Nigel McNie <oracle.shinoda@gmail.com>
     * @author Sean Coates <sean@caedmon.net>
     * @author <fredrik@averpil.com>
     * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     * @todo   May behave strangely in RTL languages
     *
     * @return bool
     */
    public function getYouAreHere()
    {
        global $conf;
        global $ID;
        global $lang;

        // check if enabled
        if (!$conf['youarehere']) {
            return false;
        }

        $parts = explode(':', $ID);
        $count = count($parts);

        echo '<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';
        echo '<li>' . rtrim($lang['youarehere'], ':') . '</li>';

        // always print the startpage
        echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';

        tpl_link(wl($conf['start']),
            '<span itemprop="name">' . iconify('mdi:home') . '<span class="sr-only">Home</span></span>',
            ' itemprop="item"  title="' . $conf['start'] . '"'
        );

        echo '<meta itemprop="position" content="1" />';
        echo '</li>';

        $position = 1;

        // print intermediate namespace links
        $part = '';

        for ($i = 0; $i < $count - 1; $i++) {
            $part .= $parts[$i] . ':';
            $page = $part;

            if ($page == $conf['start']) {
                continue;
            }
            // Skip startpage

            $position++;

            // output
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';

            $link = html_wikilink($page);
            $link = str_replace(['<span class="curid">', '</span>'], '', $link);
            $link = str_replace('<a', '<a itemprop="item" ', $link);
            $link = preg_replace('/data-wiki-id="(.+?)"/', '', $link);
            $link = str_replace('<a', '<span itemprop="name"><a', $link);
            $link = str_replace('</a>', '</a></span>', $link);

            echo $link;
            echo '<meta itemprop="position" content="' . $position . '" />';
            echo '</li>';
        }

        // print current page, skipping start page, skipping for namespace index
        $exists = false;
        resolve_pageid('', $page, $exists);

        if (isset($page) && $page == $part . $parts[$i]) {
            echo '</ol>';
            return true;
        }

        $page = $part . $parts[$i];

        if ($page == $conf['start']) {
            echo '</ol>';
            return true;
        }

        echo '<li class="active" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';

        $link = str_replace(['<span class="curid">', '</span>'], '', html_wikilink($page));
        $link = str_replace('<a ', '<a itemprop="item" ', $link);
        $link = str_replace('<a', '<span itemprop="name"><a', $link);
        $link = str_replace('</a>', '</a></span>', $link);
        $link = preg_replace('/data-wiki-id="(.+?)"/', '', $link);

        echo $link;
        echo '<meta itemprop="position" content="' . ++$position . '" />';
        echo '</li>';
        echo '</ol>';

        return true;
    }

    /**
     * Display the page title (and previous namespace page title) on browser titlebar
     *
     * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     * @return string
     */
    public function getBrowserPageTitle()
    {
        global $conf, $ACT, $ID;

        if ($this->getConf('browserTitleShowNS') && $ACT == 'show') {
            $ns_page      = '';
            $ns_parts     = explode(':', $ID);
            $ns_pages     = [];
            $ns_titles    = [];
            $ns_separator = sprintf(' %s ', $this->getConf('browserTitleCharSepNS'));

            if (useHeading('navigation')) {
                if (count($ns_parts) > 1) {
                    foreach ($ns_parts as $ns_part) {
                        $ns_page .= "$ns_part:";
                        $ns_pages[] = $ns_page;
                    }

                    $ns_pages = array_unique($ns_pages);

                    foreach ($ns_pages as $ns_page) {
                        $exists = false;
                        resolve_pageid(getNS($ns_page), $ns_page, $exists);

                        $ns_page_title_heading = hsc(p_get_first_heading($ns_page));
                        $ns_page_title_page    = noNSorNS($ns_page);
                        $ns_page_title         = ($exists) ? $ns_page_title_heading : null;

                        if ($ns_page_title !== $conf['start']) {
                            $ns_titles[] = $ns_page_title;
                        }
                    }
                }

                resolve_pageid(getNS($ID), $ID, $exists);

                if ($exists) {
                    $ns_titles[] = tpl_pagetitle($ID, true);
                } else {
                    $ns_titles[] = noNS($ID);
                }

                $ns_titles = array_filter(array_unique($ns_titles));
            } else {
                $ns_titles = $ns_parts;
            }

            if ($this->getConf('browserTitleOrderNS') == 'normal') {
                $ns_titles = array_reverse($ns_titles);
            }

            $browser_title = implode($ns_separator, $ns_titles);
        } else {
            $browser_title = tpl_pagetitle($ID, true);
        }

        return str_replace(
            ['@WIKI@', '@TITLE@'],
            [strip_tags($conf['title']), $browser_title],
            $this->getConf('browserTitle')
        );
    }

    /**
     * Return the theme for current namespace
     *
     * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     * @return string
     */
    public function getThemeForNamespace()
    {
        global $ID;

        $themes_filename = DOKU_CONF . 'bootstrap3.themes.conf';

        if (!$this->getConf('themeByNamespace')) {
            return [];
        }

        if (!file_exists($themes_filename)) {
            return [];
        }

        $config = confToHash($themes_filename);
        krsort($config);

        foreach ($config as $page => $theme) {
            if (preg_match("/^$page/", "$ID")) {
                list($bootstrap, $bootswatch) = explode('/', $theme);

                if ($bootstrap && in_array($bootstrap, ['default', 'optional', 'custom'])) {
                    return [$bootstrap, $bootswatch];
                }

                if ($bootstrap == 'bootswatch' && in_array($bootswatch, $this->getBootswatchThemeList())) {
                    return [$bootstrap, $bootswatch];
                }
            }
        }

        return [];
    }

    /**
     * Make a Bootstrap3 Nav
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @param   string   $html
     * @param   string   $type (= pills, tabs, navbar)
     * @param   boolean  $staked
     * @param   string   $optional_class
     * @return  string
     */
    public function toBootstrapNav($html, $type = '', $stacked = false, $optional_class = '')
    {
        $classes = [];

        $classes[] = 'nav';
        $classes[] = $optional_class;

        switch ($type) {
            case 'navbar':
            case 'navbar-nav':
                $classes[] = 'navbar-nav';
                break;
            case 'pills':
            case 'tabs':
                $classes[] = "nav-$type";
                break;
        }

        if ($stacked) {
            $classes[] = 'nav-stacked';
        }

        $class = implode(' ', $classes);

        $output = str_replace(
            ['<ul class="', '<ul>'],
            ["<ul class=\"$class ", "<ul class=\"$class\">"],
            $html
        );

        $output = $this->normalizeList($output);

        return $output;
    }

    /**
     * Normalize the DokuWiki list items
     *
     * @todo    use Simple DOM HTML library
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     * @todo    use Simple DOM HTML
     * @todo    FIX SimpleNavi curid
     *
     * @param   string  $html
     * @return  string
     */
    public function normalizeList($list)
    {

        global $ID;

        $list = preg_replace_callback('/data-wiki-id="(.+?)"/', [$this, '_replaceWikiCurrentIdCallback'], $list);

        $html = new \simple_html_dom;
        $html->load($list, true, false);

        # Create data-curid HTML5 attribute and unwrap span.curid for pre-Hogfather release
        foreach ($html->find('span.curid') as $elm) {
            $elm->firstChild()->setAttribute('data-wiki-curid', 'true');
            $elm->outertext = str_replace(['<span class="curid">', '</span>'], '', $elm->outertext);
        }

        # Unwrap div.li element
        foreach ($html->find('div.li') as $elm) {
            $elm->outertext = str_replace(['<div class="li">', '</div>'], '', $elm->outertext);
        }

        $list = $html->save();
        $html->clear();
        unset($html);

        $html = new \simple_html_dom;
        $html->load($list, true, false);

        foreach ($html->find('li') as $elm) {
            if ($elm->find('a[data-wiki-curid]')) {
                $elm->class .= ' active';
            }
        }

        $list = $html->save();
        $html->clear();
        unset($html);

        # TODO optimize
        $list = preg_replace('/<i (.+?)><\/i> <a (.+?)>(.+?)<\/a>/', '<a $2><i $1></i> $3</a>', $list);
        $list = preg_replace('/<span (.+?)><\/span> <a (.+?)>(.+?)<\/a>/', '<a $2><span $1></span> $3</a>', $list);

        return $list;
    }

    /**
     * Remove data-wiki-id HTML5 attribute
     *
     * @todo Remove this in future
     * @since Hogfather
     *
     * @param array $matches
     *
     * @return string
     */
    private function _replaceWikiCurrentIdCallback($matches)
    {

        global $ID;

        if ($ID == $matches[1]) {
            return 'data-wiki-curid="true"';
        }

        return '';

    }

    /**
     * Return a Bootstrap NavBar and or drop-down menu
     *
     * @todo    use Simple DOM HTML library
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @return  string
     */
    public function getNavbar()
    {
        global $INPUT;

        if ($this->getConf('showNavbar') === 'logged' && !$INPUT->server->has('REMOTE_USER')) {
            return false;
        }

        global $ID;
        global $conf;

        $navbar = $this->toBootstrapNav(tpl_include_page('navbar', 0, 1, $this->getConf('useACL')), 'navbar');

        $navbar = str_replace('urlextern', '', $navbar);

        $navbar = preg_replace('/<li class="level([0-9]) node"> (.*)/',
            '<li class="level$1 node dropdown"><a href="#" class="dropdown-toggle" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">$2 <span class="caret"></span></a>', $navbar);

        $navbar = preg_replace('/<li class="level([0-9]) node active"> (.*)/',
            '<li class="level$1 node active dropdown"><a href="#" class="dropdown-toggle" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">$2 <span class="caret"></span></a>', $navbar);

        # FIX for Purplenumbers renderer plugin
        # TODO use Simple DOM HTML or improve the regex!
        if ($conf['renderer_xhtml'] == 'purplenumbers') {
            $navbar = preg_replace('/<li class="level1"> (.*)/',
                '<li class="level1 dropdown"><a href="#" class="dropdown-toggle" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">$1 <span class="caret"></span></a>', $navbar);
        }

        $navbar = preg_replace('/<ul class="(.*)">\n<li class="level2(.*)">/',
            '<ul class="dropdown-menu" role="menu">' . PHP_EOL . '<li class="level2$2">', $navbar);

        return $navbar;
    }

    /**
     * Manipulate Sidebar page to add Bootstrap3 styling
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @param   string   $sidebar
     * @param   boolean  $return
     * @return  string
     */
    public function normalizeSidebar($sidebar, $return = false)
    {
        $out = $this->toBootstrapNav($sidebar, 'pills', true);
        $out = $this->normalizeContent($out);

        $html = new \simple_html_dom;
        $html->load($out, true, false);

        # TODO 'page-header' will be removed in the next release of Bootstrap
        foreach ($html->find('h1, h2, h3, h4, h5, h6') as $elm) {

            # Skip panel title on sidebar
            if (preg_match('/panel-title/', $elm->class)) {
                continue;
            }

            $elm->class .= ' page-header';
        }

        $out = $html->save();
        $html->clear();
        unset($html);

        if ($return) {
            return $out;
        }

        echo $out;
    }

    /**
     * Return a drop-down page
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @param   string  $page name
     * @return  string
     */
    public function getDropDownPage($page)
    {

        $page = page_findnearest($page, $this->getConf('useACL'));

        if (!$page) {
            return;
        }

        $output   = $this->normalizeContent($this->toBootstrapNav(tpl_include_page($page, 0, 1, $this->getConf('useACL')), 'pills', true));
        $dropdown = '<ul class="nav navbar-nav dw__dropdown_page">' .
        '<li class="dropdown dropdown-large">' .
        '<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="">' .
        p_get_first_heading($page) .
            ' <span class="caret"></span></a>' .
            '<ul class="dropdown-menu dropdown-menu-large" role="menu">' .
            '<li><div class="container small">' .
            $output .
            '</div></li></ul></li></ul>';

        return $dropdown;
    }

    /**
     * Include left or right sidebar
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @param   string  $type left or right sidebar
     * @return  boolean
     */
    public function includeSidebar($type)
    {
        global $conf;

        $left_sidebar       = $conf['sidebar'];
        $right_sidebar      = $this->getConf('rightSidebar');
        $left_sidebar_grid  = $this->getConf('leftSidebarGrid');
        $right_sidebar_grid = $this->getConf('rightSidebarGrid');

        if (!$this->getConf('showSidebar')) {
            return false;
        }

        switch ($type) {
            case 'left':

                if ($this->getConf('sidebarPosition') == 'left') {
                    $this->sidebarWrapper($left_sidebar, 'dokuwiki__aside', $left_sidebar_grid, 'sidebarheader', 'sidebarfooter');
                }

                return true;

            case 'right':

                if ($this->getConf('sidebarPosition') == 'right') {
                    $this->sidebarWrapper($left_sidebar, 'dokuwiki__aside', $left_sidebar_grid, 'sidebarheader', 'sidebarfooter');
                }

                if ($this->getConf('showRightSidebar')
                    && $this->getConf('sidebarPosition') == 'left') {
                    $this->sidebarWrapper($right_sidebar, 'dokuwiki__rightaside', $right_sidebar_grid, 'rightsidebarheader', 'rightsidebarfooter');
                }

                return true;
        }

        return false;
    }

    /**
     * Wrapper for left or right sidebar
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @param  string  $sidebar_page
     * @param  string  $sidebar_id
     * @param  string  $sidebar_header
     * @param  string  $sidebar_footer
     */
    private function sidebarWrapper($sidebar_page, $sidebar_id, $sidebar_class, $sidebar_header, $sidebar_footer)
    {
        global $lang;
        global $TPL;

        @require $this->tplDir . 'tpl/sidebar.php';
    }

    /**
     * Add Bootstrap classes in a DokuWiki content
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @param   string  $content from tpl_content() or from tpl_include_page()
     * @return  string  with Bootstrap styles
     */
    public function normalizeContent($content)
    {
        global $ACT;
        global $INPUT;
        global $INFO;

        # FIX :-\ smile
        $content = str_replace(['alt=":-\"', "alt=':-\'"], 'alt=":-&#92;"', $content);

        # Workaround for ToDo Plugin
        $content = str_replace('checked="checked"', ' checked="checked"', $content);

        # Return original content if Simple HTML DOM fail or exceeded page size (default MAX_FILE_SIZE => 600KB)
        if (strlen($content) > MAX_FILE_SIZE) {
            return $content;
        }

        # Import HTML string
        $html = new \simple_html_dom;
        $html->load($content, true, false);

        # Return original content if Simple HTML DOM fail or exceeded page size (default MAX_FILE_SIZE => 600KB)
        if (!$html) {
            return $content;
        }

        # Move Current Page ID to <a> element and create data-curid HTML5 attribute (pre-Hogfather release)
        foreach ($html->find('.curid') as $elm) {
            foreach ($elm->find('a') as $link) {
                $link->class .= ' curid';
                $link->attr[' data-curid'] = 'true'; # FIX attribute
            }
        }

        # Unwrap span.curid elements
        foreach ($html->find('span.curid') as $elm) {
            $elm->outertext = str_replace(['<span class="curid">', '</span>'], '', $elm->outertext);
        }

        # Footnotes
        foreach ($html->find('.footnotes') as $elm) {
            $elm->outertext = '<hr/>' . $elm->outertext;
        }

        # Accessibility (a11y)
        foreach ($html->find('.a11y') as $elm) {
            if (!preg_match('/picker/', $elm->class)) {
                $elm->class .= ' sr-only';
            }
        }

        # Fix list overlap in media images
        foreach ($html->find('ul, ol') as $elm) {
            if (!preg_match('/(nav|dropdown-menu)/', $elm->class)) {
                $elm->class .= ' fix-media-list-overlap';
            }
        }

        # Buttons
        foreach ($html->find('.button') as $elm) {
            if ($elm->tag !== 'form') {
                $elm->class .= ' btn';
            }
        }

        foreach ($html->find('[type=button], [type=submit], [type=reset]') as $elm) {
            $elm->class .= ' btn btn-default';
        }

        # Tabs
        foreach ($html->find('.tabs') as $elm) {
            $elm->class = 'nav nav-tabs';
        }

        # Tabs (active)
        foreach ($html->find('.nav-tabs strong') as $elm) {
            $elm->outertext = '<a href="#">' . $elm->innertext . "</a>";
            $parent         = $elm->parent()->class .= ' active';
        }

        # Page Heading (h1-h2)
        # TODO this class will be removed in Bootstrap >= 4.0 version
        foreach ($html->find('h1,h2,h3') as $elm) {
            $elm->class .= ' page-header pb-3 mb-4 mt-5'; # TODO replace page-header with border-bottom in BS4
        }

        # Media Images
        foreach ($html->find('img[class^=media]') as $elm) {
            $elm->class .= ' img-responsive';
        }

        # Checkbox
        foreach ($html->find('input[type=checkbox]') as $elm) {
            $elm->class .= ' checkbox-inline';
        }

        # Radio button
        foreach ($html->find('input[type=radio]') as $elm) {
            $elm->class .= ' radio-inline';
        }

        # Label
        foreach ($html->find('label') as $elm) {
            $elm->class .= ' control-label';
        }

        # Form controls
        foreach ($html->find('input, select, textarea') as $elm) {
            if (!in_array($elm->type, ['submit', 'reset', 'button', 'hidden', 'image', 'checkbox', 'radio', 'color'])) {
                $elm->class .= ' form-control';
            }
        }

        # Forms
        # TODO main form
        foreach ($html->find('form') as $elm) {
            if (!preg_match('/form-horizontal/', $elm->class)) {
                $elm->class .= ' form-inline';
            }
        }

        # Alerts
        foreach ($html->find('div.info, div.error, div.success, div.notify') as $elm) {
            switch ($elm->class) {
                case 'info':
                    $elm->class     = 'alert alert-info';
                    $elm->innertext = iconify('mdi:information') . ' ' . $elm->innertext;
                    break;

                case 'error':
                    $elm->class     = 'alert alert-danger';
                    $elm->innertext = iconify('mdi:alert-octagon') . ' ' . $elm->innertext;
                    break;

                case 'success':
                    $elm->class     = 'alert alert-success';
                    $elm->innertext = iconify('mdi:check-circle') . ' ' . $elm->innertext;
                    break;

                case 'notify':
                case 'msg notify':
                    $elm->class     = 'alert alert-warning';
                    $elm->innertext = iconify('mdi:alert') . ' ' . $elm->innertext;
                    break;
            }
        }

        # Tables

        $table_classes = 'table';

        foreach ($this->getConf('tableStyle') as $class) {
            if ($class == 'responsive') {
                foreach ($html->find('div.table') as $elm) {
                    $elm->class = 'table-responsive';
                }
            } else {
                $table_classes .= " table-$class";
            }
        }

        foreach ($html->find('table.inline,table.import_failures') as $elm) {
            $elm->class .= " $table_classes";
        }

        foreach ($html->find('div.table') as $elm) {
            $elm->class = trim(str_replace('table', '', $elm->class));
        }

        # Tag and Pagelist (table)

        if ($this->getPlugin('tag') || $this->getPlugin('pagelist')) {
            foreach ($html->find('table.ul') as $elm) {
                $elm->class .= " $table_classes";
            }
        }

        $content = $html->save();

        $html->clear();
        unset($html);

        # ----- Actions -----

        # Search

        if ($ACT == 'search') {
            # Import HTML string
            $html = new \simple_html_dom;
            $html->load($content, true, false);

            foreach ($html->find('fieldset.search-form button[type="submit"]') as $elm) {
                $elm->class .= ' btn-primary';
                $elm->innertext = iconify('mdi:magnify', ['class' => 'mr-2']) . $elm->innertext;
            }

            $content = $html->save();

            $html->clear();
            unset($html);
        }

        # Index / Sitemap

        if ($ACT == 'index') {
            # Import HTML string
            $html = new \simple_html_dom;
            $html->load($content, true, false);

            foreach ($html->find('.idx_dir') as $idx => $elm) {
                $parent = $elm->parent()->parent();

                if (preg_match('/open/', $parent->class)) {
                    $elm->innertext = iconify('mdi:folder-open', ['class' => 'text-primary mr-2']) . $elm->innertext;
                }

                if (preg_match('/closed/', $parent->class)) {
                    $elm->innertext = iconify('mdi:folder', ['class' => 'text-primary mr-2']) . $elm->innertext;
                }
            }

            foreach ($html->find('.idx .wikilink1') as $elm) {
                $elm->innertext = iconify('mdi:file-document-outline', ['class' => 'text-muted mr-2']) . $elm->innertext;
            }

            $content = $html->save();

            $html->clear();
            unset($html);
        }

        # Admin Pages

        if ($ACT == 'admin') {
            # Import HTML string
            $html = new \simple_html_dom;
            $html->load($content, true, false);

            // Set specific icon in Admin Page
            if ($INPUT->str('page')) {
                if ($admin_pagetitle = $html->find('h1.page-header', 0)) {
                    $admin_pagetitle->class .= ' ' . hsc($INPUT->str('page'));
                }
            }

            # ACL

            if ($INPUT->str('page') == 'acl') {
                foreach ($html->find('[name*=cmd[update]]') as $elm) {
                    $elm->class .= ' btn-success';
                    if ($elm->tag == 'button') {
                        $elm->innertext = iconify('mdi:content-save') . ' ' . $elm->innertext;
                    }
                }
            }

            # Popularity

            if ($INPUT->str('page') == 'popularity') {
                foreach ($html->find('[type=submit]') as $elm) {
                    $elm->class .= ' btn-primary';

                    if ($elm->tag == 'button') {
                        $elm->innertext = iconify('mdi:arrow-right') . ' ' . $elm->innertext;
                    }
                }
            }

            # Revert Manager

            if ($INPUT->str('page') == 'revert') {
                foreach ($html->find('[type=submit]') as $idx => $elm) {
                    if ($idx == 0) {
                        $elm->class .= ' btn-primary';
                        if ($elm->tag == 'button') {
                            $elm->innertext = iconify('mdi:magnify') . ' ' . $elm->innertext;
                        }
                    }

                    if ($idx == 1) {
                        $elm->class .= ' btn-success';
                        if ($elm->tag == 'button') {
                            $elm->innertext = iconify('mdi:refresh') . ' ' . $elm->innertext;
                        }
                    }
                }
            }

            # Config

            if ($INPUT->str('page') == 'config') {
                foreach ($html->find('[type=submit]') as $elm) {
                    $elm->class .= ' btn-success';
                    if ($elm->tag == 'button') {
                        $elm->innertext = iconify('mdi:content-save') . ' ' . $elm->innertext;
                    }
                }

                foreach ($html->find('#config__manager') as $cm_elm) {
                    $save_button = '';

                    foreach ($cm_elm->find('p') as $elm) {
                        $save_button    = '<div class="pull-right">' . $elm->outertext . '</div>';
                        $elm->outertext = '</div>' . $elm->outertext;
                    }

                    foreach ($cm_elm->find('fieldset') as $elm) {
                        $elm->innertext .= $save_button;
                    }
                }
            }

            # User Manager

            if ($INPUT->str('page') == 'usermanager') {
                foreach ($html->find('.notes') as $elm) {
                    $elm->class = str_replace('notes', '', $elm->class);
                }

                foreach ($html->find('h2') as $idx => $elm) {
                    switch ($idx) {
                        case 0:
                            $elm->innertext = iconify('mdi:account-multiple') . ' ' . $elm->innertext;
                            break;
                        case 1:
                            $elm->innertext = iconify('mdi:account-plus') . ' ' . $elm->innertext;
                            break;
                        case 2:
                            $elm->innertext = iconify('mdi:account-edit') . ' ' . $elm->innertext;
                            break;
                    }
                }

                foreach ($html->find('.import_users h2') as $elm) {
                    $elm->innertext = iconify('mdi:account-multiple-plus') . ' ' . $elm->innertext;
                }

                foreach ($html->find('button[name*=fn[delete]]') as $elm) {
                    $elm->class .= ' btn btn-danger';
                    $elm->innertext = iconify('mdi:account-minus') . ' ' . $elm->innertext;
                }

                foreach ($html->find('button[name*=fn[add]]') as $elm) {
                    $elm->class .= ' btn btn-success';
                    $elm->innertext = iconify('mdi:plus') . ' ' . $elm->innertext;
                }

                foreach ($html->find('button[name*=fn[modify]]') as $elm) {
                    $elm->class .= ' btn btn-success';
                    $elm->innertext = iconify('mdi:content-save') . ' ' . $elm->innertext;
                }

                foreach ($html->find('button[name*=fn[import]]') as $elm) {
                    $elm->class .= ' btn btn-primary';
                    $elm->innertext = iconify('mdi:upload') . ' ' . $elm->innertext;
                }

                foreach ($html->find('button[name*=fn[export]]') as $elm) {
                    $elm->class .= ' btn btn-primary';
                    $elm->innertext = iconify('mdi:download') . ' ' . $elm->innertext;
                }

                foreach ($html->find('button[name*=fn[start]]') as $elm) {
                    $elm->class .= ' btn btn-default';
                    $elm->innertext = iconify('mdi:chevron-double-left') . ' ' . $elm->innertext;
                }

                foreach ($html->find('button[name*=fn[prev]]') as $elm) {
                    $elm->class .= ' btn btn-default';
                    $elm->innertext = iconify('mdi:chevron-left') . ' ' . $elm->innertext;
                }

                foreach ($html->find('button[name*=fn[next]]') as $elm) {
                    $elm->class .= ' btn btn-default';
                    $elm->innertext = iconify('mdi:chevron-right') . ' ' . $elm->innertext;
                }

                foreach ($html->find('button[name*=fn[last]]') as $elm) {
                    $elm->class .= ' btn btn-default';
                    $elm->innertext = iconify('mdi:chevron-double-right') . ' ' . $elm->innertext;
                }
            }

            # Extension Manager

            if ($INPUT->str('page') == 'extension') {
                foreach ($html->find('.actions') as $elm) {
                    $elm->class .= ' pl-4 btn-group btn-group-xs';
                }

                foreach ($html->find('.actions .uninstall') as $elm) {
                    $elm->class .= ' btn-danger';
                    $elm->innertext = iconify('mdi:delete') . ' ' . $elm->innertext;
                }

                foreach ($html->find('.actions .enable') as $elm) {
                    $elm->class .= ' btn-success';
                    $elm->innertext = iconify('mdi:check') . ' ' . $elm->innertext;
                }

                foreach ($html->find('.actions .disable') as $elm) {
                    $elm->class .= ' btn-warning';
                    $elm->innertext = iconify('mdi:block-helper') . ' ' . $elm->innertext;
                }

                foreach ($html->find('.actions .install, .actions .update, .actions .reinstall') as $elm) {
                    $elm->class .= ' btn-primary';
                    $elm->innertext = iconify('mdi:download') . ' ' . $elm->innertext;
                }

                foreach ($html->find('form.install [type=submit]') as $elm) {
                    $elm->class .= ' btn btn-success';
                    $elm->innertext = iconify('mdi:download') . ' ' . $elm->innertext;
                }

                foreach ($html->find('form.search [type=submit]') as $elm) {
                    $elm->class .= ' btn btn-primary';
                    $elm->innertext = iconify('mdi:cloud-search') . ' ' . $elm->innertext;
                }

                foreach ($html->find('.permerror') as $elm) {
                    $elm->class .= ' pull-left';
                }
            }

            # Admin page
            if ($INPUT->str('page') == null) {
                foreach ($html->find('ul.admin_tasks, ul.admin_plugins') as $admin_task) {
                    $admin_task->class .= ' list-group';

                    foreach ($admin_task->find('a') as $item) {
                        $item->class .= ' list-group-item';
                        $item->style = 'max-height: 50px'; # TODO remove
                    }

                    foreach ($admin_task->find('.icon') as $item) {
                        if ($item->innertext) {
                            continue;
                        }

                        $item->innertext = iconify('mdi:puzzle', ['class' => 'text-success']);
                    }
                }

                foreach ($html->find('h2') as $elm) {
                    $elm->innertext = iconify('mdi:puzzle', ['class' => 'text-success']) . ' ' . $elm->innertext;
                }

                foreach ($html->find('ul.admin_plugins') as $admin_plugins) {
                    $admin_plugins->class .= ' col-sm-4';
                    foreach ($admin_plugins->find('li') as $idx => $item) {
                        if ($idx > 0 && $idx % 5 == 0) {
                            $item->outertext = '</ul><ul class="' . $admin_plugins->class . '">' . $item->outertext;
                        }
                    }
                }

                # DokuWiki logo
                if ($admin_version = $html->getElementById('admin__version')) {
                    $admin_version->innertext = '<div class="dokuwiki__version"><img src="' . DOKU_BASE . 'lib/tpl/dokuwiki/images/logo.png" class="p-2" alt="" width="32" height="32" /> ' . $admin_version->innertext . '</div>';

                    $template_version = $this->getVersion();

                    $admin_version->innertext .= '<div class="template__version"><img src="' . tpl_basedir() . 'images/bootstrap.png" class="p-2" height="32" width="32" alt="" />Template ' . $template_version . '</div>';
                }
            }

            $content = $html->save();

            $html->clear();
            unset($html);

            # Configuration Manager Template Sections
            if ($INPUT->str('page') == 'config') {
                # Import HTML string
                $html = new \simple_html_dom;
                $html->load($content, true, false);

                foreach ($html->find('fieldset[id^="plugin__"]') as $elm) {

                    /** @var array $matches */
                    preg_match('/plugin_+(\w+[^_])_+plugin_settings_name/', $elm->id, $matches);

                    $plugin_name = $matches[1];

                    if ($extension = plugin_load('helper', 'extension_extension')) {
                        if ($extension->setExtension($plugin_name)) {
                            foreach ($elm->find('legend') as $legend) {
                                $legend->innertext = iconify('mdi:puzzle', ['class' => 'text-success']) . ' ' . $legend->innertext . ' <br/><h6>' . $extension->getDescription() . ' <a class="urlextern" href="' . $extension->getURL() . '" target="_blank">Docs</a></h6>';
                            }
                        }
                    } else {
                        foreach ($elm->find('legend') as $legend) {
                            $legend->innertext = iconify('mdi:puzzle', ['class' => 'text-success']) . ' ' . $legend->innertext;
                        }
                    }
                }

                $dokuwiki_configs = [
                    '#_basic'          => 'mdi:settings',
                    '#_display'        => 'mdi:monitor',
                    '#_authentication' => 'mdi:shield-account',
                    '#_anti_spam'      => 'mdi:block-helper',
                    '#_editing'        => 'mdi:pencil',
                    '#_links'          => 'mdi:link-variant',
                    '#_media'          => 'mdi:folder-image',
                    '#_notifications'  => 'mdi:email',
                    '#_syndication'    => 'mdi:rss',
                    '#_advanced'       => 'mdi:palette-advanced',
                    '#_network'        => 'mdi:network',
                ];

                foreach ($dokuwiki_configs as $selector => $icon) {
                    foreach ($html->find("$selector legend") as $elm) {
                        $elm->innertext = iconify($icon) . ' ' . $elm->innertext;
                    }
                }

                $content = $html->save();

                $html->clear();
                unset($html);

                $admin_sections = [
                    // Section => [ Insert Before, Icon ]
                    'theme'            => ['bootstrapTheme', 'mdi:palette'],
                    'sidebar'          => ['sidebarPosition', 'mdi:page-layout-sidebar-left'],
                    'navbar'           => ['inverseNavbar', 'mdi:page-layout-header'],
                    'semantic'         => ['semantic', 'mdi:share-variant'],
                    'layout'           => ['fluidContainer', 'mdi:monitor'],
                    'toc'              => ['tocAffix', 'mdi:view-list'],
                    'discussion'       => ['showDiscussion', 'mdi:comment-text-multiple'],
                    'avatar'           => ['useAvatar', 'mdi:account'],
                    'cookie_law'       => ['showCookieLawBanner', 'mdi:scale-balance'],
                    'google_analytics' => ['useGoogleAnalytics', 'mdi:google'],
                    'browser_title'    => ['browserTitle', 'mdi:format-title'],
                    'page'             => ['showPageInfo', 'mdi:file'],
                ];

                foreach ($admin_sections as $section => $items) {
                    $search = $items[0];
                    $icon   = $items[1];

                    $content = preg_replace(
                        '/<span class="outkey">(tpl»bootstrap3»' . $search . ')<\/span>/',
                        '<h3 id="bootstrap3__' . $section . '" class="mt-5">' . iconify($icon) . ' ' . tpl_getLang("config_$section") . '</h3></td><td></td></tr><tr><td class="label"><span class="outkey">$1</span>',
                        $content
                    );
                }
            }
        }

        # Difference and Draft

        if ($ACT == 'diff' || $ACT == 'draft') {
            # Import HTML string
            $html = new \simple_html_dom;
            $html->load($content, true, false);

            foreach ($html->find('.diff-lineheader') as $elm) {
                $elm->style = 'opacity: 0.5';
                $elm->class .= ' text-center px-3';

                if ($elm->innertext == '+') {
                    $elm->class .= ' bg-success';
                }
                if ($elm->innertext == '-') {
                    $elm->class .= ' bg-danger';
                }
            }

            foreach ($html->find('.diff_sidebyside .diff-deletedline, .diff_sidebyside .diff-addedline') as $elm) {
                $elm->class .= ' w-50';
            }

            foreach ($html->find('.diff-deletedline') as $elm) {
                $elm->class .= ' bg-danger';
            }

            foreach ($html->find('.diff-addedline') as $elm) {
                $elm->class .= ' bg-success';
            }

            foreach ($html->find('.diffprevrev') as $elm) {
                $elm->class .= ' btn btn-default';
                $elm->innertext = iconify('mdi:chevron-left') . ' ' . $elm->innertext;
            }

            foreach ($html->find('.diffnextrev') as $elm) {
                $elm->class .= ' btn btn-default';
                $elm->innertext = iconify('mdi:chevron-right') . ' ' . $elm->innertext;
            }

            foreach ($html->find('.diffbothprevrev') as $elm) {
                $elm->class .= ' btn btn-default';
                $elm->innertext = iconify('mdi:chevron-double-left') . ' ' . $elm->innertext;
            }

            foreach ($html->find('.minor') as $elm) {
                $elm->class .= ' text-muted';
            }

            $content = $html->save();

            $html->clear();
            unset($html);
        }

        # Add icons for Extensions, Actions, etc.

        $svg_icon      = null;
        $iconify_icon  = null;
        $iconify_attrs = ['class' => 'mr-2'];

        if (!$INFO['exists'] && $ACT == 'show') {
            $iconify_icon           = 'mdi:alert';
            $iconify_attrs['style'] = 'color:orange';
        }

        $menu_class = "\\dokuwiki\\Menu\\Item\\$ACT";

        if (class_exists($menu_class, false)) {
            $menu_item = new $menu_class;
            $svg_icon  = $menu_item->getSvg();
        }

        switch ($ACT) {
            case 'admin':

                if (($plugin = plugin_load('admin', $INPUT->str('page'))) !== null) {
                    if (method_exists($plugin, 'getMenuIcon')) {
                        $svg_icon = $plugin->getMenuIcon();

                        if (!file_exists($svg_icon)) {
                            $iconify_icon = 'mdi:puzzle';
                            $svg_icon     = null;
                        }
                    } else {
                        $iconify_icon = 'mdi:puzzle';
                        $svg_icon     = null;
                    }
                }

                break;

            case 'resendpwd':
                $iconify_icon = 'mdi:lock-reset';
                break;

            case 'denied':
                $iconify_icon           = 'mdi:block-helper';
                $iconify_attrs['style'] = 'color:red';
                break;

            case 'search':
                $iconify_icon = 'mdi:search-web';
                break;

            case 'preview':
                $iconify_icon = 'mdi:file-eye';
                break;

            case 'diff':
                $iconify_icon = 'mdi:file-compare';
                break;

            case 'showtag':
                $iconify_icon = 'mdi:tag-multiple';
                break;

            case 'draft':
                $iconify_icon = 'mdi:android-studio';
                break;

        }

        if ($svg_icon) {
            $svg_attrs = ['class' => 'iconify mr-2'];

            if ($ACT == 'admin' && $INPUT->str('page') == 'extension') {
                $svg_attrs['style'] = 'fill: green;';
            }

            $svg = SVG::icon($svg_icon, null, '1em', $svg_attrs);

            # Import HTML string
            $html = new \simple_html_dom;
            $html->load($content, true, false);

            foreach ($html->find('h1') as $elm) {
                $elm->innertext = $svg . ' ' . $elm->innertext;
                break;
            }

            $content = $html->save();

            $html->clear();
            unset($html);
        }

        if ($iconify_icon) {
            # Import HTML string
            $html = new \simple_html_dom;
            $html->load($content, true, false);

            foreach ($html->find('h1') as $elm) {
                $elm->innertext = iconify($iconify_icon, $iconify_attrs) . $elm->innertext;
                break;
            }

            $content = $html->save();

            $html->clear();
            unset($html);
        }

        return $content;
    }

    /**
     * Detect the fluid navbar flag
     *
     * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     * @return boolean
     */
    public function isFluidNavbar()
    {
        $fluid_container  = $this->getConf('fluidContainer');
        $fixed_top_nabvar = $this->getConf('fixedTopNavbar');

        return ($fluid_container || ($fluid_container && !$fixed_top_nabvar) || (!$fluid_container && !$fixed_top_nabvar));
    }

    /**
     * Calculate automatically the grid size for main container
     *
     * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @return  string
     */
    public function getContainerGrid()
    {
        global $ID;

        $result = '';

        $grids = [
            'sm' => ['left' => 0, 'right' => 0],
            'md' => ['left' => 0, 'right' => 0],
        ];

        $show_right_sidebar = $this->getConf('showRightSidebar');
        $show_left_sidebar  = $this->getConf('showSidebar');
        $fluid_container    = $this->getConf('fluidContainer');

        if ($this->getConf('showLandingPage') && (bool) preg_match($this->getConf('landingPages'), $ID)) {
            $show_left_sidebar = false;
        }

        if ($show_left_sidebar) {
            foreach (explode(' ', $this->getConf('leftSidebarGrid')) as $grid) {
                list($col, $media, $size) = explode('-', $grid);
                $grids[$media]['left']    = (int) $size;
            }
        }

        if ($show_right_sidebar) {
            foreach (explode(' ', $this->getConf('rightSidebarGrid')) as $grid) {
                list($col, $media, $size) = explode('-', $grid);
                $grids[$media]['right']   = (int) $size;
            }
        }

        foreach ($grids as $media => $position) {
            $left  = $position['left'];
            $right = $position['right'];
            $result .= sprintf('col-%s-%s ', $media, (12 - $left - $right));
        }

        return $result;
    }

    /**
     * Places the TOC where the function is called
     *
     * If you use this you most probably want to call tpl_content with
     * a false argument
     *
     * @author Andreas Gohr <andi@splitbrain.org>
     * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @param bool $return Should the TOC be returned instead to be printed?
     * @return string
     */
    public function getTOC($return = false)
    {
        global $TOC;
        global $ACT;
        global $ID;
        global $REV;
        global $INFO;
        global $conf;
        global $INPUT;

        $toc = [];

        if (is_array($TOC)) {
            // if a TOC was prepared in global scope, always use it
            $toc = $TOC;
        } elseif (($ACT == 'show' || substr($ACT, 0, 6) == 'export') && !$REV && $INFO['exists']) {
            // get TOC from metadata, render if neccessary
            $meta = p_get_metadata($ID, '', METADATA_RENDER_USING_CACHE);
            if (isset($meta['internal']['toc'])) {
                $tocok = $meta['internal']['toc'];
            } else {
                $tocok = true;
            }
            $toc = isset($meta['description']['tableofcontents']) ? $meta['description']['tableofcontents'] : null;
            if (!$tocok || !is_array($toc) || !$conf['tocminheads'] || count($toc) < $conf['tocminheads']) {
                $toc = [];
            }
        } elseif ($ACT == 'admin') {
            // try to load admin plugin TOC
            /** @var $plugin DokuWiki_Admin_Plugin */
            if ($plugin = plugin_getRequestAdminPlugin()) {
                $toc = $plugin->getTOC();
                $TOC = $toc; // avoid later rebuild
            }
        }

        $toc_check     = end($toc);
        $toc_undefined = null;

        if (isset($toc_check['link']) && !preg_match('/bootstrap/', $toc_check['link'])) {
            $toc_undefined = array_pop($toc);
        }

        \dokuwiki\Extension\Event::createAndTrigger('TPL_TOC_RENDER', $toc, null, false);

        if ($ACT == 'admin' && $INPUT->str('page') == 'config') {
            $bootstrap3_sections = [
                'theme', 'sidebar', 'navbar', 'semantic', 'layout', 'toc',
                'discussion', 'avatar', 'cookie_law', 'google_analytics',
                'browser_title', 'page',
            ];

            foreach ($bootstrap3_sections as $id) {
                $toc[] = [
                    'link'  => "#bootstrap3__$id",
                    'title' => tpl_getLang("config_$id"),
                    'type'  => 'ul',
                    'level' => 3,
                ];
            }
        }

        if ($toc_undefined) {
            $toc[] = $toc_undefined;
        }

        $html = $this->renderTOC($toc);

        if ($return) {
            return $html;
        }

        echo $html;
        return '';
    }

    /**
     * Return the TOC rendered to XHTML with Bootstrap3 style
     *
     * @author Andreas Gohr <andi@splitbrain.org>
     * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
     *
     * @param array $toc
     * @return string html
     */
    private function renderTOC($toc)
    {
        if (!count($toc)) {
            return '';
        }

        global $lang;

        $json_toc = [];

        foreach ($toc as $item) {
            $json_toc[] = [
                'link'  => (isset($item['link']) ? $item['link'] : '#' . $item['hid']),
                'title' => $item['title'],
                'level' => $item['level'],
            ];
        }

        $out = '';
        $out .= '<script>JSINFO.bootstrap3.toc = ' . json_encode($json_toc) . ';</script>' . DOKU_LF;

        if ($this->getConf('tocLayout') !== 'navbar') {
            $out .= '<!-- TOC START -->' . DOKU_LF;
            $out .= '<div class="dw-toc hidden-print">' . DOKU_LF;
            $out .= '<nav id="dw__toc" role="navigation" class="toc-panel panel panel-default small">' . DOKU_LF;
            $out .= '<h6 data-toggle="collapse" data-target="#dw__toc .toc-body" title="' . $lang['toc'] . '" class="panel-heading toc-title">' . iconify('mdi:view-list') . ' ';
            $out .= '<span>' . $lang['toc'] . '</span>';
            $out .= ' <i class="caret"></i></h6>' . DOKU_LF;
            $out .= '<div class="panel-body  toc-body collapse ' . (!$this->getConf('tocCollapsed') ? 'in' : '') . '">' . DOKU_LF;
            $out .= $this->normalizeList(html_buildlist($toc, 'nav toc', 'html_list_toc', 'html_li_default', true)) . DOKU_LF;
            $out .= '</div>' . DOKU_LF;
            $out .= '</nav>' . DOKU_LF;
            $out .= '</div>' . DOKU_LF;
            $out .= '<!-- TOC END -->' . DOKU_LF;
        }

        return $out;
    }

    private function initToolsMenu()
    {
        global $ACT;

        $tools_menus = [
            'user' => ['icon' => 'mdi:account', 'object' => new \dokuwiki\Menu\UserMenu],
            'site' => ['icon' => 'mdi:toolbox', 'object' => new \dokuwiki\Menu\SiteMenu],
            'page' => ['icon' => 'mdi:file-document-outline', 'object' => new \dokuwiki\template\bootstrap3\Menu\PageMenu],
        ];

        if (defined('DOKU_MEDIADETAIL')) {
            $tools_menus['page'] = ['icon' => 'mdi:image', 'object' => new \dokuwiki\template\bootstrap3\Menu\DetailMenu];
        }

        foreach ($tools_menus as $tool => $data) {
            foreach ($data['object']->getItems() as $item) {
                $attr   = buildAttributes($item->getLinkAttributes());
                $active = 'action';

                if ($ACT == $item->getType() || ($ACT == 'revisions' && $item->getType() == 'revs') || ($ACT == 'diff' && $item->getType() == 'revs')) {
                    $active .= ' active';
                }

                if ($item->getType() == 'shareon') {
                    $active .= ' dropdown';
                }

                $html = '<li class="' . $active . '">';
                $html .= "<a $attr>";
                $html .= \inlineSVG($item->getSvg());
                $html .= '<span>' . hsc($item->getLabel()) . '</span>';
                $html .= "</a>";

                if ($item->getType() == 'shareon') {
                    $html .= $item->getDropDownMenu();
                }

                $html .= '</li>';

                $tools_menus[$tool]['menu'][$item->getType()]['object'] = $item;
                $tools_menus[$tool]['menu'][$item->getType()]['html']   = $html;
            }
        }

        $this->toolsMenu = $tools_menus;
    }

    public function getToolsMenu()
    {
        return $this->toolsMenu;
    }

    public function getToolMenu($tool)
    {
        return $this->toolsMenu[$tool];
    }

    public function getToolMenuItem($tool, $item)
    {
        if (isset($this->toolsMenu[$tool]) && isset($this->toolsMenu[$tool]['menu'][$item])) {
            return $this->toolsMenu[$tool]['menu'][$item]['object'];
        }
        return null;
    }

    public function getToolMenuItemLink($tool, $item)
    {
        if (isset($this->toolsMenu[$tool]) && isset($this->toolsMenu[$tool]['menu'][$item])) {
            return $this->toolsMenu[$tool]['menu'][$item]['html'];
        }
        return null;
    }

    public function getNavbarHeight()
    {
        switch ($this->getBootswatchTheme()) {
            case 'simplex':
            case 'superhero':
                return 40;

            case 'yeti':
                return 45;

            case 'cerulean':
            case 'cosmo':
            case 'custom':
            case 'cyborg':
            case 'lumen':
            case 'slate':
            case 'spacelab':
            case 'solar':
            case 'united':
                return 50;

            case 'darkly':
            case 'flatly':
            case 'journal':
            case 'sandstone':
                return 60;

            case 'paper':
                return 64;

            case 'readable':
                return 65;

            default:
                return 50;
        }
    }
}
