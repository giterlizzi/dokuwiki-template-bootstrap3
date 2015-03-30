jQuery(document).ready(function() {

  //'use strict';

  function checkSize() {
    if (   jQuery('#screen__mode .visible-xs').is(':visible')
        || jQuery('#screen__mode .visible-sm').is(':visible')
        || jQuery('#screen__mode .visible-md').is(':visible')) {
      jQuery('#dokuwiki__aside .content').addClass('panel panel-default');
      jQuery('#dokuwiki__aside .toogle').addClass('panel-heading');
      jQuery('#dokuwiki__aside .collapse').addClass('panel-body').removeClass('in');
    } else {
      jQuery('#dokuwiki__aside .content').removeClass('panel panel-default');
      jQuery('#dokuwiki__aside .collapse').removeClass('panel-body').addClass('in');
    }

  }

  checkSize();
  jQuery(window).resize(checkSize);

  jQuery(jQuery('.mode_denied        #dokuwiki__content h1')[0]).prepend('<i class="glyphicon glyphicon-ban-circle text-danger"></i> ');
  jQuery(jQuery('.mode_show.notFound #dokuwiki__content h1')[0]).prepend('<i class="glyphicon glyphicon-alert text-warning"></i> ');
  jQuery(jQuery('.mode_login         #dokuwiki__content h1')[0]).prepend('<i class="glyphicon glyphicon-log-in text-muted"></i> ');
  jQuery(jQuery('.mode_register      #dokuwiki__content h1')[0]).prepend('<i class="glyphicon glyphicon-edit text-muted"></i> ');
  jQuery(jQuery('.mode_search        #dokuwiki__content h1')[0]).prepend('<i class="glyphicon glyphicon-search text-muted"></i> ');
  jQuery(jQuery('.mode_index         #dokuwiki__content h1')[0]).prepend('<i class="glyphicon glyphicon-list text-muted"></i> ');
  jQuery(jQuery('.mode_recent        #dokuwiki__content h1')[0]).prepend('<i class="glyphicon glyphicon-list-alt text-muted"></i> ');
  jQuery(jQuery('.mode_media         #dokuwiki__content h1')[0]).prepend('<i class="glyphicon glyphicon-download-alt text-muted"></i> ');
  jQuery(jQuery('.mode_admin         #dokuwiki__content h1')[0]).prepend('<i class="glyphicon glyphicon-cog text-muted"></i> ');
  jQuery(jQuery('.mode_profile       #dokuwiki__content h1')[0]).prepend('<i class="glyphicon glyphicon-user text-muted"></i> ');
  jQuery(jQuery('.mode_revisions     #dokuwiki__content h1')[0]).prepend('<i class="glyphicon glyphicon-time text-muted"></i> ');
  jQuery(jQuery('.mode_backlink      #dokuwiki__content h1')[0]).prepend('<i class="glyphicon glyphicon-link text-muted"></i> ');
  jQuery(jQuery('.mode_diff          #dokuwiki__content h1')[0]).prepend('<i class="glyphicon glyphicon-list-alt text-muted"></i> ');
  jQuery(jQuery('.mode_preview       #dokuwiki__content h1')[0]).prepend('<i class="glyphicon glyphicon-eye-open text-muted"></i> ');
  jQuery(jQuery('.mode_conflict      #dokuwiki__content h1')[0]).prepend('<i class="glyphicon glyphicon-alert text-warning"></i> ');
  jQuery(jQuery('.mode_subscribe     #dokuwiki__content h1, .mode_unsubscribe #dokuwiki__content h1')[0]).prepend('<i class="glyphicon glyphicon-bookmark text-muted"></i> ');

  jQuery('div.plugin_translation select').addClass('input-sm');
  jQuery('div.plugin_translation ul li div').addClass('label label-default');
  jQuery('div.plugin_translation ul li .wikilink1').parent().addClass('label-primary');
  jQuery('div.plugin_translation ul li .wikilink2').parent().addClass('label-default');

  jQuery(document).bind('DOMNodeInserted', function(){
    jQuery('#insitu__fn').addClass('panel panel-body panel-default');
  });

  jQuery('#dw__toc .open strong').addClass('glyphicon glyphicon-chevron-up');

  jQuery('#dw__toc h3').click(function() {
    if (jQuery('#dw__toc .closed').length) {
      jQuery('#dw__toc h3 strong').removeClass('glyphicon-chevron-up');
      jQuery('#dw__toc h3 strong').addClass('glyphicon-chevron-down');
    }
    if (jQuery('#dw__toc .open').length) {
      jQuery('#dw__toc h3 strong').addClass('glyphicon-chevron-up');
      jQuery('#dw__toc h3 strong').removeClass('glyphicon-chevron-down');
    }
  });

  jQuery('#dw__toc').parent().on('affixed.bs.affix', function() {
    if (jQuery('#dw__toc .open').length) {
      jQuery('#dw__toc h3').trigger('click');
    }
  });

  jQuery('#dw__toc').css('backgroundColor', jQuery('#dokuwiki__content .panel').css('backgroundColor'));

  jQuery('#dw__toc').addClass('panel panel-default');
  jQuery('#dw__toc h3').addClass('panel-heading');
  jQuery('#dw__toc h3 + div').addClass('panel-body');

  
  jQuery('#dokuwiki__content .wikilink2').addClass('text-danger');

  jQuery('#qsearch__out').addClass('panel panel-default');

  jQuery('table').parent().addClass('table-responsive');
  jQuery('#dokuwiki__content .page h1').addClass('page-header');
  jQuery('input[type=submit], input[type=reset], input[type=button], button').addClass('btn btn-default');
  jQuery('#dokuwiki__content input[type=submit]').addClass('btn-primary');
  jQuery('input, select').not('[type=hidden], [type=image]').addClass('form-control');
  jQuery('label').addClass('control-label');
  jQuery('form').addClass('form-inline');

  jQuery('.page table').addClass('table table-striped table-condensed');
  jQuery('.tabs').addClass('nav nav-tabs');

  jQuery('#tool__bar').addClass('btn-group');
  jQuery('.toolbutton').addClass('btn-xs');

  jQuery('img.media, img.mediacenter, img.medialeft, img.mediaright').addClass('img-responsive');

  jQuery('bdi').replaceWith(function() {
    return jQuery(this).contents();
  });

  jQuery('.search_hit').addClass('mark');
  jQuery('#dw__search').addClass('nav navbar-nav navbar-form');

  //jQuery('#dokuwiki__aside h5').addClass('page-header');
  jQuery('#dokuwiki__aside ul').addClass('nav nav-pills nav-stacked');
  jQuery('#dokuwiki__aside .curid').parent().parent().addClass('active');
  jQuery('#dokuwiki__aside ul div, #dokuwiki__aside ul span').replaceWith(function() {
    return jQuery(this).contents();
  });

});