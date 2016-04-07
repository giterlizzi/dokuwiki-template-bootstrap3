/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

 // Tagging plugin
var $tagging_edit = jQuery('.plugin_tagging_edit');

if ($tagging_edit.length) {
  $tagging_edit.find(':submit').addClass('btn-xs');
  $tagging_edit.find('[type=text]').addClass('input-sm');
  $tagging_edit.find('#tagging__edit_save').addClass('btn-success');
}
