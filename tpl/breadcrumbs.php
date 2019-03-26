<?php
/**
 * DokuWiki Bootstrap3 Template: Breadcrumbs
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

global $conf;
global $TEMPLATE;

?>
<?php if ($conf['youarehere'] || $conf['breadcrumbs']): ?>
<!-- breadcrumbs -->
<nav id="dw__breadcrumbs" class="small">

    <hr/>

    <?php if($conf['youarehere']): ?>
    <div class="dw__youarehere">
        <?php $TEMPLATE->getYouAreHere()?>
    </div>
    <?php endif; ?>

    <?php if($conf['breadcrumbs']): ?>
    <div class="dw__breadcrumbs hidden-print">
        <?php $TEMPLATE->getBreadcrumbs() ?>
    </div>
    <?php endif; ?>

    <hr/>

</nav>
<!-- /breadcrumbs -->
<?php endif ?>
