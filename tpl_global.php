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

$fixedTopNavbar      = bootstrap3_conf('fixedTopNavbar');
$pageOnPanel         = bootstrap3_conf('pageOnPanel');

$bootstrap_theme      = bootstrap3_conf('bootstrapTheme');
$custom_theme         = bootstrap3_conf('customTheme');
$bootswatch_theme     = bootstrap3_conf('bootswatchTheme');
$bootstrap_styles     = array();

$JSINFO['bootstrap3'] = array(
  'tableFullWidth' => (int) bootstrap3_conf('tableFullWidth'),
  'tableStyle'     => bootstrap3_conf('tableStyle'),
  'tagsOnTop'      => (int) bootstrap3_conf('tagsOnTop'),
  'useAnchorJS'    => (int) bootstrap3_conf('useAnchorJS'),
);

if (bootstrap3_conf('showThemeSwitcher')) {

  if (get_doku_pref('bootswatchTheme', null) !== null && get_doku_pref('bootswatchTheme', null) !== '') {
    $bootswatch_theme = get_doku_pref('bootswatchTheme', null);
  }

  if ($INPUT->str('bootswatch-theme')) {
    $bootswatch_theme = $INPUT->str('bootswatch-theme');
    set_doku_pref('bootswatchTheme', $bootswatch_theme);
  }

}

switch ($bootstrap_theme) {

  case 'optional':
    $bootstrap_styles[] = DOKU_TPL.'assets/bootstrap/css/bootstrap.min.css';
    $bootstrap_styles[] = DOKU_TPL.'assets/bootstrap/css/bootstrap-theme.min.css';
    break;
  case 'custom':
    $bootstrap_styles[] = $customTheme;
    break;
  case 'bootswatch':
    $url = (bootstrap3_conf('useLocalBootswatch')) ? DOKU_TPL.'assets/bootswatch' : '//maxcdn.bootstrapcdn.com/bootswatch/3.3.6';
    $bootstrap_styles[] = "$url/$bootswatch_theme/bootstrap.min.css";
    break;
  case 'default':
  default:
    $bootstrap_styles[] = DOKU_TPL.'assets/bootstrap/css/bootstrap.min.css';
    break;

}


$navbar_padding = 20;

if (bootstrap3_conf('fixedTopNavbar')) {

  if ($bootstrapTheme == 'bootswatch') {

    // Set the navbar height for all Bootswatch Themes (values from bootswatch/*/_variables.scss)
    switch ($bootswatchTheme) {
      case 'simplex':
      case 'superhero':
        $navbar_height = 40;
        break;
      case 'yeti':
        $navbar_height = 45;
        break;
      case 'cerulean':
      case 'cosmo':
      case 'custom':
      case 'cyborg':
      case 'lumen':
      case 'slate':
      case 'spacelab':
      case 'united':
        $navbar_height = 50;
        break;
      case 'darkly':
      case 'flatly':
      case 'journal':
      case 'sandstone':
        $navbar_height = 60;
        break;
      case 'paper':
        $navbar_height = 64;
        break;
      case 'readable':
        $navbar_height = 65;
        break;
      default:
        $navbar_height = 50;
    }

  } else {
    $navbar_height = 50;
  }

  $navbar_padding += $navbar_height;

}


$body_classes   = array();
$body_classes[] = (($bootstrap_theme == 'bootswatch') ? $bootswatch_theme : $bootstrap_theme);
$body_classes[] = ($pageOnPanel ? ' page-on-panel' : null);
