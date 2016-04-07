/*
 * DokuWiki Bootstrap3 Template: Plugins Hacks!
 *
 * Home     http://dokuwiki.org/template:bootstrap3
 * Author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * License  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// Discussion plugin

var $discussion = jQuery('.comment_wrapper');

if ($discussion.length) {

  $discussion.find('h2').addClass('page-header');
  $discussion.find('.comment_buttons').addClass('text-right');
  $discussion.find('#discussion__section').prepend('<i class="fa fa-fw fa-comments"/> ');

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
