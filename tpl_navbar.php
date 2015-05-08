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
        $logo_size = 'width="20" height="20"';

        if ($tagline) {
          $logo_size = 'width="32" height="32" style="margin-top:-5px"';
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

      <ul class="nav navbar-nav">
      <?php tpl_includeFile('navbar.html') ?>
      </ul>

      <div class="navbar-right">

        <?php tpl_searchform() ?>

        <?php if ($showTools): ?>
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title=""><i class="glyphicon glyphicon-wrench"></i> <?php echo $lang['tools']; ?> <span class="caret"></span></a>
            <ul class="dropdown-menu tools" role="menu">

              <!-- dokuwiki__usertools -->
              <li class="dropdown-header"><i class="glyphicon glyphicon-user"></i> <?php echo $lang['user_tools'] ?></li>
              <?php _tpl_toolsevent('usertools', array(
                'admin'    => _tpl_action_item('admin', 'glyphicon glyphicon-cog'),
                'profile'  => _tpl_action_item('profile', 'glyphicon glyphicon-refresh'),
                'register' => _tpl_action_item('register', 'glyphicon glyphicon-edit'),
                'login'    => _tpl_action_item('login', 'glyphicon glyphicon-log-'.(!empty($_SERVER['REMOTE_USER']) ? 'out' : 'in')),
              )); ?>

              <li class="divider"></li>

              <!-- dokuwiki__sitetools -->
              <li class="dropdown-header"><i class="glyphicon glyphicon-cog"></i> <?php echo $lang['site_tools'] ?></li>
              <?php _tpl_toolsevent('sitetools', array(
                'recent' => _tpl_action_item('recent', 'glyphicon glyphicon-list-alt'),
                'media'  => _tpl_action_item('media', 'glyphicon glyphicon-download-alt'),
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

        <?php if ($showThemeSwitcher && $bootstrapTheme == 'bootswatch'): ?>
        <!-- theme-switcher -->
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Themes <span class="caret"></span></a>
            <ul class="dropdown-menu" aria-labelledby="themes">
              <?php foreach (array('cerulean','cosmo','cyborg','darkly','flatly','journal','lumen','paper','readable','sandstone','simplex','slate','spacelab','superhero','united','yeti') as $theme): ?>
              <li<?php echo ($bootswatchTheme == $theme) ? ' class="active"' : '' ?>><a href="?bootswatchTheme=<?php echo $theme ?>"><?php echo ucfirst($theme) ?></a></li>
              <?php endforeach; ?>
            </ul>
          </li>
        </ul>
        <!-- /theme-switcher -->
        <?php endif; ?>

        <ul class="nav navbar-nav">
          <li>
            <?php if (!empty($_SERVER['REMOTE_USER'])) {
              tpl_link(wl('user:'.$_SERVER['REMOTE_USER']), '<i class="glyphicon glyphicon-user"></i><span class="hidden-lg hidden-md hidden-sm"> '. userlink(null, true) . '</span>', 'title="'.userlink(null, true).'"'); /* 'Logged in as ...' */
            } ?>
          </li>
          <?php echo _tpl_action_item('login', 'glyphicon glyphicon-log-'. (!empty($_SERVER['REMOTE_USER']) ? 'out' : 'in')) ?>
         </ul>

      </div>

    </div>
  </div>
</nav>
