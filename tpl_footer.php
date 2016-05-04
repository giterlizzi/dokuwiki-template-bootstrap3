<?php
/**
 * DokuWiki Bootstrap3 Template: Footer page
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

$footer_page = 'footer';

resolve_pageid('', $footer_page, $footer_page_exists);

if ($footer_page_exists):
?>
<footer id="dw__footer" class="small navbar <?php echo ((bootstrap3_conf('inverseNavbar')) ? 'navbar-inverse' : 'navbar-default') ?> navbar-fixed-bottom">
  <div class="container<?php echo (bootstrap3_is_fluid_container()) ? '-fluid' : '' ?>">
    <div class="navbar-text">
      <?php tpl_include_page($footer_page, 1, 1); ?>
    </div>
  </div>
</footer>
<?php endif; ?>
