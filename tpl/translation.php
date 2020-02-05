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
global $TEMPLATE;

$show_translation  = false;
$translation_items = '';
$translation_label = '';

if ($TEMPLATE->getConf('showTranslation') && $translation = $TEMPLATE->getPlugin('translation')) {

    global $conf;
    $conf['plugin']['translation']['dropdown'] = 0;

    if ($translation->istranslatable($ID)) {

        $show_translation = true;

        list($lc, $idpart) = $translation->getTransParts($ID);

        $translation_label = $translation->getLang('translations');

        foreach ($translation->translations as $t) {
            $translation_items .= str_replace(array('<div class="li">', '</div>'), '', $translation->getTransItem($t, $idpart));
        }

    }

}

if ($show_translation):
?>
<!-- translation -->
<ul class="nav navbar-nav" id="dw__translation">
    <li class="dropdown">
        <a href="<?php wl($ID) ?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" title="<?php echo $translation_label ?>" role="button" aria-haspopup="true" aria-expanded="false">
            <?php echo iconify('mdi:flag'); ?> <span class="hidden-lg hidden-md hidden-sm"><?php echo $translation_label ?></span><span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li class="dropdown-header hidden-xs hidden-sm">
            <?php echo iconify('mdi:flag'); ?> <?php echo $translation_label ?>
            </li>
            <?php echo $translation_items ?>
        </ul>
    </li>
</ul>
<!-- /translation -->
<?php endif; ?>
