<?php

/**
 * DokuWiki Bootstrap3 Template: Iconify compatible API 
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) {
    define('DOKU_INC', dirname(__FILE__) . '/../../../');
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
    'prefix'   => $INPUT->str('prefix'),
    'icons'    => $INPUT->str('icons'),
    'callback' => $INPUT->str('callback'),
    'width'    => $INPUT->str('width'),
    'height'   => $INPUT->str('height'),
    'icon'     => $INPUT->str('icon'),
);

$iconify_dir = dirname(__FILE__) . '/assets/iconify';

header('Content-Type: application/javascript; charset=utf-8');

$cache_key = md5(serialize($params) . $conf['template'] . filemtime(__FILE__));

$cache         = new cache($cache_key, '.js');
$cache->_event = 'ICONIFY_CACHE';
$cache_files   = $params;
$cache_files[] = __FILE__;
$cache_ok      = $cache->useCache(array('files' => $cache_files));

if ($params['icon']) {
    list($params['prefix'], $params['icons']) = explode('-', str_replace('.svg', '', $params['icon']), 2);
    header('Content-Type: image/svg+xml; charset=utf-8', true);
}

http_cached($cache->cache, $cache_ok);

$data = array(
    'prefix' => $params['prefix'],
    'icons'  => array(),
);

$collection_file = "$iconify_dir/". $params['prefix'] .".json";

if (!file_exists($collection_file)) {
    http_status(404);
    exit;
}

$collection_data = json_decode(file_get_contents($collection_file), true);


foreach (explode(',', $params['icons']) as $icon) {

    $requested_icon = $icon;

    if (isset($collection_data['aliases'][$icon])) {
        $icon = $collection_data['aliases'][$icon]['parent'];
    }

    if (!$body = $collection_data['icons'][$icon]) {
        continue;
    }

    $data['icons'][$requested_icon] = $body;

    if (!isset($data['icons'][$requested_icon]['width'])) {
        $data['icons'][$requested_icon]['width']  = 24;
        $data['icons'][$requested_icon]['height'] = 24;
    }

    if ($params['width']) {
        $data['icons'][$requested_icon]['width']  = $params['width'];
    }
    if ($params['height']) {
        $data['icons'][$requested_icon]['height'] = $params['height'];
    }

}

if ($params['callback']) {
    
    $content = $params['callback'] . "(" . json_encode($data) . ");";

} elseif ($params['icon']) {

    $svg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="%s" height="%s" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);">%s</svg>';
    $content = sprintf($svg, $data['icons'][$params['icons']]['width'], $data['icons'][$params['icons']]['height'], $data['icons'][$params['icons']]['body']);

} else {
    
    $content = "SimpleSVG._loaderCallback(" . json_encode($data) . ");";

}

http_cached_finish($cache->cache, $content);
#print $content;
