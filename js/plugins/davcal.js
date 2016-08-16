/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// DAVCal Plugin

var $davcal = jQuery('#fullCalendar');

if ($davcal.length) {
  $davcal.find('.fc-button-group').addClass('btn-group');
}
