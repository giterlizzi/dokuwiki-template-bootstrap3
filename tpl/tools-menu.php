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
$tools_menus   = array(
    'user'   => array('icon' => 'fa fa-fw fa-user',      'menu' => new dokuwiki\Menu\UserMenu),
    'site'   => array('icon' => 'fa fa-fw fa-cubes',     'menu' => new dokuwiki\Menu\SiteMenu),
    'page'   => array('icon' => 'fa fa-fw fa-file',      'menu' => new dokuwiki\Menu\PageMenu),
);

if (defined('DOKU_MEDIADETAIL')) {
    $tools_menus['page'] = array('icon' => 'fa fa-fw fa-picture-o', 'menu' => new dokuwiki\Menu\DetailMenu);
}

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

                foreach ($data['menu']->getItems() as $item) {

                    $attr = buildAttributes($item->getLinkAttributes());
                    $active = '';

                    if ($ACT == $item->getType() || ($ACT == 'revisions' && $item->getType() == 'revs')) {
                        $active = 'active';
                    }

                    $html  = '<li class="' . $active . '">';
                    $html .= "<a $attr>";
                    $html .= inlineSVG($item->getSvg());
                    $html .= '<span>' . hsc($item->getLabel()) . '</span>';
                    $html .= "</a>";
                    $html .= '</li>';

                    echo $html;

                }

            ?>

        </ul>
    </li>

    <?php endforeach; else: ?>

    <li class="dropdown">

        <a href="<?php wl($ID) ?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" title="<?php $lang['tools'] ?>" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-wrench"></i> <span class="<?php echo (in_array('tools', $navbar_labels) ? '' : 'hidden-lg hidden-md hidden-sm') ?>"><?php echo $lang['tools'] ?></span> <span class="caret"></span>
        </a>

        <ul class="dropdown-menu tools" role="menu">
        <?php $i = 1; $max = count(array_keys($tools_menus)); foreach($tools_menus as $tool => $data): ?>

            <li class="dropdown-header">
                <i class="<?php echo $data['icon'] ?>"></i> <?php echo $lang[$tool.'_tools'] ?>
            </li>

            <?php

                foreach ($data['menu']->getItems() as $item) {

                    $attr  = buildAttributes($item->getLinkAttributes());
                    $class = 'action';

                    if ($ACT == $item->getType() || ($ACT == 'revisions' && $item->getType() == 'revs')) {
                        $class = 'action active';
                    }

                    $html  = '<li class="'.$class.'">';
                    $html .= "<a $attr>";
                    $html .= inlineSVG($item->getSvg());
                    $html .= '<span>' . hsc($item->getLabel()) . '</span>';
                    $html .= "</a>";
                    $html .= '</li>';

                    echo $html;

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


<!-- TODO move into template.css -->
<style>

.action svg {
  fill: #141414;
  display: inline-block;
  vertical-align: middle;
  padding-right: 4px;
  width: 20px;
  height: 20px;
}

.action.active svg {
  fill: #fff;
}

.cyborg .action svg ,
.darkly .action svg ,
.slate .action svg ,
.superhero .action svg ,
.solar .action svg {
  fill: #fff;
}

.yeti .dropdown-menu .action svg {
  fill: #fff;
}

.solar .dropdown-menu .action svg {
  fill: #839496;
}

.sandstone .action svg {
  fill: #98978b;
}

.lumen .action svg {
  fill: #555555;
}

.flatly .action svg {
  fill: #7b8a8b;
}

</style>
