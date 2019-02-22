<?php
/**
 * DokuWiki Bootstrap3 Template: Cookie Law Banner
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

if ( bootstrap3_conf('showCookieLawBanner') && ! (get_doku_pref('cookieNoticeAccepted', null) || get_doku_pref('cookieNoticeAccepted', '')) ):

$cookie_policy_page_id = bootstrap3_conf('cookieLawPolicyPage');
$cookie_banner_page_id = bootstrap3_conf('cookieLawBannerPage');

resolve_pageid('', $cookie_policy_page_id, $cookie_policy_page_exists);

?>
<div id="cookieNotice" class="navbar <?php echo ((bootstrap3_conf('inverseNavbar')) ? 'navbar-inverse' : 'navbar-default') ?> navbar-fixed-bottom">
  <div class="container">
    <div class="navbar-text navbar-left">
    <?php
      $cookie_banner_page = tpl_include_page($cookie_banner_page_id, 0, 1, bootstrap3_conf('useACL'));
      $cookie_banner_page = preg_replace('/<p>\n(.*?)\n<\/p>/', '<i class="fa fa-info-circle text-primary"></i> $1', $cookie_banner_page);
      echo $cookie_banner_page;
    ?>
    </div>
    <div class="navbar-right">
      <button class="btn btn-primary btn-xs navbar-btn" id="cookieDismiss">OK</button>
      <?php if ($cookie_policy_page_exists) tpl_link(wl($cookie_policy_page_id), 'Policy', 'class="btn btn-default btn-xs navbar-btn" id="cookiePolicy"') ?>
    </div>
  </div>
</div>
<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery(document).trigger('bootstrap3:cookie-law');
  });
</script>
<?php endif; ?>
