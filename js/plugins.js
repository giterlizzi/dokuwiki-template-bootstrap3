/*!
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

jQuery(document).on('bootstrap3:plugins', function(e) {

  setTimeout(function() {

    var $tags             = jQuery('.tags'),                       // Tags Plugin
        $page             = jQuery('table tbody th.page:even'),    // Tags Plugin: Count
        $csv              = jQuery('table tbody tr.row0 th.col0'), // CSV Plugin
        $translation      = jQuery('#dw__translation'),            // Translation Plugin
        $discussion       = jQuery('.comment_wrapper'),            // Discussion Plugin
        $publish          = jQuery('.approval'),                   // Publish Plugin
        $tagging_edit     = jQuery('.plugin_tagging_edit'),        // Tagging Plugin
        $explain          = jQuery('.explain'),                    // Explain Plugin
        $wrap             = jQuery('.plugin_wrap'),                // Wrap Plugin
        $datatables       = jQuery('.dt-wrapper'),                 // DataTables Plugin
        $dataplugin_entry = jQuery('.dataplugin_entry'),           // Data Plugin: Entry
        $dataplugin_table = jQuery('.dataplugin_table'),           // Data Plugin: Table
        $toc              = jQuery('#dw__toc'),                    // DokuWiki TOC
        $toc2             = jQuery('div.inlinetoc2'),              // InlineTOC Plugin
        $davcal           = jQuery('#fullCalendar'),               // DAVCal Plugin
        $include_readmore = jQuery('.include_readmore');           // Include Plugin (Read More)


    // CSV Plugin
    if ($csv.length) {

      $csv.each(function() {
        var $table = jQuery(this).parents('table');
        if ($table.find('tr.row1 th').length == 0) {
          $table.prepend('<thead/>');
          $header = $table.find('tr.row0');
          $table.find('thead').append($header);
        }
      });

    }


    // Tag Plugin: Count
    if ($page.length) {

      $page.each(function(){
        var $table  = jQuery(this).parents('table'),
            $header = $table.find('th');
        $table.prepend('<thead><tr/></thead>');
        $table.find('thead tr').append($header);
        $header.removeClass('page');
      });

    }


    // Include Plugin (Read More)
    if ($include_readmore.length) {
      $include_readmore.find('a').addClass('btn btn-default btn-xs');
    }


    // DAVCal Plugin
    if ($davcal.length) {
      $davcal.find('.fc-button-group').addClass('btn-group');
    }


    // InlineTOC Plugin
    if ($toc2.length && $toc.length) {
      $toc.css('display', 'none');
      $toc2.addClass('panel panel-default');
    }


    // Data Plugin: Entry
    if ($dataplugin_entry.length) {
      $dataplugin_entry.find('dl').addClass('panel panel-default');
    }


    // Data Plugin: Table
    if ($dataplugin_table.length) {

      $dataplugin_table.find('input').addClass('input-sm');

      var $header = $dataplugin_table.find('th[style]'),
          $inputs = $dataplugin_table.find('th input'),
          header_width = [],
          i = 0;

      $header.each(function() {
        header_width.push(this.style.width);
      });

      $inputs.each(function() {
        this.style.width = header_width[i];
        i++;
      });

    }


    // DataTables Plugin
    if ($datatables.length) {
      $datatables.find('.table-responsive').removeClass('table-responsive');
    }


    // Publish plugin
    if ($publish.length) {

      $publish.prependTo('.page');

      $publish.removeClass('approval').addClass('alert');

      jQuery('.apr_table').removeClass('table-striped');

      if ($publish.hasClass('approved_no')) {
        $publish.removeClass('approved_no')
          .addClass('alert-warning')
          .prepend('<i class="fa fa-fw fa-info-circle"/> ');
      }
      if ($publish.hasClass('approved_yes')) {
        $publish.removeClass('approved_yes')
          .addClass('alert-success')
          .prepend('<i class="fa fa-fw fa-check-circle"/> ');
      }

    }


    // Discussion plugin
    if ($discussion.length) {

      $discussion.find('h2').addClass('page-header');
      $discussion.find('.comment_buttons').addClass('text-right');
      $discussion.find('#discussion__section').prepend('<i class="fa fa-fw fa-comments"/> ');

      $discussion.find('.hentry').addClass('panel panel-default');
      $discussion.find('.hentry .comment_head').addClass('panel-heading');
      $discussion.find('.hentry .comment_body').addClass('panel-body');
      $discussion.find('.toolbar').addClass('btn-group');
      $discussion.find('.comment_buttons [type=submit]').addClass('btn-xs');
      $discussion.find('.comment_buttons .discussion__delete .btn').addClass('btn-danger');
      $discussion.find('.comment_buttons .discussion__reply .btn').addClass('btn-success');
      $discussion.find('#discussion__btn_submit').addClass('btn-success');

      jQuery(document).bind('DOMNodeInserted', function(){
        $discussion.find('.toolbutton').addClass('btn btn-xs');
      });

    }


    // Translation Plugin
    if ($translation.length) {

      var $current = $translation.find('.cur'),
          $lang    = $current.text(),
          $iso     = $lang.match(/\(([a-z]*)\)/),
          $flag    = $current.find('img');

      $current.parent().addClass('active');
      $translation.find('.wikilink2').removeClass('wikilink2').css('opacity', '0.5');

      if ($flag.length) {
        $translation.find('.dropdown-toggle i').hide();
        $translation.find('.dropdown-toggle').prepend(
          jQuery('<img/>').attr({
            'src'   : $flag.attr('src'),
            'title' : $flag.attr('title') }));
      }

    }


    // Tags plugin
    if ($tags.length) {

      $tags.each(function() {

        var $tag = jQuery(this);
        $tag.html($tag.html().replace(/,/g, ''));

        var $tagLabel = $tag.find('a').addClass('label label-default')
                                      .prepend('<i class="fa fa-fw fa-tag"/> ');


        if (JSINFO.bootstrap3.tagsOnTop && $tag.prop('tagName').toLowerCase() == 'div' && ! $tag.parents('.plugin_include_content').length) {
          $tag.remove();
          $tagLabel.prependTo('.pageId');
        }

        if ($tag.parents('.plugin_include_content').length) {
          $tag.find('span').contents().unwrap();
        }

      });

    }


    // Tagging plugin
    if ($tagging_edit.length) {
      $tagging_edit.find(':submit').addClass('btn-xs');
      $tagging_edit.find('[type=text]').addClass('input-sm');
      $tagging_edit.find('#tagging__edit_save').addClass('btn-success');
    }


    if (dw_mode('media')) {
      jQuery(document).ajaxSuccess(function() {
        // Gallery Plugin (Media Manager)
        jQuery('.mode_media .meta .row').removeClass('row');
      });
    }


    // Explain Plugin
    if ($explain.length) {

      $explain.each(function(){

        var $self    = jQuery(this),
            $tooltip = $self.find('.tooltip');

        $self.attr({
          'data-toggle'    : 'tooltip',
          'data-placement' : 'bottom',
          'title'          : $tooltip.html(),
        }).addClass('wikilink1').removeClass('explain');

        $tooltip.remove();

      });

      jQuery('[data-toggle="tooltip"]').tooltip();

    }


    // Wrap Plugin
    if ($wrap.length) {

      if ($wrap.hasClass('tabs')) {
        var $tabs = jQuery('.plugin_wrap.tabs');
        $tabs.find('div.li').contents().unwrap();
        $tabs.find('.curid').parent().addClass('active');
        $tabs.find('ul').addClass('nav nav-tabs');
      }

    }

  }, 0);

});
