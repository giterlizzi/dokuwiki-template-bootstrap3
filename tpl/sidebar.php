<?php
/**
 * DokuWiki Bootstrap3 Template: Sidebar
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

global $TEMPLATE;

$sidebar_title = $lang['sidebar'];

if ($TEMPLATE->getConf('sidebarShowPageTitle')) {
    $sidebar_title = p_get_first_heading(page_findnearest($sidebar_page, $TEMPLATE->getConf('useACL')));
    if (! $sidebar_title) $sidebar_title = $lang['sidebar'];
}

?>
<!-- sidebar -->
<aside id="<?php echo $sidebar_id ?>" class="dw__sidebar <?php echo $sidebar_class ?> hidden-print">
    <div class="dw-sidebar-content">
        <div class="dw-sidebar-title hidden-lg hidden-md hidden-sm" data-toggle="collapse" data-target="#<?php echo $sidebar_id ?> .dw-sidebar-body">
            <?php echo iconify('mdi:view-list'); ?> <?php echo $sidebar_title ?>
        </div>
        <div class="dw-sidebar-body collapse in small">
            <?php

                tpl_includeFile("$sidebar_header.html");
                if ($ACT == 'show') $TEMPLATE->includePage($sidebar_header);

                $TEMPLATE->normalizeSidebar(tpl_include_page($sidebar_page, 0, 1, $TEMPLATE->getConf('useACL'))); /* includes the nearest sidebar page */

                tpl_includeFile("$sidebar_footer.html");
                if ($ACT == 'show') $TEMPLATE->includePage($sidebar_footer)

            ?>
        </div>
    </div>
</aside>
<!-- /sidebar -->
