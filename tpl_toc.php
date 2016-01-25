<?php
/**
 * DokuWiki Bootstrap3 Template: TOC Layout
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

?>
<div class="row">
  <div class="col-md-9 content-col">
    <?php echo $content ?>
  </div>
  <div class="col-md-3 hidden-xs hidden-sm toc-col">
    <div class="hidden-print dw-toc-affix" data-spy="affix" data-offset-top="150">
      <?php echo $toc ?>
    </div>
  </div>
</div>

