<?php
/**
 * DokuWiki Bootstrap3 Template: Core Functions
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

function get_property_reflection($object, $property)
{
    $reflection = new \ReflectionProperty(get_class($object), $property);
    $reflection->setAccessible(true);
    return $reflection->getValue($object);
}

function set_property_reflection($object, $property, $new_value)
{
    $reflection = new \ReflectionProperty(get_class($object), $property);
    $reflection->setAccessible(true);
    return $reflection->setValue($object, $new_value);
}

function get_property($object, $property)
{
    $array          = (array) $object;
    $propertyLength = strlen($property);

    foreach ($array as $key => $value) {
        if (substr($key, -$propertyLength) === $property) {
            return $value;
        }
    }
}

function set_property($object, $property, $new_value)
{
    array_walk($object, function (&$value, $key) use ($new_value, $property) {
        if (substr($key, -strlen($property)) === $property) {
            $value = $new_value;
        }
    });
}

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
