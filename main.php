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

$showTools         = tpl_getConf('showTools') != 'never' &&
                     ( tpl_getConf('showTools') == 'always' || !empty($_SERVER['REMOTE_USER']) );
$showSidebar       = page_findnearest($conf['sidebar']) && ($ACT=='show');
$sidebarPosition   = tpl_getConf('sidebarPosition');
$showRightSidebar  = page_findnearest(tpl_getConf('rightSidebar')) && ($ACT=='show');
$rightSidebar      = tpl_getConf('rightSidebar');
$showThemeSwitcher = tpl_getConf('showThemeSwitcher');
$fixedTopNavbar    = tpl_getConf('fixedTopNavbar');
$inverseNavbar     = tpl_getConf('inverseNavbar');
$bootstrapTheme    = tpl_getConf('bootstrapTheme');
$customTheme       = tpl_getConf('customTheme');
$bootswatchTheme   = tpl_getConf('bootswatchTheme');
$pageOnPanel       = tpl_getConf('pageOnPanel');
$bootstrapStyles   = array();
$fluidContainer    = tpl_getConf('fluidContainer');
$contentClass      = (($showSidebar) ? 'col-sm-9 col-md-10' : 'container' . (($fluidContainer) ? '-fluid' : ''));
$showPageInfo      = tpl_getConf('showPageInfo');
$showBadges        = tpl_getConf('showBadges');

$tplConfigJSON     = array(
  'tableFullWidth' => tpl_getConf('tableFullWidth'),
);

if ($showSidebar && $showRightSidebar) {
  $contentClass = 'col-sm-6 col-md-8';
}

if ($showThemeSwitcher && $bootstrapTheme == 'bootswatch') {

  if (get_doku_pref('bootswatchTheme', null) !== null && get_doku_pref('bootswatchTheme', null) !== '') {
    $bootswatchTheme = get_doku_pref('bootswatchTheme', null);
  }

  global $INPUT;
  
  if ($INPUT->str('bootswatchTheme')) {
    $bootswatchTheme = $INPUT->str('bootswatchTheme');
    set_doku_pref('bootswatchTheme', $bootswatchTheme);
  }

}

