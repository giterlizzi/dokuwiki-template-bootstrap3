<?php

/**
 * DokuWiki Bootstrap3 Template: User Menu
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */


use dokuwiki\plugin\extension\Exception as ExtensionException;
use dokuwiki\plugin\extension\Local;
use dokuwiki\plugin\extension\Repository;

global $INFO, $lang, $TPL;

$use_avatar = $TPL->getConf('useAvatar');

$extensions_update = array();
$avatar_size       = 96;
$avatar_size_small = 32;

if ($use_avatar) {
    $avatar_img_small = $TPL->getAvatar($_SERVER['REMOTE_USER'], $INFO['userinfo']['mail'], $avatar_size_small);
    $avatar_img       = $TPL->getAvatar($_SERVER['REMOTE_USER'], $INFO['userinfo']['mail'], $avatar_size);
} else {
    $avatar_img = tpl_getMediaFile(array('images/avatar.png'));
}

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

if ($INFO['isadmin'] && $TPL->getConf('notifyExtensionsUpdate')) {
    if (class_exists(Local::class)) {
        // new extension manager since Librarian
        try {
            $extensions = (new Local())->getExtensions();
            Repository::getInstance()->initExtensions(array_keys($extensions));
            foreach ($extensions as $extension) {
                if ($extension->isEnabled() && $extension->isUpdateAvailable()) {
                    $extensions_update[] = $extension->getDisplayName();
                }
            }
        } catch (ExtensionException $ignore) {
            // Ignore the exception
        }
    } else {
        // old extension manager until Kaos
        /** @var $plugin_controller PluginController */
        global $plugin_controller;
        if ($extension = plugin_load('helper', 'extension_extension')) {

            foreach ($plugin_controller->getList('', true) as $plugin) {
                $extension->setExtension($plugin);
                if ($extension->updateAvailable() && $extension->isEnabled()) {
                    $extensions_update[] = $extension->getDisplayName();
                }
            }
        }
    }

    sort($extensions_update);
}

?>
<!-- user-menu -->
<ul class="nav navbar-nav" id="dw__user_menu">
    <li class="dropdown">

        <a href="<?php wl($ID) ?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <?php if ($use_avatar): ?>
            <img alt="<?php echo hsc($_SERVER['REMOTE_USER']) ?>" src="<?php echo $avatar_img_small ?>" class="img-circle profile-image" width="<?php echo $avatar_size_small ?>" height="<?php echo $avatar_size_small ?>" />
            <?php else: ?>
            <?php echo iconify('mdi:account'); ?>
            <?php endif; ?> <span class="hidden-lg hidden-md hidden-sm"><?php echo hsc($_SERVER['REMOTE_USER']) ?></span> <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">

            <li>

                <div class="container-fluid">

                    <p class="text-right">
                        <span style="cursor:help" class="label label-<?php echo $label_type; ?>" title="<?php echo tpl_getLang('user_groups'); ?>: <?php echo join(', ', $INFO['userinfo']['grps']); ?>">
                            <?php echo $user_type; ?>
                        </span>
                    </p>

                    <p class="text-center">
                        <img alt="<?php echo hsc($_SERVER['REMOTE_USER']) ?>" src="<?php echo $avatar_img ?>" class="img-circle" width="<?php echo $avatar_size ?>" height="<?php echo $avatar_size ?>" />
                    </p>

                    <div class="mb-2">
                        <div class="mb-2">
                            <strong><?php echo hsc($INFO['userinfo']['name']) ?></strong>
                        </div>
                        <div class="small">
                            <bdi><?php echo hsc($_SERVER['REMOTE_USER']) ?></bdi>
                        </div>
                        <div class="small">
                            <?php echo $INFO['userinfo']['mail'] ?>
                        </div>
                    </div>

                </div>

            </li>

            <li class="divider"></li>

            <?php if ($TPL->getConf('showUserHomeLink')): ?>
            <li class="dropdown-header">Home-Page</li>
            <?php
                if ($userhomepage = $TPL->getPlugin('userhomepage')):
                    echo '<li><a rel="nofollow" href="' . wl($userhomepage->getPublicID()) . '" title="'. $userhomepage->getLang('publicpage') .'">' .
                         iconify('mdi:home') . ' ' . $userhomepage->getLang('publicpage') .'</a></li>';

                    echo '<li><a rel="nofollow" href="' . wl($userhomepage->getPrivateID()) . '" title="'. $userhomepage->getLang('privatenamespace') .'">' .
                         iconify('mdi:home-account') . ' ' . $userhomepage->getLang('privatenamespace') .'</a></li>';
                else:
            ?>

            <li>
                <a href="<?php echo $TPL->getUserHomePageLink() ?>" title="Home-Page" rel="nofollow">
                    <?php echo iconify('mdi:home-account'); ?> Home-Page
                </a>
            </li>

            <?php endif; ?>
            <li class="divider"></li>
            <?php endif; ?>

            <li class="dropdown-header"><?php echo $lang['user_tools'] ?></li>

            <?php

                echo $TPL->getToolMenuItemLink('user', 'profile');

                if ($INFO['isadmin']) {
                    echo $TPL->getToolMenuItemLink('user', 'admin');
                }

            ?>

            <?php if ($INFO['isadmin'] && count($extensions_update)): ?>
            <li>
                <a href="<?php echo wl($ID, array('do' => 'admin', 'page' => 'extension')); ?>" title=" - <?php echo implode('&#13; - ', $extensions_update) ?>">
                    <?php echo iconify('mdi:puzzle', array('class' => 'text-success')) ?> <?php echo tpl_getLang('extensions_update'); ?> <span class="badge"><?php echo count($extensions_update) ?></span>
                </a>
            </li>
            <?php endif; ?>

            <li class="divider"></li>

            <?php

                // Add the user menu

                $usermenu_pageid = null;
                $user_homepage_id = $TPL->getUserHomePageID();

                foreach (array("$user_homepage_id:usermenu", 'usermenu') as $id) {
                    $usermenu_pageid = page_findnearest($id, $TPL->getConf('useACL'));
                    if ($usermenu_pageid) break;
                }

                if ($usermenu_pageid) {

                    $html = new simple_html_dom;
                    $html->load($TPL->includePage($usermenu_pageid, true), true, false);

                    foreach ($html->find('h1,h2,h3,h4,h5,h6') as $elm) {
                        $elm->outertext = '<li class="dropdown-header">' . $elm->innertext . '</li>';
                    }
                    foreach ($html->find('hr') as $elm) {
                        $elm->outertext = '<li class="divider"></li>';
                    }
                    foreach ($html->find('ul') as $elm) {
                        $elm->outertext = '' . $elm->innertext;
                    }
                    foreach ($html->find('div') as $elm) {
                        $elm->outertext = $elm->innertext;
                    }

                    $content = $html->save();

                    $html->clear();
                    unset($html);

                    $content = str_replace('urlextern', '', $content);

                    echo $content;
                    echo '<li class="divider"></li>';

                }
            ?>

            <?php
                echo $TPL->getToolMenuItemLink('user', 'logout');
            ?>

        </ul>
    </li>
</ul>
<!-- /user-menu -->
