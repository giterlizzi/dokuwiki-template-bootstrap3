/*!
 * DokuWiki Bootstrap3 Template
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

jQuery(document).ready(function() {

  var $tags           = jQuery('.mode_show .tags'),      // Tags Plugin
      $translation    = jQuery('#dw__translation'),      // Translation Plugin
      $discussion     = jQuery('.comment_wrapper'),      // Discussion Plugin
      $publish        = jQuery('.approval'),             // Publish Plugin
      $tagging_edit   = jQuery('.plugin_tagging_edit'),  // Tagging Plugin
      $explain        = jQuery('.explain');              // Explain Plugin


  // Publish plugin
  if ($publish.length) {

    $publish.removeClass('approval').addClass('alert');

    jQuery('.apr_table').removeClass('table-striped');

    if ($publish.hasClass('approved_no')) {
      $publish.removeClass('approved_no')
        .addClass('alert-warning')
        .prepend('<i class="glyphicon glyphicon-exclamation-sign"/> ');
    }
    if ($publish.hasClass('approved_yes')) {
      $publish.removeClass('approved_yes')
        .addClass('alert-success')
        .prepend('<i class="glyphicon glyphicon-ok-sign"/> ');
    }

    $publish.prependTo('.page');

  }


  // Discussion plugin
  if ($discussion.length) {

    $discussion.find('h2').addClass('page-header');
    $discussion.find('.comment_buttons').addClass('text-right');
    $discussion.find('#discussion__section').prepend('<i class="glyphicon glyphicon-comment"/> ');

    $discussion.find('.hentry').addClass('panel panel-default');
    $discussion.find('.hentry .comment_head').addClass('panel-heading');
    $discussion.find('.hentry .comment_body').addClass('panel-body');
    $discussion.find('.toolbar').addClass('btn-group');
    $discussion.find('.comment_buttons [type=submit]').addClass('btn-xs');
    $discussion.find('.comment_buttons .discussion__delete .btn').addClass('btn-danger');
    $discussion.find('.comment_buttons .discussion__reply .btn').addClass('btn-success');
    $discussion.find('#discussion__btn_submit').addClass('btn-success');

    jQuery(document).bind('DOMNodeInserted', function(){
      $discussion.find('.toolbutton').addClass('btn btn-xs');
    });

  }


  // Translation Plugin
  if ($translation.length) {

    var $current = $translation.find('.cur'),
        $lang    = $current.text(),
        $iso     = $lang.match(/\(([a-z]*)\)/),
        $flag    = $current.find('img');

    $current.parent().addClass('active');
    $translation.find('.wikilink2').removeClass('wikilink2').css('opacity', '0.5');

    if ($flag.length) {
      $translation.find('.dropdown-toggle i').hide();
      $translation.find('.dropdown-toggle').prepend(
        jQuery('<img/>').attr({
          'src'   : $flag.attr('src'),
          'title' : $flag.attr('title') }));
    }

  }


  // Tags plugin
  if ($tags.length) {

    $tags.each(function() {

      var $tag = jQuery(this);
      $tag.html($tag.html().replace(/,/g, ''));

      var $tagLabel = $tag.find('a').addClass('label label-default')
                                    .prepend('<i class="glyphicon glyphicon-tag"/> ');

      if ($tag.prop('tagName').toLowerCase() == 'div') {
        $tag.hide();
        $tagLabel.prependTo('.pageId').css('marginLeft', '3px');
      }

    });

  }


  // Tagging plugin
  if ($tagging_edit.length) {
    $tagging_edit.find(':submit').addClass('btn-xs');
    $tagging_edit.find('[type=text]').addClass('input-sm');
    $tagging_edit.find('#tagging__edit_save').addClass('btn-success');
  }


  if (jQuery('.mode_media').length) {
    jQuery(document).ajaxSuccess(function() {
      // Gallery Plugin (Media Manager)
      jQuery('.mode_media .meta .row').removeClass('row');
    });
  }


  // Explain Plugin
  if ($explain.length) {

    $explain.each(function(){

      var $self    = jQuery(this),
          $tooltip = $self.find('.tooltip');
  
      $self.attr({
        'data-toggle'    : 'tooltip',
        'data-placement' : 'bottom',
        'title'          : $tooltip.html(),
      }).addClass('wikilink1').removeClass('explain');
  
      $tooltip.remove();

    });

    jQuery('[data-toggle="tooltip"]').tooltip();

  }

});
