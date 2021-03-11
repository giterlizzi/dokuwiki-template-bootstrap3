/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Simple Navi Plugin

var $simplenavi = jQuery('.plugin__simplenavi');

if ($simplenavi.length) {

    $simplenavi.find('li').addClass('mt-1');
    $simplenavi.find('a.wikilink2').removeClass('wikilink2');
    $simplenavi.find('li.open strong').contents().unwrap();
    $simplenavi.find('li.closed a').prepend('<span class="iconify mr-2" data-icon="mdi:folder"/>');
    $simplenavi.find('li.open > a').prepend('<span class="iconify mr-2" data-icon="mdi:folder-open"/>');
    $simplenavi.find('li').not('.closed').not('.open').find('a').prepend('<span class="iconify mr-2" data-icon="mdi:file-document-outline"/>');

}
