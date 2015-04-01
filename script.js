jQuery(document).ready(function() {

  //'use strict';

  var $dw_aside    = jQuery('#dokuwiki__aside'),       // Sidebar
      $dw_content  = jQuery('#dokuwiki__content'),     // Page Content
      $dw_toc      = jQuery('#dw__toc'),               // Table of Content
      $screen_mode = jQuery('#screen__mode'),          // Responsive Check
      $tags        = jQuery('.tags'),                  // Tags Plugin
      $translation = jQuery('div.plugin_translation'); // Translation Plugin

  // Icons for DokuWiki Actions
  var icons = [
    ['.mode_denied        #dokuwiki__content h1', '<i class="glyphicon glyphicon-ban-circle text-danger"></i> '],
    ['.mode_show.notFound #dokuwiki__content h1', '<i class="glyphicon glyphicon-alert text-warning"></i> '],
    ['.mode_login         #dokuwiki__content h1', '<i class="glyphicon glyphicon-log-in text-muted"></i> '],
    ['.mode_register      #dokuwiki__content h1', '<i class="glyphicon glyphicon-edit text-muted"></i> '],
    ['.mode_search        #dokuwiki__content h1', '<i class="glyphicon glyphicon-search text-muted"></i> '],
    ['.mode_index         #dokuwiki__content h1', '<i class="glyphicon glyphicon-list text-muted"></i> '],
    ['.mode_recent        #dokuwiki__content h1', '<i class="glyphicon glyphicon-list-alt text-muted"></i> '],
    ['.mode_media         #dokuwiki__content h1', '<i class="glyphicon glyphicon-download-alt text-muted"></i> '],
    ['.mode_admin         #dokuwiki__content h1', '<i class="glyphicon glyphicon-cog text-muted"></i> '],
    ['.mode_profile       #dokuwiki__content h1', '<i class="glyphicon glyphicon-user text-muted"></i> '],
    ['.mode_revisions     #dokuwiki__content h1', '<i class="glyphicon glyphicon-time text-muted"></i> '],
    ['.mode_backlink      #dokuwiki__content h1', '<i class="glyphicon glyphicon-link text-muted"></i> '],
    ['.mode_diff          #dokuwiki__content h1', '<i class="glyphicon glyphicon-list-alt text-muted"></i> '],
    ['.mode_preview       #dokuwiki__content h1', '<i class="glyphicon glyphicon-eye-open text-muted"></i> '],
    ['.mode_conflict      #dokuwiki__content h1', '<i class="glyphicon glyphicon-alert text-warning"></i> '],
    ['.mode_subscribe     #dokuwiki__content h1', '<i class="glyphicon glyphicon-bookmark text-muted"></i> '],
    ['.mode_unsubscribe   #dokuwiki__content h1', '<i class="glyphicon glyphicon-bookmark text-muted"></i> '],
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


  // Icons for DokuWiki Actions
  jQuery.each(icons, function(i){
    jQuery(jQuery(icons[i][0])[0]).prepend(icons[i][1]);
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
  $dw_toc.find('h3').addClass('panel-heading');
  $dw_toc.find('h3 + div').addClass('panel-body');

  $dw_toc.find('h3').click(function() {
    if ($dw_toc.find('.closed').length) {
      $dw_toc.find('h3 strong').removeClass('glyphicon-chevron-up');
      $dw_toc.find('h3 strong').addClass('glyphicon-chevron-down');
    }
    if ($dw_toc.find('.open').length) {
      $dw_toc.find('h3 strong').addClass('glyphicon-chevron-up');
      $dw_toc.find('h3 strong').removeClass('glyphicon-chevron-down');
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
