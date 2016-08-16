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

?>
<?php if ($conf['youarehere'] || $conf['breadcrumbs']): ?>
<div id="dw__breadcrumbs" class="small">
  <hr/>
  <?php if($conf['youarehere']): ?>
  <div class="dw__youarehere">
    <?php bootstrap3_youarehere()?>
  </div>
  <?php endif; ?>
  <?php if($conf['breadcrumbs']): ?>
  <div class="dw__breadcrumbs hidden-print">
    <?php bootstrap3_breadcrumbs() ?>
  </div>
  <?php endif; ?>
  <hr/>
</div>
<?php endif ?>
