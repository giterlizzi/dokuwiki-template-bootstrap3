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
      .prepend('<i class="fa fa-fw fa-info-circle"/> ');
  }
  if ($publish.hasClass('approved_yes')) {
    $publish.removeClass('approved_yes')
      .addClass('alert-success')
      .prepend('<i class="fa fa-fw fa-check-circle"/> ');
  }

}
