<?php
/**
 * DokuWiki Bootstrap3 Template: Global Configurations
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

global $ID;
global $JSINFO;
global $INPUT;
global $ACT;
global $EVENT_HANDLER;

// Get the template info (useful for debug)
if ($INFO['isadmin'] && $INPUT->str('do') && $INPUT->str('do') == 'check') {
  $template_info = confToHash(dirname(__FILE__).'/template.info.txt');
  msg('bootstrap3 template version: v' . $template_info['date'], 1, '', '', MSG_ADMINS_ONLY);
}

if ($INPUT->str('bootswatch-theme')) {
  set_doku_pref('bootswatchTheme', $INPUT->str('bootswatch-theme'));
}


$EVENT_HANDLER->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', null, 'bootstrap3_metaheaders');

$page_on_panel = bootstrap3_conf('pageOnPanel');

// Populate JSINFO object
$JSINFO['bootstrap3'] = array(
  'mode'   => $ACT,
  'config' => array(
    'collapsibleSections' => (int) bootstrap3_conf('collapsibleSections'),
    'sidebarOnNavbar'     => (int) bootstrap3_conf('sidebarOnNavbar'),
    'tagsOnTop'           => (int) bootstrap3_conf('tagsOnTop'),
    'tocAffix'            => (int) bootstrap3_conf('tocAffix'),
    'tocCollapseOnScroll' => (int) bootstrap3_conf('tocCollapseOnScroll'),
    'tocCollapsed'        => (int) bootstrap3_conf('tocCollapsed'),
    'showSemanticPopup'   => (int) bootstrap3_conf('showSemanticPopup'),
  ),
);

if ($ACT == 'admin') {
  $JSINFO['bootstrap3']['admin'] = $INPUT->str('page');
}
