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

global $conf;

if (bootstrap3_conf('showBadges')): ?>
<ul id="dw__badges" class="list-inline text-right hidden-print">

  <li>
    <a href="https://www.dokuwiki.org/template:bootstrap3" title="Bootstrap template for DokuWiki" target="<?php echo $conf['target']['extern'] ?>">
      <img src="<?php echo tpl_basedir(); ?>images/bootstrap.png" width="20" alt="Bootstrap template for DokuWiki" />
    </a>
  </li>

  <li>
    <a href="https://www.php.net" title="Powered by PHP" target="<?php echo $conf['target']['extern'] ?>">
      <img src="<?php echo tpl_basedir(); ?>images/php.png" width="20" alt="Powered by PHP" />
    </a>
  </li>

  <li>
    <a href="http://validator.w3.org/check/referer" title="Valid HTML5" target="<?php echo $conf['target']['extern'] ?>">
      <img src="<?php echo tpl_basedir(); ?>images/html5.png" width="20" alt="Valid HTML5" />
    </a>
  </li>

  <li>
    <a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3" title="Valid CSS" target="<?php echo $conf['target']['extern'] ?>">
      <img src="<?php echo tpl_basedir(); ?>images/css3.png" width="20" alt="Valid CSS" />
    </a>
  </li>

  <li>
    <a href="https://www.dokuwiki.org/" title="Driven by DokuWiki" target="<?php echo $conf['target']['extern'] ?>">
      <img src="<?php echo tpl_basedir(); ?>images/logo.png" width="20" alt="Driven by DokuWiki" />
    </a>
  </li>

</ul>
<?php endif; ?>
