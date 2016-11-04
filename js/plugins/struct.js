/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Struct Plugin

if (dw_admin('struct_schemas') || dw_admin('struct_assignments')) {
  // Display all elements in TOC
  jQuery('.toc-body .toc').addClass('show');
}
