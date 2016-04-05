/*!
 * DokuWiki Bootstrap3 Template: Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

jQuery(document).ready(function() {

  //'use strict';


  function dw_mode(id) {
    return ((JSINFO.bootstrap3.mode === id) ? true : false);
  }


  function mediaSize(media) {
    return jQuery(['#screen__mode .visible-', media, '-block'].join('')).is(':visible');
  }

  jQuery(window).resize(function() {
    jQuery(document).trigger('bootstrap3:mobile-layout');
    jQuery(document).trigger('bootstrap3:collapse-sections');
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
        $containers = jQuery('body > div, header nav > div, article, footer > div');

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


  // Configuration manager
  if (dw_mode('admin')) {

    var tpl_sections = {
      // Section            ID                  Insert before           Icon
      'Theme'           : [ 'theme',            'bootstrapTheme',       'fa-tint'      ],
      'Sidebar'         : [ 'sidebar',          'sidebarPosition',      'fa-columns'   ],
      'Navbar'          : [ 'navbar',           'inverseNavbar',        'fa-navicon'   ],
      'Semantic'        : [ 'semantic',         'semantic',             'fa-share-alt' ],
      'Layout'          : [ 'layout',           'fluidContainer',       'fa-desktop'   ],
      'TOC'             : [ 'toc',              'tocAffix',             'fa-list'      ],
      'Discussion'      : [ 'discussion',       'showDiscussion',       'fa-comments'  ],
      'Cookie Law'      : [ 'cookie_law',       'showCookieLawBanner',  'fa-legal'     ],
      'Google Analytics': [ 'google_analytics', 'useGoogleAnalytics',   'fa-google'    ],
      'Browser Title'   : [ 'browser_title',    'browserTitle',         'fa-header'    ],
      'Page'            : [ 'page',             'showPageInfo',         'fa-file'      ]
    };

    var admin_tasks = {
      'usermanager' : 'users',
      'acl'         : 'key',
      'extension'   : 'puzzle-piece',
      'plugin'      : 'puzzle-piece',
      'config'      : 'cogs',
      'styling'     : 'paint-brush',
      'revert'      : 'refresh',
      'popularity'  : 'envelope',
    };

    jQuery('ul.admin_tasks').addClass('list-group');
    jQuery('ul.admin_tasks a').addClass('list-group-item');

    for(i in admin_tasks) {
      jQuery('ul.admin_tasks li.admin_' + i + ' a')
        .prepend(jQuery('<i class="fa fa-' + admin_tasks[i] + ' fa-fw fa-pull-left" />'));
    }

    jQuery('#admin__version').prepend('<img src="'+ DOKU_BASE +'lib/tpl/dokuwiki/images/logo.png" class="pull-left" /> ');

    jQuery('label[for^=config___tpl____bootstrap3]').each(function() {
      var $node = jQuery(this);
      jQuery.each(tpl_sections, function(section, item){
        if( $node.attr('for').match([item[1], '$'].join('')) ) {
          $node.parents('tr').before(jQuery(['<tr><td><h4 id="bootstrap3__', item[0] ,'"><i class="fa fa-fw ', item[2], '"></i> ', section, '</h4></td><td></td></tr>'].join('')))
        }
      });
    });

  }

});
