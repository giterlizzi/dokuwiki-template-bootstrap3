/*!
 * DokuWiki Bootstrap3 Template
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



  // Normalization & Basic Styling
  jQuery(document).on('bootstrap3:init', function(e) {

    var $dw_content = jQuery('#dokuwiki__content');  // Page Content node

    // Move/Save .curid to anchor child
    jQuery('.curid').find('a').addClass('curid');

    // Add "nav" class to sidebars and toc
    jQuery('.dw__sidebar ul, #dw__toc ul').addClass('nav');

    // Remove several tags
    jQuery('bdi, span.curid').replaceWith(function() {
      return jQuery(this).contents();
    });

    // Non-existent DokwWiki Page
    $dw_content.find('.wikilink2').addClass('text-danger');

    // Search Hits
    jQuery('.search_hit').addClass('mark');

    // Page heading
    $dw_content.find('h1').first().addClass('page-header');

    // Tables (no for Rack and Diagram Plugins)
    $dw_content.find('table').not('.rack, .diagram').parent().addClass('table-responsive');
    $dw_content.find('table').not('.rack, .diagram').addClass('table table-striped table-condensed');
  
    if (! TPL_CONFIG.tableFullWidth) {
      $dw_content.find('.table').css('width', 'auto');
    }

    // Form and controls
    jQuery(':submit, :button, :reset').addClass('btn btn-default');
    jQuery('input, select, textarea')
      .not('[type=submit], [type=reset], [type=button], [type=hidden], [type=image], [type=checkbox], [type=radio]')
      .addClass('form-control');
    jQuery('input[type=checkbox]').addClass('checkbox-inline');
    jQuery('input[type=radio]').addClass('radio-inline');
    jQuery('label').addClass('control-label');
    $dw_content.find('form').addClass('form-inline');

    // Images
    jQuery('img.media, img.mediacenter, img.medialeft, img.mediaright').addClass('img-responsive');

    // Toolbar
    jQuery('#tool__bar').addClass('btn-group')
      .find('.toolbutton').addClass('btn-xs');

  });


  // Nav
  jQuery(document).on('bootstrap3:nav', function(e) {
    
    // Unwrap unnecessary tags inside list items for Bootstrap nav component
    jQuery('.nav div.li *').unwrap();

  });


  // Tabs
  jQuery(document).on('bootstrap3:tabs', function(e) {

    jQuery('ul.tabs').addClass('nav nav-tabs');

    jQuery('ul.tabs strong').replaceWith(function() {
      jQuery(this).parent().addClass('active'); return jQuery('<a href="#"/>').html(jQuery(this).contents());
    });

  });


  // Buttons
  jQuery(document).on('bootstrap3:buttons', function(e) {

    jQuery('.button').removeClass('button');
    jQuery('.alert button').removeClass('btn btn-default');
    jQuery('#dw__login, #dw__register, #subscribe__form').find(':submit').addClass('btn-success');
    jQuery('#dw__profiledelete').find(':submit').addClass('btn-danger');
    jQuery('#edbtn__save').addClass('btn-success');
    jQuery('nav li span .action.register').addClass('btn btn-success navbar-btn');
    jQuery('nav li span .action.login, nav li span nav .action.logout').addClass('btn btn-default navbar-btn');

    // Section Button edit
    jQuery('.btn_secedit .btn').input2button();
    jQuery('.btn_secedit .btn').addClass('btn-xs').prepend('<i class="glyphicon glyphicon-edit"/> ');

  });


  // Back To Top
  jQuery(document).on('bootstrap3:back-to-top', function(e) {

    jQuery('.back-to-top').click(function() {
      jQuery('html, body').animate({ scrollTop: 0 }, 600);
    });

    // Display back-to-top during scroll
    jQuery(window).scroll(function() {
      if (jQuery(this).scrollTop()) {
        jQuery('.back-to-top').fadeIn();
      } else {
        jQuery('.back-to-top').fadeOut();
      }
    });

  });


  // Icons for DokuWiki Actions
  jQuery(document).on('bootstrap3:icons', function(e) {

    jQuery.each(icons, function(i) {
  
      var mode     = ['.mode_', icons[i][0]].join(''),
          selector = icons[i][1],
          icon     = icons[i][2];
  
      var icon_selector = [mode, '#dokuwiki__content', selector].join(' '),
          icon_tag      = ['<i class="glyphicon ', icon, '"/> '].join('');
  
      jQuery(jQuery(icon_selector)[0]).prepend(icon_tag);
  
    });

    // Interwiki User page icon
    jQuery('.iw_user').prepend('<i class="glyphicon glyphicon-user"/> ');

    // Personal Home-Page icon
    if (NS == 'user' && dw_mode('show')) {
      jQuery('.mode_show #dokuwiki__content h1').prepend('<i class="glyphicon glyphicon-user"/> ');
    }

  });


  // Footnote
  jQuery(document).on('bootstrap3:footnotes', function(e) {

    if (! jQuery('.footnotes').length) return false;

    jQuery(document).bind('DOMNodeInserted', function(){
      jQuery('#insitu__fn').addClass('panel panel-body panel-default');
    });

    if (jQuery('.footnotes').length) {
      jQuery('.footnotes').prepend(jQuery('<hr/>'));
    }

  });


  // Table of Contents
  jQuery(document).on('bootstrap3:toc', function(e) {

    var $dw_toc = jQuery('#dw__toc');

    if (! $dw_toc.length) return false;

    $dw_toc.find('.open strong').addClass('glyphicon glyphicon-chevron-up');
    $dw_toc.css('backgroundColor', jQuery('#dokuwiki__content .panel').css('backgroundColor'));
    $dw_toc.addClass('panel panel-default');
    $dw_toc.find('h3').addClass('panel-heading')
                      .prepend('<i class="glyphicon glyphicon-list" style="padding-right: 5px"/> ');
    $dw_toc.find('h3 + div').addClass('panel-body');

    $dw_toc.find('h3').click(function() {

      if ($dw_toc.find('.closed').length) {
        $dw_toc.find('h3 strong').removeClass('glyphicon-chevron-up')
                                 .addClass('glyphicon-chevron-down');
        jQuery($dw_toc.find('h3 strong')[0].nextSibling).wrap('<span class="label hide"/>');
      }

      if ($dw_toc.find('.open').length) {
        $dw_toc.find('h3 strong').addClass('glyphicon-chevron-up')
                                 .removeClass('glyphicon-chevron-down');
        $dw_toc.find('h3 .label').replaceWith(function() {
          return jQuery(this).contents();
        });
      }

    });

    $dw_toc.parent().on('affixed.bs.affix', function(e) {

      if ($dw_toc.find('.open').length) {
        $dw_toc.find('h3').trigger('click');
      }

    });

    if ((jQuery(window).height() < jQuery('#dw__toc').height())) {
      resizeToc();  
      jQuery(window).resize(resizeToc);
    }

    var bodyOffset = parseInt(jQuery('body').css('paddingTop')) || 0;

    $dw_toc.find('ul').addClass('nav');
    jQuery('body').scrollspy({
      target: '#dw__toc',
      offset: bodyOffset + 10
    });

    // Scrolling animation
    $dw_toc.find('a').click(function() {

      var sectionPosition = (jQuery(jQuery.attr(this, 'href')).offset().top - bodyOffset);

      jQuery('html, body').animate({
        scrollTop: sectionPosition
      }, 600);

      return false;

    });

  });


  // Alerts
  jQuery(document).on('bootstrap3:alerts', function(e) {

    // Info
    jQuery('div.info')
      .removeClass('info')
      .addClass('alert alert-info')
      .prepend('<i class="glyphicon glyphicon-info-sign"/> ');
  
    // Error
    jQuery('div.error')
      .removeClass('error')
      .addClass('alert alert-danger')
      .prepend('<i class="glyphicon glyphicon-exclamation-sign"/> ');
  
    // Success
    jQuery('div.success')
      .removeClass('success')
      .addClass('alert alert-success')
      .prepend('<i class="glyphicon glyphicon-ok-sign"/> ');
  
    // Notify
    jQuery('div.notify')
      .removeClass('notify')
      .addClass('alert alert-warning')
      .prepend('<i class="glyphicon glyphicon-warning-sign"/> ');

  });


  // Sidebar
  jQuery(document).on('bootstrap3:sidebar', function(e) {

    var $dw_aside = jQuery('.dw__sidebar');  // Sidebar (left and/or right) node
  
    if (! $dw_aside.length) return false;
  
    // Add nav style to all lists
    $dw_aside.find('ul').addClass('nav nav-pills nav-stacked');
    
    // Activate the current page
    $dw_aside.find('ul.nav .curid')
      .removeClass('curid')
      .parent()
      .addClass('active');

  });


  // Quick Search & Search Form
  jQuery(document).on('bootstrap3:search', function(e) {

    var $dw_search = jQuery('#dw__search');  // Search form node

    $dw_search.find('#qsearch__in').attr({
      'type'        : 'search',
      'placeholder' : $dw_search.find(':submit').attr('title'),
    });
    $dw_search.find('#qsearch__out').addClass('panel panel-default');
    $dw_search.find(':submit').input2button();
    $dw_search.find(':submit').html('').append('<i class="glyphicon glyphicon-search"/>');

  });


  // You are here and breadcrumbs
  jQuery(document).on('bootstrap3:breadcrumbs', function(e) {

    var $dw_breadcrumbs = jQuery('#dw__breadcrumbs');  // Breadcrumbs node

    if (! $dw_breadcrumbs.length) return false; 

    $dw_breadcrumbs.find('span.home a').addClass('home').text('').prepend('<i class="glyphicon glyphicon-home"/>');
    //$dw_breadcrumbs.find('span.curid').find('a').addClass('curid');
    $dw_breadcrumbs.find('span.bchead').addClass('pull-left');

    jQuery.each(['.dw__youarehere', '.dw__breadcrumbs'], function(idx, item){
      $dw_breadcrumbs.find(item + ' a').wrap('<li/>');
      $dw_breadcrumbs.find(item + ' a.curid').parent().addClass('active');
      $dw_breadcrumbs.find(item + ' li').wrapAll('<ul class="breadcrumb"/>');
    });

    $dw_breadcrumbs.find('span.home, span.bcsep, span.curid').replaceWith(function() {
      return jQuery(this).contents();
    });

  });


  // Media Manager
  jQuery(document).on('bootstrap3:media-manager', function(e) {

      var $media_popup    = jQuery('#media__content'),     // Media Manager (pop-up)
          $media_manager  = jQuery('#mediamanager__page'); // Media Manager (page)

    // Media Manager (pop-up)
    if ($media_popup.length) {
      jQuery('.qq-upload-button').addClass('btn btn-default');
      jQuery('#mediamanager__upload_button').addClass('btn-success');
    }

    // Media Manager (page)
    if ($media_manager.length) {
      $media_manager.find('.file dl').addClass('dl-horizontal');
      $media_manager.find('.panel').removeClass('panel').addClass('pull-left');
    }

  });


  // Detail page
  jQuery(document).on('bootstrap3:detail', function(e) {

    var $detail_page = jQuery('#dokuwiki__detail'); // Detail Page node

    if (! $detail_page.length) return false;

    $detail_page.find('img.img_detail')
      .addClass('thumbnail img-responsive');
    $detail_page.find('dl')
      .addClass('dl-horizontal');
    $detail_page.find('.img_backto')
      .addClass('btn btn-success')
      .prepend('<i class="glyphicon glyphicon-arrow-left"/> ');
    $detail_page.find('.mediaManager')
      .addClass('btn btn-default')
      .prepend('<i class="glyphicon glyphicon-picture"/> ');

  });


  // Search mode
  jQuery(document).on('bootstrap3:mode-search', function(e) {

    if (! dw_mode('search')) return false;

    jQuery('ul.search_quickhits li a').prepend('<i class="glyphicon glyphicon-file text-muted"/> ');

    jQuery('.search_results dt')
      .contents()
      .filter(function() {
        return this.nodeType === 3;
      })
      .wrap('<span class="label label-primary"/>');

      jQuery('.search_results .label').before('&nbsp;&nbsp;&nbsp;');

      var x = 0;

      jQuery('.search_results .label').each(function() {
        var $node = jQuery(this);
        $node.html($node.html().replace(/^\: /, ''));
      });

  });


  // Administration
  jQuery(document).on('bootstrap3:mode-admin', function(e) {

    if (! dw_mode('admin')) return false;

    var $mode_admin = jQuery('.mode_admin');  // Admin mode node

    // Extension page
    var $ext_manager = $mode_admin.find('#extension__manager'),
        $ext_actions = $ext_manager.find('.actions');

    $ext_actions.addClass('btn-group');

    $ext_actions.find('.permerror')
      .addClass('pull-left');

    $ext_actions.find('.btn')
      .addClass('btn-xs')
      .input2button();

    $ext_actions.find('.uninstall')
      .addClass('btn-danger')
      .prepend('<i class="glyphicon glyphicon-trash"/> ');

    $ext_actions.find('.install, .update, .reinstall')
      .addClass('btn-primary')
      .prepend('<i class="glyphicon glyphicon-download-alt"/> ');

    $ext_actions.find('.enable')
      .addClass('btn-success')
      .prepend('<i class="glyphicon glyphicon-ok"/> ');

    $ext_actions.find('.disable').addClass('btn-warning')
      .prepend('<i class="glyphicon glyphicon-ban-circle"/> ');

    $mode_admin.find('#dokuwiki__content :submit')
      .addClass('btn-success');

    $ext_manager.find('form.search :submit, form.install :submit').input2button();

    $ext_manager.find('form.search button')
      .prepend('<i class="glyphicon glyphicon-search"/> ');

    $ext_manager.find('form.install button')
      .prepend('<i class="glyphicon glyphicon-download-alt"/> ');

  });


  // Index Page
  jQuery(document).on('bootstrap3:mode-index', function(e) {

    if (! dw_mode('index')) return false;

    var $directories = jQuery('a.idx_dir'),
        $pages       = jQuery('a.wikilink1');

    jQuery.each($directories, function() {

      var $directory = jQuery(this),
          $closed    = $directory.parents('.closed'),
          $open      = $directory.parents('.open');

      if (! $directory.find('.glyphicon').length) {
        $directory.prepend('<i class="glyphicon text-primary"/> ');
      }

      if ($open.length) {
        $directory.find('i')
          .removeClass('glyphicon-folder-close')
          .addClass('glyphicon-folder-open');
      }

      if ($closed.length) {
        $directory.find('i')
          .removeClass('glyphicon-folder-open')
          .addClass('glyphicon-folder-close');
      }

    });

    jQuery.each($pages, function() {

      var $page = jQuery(this);

      if (! $page.find('i').length) {
        $page.prepend('<i class="glyphicon glyphicon-file text-muted"/> ');
      }

    });

  });


  jQuery(document).on('bootstrap3:components', function(e) {

    var events = [ 'mode-index', 'nav', 'sidebar', 'breadcrumbs', 'tabs', 'buttons', 'back-to-top', 'icons', 'footnotes', 'toc', 'alerts', 'mode-admin', 'mode-search', 'media-manager', 'detail', 'search' ];

    for (i in events.sort()) {
      jQuery(document).trigger('bootstrap3:' + events[i]);
    }

  });


  // Init template
  jQuery(document).trigger('bootstrap3:init');

  // Init other components
  jQuery(document).trigger('bootstrap3:components');

  /* DOKUWIKI:include plugins.js */

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
