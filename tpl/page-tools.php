<?php
/**
 * DokuWiki Bootstrap3 Template: Page Tools
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

global $TEMPLATE;
global $ACT;

if ($TEMPLATE->getConf('showPageTools')): ?>

<!-- page-tools -->
<nav id="dw__pagetools" class="hidden-print">
    <div class="tools panel panel-default pull-right <?php echo (($TEMPLATE->getConf('pageToolsAnimation')) ? 'tools-animation' : '') ?>">
        <ul class="nav nav-stacked nav-pills">
            <?php

                $menu = ((! defined('DOKU_MEDIADETAIL')) ? new dokuwiki\Menu\PageMenu : new dokuwiki\Menu\DetailMenu);

                foreach ($menu->getItems() as $item) {

                    $attr  = buildAttributes($item->getLinkAttributes());
                    $class = 'action';

                    if ($ACT == $item->getType() || ($ACT == 'revisions' && $item->getType() == 'revs')) {
                        $class = 'action active';
                    }

                    $html  = '<li class="' . $class . '">';
                    $html .= "<a $attr>";
                    $html .= '<span class="sr-only">' . hsc($item->getLabel()) . '</span>';
                    $html .= inlineSVG($item->getSvg());
                    $html .= "</a>";
                    $html .= '</li>';

                    echo $html;

                }

            ?>
        </ul>
    </div>
</nav>
<?php endif; ?>
<!-- /page-tools -->
