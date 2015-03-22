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

$showTools         = !tpl_getConf('hideTools') || ( tpl_getConf('hideTools') && !empty($_SERVER['REMOTE_USER']) );
$showSidebar       = page_findnearest($conf['sidebar']) && ($ACT=='show');
$showThemeSwitcher = tpl_getConf('showThemeSwitcher');
$fixedTopNavbar    = tpl_getConf('fixedTopNavbar');
$inverseNavbar     = tpl_getConf('inverseNavbar');
$bootstrapTheme    = tpl_getConf('bootstrapTheme');
$customTheme       = tpl_getConf('customTheme');
$bootswatchTheme   = tpl_getConf('bootswatchTheme');
$bootstrapStyles   = array();

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
    <?php tpl_metaheaders() ?>
    <script src="<?php echo DOKU_TPL ?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">
      body { padding-top: <?php echo (($fixedTopNavbar) ? '70' : '20'); ?>px; }
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<?php tpl_flush() ?>
<body class="<?php echo $bootswatchTheme; ?>">
  <!--[if lte IE 7 ]><div id="IE7"><![endif]--><!--[if IE 8 ]><div id="IE8"><![endif]-->

  <div id="dokuwiki__site" class="container">
    <div id="dokuwiki__top" class="site <?php echo tpl_classes(); ?> <?php echo ($showSidebar) ? 'hasSidebar' : ''; ?>">

      <?php tpl_includeFile('header.html') ?>

      <!-- header -->
      <div id="dokuwiki__header">

        <nav class="navbar <?php echo (($fixedTopNavbar) ? 'navbar-fixed-top' : '') ?> <?php echo (($inverseNavbar) ? 'navbar-inverse' : 'navbar-default') ?>" role="navigation">
          <div class="container-fluid">
            <div class="navbar-header">
              <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <?php
                // get logo either out of the template images folder or data/media folder
                $logoSize = array();
                $logo = tpl_getMediaFile(array(':wiki:logo.png', ':logo.png', 'images/logo.png'), false, $logoSize);

                // display logo and wiki title in a link to the home page
                // '.$logoSize[3].'
                tpl_link(
                    wl(),
                    '<img src="'.$logo.'" alt="'.$conf['title'].'" width="20" height="20" class="pull-left" style="margin-right:10px" /> <span>'.$conf['title'].'</span>',
                    'accesskey="h" title="[H]" class="navbar-brand"'
                );
              ?>
            </div>

            <div class="collapse navbar-collapse">

              <?php if ($conf['tagline']): ?>
              <p class="navbar-text"><?php  $conf['tagline'] ?></p>
              <?php endif ?>

              <ul class="nav navbar-nav">
              <?php tpl_includeFile('navbar.html') ?>
              </ul>

              <div class="navbar-right">

                <?php tpl_searchform() ?>

                <ul class="nav navbar-nav">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title=""><i class="glyphicon glyphicon-wrench"></i> <?php echo $lang['tools']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu tools" role="menu">
                      <!-- dokuwiki__usertools -->
                      <li class="dropdown-header"><i class="glyphicon glyphicon-user"></i> <?php echo $lang['user_tools'] ?></li>
                      <?php _tpl_toolsevent('usertools', array(
                        'admin' => tpl_action('admin', 1, 'li' . (($ACT == 'admin') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-cog"></i> '),
                        'profile' => tpl_action('profile', 1, 'li' . (($ACT == 'profile') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-refresh"></i> '),
                        'register' => tpl_action('register', 1, 'li' . (($ACT == 'register') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-edit"></i> '),
                        'login' => tpl_action('login', 1, 'li' . (($ACT == 'login') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-log-out"></i> '),
                      )); ?>
                      <li class="divider"></li>
                      <!-- dokuwiki__sitetools -->
                      <li class="dropdown-header"><i class="glyphicon glyphicon-cog"></i> <?php echo $lang['site_tools'] ?></li>
                      <?php _tpl_toolsevent('sitetools', array(
                        'recent' => tpl_action('recent', 1, 'li' . (($ACT == 'recent') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-list-alt"></i> '),
                        'media' => tpl_action('media', 1, 'li' . (($ACT == 'media') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-download-alt"></i> '),
                        'index' => tpl_action('index', 1, 'li' . (($ACT == 'index') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-list"></i> '),
                      )); ?>
                      <li class="divider"></li>
                      <!-- dokuwiki__pagetools -->
                      <li class="dropdown-header"><i class="glyphicon glyphicon-file"></i> <?php echo $lang['page_tools'] ?></li>
                      <?php _tpl_toolsevent('pagetools', array(
                        'edit' => tpl_action('edit', 1, 'li' . (($ACT == 'edit') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-edit"></i> '),
                        'revert' => tpl_action('revert', 1, 'li' . (($ACT == 'revert') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-repeat"></i> '),
                        'revisions' => tpl_action('revisions', 1, 'li' . (($ACT == 'revisions') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-time"></i> '),
                        'backlink' => tpl_action('backlink', 1, 'li' . (($ACT == 'backlink') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-link"></i> '),
                        'subscribe' => tpl_action('subscribe', 1, 'li' . (($ACT == 'subscribe') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-bookmark"></i> '),
                        'top' => tpl_action('top', 1, 'li' . (($ACT == 'top') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-chevron-up"></i> '),
                      )); ?>
                    </ul>
                  </li>
                </ul>

                <?php if ($showThemeSwitcher && $bootstrapTheme == 'bootswatch'): ?>
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Themes <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="themes">
                      <?php foreach (array('cerulean','cosmo','cyborg','darkly','flatly','journal','lumen','paper','readable','sandstone','simplex','slate','spacelab','superhero','united','yeti') as $theme): ?>
                      <li<?php echo ($bootswatchTheme == $theme) ? ' class="active"' : '' ?>><a href="?bootswatchTheme=<?php echo $theme ?>"><?php echo ucfirst($theme) ?></a></li>
                      <?php endforeach; ?>
                    </ul>
                  </li>
                </ul>
                <?php endif; ?>

                <ul class="nav navbar-nav">
                  <li>
                    <?php if (!empty($_SERVER['REMOTE_USER'])) {
                      tpl_link(wl('user:'.$_SERVER['REMOTE_USER']), '<i class="glyphicon glyphicon-user"></i><span class="hidden-lg hidden-md hidden-sm"> '. userlink(null, true) . '</span>', 'title="'.userlink(null, true).'"'); /* 'Logged in as ...' */
                    } ?>
                  </li>
                  <li>
                    <?php echo tpl_action('login', 1, '', 1, '<i class="glyphicon glyphicon-log-'. (!empty($_SERVER['REMOTE_USER']) ? 'out' : 'in') .'"></i> ') ?>
                  </li>
                </ul>

              </div>

            </div>
          </div>
        </nav>
      </div><!-- /header -->

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

      <?php html_msgarea() ?>

      <div class="main row" role="main">

      <?php if ($showSidebar): ?>
        <!-- ********** ASIDE ********** -->
        <div id="dokuwiki__aside" class="col-sm-3 col-md-2">
          <div class="content">
            <div class="toogle hidden-print hidden-lg hidden-md" data-toggle="collapse" data-target="#dokuwiki__aside .collapse">
              <i class="glyphicon glyphicon-th-list"></i> <?php echo $lang['sidebar'] ?>
            </div>
            <div class="collapse in">
              <?php tpl_includeFile('sidebarheader.html') ?>
              <?php tpl_include_page($conf['sidebar'], 1, 1) /* includes the nearest sidebar page */ ?>
              <?php tpl_includeFile('sidebarfooter.html') ?>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- ********** CONTENT ********** -->
      <div id="dokuwiki__content" class="<?php echo (($showSidebar) ? 'col-sm-9 col-md-10' : 'container') ?>">
          <div class="panel panel-default"> 
            <div class="page group panel-body">
              <div class="pageId text-right hide"><span><?php echo hsc($ID) ?></span></div>

              <?php tpl_flush() /* flush the output buffer */ ?>
              <?php tpl_includeFile('pageheader.html') ?>

              <?php
                  // render the content into buffer for later use
                  ob_start();
                  tpl_content(false);
                  $content = ob_get_clean();
              ?>

                <div class="pull-right hidden-print" data-spy="affix" data-offset-top="150" style="top:<?php echo (($fixedTopNavbar) ? '60' : '10'); ?>px; right: 10px;">
                  <?php tpl_toc()?>
                </div>
  
                <!-- wikipage start -->
                <?php echo $content; ?>
                <!-- wikipage stop -->
  
              <?php tpl_flush() ?>
              <?php tpl_includeFile('pagefooter.html') ?>

            </div>
          </div>
        </div>
      </div>

      <footer id="dokuwiki__footer" class="small hidden-print">

        <a style="position: fixed; bottom: 10px; right: 10px; opacity: .8" href="javascript:void(0)" class="hidden-print btn btn-default btn-sm" onclick="jQuery('html, body').animate({ scrollTop: 0 }, 600);" title="<?php echo $lang['skip_to_content'] ?>>" id="back-to-top"><i class="glyphicon glyphicon-chevron-up"></i></a>

        <div class="text-right">
          <p class="docInfo">
            <?php tpl_pageinfo() /* 'Last modified' etc */ ?>
          </p>
        </div>
        <div class="text-center">
          <?php 
            tpl_license('');
            $target = ($conf['target']['extern']) ? 'target="'.$conf['target']['extern'].'"' : '';
          ?>
          <p>
            <?php tpl_license('button', true, false, false); // license button, no wrapper ?>
            <!--
            <a href="http://getbootstrap.com" title="Built with Bootstrap 3" <?php echo $target?>>
              <img src="images/button-bootstrap3.png" width="80" height="15" alt="Built with Bootstrap 3" />
            </a>
            -->
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
