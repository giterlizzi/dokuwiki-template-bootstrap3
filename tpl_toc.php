<?php
/**
 * DokuWiki Bootstrap3 Template: TOC
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

?>
<div class="pull-right hidden-print">
  <div class="toc-affix" data-spy="affix" data-offset-top="150">
    <?php bootstrap3_toc(tpl_toc(true)) ?>
  </div>
</div>
