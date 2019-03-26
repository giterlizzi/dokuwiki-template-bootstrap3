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

if (!defined('DOKU_INC')) die(); // must be run from within DokuWiki

global $TEMPLATE;

$TEMPLATE = \dokuwiki\template\bootstrap3\Template::getInstance();

require_once(template('/tpl/global.php'));
require_once(template('/tpl/functions.php'));  // include hook for template functions

header('X-UA-Compatible: IE=edge,chrome=1');

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="UTF-8" />
    <title><?php echo hsc(tpl_img_getTag('IPTC.Headline',$IMG))?> [<?php echo strip_tags($conf['title'])?>]</title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php
        echo tpl_favicon(array('favicon', 'mobile'));
        tpl_includeFile('meta.html');
        tpl_metaheaders();
    ?>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script type="text/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery(document).trigger('bootstrap3:detail');
    });
</script>
</head>

<body class="<?php echo $TEMPLATE->getClasses() ?>" data-img-id="<?php echo $IMG ?>">

    <header id="dokuwiki__header" class="dokuwiki container<?php echo ($TEMPLATE->isFluidContainer()) ? '-fluid' : '' ?>">
        <?php

            tpl_includeFile('topheader.html');

            // Top-Header DokuWiki page
            if ($ACT == 'show') echo $TEMPLATE->includePage('topheader');

            require_once(template('tpl/navbar.php'));

            tpl_includeFile('header.html');

            // Header DokuWiki page
            if ($ACT == 'show') echo $TEMPLATE->includePage('header');

        ?>
    </header>

    <div id="dokuwiki__top" class="dokuwiki container<?php echo ($TEMPLATE->isFluidContainer()) ? '-fluid mx-5' : '' ?>">

        <div id="dokuwiki__pageheader">

            <?php tpl_includeFile('social.html') ?>

            <?php require_once('tpl/breadcrumbs.php'); ?>

            <p class="pageId text-right">
                <?php if($TEMPLATE->getConf('showPageId')): ?><span class="label label-primary"><?php echo hsc(tpl_img_getTag('IPTC.Headline',$IMG)); ?></span><?php endif; ?>
            </p>

            <div id="dw__msgarea" class="small">
                <?php $TEMPLATE->getMessageArea() ?>
            </div>

        </div>

        <main role="main">

            <article id="dokuwiki__detail">

                <?php require_once('tpl/page-tools.php'); // Page Tools ?>

                <div class="<?php echo ($TEMPLATE->getConf('pageOnPanel') ? 'panel panel-default' : 'no-panel') ?>">
                    <div class="page <?php echo ($TEMPLATE->getConf('pageOnPanel') ? 'panel-body' : '') ?>">

                        <?php require_once(template('tpl/page-icons.php')); ?>

                        <?php if ($ERROR): print $ERROR; ?>
                        <?php else: ?>
                        <?php if ($REV) echo p_locale_xhtml('showrev'); ?>

                        <h1 class="page-header">
                            <i class="fa fa-picture-o text-muted"></i> <?php echo hsc(tpl_img_getTag('IPTC.Headline', $IMG))?>
                        </h1>

                        <p class="pull-right hidden-print list-inline">
                            <button type="button" class="btn btn-primary btn-xs" title="Info" data-toggle="modal" data-target="#detail-dialog"><i class="fa fa-fw fa-info-circle"></i></button>
                            <a href="<?php echo ml($IMG, array('cache'=> $INPUT->str('cache'),'rev'=>$REV), true, '&'); ?>" target="_blank" class="btn btn-default btn-xs" title="<?php echo $lang['js']['mediadirect']; ?>"><i class="fa fa-fw fa-arrows-alt"></i></a>
                        </p>

                        <?php tpl_img(900, 700); /* the image; parameters: maximum width, maximum height (and more) */ ?>

                        <div class="modal fade" tabindex="-1" id="detail-dialog" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo $lang['js']['mediaclose']; ?>"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-fw fa-info-circle text-primary"></i> <?php echo hsc(tpl_img_getTag('IPTC.Headline',$IMG)); ?></h4>
                                    </div>
                                    <div class="modal-body">

                                    <?php
                                        tpl_img_meta();
                                        //Comment in for Debug
                                        //dbg(tpl_img_getTag('Simple.Raw'));
                                    ?>

                                    <hr/>

                                    <dl class="dl-horizontal">
                                        <?php
                                            echo '<dt>'.$lang['reference'].':</dt>';
                                            $media_usage = ft_mediause($IMG, true);
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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang['js']['mediaclose']; ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php endif; ?>

                    </div>
                </div>

                <div class="small text-right">

                    <?php if ($TEMPLATE->getConf('showPageInfo')): ?>
                    <span class="docInfo">
                        <?php $TEMPLATE->getPageInfo() /* 'Last modified' etc */ ?>
                    </span>
                    <?php endif ?>

                    <?php if ($TEMPLATE->getConf('showLoginOnFooter')): ?>
                    <span class="loginLink hidden-print">
                        <?php echo tpl_action('login', 1, 0, 1, '<i class="fa fa-sign-in"></i> '); ?>
                    </span>
                    <?php endif; ?>

                </div>

            </article>
        </main>

        <div class="small text-right">

            <?php if ($TEMPLATE->getConf('showLoginOnFooter')): ?>
            <span class="loginLink hidden-print">
                <?php echo tpl_action('login', 1, 0, 1, '<i class="fa fa-sign-in"></i> '); ?>
            </span>
            <?php endif; ?>

        </div>

        <?php
            // Footer hook
            tpl_includeFile('footer.html');

            // Footer DokuWiki page
            require_once(template('tpl/footer.php'));

            // Cookie-Law banner
            require_once(template('tpl/cookielaw.php'));
        ?>

        <a href="#dokuwiki__top" class="back-to-top hidden-print btn btn-default btn-sm" title="<?php echo $lang['skip_to_content'] ?>" accesskey="t"><i class="fa fa-chevron-up"></i></a>

        <div id="screen__mode"><?php /* helper to detect CSS media query in script.js */ ?>
            <span class="visible-xs"></span>
            <span class="visible-sm"></span>
            <span class="visible-md"></span>
            <span class="visible-lg"></span>
        </div>

    </div>

</body>
</html>
