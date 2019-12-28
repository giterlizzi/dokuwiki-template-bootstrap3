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

var $davcard_table = jQuery('.davcardAddressbookTable');

if ($davcard_table.length) {
    $davcard_table.addClass('table');
}

var $davcard_add_btn = jQuery('a.davcardAddressbookAddNew');

if ($davcard_add_btn.length) {
    $davcard_add_btn.prepend(jQuery('<span class="iconify mr-2" data-icon="mdi:account-plus"/>'));
    $davcard_add_btn.addClass('btn btn-xs btn-primary');
}
