/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Tagalerts plugin

jQuery('.tagerror, .taginfo, .tagsuccess, .tagnotify').each(function () {

    var $node = jQuery(this);

    if ($node.prop('nodeName').toLowerCase() == 'div') {

        $node.removeClass('label label-default').addClass('alert');
        $node.prependTo('#dw__msgarea');

        if ($node.hasClass('tagerror')) $node.removeClass('tagerror').addClass('alert-danger');
        if ($node.hasClass('taginfo')) $node.removeClass('taginfo').addClass('alert-info');
        if ($node.hasClass('tagsuccess')) $node.removeClass('tagsuccess').addClass('alert-success');
        if ($node.hasClass('tagnotify')) $node.removeClass('tagnotify').addClass('alert-warning');

    } else {

        if ($node.hasClass('tagerror')) $node.removeClass('tagerror').addClass('label-danger');
        if ($node.hasClass('taginfo')) $node.removeClass('taginfo').addClass('label-info');
        if ($node.hasClass('tagsuccess')) $node.removeClass('tagsuccess').addClass('label-success');
        if ($node.hasClass('tagnotify')) $node.removeClass('tagnotify').addClass('label-warning');

    }

});
