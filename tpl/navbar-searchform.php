<?php
/**
 * DokuWiki Bootstrap3 Template: Navbar Search Form
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

global $lang;
global $ACT;
global $QUERY;
global $ID;

?>
<!-- navbar-searchform -->
<form action="<?php echo wl($ID); ?>" accept-charset="utf-8" class="navbar-form navbar-left search" id="dw__search" method="get" role="search">
    <div class="input-group">
        <input id="qsearch" autocomplete="off" type="search" placeholder="<?php echo $lang['btn_search']; ?>" value="<?php echo ($ACT == 'search') ? hsc($QUERY) : ''; ?>" accesskey="f" name="q" class="form-control" title="[F]" />
        <div class="input-group-btn">
            <button  class="btn btn-default" type="submit" title="<?php echo $lang['btn_search']; ?>">
                <?php echo iconify('mdi:magnify'); ?>
            </button>
        </div>

    </div>
    <input type="hidden" name="do" value="search" />
</form>
<!-- /navbar-searchform -->
