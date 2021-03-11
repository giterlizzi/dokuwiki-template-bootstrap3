/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Database2 Plugin

var $database2 = jQuery('table.database2, table.database2-single-editor');

if ($database2.length) {
    $database2.find('.label').removeClass('label').addClass('database2-label');
    $database2.find('input[type="submit"]:first').addClass('btn-success');
}
