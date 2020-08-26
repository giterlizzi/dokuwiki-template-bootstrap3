<?php
/**
 * DokuWiki Bootstrap3 Template: Global include
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$template_dir = tpl_incdir();

// Load compatibility functions and classes
require "$template_dir/compat/inc/functions.php";

// Load custom menus
require "$template_dir/inc/Menu/PageMenu.php";
require "$template_dir/inc/Menu/DetailMenu.php";
require "$template_dir/inc/Menu/PageIconsMenu.php";

// Load custom items
require "$template_dir/inc/Menu/Item/Discussion.php";
require "$template_dir/inc/Menu/Item/PrintPage.php";
require "$template_dir/inc/Menu/Item/Feed.php";
require "$template_dir/inc/Menu/Item/Help.php";
require "$template_dir/inc/Menu/Item/SendMail.php";
require "$template_dir/inc/Menu/Item/ImgOriginalSize.php";
require "$template_dir/inc/Menu/Item/ShareOn.php";
require "$template_dir/inc/Menu/Item/Permalink.php";

global $TPL;

$TPL = \dokuwiki\template\bootstrap3\Template::getInstance();

// Load PHP Simple HTML DOM class
require "$template_dir/inc/simple_html_dom.php";
