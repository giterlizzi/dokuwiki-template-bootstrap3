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
                'admin' => tpl_action('admin', 1, 'li' . (($ACT == 'admin') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-cog"></i> '),
                'profile' => tpl_action('profile', 1, 'li' . (($ACT == 'profile') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-refresh"></i> '),
                'register' => tpl_action('register', 1, 'li' . (($ACT == 'register') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-edit"></i> '),
                'login' => tpl_action('login', 1, 'li' . (($ACT == 'login') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-log-'.(!empty($_SERVER['REMOTE_USER']) ? 'out' : 'in').'"></i> '),
              )); ?>

              <li class="divider"></li>

              <!-- dokuwiki__sitetools -->
              <li class="dropdown-header"><i class="glyphicon glyphicon-cog"></i> <?php echo $lang['site_tools'] ?></li>
              <?php _tpl_toolsevent('sitetools', array(
                'recent' => tpl_action('recent', 1, 'li' . (($ACT == 'recent') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-list-alt"></i> '),
                'media' => tpl_action('media', 1, 'li' . (($ACT == 'media') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-download-alt"></i> '),
                'index' => tpl_action('index', 1, 'li' . (($ACT == 'index') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-list"></i> '),
              )); ?>

              <li class="divider"></li>

              <!-- dokuwiki__pagetools -->
              <li class="dropdown-header"><i class="glyphicon glyphicon-file"></i> <?php echo $lang['page_tools'] ?></li>
              <?php _tpl_toolsevent('pagetools', array(
                'edit' => tpl_action('edit', 1, 'li' . (($ACT == 'edit') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-edit"></i> '),
                'revert' => tpl_action('revert', 1, 'li' . (($ACT == 'revert') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-repeat"></i> '),
                'revisions' => tpl_action('revisions', 1, 'li' . (($ACT == 'revisions') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-time"></i> '),
                'backlink' => tpl_action('backlink', 1, 'li' . (($ACT == 'backlink') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-link"></i> '),
                'subscribe' => tpl_action('subscribe', 1, 'li' . (($ACT == 'subscribe') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-bookmark"></i> '),
                'top' => tpl_action('top', 1, 'li' . (($ACT == 'top') ? ' class="active"' : ''), 1, '<i class="glyphicon glyphicon-chevron-up"></i> '),
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
          <li>
            <?php echo tpl_action('login', 1, '', 1, '<i class="glyphicon glyphicon-log-'. (!empty($_SERVER['REMOTE_USER']) ? 'out' : 'in') .'"></i> ') ?>
          </li>
        </ul>

      </div>

    </div>
  </div>
</nav>
