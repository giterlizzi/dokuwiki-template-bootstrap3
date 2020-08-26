<?php

namespace dokuwiki\Menu\Item;

/**
 * Class Feed
 */
class Feed extends AbstractItem
{

    /** @inheritdoc */
    public function __construct()
    {
        parent::__construct();

        global $lang;

        if (!in_array('feed', explode(',', tpl_getConf('pageIcons')))) {
            throw new \RuntimeException("feed is not available");
        }

        unset($this->params['do']);

        $this->label = $lang['btn_recent'];
        $this->svg   = tpl_incdir() . 'images/menu/rss.svg';
    }

    public function getLinkAttributes($classprefix = 'menuitem ')
    {
        $attr         = parent::getLinkAttributes($classprefix);
        $attr['href'] = DOKU_URL . 'feed.php?ns=' . getNS($this->id);

        return $attr;
    }
}
