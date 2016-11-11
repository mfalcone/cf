/* jshint undef: false, unused:false */
// AJAX Functions
var jq = jQuery;
var id, type;
var $elem;
jq(document).ready(function bpLike() {
    "use strict";

    function megusta() {
        console.log("z")
        id = jq(this).attr('id');                           // Used to get the id of the entity liked or unliked
         $elem = jq(this);
        type = jq(this).attr('class')                           //
            .replace('bp-primary-action ','')                   // end space needed to avoid double space in var type
            .replace('button', 'activity_update')               // clearer variable naming
            .replace('acomment-reply', 'activity_comment')
            .replace('blogpost', 'blog_post')
            .trim();
        type = type.split(' ');

        if (type.length < 2)
            return;

        var method = type[1];
        type = type[0];

        jq(this).addClass('loading');
        var activity_autor = $elem.parents('li').data("userid");
        console.log(activity_autor);
        jq.post(ajaxurl, {
            action: 'activity_like',
            'type': type,
            'method': method,
            'id': id,
            'activity_autor':activity_autor
        },
            function( data ) {
                console.log(data)
                jq('#' + id).fadeOut(100, function() {
                    jq(this).html(data).removeClass('loading').fadeIn(100);
                });

                // may only need one if and else if
                // if (like) {} else if (unlike) {} else {oops()}
                // leave for now as may need something for messages
                if (method == 'like') {

                    var counter = 40;
                    timer = setInterval(function() {
                        $elem.parent().find(".dedos").css({'background-position': '-'+counter+'px 0px'});
                        counter = counter+40;
                        
                        if(counter>= 200)clearTimeout(timer);
                        }, 100);
                    jq('#' + id).removeClass('like')
                        .addClass('unlike')
                        .attr('title', bplikeTerms.unlike_message)
                        .attr('id', id.replace("like", "unlike") );
                } else if (method == 'unlike') {

                    jq('#' + id).removeClass('unlike')
                        .addClass('like')
                        .attr('title', bplikeTerms.like_message)
                        .attr('id', id.replace("unlike", "like"));
                }

                if (type != 'activity_comment')
                    getLikes(id, type);

                // Nobody else liked this, so clear who likes the item
                if ( data == 'Like <span>0</span>' ) {
                    jq('#users-who-like-' + getItemId(id) ).empty();
                }

                type = type
                .replace( 'unlike', '' )
                .replace( 'like', '' )
                .trim();
                // Show who likes the item if user is first to like
                if (data == 'Unlike <span>1</span>') {
                    jq('#users-who-like-' + getItemId(id)).html('<small>' + bplikeTerms.you_like_this +'</small>');
                }

            });

        return false;
    }

    jq('.like, .unlike').on('click',megusta);

    function getItemId(id) {
        return id
          .replace('like-', '')
          .replace('unlike-', '')
          .replace('activity-', '')
          .replace('blogpost-', '')
          .replace('comment-', '')
          .replace('un', '');
    }

    // this function is to get likes of a post
    function getLikes( id, type ) {
      id = getItemId(id);
      type = type
           .replace('like', '')
           .replace('unlike' , '')
           .replace('un', '')
           .trim();

      jq('#users-who-like-' + id).addClass('loading');
      jq.post(ajaxurl, {
          action: 'bplike_get_likes',
          'type': type,
          'id': id
      }, function( response ) {
        response = response
          .replace('<p class="users-who-like" id="users-who-like-' + id + '">', '')
          .replace('</p>', '');

        jq('#users-who-like-' + id).html(response);
        jq('#users-who-like-' + id).removeClass('loading');

      })
    };


    window.cargarlosLikes = function(){
      var btlike = '<div class="like-unlike-wrapper"><div class="dedos"></div><a href="#" class="button bp-primary-action like" id="like-activity-213" title="Like this item">gracias por compartir <span>0</span> </a></div>'
     
      jQuery("#activity-stream li").each(function(ind,elem){
        if(!jQuery(elem).find(".activity-content .like-unlike-wrapper").size()){
            jQuery(elem).find(".activity-content .activity-meta").append(btlike);
            jQuery(elem).find('.like, .unlike').on('click',megusta);
        }
      })
    }
      
});
