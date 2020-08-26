<?php
/**
 * DokuWiki Bootstrap3 Template: Administration Menu
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

global $ID, $INPUT, $auth, $TPL;

if ($TPL->getConf('showAdminMenu')):

$admin_plugins        = plugin_list('admin');
$administrative_tasks = array('usermanager', 'acl', 'extension', 'config', 'styling', 'revert', 'popularity');
$additional_plugins   = array_diff($admin_plugins, $administrative_tasks);

$admin = array(
    'administrative_tasks' => array(
        'label'   => tpl_getLang('administrative_tasks'),
        'icon'    => 'mdi:settings',
        'plugins' => $administrative_tasks
    ),
    'additional_plugins' => array(
        'label'   => tpl_getLang('additional_plugins'),
        'icon'    => 'mdi:puzzle',
        'plugins' => $additional_plugins
    ),
);

?>
<!-- admin -->
<ul class="nav navbar-nav" id="dw__admin">
    <li class="dropdown dropdown-large">

        <a href="<?php wl($ID) ?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" title="<?php echo $lang['btn_admin'] ?>" role="button" aria-haspopup="true" aria-expanded="false">
            <?php echo iconify('mdi:settings'); ?> <span class="<?php echo (in_array('admin', $TPL->getConf('navbarLabels')) ? '' : 'hidden-lg hidden-md hidden-sm') ?>"> <?php echo $lang['btn_admin'] ?></span> <span class="caret"></span>
        </a>

        <ul class="dropdown-menu dropdown-menu-large" role="menu">
            <li class="open dropdown-row">

                <?php foreach ($admin as $key => $items): if (! count($items['plugins'])) continue ?>

                <ul class="dropdown-menu col-sm-<?php echo (count($additional_plugins) > 0) ? '6' : '12' ?>">

                    <li class="dropdown-header">
                        <?php echo iconify($items['icon']) ?> <?php echo ucfirst($items['label']) ?>
                    </li>

                    <?php

                        foreach($items['plugins'] as $item) {

                            if (($plugin = plugin_load('admin', $item)) === null) continue;
                            if ($plugin->forAdminOnly() && !$INFO['isadmin']) continue;
                            if ($item == 'usermanager' && ! ($auth && $auth->canDo('getUsers'))) continue;

                            $label = $plugin->getMenuText($conf['lang']);

                            if (method_exists($plugin, 'getMenuIcon')) {
                                $icon = $plugin->getMenuIcon();
                                if (! file_exists($icon)) {
                                    $icon = tpl_incdir() . 'images/menu/puzzle.svg';
                                }
                            } else {
                                $icon = tpl_incdir() . 'images/menu/puzzle.svg';
                            }

                            if (! $label) continue;

                            echo '<li class="menuitem ' . (($INPUT->str('page') == $item) ? 'active' : '') . '">' .
                                 '<a href="'. wl($ID, array('do' => 'admin', 'page' => $item)) .'" title="'. $label .'" class="admin '. $item .'">' .
                                 inlineSVG($icon) . ' ' . $label .
                                 '</a></li>';

                        }

                    ?>

                </ul>
                <?php endforeach; ?>
            </li>
        </ul>
    </li>
</ul>
<!-- /admin -->
<?php endif; ?>
