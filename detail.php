<?php
/**
 * DokuWiki Bootstrap3 Template: Image Detail Page
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Andreas Gohr <andi@splitbrain.org>
 * @author   Anika Henke <anika@selfthinker.org>
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */
header('X-UA-Compatible: IE=edge,chrome=1');

include_once(dirname(__FILE__).'/tpl_global.php'); // Include template global variables

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang']?>"
 lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
  <meta charset="UTF-8" />
  <title><?php echo hsc(tpl_img_getTag('IPTC.Headline',$IMG))?> [<?php echo strip_tags($conf['title'])?>]</title>
  <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
  <?php tpl_includeFile('meta.html') ?>
  <?php tpl_metaheaders()?>
  <!--[if lt IE 9]>
  <script type="text/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script type="text/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="container">
  <!--[if IE 8 ]><div id="IE8"><![endif]-->
  <div id="dokuwiki__detail" class="<?php echo tpl_classes(); ?>">

    <?php html_msgarea() ?>

    <?php if ($ERROR): print $ERROR; ?>
    <?php else: ?>

    <h1 class="page-header">
      <i class="fa fa-picture-o text-muted"></i> <?php echo hsc(tpl_img_getTag('IPTC.Headline', $IMG))?>
    </h1>

    <main class="row">

      <div class="col-md-8">
        <?php tpl_img(900, 700); /* the image; parameters: maximum width, maximum height (and more) */ ?>
      </div>

      <div class="col-md-4">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <i class="fa fa-picture-o"></i> <?php print nl2br(hsc(tpl_img_getTag('simple.title'))); ?>
            </h4>
          </div>
          <div class="panel-body">

            <?php
              tpl_img_meta();
               //Comment in for Debug
               //dbg(tpl_img_getTag('Simple.Raw'));
            ?>

            <hr/>

            <dl class="dl-horizontal">
              <?php
              echo '<dt>'.$lang['reference'].':</dt>';
              $media_usage = ft_mediause($IMG,true);
              if (count($media_usage) > 0){
                foreach($media_usage as $path){
                  echo '<dd>'.html_wikilink($path).'</dd>';
                }
              } else {
                echo '<dd>'.$lang['nothingfound'].'</dd>';
              }
              ?>
            </dl>

            <?php if (isset($lang['media_acl_warning'])): // This message is available from release 2015-08-10 "Detritus" ?>
            <div class="alert alert-warning">
              <i class="fa fa-warning"></i> <?php echo $lang['media_acl_warning']; ?>
            </div>
            <?php endif; ?>

          </div>
        </div>

      </div>
    </main>

    <hr/>

    <footer>

      <div class="btn-group-xs">
        <?php tpl_action('img_backto', 1) ?>
        <?php tpl_action('mediaManager', 1) ?>
      </div>

    </footer>

    <?php endif; ?>
  </div>
  <!--[if IE 8 ]></div><![endif]-->
</body>
</html>
