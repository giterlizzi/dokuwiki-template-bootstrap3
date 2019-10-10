/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Move Plugin

jQuery(document).on('bootstrap3:plugin-move', function(event) {

    if (! jQuery('#plugin_move__tree').length) return false;

    // console.debug(event.type + ' event fired');

    setTimeout(function() {

        var $directories = jQuery('li.type-d a.idx_dir'),
            $pages       = jQuery('li.type-f a.wikilink1');

        jQuery.each($directories, function() {

            var $directory = jQuery(this),
                $closed    = $directory.parents('.closed'),
                $open      = $directory.parents('.open');

            if (! $directory.find('.mdi').length) {
                $directory.prepend('<i class="mdi text-primary"/> ');
            }

            if ($open.length) {
                $directory.find('i')
                .removeClass('mdi-folder')
                .addClass('mdi-folder-open');
            }

            if ($closed.length) {
                $directory.find('i')
                .removeClass('mdi-folder-open')
                .addClass('mdi-folder');
            }

        });

        jQuery.each($pages, function() {

            var $page = jQuery(this);

            if (! $page.find('i').length) {
                $page.prepend('<i class="mdi mdi-file-document text-muted"/> ');
            }

        });

    }, 0);

});

jQuery('#plugin_move__tree a').click(function(e) {
    jQuery(document).trigger('bootstrap3:mode-index');
});

jQuery(document).trigger('bootstrap3:plugin-move');

jQuery(document).ajaxSuccess(function(e) {
    jQuery(document).trigger('bootstrap3:plugin-move');
});
