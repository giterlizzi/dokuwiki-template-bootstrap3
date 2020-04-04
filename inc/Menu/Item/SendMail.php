<?php

namespace dokuwiki\Menu\Item;

/**
 * Class SendMail
 */
class SendMail extends AbstractItem {

    /** @inheritdoc */
    public function __construct() {

        parent::__construct();

        if (! in_array('send-mail', explode(',', tpl_getConf('pageIcons')))) {
            throw new \RuntimeException("send-mail is not available");
        }

        unset($this->params['do']);

        $this->label = tpl_getLang('send_mail');
        $this->svg   = tpl_incdir() . 'images/menu/email-plus.svg';
        $this->id    = '#';

    }

    public function getLinkAttributes($classprefix = 'menuitem ') {

        $attr = array(
            'href'    => $this->getLink(),
            'title'   => $this->getTitle(),
            'rel'     => 'nofollow',
        );

        if ($classprefix !== false) $attr['class'] = $classprefix . $this->getType();

        return $attr;

    }

}
