<?php
/**
 * DokuWiki Bootstrap3 Template: Page icons
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

if (($ACT == 'show' || defined('DOKU_MEDIADETAIL')) && bootstrap3_conf('showPageIcons')):

global $ID;
global $INFO;
global $conf;

$page_icons   = bootstrap3_conf('pageIcons');
$social_share = in_array('social-share', $page_icons);
$social_share_providers = bootstrap3_conf('socialShareProviders');
$current_ns   = getNS($ID);

$help_page  = false;
$help_title = null;

if (in_array('help', $page_icons)) {
  $help_page  = page_findnearest('help', bootstrap3_conf('useACL'));
  $help_title = hsc(p_get_first_heading($help_page));
  $help_popup = wl($help_page, array('do' => 'export_xhtmlbody'));
}

?>
<div class="dw-page-icons pull-right hidden-print">

  <ul class="list-inline pull-right">
    <?php if (in_array('feed', $page_icons)): ?>
    <li>
      <a href="<?php echo DOKU_URL . 'feed.php?ns=' . $current_ns ?>" title="<?php echo $lang['btn_recent'] ?>" class="feed" target="_blank"><i class="fa fa-fw fa-rss text-muted"></i></a>
    </li>
    <?php endif;
          if (in_array('send-mail', $page_icons)): ?>
    <li>
      <a href="#" title="<?php echo tpl_getLang('send_mail') ?>" class="send-mail"><i class="fa fa-fw fa-envelope text-muted"></i></a>
    </li>
    <?php endif;
          if (in_array('print', $page_icons)): ?>
    <li>
      <a href="#" title="<?php echo tpl_getLang('print') ?>" onclick="window.print()"><i class="fa fa-fw fa-print text-muted"></i></a>
    </li>
    <?php endif;
          if (in_array('help', $page_icons) && $help_page): ?>
    <li>
      <a href="#" title="<?php echo $help_title ?>" data-toggle="modal" data-target=".dw-page-icons .modal.help" data-page="<?php echo $help_popup; ?>" onclick="return jQuery('.modal.help .modal-body').load(jQuery(this).data('page'));"><i class="fa fa-fw fa-question text-muted"></i></a>
    </li>
    <?php endif; ?>
  </ul>

  <?php if ($social_share && count($social_share_providers)): ?>

  <div class="dropdown pull-right">
    <a href="#" data-remote="<?php wl($ID) ?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" title="<?php echo tpl_getLang('share_on') ?> ..." class="share-on">
      <i class="fa fa-share-alt fa-fw text-muted"></i>
    </a>
    <ul class="dropdown-menu">
      <li class="dropdown-header">
        <i class="fa fa-fw fa-share-alt"></i> <?php echo tpl_getLang('share_on') ?> ...
      </li>
      <?php if (in_array('google-plus', $social_share_providers)): ?>
      <li>
        <a href="#" class="share-google-plus" title="<?php echo tpl_getLang('share_on') ?> Google+"><i class="fa fa-fw fa-lg fa-google-plus-square"></i> Google+</a>
      </li>
      <?php endif;
            if (in_array('twitter', $social_share_providers)): ?>
      <li>
        <a href="#" class="share-twitter" title="<?php echo tpl_getLang('share_on') ?> Twitter"><i class="fa fa-fw fa-lg fa-twitter-square"></i> Twitter</a>
      </li>
      <?php endif;
            if (in_array('linkedin', $social_share_providers)): ?>
      <li>
        <a href="#" class="share-linkedin" title="<?php echo tpl_getLang('share_on') ?> LinkedIn"><i class="fa fa-fw fa-lg fa-linkedin-square"></i> LinkedIn</a>
      </li>
      <?php endif;
            if (in_array('facebook', $social_share_providers)): ?>
      <li>
        <a href="#" class="share-facebook" title="<?php echo tpl_getLang('share_on') ?> Facebook"><i class="fa fa-fw fa-lg fa-facebook-square"></i> Facebook</a>
      </li>
      <?php endif;
            if (in_array('pinterest', $social_share_providers)): ?>
      <li>
        <a href="#" class="share-pinterest" title="<?php echo tpl_getLang('share_on') ?> Pinterest"><i class="fa fa-fw fa-lg fa-pinterest"></i> Pinterest</a>
      </li>
      <?php endif;
            if (in_array('telegram', $social_share_providers)): ?>
      <li>
        <a href="#" class="share-telegram" title="<?php echo tpl_getLang('share_on') ?> Telegram"><i class="fa fa-fw fa-lg fa-telegram"></i> Telegram</a>
      </li>
      <?php endif;
            if (in_array('whatsapp', $social_share_providers) && $INFO['ismobile']): ?>
      <li>
        <a href="whatsapp://send?text=" class="share-whatsapp" title="<?php echo tpl_getLang('share_on') ?> Whatsapp" data-action="share/whatsapp/share"><i class="fa fa-fw fa-lg fa-whatsapp"></i> Whatsapp</a>
      </li>
      <?php endif; ?>
    </ul>
  </div>

  <?php endif; ?>

  <?php if (in_array('help', $page_icons) && $help_page): ?>
  <div class="help modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><?php echo $conf['title'] ?></h4>
        </div>
        <div class="modal-body" style="padding:20px"></div>
      </div>
    </div>
  </div>
  <?php endif; ?>


</div>
<span class="clearfix"></span>
<?php endif; ?>
