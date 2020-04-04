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

global $TEMPLATE;

if ( $TEMPLATE->getConf('showCookieLawBanner') && !get_doku_pref('cookieNoticeAccepted', null) ):

$cookie_policy_page_id = $TEMPLATE->getConf('cookieLawPolicyPage');
$cookie_banner_page_id = $TEMPLATE->getConf('cookieLawBannerPage');

$cookie_policy_page_exists = false;
resolve_pageid('', $cookie_policy_page_id, $cookie_policy_page_exists);

?>
<!-- cookie-law -->
<div id="cookieNotice" class="navbar <?php echo (($TEMPLATE->getConf('inverseNavbar')) ? 'navbar-inverse' : 'navbar-default') ?> navbar-fixed-bottom">
    <div class="dw-container container<?php echo ($TEMPLATE->isFluidNavbar() ? '-fluid mx-5' : '') ?>">
        <div class="navbar-text navbar-left">
            <?php
                $cookie_banner_page = tpl_include_page($cookie_banner_page_id, 0, 1, $TEMPLATE->getConf('useACL'));
                $cookie_banner_page = preg_replace('/<p>\n(.*?)\n<\/p>/', iconify('mdi:information', array('class' => 'text-primary')) . ' $1', $cookie_banner_page);
                echo $cookie_banner_page;
            ?>
        </div>
        <div class="navbar-right">
            <button class="btn btn-primary btn-xs navbar-btn" id="cookieDismiss">OK</button>
            <?php
                if ($cookie_policy_page_exists) {
                    tpl_link(wl($cookie_policy_page_id), 'Policy', 'class="btn btn-default btn-xs navbar-btn" id="cookiePolicy"');
                }
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery(document).trigger('bootstrap3:cookie-law');
    });
</script>
<!-- /cookie-law -->
<?php endif; ?>
