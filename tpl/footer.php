<?php
/**
 * DokuWiki Bootstrap3 Template: Footer page
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

global $conf;
global $TEMPLATE;

$footer_page_exist    = page_findnearest('footer', $TEMPLATE->getConf('useACL'));
$license_is_enabled   = $conf['license'];
$badges_is_enabled    = $TEMPLATE->getConf('showBadges');
$wiki_info_is_enabled = $TEMPLATE->getConf('showWikiInfo');

$logo_size      = array();
$wiki_logo      = tpl_getMediaFile(array(':wiki:logo.png', ':logo.png', 'images/logo.png'), false, $logo_size);
$wiki_title     = $conf['title'];
$wiki_tagline   = ($conf['tagline']) ? '<span class="dw__tagline">'.$conf['tagline'].'</span>' : '';
$wiki_home_link = ($TEMPLATE->getConf('homePageURL') ? $TEMPLATE->getConf('homePageURL') : wl());

?>
<?php if ($wiki_info_is_enabled || $footer_page_exist || $license_is_enabled || $badges_is_enabled): ?>
<!-- footer -->
<div class="dw-container small container<?php echo ($TEMPLATE->getConf('fixedTopNavbar') || $TEMPLATE->isFluidNavbar() ? '-fluid mx-5' : '') ?>">

    <?php if ($wiki_info_is_enabled): ?>
    <div class="footer-dw-title">
        <div class="media">
            <div class="media-left">
                <img src="<?php echo $wiki_logo ?>" alt="<?php echo $wiki_title ?>" class="media-object" style="height:32px" />
            </div>
            <div class="media-body">
                <div class="row">
                    <div class="col-sm-2">
                        <h4 class="media-heading"><?php echo $wiki_title ?></h4>
                        <p>
                            <?php echo $wiki_tagline ?>
                        </p>
                    </div>
                    <div class="col-sm-10">
                        <?php
                            if ($footer_page_exist) {
                                echo $TEMPLATE->includePage('footer');
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="footer-license row">
        <hr/>
        <div id="dw__license" class="col-sm-6">
            <?php if ($license_is_enabled): ?>
            <p>
                <?php $TEMPLATE->getLicense('image') ?>
            </p>
            <p class="small">
                <?php $TEMPLATE->getLicense('link') ?>
            </p>
            <?php endif; ?>
        </div>

        <div class="col-sm-6">
            <?php
                if ($badges_is_enabled) {
                    require_once('badges.php'); 
                }
            ?>
        </div>

    </div>

</div>
<!-- /footer -->
<?php endif; ?>
