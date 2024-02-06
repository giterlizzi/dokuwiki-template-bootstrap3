<?php

/**
 * DokuWiki Bootstrap3 Template: Iconify compatible API
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

require_once DOKU_INC . 'inc/init.php';

global $INPUT;

$params = array(
    'prefix'   => hsc($INPUT->str('prefix')),
    'icons'    => hsc($INPUT->str('icons')),
    'callback' => hsc($INPUT->str('callback')),
    'width'    => hsc($INPUT->str('width')),
    'height'   => hsc($INPUT->str('height')),
    'icon'     => hsc($INPUT->str('icon')),
    'color'    => hsc($INPUT->str('color')),
);

$iconify_dir   = dirname(__FILE__) . '/assets/iconify/json';
$cache_key     = md5(serialize($params) . $conf['template'] . filemtime(__FILE__));
$cache_files   = $params;
$cache_files[] = __FILE__;
$content_type  = 'application/javascript; charset=utf-8';

$cache = new dokuwiki\Cache\Cache($cache_key, '.js');
$cache->setEvent('ICONIFY_CACHE');
$cache_ok = $cache->useCache(array('files' => $cache_files));


if ($params['icon']) {
    $content_type                             = 'image/svg+xml; charset=utf-8';
    list($params['prefix'], $params['icons']) = explode('-', str_replace('.svg', '', $params['icon']), 2);
}

header("Content-Type: $content_type");

http_cached($cache->cache, $cache_ok);

$collection_file = "$iconify_dir/" . $params['prefix'] . ".json";

if (!file_exists($collection_file)) {
    header('Content-Type: text/plain; charset=utf-8', true);
    http_status(404);
    print "Not Found";
    exit;
}

$collection_data = json_decode(io_readFile($collection_file), true);

$iconify_data = array(
    'prefix'  => $params['prefix'],
    'icons'   => array(),
    'aliases' => array(),
);

foreach (explode(',', $params['icons']) as $icon) {

    if (isset($collection_data['aliases'][$icon])) {
        $iconify_data['aliases'][$icon] = $collection_data['aliases'][$icon];
        $icon                           = $collection_data['aliases'][$icon]['parent'];
    }

    if (!$icon_data = $collection_data['icons'][$icon]) {
        continue;
    }

    $iconify_data['icons'][$icon] = $icon_data;

    if ($params['width']) {
        $iconify_data['icons'][$icon]['width'] = $params['width'];
    }
    if ($params['height']) {
        $iconify_data['icons'][$icon]['height'] = $params['height'];
    }

}

foreach (array('width', 'height', 'top', 'left', 'inlineHeight', 'inlineTop', 'verticalAlign') as $property) {
    if (isset($collection_data[$property])) {
        $iconify_data[$property] = $collection_data[$property];
    }
}

if ($params['callback']) {

    $content = $params['callback'] . "(" . json_encode($iconify_data) . ");";

} elseif ($params['icon']) {

    $icon   = $params['icons'];
    $width  = '1em';
    $height = '1em';
    $fill   = '';

    if (isset($iconify_data['aliases'][$icon])) {
        $icon = $iconify_data['aliases'][$icon]['parent'];
    }

    if (!isset($iconify_data['icons'][$icon])) {
        header('Content-Type: text/plain; charset=utf-8', true);
        http_status(404);
        print "Not Found";
        exit;
    }

    if ($params['width']) {
        $width  = $params['width'];
        $height = $params['width'];
    }

    if ($params['height']) {
        $width  = $params['height'];
        $height = $params['height'];
    }

    if ($params['color']) {
        $fill = $params['color'];
    }

    # TODO add "rotate" support

    $body = $iconify_data['icons'][$icon]['body'];

    if ($fill) {
        $body = str_replace('currentColor', $fill, $body);
    }

    $svg     = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="%s" height="%s" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);">%s</svg>';
    $content = sprintf($svg, $width, $height, $body);

} else {

    $content = "SimpleSVG._loaderCallback(" . json_encode($iconify_data) . ");";

}

http_cached_finish($cache->cache, $content);
#print $content;
