/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// CSV Plugin

var $csv = jQuery('table tbody tr.row0 th.col0');

if ($csv.length) {

  $csv.each(function() {
    var $table = jQuery(this).parents('table');
    if ($table.find('tr.row1 th').length == 0) {
      $table.prepend('<thead/>');
      $header = $table.find('tr.row0');
      $table.find('thead').append($header);
    }
  });

}
