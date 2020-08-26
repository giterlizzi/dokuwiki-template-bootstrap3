<?php

namespace dokuwiki\Menu\Item;

/**
 * Class ImgOriginalSize
 */
class ImgOriginalSize extends AbstractItem
{

    /** @inheritdoc */
    public function __construct()
    {
        parent::__construct();

        global $lang;
        global $IMG;

        if (!$IMG) {
            throw new \RuntimeException("image is not available");
        }

        unset($this->params['do']);

        $this->label = $lang['js']['mediadirect'];
        $this->svg   = tpl_incdir() . 'images/menu/image-size-select-large.svg';
        $this->id    = $IMG;
    }

    public function getLink()
    {
        global $IMG;
        global $REV;
        global $INPUT;

        return ml($IMG, array('cache' => $INPUT->str('cache'), 'rev' => $REV), true, '&');
    }

    public function getLinkAttributes($classprefix = 'menuitem ')
    {
        $attr           = parent::getLinkAttributes($classprefix);
        $attr['target'] = '_blank';

        return $attr;
    }
}
