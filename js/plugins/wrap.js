/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Wrap Plugin

var $wrap = jQuery('.plugin_wrap');

if ($wrap.length) {

  if ($wrap.hasClass('tabs')) {
    var $tabs = jQuery('.plugin_wrap.tabs');
    $tabs.find('div.li').contents().unwrap();
    $tabs.find('.curid').parent().addClass('active');
    $tabs.find('ul').addClass('nav nav-tabs');
  }

}
