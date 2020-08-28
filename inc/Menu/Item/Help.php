<?php

namespace dokuwiki\Menu\Item;

/**
 * Class Help
 */
class Help extends AbstractItem
{

    /** @inheritdoc */
    public function __construct()
    {
        parent::__construct();

        if (!in_array('help', explode(',', tpl_getConf('pageIcons')))) {
            throw new \RuntimeException("help is not available");
        }

        unset($this->params['do']);

        $help_id = page_findnearest('help', tpl_getConf('useACL'));

        if (!$help_id) {
            throw new \RuntimeException("help page not found");
        }

        $this->label     = hsc(p_get_first_heading($help_id));
        $this->svg       = tpl_incdir() . 'images/menu/help.svg';
        $this->id        = '#';
        $this->help_id   = $help_id;
        $this->help_link = wl($help_id, array('do' => 'export_xhtmlbody'));
    }

    public function getLinkAttributes($classprefix = 'menuitem ')
    {
        $attr = parent::getLinkAttributes($classprefix);

        $attr['data-toggle']  = 'modal';
        $attr['data-help-id'] = $this->help_id;
        $attr['data-target']  = '.modal.help';
        $attr['data-link']    = $this->help_link;

        return $attr;
    }
}
