<?php

namespace dokuwiki\Menu\Item;

/**
 * Class Help
 */
class Help extends AbstractItem {

    /** @inheritdoc */
    public function __construct() {

        parent::__construct();

        if (! in_array('help', explode(',', tpl_getConf('pageIcons')))) {
            throw new \RuntimeException("help is not available");
        }

        unset($this->params['do']);

        $help_page = page_findnearest('help', tpl_getConf('useACL'));

        if (! $help_page) {
            throw new \RuntimeException("help page not found");
        }

        $this->label = hsc(p_get_first_heading($help_page));
        $this->svg   = tpl_incdir() . 'images/menu/help.svg';
        $this->id    = '#';
        $this->help  = wl($help_page, array('do' => 'export_xhtmlbody'));

    }

    public function getLinkAttributes($classprefix = 'menuitem ') {

        $attr = array(
            'href'        => $this->getLink(),
            'title'       => $this->getTitle(),
            'rel'         => 'nofollow',
            'data-toggle' => 'modal',
            'data-target' => '.modal.help',
            'data-page'   => $this->help,
            'onclick'     => "jQuery('.modal.help .modal-title').html(jQuery(this).attr('title')); jQuery('.modal.help .modal-body').load(jQuery(this).data('page'));"
        );

        if ($classprefix !== false) $attr['class'] = $classprefix . $this->getType();

        return $attr;

    }

}
