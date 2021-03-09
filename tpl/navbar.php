<?php
/**
 * DokuWiki Bootstrap3 Template: Navbar
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

global $lang;
global $TPL;
global $ACT;

$navbar_labels    = $TPL->getConf('navbarLabels');
$navbar_classes   = [];
$navbar_classes[] = ($TPL->getConf('fixedTopNavbar') ? 'navbar-fixed-top' : null);
$navbar_classes[] = ($TPL->getConf('inverseNavbar') ? 'navbar-inverse' : 'navbar-default');
$home_link        = ($TPL->getConf('homePageURL') ? $TPL->getConf('homePageURL') : wl());

?>
<!-- navbar -->
<nav id="dw__navbar" class="navbar <?php echo trim(implode(' ', $navbar_classes)) ?>" role="navigation">

    <div class="dw-container container<?php echo ($TPL->isFluidNavbar() ? '-fluid mx-5' : '') ?>">

        <div class="navbar-header">

            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <?php

                // get logo either out of the template images folder or data/media folder
                $logo_size = [];
                $logo      = tpl_getMediaFile([':wiki:logo.png', ':logo.png', 'images/logo.png'], false, $logo_size);
                $title     = $conf['title'];
                $tagline   = (($conf['tagline']) ? '<div id="dw__tagline">' . $conf['tagline'] . '</div>' : '');

                $logo_height   = $logo_size[1];
                $nabvar_height = $TPL->getNavbarHeight();

                echo '<a class="navbar-brand d-flex align-items-center" href="' . $home_link . '" accesskey="h" title="' . $title . '">';
                echo '<img id="dw__logo" class="pull-left h-100 mr-4" alt="' . $title . '" src="' . $logo . '" />';
                echo '<div class="pull-right"><div id="dw__title">' . $title . '</div>' . $tagline . '</div>';
                echo '</a>';

            ?>

        </div>

        <div class="collapse navbar-collapse">

            <?php if ($TPL->getConf('showHomePageLink')): ?>
            <ul class="nav navbar-nav">
                <li<?php echo ((wl($ID) == $home_link) ? ' class="active"' : ''); ?>>
                    <?php tpl_link($home_link, iconify('mdi:home') . ' Home')?>
                </li>
            </ul>
            <?php endif;?>

            <?php
                echo $TPL->getNavbar(); // Include the navbar for different namespaces
                echo $TPL->getDropDownPage('dropdownpage');
            ?>

            <div class="navbar-right" id="dw__navbar_items">

                <?php
                    // Search form
                    if (actionOK('search') && $TPL->getConf('showSearchForm')) {
                        include_once 'navbar-searchform.php';
                    }

                    // Tools Menu
                    if ($TPL->getConf('showTools')) {
                        include_once 'menu-tools.php';
                    }

                    // Theme Switcher Menu
                    if ($TPL->getConf('showThemeSwitcher')) {
                        include_once 'theme-switcher.php';
                    }

                    // Translation Menu
                    if ($TPL->getConf('showTranslation') && $ACT == 'show' && $TPL->getPlugin('translation')) {
                        include_once 'translation.php';
                    }

                    // Add New Page
                    if (!plugin_isdisabled('addnewpage') && $ACT == 'show' && $TPL->getConf('showAddNewPage')) {
                        include_once 'new-page.php';
                    }
                ?>

                <ul class="nav navbar-nav">

                    <?php

                        if ($TPL->getConf('showEditBtn')) {

                            $action = null;

                            global $ACT;

                            if ($ACT == 'edit') {
                                $action = 'show';
                            }
                            if ($ACT == 'show') {
                                $action = 'edit';
                            }

                            if ($action && $edit_action = $TPL->getToolMenuItem('page', $action)) {

                                $edit_attr = $edit_action->getLinkAttributes();

                                $edit_html = '<li class="hidden-xs"><a ' . buildAttributes($edit_attr) . '>';
                                $edit_html .= \inlineSVG($edit_action->getSvg());
                                $edit_html .= "</a></li>";

                                echo $edit_html;

                            }

                        }

                    ?>

                    <?php if (empty($_SERVER['REMOTE_USER'])): ?>
                    <li>
                        <span class="dw__actions dw-action-icon">
                        <?php

                            $register_action = $TPL->getToolMenuItem('user', 'register');
                            $login_action    = $TPL->getToolMenuItem('user', 'login');

                            if ($register_action) {

                                $register_attr = $register_action->getLinkAttributes();
                                $register_attr['class'] .= ' btn btn-success navbar-btn';

                                $register_html = '<a ' . buildAttributes($register_attr) . '>';
                                $register_html .= \inlineSVG($register_action->getSvg());
                                $register_html .= '<span class="' . (in_array('register', $navbar_labels) ? null : 'sr-only') . '"> ' . hsc($register_action->getLabel()) . '</span>';
                                $register_html .= "</a>";

                                echo $register_html;

                            }

                            if (!$TPL->getConf('hideLoginLink') && $login_action) {

                                $login_attr = $login_action->getLinkAttributes();
                                $login_attr['class'] .= ' btn btn-default navbar-btn';

                                $login_html = '<a ' . buildAttributes($login_attr) . '>';
                                $login_html .= \inlineSVG($login_action->getSvg());
                                $login_html .= '<span class="' . (in_array('login', $navbar_labels) ? null : 'sr-only') . '"> ' . hsc($login_action->getLabel()) . '</span>';
                                $login_html .= "</a>";

                                echo $login_html;

                            }

                        ?>
                        </span>
                    </li>
                    <?php endif;?>

                </ul>

                <?php if ($TPL->getConf('tocLayout') == 'navbar'): ?>
                <ul class="nav navbar-nav hide" id="dw__toc_menu">
                    <li class="dropdown">
                        <a href="<?php wl($ID)?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" title="<?php echo $lang['toc'] ?>" role="button" aria-haspopup="true" aria-expanded="false">
                        <?php echo iconify('mdi:view-list'); ?> <span class="hidden-lg hidden-md hidden-sm"><?php echo $lang['toc'] ?></span><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu" style="max-height: 400px; overflow-y: auto">
                            <li class="dropdown-header"><?php echo iconify('mdi:view-list'); ?> <?php echo $lang['toc'] ?></li>
                        </ul>
                    </li>
                </ul>
                <?php endif;?>

                <?php
                    if (!empty($_SERVER['REMOTE_USER'])) {
                        // Admin Menu
                        include_once 'menu-admin.php';

                        // User Menu
                        include_once 'menu-user.php';
                    }
                ?>

            </div>

        </div>
    </div>
</nav>
<!-- navbar -->
