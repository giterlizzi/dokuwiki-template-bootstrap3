/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Tag Plugin

var $page = jQuery('table tbody td.page:even');

// Tag Plugin: Count
if ($page.length) {

  $page.each(function(){
    var $table  = jQuery(this).parents('table'),
        $header = $table.find('tr');
    $table.prepend('<thead><tr/></thead>');
    $table.find('thead tr').append($header);
    $header.removeClass('page');
  });

}
