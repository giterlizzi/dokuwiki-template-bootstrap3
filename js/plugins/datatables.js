/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// DataTables Plugin

var $datatables = jQuery('.dt-wrapper');

if ($datatables.length) {
  $datatables.find('.table-responsive').removeClass('table-responsive');
}
