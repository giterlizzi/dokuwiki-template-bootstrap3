<?php
/**
 * DokuWiki Image Detail Page
 *
 * @author   Andreas Gohr <andi@splitbrain.org>
 * @author   Anika Henke <anika@selfthinker.org>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */
header('X-UA-Compatible: IE=edge,chrome=1');

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang']?>"
 lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="UTF-8" />
    <title>
        <?php echo hsc(tpl_img_getTag('IPTC.Headline',$IMG))?>
        [<?php echo strip_tags($conf['title'])?>]
    </title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <?php tpl_metaheaders()?>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>
</head>

<body>
    <!--[if lte IE 7 ]><div id="IE7"><![endif]--><!--[if IE 8 ]><div id="IE8"><![endif]-->
    <div id="dokuwiki__detail" class="<?php echo tpl_classes(); ?>">
        <?php html_msgarea() ?>

        <?php if($ERROR): print $ERROR; ?>
        <?php else: ?>

            <h1><?php echo hsc(tpl_img_getTag('IPTC.Headline', $IMG))?></h1>

            <div class="content">
                <?php tpl_img(900, 700); /* the image; parameters: maximum width, maximum height (and more) */ ?>

                <div class="img_detail">
                    <h2><?php print nl2br(hsc(tpl_img_getTag('simple.title'))); ?></h2>

                    <?php tpl_img_meta(); ?>
                    <?php //Comment in for Debug// dbg(tpl_img_getTag('Simple.Raw')); ?>
                </div>
                <div class="clearer"></div>
            </div><!-- /.content -->

            <p class="back">
                <?php tpl_action('mediaManager', 1) ?><br />
                &larr; <?php tpl_action('img_backto', 1) ?>
            </p>

        <?php endif; ?>
    </div>
    <!--[if ( lte IE 7 | IE 8 ) ]></div><![endif]-->
</body>
</html>
