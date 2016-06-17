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

if (bootstrap3_conf('showThemeSwitcher')):

global $ID;

$bootswatch_theme = bootstrap3_bootswatch_theme();

?>
<!-- theme-switcher -->
<ul class="nav navbar-nav" id="dw__themes">
  <li class="dropdown">

    <a href="<?php wl($ID) ?>" class="dropdown-toggle" data-toggle="dropdown" data-target="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-tint"></i> <span class="<?php echo (in_array('themes', bootstrap3_conf('navbarLabels')) ? '' : 'hidden-lg hidden-md hidden-sm') ?>"><?php echo tpl_getLang('themes') ?></span> <span class="caret"></span></a>

    <ul class="dropdown-menu" aria-labelledby="themes">
      <li class="dropdown-header"><i class="fa fa-fw fa-tint"></i> Bootswatch Themes</li>
      <?php foreach (bootstrap3_bootswatch_themes_available() as $theme): ?>
      <li<?php echo ($bootswatch_theme == $theme) ? ' class="active"' : '' ?>>
        <a href="<?php echo wl($ID, array('bootswatch-theme' => hsc($theme))); ?>"><?php echo ucfirst($theme) ?></a>
      </li>
      <?php endforeach; ?>
    </ul>

  </li>
</ul>
<!-- /theme-switcher -->
<?php endif; ?>
