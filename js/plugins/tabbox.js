/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Tabbox plugin

setTimeout(function () {
    jQuery('.plugin_tabbox').each(function () {
        var $self = jQuery(this);
        $self.find('> ul.tabs').addClass('nav nav-tabs').css('max-height', '40px');
    });
}, 500);
