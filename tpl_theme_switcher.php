<?php
/**
 * DokuWiki Bootstrap3 Template: Theme Switcher
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$themes = array('cerulean', 'cosmo', 'cyborg', 'darkly', 'flatly', 'journal', 'lumen', 'paper', 'readable', 'sandstone', 'simplex', 'slate', 'spacelab', 'superhero', 'united', 'yeti');

?>
<?php if ($showThemeSwitcher && $bootstrapTheme == 'bootswatch'): ?>
<!-- theme-switcher -->
<ul class="nav navbar-nav" id="dw__themes">
  <li class="dropdown">

    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-tint"></i> <span class="hidden-lg hidden-md hidden-sm"><?php echo tpl_getLang('themes') ?></span> <span class="caret"></span></a>

    <ul class="dropdown-menu" aria-labelledby="themes">
      <li class="dropdown-header"><i class="glyphicon glyphicon-tint"></i> Bootswatch Themes</li>
      <?php foreach ($themes as $theme): ?>
      <?php if(! in_array($theme, $hideInThemeSwitcher)): ?>
      <li<?php echo ($bootswatchTheme == $theme) ? ' class="active"' : '' ?>>
        <a href="?bootswatchTheme=<?php echo $theme ?>"><?php echo ucfirst($theme) ?></a>
      </li>
      <?php endif; ?>
      <?php endforeach; ?>
    </ul>

  </li>
</ul>
<!-- /theme-switcher -->
<?php endif; ?>
