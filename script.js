/*!
 * DokuWiki Bootstrap3 Template: Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

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

  jQuery(window).resize(function() {
    jQuery(document).trigger('bootstrap3:mobile-layout');
    jQuery(document).trigger('bootstrap3:collapse-sections');
    jQuery(document).trigger('bootstrap3:toc-resize');
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


  jQuery('.fluid-container').on('click', function() {

    var $button     = jQuery(this),
        $containers = jQuery('body > div, header, header nav > div, article, footer > div');

    if (jQuery('body > div.container').length) {

      $containers
        .removeClass('container')
        .addClass('container-fluid');
      $button.parent().addClass('active');

      DokuCookie.setValue('fluidContainer', 1);

    } else {

      $containers
        .removeClass('container-fluid')
        .addClass('container');
      $button.parent().removeClass('active');

      DokuCookie.setValue('fluidContainer', 0);

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

  // Admin mode
  if (dw_mode('admin')) {
    jQuery(document).trigger('bootstrap3:mode-admin');
  }

  // Search mode
  if (dw_mode('search')) {
    jQuery(document).trigger('bootstrap3:mode-search');
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
