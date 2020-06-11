<?php

/**
 * DokuWiki Bootstrap3 Template: CSS Asset Dispatcher
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

# NOTE Some Linux distributon change the location of DokuWiki core libraries (DOKU_INC)
#
#      Bitnami (Docker)         /opt/bitnami/dokuwiki
#      LinuxServer.io (Docker)  /app/dokuwiki
#      Arch Linux               /usr/share/webapps/dokuwiki
#      Debian/Ubuntu            /usr/share/dokuwiki
#
# NOTE If DokuWiki core libraries (DOKU_INC) is in another location you can
#      create a PHP file in bootstrap3 root directory called "doku_inc.php" with
#      this content:
#
#           <?php define('DOKU_INC', '/path/dokuwiki/');
#
#      (!) This file will be deleted on every upgrade of template

$doku_inc_dirs = array(
    '/opt/bitnami/dokuwiki',                      # Bitnami (Docker)
    '/usr/share/webapps/dokuwiki',                # Arch Linux
    '/usr/share/dokuwiki',                        # Debian/Ubuntu
    '/app/dokuwiki',                              # LinuxServer.io (Docker),
    realpath(dirname(__FILE__) . '/../../../'),   # Default DokuWiki path
);

# Load doku_inc.php file
#
if (file_exists(dirname(__FILE__) . '/doku_inc.php')) {
    require_once dirname(__FILE__) . '/doku_inc.php';
}

if (! defined('DOKU_INC')) {
    foreach ($doku_inc_dirs as $dir) {
        if (! defined('DOKU_INC') && @file_exists("$dir/inc/init.php")) {
            define('DOKU_INC', "$dir/");
        }
    }
}


// we do not use a session or authentication here (better caching)

if (!defined('NOSESSION')) {
    define('NOSESSION', true);
}

if (!defined('NL')) {
    define('NL', "\n");
}

// we gzip ourself here

if (!defined('DOKU_DISABLE_GZIP_OUTPUT')) {
    define('DOKU_DISABLE_GZIP_OUTPUT', 1);
}

function css_error($error)
{
    echo "html:before {
        content: '$error';
        background-color: red;
        display: block;
        background-color: #fcc;
        border-color: #ebb;
        color: #000;
        padding: 0.5em;
    }";
}

// TODO remove this cache-control in future
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: text/css; charset=utf-8');

if (!file_exists(DOKU_INC)) {
    $error = 'Problem with DOKU_INC directory. Please check your DokuWiki installation directory!';
    css_error($error);
    die;
}

require_once DOKU_INC . 'inc/init.php';

global $INPUT;
global $conf;
global $ID;

$ID = cleanID($INPUT->str('id', null));

$bootstrap_theme    = tpl_getConf('bootstrapTheme');
$bootswatch_theme   = tpl_getConf('bootswatchTheme');
$custom_theme       = tpl_getConf('customTheme');
$theme_by_namespace = tpl_getConf('themeByNamespace');
$tpl_basedir        = tpl_basedir();
$tpl_incdir         = tpl_incdir();
$themes_filename    = DOKU_CONF . 'bootstrap3.themes.conf';
$stylesheets        = array();
$bootswatch_themes  = array('cerulean', 'cosmo', 'cyborg', 'darkly', 'flatly', 'journal', 'lumen', 'paper', 'readable', 'sandstone', 'simplex', 'solar', 'slate', 'spacelab', 'superhero', 'united', 'yeti');

# Check Theme Switcher
if (tpl_getConf('showThemeSwitcher')) {
    if (get_doku_pref('bootswatchTheme', null) !== null && get_doku_pref('bootswatchTheme', null) !== '') {
        $bootswatch_theme = get_doku_pref('bootswatchTheme', null);
    }

    if (!in_array($bootswatch_theme, $bootswatch_themes)) {
        $bootswatch_theme = 'default';
    }
}

# Check Theme by Namespace
if ($theme_by_namespace && file_exists($themes_filename)) {
    $config = confToHash($themes_filename);
    krsort($config);
    $theme_found = false;

    foreach ($config as $page => $theme) {
        if (preg_match("/^$page/", "$ID")) {
            list($bootstrap_theme, $bootswatch_theme) = explode('/', $theme);

            if ($bootstrap_theme && in_array($bootstrap_theme, array('default', 'optional', 'custom'))) {
                $theme_found = true;
                break;
            }

            if ($bootstrap_theme == 'bootswatch' && in_array($bootswatch_theme, $bootswatch_themes)) {
                $theme_found = true;
                break;
            }
        }
    }
}

# Check $ID and unload the template
if ($theme_by_namespace && file_exists($themes_filename) && !$ID) {
    $bootstrap_theme = 'none';
}

switch ($bootstrap_theme) {
    case 'optional':
        $stylesheets[] = 'assets/bootstrap/default/bootstrap.min.css';
        $stylesheets[] = 'assets/bootstrap/default/bootstrap-theme.min.css';
        break;

    case 'custom':
        $stylesheets[] = $custom_theme;
        break;

    case 'bootswatch':

        $bootswatch_url = 'assets/bootstrap';

        if (file_exists($tpl_incdir . "assets/fonts/$bootswatch_theme.fonts.css")) {
            $stylesheets[] = "assets/fonts/$bootswatch_theme.fonts.css";
        }

        $stylesheets[] = "$bootswatch_url/$bootswatch_theme/bootstrap.min.css";
        break;

    case 'none':
        break;

    case 'default':
    default:
        $stylesheets[] = 'assets/bootstrap/default/bootstrap.min.css';
        break;
}

$content = '';

foreach ($stylesheets as $style) {
    $content .= "@import url($style);" . NL;
}

print $content;
