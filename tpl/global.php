<?php
/**
 * DokuWiki Bootstrap3 Template: Global include
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

$template_dir = tpl_incdir();

define('DOKU_INC_COMPAT', "$template_dir/compat/");

include(DOKU_INC_COMPAT . 'inc/functions.php');

// Load compatibility class for pre-Greebo releases
if (! file_exists(DOKU_INC . '/inc/Menu/PageMenu.php')) {

    include "$template_dir/compat/inc/Menu/MenuInterface.php";
    include "$template_dir/compat/inc/Menu/AbstractMenu.php";
    include "$template_dir/compat/inc/Menu/Item/AbstractItem.php";

    include "$template_dir/compat/inc/Menu/UserMenu.php";
    include "$template_dir/compat/inc/Menu/MobileMenu.php";
    include "$template_dir/compat/inc/Menu/PageMenu.php";
    include "$template_dir/compat/inc/Menu/SiteMenu.php";
    include "$template_dir/compat/inc/Menu/DetailMenu.php";

    include "$template_dir/compat/inc/Menu/Item/ImgBackto.php";
    include "$template_dir/compat/inc/Menu/Item/Top.php";
    include "$template_dir/compat/inc/Menu/Item/Edit.php";
    include "$template_dir/compat/inc/Menu/Item/Profile.php";
    include "$template_dir/compat/inc/Menu/Item/Revisions.php";
    include "$template_dir/compat/inc/Menu/Item/Backlink.php";
    include "$template_dir/compat/inc/Menu/Item/Back.php";
    include "$template_dir/compat/inc/Menu/Item/Login.php";
    include "$template_dir/compat/inc/Menu/Item/Index.php";
    include "$template_dir/compat/inc/Menu/Item/Register.php";
    include "$template_dir/compat/inc/Menu/Item/MediaManager.php";
    include "$template_dir/compat/inc/Menu/Item/Subscribe.php";
    include "$template_dir/compat/inc/Menu/Item/Recent.php";
    include "$template_dir/compat/inc/Menu/Item/Media.php";
    include "$template_dir/compat/inc/Menu/Item/Resendpwd.php";
    include "$template_dir/compat/inc/Menu/Item/Admin.php";
    include "$template_dir/compat/inc/Menu/Item/Revert.php";

}

// Load SVG class
require_once "$template_dir/SVG.php";
require_once "$template_dir/Template.php";

// Load PHP Simple HTML DOM class
include_once "$template_dir/inc/simple_html_dom.php";

// Load custom menus
include "$template_dir/inc/Menu/PageMenu.php";
include "$template_dir/inc/Menu/DetailMenu.php";
include "$template_dir/inc/Menu/PageIconsMenu.php";

include "$template_dir/inc/Menu/Item/Discussion.php";
include "$template_dir/inc/Menu/Item/PrintPage.php";
include "$template_dir/inc/Menu/Item/Feed.php";
include "$template_dir/inc/Menu/Item/Help.php";
include "$template_dir/inc/Menu/Item/SendMail.php";
include "$template_dir/inc/Menu/Item/ImgOriginalSize.php";
include "$template_dir/inc/Menu/Item/ShareOn.php";
include "$template_dir/inc/Menu/Item/Permalink.php";


global $TEMPLATE;

$TEMPLATE = \dokuwiki\template\bootstrap3\Template::getInstance();

if (! defined('MAX_FILE_SIZE')) {

    if ($pagesize = $TEMPLATE->getConf('domParserMaxPageSize')) {
        define('MAX_FILE_SIZE', $pagesize);
    }

}

// kate: space-indent on; indent-width 4; replace-tabs on;


