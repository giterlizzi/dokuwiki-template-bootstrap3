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

if (page_findnearest('footer', bootstrap3_conf('useACL'))):
?>
<footer id="dw__footer" class="small navbar <?php echo ((bootstrap3_conf('inverseNavbar')) ? 'navbar-inverse' : 'navbar-default') ?>">
  <div class="container<?php echo (bootstrap3_is_fluid_container()) ? '-fluid' : '' ?>">
    <div class="navbar-text">
      <?php tpl_include_page('footer', 1, 1, bootstrap3_conf('useACL')); ?>
    </div>
  </div>
</footer>
<?php endif; ?>
