<?php
/**
 * DokuWiki Bootstrap3 Template: Theme Switcher
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

global $TEMPLATE, $ID;

if ($TEMPLATE->getConf('showThemeSwitcher')):

$bootswatch_theme = $TEMPLATE->getBootswatchTheme();

?>
<!-- theme-switcher -->
<ul class="nav navbar-nav" id="dw__themes">
    <li class="dropdown">

        <a href="<?php wl($ID) ?>" class="dropdown-toggle" data-toggle="dropdown" data-target="#" role="button" aria-haspopup="true" aria-expanded="false">
            <?php echo iconify('mdi:palette'); ?> <span class="<?php echo (in_array('themes', $TEMPLATE->getConf('navbarLabels')) ? '' : 'hidden-lg hidden-md hidden-sm') ?>"><?php echo tpl_getLang('themes') ?></span> <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" aria-labelledby="themes">
            <li class="dropdown-header">
                <?php echo iconify('mdi:palette'); ?> <?php echo tpl_getLang('themes') ?>
            </li>
            <li<?php echo ($bootswatch_theme == 'default') ? ' class="active"' : '' ?>>
                <a href="<?php echo wl($ID, array('bootswatch-theme' => hsc('default'))); ?>">Default</a>
            </li>
            <li class="dropdown-header">
                <?php echo iconify('mdi:palette'); ?> Bootswatch Themes
            </li>
            <?php foreach ($TEMPLATE->getAvailableBootswatchThemes() as $theme): ?>
            <li<?php echo ($bootswatch_theme == $theme) ? ' class="active"' : '' ?>>
                <a href="<?php echo wl($ID, array('bootswatch-theme' => hsc($theme))); ?>"><?php echo ucfirst($theme) ?></a>
            </li>
            <?php endforeach; ?>
        </ul>

    </li>
</ul>
<!-- /theme-switcher -->
<?php endif; ?>
