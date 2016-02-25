/*!
 * DokuWiki Bootstrap3 Template: Template Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */


// Normalization & Basic Styling
jQuery(document).on('bootstrap3:init', function(e) {

  setTimeout(function() {

    var $dw_content = jQuery('#dokuwiki__content, #media__manager');  // Page Content node

    // Move/Save .curid to anchor child
    jQuery('.curid').find('a').addClass('curid');

    // Unwrap several tags
    jQuery('bdi, span.curid').contents().unwrap();

    // Search Hits
    jQuery('.search_hit').addClass('mark');

    // a11y
    jQuery('.a11y').not('.picker').addClass('sr-only');

    // Page heading
    $dw_content.find('h1, h2').addClass('page-header');

    // Abbr tooltips
    jQuery('abbr').tooltip();

    // Tables
    if (JSINFO.bootstrap3.tableStyle.indexOf('responsive') !== -1) {
      $dw_content.find('div.table').addClass('table-responsive');
    }

    var table_class = ['table'];

    if (JSINFO.bootstrap3.tableStyle.indexOf('striped') !== -1)   table_class.push('table-striped');
    if (JSINFO.bootstrap3.tableStyle.indexOf('condensed') !== -1) table_class.push('table-condensed');
    if (JSINFO.bootstrap3.tableStyle.indexOf('hover') !== -1)     table_class.push('table-hover');
    if (JSINFO.bootstrap3.tableStyle.indexOf('bordered') !== -1)  table_class.push('table-bordered');

    $dw_content.find('table.inline').addClass(table_class.join(' '));

    if (! JSINFO.bootstrap3.tableFullWidth) {
      $dw_content.find('table.inline').css('width', 'auto');
    }

    // Form and controls
    $dw_content.find(':submit, :button, :reset').addClass('btn btn-default');
    jQuery('input, select, textarea')
      .not('[type=submit], [type=reset], [type=button], [type=hidden], [type=image], [type=checkbox], [type=radio]')
      .addClass('form-control');
    jQuery('input[type=checkbox]').addClass('checkbox-inline');
    jQuery('input[type=radio]').addClass('radio-inline');
    jQuery('label').addClass('control-label');
    jQuery('main form').addClass('form-inline');

    // Images
    jQuery('img.media, img.mediacenter, img.medialeft, img.mediaright').addClass('img-responsive');

    // Toolbar
    jQuery('#tool__bar').addClass('btn-group')
      .find('.toolbutton').addClass('btn-xs');

    // Picker
    if (dw_mode('edit')) {
      jQuery('.picker').addClass('btn-group');
    }

    // Fix list overlap in media images
    jQuery('main ul, main ol').not('.nav, .dropdown-menu').addClass('fix-media-list-overlap');

    // Personal Home-Page icon
    if (NS == 'user' && dw_mode('show') && jQuery('.notFound').length == 0) {
      jQuery('.mode_show #dokuwiki__content h1').prepend('<i class="fa fa-fw fa-user"/> ');
    }

  }, 0);

});


// Nav
jQuery(document).on('bootstrap3:nav', function(e) {

  setTimeout(function() {

    // Unwrap unnecessary tags inside list items for Bootstrap nav component
    jQuery('.nav div.li')
      .contents().unwrap();

    // Move the font-icons inside a link
    var $links = jQuery('.nav li i + a');
    if ($links.length) {
      jQuery.each($links, function() {
        var $link = jQuery(this),
            $icon = $link.prev();
        $icon.prependTo($link);
        $icon.after(' ');
      });
    }

  }, 0);

});


// Tabs
jQuery(document).on('bootstrap3:tabs', function(e) {

  setTimeout(function() {

    jQuery('ul.tabs').addClass('nav nav-tabs');

    jQuery('ul.tabs strong').replaceWith(function() {

      jQuery(this).parent().addClass('active');
      return jQuery('<a href="#"/>').html(jQuery(this).contents());

    });

  }, 0);

});


// Buttons
jQuery(document).on('bootstrap3:buttons', function(e) {

  setTimeout(function() {

    jQuery('.button').removeClass('button');
    jQuery('.alert button').removeClass('btn btn-default');
    jQuery('#dw__login, #dw__register, #subscribe__form, #media__manager').find(':submit').addClass('btn-success');
    jQuery('#dw__profiledelete').find(':submit').addClass('btn-danger');
    jQuery('#edbtn__save').addClass('btn-success');

    // Section Button edit
    jQuery('.btn_secedit .btn').input2button();
    jQuery('.btn_secedit .btn').addClass('btn-xs');

  }, 0);

});


