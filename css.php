<?php

/**
 * DokuWiki Bootstrap3 Template: CSS Asset Dispatcher 
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

# Detect Bitnami DokuWiki Docker image and apply the correct DOKU_INC path
#   see: https://github.com/bitnami/bitnami-docker-dokuwiki/issues/37
if (getenv('BITNAMI_APP_NAME')) {
    define('DOKU_INC', '/opt/bitnami/dokuwiki/');
}

if (!defined('DOKU_INC')) {
    define('DOKU_INC', realpath(dirname(__FILE__) . '/../../../') . '/');
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

require_once DOKU_INC . 'inc/init.php';
require_once dirname(__FILE__) . '/tpl/global.php';

global $INPUT;
global $conf;
global $ID;

$ID = cleanID($INPUT->str('id'));

$tpl = new \dokuwiki\template\bootstrap3\Template;

// Bootstrap Theme
$bootstrap_theme  = $tpl->getConf('bootstrapTheme');
$bootswatch_theme = $tpl->getBootswatchTheme();
$custom_theme     = $tpl->getConf('customTheme');
$tpl_basedir      = $tpl->baseDir;
$tpl_incdir       = $tpl->tplDir;

$stylesheets = array();
$fonts       = array();

switch ($bootstrap_theme) {

    case 'optional':
        $stylesheets[] = 'assets/bootstrap/default/bootstrap.min.css';
        $stylesheets[] = 'assets/bootstrap/default/bootstrap-theme.min.css';
        break;

    case 'custom':
        $stylesheets[] = $custom_theme;
        break;

    case 'bootswatch':

        $bootswatch_url   = 'assets/bootstrap';

        if (file_exists($tpl_incdir . "assets/fonts/$bootswatch_theme.fonts.css")) {
            $stylesheets[] = "assets/fonts/$bootswatch_theme.fonts.css";
        }

        $stylesheets[] = "$bootswatch_url/$bootswatch_theme/bootstrap.min.css";
        break;

    case 'default':
    default:
        $stylesheets[] = 'assets/bootstrap/default/bootstrap.min.css';
        break;

}

// TODO remove this cache-control in future
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: text/css; charset=utf-8');

$content = '';

foreach ($stylesheets as $style) {
  $content .= "@import url($style);\n";
}

print $content;
