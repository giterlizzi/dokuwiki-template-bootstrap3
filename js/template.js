/*!
 * DokuWiki Bootstrap3 Template: Template Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */


// Normalization & Basic Styling
jQuery(document).on('bootstrap3:init', function() {

  setTimeout(function() {

    var $dw_content = jQuery('#dokuwiki__content, #media__manager');  // Page Content node

    // Move/Save .curid to anchor child
    jQuery('.curid').find('a').addClass('curid');

    // Unwrap several tags
    jQuery('bdi, span.curid').contents().unwrap();

    // a11y
    jQuery('.a11y').not('.picker').addClass('sr-only');

    // Abbr tooltips
    jQuery('abbr').tooltip();

    // Form and controls
    $dw_content.find(':submit, :button, :reset').addClass('btn btn-default');
    jQuery('input, select, textarea')
      .not('[type=submit], [type=reset], [type=button], [type=hidden], [type=image], [type=checkbox], [type=radio]')
      .addClass('form-control');
    jQuery('input[type=checkbox]').addClass('checkbox-inline');
    jQuery('input[type=radio]').addClass('radio-inline');
    jQuery('label').addClass('control-label');
    jQuery('main form:not(.form-horizontal)').addClass('form-inline');

    // Toolbar
    jQuery('#tool__bar').addClass('btn-group btn-group-xs');

    // Picker
    if (dw_mode('edit')) {
      jQuery('.picker').addClass('btn-group');
    }

    // Footer links
    jQuery('footer a').addClass('navbar-link');

    // Fix list overlap in media images
    jQuery('main ul, main ol').not('.nav, .dropdown-menu').addClass('fix-media-list-overlap');

    // Personal Home-Page icon
    if (NS == 'user' && dw_mode('show') && ! jQuery('.notFound').length) {
      jQuery('.mode_show #dokuwiki__content h1').prepend('<i class="fa fa-fw fa-user"/> ');
    }

    // Scrolling animation (on TOC and FootNotes)
    jQuery('#dw__toc a, a.fn_top, a.fn_bot').on('click', function(e) {

      var $link = jQuery(this);

      if ($link.attr('href').match(/^#/) && $link.attr('href').length > 1) {

        e.preventDefault();

        if (mediaSize('xs') && $link.hasClass('fn_top')) {
          return false;
        }

        if (JSINFO.bootstrap3.config.tocCollapseOnScroll && JSINFO.bootstrap3.config.tocAffix) {
          jQuery(document).trigger('bootstrap3:toc-close');
        }

        var $target = jQuery('body ' + $link.attr('href'));

        if ($target.length) {

          var body_offset      = (parseInt(jQuery('body').css('paddingTop')) || 0),
              target_position  = Math.round($target.offset().top - body_offset);

          jQuery('html, body').animate({
            scrollTop: target_position
          }, 600);

          document.location.hash = $link.attr('href');

        }

        return false;

      }

    });

  }, 0);

});


// Nav
jQuery(document).on('bootstrap3:nav', function() {

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
jQuery(document).on('bootstrap3:tabs', function() {

  setTimeout(function() {

    jQuery('ul.tabs').addClass('nav nav-tabs');

    jQuery('.nav-tabs strong').replaceWith(function() {

      jQuery(this).parent().addClass('active');
      return jQuery('<a href="#"/>').html(jQuery(this).contents());

    });

  }, 0);

});


// Buttons
jQuery(document).on('bootstrap3:buttons', function() {

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
jQuery(document).on('bootstrap3:back-to-top', function() {

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
jQuery(document).on('bootstrap3:footnotes', function() {

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


jQuery(document).on('bootstrap3:toc-resize', function() {

  var $dw_toc = jQuery('#dw__toc');
  if (! $dw_toc.length) return false;

  if (JSINFO.bootstrap3.config.tocAffix) {
    $dw_toc.affix('checkPosition');
  }

  jQuery('#dw__toc .toc-body > ul').css({
    'max-height' : (jQuery(window).height() - 50 - jQuery('main').position().top) + 'px',
    'overflow-y' : 'scroll'
  });

  jQuery('.toc-body').width(jQuery('.dw-toc').width());

});


jQuery(document).on('bootstrap3:toc-close', function() {

  var $dw_toc = jQuery('#dw__toc');
  if (! $dw_toc.length) return false;

  if (! $dw_toc.hasClass('affix-bottom')) {
    jQuery('article .dw-content').addClass('dw-toc-closed');
    $dw_toc.find('.toc-body').collapse('hide');
  }

});


jQuery(document).on('bootstrap3:toc-open', function() {

  var $dw_toc = jQuery('#dw__toc');
  if (! $dw_toc.length) return false;

  jQuery('article .dw-content').removeClass('dw-toc-closed');

  $dw_toc.find('.toc-body').collapse('show');

});


// Table of Contents
jQuery(document).on('bootstrap3:toc', function() {

  setTimeout(function() {

    var $dw_toc = jQuery('#dw__toc');
    if (! $dw_toc.length) return false;

    jQuery(document).trigger('bootstrap3:toc-resize');

    $dw_toc.css('backgroundColor', jQuery('article > .panel').css('backgroundColor'));
    $dw_toc.find('a').css('color', jQuery('body').css('color'));

    if (JSINFO.bootstrap3.config.tocCollapseOnScroll && JSINFO.bootstrap3.config.tocAffix) {

      $dw_toc.on('affix.bs.affix', function() {
        jQuery(document).trigger('bootstrap3:toc-close');
      });

      if (! JSINFO.bootstrap3.config.tocCollapsed) {
        $dw_toc.on('affix-top.bs.affix', function() {
          jQuery(document).trigger('bootstrap3:toc-open');
        });
      }

    }

    $dw_toc.find('.toc-title').on('click', function() {

      var $self = jQuery(this);

      jQuery('article .dw-content').toggleClass('dw-toc-closed');

      if (! jQuery('.dw-toc-closed').length) {
        jQuery(document).trigger('bootstrap3:toc-resize');
      }

    });

    if ((jQuery(window).height() < $dw_toc.height())) {
      jQuery(document).trigger('bootstrap3:toc-resize');
    }

  }, 0);

});


// Alerts
jQuery(document).on('bootstrap3:alerts', function() {

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
      .prepend('<i class="fa fa-fw fa-times-circle"/> ');

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
jQuery(document).on('bootstrap3:media-manager', function() {

  setTimeout(function() {

    var $media_popup    = jQuery('#media__content'),     // Media Manager (pop-up)
        $media_manager  = jQuery('#mediamanager__page'); // Media Manager (page)

    // Media Manager (pop-up)
    if ($media_popup.length || $media_manager.length) {
      jQuery('.qq-upload-button').addClass('btn btn-default');
      jQuery('.qq-upload-action').addClass('btn btn-success');
    }

    // Media Manager (page)
    if ($media_manager.length) {

      var $sort_buttons = jQuery('.ui-buttonset');

      $media_manager.find('.file dl').addClass('dl-horizontal');
      $media_manager.find('.panel').removeClass('panel').addClass('pull-left');

      $sort_buttons.addClass('btn-group');
      $sort_buttons.find('label').addClass('btn btn-xs btn-default');
      $sort_buttons.find('input').hide();

      function buttonHandler() {

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
jQuery(document).on('bootstrap3:detail', function() {

  setTimeout(function() {

    var $detail_page = jQuery('#dokuwiki__detail'); // Detail Page node

    if (! $detail_page.length) return false;

    $detail_page.find('img.img_detail')
      .addClass('img-responsive');
    $detail_page.find('dl')
      .addClass('dl-horizontal');

  }, 0);

});


// Search mode
jQuery(document).on('bootstrap3:mode-search', function() {

  setTimeout(function() {

    if (! dw_mode('search')) return false;

    jQuery('.search_results dt')
      .contents()
      .filter(function() {
        return this.nodeType === 3;
      })
      .wrap('<span class="label label-primary"/>');

      jQuery('.search_results .label').before('&nbsp;&nbsp;&nbsp;');

      jQuery('.search_results .label').each(function() {
        var $node = jQuery(this);
        $node.html($node.html().replace(/^\: /, ''));
      });

  }, 0);

});


// Administration
jQuery(document).on('bootstrap3:mode-admin', function() {

  setTimeout(function() {

    if (! dw_mode('admin')) return false;

    var $mode_admin = jQuery('.mode_admin');  // Admin mode node

    // Set specific icon in Admin Page
    if (JSINFO.bootstrap3.admin) {
      jQuery('article h1').first().addClass(JSINFO.bootstrap3.admin);
    }

    var $ext_manager  = $mode_admin.find('#extension__manager'),
        $ext_actions  = $ext_manager.find('.actions'),
        $user_manager = $mode_admin.find('#user__manager'),
        $admin_tasks  = $mode_admin.find('ul.admin_tasks');

    var admin_tasks = {
      // Task         Icon
      'usermanager' : 'users',
      'acl'         : 'key',
      'extension'   : 'puzzle-piece',
      'plugin'      : 'puzzle-piece',
      'config'      : 'cogs',
      'styling'     : 'paint-brush',
      'revert'      : 'refresh',
      'popularity'  : 'envelope',
    };

    // Admin Task icon
    $admin_tasks.addClass('list-group');
    $admin_tasks.find('a').addClass('list-group-item');

    for (var i in admin_tasks) {
      $admin_tasks.find('li.admin_' + i + ' a')
        .prepend(jQuery('<i class="fa fa-' + admin_tasks[i] + ' fa-fw fa-pull-left" />'));
    }

    // DokuWiki logo
    jQuery('#admin__version').prepend('<img src="'+ DOKU_BASE +'lib/tpl/dokuwiki/images/logo.png" class="pull-left" /> ');

    // Extension Manager Actions
    if (dw_admin('extension')) {

      $ext_actions.addClass('btn-group');

      $ext_actions.find('.permerror')
        .addClass('pull-left');

      $ext_actions.find('.btn')
        .addClass('btn-xs')
        .input2button();

      $ext_actions.find('.uninstall').addClass('btn-danger');
      $ext_actions.find('.install, .update, .reinstall').addClass('btn-primary');
      $ext_actions.find('.enable').addClass('btn-success');
      $ext_actions.find('.disable').addClass('btn-warning');

      $ext_manager.find('form.search :submit, form.install :submit').input2button();
      $ext_manager.find('form.search button, form.install button').addClass('btn-success');

    }

    // User Manager
    if (dw_admin('usermanager')) {

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

  }, 0);

});


// Index Page
jQuery(document).on('bootstrap3:mode-index', function() {

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


// Page Tools (animaton)
jQuery(document).on('bootstrap3:page-tools', function() {

  // Page Tools Affix
  jQuery('#dw__pagetools .tools').affix({
    offset : {
      top    : (jQuery('main').position().top),
      bottom : ((   jQuery(document).height()
                  - jQuery('article').height()
                  - jQuery('#dokuwiki__pageheader').height()
                  - jQuery('#dokuwiki__header').height() ))
    }
  });

  var $page_tools       = jQuery('#dw__pagetools'),
      $page_tools_items = $page_tools.find('ul li a'),
      $animation        = $page_tools.find('.tools-animation');

  if (! ($page_tools_items.length && $animation.length)) return false;

  $page_tools_items.on('mouseenter', function () {
    var $icon = jQuery(this);
    $icon.find('i').addClass('fa-2x', 250);
  });

  $page_tools_items.on('mouseleave', function () {
    var $icon = jQuery(this);
    $icon.find('i').removeClass('fa-2x', 250);
  });

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
  anchors.add('.mode_show article .dw-content h1, .mode_show article .dw-content h2, .mode_show article .dw-content h3, .mode_show article .dw-content h4, .mode_show article .dw-content h5');
});


// Page icons
jQuery(document).on('bootstrap3:page-icons', function() {

  var $dw_page_icons = jQuery('.dw-page-icons');

  if (! $dw_page_icons.length) return false;

  var title = encodeURIComponent(document.title),
      url   = encodeURIComponent(location),
      window_options = 'width=600,height=460,menubar=no,location=no,status=no';

  var share_to = {
    'google-plus' : (function(){ return [ 'https://plus.google.com/share?ur\l=', url ].join(''); })(),
    'twitter'     : (function(){ return [ 'https://twitter.com/intent/tweet?text=', title, '&url=', url ].join(''); })(),
    'linkedin'    : (function(){ return [ 'https://www.linkedin.com/shareArticle?mini=true&url=', url, '&title=', title ].join(''); })(),
    'facebook'    : (function(){ return [ 'https://www.facebook.com/sharer/sharer.php?u=', url, '&t=', title ].join(''); })(),
    'pinterest'   : (function(){ return [ 'https://pinterest.com/pin/create/button/?url=', url, '&description=', title ].join(''); })(),
    'telegram'    : (function(){ return [ 'https://telegram.me/share/url?url=', url ].join(''); })(),
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
  $dw_page_icons.find('.share-telegram').on('click', function() {
    window.open(share_to.telegram, 'Share to Telegram', window_options);
  });
  $dw_page_icons.find('.send-mail').on('click', function(e) {
    e.preventDefault();
    window.location = share_to['send-mail'];
  });

  $dw_page_icons.find('.share-whatsapp').attr('href', share_to.whatsapp);

});


// Collapse sections on mobile (XS media)
jQuery(document).on('bootstrap3:collapse-sections', function() {

  setTimeout(function() {

  if (! JSINFO.bootstrap3.config.collapsibleSections) return false;

  var $sections = jQuery('article div.level2'),
      $headings = $sections.prev();

  if (mediaSize('xs')) {

    $sections.addClass('hide');

    if (! $headings.find('i').length) {

      $headings
        .css('cursor', 'pointer')
        .prepend(jQuery('<i class="fa fa-fw fa-chevron-down fa-pull-left" style="font-size:12px; padding:10px 0"/>'));

      $headings.on('click', function() {

        var $heading = jQuery(this),
            $icon    = $heading.find('i'),
            $section = $heading.nextUntil('h2');

        $section.toggleClass('hide');
        $heading.css('cursor', 'pointer');

        $icon.hasClass('fa-chevron-down')
          ? $icon.removeClass('fa-chevron-down').addClass('fa-chevron-up')
          : $icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');

      });

      if (mediaSize('xs')) {
        $headings.trigger('click');
      }

    }

  } else {
    if ($sections.hasClass('hide')) {
      $sections.removeClass('hide');
    }
  }

  }, 0);

});


// Mobile Layout
jQuery(document).on('bootstrap3:mobile-layout', function() {

  setTimeout(function() {

    var $dw_aside = jQuery('.dw__sidebar');
    if (! $dw_aside.length) return false;

    if (mediaSize('xs')) {

      if (JSINFO.bootstrap3.config.sidebarOnNavbar) {

        if (! jQuery('header aside').length) {
          jQuery('<aside/>').prependTo('header nav div .navbar-collapse');
          $dw_aside.find('.dw-sidebar-content').clone().appendTo('header aside');
          jQuery('header aside .dw-sidebar-title').addClass('navbar-text');
        }
        jQuery('header aside').show();
        $dw_aside.hide();

      } else {

        if (! $dw_aside.find('.dw-sidebar-content').hasClass('panel')) {
          $dw_aside.find('.dw-sidebar-content').addClass('panel panel-default');
          $dw_aside.find('.dw-sidebar-title').addClass('panel-heading');
          $dw_aside.find('.dw-sidebar-body').addClass('panel-body').removeClass('in');
        }

      }

    } else {

      jQuery('header aside').hide();
      $dw_aside.find('.dw-sidebar-content').removeClass('panel panel-default');
      $dw_aside.find('.dw-sidebar-title').removeClass('panel-heading');
      $dw_aside.find('.dw-sidebar-body').removeClass('panel-body').addClass('in');
      $dw_aside.show();
    }

  }, 0);

});


jQuery(document).on('bootstrap3:components', function() {

  setTimeout(function() {

    var events = [  'mobile-layout', 'toc', 'nav', 'tabs',
                    'back-to-top', 'buttons', 'page-tools', 'page-icons',
                    'dropdown-page', 'footnotes', 'media-manager',
                    'collapse-sections' ];

    for (var i in events) {
      jQuery(document).trigger('bootstrap3:' + events[i]);
    }

  }, 0);

});
