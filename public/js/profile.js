$(document).ready(function() {
    $("#profile_img_link").click(function(e) {
        e.preventDefault();
        console.log("link");
        console.log($("#profile_img_file"));
        // $("#profile_img_file").trigger("click");
        $("#profile_img_file").click();
    });

    $("#profile_img_file").change(function() {
        $("#send_profile_img").click();
    });
});
