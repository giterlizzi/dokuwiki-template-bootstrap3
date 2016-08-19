<?php
/**
 * DokuWiki Bootstrap3 Template: Jumbotron  hook
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Eric Maeker <eric@@maeker.fr>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

  // must be run from within DokuWiki
  if (!defined('DOKU_INC')) die();

  // This jumbotron hook allow users to include full view jumbotron to their
  // landing pages. Config vars: showLandingPage and landingPages must be defined accordingly.
  // On landing pages, the jumbotron is included before the dokuwiki page. This allow user
  // to create a beautifull "one picture" landing page to their website.

  // Show jumbotron on landing pages only
  if (bootstrap3_conf('showLandingPage')
      && (bool) preg_match(bootstrap3_conf('landingPages'), $ID)) {
       // Do not include jumbotron on administratives panels
       if ($_GET['do'] == '') {
         tpl_include_page('jumbotron', 1, 1);
       } else {
         // Here you can add a padding-top empty div
       }
  } else {
    // Here you can add a padding-top empty div
  }
?>