// Back To Top
jQuery(document).on('bootstrap3:back-to-top', function(e) {

  setTimeout(function() {

    jQuery('.back-to-top').click(function(e) {
      e.preventDefault();
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

  }, 0);

});


// Footnote
jQuery(document).on('bootstrap3:footnotes', function(e) {

  setTimeout(function() {

    if (! jQuery('.footnotes').length) return false;

    jQuery(document).bind('DOMNodeInserted', function(){
      jQuery('#insitu__fn').addClass('panel panel-body panel-default');
    });

    if (jQuery('.footnotes').length) {
      jQuery('.footnotes').prepend(jQuery('<hr/>'));
    }

  }, 0);

});


// Table of Contents
jQuery(document).on('bootstrap3:toc', function(e) {

  setTimeout(function() {

    var $dw_toc = jQuery('#dokuwiki__toc');

    if (! $dw_toc.length) return false;

    var $toc_col     = jQuery('article .toc-col'),
        $content_col = jQuery('article .content-col');

    $dw_toc.find('h3').on('click', function() {

      var $self = jQuery(this);

      if ($self.hasClass('open')) {
        $self.addClass('closed').removeClass('open');
      } else {
        $self.addClass('open').removeClass('closed');
      }
    });

    $dw_toc.parent().on('affixed.bs.affix', function(e) {

      if ($dw_toc.find('.open').length) {
        $dw_toc.find('h3').trigger('click');
      }

    });

    $dw_toc.parent().on('affixed-top.bs.affix', function(e) {

      if ($dw_toc.find('.closed').length) {
        $dw_toc.find('h3').trigger('click');
       }

    });

    if ((jQuery(window).height() < $dw_toc.height())) {
      resizeToc();
      jQuery(window).resize(resizeToc);
    }

    // Scrolling animation
    $dw_toc.find('a').click(function(e) {

      e.preventDefault();

      var body_offset      = (parseInt(jQuery('body').css('paddingTop')) || 0),
          section_position = (jQuery(jQuery.attr(this, 'href')).offset().top - body_offset);

      jQuery('html, body').animate({
        scrollTop: section_position
      }, 600);

      return false;

    });

  }, 0);

});


// Alerts
jQuery(document).on('bootstrap3:alerts', function(e) {

  setTimeout(function() {

    // Info
    jQuery('div.info')
      .removeClass('info')
      .addClass('alert alert-info')
      .prepend('<i class="fa fa-fw fa-info-circle"/> ');

    // Error
    jQuery('div.error')
      .removeClass('error')
      .addClass('alert alert-danger')
      .prepend('<i class="fa fa-fw fa-info-circle"/> ');

    // Success
    jQuery('div.success')
      .removeClass('success')
      .addClass('alert alert-success')
      .prepend('<i class="fa fa-fw fa-check-circle"/> ');

    // Notify
    jQuery('div.notify')
      .removeClass('notify')
      .addClass('alert alert-warning')
      .prepend('<i class="fa fa-fw fa-warning"/> ');

  }, 0);

});


// Media Manager
jQuery(document).on('bootstrap3:media-manager', function(e) {

  setTimeout(function() {

    var $media_popup    = jQuery('#media__content'),     // Media Manager (pop-up)
        $media_manager  = jQuery('#mediamanager__page'); // Media Manager (page)

    // Media Manager (pop-up)
    if ($media_popup.length) {
      jQuery('.qq-upload-button').addClass('btn btn-default');
      jQuery('#mediamanager__upload_button').addClass('btn-success');
    }

    // Media Manager (page)
    if ($media_manager.length) {

      var $sort_buttons = jQuery('.ui-buttonset');

      $media_manager.find('.file dl').addClass('dl-horizontal');
      $media_manager.find('.panel').removeClass('panel').addClass('pull-left');

      $sort_buttons.addClass('btn-group');
      $sort_buttons.find('label').addClass('btn btn-xs btn-default');
      $sort_buttons.find('input').hide();

      function buttonHandler(e) {

        var $button    = jQuery(this),
            option_for = $button.attr('for'),
            option_set = option_for.replace('sortBy__', '').replace('listType__', '');

        $sort_buttons.find('.active').removeClass('active');
        $button.addClass('active');
        $sort_buttons.find('#'+ option_for).prop('checked', true);

        switch (option_set) {
          case 'thumbs':
          case 'rows':
            dw_mediamanager.set_fileview_list(option_set);
            $sort_buttons.find('[name=list_dwmedia]').val(option_set);
            break;
          case 'name':
          case 'date':
            dw_mediamanager.set_fileview_sort(option_set);
            $sort_buttons.find('[name=sort_dwmedia]').val(option_set);
            dw_mediamanager.list.call(jQuery('#dw__mediasearch')[0] || this, event);
            break;
        }

      }

      $sort_buttons.find('label').on('click', buttonHandler);

    }

  }, 0);

});


// Detail page
jQuery(document).on('bootstrap3:detail', function(e) {

  setTimeout(function() {

    var $detail_page = jQuery('#dokuwiki__detail'); // Detail Page node

    if (! $detail_page.length) return false;

    $detail_page.find('img.img_detail')
      .addClass('thumbnail img-responsive');
    $detail_page.find('dl')
      .addClass('dl-horizontal');
    $detail_page.find('.img_backto')
      .addClass('btn btn-success')
      .prepend('<i class="fa fa-fw fa-arrow-left"/> ');
    $detail_page.find('.mediaManager')
      .addClass('btn btn-default')
      .prepend('<i class="fa fa-fw fa-picture-o"/> ');

  }, 0);

});


// Search mode
jQuery(document).on('bootstrap3:mode-search', function(e) {

  setTimeout(function() {

    if (! dw_mode('search')) return false;

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

  }, 0);

});


// Administration
jQuery(document).on('bootstrap3:mode-admin', function(e) {

  setTimeout(function() {

    if (! dw_mode('admin')) return false;

    var $mode_admin = jQuery('.mode_admin');  // Admin mode node

    if (JSINFO.bootstrap3.tableFullWidth) {
      $mode_admin.find('div.table table.inline').css('width', '100%');
    }

    var $ext_manager  = $mode_admin.find('#extension__manager'),
        $ext_actions  = $ext_manager.find('.actions'),
        $user_manager = $mode_admin.find('#user__manager');

    // Extension Manager Actions
    if ($ext_actions.length) {

      $ext_actions.addClass('btn-group');

      $ext_actions.find('.permerror')
        .addClass('pull-left');

      $ext_actions.find('.btn')
        .addClass('btn-xs')
        .input2button();

      $ext_actions.find('.uninstall')
        .addClass('btn-danger')
        .prepend('<i class="fa fa-fw fa-trash"/> ');

      $ext_actions.find('.install, .update, .reinstall')
        .addClass('btn-primary')
        .prepend('<i class="fa fa-fw fa-download"/> ');

      $ext_actions.find('.enable')
        .addClass('btn-success')
        .prepend('<i class="fa fa-fw fa-check"/> ');

      $ext_actions.find('.disable').addClass('btn-warning')
        .prepend('<i class="fa fa-fw fa-ban"/> ');

    }

    // User Manager
    if ($user_manager.length) {

      $mode_admin.find('.notes').removeClass('notes');

      $mode_admin.find('h2').each(function(index, node) {

        var $node = jQuery(this);
        switch (index) {
          case 0:
            $node.prepend('<i class="fa fa-users"/> ');
            break;
          case 1:
            $node.prepend('<i class="fa fa-user-plus"/> ');
            break;
          case 2:
            if ($node.attr('id') !== 'bulk_user_import') {
              $node.prepend('<i class="fa fa-user"/> ');
            }
            break;
        }

      });

      $mode_admin.find(':button[name]').each(function(){

        var $node = jQuery(this);
        switch ($node.attr('name')) {
          case 'fn[delete]':
            $node.addClass('btn-danger');
            $node.prepend('<i class="fa fa-trash"/> ');
            break;
          case 'fn[add]':
            $node.addClass('btn-success');
            $node.prepend('<i class="fa fa-plus"/> ');
            break;
          case 'fn[modify]':
            $node.addClass('btn-success');
            $node.prepend('<i class="fa fa-save"/> ');
            break;
          case 'fn[import]':
            $node.prepend('<i class="fa fa-upload"/> ');
            break;
          case 'fn[export]':
            $node.prepend('<i class="fa fa-download"/> ');
            break;
        }

      });

    }

    // Extension Manager
    if ($ext_manager.length) {

      $ext_manager.find('form.search :submit, form.install :submit').input2button();

      $ext_manager.find('form.search button')
        .prepend('<i class="fa fa-fw fa-search"/> ');

      $ext_manager.find('form.install button')
        .prepend('<i class="fa fa-fw fa-download"/> ');

    }

  }, 0);

});


// Index Page
jQuery(document).on('bootstrap3:mode-index', function(e) {

  setTimeout(function() {

    if (! dw_mode('index')) return false;

    var $directories = jQuery('ul.idx a.idx_dir'),
        $pages       = jQuery('ul.idx a.wikilink1');

    jQuery.each($directories, function() {

      var $directory = jQuery(this),
          $closed    = $directory.parents('.closed'),
          $open      = $directory.parents('.open');

      if (! $directory.find('.fa').length) {
        $directory.prepend('<i class="fa text-primary"/> ');
      }

      if ($open.length) {
        $directory.find('i')
          .removeClass('fa-folder')
          .addClass('fa-folder-open');
      }

      if ($closed.length) {
        $directory.find('i')
          .removeClass('fa-folder-open')
          .addClass('fa-folder');
      }

    });

    jQuery.each($pages, function() {

      var $page = jQuery(this);

      if (! $page.find('i').length) {
        $page.prepend('<i class="fa fa-fw fa-file-text-o text-muted"/> ');
      }

    });

  }, 0);

});


// Page Tools
jQuery(document).on('bootstrap3:page-tools', function() {

  setTimeout(function() {

    var $page_tools_items = jQuery('#dw__pagetools ul li a');

    $page_tools_items.on('mouseenter', function () {
      var $icon = jQuery(this);
      $icon.find('i').addClass('fa-2x', 250);
    });

    $page_tools_items.on('mouseleave', function () {
      var $icon = jQuery(this);
      $icon.find('i').removeClass('fa-2x', 250);
    });

  }, 0);

});


// Dropdown-Page
jQuery(document).on('bootstrap3:dropdown-page', function() {

  jQuery('.dw__dropdown_page .dropdown').hover(function() {
    if (! jQuery('#screen_mode').find('.visible-xs').is(':visible')) {
      jQuery(this).addClass('open');
    }
  },
  function() {
    if (! jQuery('#screen_mode').find('.visible-xs').is(':visible')) {
      jQuery(this).removeClass('open');
    }
  });

});


// Cookie-Law
jQuery(document).on('bootstrap3:cookie-law', function() {
  jQuery('#cookieDismiss').click(function(){
    jQuery('#cookieNotice').hide();
    DokuCookie.setValue('cookieNoticeAccepted', true);
  });
});


// AnchorJS
jQuery(document).on('bootstrap3:anchorjs', function() {
  if (JSINFO.bootstrap3.useAnchorJS) {
    anchors.add('.mode_show article .dw-content h1, .mode_show article .dw-content h2, .mode_show article .dw-content h3, .mode_show article .dw-content h4, .mode_show article .dw-content h5');
  }
});


jQuery(document).on('bootstrap3:page-icons', function() {

  var $dw_page_icons = jQuery('.dw-page-icons');

  var title = encodeURIComponent(document.title),
      url   = encodeURIComponent(location),
      window_options = 'width=600,height=460,menubar=no,location=no,status=no';

  var share_to = {
    'google-plus' : (function(){ return [ 'https://plus.google.com/share?ur\l=', url ].join(''); })(),
    'twitter'     : (function(){ return [ 'https://twitter.com/intent/tweet?text=', title, '&url=', url ].join(''); })(),
    'linkedin'    : (function(){ return [ 'https://www.linkedin.com/shareArticle?mini=true&url=', url, '&title=', title ].join(''); })(),
    'facebook'    : (function(){ return [ 'https://www.facebook.com/sharer/sharer.php?u=', url, '&t=', title ].join(''); })(),
    'pinterest'   : (function(){ return [ 'https://pinterest.com/pin/create/button/?url=', url, '&description=', title ].join('') })(),
    'whatsapp'    : (function(){ return [ 'whatsapp://send?text=', title, ': ', url ].join(''); })(),
    'send-mail'   : (function(){ return [ 'mailto:?subject=', document.title, '&body=', document.URL ].join(''); })(),
  };

  $dw_page_icons.find('.share-google-plus').on('click', function() {
    window.open(share_to['google-plus'], 'Share to Google+', window_options);
  });
  $dw_page_icons.find('.share-twitter').on('click', function() {
    window.open(share_to.twitter, 'Share to Twitter', window_options);
  });
  $dw_page_icons.find('.share-linkedin').on('click', function() {
    window.open(share_to.linkedin, 'Share to Linkedin', window_options);
  });
  $dw_page_icons.find('.share-facebook').on('click', function() {
    window.open(share_to.facebook, 'Share to Facebook', window_options);
  });
  $dw_page_icons.find('.share-pinterest').on('click', function() {
    window.open(share_to.pinterest, 'Share to Pinterest', window_options);
  });
  $dw_page_icons.find('.send-mail').on('click', function(e) {
    e.preventDefault();
    window.location = share_to['send-mail'];
  });

  $dw_page_icons.find('.share-whatsapp').attr('href', share_to.whatsapp);

});


jQuery(document).on('bootstrap3:components', function(e) {

  setTimeout(function() {

    var events = [ 'toc', 'nav', 'tabs', 'anchorjs', 'back-to-top',
                   'buttons', 'page-tools', 'page-icons',
                   'dropdown-page', 'footnotes', 'alerts',
                   'mode-admin', 'mode-index', 'mode-search',
                   'media-manager', 'detail', 'cookie-law' ];

    for (i in events) {
      jQuery(document).trigger('bootstrap3:' + events[i]);
    }

  }, 0);

});
