<?php

/**
 * MDI PHP Helper
 *
 * Based on https://github.com/chteuchteu/MaterialDesignIcons-PHP
 *
 * @author  Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license MIT, GPLv2
 */


class Mdi
{

    public static $iconsPath;

    public static $defaultAttributes = array();

    /**
     * Add icon
     * 
     * @param string $icon  Icon name
     * @param string $class Icon Class
     * @param int    $size  Icon size
     * @param array  $attrs Icon attributes
     * 
     * @return string
     */
    public static function icon($icon, $class = null, $size = 24, $attrs = array())
    {
        // Ensure that the icons path has been specified, or auto-detect it
        if (!self::$iconsPath) {
            msg('You forgot to specify MDI\'s path!', -1);
            return false;
        }

        // Strip leading "mdi mdi-" or "mdi-"
        if (strpos($icon, 'mdi mdi-') === 0) {
            $icon = substr($icon, \strlen('mdi mdi-'));
        }

        if (strpos($icon, 'mdi-') === 0) {
            $icon = substr($icon, \strlen('mdi-'));
        }

        // Find the icon, ensure it exists
        $filePath = self::$iconsPath . $icon . '.svg';

        if (!is_file($filePath)) {
            msg(sprintf('Unrecognized icon "%s" (svg file "%s" does not exist).', $icon, $filePath), -1);
            return false;
        }

        // Read the file
        $svg = file_get_contents($filePath);

        // Only keep the <path d="..." /> part
        if (preg_match('/(<path d=".+" \/>)/', $svg, $matches) !== 1) {
            msg(sprintf('"%s" could not be recognized as an icon file', $filePath), -1);
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

// kate: space-indent on; indent-width 4; replace-tabs on;

