<?php

namespace dokuwiki\Menu\Item;

/**
 * Class Discussion
 */
class Discussion extends AbstractItem
{

    /** @inheritdoc */
    public function __construct()
    {

        parent::__construct();

        if (!tpl_getConf('showDiscussion')) {
            throw new \RuntimeException("discussion is not available");
        }

        unset($this->params['do']);

        $discuss_page     = str_replace('@ID@', $this->id, tpl_getConf('discussionPage'));
        $discuss_page_raw = str_replace('@ID@', '', tpl_getConf('discussionPage'));
        $is_discuss_page  = strpos($this->id, $discuss_page_raw) !== false;
        $back_id          = str_replace($discuss_page_raw, '', $this->id);

        if ($is_discuss_page) {
            $this->label = tpl_getLang('back_to_article');
            $this->id    = cleanID($back_id);
            $this->svg   = tpl_incdir() . 'images/menu/file-document-box-outline.svg';
        } else {
            $this->label = tpl_getLang('discussion');
            $this->id    = cleanID($discuss_page);
            $this->svg   = tpl_incdir() . 'images/menu/comment-text-multiple.svg';
        }

    }

}
