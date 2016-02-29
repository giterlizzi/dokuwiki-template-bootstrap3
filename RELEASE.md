# Bootstrap3 DokuWiki Template
## What's new in v2016-02-29 release

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

For more information of new functionality see https://www.dokuwiki.org/template:bootstrap3 page.
