/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Gallery Plugin (Media Manager)

 if (dw_mode('media')) {
   jQuery(document).ajaxSuccess(function() {
     jQuery('.mode_media .meta .row').removeClass('row');
   });
 }
