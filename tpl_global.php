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

$EVENT_HANDLER->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', null, 'bootstrap3_metaheaders');

$fixed_top_navbar  = bootstrap3_conf('fixedTopNavbar');
$page_on_panel     = bootstrap3_conf('pageOnPanel');
$bootstrap_theme   = bootstrap3_conf('bootstrapTheme');
$bootswatch_theme  = bootstrap3_bootswatch_theme();


$JSINFO['bootstrap3'] = array(
  'tableFullWidth' => (int) bootstrap3_conf('tableFullWidth'),
  'tableStyle'     => bootstrap3_conf('tableStyle'),
  'tagsOnTop'      => (int) bootstrap3_conf('tagsOnTop'),
  'useAnchorJS'    => (int) bootstrap3_conf('useAnchorJS'),
  'mode'           => $ACT,
);


$body_classes   = array();
$body_classes[] = (($bootstrap_theme == 'bootswatch') ? $bootswatch_theme : $bootstrap_theme);
$body_classes[] = ($page_on_panel ? ' page-on-panel' : null);
