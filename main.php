<?php
/**
 * DokuWiki Bootstrap3 Template
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */
header('X-UA-Compatible: IE=edge,chrome=1');

include_once(dirname(__FILE__).'/tpl_global.php'); // Include template global variables

// Get the template info (useful for debug)
if ($INFO['isadmin'] && isset($_GET['do']) && $_GET['do'] == 'check') {
  $template_info = confToHash(dirname(__FILE__).'/template.info.txt');
  msg('bootstrap3 template version: v' . $template_info['date'], 1, '', '', MSG_ADMINS_ONLY);
}

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
  <?php foreach ($bootstrap_styles as  $bootstrap_style): ?>
  <link type="text/css" rel="stylesheet" href="<?php echo $bootstrap_style; ?>" />
  <?php endforeach; ?>
  <link type="text/css" rel="stylesheet" href="<?php echo DOKU_TPL ?>assets/font-awesome/css/font-awesome.min.css" />
  <?php tpl_metaheaders() ?>
  <style type="text/css">
    body { padding-top: <?php echo $navbar_padding ?>px; }
    <?php if (bootstrap3_conf('tocCollapseSubSections')): ?>
    #dokuwiki__toc .nav .nav .nav { display: none; }
    <?php endif; ?>
    .dw-toc-affix { top: <?php echo ($navbar_padding -10) ?>px; }
  </style>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script type="text/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script type="text/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <?php if ($fixedTopNavbar): ?>
  <script type="text/javascript">/*<![CDATA[*/
    jQuery(document).ready(function() {
      if (location.hash) {
        setTimeout(function() {
          scrollBy(0, -<?php echo $navbar_padding ?>);
        }, 1);
      }
    });
  /*!]]>*/</script>
  <?php endif; ?>
</head>
<?php tpl_flush() ?>
<body class="<?php echo trim(implode(' ', $body_classes)) ?>" data-spy="scroll" data-target="#dokuwiki__toc" data-offset="<?php echo $navbar_padding ?>">
  <!--[if IE 8 ]><div id="IE8"><![endif]-->
  <div id="dokuwiki__top" class="<?php echo tpl_classes(); ?> container<?php echo (bootstrap3_is_fluid_container()) ? '-fluid' : '' ?>">

    <header id="dokuwiki__header">
      <?php tpl_includeFile('topheader.html') ?>
      <?php require_once('tpl_navbar.php'); ?>
      <?php tpl_includeFile('header.html') ?>
    </header>

    <?php tpl_includeFile('social.html') ?>

    <?php require_once('tpl_breadcrumbs.php'); ?>

    <p class="pageId text-right">
      <?php if(bootstrap3_conf('showPageId')): ?><span class="label label-primary"><?php echo hsc($ID) ?></span><?php endif; ?>
    </p>

    <div id="dw__msgarea">
      <?php bootstrap3_html_msgarea() ?>
    </div>

    <main class="main row" role="main">

      <?php bootstrap3_sidebar_include('left') ?>

      <!-- ********** CONTENT ********** -->
      <article id="dokuwiki__content" class="<?php echo bootstrap3_container_grid() ?>" <?php echo ((bootstrap3_conf('semantic')) ? sprintf('itemscope itemtype="http://schema.org/%s" itemref="dw__license"', bootstrap3_conf('schemaOrgType')) : '') ?>>

        <div class="<?php echo ($pageOnPanel ? 'panel panel-default' : 'no-panel') ?>" <?php echo ((bootstrap3_conf('semantic')) ? 'itemprop="articleBody"' : '') ?>>
          <div class="page <?php echo ($pageOnPanel ? 'panel-body' : '') ?>">

            <?php

              // Page icons (print, email, share link, etc.)
              require_once('tpl_page_icons.php');

              tpl_flush(); /* flush the output buffer */

              // Page-Header DokuWiki page
              tpl_includeFile('pageheader.html');

              // Page-Header DokuWiki page
              if ($ACT == 'show') tpl_include_page('pageheader', 1, 1);

              // render the content into buffer for later use
              ob_start();
              tpl_content(false);

              $content = ob_get_clean();
              $toc     = bootstrap3_toc(true);

              $content = '<div class="dw-content">' . $content . '</div>';

              // Include Page Tools
              require_once('tpl_page_tools.php');

              // Include the TOC layout
              if ($toc) {
                require_once('tpl_toc.php');
              }

              echo $content;

              tpl_flush();

              // Page-Footer hook
              tpl_includeFile('pagefooter.html');

              // Page-Footer DokuWiki page
              if ($ACT == 'show') tpl_include_page('pagefooter', 1, 1);

            ?>

          </div>
        </div>

      </article>

      <?php bootstrap3_sidebar_include('right') ?>

    </main>

    <div class="small text-right">

      <?php if (bootstrap3_conf('showPageInfo')): ?>
      <span class="docInfo text-muted">
        <?php tpl_pageinfo() /* 'Last modified' etc */ ?>
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
      <span class="visible-xs"></span>
      <span class="visible-sm"></span>
      <span class="visible-md"></span>
      <span class="visible-lg"></span>
    </div>

  </div>

  <!--[if lte IE 8 ]></div><![endif]-->
</body>
</html>
