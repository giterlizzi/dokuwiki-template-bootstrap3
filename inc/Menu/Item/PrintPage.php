<?php

namespace dokuwiki\Menu\Item;

/**
 * Class PrintPage
 */
class PrintPage extends AbstractItem
{

    /** @inheritdoc */
    public function __construct()
    {
        parent::__construct();

        if (!in_array('print', explode(',', tpl_getConf('pageIcons')))) {
            throw new \RuntimeException("print is not available");
        }

        unset($this->params['do']);

        $this->label = tpl_getLang('print');
        $this->svg   = tpl_incdir() . 'images/menu/printer.svg';
        $this->id    = '#';
    }
}
