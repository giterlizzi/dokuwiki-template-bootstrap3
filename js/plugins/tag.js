/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Tag Plugin

var $tags = jQuery('.tags'),
    $page = jQuery('table tbody th.page:even');

// Tag Plugin: Count
if ($page.length) {

  $page.each(function(){
    var $table  = jQuery(this).parents('table'),
        $header = $table.find('th');
    $table.prepend('<thead><tr/></thead>');
    $table.find('thead tr').append($header);
    $header.removeClass('page');
  });

}

// Tag Plugin: Tags
if ($tags.length) {

  $tags.each(function() {

    var $tag = jQuery(this);
    $tag.html($tag.html().replace(/,/g, ''));

    var $tagLabel = $tag.find('a').addClass('label label-default')
                                  .prepend('<i class="fa fa-fw fa-tag"/> ');


    if (JSINFO.bootstrap3.config.tagsOnTop && $tag.prop('tagName').toLowerCase() == 'div' && ! $tag.parents('.plugin_include_content').length) {
      $tag.remove();
      $tagLabel.prependTo('.pageId');
    }

    if ($tag.parents('.plugin_include_content').length) {
      $tag.find('span').contents().unwrap();
    }

  });

}
