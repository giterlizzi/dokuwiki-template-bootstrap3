<?php
/**
 * DokuWiki Bootstrap3 Template: Navbar
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

?>
<nav class="navbar <?php echo (($fixedTopNavbar) ? 'navbar-fixed-top' : '') ?> <?php echo (($inverseNavbar) ? 'navbar-inverse' : 'navbar-default') ?>" role="navigation">

  <div class="container<?php echo ($fluidContainer || ($fluidContainer && ! $fixedTopNavbar) || (! $fluidContainer && ! $fixedTopNavbar)) ? '-fluid' : '' ?>">

    <div class="navbar-header">

      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <?php

        // get logo either out of the template images folder or data/media folder
        $logoSize  = array();
        $logo      = tpl_getMediaFile(array(':wiki:logo.png', ':logo.png', 'images/logo.png'), false, $logoSize);
        $title     = $conf['title'];
        $tagline   = ($conf['tagline']) ? '<span id="dw__tagline">'.$conf['tagline'].'</span>' : '';
        $logo_size = 'height="20"';

        if ($tagline) {
          $logo_size = 'height="32" style="margin-top:-5px"';
        }

        // display logo and wiki title in a link to the home page
        tpl_link(
            wl(),
            '<img src="'.$logo.'" alt="'.$title.'" class="pull-left" id="dw__logo" '.$logo_size.' /> <span id="dw__title" '.($tagline ? 'style="margin-top:-5px"': '').'>'. $title . $tagline .'</span>',
            'accesskey="h" title="[H]" class="navbar-brand"'
        );

      ?>

    </div>

    <div class="collapse navbar-collapse">

      <?php if (bootstrap3_conf('showHomePageLink')) :?>
      <ul class="nav navbar-nav">
        <li<?php echo ((wl($ID) == wl()) ? ' class="active"' : ''); ?>>
          <?php tpl_link(wl(), '<i class="fa fa-fw fa-home"></i> Home') ?>
        </li>
      </ul>
      <?php endif; ?>

      <?php echo bootstrap3_navbar() // Include the navbar for different namespaces ?>
      <?php echo bootstrap3_dropdown_page('dropdownpage') ?>

      <?php if(file_exists(dirname(__FILE__) . '/navbar.html') && bootstrap3_conf('useLegacyNavbar')): ?>
      <ul class="nav navbar-nav">
        <?php tpl_includeFile('navbar.html') ?>
      </ul>
      <?php endif; ?>

      <div class="navbar-right">

        <?php if ($showSearchForm): ?>
          <?php bootstrap3_searchform() ?>
        <?php endif; ?>

        <?php
          // Admin Menu
          include_once(dirname(__FILE__).'/tpl_admin.php');

          // Tools Menu
          include_once(dirname(__FILE__).'/tpl_tools_menu.php');

          // Theme Switcher Menu
          include_once(dirname(__FILE__).'/tpl_theme_switcher.php');

          // Translation Menu
          include_once(dirname(__FILE__).'/tpl_translation.php');
        ?>

        <ul class="nav navbar-nav">

          <?php if ($fluidContainerBtn): ?>
          <li class="hidden-xs<?php echo (bootstrap3_fluid_container_button() ? ' active' : '')?>">
            <a href="#" class="fluid-container" title="<?php echo tpl_getLang('expand_container') ?>"><i class="fa fa-fw fa-arrows-alt"></i><span class="hidden-lg hidden-md hidden-sm"> <?php echo tpl_getLang('expand_container') ?></span></a>
          </li>
          <?php endif; ?>

          <?php if (empty($_SERVER['REMOTE_USER'])): ?>
          <li>
            <span class="dw__actions">
              <?php

                echo bootstrap3_action_item('register', 'fa fa-fw fa-user-plus', true);

                if ($showLoginLink) {
                  echo bootstrap3_action_item('login', 'fa fa-fw fa-sign-in', true);
                }

              ?>
            </span>
          </li>
          <?php endif; ?>

        </ul>

        <?php include_once(dirname(__FILE__).'/tpl_user_menu.php'); ?>

      </div>

    </div>
  </div>
</nav>

