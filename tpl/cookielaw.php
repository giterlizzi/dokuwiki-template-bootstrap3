<?php
/**
 * DokuWiki Bootstrap3 Template: Cookie Law Banner
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

global $TPL;

if ( $TPL->getConf('showCookieLawBanner') && !get_doku_pref('cookieNoticeAccepted', null) ):

$cookie_policy_page_id = $TPL->getConf('cookieLawPolicyPage');
$cookie_banner_page_id = $TPL->getConf('cookieLawBannerPage');

$cookie_policy_page_exists = false;
resolve_pageid('', $cookie_policy_page_id, $cookie_policy_page_exists);

?>
<!-- cookie-law -->
<div id="cookieNotice" class="navbar <?php echo (($TPL->getConf('inverseNavbar')) ? 'navbar-inverse' : 'navbar-default') ?> navbar-fixed-bottom">
    <div class="dw-container container<?php echo ($TPL->isFluidNavbar() ? '-fluid mx-5' : '') ?>">
        <div class="navbar-text navbar-left">
            <?php
                $cookie_banner_page = tpl_include_page($cookie_banner_page_id, 0, 1, $TPL->getConf('useACL'));
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
<!-- /cookie-law -->
<?php endif; ?>
