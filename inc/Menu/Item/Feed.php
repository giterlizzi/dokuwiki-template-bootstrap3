<?php

namespace dokuwiki\Menu\Item;

/**
 * Class Feed
 */
class Feed extends AbstractItem {

    /** @inheritdoc */
    public function __construct() {

        parent::__construct();

        global $lang;

        if (! in_array('feed', explode(',', tpl_getConf('pageIcons')))) {
            throw new \RuntimeException("feed is not available");
        }

        unset($this->params['do']); 

        $this->label    = $lang['btn_recent'];
        $this->svg      = tpl_incdir() . 'images/menu/rss.svg';
        $this->id       = '';
        $this->nofollow = true;
    }

    public function getLinkAttributes($classprefix = 'menuitem ') {

        global $ID;

        $attr = array(
            'href'   => DOKU_URL . 'feed.php?ns=' . getNS($ID),
            'title'  => $this->getTitle(),
            'rel'    => 'nofollow',
            'target' => '_blank',
        );

        if ($classprefix !== false) $attr['class'] = $classprefix . $this->getType();

        return $attr;

    }

}
