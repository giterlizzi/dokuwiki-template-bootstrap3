/*!
 * DokuWiki Bootstrap3 Template: Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

jQuery(document).ready(function() {

  //'use strict';

  // Icons for DokuWiki Actions
  var icons = [
    // Mode           Selector  Icon
    ['denied',        'h1',     'glyphicon-ban-circle text-danger'],
    ['show.notFound', 'h1',     'glyphicon-alert text-warning'],
    ['login',         'h1',     'glyphicon-log-in text-muted'],
    ['register',      'h1',     'glyphicon-edit text-muted'],
    ['search',        'h1',     'glyphicon-search text-muted'],
    ['index',         'h1',     'glyphicon-list text-muted'],
    ['recent',        'h1',     'glyphicon-list-alt text-muted'],
    ['media',         'h1',     'glyphicon-picture text-muted'],
    ['admin',         'h1',     'glyphicon-cog text-muted'],
    ['profile',       'h1',     'glyphicon-user text-muted'],
    ['revisions',     'h1',     'glyphicon-time text-muted'],
    ['backlink',      'h1',     'glyphicon-link text-muted'],
    ['diff',          'h1',     'glyphicon-list-alt text-muted'],
    ['preview',       'h1',     'glyphicon-eye-open text-muted'],
    ['conflict',      'h1',     'glyphicon-alert text-warning'],
    ['subscribe',     'h1',     'glyphicon-bookmark text-muted'],
    ['unsubscribe',   'h1',     'glyphicon-bookmark text-muted'],
    ['draft',         'h1',     'glyphicon-edit text-muted'],
    ['showtag',       'h1',     'glyphicon-tags text-muted']
  ];


  function dw_mode(id) {
    return ((jQuery('.mode_' + id).length) ? true : false);
  }


  function checkSize() {

    var $screen_mode = jQuery('#screen__mode'), // Responsive Check
        $dw_aside    = jQuery('.dw__sidebar');  // Sidebar (left and/or right) node

    if ($screen_mode.find('.visible-xs').is(':visible')) {

      $dw_aside.find('.content').addClass('panel panel-default');
      $dw_aside.find('.toogle').addClass('panel-heading');
      $dw_aside.find('.collapse').addClass('panel-body').removeClass('in');

    } else {

      $dw_aside.find('.content').removeClass('panel panel-default');
      $dw_aside.find('.collapse').removeClass('panel-body').addClass('in');

    }

  }

  function resizeToc() {

    jQuery('#dw__toc .panel-body').css({
      'height'    : (jQuery(window).height() - 50 - jQuery('#dokuwiki__content').position().top) + 'px',
      'overflow-y': 'scroll'
    });

  }

  checkSize();
  jQuery(window).resize(checkSize);


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
      jQuery(document).trigger('bootstrap3:tabs');
    });

  }

  // Index tree
  if (dw_mode('index')) {

    jQuery(document).ajaxSuccess(function() {
      jQuery(document).trigger('bootstrap3:mode-index');
    });

    jQuery('#index__tree').click(function(e) {
      jQuery(document).trigger('bootstrap3:mode-index');
    });

  }


});
