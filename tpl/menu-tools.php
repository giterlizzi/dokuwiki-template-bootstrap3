<?php
/**
 * DokuWiki Bootstrap3 Template: Tools Menu
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

global $TEMPLATE, $ID;

if ($TEMPLATE->getConf('showTools')):

$navbar_labels = $TEMPLATE->getConf('navbarLabels');
$tools_menus   = $TEMPLATE->getToolsMenu();

?>
<!-- tools-menu -->
<ul class="nav navbar-nav dw-action-icon" id="dw__tools">

    <?php if ($TEMPLATE->getConf('individualTools')): foreach($tools_menus as $tool => $data): ?>

    <li class="dropdown">

        <a href="<?php wl($ID) ?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" title="<?php echo $lang[$tool.'_tools'] ?>" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="<?php echo $data['icon'] ?>"></i> <span class="<?php echo (in_array($tool, $navbar_labels) ? '' : 'hidden-lg hidden-md hidden-sm') ?>"><?php echo $lang[$tool.'_tools'] ?></span> <span class="caret"></span>
        </a>

        <ul class="dropdown-menu tools" role="menu">

            <li class="dropdown-header hidden-xs hidden-sm">
                <i class="<?php echo $data['icon'] ?>"></i> <?php echo $lang[$tool.'_tools'] ?>
            </li>
            <?php

                foreach ($data['menu'] as $type => $item) {
                    echo $item;
                }

            ?>

        </ul>
    </li>

    <?php endforeach; else: ?>

    <li class="dropdown">

        <a href="<?php wl($ID) ?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" title="<?php $lang['tools'] ?>" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="mdi mdi-wrench"></i> <span class="<?php echo (in_array('tools', $navbar_labels) ? '' : 'hidden-lg hidden-md hidden-sm') ?>"><?php echo $lang['tools'] ?></span> <span class="caret"></span>
        </a>

        <ul class="dropdown-menu tools" role="menu">
        <?php $i = 1; $max = count(array_keys($tools_menus)); foreach($tools_menus as $tool => $data): ?>

            <li class="dropdown-header">
                <i class="<?php echo $data['icon'] ?>"></i> <?php echo $lang[$tool.'_tools'] ?>
            </li>

            <?php

                foreach ($data['menu'] as $type => $item) {
                    echo $item;
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
<?php endif; ?>