switch ($bootstrapTheme){
  case 'bootswatch':
    $bootstrapStyles[] = "https://bootswatch.com/$bootswatchTheme/bootstrap.css";
    break;
  case 'custom':
    $bootstrapStyles[] = DOKU_TPL.'assets/bootstrap/css/bootstrap.min.css';
    $bootstrapStyles[] = $customTheme;
    break;
  case 'default':
    $bootstrapStyles[] = DOKU_TPL.'assets/bootstrap/css/bootstrap.min.css';
    break;
  case 'default+optional':
  case 'default-optional':
    $bootstrapStyles[] = DOKU_TPL.'assets/bootstrap/css/bootstrap.min.css';
    $bootstrapStyles[] = DOKU_TPL.'assets/bootstrap/css/bootstrap-theme.min.css';
    break;
}

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang'] ?>"
  lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php tpl_pagetitle() ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>
    <?php foreach ($bootstrapStyles as  $bootstrapStyle): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $bootstrapStyle; ?>" />
    <?php endforeach; ?>
    <script type="text/javascript">/*<![CDATA[*/
    var TPL_CONFIG = <?php echo json_encode($tplConfigJSON); ?>;
    /*!]]>*/</script>
    <?php tpl_metaheaders() ?>
    <script type="text/javascript" src="<?php echo DOKU_TPL ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">
      body { padding-top: <?php echo (($fixedTopNavbar) ? '70' : '20'); ?>px; }
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script type="text/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<?php tpl_flush() ?>
<body class="<?php echo (($bootstrapTheme == 'bootswatch') ? $bootswatchTheme : $bootstrapTheme) . ($pageOnPanel ? ' page-on-panel' : ''); ?>">
  <!--[if lte IE 7 ]><div id="IE7"><![endif]--><!--[if IE 8 ]><div id="IE8"><![endif]-->

  <div id="dokuwiki__site" class="container<?php echo ($fluidContainer) ? '-fluid' : '' ?>">
    <div id="dokuwiki__top" class="site <?php echo tpl_classes(); ?> <?php echo ($showSidebar) ? 'hasSidebar' : ''; ?>">

      <?php tpl_includeFile('topheader.html') ?>

      <!-- header -->
      <div id="dokuwiki__header">
        <?php @require_once('tpl_navbar.php'); ?>
      </div>
      <!-- /header -->

      <?php tpl_includeFile('header.html') ?>

      <?php
        if (tpl_getConf('showTranslation')) {
          if ($translation = plugin_load('helper','translation')) {
            echo '<div class="pull-right">';
            echo $translation->showTranslations();
            echo '</div>';
            echo '<p class="clearfix">&nbsp;</p>';
          }
        }
      ?>

      <?php if ($conf['youarehere'] || $conf['breadcrumbs']): ?>
      <div id="dw__breadcrumbs">
        <hr/>
        <?php if($conf['youarehere']): ?>
        <div class="breadcrumb"><?php tpl_youarehere() ?></div>
        <?php endif; ?>
        <?php if($conf['breadcrumbs']): ?>
        <div class="breadcrumb hidden-print"><?php tpl_breadcrumbs() ?></div>
        <?php endif; ?>
        <hr/>
      </div>
      <?php endif ?>

      <p class="pageId text-right">
        <span class="label label-default"><?php echo hsc($ID) ?></span>
      </p>

      <?php html_msgarea() ?>

      <main class="main row" role="main">

        <?php if ($showSidebar && $sidebarPosition == 'left') _tpl_sidebar($conf['sidebar'], 'dokuwiki__aside', 'sidebarheader.html', 'sidebarfooter.html'); ?>

        <!-- ********** CONTENT ********** -->
        <article id="dokuwiki__content" class="<?php echo $contentClass ?>">
          <div class="<?php echo ($pageOnPanel ? 'panel panel-default' : '') ?>"> 
            <div class="page group <?php echo ($pageOnPanel ? 'panel-body' : '') ?>">
  
              <?php tpl_flush() /* flush the output buffer */ ?>
              <?php tpl_includeFile('pageheader.html') ?>
              <?php
                // render the content into buffer for later use
                ob_start();
                tpl_content(false);
                $content = ob_get_clean();
              ?>
  
              <div class="pull-right hidden-print" data-spy="affix" data-offset-top="150" style="z-index:1024; top:<?php echo (($fixedTopNavbar) ? '60' : '10'); ?>px; right:10px;">
                <?php tpl_toc()?>
              </div>
  
              <!-- wikipage start -->
              <?php echo $content; ?>
              <!-- wikipage stop -->
  
              <?php tpl_flush() ?>
              <?php tpl_includeFile('pagefooter.html') ?>

            </div>
          </div>
        </article>

        <?php
          if ($showSidebar && $sidebarPosition == 'right') {
            _tpl_sidebar($conf['sidebar'], 'dokuwiki__aside',
                         'sidebarheader.html', 'sidebarfooter.html');
          }
          if ($showSidebar && $showRightSidebar && $sidebarPosition == 'left') {
            _tpl_sidebar($rightSidebar, 'dokuwiki__rightaside',
                         'rightsidebarheader.html', 'rightsidebarfooter.html');
          }
        ?>

      </main>

      <footer id="dokuwiki__footer" class="small hidden-print">

        <a href="javascript:void(0)" class="back-to-top hidden-print btn btn-default btn-sm" title="<?php echo $lang['skip_to_content'] ?>>" id="back-to-top"><i class="glyphicon glyphicon-chevron-up"></i></a>

        <?php if ($showPageInfo): ?>
        <div class="text-right">
          <p class="docInfo">
            <?php tpl_pageinfo() /* 'Last modified' etc */ ?>
          </p>
        </div>
        <?php endif ?>
        <div class="text-center">
          <p id="dw__license">
            <?php 
              tpl_license('');
              $target = ($conf['target']['extern']) ? 'target="'.$conf['target']['extern'].'"' : '';
            ?>
          </p>
          <?php if($showBadges): ?>
          <p id="dw__badges">
            <?php tpl_license('button', true, false, false); // license button, no wrapper ?>
            <a href="http://getbootstrap.com" title="Built with Bootstrap 3" <?php echo $target?>>
              <img src="<?php echo tpl_basedir(); ?>images/button-bootstrap3.png" width="80" height="15" alt="Built with Bootstrap 3" />
            </a>
            <a href="http://www.php.net" title="Powered by PHP" <?php echo $target?>>
              <img src="<?php echo dirname(tpl_basedir()); ?>/dokuwiki/images/button-php.gif" width="80" height="15" alt="Powered by PHP" />
            </a>
            <a href="http://validator.w3.org/check/referer" title="Valid HTML5" <?php echo $target?>>
              <img src="<?php echo dirname(tpl_basedir()); ?>/dokuwiki/images/button-html5.png" width="80" height="15" alt="Valid HTML5" />
            </a>
            <a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3" title="Valid CSS" <?php echo $target?>>
              <img src="<?php echo dirname(tpl_basedir()); ?>/dokuwiki/images/button-css.png" width="80" height="15" alt="Valid CSS" />
            </a>
            <a href="http://dokuwiki.org/" title="Driven by DokuWiki" <?php echo $target?>>
              <img src="<?php echo dirname(tpl_basedir()); ?>/dokuwiki/images/button-dw.png" width="80" height="15" alt="Driven by DokuWiki" />
            </a>
          </p>
          <?php endif ?>
        </div>
      </footer>

      <?php tpl_includeFile('footer.html') ?>

    </div><!-- /site -->

    <div class="no"><?php tpl_indexerWebBug() ?></div>
    <div id="screen__mode" class="no">
      <span class="visible-xs"></span>
      <span class="visible-sm"></span>
      <span class="visible-md"></span>
      <span class="visible-lg"></span>
    </div>
  </div>
  <!--[if ( lte IE 7 | IE 8 ) ]></div><![endif]-->
</body>
</html>
