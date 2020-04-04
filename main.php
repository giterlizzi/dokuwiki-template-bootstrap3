<?php
/**
 * DokuWiki Bootstrap3 Template
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die();     // must be run from within DokuWiki

require_once('tpl/global.php');
require_once('tpl/functions.php');

header('X-UA-Compatible: IE=edge,chrome=1');

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="UTF-8" />
    <title><?php echo $TEMPLATE->getBrowserPageTitle() ?></title>
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
</head>
<?php tpl_flush() ?>
<body class="<?php echo $TEMPLATE->getClasses() ?>" data-page-id="<?php echo $ID ?>"><div class="dokuwiki"><?php /* CSS class for Plugins and user styles */ ?>

    <header id="dokuwiki__header" class="dw-container dokuwiki container<?php echo ($TEMPLATE->getConf('fluidContainer')) ? '-fluid mx-5' : '' ?>">
    <?php

        tpl_includeFile('topheader.html');

        // Top-Header DokuWiki page
        if ($ACT == 'show') $TEMPLATE->includePage('topheader');

        require_once('tpl/navbar.php');

        tpl_includeFile('header.html');

        // Header DokuWiki page
        if ($ACT == 'show') $TEMPLATE->includePage('header');

    ?>
    </header>

    <a name="dokuwiki__top" id="dokuwiki__top"></a>

    <main role="main" class="dw-container pb-5 dokuwiki container<?php echo ($TEMPLATE->getConf('fluidContainer')) ? '-fluid mx-5' : '' ?>">

        <div id="dokuwiki__pageheader">

            <?php tpl_includeFile('social.html') ?>

            <?php require_once('tpl/breadcrumbs.php'); ?>

            <p class="text-right">
                <?php

                    if ($TEMPLATE->getConf('tagsOnTop') && $tag = $TEMPLATE->getPlugin('tag')) {
                        echo implode('', array_map('trim', explode(',', $tag->td($ID))));
                    }

                    if ($TEMPLATE->getConf('showPageId')) {
                        echo '<span class="pageId ml-1 label label-primary">'. hsc($ID) .'</span>';
                    }

                ?>
            </p>

            <div id="dw__msgarea" class="small">
                <?php $TEMPLATE->getMessageArea() ?>
            </div>

        </div>

        <div class="row">

            <?php $TEMPLATE->includeSidebar('left'); // Left Sidebar ?>

            <article id="dokuwiki__content" class="<?php echo $TEMPLATE->getContainerGrid() ?>" <?php echo (($TEMPLATE->getConf('semantic')) ? sprintf('itemscope itemtype="http://schema.org/%s" itemref="dw__license"', $TEMPLATE->getConf('schemaOrgType')) : '') ?>>

                <?php require_once('tpl/page-tools.php'); // Page Tools ?>

                <div class="<?php echo ($TEMPLATE->getConf('pageOnPanel') ? 'panel panel-default px-3 py-2' : 'no-panel') ?>" <?php echo (($TEMPLATE->getConf('semantic')) ? 'itemprop="articleBody"' : '') ?>>
                    <div class="page <?php echo ($TEMPLATE->getConf('pageOnPanel') ? 'panel-body' : '') ?>">

                        <?php

                        // Page icons (print, email, share link, etc.)
                        require_once('tpl/page-icons.php');

                        // Page-Header DokuWiki page
                        tpl_includeFile('pageheader.html');

                        // Page-Header DokuWiki page
                        if ($ACT == 'show') $TEMPLATE->includePage('pageheader');

                        tpl_flush(); /* flush the output buffer */

                        // render the content into buffer for later use
                        ob_start();
                        tpl_content(false);

                        $content         = ob_get_clean();
                        $toc             = $TEMPLATE->getTOC(true);
                        $content_classes = array();

                        if ($TEMPLATE->getConf('tocCollapsed')) $content_classes[] = 'dw-toc-closed';

                        echo '<div class="dw-content-page '. implode(' ', $content_classes) .'">';

                        if ($toc && $TEMPLATE->getConf('tocLayout') == 'default') echo '<div class="dw-toc hidden-print">' . $toc . '</div>';

                        echo '<!-- content -->';
                        echo '<div class="dw-content">';
                        echo $content;
                        echo '</div>';
                        echo '<!-- /content -->';
                        echo '</div>';

                        tpl_flush();

                        if (! $TEMPLATE->getConf('tagsOnTop') && $tag = $TEMPLATE->getPlugin('tag')) {
                            echo implode('', array_map('trim', explode(',', $tag->td($ID))));
                        }

                        // Page-Footer hook
                        tpl_includeFile('pagefooter.html');

                        // Page-Footer DokuWiki page
                        if ($ACT == 'show') $TEMPLATE->includePage('pagefooter');

                        ?>

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
                        <?php
                            if ($login_item = $TEMPLATE->getToolMenuItem('user', 'login')) {
                                echo '<a '. buildAttributes($login_item->getLinkAttributes()) .'>'. inlineSVG($login_item->getSvg()) . ' ' . hsc($login_item->getLabel()) .'</a>';
                            }
                        ?>
                    </span>
                    <?php endif; ?>

                </div>

            </article>

            <?php $TEMPLATE->includeSidebar('right'); // Right Sidebar ?>

        </div>

    </main>

    <footer id="dw__footer" class="dw-container py-5 dokuwiki container<?php echo ($TEMPLATE->getConf('fluidContainer')) ? '-fluid' : '' ?>">
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
