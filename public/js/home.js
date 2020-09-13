$(document).ready(function() {
    $("#search_user").keyup(getUsers);
    $(".add-friend").click(addFriend);
});
var url = window.location.origin;

function getUsers() {
    let name = $(this).val();

    if (name != "") {
        $.ajax({
            type: "get",
            url: url + "/api/user",
            data: {
                name: name
            },
            dataType: "json",
            success: function(data, text, xhr) {
                console.log(xhr);
                console.log(url);
                displayUsers(data);
            },
            error: function(xhr, text, error) {
                console.log(xhr);
            }
        });
    } else {
        // $("#search_users_list").html("");
        $("#search_users_list").fadeOut();
    }
}

function displayUsers($users) {
    let string = "<ul>";
    $users.forEach(u => {
        string += `
            <li>
            <img class='user_img' src='${url}/img/users/${u.profile_img_src}'/>
            <a href='/user_profile/${u.id_user}' class='one_user' data-id=${u.id}>${u.first_name} ${u.last_name}</a></li>
        `;
    });
    string += `</ul>`;

    $("#search_users_list").html(string);
    $("#search_users_list").fadeIn();
}

function addFriend() {
    let idSugestion = $(this).data("id-sugestion");
    // console.log(idSugestion);
    let idUser = $(this).data("id-user");

    $.ajax({
        type: "post",
        url: "api/add-friend",
        data: {
            idSugestion: idSugestion,
            idUser: idUser
        },
        dataType: "json",
        success: function(data, text, xhr) {
            console.log(xhr);
        },
        error: function(xhr, text, error) {
            console.log(xhr);
        }
    });
}
