<?php
/**
 * DokuWiki Bootstrap3 Template: Translation Plugin
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

global $ID;

if (bootstrap3_conf('showTranslation') && $translation = plugin_load('helper','translation')):

if (! $translation->istranslatable($ID)) return false;

  list($lc, $idpart) = $translation->getTransParts($ID);

  $trans_items = '';
  $trans_label = $translation->getLang('translations');

  foreach ($translation->translations as $trans) {
    $trans_items .= str_replace(array('<div class="li">', '</div>'), '', $translation->getTransItem($trans, $idpart));
  }

?>
<ul class="nav navbar-nav" id="dw__translation">
  <li class="dropdown">
    <a href="<?php wl($ID) ?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" title="<?php echo $trans_label ?>" role="button" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-fw fa-flag"></i> <span class="hidden-lg hidden-md hidden-sm"><?php echo $trans_label ?></span><span class="caret"></span>
    </a>
  <ul class="dropdown-menu" role="menu">
    <li class="dropdown-header hidden-xs hidden-sm"><i class="fa fa-fw fa-flag"></i> <?php echo $trans_label ?></li>
    <?php echo $trans_items ?>
  </ul>
</ul>
<?php endif; ?>
