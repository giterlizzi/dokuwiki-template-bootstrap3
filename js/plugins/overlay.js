/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Overlay Plugin
var $overlay = jQuery('#overlay');

if ($overlay.length) {

  $overlay.addClass('panel panel-default small');

  $overlay.css('border',     jQuery('.panel').css('border'));
  $overlay.css('background', jQuery('.panel').css('background'));

  var $title = $overlay.find('.close'),
      $btn   = $title.find('a');

  $btn.wrapAll('<ul class="text-right list-inline dw-action-icon" />');
  $btn.wrap('<li/>');
  $btn.addClass('text-muted');

  $title.nextAll().wrapAll('<div class="panel-body" />');
  $title.removeClass('close').addClass('panel-heading');

}
