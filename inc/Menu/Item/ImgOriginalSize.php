<?php

namespace dokuwiki\Menu\Item;

/**
 * Class ImgOriginalSize
 */
class ImgOriginalSize extends AbstractItem {

    /** @inheritdoc */
    public function __construct() {

        parent::__construct();

        global $IMG;
        global $REV;
        global $INPUT;
        global $lang;

        if (! $IMG) {
            throw new \RuntimeException("image is not available");
        }

        unset($this->params['do']);

        $this->label    = $lang['js']['mediadirect'];
        $this->svg      = tpl_incdir() . 'images/menu/image-size-select-large.svg';
        $this->id       = '#';
        $this->img_link = ml($IMG, array('cache'=> $INPUT->str('cache'),'rev' => $REV), true, '&');

    }

    public function getLinkAttributes($classprefix = 'menuitem ') {

        $attr = array(
            'href'    => $this->img_link,
            'title'   => $this->getTitle(),
            'rel'     => 'nofollow',
            'target'  => '_blank',
        );

        if ($classprefix !== false) $attr['class'] = $classprefix . $this->getType();

        return $attr;

    }

}
