/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Publish Plugin

var $publish = jQuery('.approval');

if ($publish.length) {

    $publish.prependTo('.page');

    $publish.removeClass('approval').addClass('alert');

    jQuery('.apr_table').removeClass('table-striped');

    if ($publish.hasClass('approved_no')) {
        $publish.removeClass('approved_no')
            .addClass('alert-warning')
            .prepend('<span class="iconify mr-2" data-icon="mdi:information"/>');
    }
    if ($publish.hasClass('approved_yes')) {
        $publish.removeClass('approved_yes')
            .addClass('alert-success')
            .prepend('<span class="iconify mr-2" data-icon="mdi:check-circle"/>');
    }

}
