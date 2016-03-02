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

if ($ACT == 'show' && bootstrap3_conf('showPageIcons')):

$page_icons   = bootstrap3_conf('pageIcons');
$social_share = in_array('social-share', $page_icons);
$social_share_providers = bootstrap3_conf('socialShareProviders');

$help_page  = false;
$help_title = null;

if (in_array('help', $page_icons)) {
  $help_page  = page_findnearest('help');
  $help_title = hsc(p_get_first_heading($help_page));
}

?>
<div class="dw-page-icons pull-right hidden-print">

  <ul class="list-inline pull-right">
    <?php if(in_array('feed', $page_icons)): ?>
    <li>
      <a href="<?php echo DOKU_URL . 'feed.php' ?>" title="<?php echo $lang['btn_recent'] ?>" class="feed"><i class="fa fa-fw fa-rss text-muted"></i></a>
    </li>
    <?php endif;
          if(in_array('send-mail', $page_icons)): ?>
    <li>
      <a href="#" title="Send e-Mail" class="send-mail"><i class="fa fa-fw fa-envelope text-muted"></i></a>
    </li>
    <?php endif;
          if(in_array('print', $page_icons)): ?>
    <li>
      <a href="#" title="Print" onclick="window.print()"><i class="fa fa-fw fa-print text-muted"></i></a>
    </li>
    <?php endif;
          if(in_array('help', $page_icons) && $help_page): ?>
    <li>
      <a href="<?php echo wl($help_page) ?>" title="<?php echo $help_title ?>"><i class="fa fa-fw fa-question text-muted"></i></a>
    </li>
    <?php endif; ?>
  </ul>

  <?php if($social_share && count($social_share_providers)): ?>

  <div class="dropdown pull-right">
    <a href="#" title="Share on ..." class="share-on" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
      <i class="fa fa-share-alt fa-fw text-muted"></i>
    </a>
    <ul class="dropdown-menu">
      <li class="dropdown-header">
        <i class="fa fa-fw fa-share-alt"></i> Share on ...
      </li>
      <?php if(in_array('google-plus', $social_share_providers)): ?>
      <li>
        <a href="#" class="share-google-plus" title="Share on Google+"><i class="fa fa-fw fa-lg fa-google-plus-square"></i> Google+</a>
      </li>
      <?php endif;
            if(in_array('twitter', $social_share_providers)): ?>
      <li>
        <a href="#" class="share-twitter" title="Share on Twitter"><i class="fa fa-fw fa-lg fa-twitter-square"></i> Twitter</a>
      </li>
      <?php endif;
            if(in_array('linkedin', $social_share_providers)): ?>
      <li>
        <a href="#" class="share-linkedin" title="Share on LinkedIn"><i class="fa fa-fw fa-lg fa-linkedin-square"></i> LinkedIn</a>
      </li>
      <?php endif;
            if(in_array('facebook', $social_share_providers)): ?>
      <li>
        <a href="#" class="share-facebook" title="Share on Facebook"><i class="fa fa-fw fa-lg fa-facebook-square"></i> Facebook</a>
      </li>
      <?php endif;
            if(in_array('pinterest', $social_share_providers)): ?>
      <li>
        <a href="#" class="share-pinterest" title="Share on Pinterest"><i class="fa fa-fw fa-lg fa-pinterest"></i> Pinterest</a>
      </li>
      <?php endif;
            if(in_array('whatsapp', $social_share_providers) && $INFO['ismobile']): ?>
      <li>
        <a href="whatsapp://send?text=" class="share-whatsapp" title="Share on Whatsapp" data-action="share/whatsapp/share"><i class="fa fa-fw fa-lg fa-whatsapp"></i> Whatsapp</a>
      </li>
      <?php endif; ?>
    </ul>
  </div>

  <?php endif; ?>

</div>
<span class="clearfix"></span>
<?php endif; ?>
