/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// InlineTOC Plugin

var $toc  = jQuery('#dw__toc, #dokuwiki__toc'),  // DokuWiki TOC
    $toc2 = jQuery('div.inlinetoc2');            // InlineTOC Plugin

// InlineTOC Plugin
if ($toc2.length && $toc.length) {
  $toc.css('display', 'none');
  $toc2.addClass('panel panel-default');
}
