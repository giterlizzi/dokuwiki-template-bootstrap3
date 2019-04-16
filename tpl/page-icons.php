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

global $TEMPLATE;

if (($ACT == 'show' || defined('DOKU_MEDIADETAIL')) && $TEMPLATE->getConf('showPageIcons')):

global $ID;
global $INFO;
global $conf;

$page_icons   = $TEMPLATE->getConf('pageIcons');
$social_share = in_array('social-share', $page_icons);
$social_share_providers = $TEMPLATE->getConf('socialShareProviders');
$current_ns   = getNS($ID);

$help_page  = false;
$help_title = null;
$help_popup = null;

if (in_array('help', $page_icons)) {
  $help_page  = page_findnearest('help', $TEMPLATE->getConf('useACL'));
  $help_title = hsc(p_get_first_heading($help_page));
  $help_popup = wl($help_page, array('do' => 'export_xhtmlbody'));
}

?>
<!-- page-icons -->
<div class="dw-page-icons pull-right hidden-print">

    <ul class="list-inline pull-right m-0 mb-2">

        <?php if ($social_share && count($social_share_providers)): ?>
        <li class="dropdown">
            <a href="#" data-remote="<?php wl($ID) ?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" title="<?php echo tpl_getLang('share_on') ?> ...">
                <i class="mdi mdi-share-variant"></i>
            </a>
            <ul class="dropdown-menu">
                <li class="dropdown-header">
                    <i class="mdi mdi-share-variant"></i> <?php echo tpl_getLang('share_on') ?> ...
                </li>
                <?php if (in_array('google-plus', $social_share_providers)): ?>
                <!--
                <li>
                    <a href="#" class="share-google-plus" title="<?php echo tpl_getLang('share_on') ?> Google+"><i class="mdi mdi-google-plus"></i> Google+</a>
                </li>
                -->
                <?php endif; if (in_array('twitter', $social_share_providers)): ?>
                <li>
                    <a href="#" class="share-twitter" title="<?php echo tpl_getLang('share_on') ?> Twitter"><i class="mdi mdi-twitter"></i> Twitter</a>
                </li>
                <?php endif; if (in_array('linkedin', $social_share_providers)): ?>
                <li>
                    <a href="#" class="share-linkedin" title="<?php echo tpl_getLang('share_on') ?> LinkedIn"><i class="mdi mdi-linkedin"></i> LinkedIn</a>
                </li>
                <?php endif; if (in_array('facebook', $social_share_providers)): ?>
                <li>
                    <a href="#" class="share-facebook" title="<?php echo tpl_getLang('share_on') ?> Facebook"><i class="mdi mdi-facebook"></i> Facebook</a>
                </li>
                <?php endif; if (in_array('pinterest', $social_share_providers)): ?>
                <li>
                    <a href="#" class="share-pinterest" title="<?php echo tpl_getLang('share_on') ?> Pinterest"><i class="mdi mdi-pinterest"></i> Pinterest</a>
                </li>
                <?php endif; if (in_array('telegram', $social_share_providers)): ?>
                <li>
                    <a href="#" class="share-telegram" title="<?php echo tpl_getLang('share_on') ?> Telegram"><i class="mdi mdi-telegram"></i> Telegram</a>
                </li>
                <?php endif; if (in_array('whatsapp', $social_share_providers) && $INFO['ismobile']): ?>
                <li>
                    <a href="whatsapp://send?text=" class="share-whatsapp" title="<?php echo tpl_getLang('share_on') ?> Whatsapp" data-action="share/whatsapp/share"><i class="mdi mdi-whatsapp"></i> Whatsapp</a>
                </li>
                <?php endif; if (in_array('yammer', $social_share_providers)): ?>
                <li>
                    <a href="#" class="share-yammer" title="<?php echo tpl_getLang('share_on') ?> Yammer"><i class="mdi mdi-yammer"></i> Yammer</a>
                </li>
                <?php endif; if (in_array('reddit', $social_share_providers)): ?>
                <li>
                    <a href="#" class="share-reddit" title="<?php echo tpl_getLang('share_on') ?> Reddit"><i class="mdi mdi-reddit"></i> Reddit</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <?php if (in_array('feed', $page_icons)): ?>
        <li>
            <a href="<?php echo DOKU_URL . 'feed.php?ns=' . $current_ns ?>" title="<?php echo $lang['btn_recent'] ?>" class="feed" target="_blank"><i class="mdi mdi-rss"></i></a>
        </li>
        <?php endif; if (in_array('send-mail', $page_icons)): ?>
        <li>
            <a href="#" title="<?php echo tpl_getLang('send_mail') ?>" class="send-mail"><i class="mdi mdi-email"></i></a>
        </li>
        <?php endif; if (in_array('print', $page_icons)): ?>
        <li>
            <a href="#" title="<?php echo tpl_getLang('print') ?>" onclick="window.print()"><i class="mdi mdi-printer"></i></a>
        </li>
        <?php endif; if (in_array('permalink', $page_icons) && $INFO['lastmod']): ?>
        <li>
            <a href="<?php echo DOKU_URL . DOKU_SCRIPT . '?id=' . $ID . '&rev=' . $INFO['lastmod'] ?>" title="<?php echo tpl_getLang('permalink') ?>" target="_blank"><i class="mdi mdi-link"></i></a>
        </li>
        <?php endif; if (in_array('help', $page_icons) && $help_page): ?>
        <li>
            <a href="#" title="<?php echo $help_title ?>" data-toggle="modal" data-target=".dw-page-icons .modal.help" data-page="<?php echo $help_popup; ?>" onclick="return jQuery('.modal.help .modal-body').load(jQuery(this).data('page'));"><i class="mdi mdi-help"></i></a>
        </li>
        <?php endif; ?>
    </ul>


    <?php if (in_array('help', $page_icons) && $help_page): ?>
    <div class="help modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?php echo $conf['title'] ?> - <?php echo $help_title ?></h4>
                </div>
                <div class="modal-body px-5"></div>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>
<!-- /page-icons -->
<span class="clearfix"></span>
<?php endif; ?>
