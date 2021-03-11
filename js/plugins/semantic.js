/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Semantic Plugin

var $wikilinks = jQuery('article .wikilink1');

if (typeof JSINFO.plugin === 'undefined') {
    JSINFO.plugin = {};
}

if (typeof JSINFO.plugin.semantic === 'undefined') {
    JSINFO.plugin.semantic = {};
}

if ($wikilinks.length
    && JSINFO.plugin.semantic.exposeWebService
    && JSINFO.bootstrap3.config.showSemanticPopup) {

    $wikilinks.hover(function () {

        $wikilinks.popover('destroy');

        var $wikilink = jQuery(this),
            page_id = $wikilink.attr('title');

        // Disable popup for linked tabs/navs items (Bootstrap Wrapper Plugin)
        if ($wikilink.parents('.bs-wrap-nav').length) {
            return false;
        }

        if (!page_id) return false;
        if (page_id == JSINFO.id) return false; // Self

        jQuery.get(
            DOKU_BASE + 'doku.php',
            {
                id: page_id,
                do: 'export_xhtmlsummary'
            },
            function (data) {

                var content = '<div class="popover-xhtmlsummary">'
                    + '  <div class="popover-body">' + data + '</div>'
                    + '  <div class="popover-footer text-right">'
                    + '    <a class="btn btn-xs btn-primary" href="' + $wikilink.attr('href') + '">' + page_id + '</a>'
                    + '  </div>'
                    + '</div>';

                $wikilink.popover({
                    trigger: 'manual',
                    html: true,
                    title: page_id,
                    content: content,
                    placement: 'auto left',
                }).popover('show');

                $wikilink.attr('title', page_id);

            }
        );

        // jQuery.post(
        //   DOKU_BASE + 'lib/exe/ajax.php',
        //   { call: 'plugin_semantic', id: page_id },
        //   function(data) {

        //     var jsonld = data[0];

        //     if (! (jsonld.headline && jsonld.description)) return false;

        //     $wikilink.data('original-title', page_id);
        //     $wikilink.attr('title', '');

        //     var title       = jsonld.headline;
        //     var image       = ('image' in jsonld) ? [ '<img src="', jsonld.image.url, '" alt="" class="img-responsive" /><br/>' ].join('') : '';
        //     var description = jQuery.trim(jsonld.description.replace(/\t\*$/, ''))
        //                         .replace(/\*(.*)/g, '<span class="iconify mr-2" data-icon="mdi:circle"></span> $1')
        //                         .replace(/\n/g, "<br/>\n")
        //                         .replace(/\t/g, '&nbsp;');

        //     var content = [ '<div class="row small"><div class="col-md-12">', image, description, ' ... </div></div>' ].join('');

        //     $wikilink.popover({
        //       trigger   : 'manual',
        //       html      : true,
        //       title     : title,
        //       content   : content,
        //       placement : 'auto left',
        //     }).popover('show');

        //     $wikilink.attr('title', page_id);

        //   });

    }, function () {

        var self = this;

        setTimeout(function () {
            if (jQuery(self).next('.popover').length && !jQuery(self).next('.popover:hover').length) {
                jQuery(self).popover('destroy');
            }
        }, 300);

    });

}
