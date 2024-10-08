/*!
 * DokuWiki Bootstrap3 Template: Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

/* DOKUWIKI:include assets/bootstrap/js/bootstrap.min.js */
/* DOKUWIKI:include assets/anchorjs/anchor.min.js */
/* DOKUWIKI:include assets/typeahead/bootstrap3-typeahead.min.js */
/* DOKUWIKI:include assets/iconify/iconify.min.js */
/* DOKUWIKI:include assets/iconify/plugins/fa.js */

// Detect Icoonify support with Icon Plugin
if (!Iconify.getConfig('defaultAPI').match('lib/plugins/icons')) {
    Iconify.setConfig('defaultAPI', DOKU_TPL + 'iconify.php?prefix={prefix}&icons={icons}');
}

if (typeof JSINFO.bootstrap3 === 'undefined') {
    JSINFO.bootstrap3 = {
        config: {}
    };
}

if (typeof JSINFO.plugin === 'undefined') {
    JSINFO.plugin = {};
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

var dw_template = {

    init: function () {

        dw_template.common();
        dw_template.mobileLayout();
        dw_template.toc();
        dw_template.tabs();
        dw_template.tocMenu();
        dw_template.nav();
        dw_template.backToTop();
        dw_template.anchorJS();
        dw_template.pageTools();
        dw_template.pageIcons();
        dw_template.dropdownPage();
        dw_template.footnotes();
        dw_template.mediaManager();
        dw_template.collapseSections();
        dw_template.pageRestoreConfirm();
        dw_template.alerts();
        dw_template.detail();

        dw_template.menuitem();
        dw_template.cookieLaw();
        dw_template.plugins();

        // Enable Typeahead
        if (! JSINFO.bootstrap3.config.disableSearchSuggest) {
            dw_template.typeahead();
        }

        // Preload icons
        Iconify.preloadImages(['mdi:folder-open', 'mdi:folder', 'mdi:file-document-outline', 'mdi:chevron-up', 'mdi:chevron-down']);

        // Mobile Layout
        jQuery(window).resize(function () {
            dw_template.mobileLayout();
            dw_template.collapseSections();
            dw_template.tocResize();
        });

        // Re-initialize some components in media-manager
        if (dw_mode('media') || jQuery('#media__manager').length) {

            jQuery(document).ajaxSuccess(function () {
                dw_template.common();
                dw_template.buttons();
                dw_template.tabs();
                dw_template.mediaManager();
                dw_template.alerts();
            });
        }

        // Index Mode
        if (dw_mode('index')) {

            jQuery(document).ajaxSuccess(function () {
                dw_template.modeIndex();
            });

            jQuery('#index__tree').click(function (e) {
                dw_template.modeIndex();
            });

        }

        // Hash change
        if (JSINFO.bootstrap3.config.fixedTopNavbar) {

            var scrollOnHashChange = function () {
                scrollBy(0, - (parseInt(jQuery('body').css('marginTop')) || 0));
            };

            if (location.hash) {
                setTimeout(function () {
                    scrollOnHashChange();
                }, 1);
            }

            jQuery(window).on('hashchange', function () {
                scrollOnHashChange();
            });
        }

    },

    // Normalization & Basic Styling
    common: function () {

        var $dw_content = jQuery('#dokuwiki__content, #media__manager');  // Page Content node

        // Abbr tooltips
        jQuery('abbr').tooltip();

        // Search Hit
        jQuery('.search_hit').removeClass('search_hit').addClass('mark');

        // Fix accesskey issue on dropdown menu
        if (jQuery('#dw__pagetools').length) {
            jQuery('ul.dropdown-menu li a[accesskey]')
                .closest('.top, .revs, .show, .edit')
                .removeAttr('accesskey');
        }

        // Form and controls
        // TODO ported
        $dw_content.find(':submit, :button, :reset').addClass('btn btn-default');
        jQuery('input, select, textarea')
            .not('[type=submit], [type=reset], [type=button], [type=hidden], [type=image], [type=checkbox], [type=radio], [type=color]')
            .addClass('form-control');
        jQuery('input[type=checkbox]').addClass('checkbox-inline');
        jQuery('input[type=radio]').addClass('radio-inline');
        jQuery('label').addClass('control-label');
        jQuery('main form:not(.form-horizontal)').addClass('form-inline');

        // Toolbar
        jQuery('#tool__bar').addClass('btn-group');

        // Add icons
        jQuery('[data-dw-icon]').each(function () {
            var $self = jQuery(this);
            var $icon = jQuery('<span class="iconify mr-1">').attr('data-icon', $self.attr('data-dw-icon'));

            if ($self.attr('data-dw-icon-target')) {
                $self.find($self.attr('data-dw-icon-target')).prepend($icon);
            } else {
                $self.prepend($icon);
            }

        });

        // Picker
        //     if (dw_mode('edit')) {
        //       jQuery('.picker').addClass('btn-group');
        //     }

        // Footer links
        jQuery('footer a').addClass('navbar-link');

        // Personal Home-Page icon
        if (NS == 'user' && dw_mode('show') && !jQuery('.notFound').length) {
            jQuery('.mode_show #dokuwiki__content h1').prepend('<span class="iconify mr-2" data-icon="mdi:account"/> ');
        }

        // Scrolling animation (on TOC and FootNotes)
        jQuery('#dw__toc a, #dw__toc_menu a, a.fn_top, a.fn_bot').on('click', function (e) {

            var $link = jQuery(this);

            if ($link.attr('href').match(/^#/) && $link.attr('href').length > 1) {

                e.preventDefault();

                if (mediaSize('xs') && $link.hasClass('fn_top')) {
                    return false;
                }

                if (JSINFO.bootstrap3.config.tocCollapseOnScroll && JSINFO.bootstrap3.config.tocAffix) {
                    dw_template.tocClose();
                }

                var $target = jQuery('body ' + $link.attr('href'));

                if ($target.length) {

                    var body_offset = (parseInt(jQuery('body').css('marginTop')) || 0),
                        target_position = Math.round($target.offset().top - body_offset);

                    jQuery('html, body').animate({
                        scrollTop: target_position
                    }, 600);

                    document.location.hash = $link.attr('href');

                }

                return false;

            }

        });

    },

    /**
     * Customize jQuery UI with Bootstrap v3 classes
     */
    jQueryUI: function () {

        if (typeof jQuery.ui === 'undefined') return false;

        // accordion
        jQuery.ui.accordion.prototype.options.classes["ui-accordion"] = "panel panel-default";
        jQuery.ui.accordion.prototype.options.classes["ui-accordion-content"] = "panel-collapse collapse";
        jQuery.ui.accordion.prototype.options.classes["ui-accordion-content-active"] = "in";
        jQuery.ui.accordion.prototype.options.classes["ui-accordion-header"] = "panel-heading";

        // button
        jQuery.ui.button.prototype.options.classes["ui-button"] = "btn btn-default";
        jQuery.ui.button.prototype.options.classes["ui-button-icon"] = "glyphicon";

        // dialog
        jQuery.ui.dialog.prototype.options.classes["ui-dialog"] = "modal-content";
        jQuery.ui.dialog.prototype.options.classes["ui-dialog-titlebar"] = "modal-header";
        jQuery.ui.dialog.prototype.options.classes["ui-dialog-title"] = "modal-title";
        jQuery.ui.dialog.prototype.options.classes["ui-dialog-titlebar-close"] = "btn btn-default";
        jQuery.ui.dialog.prototype.options.classes["ui-dialog-content"] = "modal-body";
        jQuery.ui.dialog.prototype.options.classes["ui-dialog-buttonpane"] = "modal-footer";

        // menu
        jQuery.ui.menu.prototype.options.classes["ui-menu"] = "list-group";
        jQuery.ui.menu.prototype.options.classes["ui-menu-icons"] = "";
        jQuery.ui.menu.prototype.options.classes["ui-menu-icon"] = "glyphicon glyphicon-chevron-right";
        jQuery.ui.menu.prototype.options.classes["ui-menu-item"] = "list-group-item";
        jQuery.ui.menu.prototype.options.classes["ui-menu-divider"] = "";
        jQuery.ui.menu.prototype.options.classes["ui-menu-item-wrapper"] = "";

        // progressbar
        jQuery.ui.progressbar.prototype.options.classes["ui-progressbar"] = "progress";
        jQuery.ui.progressbar.prototype.options.classes["ui-progressbar-value"] = "progress-bar";

        // selectmenu
        jQuery.ui.selectmenu.prototype.options.classes["ui-selectmenu-button"] = "btn btn-default dropdown-toggle";
        jQuery.ui.selectmenu.prototype.options.classes["ui-selectmenu-open"] = "open";
        jQuery.ui.selectmenu.prototype.options.icons.button = "caret";
        jQuery.ui.selectmenu.prototype.options.width = "auto";

        // tabs
        jQuery.ui.tabs.prototype.options.classes["ui-tabs-nav"] = "nav nav-tabs";
        jQuery.ui.tabs.prototype.options.classes["ui-tabs-panel"] = "tab-pane";
        jQuery.ui.tabs.prototype.options.classes["ui-tabs-active"] = "active";

        // tooltip
        jQuery.ui.tooltip.prototype.options.classes["ui-tooltip"] = "tooltip top fade in";
        jQuery.ui.tooltip.prototype.options.classes["ui-tooltip-content"] = "tooltip-inner";

    },

    nav: function () {
        // Unwrap unnecessary tags inside list items for Bootstrap nav component
        jQuery('.nav div.li').contents().unwrap();

        // Move the font-icons inside a link
        jQuery('.nav li .dw-icons + a').each(function () {
            var $link = jQuery(this),
                $icon = $link.prev();
            $icon.prependTo($link);
            $icon.after(' ');
        });

    },

    tabs: function () {
        jQuery('ul.tabs').addClass('nav nav-tabs');

        jQuery('.nav-tabs strong').replaceWith(function () {

            jQuery(this).parent().addClass('active');
            return jQuery('<a href="#"/>').html(jQuery(this).contents());
        });
    },

    buttons: function () {
        // TODO ported
        jQuery('.button').removeClass('button'); // Not ported
        jQuery('.alert button').removeClass('btn btn-default');
        jQuery('#dw__login, #dw__register, #subscribe__form, #media__manager').find(':submit').addClass('btn-success');
        jQuery('#dw__profiledelete').find(':submit').addClass('btn-danger');
        jQuery('#edbtn__save').addClass('btn-success');

        // Section Button edit
        // TODO ported
        jQuery('.btn_secedit .btn').addClass('btn-xs');
    },

    backToTop: function () {
        jQuery('.back-to-top').click(function (e) {
            e.preventDefault();
            jQuery('html, body').animate({ scrollTop: 0 }, 600);
        });

        // Display back-to-top during scroll
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop()) {
                jQuery('.back-to-top').fadeIn();
            } else {
                jQuery('.back-to-top').fadeOut();
            }
        });
    },

    footnotes: function () {

        var orig_insituPopup = dw_page.insituPopup;

        dw_page.insituPopup = function (target, popup_id) {
            var $fndiv = orig_insituPopup(target, popup_id);
            $fndiv.addClass('panel panel-body panel-default');
            return $fndiv;
        }

    },

    alerts: function () {
        // Info
        jQuery('div.info')
            .removeClass('info')
            .addClass('alert alert-info')
            .prepend('<span class="iconify mr-2" data-height="18" data-icon="mdi:information"/>');

        // Error
        jQuery('div.error')
            .removeClass('error')
            .addClass('alert alert-danger')
            .prepend('<span class="iconify mr-2" data-height="18" data-icon="mdi:alert-octagon"/>');

        // Success
        jQuery('div.success')
            .removeClass('success')
            .addClass('alert alert-success')
            .prepend('<span class="iconify mr-2" data-height="18" data-icon="mdi:check-circle"/>');

        // Notify
        jQuery('div.notify')
            .removeClass('notify')
            .addClass('alert alert-warning')
            .prepend('<span class="iconify mr-2" data-height="18" data-icon="mdi:alert"/>');
    },

    cookieLaw: function () {
        jQuery('#cookieDismiss').on('click', function () {
            jQuery('#cookieNotice').hide();
            DokuCookie.setValue('cookieNoticeAccepted', 1);
        });

    },

    anchorJS: function () {

        if (!JSINFO.bootstrap3.config.useAnchorJS) return false;

        anchors.add('.mode_show article .dw-content h1, .mode_show article ' +
            '.dw-content h2, .mode_show article .dw-content h3, ' +
            '.mode_show article .dw-content h4, .mode_show article ' +
            '.dw-content h5');

    },

    dropdownPage: function () {
        jQuery('.dw__dropdown_page .dropdown').hover(function () {
            if (!jQuery('#screen_mode').find('.visible-xs').is(':visible')) {
                jQuery(this).addClass('open');
            }
        },
            function () {
                if (!jQuery('#screen_mode').find('.visible-xs').is(':visible')) {
                    jQuery(this).removeClass('open');
                }
            });
    },

    pageIcons: function () {

        var $dw_page_icons = jQuery('.dw-page-icons');

        if (!$dw_page_icons.length) return false;

        var title = encodeURIComponent(document.title),
            url = encodeURIComponent(location),
            window_options = 'width=800,height=600,menubar=no,location=no,status=no';

        var share_to = {
            'twitter': (function () { return ['https://twitter.com/intent/tweet?text=', title, '&url=', url].join(''); })(),
            'linkedin': (function () { return ['https://www.linkedin.com/shareArticle?mini=true&url=', url, '&title=', title].join(''); })(),
            'facebook': (function () { return ['https://www.facebook.com/sharer/sharer.php?u=', url, '&t=', title].join(''); })(),
            'pinterest': (function () { return ['https://pinterest.com/pin/create/button/?url=', url, '&description=', title].join(''); })(),
            'telegram': (function () { return ['https://telegram.me/share/url?url=', url].join(''); })(),
            'whatsapp': (function () { return ['https://wa.me/?text=', title, ': ', url].join(''); })(),
            'yammer': (function () { return ['https://www.yammer.com/messages/new?login=true&trk_event=yammer_share&status=', url, '#/Messages/bookmarklet'].join(''); })(),
            'sendmail': (function () { return ['mailto:?subject=', document.title, '&body=', document.URL].join(''); })(),
            'reddit': (function () { return ['https://www.reddit.com/submit?url=', url, '&title=', title].join(''); })(),
            'msteams': (function () { return ['https://teams.microsoft.com/share?href=', url, '&referrer=', location.host].join(''); })(),
        };

        $dw_page_icons.find('.share-twitter').on('click', function () {
            window.open(share_to.twitter, 'Share to Twitter', window_options);
        });

        $dw_page_icons.find('.share-linkedin').on('click', function () {
            window.open(share_to.linkedin, 'Share to Linkedin', window_options);
        });

        $dw_page_icons.find('.share-facebook').on('click', function () {
            window.open(share_to.facebook, 'Share to Facebook', window_options);
        });

        $dw_page_icons.find('.share-pinterest').on('click', function () {
            window.open(share_to.pinterest, 'Share to Pinterest', window_options);
        });

        $dw_page_icons.find('.share-telegram').on('click', function () {
            window.open(share_to.telegram, 'Share to Telegram', window_options);
        });

        $dw_page_icons.find('.share-yammer').on('click', function () {
            window.open(share_to.yammer, 'Share to Yammer', window_options);
        });

        $dw_page_icons.find('.share-reddit').on('click', function () {
            window.open(share_to.reddit, 'Share to Reddit', window_options);
        });

        $dw_page_icons.find('.sendmail').on('click', function (e) {
            e.preventDefault();
            window.location = share_to['sendmail'];
        });

        $dw_page_icons.find('.share-whatsapp').on('click', function () {
            window.open(share_to.whatsapp, 'Share to WhatsApp', window_options);
        });

        $dw_page_icons.find('.share-microsoft-teams').on('click', function () {
            window.open(share_to.msteams, 'Share to Microsoft Teams', window_options);
        });

    },

    pageTools: function () {

        if (!jQuery('#dw__pagetools').length) return false;

        // Page Tools Affix
        jQuery('#dw__pagetools .tools').affix({
            offset: {
                top: (jQuery('main').position().top),
                bottom: (jQuery(document).height()
                    - jQuery('#dokuwiki__content').height()
                    - jQuery('#dokuwiki__pageheader').height()
                    - jQuery('#dokuwiki__header').height())
            }
        });

        var $pagetools = jQuery('#dw__pagetools');

        $pagetools.find('svg').hover(

            function () {
                var $node = jQuery(this);
                $node.closest('li.active').removeClass('active');
                $node.closest('li').addClass('active');
            },

            function () {
                var $node = jQuery(this);
                $node.closest('li.active').removeClass('active');
            }
        );

    },

    collapseSections: function () {

        if (!JSINFO.bootstrap3.config.collapsibleSections) return false;

        var $sections = jQuery('article div.level2'),
            $headings = $sections.prev();

        if (mediaSize('xs')) {

            $sections.addClass('hide');

            if (!$headings.find('svg').length) {

                $headings
                    .css('cursor', 'pointer')
                    .prepend(Iconify.getSVG('mdi:chevron-down'));

                $headings.on('click', function () {

                    var $heading = jQuery(this),
                        $icon = $heading.find('svg'),
                        $section = $heading.nextUntil('h2');

                    $section.toggleClass('hide');
                    $heading.css('cursor', 'pointer');

                    $section.hasClass('hide')
                        ? $icon.replaceWith(Iconify.getSVG('mdi:chevron-down'))
                        : $icon.replaceWith(Iconify.getSVG('mdi:chevron-up'));

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

    },

    mobileLayout: function () {

        var $dw_aside = jQuery('.dw__sidebar');
        if (!$dw_aside.length) return false;

        if (mediaSize('xs')) {

            if (JSINFO.bootstrap3.config.sidebarOnNavbar) {

                if (!jQuery('header aside').length) {
                    jQuery('<aside/>').prependTo('header nav div .navbar-collapse');
                    $dw_aside.find('.dw-sidebar-content').clone().appendTo('header aside');
                    jQuery('header aside .dw-sidebar-title').addClass('navbar-text');
                }
                jQuery('header aside').show();
                $dw_aside.hide();

            } else {

                if (!$dw_aside.find('.dw-sidebar-content').hasClass('panel')) {
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

    },

    modeIndex: function () {

        if (!dw_mode('index')) return false;

        var $directories = jQuery('ul.idx a.idx_dir'),
            $pages = jQuery('ul.idx a.wikilink1');

        jQuery.each($directories, function () {

            var $directory = jQuery(this),
                $closed = $directory.parents('.closed'),
                $open = $directory.parents('.open');

            if (!$directory.find('svg').length) {
                $directory.prepend(Iconify.getSVG('mdi:folder'));
            }

            if ($open.length) {
                $directory.find('svg').replaceWith(Iconify.getSVG('mdi:folder-open'));
            }

            if ($closed.length) {
                $directory.find('svg').replaceWith(Iconify.getSVG('mdi:folder'));
            }

            $directory.find('svg').addClass('iconify text-primary mr-2');

        });

        jQuery.each($pages, function () {

            var $page = jQuery(this);

            if (!$page.find('svg').length) {
                $page.prepend(Iconify.getSVG('mdi:file-document-outline'));
            }
            $page.find('svg').addClass('text-muted mr-2');

        });

    },

    mediaManager: function () {

        var $media_popup = jQuery('#media__content'),       // Media Manager (pop-up)
            $media_manager = jQuery('#mediamanager__page'); // Media Manager (page)

        // Media Manager (pop-up)
        if ($media_popup.length || $media_manager.length) {

            jQuery('.qq-upload-button').addClass('btn btn-default');
            jQuery('.qq-upload-action').addClass('btn btn-success');

            var $btn_delete = jQuery('#mediamanager__btn_delete [type=submit]');
            var $btn_update = jQuery('#mediamanager__btn_update [type=submit]');

            if (!$btn_delete.find('span').length) {
                $btn_delete.addClass('btn btn-danger');
                $btn_delete.prepend(jQuery('<span class="iconify mr-2" data-icon="mdi:delete"/>'));
                $btn_update.prepend(jQuery('<span class="iconify mr-2" data-icon="mdi:image-plus"/>'));
            }

            jQuery('#page__revisions .sizechange').addClass('label label-primary');
            jQuery('#page__revisions .sizechange.positive').addClass('label-success');
            jQuery('#page__revisions .sizechange.negative').addClass('label-danger');

        }

        // Media Manager (page)
        if ($media_manager.length) {

            var $sort_buttons = jQuery('.ui-buttonset');

            //$media_manager.find('.file dl').addClass('dl-horizontal');
            $media_manager.find('.file dd').addClass('pl-4');
            $media_manager.find('.panel').removeClass('panel').addClass('pull-left');

            $sort_buttons.addClass('btn-group');
            $sort_buttons.find('label').addClass('btn btn-xs btn-default');
            $sort_buttons.find('input').hide();

            function buttonHandler() {

                var $button = jQuery(this),
                    option_for = $button.attr('for'),
                    option_set = option_for.replace('sortBy__', '').replace('listType__', '');

                $sort_buttons.find('.active').removeClass('active');
                $button.addClass('active');
                $sort_buttons.find('#' + option_for).prop('checked', true);

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

    },

    detail: function () {

        var $detail_page = jQuery('#dokuwiki__detail'); // Detail Page node

        if (!$detail_page.length) return false;

        $detail_page.find('img.img_detail')
            .addClass('img-responsive');
        $detail_page.find('dl')
            .addClass('dl-horizontal');

    },

    tocResize: function () {

        var $dw_toc = jQuery('#dw__toc');
        if (!$dw_toc.length) return false;

        if (JSINFO.bootstrap3.config.tocAffix) {
            $dw_toc.affix('checkPosition');
        }

        jQuery('#dw__toc .toc-body > ul').css({
            'max-height': (jQuery(window).height() - 50 - jQuery('#dokuwiki__content').position().top) + 'px',
            'overflow-y': 'scroll'
        });

        jQuery('.toc-body').width(jQuery('.dw-toc').width());

    },

    tocClose: function () {

        var $dw_toc = jQuery('#dw__toc');
        if (!$dw_toc.length) return false;

        if (!$dw_toc.hasClass('affix-bottom')) {
            jQuery('.dw-content-page').addClass('dw-toc-closed');
            $dw_toc.find('.toc-body').collapse('hide');
        }

    },

    tocOpen: function () {

        var $dw_toc = jQuery('#dw__toc');
        if (!$dw_toc.length) return false;

        jQuery('.dw-content-page').removeClass('dw-toc-closed');

        $dw_toc.find('.toc-body').collapse('show');

    },

    // Table of Contents (Navbar)
    tocMenu: function () {

        if (!jQuery("#dw__toc_menu").length) return false;

        if (jQuery(JSINFO.bootstrap3.toc).length) {
            jQuery("#dw__toc_menu").removeClass("hide");
        }

        jQuery.each(JSINFO.bootstrap3.toc, function (idx, item) {

            var indent = "";

            if (item.level > 1) {
                for (var i = 0; i <= item.level; i++) {
                    indent += "&nbsp;&nbsp;"
                }
            }

            jQuery("#dw__toc_menu ul").append(['<li><a class="small" href="', item.link, '">', indent, item.title, '</a></li>'].join(''));

        });

    },

    toc: function () {

        var $dw_toc = jQuery('#dw__toc');
        if (!$dw_toc.length) return false;

        // Set TOC Affix
        if (JSINFO.bootstrap3.config.tocAffix) {
            $dw_toc.affix({
                offset: {
                    top: (jQuery("#dokuwiki__content").position().top),
                    bottom: (jQuery(document).height() - jQuery("#dokuwiki__content").height()),
                }
            });
        }

        // ScrollSpy
        var scrollspy_target = '#dw__toc';

        if (JSINFO.bootstrap3.config.tocLayout == 'navbar') {
            scrollspy_target = '#dw__navbar_items';
        }

        jQuery('body').scrollspy({
            target: scrollspy_target,
            offset: ((parseInt(jQuery('body').css('marginTop')) || 0) + 10),
        });

        dw_template.tocResize();

        if (mediaSize('xs')) {
            dw_template.tocClose();
        }

        $dw_toc.css('backgroundColor', jQuery('article > .panel').css('backgroundColor'));
        $dw_toc.find('a').css('color', jQuery('body').css('color'));

        if (JSINFO.bootstrap3.config.tocCollapseOnScroll && JSINFO.bootstrap3.config.tocAffix) {

            $dw_toc.on('affix.bs.affix', function () {
                dw_template.tocClose();
            });

            if (!JSINFO.bootstrap3.config.tocCollapsed) {
                $dw_toc.on('affix-top.bs.affix', function () {
                    dw_template.tocOpen();
                });
            }

        }

        $dw_toc.find('.toc-title').on('click', function () {

            jQuery('.dw-content-page').toggleClass('dw-toc-closed');

            if (jQuery('.dw-toc').hasClass('dw-toc-bootstrap')) {
                if (jQuery('.dw-content-page').hasClass('dw-toc-closed')) {
                    jQuery('.dw-toc').removeClass('col-md-3');
                    jQuery('.dw-content-page').removeClass('col-md-9').addClass('col-md-12');
                } else {
                    jQuery('.dw-toc').addClass('col-md-3');
                    jQuery('.dw-content-page').removeClass('col-md-12').addClass('col-md-9');
                    dw_template.tocResize();
                }
            }

            if (!jQuery('.dw-toc-closed').length) {
                dw_template.tocResize();
            }

        });

        if ((jQuery(window).height() < $dw_toc.height())) {
            dw_template.tocResize();
        }

    },

    // Add typeahead support for quick seach
    typeahead: function () {

        jQuery("#qsearch").typeahead({

            source: function (query, process) {

                return jQuery.post(DOKU_BASE + 'lib/exe/ajax.php',
                    {
                        call: 'qsearch',
                        q: encodeURI(query)
                    },
                    function (data) {

                        var results = [];

                        jQuery(data).find('a').each(function () {

                            var page = jQuery(this);

                            results.push({
                                name: page.text(),
                                href: page.attr('href'),
                                title: page.attr('title'),
                                category: page.attr('title').replace(/:/g, ' » '),
                            });

                        });

                        return process(results);

                    });
            },

            itemLink: function (item) {
                return item.href;
            },

            itemTitle: function (item) {
                return item.title;
            },

            followLinkOnSelect: true,
            autoSelect: false,
            items: 50,
            fitToElement: true,
            delay: 500,

        });
    },

    // Replace all OOTB DokuWiki toolbar icon with Material Design Icons
    toolbarIcons: function () {

        if (typeof window.toolbar === 'undefined') return false;
        if (!JSINFO.bootstrap3.config.useAlternativeToolbarIcons) return false;

        var icons = {
            'bold.png': 'format-bold.svg',
            'chars.png': 'omega.svg',
            'h.png': 'format-header-pound.svg',
            'h1.png': 'format-header-1.svg',
            'hequal.png': 'format-header-equal.svg',
            'hminus.png': 'format-header-decrease.svg',
            'hplus.png': 'format-header-increase.svg',
            'hr.png': 'minus.svg', // ??
            'image.png': 'image.svg',
            'italic.png': 'format-italic.svg',
            'link.png': 'link.svg',
            'linkextern.png': 'link-variant.svg', // ??
            'mono.png': 'format-title.svg',
            'ol.png': 'format-list-numbered.svg',
            'sig.png': 'signature.svg',
            'smiley.png': 'emoticon-outline.svg',
            'strike.png': 'format-strikethrough.svg',
            'ul.png': 'format-list-bulleted.svg',
            'underline.png': 'format-underline.svg',

        };

        for (var i in window.toolbar) {

            // Replace all icons in "H(eaders)" picker
            if (window.toolbar[i].icon == 'h.png') {
                for (var x in window.toolbar[i].list) {
                    var hn = parseInt(x) + 1;
                    window.toolbar[i].list[x].icon = '../../tpl/bootstrap3/iconify.php?icon=mdi-format-header-' + hn + '.svg';
                }
            }

            for (var icon in icons) {
                if (window.toolbar[i].icon == icon) {
                    window.toolbar[i].icon = '../../tpl/bootstrap3/iconify.php?icon=mdi-' + icons[icon];
                }
            }

        }

    },

    // Display confirm dialog on page restore action
    pageRestoreConfirm: function () {
        jQuery('li.action a.revert').on('click',
            function () {
                return confirm(LANG.restore_confirm);
            }
        );
    },

    menuitem: function () {
        jQuery('.menuitem.help').on('click', function () {
            var $self = jQuery(this);
            jQuery('.modal.help .modal-title').html($self.attr('title'));
            jQuery('.modal.help .modal-body').load($self.data('link'));
        });
        jQuery('.menuitem.printpage').on('click', function () {
            window.print();
        });
    },


    plugins: function () {
        /* DOKUWIKI:include js/plugins/csv.js */
        /* DOKUWIKI:include js/plugins/data.js */
        /* DOKUWIKI:include js/plugins/database2.js */
        /* DOKUWIKI:include js/plugins/datatables.js */
        /* DOKUWIKI:include js/plugins/davcal.js */
        /* DOKUWIKI:include js/plugins/discussion.js */
        /* DOKUWIKI:include js/plugins/explain.js */
        /* DOKUWIKI:include js/plugins/folded.js */
        /* DOKUWIKI:include js/plugins/gallery.js */
        /* DOKUWIKI:include js/plugins/include.js */
        /* DOKUWIKI:include js/plugins/inlinetoc.js */
        /* DOKUWIKI:include js/plugins/monthcal.js */
        /* DOKUWIKI:include js/plugins/move.js */
        /* DOKUWIKI:include js/plugins/overlay.js */
        /* DOKUWIKI:include js/plugins/plantuml.js */
        /* DOKUWIKI:include js/plugins/publish.js */
        /* DOKUWIKI:include js/plugins/semantic.js */
        /* DOKUWIKI:include js/plugins/simplenavi.js */
        /* DOKUWIKI:include js/plugins/struct.js */
        /* DOKUWIKI:include js/plugins/tabbox.js */
        /* DOKUWIKI:include js/plugins/tagalerts.js */
        /* DOKUWIKI:include js/plugins/tagging.js */
        /* DOKUWIKI:include js/plugins/translation.js */
        /* DOKUWIKI:include js/plugins/wrap.js */
        /* DOKUWIKI:include js/plugins/watchcycle.js */
    },
};

dw_template.toolbarIcons();
dw_template.jQueryUI();

jQuery(dw_template.init);
