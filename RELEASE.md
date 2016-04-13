# Bootstrap3 DokuWiki Template ChangeLog

## [v2016-04-13]

In this release improved the stability, speed and the user experience with new layout for **Detail page** and new icons for **Admin pages** and **3th party plugins** and new options. Added support for **Loadskin** plugin. Updated **FontAwesome** and **AnchorJS** to latest release.

### Added
  * #164: Introduced new PHP function to wrap a DokuWiki content to replace/add or adjust code/tags/classes on server-side
  * #168: Added missing button style in Media Manager (thanks to @nkukard)
  * #170: Added missing Google Analytics code in ``detail.php`` (thanks to @AlekSet)
  * #175: Added **Loadskin plugin** support
  * Added Bootstrap table style to User Import Failure table
  * Added automatic collapse of 2nd section levels in mobile devices and clean code
  * Added ``tocAffix`` (default: 1) option to disable/enable the affix of TOC
  * Added ``collapsibleSections`` (default:0) option to enable/disable 2nd section levels collapse
  * Added ``showSearchButton`` (default:0) option to enable/disable search button in navbar. Turn off to save space in navbar
  * Added ``forcewrapper=true`` in TOC to add initial ``<ul>`` tag

### Changed
  * #161: Removed RSS Feed icon color (thanks to @AlekSet and @polyzen)
  * #171: Improvements in detail.php (thanks to @AlekSet for the idea)
  * #172: Changed color of toolbar in Bootswatch Cosmo theme (thanks to @drguildo)
  * #175: Use the ``tpl_basedir()`` function instead of deprecated ``DOKU_TPL`` constant (thanks to @umbomas)
  * #177: Changed alignment and layout of form elements for mobile devices (thanks to @blacklord049 on #177)
  * New layout for ``detail.php``
  * Updated AnchorJS to v3.1.0
  * Updated FontAwesome to v4.6.0
  * Updated all translations from Transifex platform
  * Splitted plugins hacks (CSS and JS) in different files
  * Changed textarea ``font-family`` in edit mode
  * Using ``wl()`` function to build the Theme Switcher URL
  * Improvements in TOC, Admin Pages (new icons) and JS and Template engine
  * Using CSS instead of ``<i>`` tag to add icons in page, to reduce page size
  * Adding ``.mark`` class via PHP instead of JS
  * Moved ``<header>`` out of main ``<div>``

### Deprecated
  * Using ``.visible-*-block`` classes instead of deprecated ``.visible-*`` classes to detect media/device size

### Removed
  * Removed old commented code

### Fixed
  * #26: Fixed regression image alignment after moving Bootstrap CSS before the custom CSS (thanks to @duenni)
  * #154: Fixed multiple count syntax in same page (thanks to @duenni)
  * #156: Fixed IE11 issue for User and Admin menu (thanks to @blacklord049)
  * #161: Added missing Feed URL (thanks to @AlekSet)
  * #163: Added new regex pattern to fix a ``.page-header`` with ``H1-H2`` tags in sidebar (thanks to @blacklord049)
  * #166: Fixed TOC behavior with the same #ID in the article and sidebar (thanks to HanFox)
  * #174: Fixed Pagetools are behind the scrollbar on IE11 (thanks to @blacklord049)
  * #188: Fixed Media Manager popup issue on IE11 (thanks to @help53)
  * Fixed unexpected behavior for ``fluidContainer`` button and TOC
  * Fixed ScrollSpy behavior
  * Fixed unhexpected behavior in TOC for SQLite and Advanced plugin


## [v2016-02-29]

In this release improved the user experience with new icons for print, share the link (via mail and social network -- eg Google+, Fb, Twitter, WhatsApp) and new little-hook to an help page. Enjoy SEO user, with the OOTB integration with Google Analytics. Fixed some issues, reorganized and added new configurations.

