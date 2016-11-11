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

  $simplenavi.find('li.open strong').contents().unwrap();
  $simplenavi.find('li.closed a').prepend('<i class="fa fa-fw fa-folder"/> ');
  $simplenavi.find('li.open > a').prepend('<i class="fa fa-fw fa-folder-open"/> ');
  $simplenavi.find('li').not('.closed').not('.open').find('a').prepend('<i class="fa fa-fw fa-file-text-o text-muted"/> ');

}
