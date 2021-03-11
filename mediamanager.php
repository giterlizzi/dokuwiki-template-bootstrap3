<?php
/**
 * DokuWiki Bootstrap3 Template: Media Manager Popup
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Andreas Gohr <andi@splitbrain.org>
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die();     // must be run from within DokuWiki

require_once 'tpl/global.php';
require_once 'tpl/functions.php';

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction'] ?>" class="popup no-js">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo hsc($lang['mediaselect'])?> [<?php echo strip_tags($conf['title'])?>]</title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php

    if ($TPL->getConf('themeByNamespace')) {
        echo '<link href="' . tpl_basedir() . 'css.php?id='. $ID .'" rel="stylesheet" />';
    }

    echo tpl_favicon(array('favicon', 'mobile'));
    tpl_includeFile('meta.html');
    tpl_metaheaders();

    ?>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        body { position: initial; }
    </style>
</head>
<body class="container">

    <div id="dw__msgarea" class="small">
        <?php $TPL->getMessageArea() ?>
    </div>
    <div id="media__manager" class="<?php echo $TPL->getClasses() ?> row">

        <div id="mediamgr__aside" class="col-xs-4">
        <h1><?php echo hsc($lang['mediaselect'])?></h1>

        <?php /* keep the id! additional elements are inserted via JS here */?>
        <div id="media__opts"></div>
            <?php tpl_mediaTree() ?>
        </div>

        <div id="mediamgr__content" class="col-xs-8">
            <?php tpl_mediaContent() ?>
        </div>

    </div>

</body>
</html>
