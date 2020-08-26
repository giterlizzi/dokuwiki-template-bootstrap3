<?php

namespace dokuwiki\template\bootstrap3\Menu;

/**
 * Class DetailMenu
 *
 * This menu offers options on an image detail view. It usually displayed similar to
 * the PageMenu.
 */
class DetailMenu extends \dokuwiki\Menu\AbstractMenu
{
    protected $view = 'detail';

    protected $types = array(
        'ImgOriginalSize',
        'MediaManager',
        'ImgBackto',
        'Top',
    );
}
