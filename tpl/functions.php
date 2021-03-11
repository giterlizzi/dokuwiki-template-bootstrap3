<?php
/**
 * DokuWiki Bootstrap3 Template: Core Functions
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

function bootstrap3_content($content)
{
    global $TPL;
    return $TPL->normalizeContent($content);
}

function iconify($icon, $attrs = [])
{
    $class = 'iconify';

    if (isset($attrs['class'])) {
        $class .= ' ' . $attrs['class'];
        unset($attrs['class']);
    }

    $attrs['data-icon'] = $icon;

    $attributes = '';

    foreach ($attrs as $key => $value) {
        $attributes .= ' ' . $key . '="' . hsc($value) . '"';
    }

    return '<span class="' . $class . '" ' . $attributes . '></span>';
}
