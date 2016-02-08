<?php
/**
 * DokuWiki Bootstrap3 Template: Badges
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

if (bootstrap3_conf('showBadges')):

  $target  = ($conf['target']['extern']) ? 'target="'.$conf['target']['extern'].'"' : '';
  $dw_path = dirname(tpl_basedir());

?>
<div class="text-center hidden-print">

  <?php echo tpl_license('button', true, false, false); // license button, no wrapper ?>

  <a href="http://getbootstrap.com" title="Built with Bootstrap 3" <?php echo $target ?>>
    <img src="<?php echo tpl_basedir(); ?>images/button-bootstrap3.png" width="80" height="15" alt="Built with Bootstrap 3" />
  </a>

  <a href="http://www.php.net" title="Powered by PHP" <?php echo $target ?>>
    <img src="<?php echo $dw_path ?>/dokuwiki/images/button-php.gif" width="80" height="15" alt="Powered by PHP" />
  </a>

  <a href="http://validator.w3.org/check/referer" title="Valid HTML5" <?php echo $target ?>>
    <img src="<?php echo $dw_path ?>/dokuwiki/images/button-html5.png" width="80" height="15" alt="Valid HTML5" />
  </a>

  <a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3" title="Valid CSS" <?php echo $target ?>>
    <img src="<?php echo $dw_path ?>/dokuwiki/images/button-css.png" width="80" height="15" alt="Valid CSS" />
  </a>

  <a href="http://dokuwiki.org/" title="Driven by DokuWiki" <?php echo $target ?>>
    <img src="<?php echo $dw_path ?>/dokuwiki/images/button-dw.png" width="80" height="15" alt="Driven by DokuWiki" />
  </a>

</div>
<?php endif; ?>
