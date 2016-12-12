<?php
/**
 * DokuWiki Bootstrap3 Template
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die();                        // must be run from within DokuWiki
@require_once(dirname(__FILE__).'/tpl_functions.php');  // include hook for template functions
include_once(dirname(__FILE__).'/tpl_global.php');      // Include template global variables
header('X-UA-Compatible: IE=edge,chrome=1');
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang'] ?>"
  lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title><?php echo bootstrap3_page_browser_title() ?></title>
  <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
  <?php tpl_includeFile('meta.html') ?>
  <?php tpl_metaheaders() ?>
  <?php bootstrap3_google_analytics() ?>
  <!--[if lt IE 9]>
  <script type="text/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script type="text/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<?php tpl_flush() ?>
<body class="<?php echo bootstrap3_classes() ?>" data-page-id="<?php echo $ID ?>">

  <header id="dokuwiki__header" class="dokuwiki container<?php echo (bootstrap3_is_fluid_container()) ? '-fluid' : '' ?>">
    <?php tpl_includeFile('topheader.html') ?>
    <?php require_once('tpl_navbar.php'); ?>
    <?php tpl_includeFile('header.html') ?>
  </header>

  <div id="dokuwiki__top" class="dokuwiki container<?php echo (bootstrap3_is_fluid_container()) ? '-fluid' : '' ?>">

    <div id="dokuwiki__pageheader">

      <?php tpl_includeFile('social.html') ?>

      <?php require_once('tpl_breadcrumbs.php'); ?>

      <p class="pageId text-right small">
        <?php if(bootstrap3_conf('showPageId')): ?><span class="label label-primary"><?php echo hsc($ID) ?></span><?php endif; ?>
      </p>

      <div id="dw__msgarea" class="small">
        <?php bootstrap3_html_msgarea() ?>
      </div>

    </div>

    <main class="main row" role="main">

      <?php bootstrap3_sidebar_include('left'); // Left Sidebar ?>

      <!-- ********** CONTENT ********** -->
      <article id="dokuwiki__content" class="<?php echo bootstrap3_container_grid() ?>" <?php echo ((bootstrap3_conf('semantic')) ? sprintf('itemscope itemtype="http://schema.org/%s" itemref="dw__license"', bootstrap3_conf('schemaOrgType')) : '') ?>>

        <?php require_once('tpl_page_tools.php'); // Page Tools ?>

        <div class="<?php echo ($page_on_panel ? 'panel panel-default' : 'no-panel') ?>" <?php echo ((bootstrap3_conf('semantic')) ? 'itemprop="articleBody"' : '') ?>>
          <div class="page <?php echo ($page_on_panel ? 'panel-body' : '') ?>">

            <?php

              // Page icons (print, email, share link, etc.)
              require_once('tpl_page_icons.php');

              tpl_flush(); /* flush the output buffer */

              // Page-Header DokuWiki page
              tpl_includeFile('pageheader.html');

              // Page-Header DokuWiki page
              if ($ACT == 'show') tpl_include_page('pageheader', 1, 1, bootstrap3_conf('useACL'));

              // render the content into buffer for later use
              ob_start();
              tpl_content(false);

              $content = bootstrap3_content(ob_get_clean());
              $toc     = bootstrap3_toc(true);

              $toc_classes     = array();
              $content_classes = array();

              if (bootstrap3_conf('tocCollapsed')) $content_classes[] = 'dw-toc-closed';
              if (bootstrap3_conf('tocPosition'))  $toc_classes[]     = 'dw-toc-'. bootstrap3_conf('tocPosition');

              echo '<div class="dw-content '. implode(' ', $content_classes) .'">';

              // Include the TOC layout
              if ($toc) echo '<div class="dw-toc '. implode(' ', $toc_classes) .' hidden-print">' . $toc . '</div>';
              echo $content;
              echo '</div>';

              tpl_flush();

              // Page-Footer hook
              tpl_includeFile('pagefooter.html');

              // Page-Footer DokuWiki page
              if ($ACT == 'show') tpl_include_page('pagefooter', 1, 1, bootstrap3_conf('useACL'));

            ?>

          </div>
        </div>

      </article>

      <?php bootstrap3_sidebar_include('right'); // Right Sidebar ?>

    </main>

    <div class="small text-right">

      <?php if (bootstrap3_conf('showPageInfo')): ?>
      <span class="docInfo">
        <?php bootstrap3_pageinfo() /* 'Last modified' etc */ ?>
      </span>
      <?php endif ?>

      <?php if (bootstrap3_conf('showLoginOnFooter')): ?>
      <span class="loginLink hidden-print">
        <?php echo tpl_action('login', 1, 0, 1, '<i class="fa fa-sign-in"></i> '); ?>
      </span>
      <?php endif; ?>

    </div>

    <?php if ($conf['license']): ?>
    <div id="dw__license" class="text-center small" <?php ((bootstrap3_conf('semantic')) ? 'itemprop="license"' : '') ?>>
      <?php echo tpl_license('') ?>
    </div>
    <?php endif; ?>

    <?php
      // DokuWiki badges
      require_once('tpl_badges.php');

      // Footer hook
      tpl_includeFile('footer.html');

      // Footer DokuWiki page
      require_once('tpl_footer.php');

      // Cookie-Law banner
      require_once('tpl_cookielaw.php');

      // Provide DokuWiki housekeeping, required in all templates
      tpl_indexerWebBug();
    ?>

    <a href="#dokuwiki__top" class="back-to-top hidden-print btn btn-default btn-sm" title="<?php echo $lang['skip_to_content'] ?>" accesskey="t"><i class="fa fa-chevron-up"></i></a>

    <div id="screen__mode"><?php /* helper to detect CSS media query in script.js */ ?>
      <span class="visible-xs-block"></span>
      <span class="visible-sm-block"></span>
      <span class="visible-md-block"></span>
      <span class="visible-lg-block"></span>
    </div>

  </div>

</body>
</html>
