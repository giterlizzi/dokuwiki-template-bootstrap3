/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Include Plugin

var $include_readmore = jQuery('.include_readmore');

// Include Plugin (Read More)
if ($include_readmore.length) {
  $include_readmore.find('a').addClass('btn btn-default btn-xs');
}
