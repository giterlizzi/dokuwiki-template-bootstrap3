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

if ($wikilinks.length && JSINFO.plugin.semantic.exposeWebService && JSINFO.bootstrap3.config.showSemanticPopup) {

  $wikilinks.hover(function() {

    var $wikilink = jQuery(this),
        page_id   = $wikilink.attr('title');

    $wikilinks.popover('destroy');
    if (! page_id) return false;

    jQuery.post(
      DOKU_BASE + 'lib/exe/ajax.php',
      { call: 'plugin_semantic', id: page_id },
      function(data) {

        var jsonld = data[0];

        if (! (jsonld.headline && jsonld.description)) return false;

        $wikilink.data('original-title', page_id);
        $wikilink.attr('title', '');

        var title       = jsonld.headline;
        var image       = ('image' in jsonld) ? [ '<img src="', jsonld.image.url, '" alt="" class="img-responsive" /><br/>' ].join('') : '';
        var description = jQuery.trim(jsonld.description.replace(/\t\*$/, ''))
                            .replace(/\*(.*)/g, '<i class="fa fa-circle small"></i> $1')
                            .replace(/\n/g, "<br/>\n")
                            .replace(/\t/g, '&nbsp;');

        var content = [ '<div class="row small"><div class="col-md-12">', image, description, ' ... </div></div>' ].join('');

        $wikilink.popover({
          trigger   : 'manual',
          html      : true,
          title     : title,
          content   : content,
          placement : 'auto left',
        }).popover('show');

        $wikilink.attr('title', page_id);

      });

  }, function() {

    var self = this;

    setTimeout(function() {
      if (! jQuery(self).next('.popover:hover').length) {
        jQuery(self).popover('destroy');
      }
    }, 300);

  });

}
