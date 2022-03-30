<?php
/**
 * DokuWiki Bootstrap3 Template
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die();     // must be run from within DokuWiki

require_once 'tpl/global.php';
require_once 'tpl/functions.php';

header('X-UA-Compatible: IE=edge,chrome=1');

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="UTF-8" />
    <title><?php echo $TPL->getBrowserPageTitle() ?></title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php

        if ($TPL->getConf('themeByNamespace')) {
            echo '<link href="' . tpl_basedir() . 'css.php?id='. $ID .'" rel="stylesheet" />';
        }

        echo tpl_favicon(['favicon', 'mobile']);
        tpl_includeFile('meta.html');
        tpl_metaheaders();

    ?>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script type="text/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<?php tpl_flush() ?>
<body class="<?php echo $TPL->getClasses() ?>" data-page-id="<?php echo $ID ?>"><div class="dokuwiki"><?php /* CSS class for Plugins and user styles */ ?>

    <header id="dokuwiki__header" class="dw-container dokuwiki container<?php echo ($TPL->getConf('fluidContainer')) ? '-fluid mx-5' : '' ?>">
    <?php

        tpl_includeFile('topheader.html');

        // Top-Header DokuWiki page
        if ($ACT == 'show') $TPL->includePage('topheader');

        require_once('tpl/navbar.php');

        tpl_includeFile('header.html');

        // Header DokuWiki page
        if ($ACT == 'show') $TPL->includePage('header');

    ?>
    </header>

    <a name="dokuwiki__top" id="dokuwiki__top"></a>

    <main role="main" class="dw-container pb-5 dokuwiki container<?php echo ($TPL->getConf('fluidContainer')) ? '-fluid mx-5' : '' ?>">

        <div id="dokuwiki__pageheader">

            <?php tpl_includeFile('social.html') ?>

            <?php require_once('tpl/breadcrumbs.php'); ?>

            <p class="text-right">
                <?php

                    if (($ACT == 'show') && $TPL->getConf('tagsOnTop') && $tag = $TPL->getPlugin('tag')) {
                        echo implode('', array_map('trim', explode(',', $tag->td($ID))));
                    }

                    if ($TPL->getConf('showPageId')) {
                        echo '<span class="pageId ml-1 label label-primary">'. hsc($ID) .'</span>';
                    }

                ?>
            </p>

            <div id="dw__msgarea" class="small">
                <?php $TPL->getMessageArea() ?>
            </div>

        </div>

        <div class="row">

            <?php $TPL->includeSidebar('left'); // Left Sidebar ?>

            <article id="dokuwiki__content" class="<?php echo $TPL->getContainerGrid() ?>" itemscope itemtype="http://schema.org/<?php echo $TPL->getConf('schemaOrgType'); ?>" itemref="dw__license">

                <?php require_once('tpl/page-tools.php'); // Page Tools ?>

                <div class="<?php echo ($TPL->getConf('pageOnPanel') ? 'panel panel-default px-3 py-2' : 'no-panel') ?>" itemprop="articleBody">
                    <div class="page <?php echo ($TPL->getConf('pageOnPanel') ? 'panel-body' : '') ?>">

                        <?php

                        // Page icons (print, email, share link, etc.)
                        require_once('tpl/page-icons.php');

                        // Page-Header DokuWiki page
                        tpl_includeFile('pageheader.html');

                        // Page-Header DokuWiki page
                        if ($ACT == 'show') $TPL->includePage('pageheader');

                        tpl_flush(); /* flush the output buffer */

                        // render the content into buffer for later use
                        ob_start();
                        tpl_content(false);

                        $content         = ob_get_clean();
                        $toc             = $TPL->getTOC(true);
                        $content_classes = [];

                        if ($TPL->getConf('tocCollapsed')) $content_classes[] = 'dw-toc-closed';

                        echo '<div class="dw-content-page '. implode(' ', $content_classes) .'">';

                        if ($toc) echo $toc;

                        echo '<!-- content -->';
                        echo '<div class="dw-content">';
                        echo $content;
                        echo '</div>';
                        echo '<!-- /content -->';
                        echo '</div>';

                        tpl_flush();

                        if (! $TPL->getConf('tagsOnTop') && $tag = $TPL->getPlugin('tag')) {
                            echo implode('', array_map('trim', explode(',', $tag->td($ID))));
                        }

                        // Page-Footer hook
                        tpl_includeFile('pagefooter.html');

                        // Page-Footer DokuWiki page
                        if ($ACT == 'show') $TPL->includePage('pagefooter');

                        ?>

                    </div>
                </div>

                <div class="small text-right">

                    <?php if ($TPL->getConf('showPageInfo')): ?>
                    <span class="docInfo">
                        <?php $TPL->getPageInfo() /* 'Last modified' etc */ ?>
                    </span>
                    <?php endif ?>

                    <?php if ($TPL->getConf('showLoginOnFooter')): ?>
                    <span class="loginLink hidden-print">
                        <?php
                            if ($login_item = $TPL->getToolMenuItem('user', 'login')) {
                                echo '<a '. buildAttributes($login_item->getLinkAttributes()) .'>'. inlineSVG($login_item->getSvg()) . ' ' . hsc($login_item->getLabel()) .'</a>';
                            }
                        ?>
                    </span>
                    <?php endif; ?>

                </div>

            </article>

            <?php $TPL->includeSidebar('right'); // Right Sidebar ?>

        </div>

    </main>

    <footer id="dw__footer" class="dw-container py-5 dokuwiki container<?php echo ($TPL->getConf('fluidContainer')) ? '-fluid' : '' ?>">
        <?php
            // Footer hook
            tpl_includeFile('footer.html');

            // Footer DokuWiki page
            require_once('tpl/footer.php');

            // Cookie-Law banner
            require_once('tpl/cookielaw.php');
        ?>
    </footer>

    <a href="#dokuwiki__top" class="back-to-top hidden-print btn btn-default" title="<?php echo $lang['skip_to_content'] ?>" accesskey="t">
        <?php echo iconify('mdi:chevron-up'); ?>
    </a>

    <div id="screen__mode"><?php /* helper to detect CSS media query in script.js */ ?>
        <span class="visible-xs-block"></span>
        <span class="visible-sm-block"></span>
        <span class="visible-md-block"></span>
        <span class="visible-lg-block"></span>
    </div>

    <?php
        // Provide DokuWiki housekeeping, required in all templates
        tpl_indexerWebBug();
    ?>

</div>

</body>
</html>
