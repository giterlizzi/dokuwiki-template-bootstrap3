<?php
/**
 * DokuWiki Bootstrap3 Template: User Menu
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

global $INFO;
global $lang;

if (! empty($_SERVER['REMOTE_USER'])):

$use_avatar = bootstrap3_conf('useAvatar');

$avatar_size       = 96;
$avatar_size_small = 32;

if ($use_avatar) {
  $avatar_img_small = get_avatar($_SERVER['REMOTE_USER'], $INFO['userinfo']['mail'], $avatar_size_small);
  $avatar_img       = get_avatar($_SERVER['REMOTE_USER'], $INFO['userinfo']['mail'], $avatar_size);
} else {
  $avatar_img = tpl_getMediaFile(array('images/avatar.png'));
}

?>
<ul class="nav navbar-nav" id="dw__user_menu">
  <li class="dropdown">

    <a href="<?php wl($ID) ?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
      <?php if ($use_avatar): ?>
        <img src="<?php echo $avatar_img_small ?>" class="img-circle profile-image" width="<?php echo $avatar_size_small ?>" height="<?php echo $avatar_size_small ?>" />
      <?php else: ?>
        <i class="fa fa-fw fa-user"></i>
      <?php endif; ?> <span class="hidden-lg hidden-md hidden-sm"><?php echo hsc($_SERVER['REMOTE_USER']) ?></span> <span class="caret"></span>
    </a>

    <ul class="dropdown-menu" role="menu">

      <li>

        <div class="container-fluid">

          <p class="text-right">
            <?php

              $label_type = 'info';
              $user_type  = 'User';

              if ($INFO['ismanager']) {
                $label_type = 'warning';
                $user_type  = 'Manager';
              }

              if ($INFO['isadmin']) {
                $label_type = 'danger';
                $user_type  = 'Admin';
              }

              echo '<span style="cursor:help" class="label label-' . $label_type . '" title="Groups: '. join(', ', $INFO['userinfo']['grps']) .'">' . $user_type . '</span>';

            ?>
          </p>

          <p class="text-center">
            <img src="<?php echo $avatar_img ?>" class="img-circle" width="<?php echo $avatar_size ?>" height="<?php echo $avatar_size ?>" />
          </p>

          <dl>
            <dt>
              <?php echo hsc($INFO['userinfo']['name']) ?>
            </dt>
            <dd class="small">
              <?php echo hsc($_SERVER['REMOTE_USER']) ?>
            </dd>
            <dd class="small">
              <?php echo $INFO['userinfo']['mail'] ?>
            </dd>
          </dl>

        </div>

      </li>

      <li class="divider"></li>

      <?php if (bootstrap3_conf('showUserHomeLink')): ?>
      <li class="dropdown-header">Home-Page</li>
      <?php
        if ($userhomepage_helper = plugin_load('helper','userhomepage')):
          echo '<li>' .
               $userhomepage_helper->getPublicLink('<i class="fa fa-fw fa-home"></i> ' . $userhomepage_helper->getLang('publicpage')) .
               $userhomepage_helper->getPrivateLink('<i class="fa fa-fw fa-user-secret"></i> ' . $userhomepage_helper->getLang('privatenamespace')) .
               '</li>';
        else:
      ?>

      <li>
        <a href="<?php echo bootstrap3_user_homepage_link() ?>" title="Home-Page" rel="nofollow">
          <i class="fa fa-fw fa-home"></i> Home-Page
        </a>
      </li>

      <?php endif; ?>
      <li class="divider"></li>
      <?php endif; ?>

      <li class="dropdown-header"><?php echo $lang['user_tools'] ?></li>

      <?php echo bootstrap3_action_item('admin', 'fa fa-fw fa-cogs') ?>
      <?php echo bootstrap3_action_item('profile', 'fa fa-fw fa-refresh') ?>

      <li class="divider"></li>

      <?php echo bootstrap3_action_item('login', 'fa fa-fw fa-power-off text-danger'); ?>

    </ul>
  </li>
</ul>
<?php endif; ?>
