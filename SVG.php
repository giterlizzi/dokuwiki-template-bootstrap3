<?php

/**
 * SVG PHP Helper
 *
 * Based on https://github.com/chteuchteu/MaterialDesignIcons-PHP
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license MIT, GPLv2
 */

namespace dokuwiki\template\bootstrap3;

class SVG
{

    public static $iconsPath;

    public static $defaultAttributes = array();

    /**
     * Add icon
     *
     * @param string $icon  Icon name or full path
     * @param string $class Icon Class
     * @param int    $size  Icon size
     * @param array  $attrs Icon attributes
     *
     * @return string
     */
    public static function icon($icon, $class = null, $size = 24, $attrs = array())
    {
        // Find the icon, ensure it exists
        if (file_exists($icon)) {
            $file_path = $icon;
        } else {
            $file_path = self::$iconsPath . $icon . '.svg';
        }

        if (!is_file($file_path)) {
            msg(sprintf('Unrecognized icon "%s" (svg file "%s" does not exist).', $icon, $file_path), -1);
            return false;
        }

        // Read the file
        $svg = file_get_contents($file_path);

        // Only keep the <path d="..." /> part
        // Old REGEX: (<path d=".+" \/>)
        if (preg_match('/((<path\b([\s\S]*?)\/>)|(<path\b([\s\S]*?)><\/path>))/', $svg, $matches) !== 1) {
            msg(sprintf('"%s" could not be recognized as an icon file', $file_path), -1);
            return false;
        }

        $svg = $matches[1];

        // Add some (clean) attributes
        $attributes = array_merge(
            array(
                'viewBox' => '0 0 24 24',
                'xmlns'   => 'http://www.w3.org/2000/svg',
                'width'   => $size,
                'height'  => $size,
                'role'    => 'presentation',
            ),
            self::$defaultAttributes,
            $attrs
        );

        if ($class !== null) {
            $attributes['class'] = $class;
        }

        // Remove possibly empty-ish attributes (self::$defaultAttributes or $attrs may contain null values)
        $attributes = array_filter($attributes);

        return sprintf(
            '<svg %s>%s</svg>',
            self::attributes($attributes),
            $svg
        );
    }

    /**
     * Turns a 1-dimension array into an HTML-ready attributes set.
     */
    private static function attributes($attrs = array())
    {
        return implode(' ', array_map(
            function ($val, $key) {
                return $key . '="' . htmlspecialchars($val) . '"';
            },
            $attrs,
            array_keys($attrs)
        ));
    }
}
