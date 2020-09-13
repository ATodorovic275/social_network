$(document).ready(function() {
    $("#btn_login").click(loginFormValidation);
});

function loginFormValidation() {
    //data

    var username = $("#log_username").val();
    var password = $("#log_password").val();

    //regex
    var usernameRegex = /^[\w!@#$%^&*]+$/;
    var passwordDigitRegex = /\d+/;
    var passwordLetterRegex = /[a-z]+/;
    var passwordSpecialCaracterRegex = /[!@#$%%^&*?]+/;
    var error = [];

    if (!usernameRegex.test(username)) {
        error.push(
            "Username mora sadrzati mala slova ili broj i specijalni karakter"
        );
    } else {
        console.log("username ok");
    }

    // if (!passwordDigitRegex.test(password)) {
    //     console.log("password nema broj");
    // }

    // if (!passwordLetterRegex.test(password)) {
    //     console.log("password nema slovo");
    // }

    if (
        (!passwordDigitRegex.test(password) &&
            !passwordLetterRegex.test(password)) ||
        !passwordSpecialCaracterRegex.test(password)
    ) {
        console.log("password NIJE OK");
    } else {
        console.log("password OK");
    }

    // if (
    //     !passwordDigitRegex.test(password) &&
    //     !passwordLetterRegex.test(password)
    // ) {
    //     error.push(
    //         "Password mora sadrzati mala slova, minimum jedan broj i specijalan znak"
    //     );
    // } else {
    //     console.log("password je ok");
    // }

    if (error.length != 0) {
        showErrors(error);
    } else {
        $.ajax({
            type: "post",
            url: "/doLogin",
            data: {
                _token: $("input[name='_token']").val(),
                username: username,
                password: password
            },
            dataType: "json",
            success: function(data, text, xhr) {
                console.log(xhr);
                window.location.href = "/";
            },
            error: function(xhr, test, err) {
                console.log(xhr);
                if (xhr.status == 422) {
                    showErrors(xhr.responseJSON.errors);
                }
            }
        });
    }

    function showErrors(errors) {
        let string = "<ul>";
        errors.forEach(e => {
            string += `
                <li>${e}</li>
            `;
        });
        string += `</ul>`;

        $("#log_error").html(string);
    }
}
