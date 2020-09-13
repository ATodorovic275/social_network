$(document).ready(function() {
    // $("#user_search").keyup(paginateUsers);
});

function paginateUsers() {
    let value = $(this).val();
    console.log(value);

    $.ajax({
        type: "get",
        url: "/admin/user?value=" + value,
        dataType: "json",
        success: function(data, text, xhr) {
            console.log(xhr);
        },
        error: function(xhr, text, error) {
            console.log(xhr);
        }
    });
}
