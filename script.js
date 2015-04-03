jQuery(document).ready(function() {

  //'use strict';

  var $dw_aside    = jQuery('.dw__sidebar'),           // Sidebar
      $dw_content  = jQuery('#dokuwiki__content'),     // Page Content
      $dw_toc      = jQuery('#dw__toc'),               // Table of Content
      $screen_mode = jQuery('#screen__mode'),          // Responsive Check
      $tags        = jQuery('.tags'),                  // Tags Plugin
      $translation = jQuery('div.plugin_translation'); // Translation Plugin

  // Icons for DokuWiki Actions
  var icons = [
    ['.mode_denied',        'glyphicon-ban-circle text-danger'],
    ['.mode_show.notFound', 'glyphicon-alert text-warning'],
    ['.mode_login',         'glyphicon-log-in text-muted'],
    ['.mode_register',      'glyphicon-edit text-muted'],
    ['.mode_search',        'glyphicon-search text-muted'],
    ['.mode_index',         'glyphicon-list text-muted'],
    ['.mode_recent',        'glyphicon-list-alt text-muted'],
    ['.mode_media',         'glyphicon-download-alt text-muted'],
    ['.mode_admin',         'glyphicon-cog text-muted'],
    ['.mode_profile',       'glyphicon-user text-muted'],
    ['.mode_revisions',     'glyphicon-time text-muted'],
    ['.mode_backlink',      'glyphicon-link text-muted'],
    ['.mode_diff',          'glyphicon-list-alt text-muted'],
    ['.mode_preview',       'glyphicon-eye-open text-muted'],
    ['.mode_conflict',      'glyphicon-alert text-warning'],
    ['.mode_subscribe',     'glyphicon-bookmark text-muted'],
    ['.mode_unsubscribe',   'glyphicon-bookmark text-muted'],
    ['.mode_draft',         'glyphicon-edit text-muted'],
  ];

  function checkSize() {

    if ($screen_mode.find('.visible-xs').is(':visible')) {

      $dw_aside.find('.content').addClass('panel panel-default');
      $dw_aside.find('.toogle').addClass('panel-heading');
      $dw_aside.find('.collapse').addClass('panel-body').removeClass('in');

    } else {

      $dw_aside.find('.content').removeClass('panel panel-default');
      $dw_aside.find('.collapse').removeClass('panel-body').addClass('in');

    }

  }

  checkSize();
  jQuery(window).resize(checkSize);


  // Back To Top
  jQuery('.back-to-top').click(function() {
    jQuery('html, body').animate({ scrollTop: 0 }, 600);
  });


  // Icons for DokuWiki Actions
  jQuery.each(icons, function(i) {
    var selector = [icons[i][0], ' #dokuwiki__content h1'].join(''),
        icon     = ['<i class="glyphicon ', icons[i][1], '"></i> '].join('');
    jQuery(jQuery(selector)[0]).prepend(icon);
  });


  // Translation Plugin
  $translation.find('select').addClass('input-sm');
  $translation.find('ul li div').addClass('label label-default');


  // Tags plugin
  if ($tags.length) {
    $tags.hide();
    $tags.find('a').addClass('label label-default')
                   .prepend('<i class="glyphicon glyphicon-tag"></i> ')
                   .prependTo('.pageId').css('marginLeft', '3px');
  }


  // Footnote
  jQuery(document).bind('DOMNodeInserted', function(){
    jQuery('#insitu__fn').addClass('panel panel-body panel-default');
  });


  // Table of Contents
  $dw_toc.find('.open strong').addClass('glyphicon glyphicon-chevron-up');
  $dw_toc.css('backgroundColor', jQuery('#dokuwiki__content .panel').css('backgroundColor'));
  $dw_toc.addClass('panel panel-default');
  $dw_toc.find('h3').addClass('panel-heading')
                    .prepend('<i class="glyphicon glyphicon-list" style="padding-right: 5px"></i> ');
  $dw_toc.find('h3 + div').addClass('panel-body');

  $dw_toc.find('h3').click(function() {

    if ($dw_toc.find('.closed').length) {
      $dw_toc.find('h3 strong').removeClass('glyphicon-chevron-up')
                               .addClass('glyphicon-chevron-down');
      jQuery($dw_toc.find('h3 strong')[0].nextSibling).wrap('<span class="label hide"></span>');
    }

    if ($dw_toc.find('.open').length) {
      $dw_toc.find('h3 strong').addClass('glyphicon-chevron-up')
                               .removeClass('glyphicon-chevron-down');
      $dw_toc.find('h3 .label').replaceWith(function() {
        return jQuery(this).contents();
      });
    }

  });

  $dw_toc.parent().on('affixed.bs.affix', function() {
    if ($dw_toc.find('.open').length) {
      $dw_toc.find('h3').trigger('click');
    }
  });


  // Sidebar
  $dw_aside.find('ul').addClass('nav nav-pills nav-stacked');
  $dw_aside.find('.curid').parent().parent().addClass('active');
  $dw_aside.find('ul div, ul span').replaceWith(function() {
    return jQuery(this).contents();
  });


  // Non-existent DokwWiki Page   
  $dw_content.find('.wikilink2').addClass('text-danger');


  // Quick Search
  jQuery('#qsearch__out').addClass('panel panel-default');


  // Common styles
  $dw_content.find('.page h1').addClass('page-header');
  $dw_content.find('input[type=submit]').addClass('btn-primary');
  jQuery('table').parent().addClass('table-responsive');
  jQuery('input[type=submit], input[type=reset], input[type=button], button').addClass('btn btn-default');
  jQuery('input, select').not('[type=hidden], [type=image]').addClass('form-control');
  jQuery('label').addClass('control-label');
  jQuery('form').addClass('form-inline');
  jQuery('img.media, img.mediacenter, img.medialeft, img.mediaright').addClass('img-responsive');
  jQuery('#tool__bar').addClass('btn-group');
  jQuery('#dw__search').addClass('nav navbar-nav navbar-form');
  jQuery('.page table').addClass('table table-striped table-condensed');
  jQuery('.tabs').addClass('nav nav-tabs');
  jQuery('.toolbutton').addClass('btn-xs');
  jQuery('.search_hit').addClass('mark');

  jQuery('bdi').replaceWith(function() {
    return jQuery(this).contents();
  });

});
