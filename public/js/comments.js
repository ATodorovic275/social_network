$(document).ready(function() {
    $(".post_comment").click(postComment);
    // $(".comment").click(comment);
    $(".like").click(likePost);
});

var url = window.location.origin;

function postComment() {
    idPost = $(this)
        .prev()
        .prev()
        .prev()
        .val();
    console.log(idPost);
    comment = $(this)
        .prev()
        .val();
    idUser = $(this)
        .prev()
        .prev()
        .val();

    $.ajax({
        type: "post",
        url: "/api/comments/post",
        data: {
            comment: comment,
            idPost: idPost,
            idUser: idUser
        },
        dataType: "json",
        success: function(data, text, xhr) {
            console.log(xhr);
            //ucitavanje postova
            getPosts();
        },
        error: function(xhr, text, error) {
            console.log(xhr);
        }
    });
}

// function comment() {
//     // console.log($(".comment"));
//     let commentsSpan = $(".comment");
//     let commentInputs = $(".comment_input");
//     // console.log(commentInputs);
// }

function likePost(e) {
    e.preventDefault();
    let idUser = $(this).data("id-user");
    let idPost = $(this).data("id-post");

    console.log(idPost);

    $.ajax({
        type: "post",
        url: "/api/like_post",
        data: {
            idUser: idUser,
            idPost: idPost
        },
        dataType: "json",
        success: function(data, text, xhr) {
            console.log(xhr);
            //ucitavanje postova
            getPosts();
        },
        error: function(xhr, text, error) {
            console.log(xhr);
        }
    });
}

function getPosts() {
    $.ajax({
        type: "get",
        url: "/posts_ajax",
        dataType: "json",
        success: function(data, text, xhr) {
            console.log(xhr);
            //ucitavanje postova
            displayPost(data);
        },
        error: function(xhr, text, error) {
            console.log(xhr);
        }
    });
}

function displayPost(post) {
    let string = `<div id="make_post">
    <h3>New post</h3>

        <form action="${url}/posts" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="NLZMPShyUETtl7mwCCSwXToKE9n318zw2TkGw8cd">                                <span>Description:</span>
              <textarea name="post_description" id="post_description" cols="30" rows="3"></textarea><br>
              <span>Picture</span><br>
              <input type="file" name="post_img" id="post_img"><br>
              <input type="submit" value="Post">
          </form>
    </div>`;

    post.forEach(p => {
        string += `
        <div id="post" class="col-side">
        <div class="content-head">
            <img src="${url}/img/users/${p.profile_img_src}" alt="${
            p.profile_img_alt
        }" class="img-fludi float-left" height="50px">
            <div class="head-title float-left"> 
                <a href="" ><h2>${p.first_name} ${p.last_name}</h2></a>
                <p>Published: ${p.created_post}</p>
            </div>
            <div class="clearfix"></div>
        </div>
        <img src="${url}/img/posts/${p.src}" alt="${p.alt}" class="img-fluid">
        <div class="content-description">
            <p>${p.description}</p>
        </div>
        <div class="like-comments">
            <div class="like-comments-numb float-left">
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                <span>${p.numberOfLikes}</span>
            </div>
            <div class="like-comments-numb float-left">
                <i class="fa fa-comments" aria-hidden="true"></i>
                <span>${p.numberOfComments}</span>
            </div>
            <div class="clearfix"></div>
        </div>
        <hr>
        <div class="like-or-comments">
        <div class="like-or-comment float-left">
            <a href="#" class="like" data-id-post='${
                p.id_post
            }' data-id-user='${p.id_user}'>
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                <span>Like post</span>
            </a>
        </div>
        <div class="like-or-comment float-left">
            <i class="fa fa-comment" aria-hidden="true"></i>
            <span class="comment" data-id=${p.id_post}>Comment</span>           
        </div>
        <div class="clearfix"></div>
        </div>
        <ul>
        ${displayComments(p.comments)}
    </ul>
        <hr>
        <img src="${url}/img/users/${
            p.userFromSession.profile_img_src
        }" alt="" class="img-fludi float-left" height="30px">

    <form action="" method="post">
            <input type="hidden" name="post_id" id="post_id" value="${
                p.id_post
            }">
            <input type="hidden" name="user_id" id="user_id" value="${
                p.userFromSession.id_user
            }">
            <input type="text" name="comment" id="comment" class="comment_input">
            <input type="button" value="Send" class="post_comment" name="post_comment">
        </form>
    </div>      
        `;
    });

    $("#scroll").html(string);
    $(".like").click(likePost);
    $(".post_comment").click(postComment);
}

function displayComments(comments) {
    let string = "";
    comments.forEach(c => {
        string += `<li> ${c.first_name} ${c.text}</li>`;
    });
    return string;
}
