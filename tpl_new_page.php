<?php
/**
 * DokuWiki Bootstrap3 Template: Add New Page Plugin
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

global $ID;

if (! plugin_isdisabled('addnewpage') && $ACT == 'show' && bootstrap3_conf('showAddNewPage')):

?>
<ul class="nav navbar-nav" id="dw__addnewpage">
  <li class="dropdown">
    <a href="<?php wl($ID) ?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" title="<?php echo tpl_getLang('add_new_page') ?>" role="button" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-fw fa-file-o"></i> <span class="hidden-lg hidden-md hidden-sm"><?php echo tpl_getLang('add_new_page') ?></span><span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
      <li class="dropdown-header hidden-xs hidden-sm"><i class="fa fa-fw fa-file-o"></i> <?php echo tpl_getLang('add_new_page') ?></li>
      <li>
        <?php
          #$current_ns = getNS($ID);
          $current_ns = false;
          $search     = array('addnewpage', 'class="button"');
          $replace    = array('addnewpage form-inline', 'class="btn btn-success pull-right"');
          $form       = p_render('xhtml',p_get_instructions(sprintf('{{NEWPAGE>%s}}', $current_ns)), $info);
          $form       = str_replace($search, $replace, $form);

          echo $form;
        ?>
      </li>
    </ul>
  </li>
</ul>
<?php endif; ?>
