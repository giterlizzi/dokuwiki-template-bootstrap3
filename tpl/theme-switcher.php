<?php
/**
 * DokuWiki Bootstrap3 Template: Theme Switcher
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

global $TPL, $ID;

$bootswatch_theme = $TPL->getBootswatchTheme();

?>
<!-- theme-switcher -->
<ul class="nav navbar-nav" id="dw__themes">
    <li class="dropdown">

        <a href="<?php wl($ID) ?>" class="dropdown-toggle" data-toggle="dropdown" data-target="#" role="button" aria-haspopup="true" aria-expanded="false">
            <?php echo iconify('mdi:palette'); ?> <span class="<?php echo (in_array('themes', $TPL->getConf('navbarLabels')) ? '' : 'hidden-lg hidden-md hidden-sm') ?>"><?php echo tpl_getLang('themes') ?></span> <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" aria-labelledby="themes">
            <li class="dropdown-header">
                <?php echo iconify('mdi:palette'); ?> <?php echo tpl_getLang('themes') ?>
            </li>
            <li<?php echo ($bootswatch_theme == 'default') ? ' class="active"' : '' ?>>
                <a onclick="DokuCookie.setValue('bootswatchTheme', '<?php echo hsc('default'); ?>'); document.location.reload(true)" href="#">Default</a>
            </li>
            <li class="dropdown-header">
                <?php echo iconify('mdi:palette'); ?> Bootswatch Themes
            </li>
            <?php foreach ($TPL->getAvailableBootswatchThemes() as $theme): ?>
            <li<?php echo ($bootswatch_theme == $theme) ? ' class="active"' : '' ?>>
                <a onclick="DokuCookie.setValue('bootswatchTheme', '<?php echo hsc($theme); ?>'); document.location.reload(true)" href="#"><?php echo ucfirst($theme) ?></a>
            </li>
            <?php endforeach; ?>
        </ul>

    </li>
</ul>
<!-- /theme-switcher -->
