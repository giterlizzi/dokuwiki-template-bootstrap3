<?php
/**
 * DokuWiki Bootstrap3 Template: Page Tools
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// class="panel panel-default" data-spy="affix" data-offset-top="60" data-offset-bottom="200"

?>
<?php if ($showPageTools): ?>
<div id="dokuwiki__pagetools" class="hidden-print">
  <div class="tools">
    <ul class="nav nav-stacked nav-pills">
      <?php 
        $tools = bootstrap3_tools_menu();
        unset($tools['page']['menu']['top']);
        ob_start();
        tpl_toolsevent('pagetools', $tools['page']['menu']);
        $tools_menu = ob_get_clean();
        $tools_menu = str_replace(array('class="action', '</i>', '</a>'), array('class="action text-muted', '</i><span class="sr-only">', '</span></a>'), $tools_menu);
        echo $tools_menu;
      ?>
    </ul>
  </div>
</div>
<?php endif; ?>
