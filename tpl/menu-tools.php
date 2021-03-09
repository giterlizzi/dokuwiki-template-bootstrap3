<?php
/**
 * DokuWiki Bootstrap3 Template: Tools Menu
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

global $TPL, $ID;

$navbar_labels = $TPL->getConf('navbarLabels');
$tools_menus   = $TPL->getToolsMenu();

?>
<!-- tools-menu -->
<ul class="nav navbar-nav dw-action-icon" id="dw__tools">

    <?php

        if ($TPL->getConf('individualTools')):

            foreach ($TPL->getConf('showIndividualTool') as $tool):

                if (! isset($tools_menus[$tool])) continue;

                $data = $tools_menus[$tool];

                if (! isset($data['menu'])) continue;
    ?>

    <li class="dropdown">

        <a href="<?php wl($ID) ?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" title="<?php echo $lang[$tool.'_tools'] ?>" role="button" aria-haspopup="true" aria-expanded="false">
            <?php echo iconify($data['icon']); ?> <span class="<?php echo (in_array($tool, $navbar_labels) ? '' : 'hidden-lg hidden-md hidden-sm') ?>"><?php echo $lang[$tool.'_tools'] ?></span> <span class="caret"></span>
        </a>

        <ul class="dropdown-menu tools" role="menu">

            <li class="dropdown-header hidden-xs hidden-sm">
                <?php echo iconify($data['icon']); ?> <?php echo $lang[$tool.'_tools'] ?>
            </li>
            <?php
                foreach ($data['menu'] as $type => $item) {
                    echo $item['html'];
                }
            ?>

        </ul>
    </li>

    <?php endforeach; else: ?>

    <li class="dropdown">

        <a href="<?php wl($ID) ?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" title="<?php $lang['tools'] ?>" role="button" aria-haspopup="true" aria-expanded="false">
            <?php echo iconify('mdi:wrench'); ?> <span class="<?php echo (in_array('tools', $navbar_labels) ? '' : 'hidden-lg hidden-md hidden-sm') ?>"><?php echo $lang['tools'] ?></span> <span class="caret"></span>
        </a>

        <ul class="dropdown-menu tools" role="menu">
            <?php

                $i   = 1;
                $max = count(array_keys($tools_menus));

                foreach($tools_menus as $tool => $data):

                    if (! isset($data['menu'])) continue;
            ?>

            <li class="dropdown-header">
                <?php echo iconify($data['icon']); ?> <?php echo $lang[$tool.'_tools'] ?>
            </li>

            <?php
                foreach ($data['menu'] as $type => $item) {
                    echo $item['html'];
                }
            ?>

            <?php if ($max > $i): ?>
            <li class="divider" role="separator"></li>
            <?php endif; ?>

        <?php $i++; endforeach; ?>
        </ul>
    </li>

    <?php endif; ?>

</ul>
<!-- /tools-menu -->
