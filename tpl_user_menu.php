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

if (! empty($_SERVER['REMOTE_USER'])):

$use_gravatar = bootstrap3_conf('useGravatar');

if ($use_gravatar) {
  $gravatar_img_small = ml(get_gravatar($INFO['userinfo']['mail'], 30).'&.jpg', array('cache' => 'recache', 'w' => 30, 'h' => 30));
  $gravatar_img       = ml(get_gravatar($INFO['userinfo']['mail'], 64).'&.jpg', array('cache' => 'recache', 'w' => 64, 'h' => 64));
}

?>
<ul class="nav navbar-nav" id="dw__user_menu">
  <li class="dropdown dropdown-large">

    <a href="<?php wl($ID) ?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
      <?php if ($use_gravatar): ?>
        <img src="<?php echo $gravatar_img_small ?>" class="img-circle profile-image" width="30" height="30" />
      <?php else: ?>
        <i class="fa fa-fw fa-user"></i>
      <?php endif; ?> <span class="hidden-lg hidden-md hidden-sm"><?php echo hsc($_SERVER['REMOTE_USER']) ?></span> <span class="caret"></span>
    </a>

    <ul class="dropdown-menu dropdown-menu-large" role="menu">

      <li class="dropdown-header">
        <h4 class="page-header"><?php echo hsc($INFO['userinfo']['name']) ?> <small><?php echo hsc($_SERVER['REMOTE_USER']) ?></small></h4>
      </li>

      <li class="open dropdown-row">

        <ul class="dropdown-menu" style="min-width:64px">
          <li class="dropdown-header">
            <?php if ($use_gravatar): ?>
              <img src="<?php echo $gravatar_img ?>" class="img-circle" width="64" height="64" />
            <?php else: ?>
              <i class="fa fa-fw fa-user fa-4x">&nbsp;</i>
            <?php endif; ?>
          </li>
        </ul>

        <ul class="dropdown-menu">
          <?php if (bootstrap3_conf('showUserHomeLink')): ?>
          <?php
            if ($userhomepageHelper = plugin_load('helper','userhomepage')):
                echo '<li class="dropdown-header">Home-Page</li>' .
                     '<li>' .
                     $userhomepageHelper->getPublicLink('<i class="fa fa-fw fa-home"></i> Public') .
                     $userhomepageHelper->getPrivateLink('<i class="fa fa-fw fa-user-secret"></i> Private') .
                     '</li>' .
                     '<li><hr/></li>';
            else:
            ?>
            <li>
              <a href="<?php echo bootstrap3_user_homepage_link() ?>" title="Home-Page" rel="nofollow">
                <i class="fa fa-fw fa-home"></i> Home-Page
              </a>
            </li>
            <?php endif; endif; ?>
          <li>
            <a href="mailto:<?php echo $INFO['userinfo']['mail'] ?>" title="<?php echo $INFO['userinfo']['mail'] ?>">
              <i class="fa fa-fw fa-envelope"></i> <?php echo $INFO['userinfo']['mail'] ?>
            </a>
          </li>
          <?php echo bootstrap3_action_item('admin', 'fa fa-fw fa-cogs') ?>
          <?php echo bootstrap3_action_item('profile', 'fa fa-fw fa-refresh') ?>
        </ul>

      </li>
      <?php echo bootstrap3_action_item('login', 'fa fa-fw fa-power-off text-danger'); ?>
    </ul>
  </li>
</ul>
<?php endif; ?>
