/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Explain Plugin

var $explain = jQuery('.explain');

if ($explain.length) {

  $explain.each(function(){

   var $self    = jQuery(this),
       $tooltip = $self.find('.tooltip');

   $self.attr({
     'data-toggle'    : 'tooltip',
     'data-placement' : 'bottom',
     'title'          : $tooltip.html(),
   }).addClass('wikilink1').removeClass('explain');

   $tooltip.remove();

  });

  jQuery('[data-toggle="tooltip"]').tooltip();

}
