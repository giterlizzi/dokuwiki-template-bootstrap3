<?php
/**
 * DokuWiki Bootstrap3 Template: Administration Menu
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

global $ID, $auth;

if (bootstrap3_conf('showAdminMenu')):

$admin_plugins        = plugin_list('admin');
$administrative_tasks = array('usermanager', 'acl', 'extension', 'config', 'styling', 'revert', 'popularity');
$additional_plugins   = array_diff($admin_plugins, $administrative_tasks);

$plugins = array(
  tpl_getLang('administrative_tasks') => $administrative_tasks,
  tpl_getLang('additional_plugins')   => $additional_plugins
);

?>
<ul class="nav navbar-nav">
  <li class="dropdown dropdown-large">

    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="<?php echo $lang['btn_admin'] ?>">
      <i class="fa fa-fw fa-cogs"></i>  <span class="hidden-lg hidden-md hidden-sm"><?php echo $lang['btn_admin'] ?></span> <span class="caret"></span>
    </a>

    <ul class="dropdown-menu dropdown-menu-large" role="menu">
      <li class="open dropdown-row">

        <?php foreach ($plugins as $name => $items): if (! count($items)) continue ?>

        <ul class="dropdown-menu col-sm-<?php echo (count($additional_plugins) > 0) ? '6' : '12' ?>">

          <li class="dropdown-header">
            <i class="fa fa-fw fa-cog"></i> <?php echo ucfirst($name) ?>
          </li>

          <?php

            foreach($items as $item) {

              if (($plugin = plugin_load('admin', $item)) === null) continue;
              if ($plugin->forAdminOnly() && !$INFO['isadmin']) continue;
              if ($item == 'usermanager' && ! ($auth && $auth->canDo('getUsers'))) continue;

              $label = $plugin->getMenuText($conf['lang']);

              if (! $label) continue;

              switch ($item) {
                case 'usermanager': $icon = 'users'; break;
                case 'acl':         $icon = 'key'; break;
                case 'extension':   $icon = 'plus'; break;
                case 'config':      $icon = 'cogs'; break;
                case 'styling':     $icon = 'paint-brush'; break;
                case 'revert':      $icon = 'refresh'; break;
                case 'popularity':  $icon = 'envelope'; break;

                case 'sqlite':      $icon = 'database'; break;
                case 'tagging':     $icon = 'tags'; break;
                case 'upgrade':     $icon = 'cloud-download'; break;
                case 'smtp':        $icon = 'envelope-o'; break;
                case 'searchindex': $icon = 'sitemap'; break;
                case 'discussion':  $icon = 'comments'; break;
                default:            $icon = 'puzzle-piece';
              }

              echo sprintf('<li><a href="%s" title="%s"><i class="fa fa-fw fa-%s"></i> %s</a></li>',
                           wl($ID, array('do' => 'admin', 'page' => $item)), $label, $icon, $label);

            }

          ?>

        </ul>
        <?php endforeach; ?>
      </li>
    </ul>
  </li>
</ul>
<?php endif; ?>
