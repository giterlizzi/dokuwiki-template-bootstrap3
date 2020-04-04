<?php

namespace dokuwiki\Menu\Item;

/**
 * Class Permalink
 */
class Permalink extends AbstractItem {

    /** @inheritdoc */
    public function __construct() {

        parent::__construct();

        if (! in_array('permalink', explode(',', tpl_getConf('pageIcons')))) {
            throw new \RuntimeException("permalink is not available");
        }

        unset($this->params['do']); 

        $this->label = tpl_getLang('permalink');
        $this->svg   = tpl_incdir() . 'images/menu/link.svg';
        $this->id    = '#';
    }

    public function getLinkAttributes($classprefix = 'menuitem ') {

        global $INFO;
        global $ID;

        $attr = array(
            'href'   => DOKU_URL . DOKU_SCRIPT . '?id=' . $ID . '&rev=' . $INFO['lastmod'],
            'title'  => $this->getTitle(),
            'rel'    => 'nofollow',
            'target' => '_blank',
        );

        if ($classprefix !== false) $attr['class'] = $classprefix . $this->getType();

        return $attr;

    }

}
