<?php
/**
 * DokuWiki Bootstrap3 Template: Tools Menu
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

?>
<?php if ($showTools): $tools = bootstrap3_tools_menu(); ?>

<ul class="nav navbar-nav" id="dw__tools">

<?php if ($editOnNavbar && isset($tools['page']) && $tools['page']['items']['edit']) {
echo _tpl_action_item('edit', 'glyphicon glyphicon-edit');
} ?>

<?php if ($individualTools): foreach($tools as $id => $menu): ?>

  <li class="dropdown">

    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="<?php echo $lang[$id.'_tools'] ?>">
      <i class="<?php echo $menu['icon'] ?>"></i> <span class="hidden-lg hidden-md hidden-sm"><?php echo $lang[$id.'_tools'] ?></span> <span class="caret"></span>
    </a>

    <ul class="dropdown-menu tools" role="menu">

      <li class="dropdown-header hidden-xs hidden-sm">
        <i class="<?php echo $menu['icon'] ?>"></i> <?php echo $lang[$id.'_tools'] ?>
      </li>
      <?php tpl_toolsevent($id.'tools', $menu['menu']) ?>

    </ul>
  </li>

<?php endforeach; else: ?>

  <li class="dropdown">

    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="<?php $lang['tools'] ?>">
      <i class="fa fa-fw fa-wrench"></i> <span class="hidden-lg hidden-md hidden-sm"><?php echo $lang['tools'] ?></span> <span class="caret"></span>
    </a>

    <ul class="dropdown-menu tools" role="menu">
    <?php $i = 1; $max = count(array_keys($tools)); foreach($tools as $id => $menu): ?>

      <li class="dropdown-header">
        <i class="<?php echo $menu['icon'] ?>"></i> <?php echo $lang[$id.'_tools'] ?>
      </li>
      <?php tpl_toolsevent($id.'tools', $menu['menu']) ?>

      <?php if ($max > $i): ?>
      <li class="divider" role="separator"></li>
      <?php endif; ?>

    <?php $i++; endforeach; ?>
    </ul>
  </li>

<?php endif; ?>

</ul>

<?php endif; ?>