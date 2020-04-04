<?php

namespace dokuwiki\Menu\Item;

/**
 * Class ShareOn
 */
class ShareOn extends AbstractItem {

    /** @inheritdoc */
    public function __construct() {

        parent::__construct();

        if (! in_array('social-share', explode(',', tpl_getConf('pageIcons')))) {
            throw new \RuntimeException("share on is not available");
        }

        unset($this->params['do']);

        $this->label    = tpl_getLang('share_on');
        $this->svg      = tpl_incdir() . 'images/menu/share-variant.svg';
        $this->id       = '#';

    }

    public function getLinkAttributes($classprefix = 'menuitem dropdown-toggle ') {

        global $ID;

        $attr = array(
            'href'          => $this->getLink(),
            'title'         => $this->getTitle(),
            'rel'           => 'nofollow',
            'data-toggle'   => 'dropdown',
            'data-remote'   => wl($ID),
            'data-target'   => '#',
            'aria-haspopup' => 'true',
            'aria-expanded' => 'true',

        );

        if ($classprefix !== false) $attr['class'] = $classprefix . $this->getType();

        return $attr;

    }


    public function getDropDownMenu() {

        $enabled_providers = explode(',', tpl_getConf('socialShareProviders'));

        $share_providers = array(
            'twitter'   => array( 'label' => 'Twitter', ),
            'linkedin'  => array( 'label' => 'LinkedIn', ),
            'facebook'  => array( 'label' => 'Facebook', ),
            'pinterest' => array( 'label' => 'Pinterest', ),
            'telegram'  => array( 'label' => 'Telegram', ),
            'whatsapp'  => array( 'label' => 'WhatsApp', ),
            'yammer'    => array( 'label' => 'Yammer', ),
            'reddit'    => array( 'label' => 'Reddit', ),
        );

        $html = '';

        $html .= '<ul class="dropdown-menu">';
        $html .= '<li class="dropdown-header">';
        $html .= iconify('mdi:share-variant') . ' '. tpl_getLang('share_on') .'...';
        $html .= '</li>';

        foreach ($share_providers as $provider => $data) {

            if (! in_array($provider, $enabled_providers)) {
                continue;
            }

            $html .= '<li><a href="#" class="share share-'. $provider .'" title="'. tpl_getLang('share_on') .' '. $data['label'] .'">'. iconify("mdi:$provider") .' '. $data['label'] .'</a></li>';

        }

        $html .= '</ul>';

        return $html;
    
    }

}