### New features
  * #141: Added option to change visibility of navbar hook (thanks to @jERCle)
  * Added icons (on top of page) to Print, Send url via e-mail, Share to social network (g+, FB, Linkedin, Whatsapp, etc) and the link to Help page (``:help``) of current NS
  * New Page Info layout and configurations
  * Added Google Analytics integration

### Translations
  * Updated translation files (thanks to all translators on Transifex platform)

### Assets
  * Updated FontAwesome to v4.5.0

### Plugins
  * #149: Fixed warning message of the translation plugin (thanks to @Juergen-aus-Koeln)
  * #152: Fixed Mobile View borked when using many tags (thanks to @duenni and @hvarga)
  * #154: Tables generated with tag and csv plugin don't use Bootstrap style (thanks to @duenni)
  * Removed unnecessary code for new version of DataTables plugin
  * Fixed sidebar title headings to prevent issue with Bootstrap Wrapper plugin (thanks to @AlekSet via LotarProject/dokuwiki-plugin-bootswrapper#24 issue)

### Layout
  * #139: Added styling to ordered list (``<ol/>``), same as DokuWiki default template (thanks to @Valiantiam for the idea)
  * #145: Fixed lost styles in media details (thanks to @AlekSet)
  * #154: Fixed tables generated with Tag and CSV plugin don't use Bootstrap style (thanks to @duenni and @blacklord049
  * #157: Printing out with a lot of space (thanks to @Juergen-aus-Koeln and @Soeldner)
  * #160: Fixed theme loading in detail.php (thanks to @asmith3006 for PR)
  * Optimization to HTML5 layout
  * Added tooltip to ``<abbr/>`` element
  * Added ``<footer>`` element to ``tpl_footer.php``
  * Reorganized the position of template configurations in Configuration Manager
  * Optimization in action/tools menu
  * Added little margin on top for the first ``.page-header`` element in page
  * Display username in small device
  * Fixed a regression for TOC position in affix mode (thank to @polyzen)
  * Improvements in TOC (thanks to @polyzen)
  * Improvements in JS and Template engine


## [v2016-01-25]

### Template
  * #78: Fixed the behavior when the user scroll up and the TOC remain closed
  * #100, #105, #123: Fix for page tools visibility on mobile and fluid-container
  * #116: Deprecated ``navbar.html`` hook and added the ``useLegacyNavbar`` option (thanks to @per-hed)
  * #127: Escaped the REMOTE_USER and fullname of DokuWiki user to prevent an XSS vulnerability (thanks to @splitbrain)
  * #129: Added initial support to display the previous title of every namespace of current page on the browser title (thanks to Alekk and @polyzen)
  * #129: Added new section in Configuration manager for "Browser Title"
  * Fixed pagename in "bradcrumbs" and "you-are-here" (thanks to Jason Harris)
  * Added new option to enable/disable the collapse of all sub-sections in TOC (thanks to Jason Harris and the other people)
  * Improved the DokuWiki ``:footer`` hook and added ``.container-fluid`` class when the template is in "fluid" mode. Now the ":footer" have the same style of navbar
  * Updated and rewritten ``plugin.less``
  * Optimization to TOC, sidebars and JS engine to increase the page speed and UX
  * Added ``.page-header`` class for all H[1-6] tags in (left and right) sidebar
  * Changed ``:pageheader`` & ``:pagefooter`` visibility (thanks to @Digitalin)
  * Improvements in media manager
  * General optimization of PHP code to increase the page speed
  * New layout for Page Tools
  * ... and more!

### Assets
  * Updated Bootswatch to v3.3.6+1
  * Updated Bootstrap to v3.3.6

### Translation
  * Updated all translations from Transifex platform


## [v2015-11-23]

### Template
  * #112: white button on navbar with particular Bootswatch themes (thanks to @chtiland)
  * #114: Fixed picker not expanded in edit page (thanks to @Yuriy46)
  * #125: Fixed body font-size small being applied to all Bootswatch templates (thanks to @tysoncecka)

### Engine
  * Moved external JS (AnchorJS and Bootstrap) in DokuWiki JS dispatcher (aka /lib/exe/js.php) to reduce the number of HTTP requests
  * Moved all template configuration from TPL_CONFIG to DokuWiki JSINFO JavaScript object

### Configuration
  * #124, #118, #109 (and more...): Added a new config ('showHomePageLink' - default: 0) to enable/disable the Home-Page link in navbar

### Plugins
  * #107: Added initial support for plugin:userhomepage
  * #115: Added InlineTOC support (thanks to @coastgnu)
  * #117: Added "Recipe" option for "schemaOrgType" config (thanks to @coastgnu
  * #113: Added AnchorJS support
  * #116, #121: Fixed issues for DAVCal (thanks to @antiphasis and @kernam)
  * Removed hacks for jOrgChart, Rack and Diagram plugins

### Translation
  * Added "de" translation from Transifex (thanks to @Soeldner)
  * Updated all translation from Transifex platform


## [v2015-10-27]

In this release improved the user experience with new icons for Configuration Manager and Page Tools (for third-party plugins). Reduced the page loading and execution of JS hacks by moving the icons from JS to CSS. Now Configuration Manager, Login and Register pages have a responsive layout for small and tablet devices. Fixed some issue and added new configurations.

  * Moved all icons from JS to CSS to increase the performance during the execution of the page
  * Added more icons in Configuration Manager
  * Added responsive layout for Configuration Manager
  * Added some "font" icons for third-party plugin in Page Tools
  * Fixed "Undefined Settings" config visibility in Configuration Manager
  * Updated translations from Transifex platform (thanks for ALL translators)
  * Added "Callouts" classes for future enhancements
  * Fixed User profile dropdown menu links style (issue #83)
  * Added "tagsOnTop" configuration (default:on) for move (or not) all tags on top of the page (thanks to @chtiland on issue #95)
  * Added "showPageId" configuration (default:on) for display/hide the pageId on top of the page (thanks to @armanabraham on #99 issue)
  * Fixed namespace scroll in media manager pop-up (thanks to @chtiland on #97 issue)
  * Fixed #86 and #98 issue for Data plugin (thanks to @virk  and @miocat)
  * Fixed #101 issue for missing tooltip in Rename button from plugin:move (thanks to @polyzen)
  * Fixed issue for Bootstrap Wrapper Plugin (LotarProject/dokuwiki-plugin-bootswrapper#16). Thanks to @Shadoward
  * Fixed text above forms on login and register pages off to the right (thanks to @polyzen on #106 issue)


## [v2015-10-08]

  * Added new DokuWiki hooks:
    * ``:navbar`` and ``:dropdownpage`` for the NavBar (see #91 and #88)
    * ``:pageheader`` and ``:pagefooter`` for the wiki article and ``:footer`` of the page

      These hooks permits to create differents and personalized "navbar" (with sub-menu), "drop-down page" (eg. for an index menu or a brief descriptions), header/footer for wiki article (eg. for navitagion menu or back/forward link) and footer per namespaces (like the sidebar behavior).
  * Switched to LESS to maintain the code clean and modular. In the future i have the plan to integrate the template with Styling plugin
  * Added new choices for the ``tableStyle`` option (*bordered* and *hover*)
  * Updated Bootswatch themes to the latest release (v3.3.5+4)
  * Fixed mediafile icon in sidebar
  * Fixed the list overlaps image (thanks to @Iwasntthere on issue #55)
  * Removed unused files (LESS and SASS support) from FontAwesome directory
  * Removed empty tool from Tools Menu
  * Improvements in Administration Menu layout
  * Added translations for Administration Menu
  * Switched the Gravatar url from HTTP to HTTPS to increase the security (thanks to @MWsatwareAG on #93 and PR #94)
  * Removed the width of logo to maintain aspect ratio (thanks to @mdik on PR #92)
  * Re-implemented some DokuWiki functions to increase the client-side performance during the rendering the page (eg. for breadcrumbs and you-are-here)
  * New PHP functions
  * Initial support for *override* the some parts of template (now is disabled)
  * Updated translations from Tansifex platform (thanks for ALL translators)
  * Improvements in Cookie Law. Now the Policy button is displayed only when the DokuWiki page exists
  * ... and more

## Older releases

  * [v2015-09-18](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-09-14...v2015-09-18)
  * [v2015-09-14](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-09-13...v2015-09-14)
  * [v2015-09-13](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-09-12...v2015-09-13)
  * [v2015-09-12](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-09-07...v2015-09-12)
  * [v2015-09-07](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-09-06...v2015-09-07)
  * [v2015-09-06](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-09-04...v2015-09-06)
  * [v2015-09-04](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-08-30...v2015-09-04)
  * [v2015-08-30](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-08-27...v2015-08-30)
  * [v2015-08-27](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-08-22...v2015-08-27)
  * [v2015-08-22](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-08-20...v2015-08-22)
  * [v2015-08-20](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-08-19...v2015-08-20)
  * [v2015-08-19](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-08-12...v2015-08-19)
  * [v2015-08-12](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-08-10...v2015-08-12)
  * [v2015-08-10](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-08-03...v2015-08-10)
  * [v2015-08-03](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-08-02...v2015-08-03)
  * [v2015-08-02](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-08-01...v2015-08-02)
  * [v2015-08-01](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-07-31...v2015-08-01)
  * [v2015-07-31](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-07-30...v2015-07-31)
  * [v2015-07-30](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-07-28...v2015-07-30)
  * [v2015-07-28](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-07-22...v2015-07-28)
  * [v2015-07-22](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-07-19...v2015-07-22)
  * [v2015-07-19](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-07-17...v2015-07-19)
  * [v2015-07-17](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-07-16...v2015-07-17)
  * [v2015-07-16](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-07-15...v2015-07-16)
  * [v2015-07-15](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-07-13...v2015-07-15)
  * [v2015-07-13](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-07-08...v2015-07-13)
  * [v2015-07-08](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-07-06...v2015-07-08)
  * [v2015-07-06](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-06-17...v2015-07-06)
  * [v2015-06-17](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-06-11...v2015-06-17)
  * [v2015-06-11](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-06-05...v2015-06-11)
  * [v2015-06-05](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-05-14...v2015-06-05)
  * [v2015-05-14](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-05-13...v2015-05-14)
  * [v2015-05-13](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-05-12...v2015-05-13)
  * [v2015-05-12](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-05-08...v2015-05-12)
  * [v2015-05-08](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-05-06...v2015-05-08)
  * [v2015-05-06](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-04-27...v2015-05-06)
  * [v2015-04-27](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-04-22...v2015-04-27)
  * [v2015-04-22](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-04-20...v2015-04-22)
  * [v2015-04-20](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-04-10...v2015-04-20)
  * [v2015-04-10](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-04-09...v2015-04-10)
  * [v2015-04-09](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-04-08...v2015-04-09)
  * [v2015-04-08](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-04-07...v2015-04-08)
  * [v2015-04-07](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-04-02...v2015-04-07)
  * [v2015-04-02](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-04-01...v2015-04-02)
  * [v2015-04-01](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-03-24...v2015-04-01)
  * [v2015-03-24](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-03-22...v2015-03-24)
  * [v2015-03-22](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-03-19...v2015-03-22)
  * [v2015-03-19](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-03-18...v2015-03-19)
  * [v2015-03-18](https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-03-18...v2015-03-18)


[Develop]: https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/master...develop
[v2016-04-13]: https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2016-02-29...v2016-04-13
[v2016-02-29]: https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2016-01-25...v2016-02-29
[v2016-01-25]: https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-11-23...v2016-01-25
[v2015-11-23]: https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-10-27...v2015-11-23
[v2015-10-27]: https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-10-08...v2015-10-27
[v2015-10-08]: https://github.com/LotarProject/dokuwiki-template-bootstrap3/compare/v2015-09-18...v2015-10-08
