/*!
 * DokuWiki Bootstrap3 Template: Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

/**
 * Replace all OOTB DokuWiki toolbar icon with Material Design Icons
 */
if (typeof window.toolbar !== 'undefined') {

  if (JSINFO.bootstrap3.config.useAlternativeToolbarIcons) {

    var original_toolbar = window.toolbar;
    var new_toolbar = new Array();

    var icons = {
      'bold.png'       : 'format-bold.svg',
      'chars.png'      : 'omega.svg',
      'h.png'          : 'format-header-pound.svg',
      'h1.png'         : 'format-header-1.svg',
      'hequal.png'     : 'format-header-equal.svg',
      'hminus.png'     : 'format-header-decrease.svg',
      'hplus.png'      : 'format-header-increase.svg',
      'hr.png'         : 'minus.svg', // ??
      'image.png'      : 'image.svg',
      'italic.png'     : 'format-italic.svg',
      'link.png'       : 'link.svg',
      'linkextern.png' : 'link-variant.svg', // ??
      'mono.png'       : 'format-title.svg',
      'ol.png'         : 'format-list-numbered.svg',
      'sig.png'        : 'signature.svg',
      'smiley.png'     : 'emoticon-outline.svg',
      'strike.png'     : 'format-strikethrough.svg',
      'ul.png'         : 'format-list-bulleted.svg',
      'underline.png'  : 'format-underline.svg',

    };

    for (i in window.toolbar) {

      // Replace all icons in "H(eaders)" picker
      if (window.toolbar[i].icon == 'h.png') {
        for (x in window.toolbar[i].list) {
          var hn = parseInt(x) + 1;
          window.toolbar[i].list[x].icon = '../../tpl/bootstrap3/iconify.php?icon=mdi-format-header-' + hn + '.svg';
        }
      }

      for (icon in icons) {
        if (window.toolbar[i].icon == icon) {
          window.toolbar[i].icon = '../../tpl/bootstrap3/iconify.php?icon=mdi-' + icons[icon];
        }
      }

    }

  }

}


jQuery(document).ready(function() {

  //'use strict';

  if (typeof JSINFO.bootstrap3 === 'undefined') {
    JSINFO.bootstrap3 = {};
  }

  function dw_mode(id) {
    return ((JSINFO.bootstrap3.mode === id) ? true : false);
  }

  function dw_admin(page) {
    return ((JSINFO.bootstrap3.admin === page) ? true : false);
  }

  function mediaSize(media) {
    return jQuery(['#screen__mode .visible-', media, '-block'].join('')).is(':visible');
  }

  // Preload icons
  Iconify.preloadImages(['mdi:folder-open', 'mdi:folder', 'mdi:file-document-outline', 'mdi:chevron-up', 'mdi:chevron-down']);

  jQuery(window).resize(function() {
    jQuery(document).trigger('bootstrap3:mobile-layout');
    jQuery(document).trigger('bootstrap3:collapse-sections');
    jQuery(document).trigger('bootstrap3:toc-resize');
  });


  // Add typeahead support for quick seach
  jQuery("#qsearch").typeahead({

    source: function(query, process) {

      return jQuery.post(DOKU_BASE + 'lib/exe/ajax.php', {
        call: 'qsearch',
        q: encodeURI(query)
      },

      function(data) {

        var results = [];

        jQuery(data).find('a').each(function(){

          var page = jQuery(this);

          results.push({
            name     : page.text(),
            href     : page.attr('href'),
            title    : page.attr('title'),
            category : page.attr('title').replace(/:/g, ' » '),
          });

        });

        return process(results);

      });
    },

    itemLink: function (item) {
      return item.href;
    },

    itemTitle: function (item) {
      return item.title;
    },

    followLinkOnSelect : true,
    autoSelect         : false,
    items              : 50,
    fitToElement       : true,
    delay              : 500,

  });


  // Replace ALL input[type=submit|reset|button] (with no events) to button[type=submit|reset|button] for CSS styling
  jQuery.fn.extend({

    input2button: function() {

      return this.each(function() {

        var attrs = { 'type' : 'button' },
            label = '',
            node  = jQuery(this);

        if (typeof node.data('events') === 'undefined' && node.prop('tagName') == 'INPUT') {

          jQuery(node[0].attributes).each(function(index, attribute) {
            if (attribute.name == 'value') {
              label = attribute.value;
            } else {
              attrs[attribute.name] = attribute.value;
            }
          });

          var newNode = jQuery('<button/>', attrs).html(label);
          node.replaceWith(newNode);

        }

      });

    }

  });


  /* DOKUWIKI:include js/template.js */


  // Init template
  jQuery(document).trigger('bootstrap3:init');

  // Init other components
  jQuery(document).trigger('bootstrap3:components');

  /* DOKUWIKI:include js/plugins.js */

  // Init plugins
  jQuery(document).trigger('bootstrap3:plugins');


  // Re-initialize some components in media-manager
  if (dw_mode('media') || jQuery('#media__manager')) {

   jQuery(document).ajaxSuccess(function() {
     jQuery(document).trigger('bootstrap3:init');
     jQuery(document).trigger('bootstrap3:buttons');
     jQuery(document).trigger('bootstrap3:tabs');
     jQuery(document).trigger('bootstrap3:media-manager');
     jQuery(document).trigger('bootstrap3:alerts')
   });

  }

  // Init AnchorJS
  if (JSINFO.bootstrap3.config.useAnchorJS) {
    jQuery(document).trigger('bootstrap3:anchorjs');
  }

  // Hash change
  if (JSINFO.bootstrap3.config.fixedTopNavbar) {

    var scrollOnHashChange = function() {
      scrollBy(0, - (parseInt(jQuery('body').css('marginTop')) || 0));
    };

    if (location.hash) {
      setTimeout(function() {
        scrollOnHashChange();
      }, 1);
    }

    jQuery(window).on('hashchange', function() {
      scrollOnHashChange();
    });

  }

  // Index mode
  if (dw_mode('index')) {

   jQuery(document).trigger('bootstrap3:mode-index');

   jQuery(document).ajaxSuccess(function() {
     jQuery(document).trigger('bootstrap3:mode-index');
   });

   jQuery('#index__tree').click(function(e) {
     jQuery(document).trigger('bootstrap3:mode-index');
   });

  }

});
