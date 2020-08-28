<?php
/**
 * DokuWiki Bootstrap3 Template: Page icons
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

global $TPL;

if (($ACT == 'show' || defined('DOKU_MEDIADETAIL')) && $TPL->getConf('showPageIcons')):

?>
<!-- page-icons -->
<div class="dw-page-icons pull-right hidden-print">
    <ul class="list-inline">
    <?php

        $menu = new \dokuwiki\template\bootstrap3\Menu\PageIconsMenu;

        foreach($menu->getItems() as $item) {

            $class = $item->getType();
            $attr  = buildAttributes($item->getLinkAttributes());

            if ($item->getType() == 'shareon') {
                $class .= ' dropdown';
            }

            $html  = '<li class="' . $class . '">';
            $html .= "<a $attr>";
            $html .= \inlineSVG($item->getSvg());
            $html .= '<span>' . hsc($item->getLabel()) . '</span>';
            $html .= "</a>";

            if ($item->getType() == 'shareon') {
                $html .= $item->getDropDownMenu();
            }

            $html .= '</li>';

            echo $html;

        }

    ?>
    </ul>
</div>

<span class="clearfix"></span>

<!-- /page-icons -->

<div class="help modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body px-5"></div>
        </div>
    </div>
</div>

<?php endif; ?>

