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

global $lang;

$navbar_labels    = bootstrap3_conf('navbarLabels');
$navbar_classes   = array();
$navbar_classes[] = (bootstrap3_conf('fixedTopNavbar') ? 'navbar-fixed-top' : null);
$navbar_classes[] = (bootstrap3_conf('inverseNavbar')  ? 'navbar-inverse'   : 'navbar-default');

?>
<nav class="navbar <?php echo trim(implode(' ', $navbar_classes)) ?>" role="navigation">

  <div class="container<?php echo (bootstrap3_is_fluid_navbar() ? '-fluid' : '') ?>">

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
            '<img src="'.$logo.'" alt="'.$title.'" class="pull-left'.(($tagline) ? ' dw-logo-tagline' : '').'" id="dw__logo" '.$logo_size.' /> <span id="dw__title" '.($tagline ? 'style="margin-top:-5px"': '').'>'. $title . $tagline .'</span>',
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

        <?php bootstrap3_searchform() ?>

        <?php
          // Admin Menu
          include_once(dirname(__FILE__).'/tpl_admin.php');

          // Tools Menu
          include_once(dirname(__FILE__).'/tpl_tools_menu.php');

          // Theme Switcher Menu
          include_once(dirname(__FILE__).'/tpl_theme_switcher.php');

          // Translation Menu
          include_once(dirname(__FILE__).'/tpl_translation.php');

          // Add New Page
          include_once(dirname(__FILE__).'/tpl_new_page.php');
        ?>

        <ul class="nav navbar-nav">

          <?php if (bootstrap3_conf('showEditBtn')): ?>
          <li class="dw-action-icon hidden-xs">
            <?php tpl_actionlink('edit', '<span class="sr-only">', '</span>'); ?>
          </li>
          <?php endif; ?>

          <?php if (bootstrap3_conf('fluidContainerBtn')): ?>
          <li class="hidden-xs<?php echo (bootstrap3_fluid_container_button() ? ' active' : '')?>">
            <a href="#" class="fluid-container" title="<?php echo tpl_getLang('expand_container') ?>"><i class="fa fa-fw fa-arrows-alt"></i><span class="<?php echo (in_array('expand', bootstrap3_conf('navbarLabels')) ? '' : 'hidden-lg hidden-md hidden-sm') ?>"> <?php echo tpl_getLang('expand_container') ?></span></a>
          </li>
          <?php endif; ?>

          <?php if (empty($_SERVER['REMOTE_USER'])): ?>
          <li>
            <span class="dw__actions dw-action-icon">
              <?php

                $register_label = sprintf('<span class="%s">%s</span>', (in_array('register', $navbar_labels) ? null : 'sr-only'), $lang['btn_register']);
                $login_label    = sprintf('<span class="%s">%s</span>', (in_array('login', $navbar_labels) ? null : 'sr-only'), $lang['btn_login']);

                $register_btn = tpl_actionlink('register', null, null, $register_label, true);
                $register_btn = str_replace('action', 'action btn btn-success navbar-btn', $register_btn);
                echo $register_btn;

                if (! bootstrap3_conf('hideLoginLink')) {
                  $login_btn = tpl_actionlink('login', null, null, $login_label, true);
                  $login_btn = str_replace('action', 'action btn btn-default navbar-btn', $login_btn);
                  echo $login_btn;
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

