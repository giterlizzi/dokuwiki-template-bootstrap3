/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Data Plugin

var $dataplugin_entry = jQuery('.dataplugin_entry'),
    $dataplugin_table = jQuery('.dataplugin_table');

// Data Plugin: Entry
if ($dataplugin_entry.length) {
  $dataplugin_entry.find('dl').addClass('panel panel-default');
}


// Data Plugin: Table
if ($dataplugin_table.length) {

  $dataplugin_table.find('input').addClass('input-sm');

  var $header = $dataplugin_table.find('th[style]'),
      $inputs = $dataplugin_table.find('th input'),
      header_width = [],
      i = 0;

  $header.each(function() {
    header_width.push(this.style.width);
  });

  $inputs.each(function() {
    this.style.width = header_width[i];
    i++;
  });

}
