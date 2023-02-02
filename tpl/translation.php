<?php
/**
 * DokuWiki Bootstrap3 Template: Translation Plugin
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

global $ID;
global $TPL;
global $conf;

$show_translation  = false;
$translation_items = [];
$translation_label = '';

$translation = $TPL->getPlugin('translation');

$conf['plugin']['translation']['dropdown'] = 0;

if ($translation->istranslatable($ID)) {

    $show_translation = true;

    list($lc, $idpart) = $translation->getTransParts($ID);

    $translation_label = $translation->getLang('translations');

    foreach ($translation->translations as $t) {

        // Old version of Translation plugin
        if (method_exists($translation, 'getTransItem')) {
            $translation_items[] = str_replace(array('<div class="li">', '</div>'), '', $translation->getTransItem($t, $idpart));
        } else {

            list($target, $language) = $translation->buildTransID($t, $idpart);

            $target = cleanID($target);
            $exists = page_exists($target, '', false);
            $link   = wl($target);

            $text  = '';
            $title = hsc($translation->getLocalName($language));

            if (isset($translation->opts['flag'])) {
                $text .= '<i>' . inlineSVG(DOKU_PLUGIN . 'translation/flags/' . $language . '.svg', 1024 * 12) . '</i>';
            }

            if (isset($translation->opts['name'])) {

                $text .= hsc($translation->getLocalName($language));

                if (isset($translation->opts['langcode'])) {
                    $text .= ' (' . hsc($language) . ')';
                }

            } elseif (isset($translation->opts['langcode'])) {
                $text .= hsc($language);
            }

            $translation_items[] = '<li class="menuitem"><a href="' . $link . '" class="' . ($exists ? 'wikilink1' : 'wikilink2') . '" title="' . $title . '">' . $text . '</a></li>';

        }
    }

}

if ($show_translation):
?>
<!-- translation -->
<ul class="nav navbar-nav" id="dw__translation">
    <li class="dropdown">
        <a href="<?php wl($ID)?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" title="<?php echo $translation_label ?>" role="button" aria-haspopup="true" aria-expanded="false">
            <?php echo iconify('mdi:flag'); ?> <span class="hidden-lg hidden-md hidden-sm"><?php echo $translation_label ?></span><span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">

            <?php if ($translation->getConf('about') || $translation->getConf('title')): ?>
            <li class="dropdown-header hidden-xs hidden-sm">
                <?php

                    echo iconify('mdi:flag');
                    echo $translation->getLang('translations');

                    if ($translation->getConf('about')) {
                        echo ' ' . $translation->showAbout();
                    }
                ?>
            <?php endif;?>
            </li>

            <?php
                foreach ($translation_items as $item) {
                    echo $item;
                }
            ?>

        </ul>
    </li>
</ul>
<!-- /translation -->
<?php endif;?>
