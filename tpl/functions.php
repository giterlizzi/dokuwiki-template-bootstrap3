<?php
/**
 * DokuWiki Bootstrap3 Template: Core Functions
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();


/**
 * Create link for DokuWiki actions
 *
 * @author Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 *
 * @param  string          $type action
 * @param  string          $icon class
 * @param  boolean|string  $wrapper
 * @param  boolean         $return
 * @return string
 */
function bootstrap3_action($type, $icon = '', $wrapper = false, $return = false)
{

    global $ACT;
    global $ID;
    global $INPUT;
    global $lang;

    $output = '';

    $custom_actions = array('discussion');

    if (in_array($type, $custom_actions)) {

        if ($wrapper) {
            $output .= "<$wrapper>";
        }

        if ($type == 'discussion') {

            $discuss_page     = str_replace('@ID@', $ID, tpl_getConf('discussionPage'));
            $discuss_page_raw = str_replace('@ID@', '', tpl_getConf('discussionPage'));
            $is_discussPage   = strpos($ID, $discuss_page_raw) !== false;
            $back_id          = ':' . str_replace($discuss_page_raw, '', $ID);

            if ($is_discussPage) {

                $link = html_wikilink($back_id, tpl_getLang('back_to_article'));
                $link = str_replace('title="', 'title="' . tpl_getLang('back_to_article') . ': ', $link);

            } else {

                $link = html_wikilink($discuss_page, tpl_getLang('discussion'));
                $link = str_replace('title="', 'title="' . tpl_getLang('discussion') . ': ', $link);

            }

            $output .= str_replace(array('class="', 'wikilink1', 'wikilink2'),
                array('class="action discussion ', '', ''), $link);

            if ($icon) {
                $output = preg_replace('/(<a (.*?)>)/m', '$1<i class="' . $icon . '"></i> ', $output);
            }

        }

        if ($wrapper) {
            $output .= "</$wrapper>";
        }

    } else {

        $inner = '';

        if (isset($lang['btn_' . $type])) {
            $inner = $lang['btn_' . $type];
        }

        if ($type == 'img_backto') {
            if (strpos($inner, '%s')) {
                $inner = sprintf($inner, $ID);
            }
        }

        if ($type == 'login' && $INPUT->server->has('REMOTE_USER')) {
            $inner = $lang['btn_logout'];
        }

        if ($icon) {
            $inner = '<i class="' . $icon . '"></i> ' . $inner;
        }

        $output .= tpl_actionlink($type, '', '', $inner, true, $wrapper);

        if ($type == $ACT) {
            $output = str_replace('class="action ', 'class="action active ', $output);
        }

    }

    if ($return) {
        return $output;
    }

    echo $output;

}

