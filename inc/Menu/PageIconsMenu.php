<?php

namespace dokuwiki\template\bootstrap3\Menu;

/**
 * Class PageIconsMenu
 *
 * Actions manipulating the current page. Shown as a floating menu in the dokuwiki template
 */
class PageIconsMenu extends \dokuwiki\Menu\AbstractMenu
{
    protected $view = 'pageicons';

    protected $types = array(
        'ShareOn',
        'Feed',
        'SendMail',
        'PrintPage',
        'Permalink',
        'Help',
    );
}
