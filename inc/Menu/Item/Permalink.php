<?php

namespace dokuwiki\Menu\Item;

/**
 * Class Permalink
 */
class Permalink extends AbstractItem
{

    /** @inheritdoc */
    public function __construct()
    {
        parent::__construct();

        if (!in_array('permalink', explode(',', tpl_getConf('pageIcons')))) {
            throw new \RuntimeException("permalink is not available");
        }

        unset($this->params['do']);

        $this->label = tpl_getLang('permalink');
        $this->svg   = tpl_incdir() . 'images/menu/link.svg';
        $this->id    = '#';
    }

    public function getLink()
    {
        global $ID;
        global $INFO;

        return wl($ID, 'rev=' . $INFO['lastmod'], true, '&');
    }

    public function getLinkAttributes($classprefix = 'menuitem ')
    {
        $attr           = parent::getLinkAttributes($classprefix);
        $attr['target'] = '_blank';

        return $attr;
    }
}
