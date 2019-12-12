/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// PlantUML Parser Plugin

var $plant_uml = jQuery('div[id^="plant-uml-diagram"] svg');

if ($plant_uml.length) {
    $plant_uml.addClass('img-responsive');
}
