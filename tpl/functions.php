<?php
/**
 * DokuWiki Bootstrap3 Template: Core Functions
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

function bootstrap3_content($content) {

  global $TEMPLATE;

  return $TEMPLATE->normalizeContent($content);

}

function iconify($icon, $attrs = array()) {

    $class = 'iconify';

    if (isset($attrs['class'])) {
      $class .= ' ' . $attrs['class'];
      unset($attrs['class']);
    }

    $attrs['data-icon'] = $icon;

    $attributes = '';

    foreach ($attrs as $key => $value) {
      $attributes .= ' '. $key .'="'. hsc($value) .'"';
    }

    return '<span class="'. $class .'" '. $attributes .'></span>';
}
