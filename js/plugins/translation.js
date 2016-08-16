/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

 // Translation Plugin
var $translation = jQuery('#dw__translation');

if ($translation.length) {

 var $current = $translation.find('.cur'),
     $lang    = $current.text(),
     $iso     = $lang.match(/\(([a-z]*)\)/),
     $flag    = $current.find('img');

 $current.parent().addClass('active');
 $translation.find('.wikilink2').removeClass('wikilink2').css('opacity', '0.5');

 if ($flag.length) {
   $translation.find('.dropdown-toggle i').hide();
   $translation.find('.dropdown-toggle').prepend(
     jQuery('<img/>').attr({
       'src'   : $flag.attr('src'),
       'title' : $flag.attr('title') }));
 }

}
