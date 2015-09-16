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

$gravatar_check = false;

if ($useGravatar) {

  $HTTP = new DokuHTTPClient();

  $gravatar_img_small = get_gravatar($INFO['userinfo']['mail'], 30);
  $gravatar_img       = get_gravatar($INFO['userinfo']['mail'], 64);
  $gravatar_check     = $HTTP->get($gravatar_img . '&d=404');

}

?>
<?php if (! empty($_SERVER['REMOTE_USER'])): ?>
<ul class="nav navbar-nav" id="dw__user_menu">
  <li class="dropdown">

    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="">
      <?php if ($gravatar_check): ?>
        <img src="<?php echo $gravatar_img_small ?>" class="img-circle profile-image" />
      <?php else: ?>
        <i class="fa fa-fw fa-user"></i>
      <?php endif; ?> <span class="caret"></span>
    </a>

    <ul class="dropdown-menu" role="menu" style="width: 350px">

      <li class="dropdown-header">
        <h4 class="page-header"><?php echo $INFO['userinfo']['name'] ?> <small><?php echo $_SERVER['REMOTE_USER'] ?></small></h4>
      </li>

      <li class="row">

        <ul class="list-unstyled col-sm-4">
          <li class="dropdown-header">
            <?php if ($gravatar_check): ?>
              <img src="<?php echo $gravatar_img ?>" class="img-circle" />
            <?php else: ?>
              <i class="fa fa-fw fa-user fa-5x"></i>
            <?php endif; ?>
          </li>
        </ul>
        <ul class="nav navbar-nav col-sm-8">
          <?php if($showUserHomeLink): ?>
          <li>
            <a href="<?php echo bootstrap3_user_homepage_link() ?>">
              <i class="fa fa-fw fa-home"></i> Personal Home-Page
            </a>
          </li>
          <?php endif; ?>
          <li>
            <a href="mailto:<?php echo $INFO['userinfo']['mail'] ?>" title="<?php echo $INFO['userinfo']['mail'] ?>">
              <i class="fa fa-fw fa-envelope"></i> <?php echo $INFO['userinfo']['mail'] ?>
            </a>
          </li>
          <?php echo bootstrap3_action_item('profile', 'fa fa-fw fa-refresh') ?>
        </ul>

      </li>

      <li class="divider" role="separator"></li>
      <?php echo bootstrap3_action_item('login', 'fa fa-fw fa-power-off text-danger'); ?>

    </ul>

  </li>

</ul>
<?php endif; ?>