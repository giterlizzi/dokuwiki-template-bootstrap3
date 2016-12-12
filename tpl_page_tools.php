<?php
/**
 * DokuWiki Bootstrap3 Template: Page Tools
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

?>
<?php if (bootstrap3_conf('showPageTools')): ?>

<div id="dw__pagetools" class="hidden-print">
  <div class="tools panel panel-default pull-right <?php echo ((bootstrap3_conf('pageToolsAnimation')) ? 'tools-animation' : '') ?>">
    <ul class="nav nav-stacked nav-pills">
      <?php
        $tools = bootstrap3_tools();
        unset($tools['page']['menu']['top']);
        $tools_menu = bootstrap3_toolsevent('pagetools', $tools['page']['menu'], 'main', true);
        $tools_menu = str_replace(array('class="action', '</i>', '</a>'),
                                  array('class="action text-muted', '</i><span class="sr-only">', '</span></a>'),
                                  $tools_menu);
        echo $tools_menu;
      ?>
    </ul>
  </div>
</div>
<?php endif; ?>
