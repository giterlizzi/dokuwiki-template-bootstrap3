<?php

/**
 * DokuWiki Bootstrap3 Template: Tools Menu
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

?>
<?php if ($showTools): ?>
<ul class="nav navbar-nav" id="dw__tools">
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="<?php echo $lang['tools']; ?>"><i class="glyphicon glyphicon-wrench"></i> <span class="hidden-lg hidden-md hidden-sm"><?php echo $lang['tools']; ?></span> <span class="caret"></span></a>
    <ul class="dropdown-menu tools" role="menu">

      <!-- dokuwiki__usertools -->
      <li class="dropdown-header"><i class="glyphicon glyphicon-user"></i> <?php echo $lang['user_tools'] ?></li>
      <?php _tpl_toolsevent('usertools', array(
        'admin'    => _tpl_action_item('admin', 'glyphicon glyphicon-cog'),
        'profile'  => _tpl_action_item('profile', 'glyphicon glyphicon-refresh'),
#        'register' => _tpl_action_item('register', 'glyphicon glyphicon-edit'),
#        'login'    => _tpl_action_item('login', 'glyphicon glyphicon-log-'.(!empty($_SERVER['REMOTE_USER']) ? 'out' : 'in')),
      )); ?>

      <li class="divider"></li>

      <!-- dokuwiki__sitetools -->
      <li class="dropdown-header"><i class="glyphicon glyphicon-cog"></i> <?php echo $lang['site_tools'] ?></li>
      <?php _tpl_toolsevent('sitetools', array(
        'recent' => _tpl_action_item('recent', 'glyphicon glyphicon-list-alt'),
        'media'  => _tpl_action_item('media', 'glyphicon glyphicon-picture'),
        'index'  => _tpl_action_item('index', 'glyphicon glyphicon-list'),
      )); ?>

      <li class="divider"></li>

      <!-- dokuwiki__pagetools -->
      <li class="dropdown-header"><i class="glyphicon glyphicon-file"></i> <?php echo $lang['page_tools'] ?></li>
      <?php _tpl_toolsevent('pagetools', array(
        'edit'       => _tpl_action_item('edit', 'glyphicon glyphicon-edit'),
        'discussion' => _tpl_action_item('discussion', 'glyphicon glyphicon-comment'),
        'revert'     => _tpl_action_item('revert', 'glyphicon glyphicon-repeat'),
        'revisions'  => _tpl_action_item('revisions', 'glyphicon glyphicon-time'),
        'backlink'   => _tpl_action_item('backlink', 'glyphicon glyphicon-link'),
        'subscribe'  => _tpl_action_item('subscribe', 'glyphicon glyphicon-bookmark'),
        'top'        => _tpl_action_item('top', 'glyphicon glyphicon-chevron-up'),
      )); ?>

    </ul>
  </li>
</ul>
<?php endif ?>