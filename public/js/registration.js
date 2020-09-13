$(document).ready(function() {
    $("#btn_registration").click(registrationFormValidation);
});

function registrationFormValidation() {
    // data

    var firstName = $("#first_name").val();
    var lastName = $("#last_name").val();
    var email = $("#email").val();
    var username = $("#reg_username").val();
    var password = $("#reg_password").val();

    //regex
    var firstNameRegex = /^[A-Z]{1}[a-z]+$/;

    //email
    var emailDigitRegex = /\d*/;
    var emailLetterRegex = /[a-z]*/;
    var emailSpecialRegex = /[!@#$%%^&*?]*/;
    var emailProvidersRegex = /@(gmail\.|yahoo\.|ict\.edu\.)(com|rs)$/;
    var emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    var usernameRegex = /^[\w!@#$%^&*]+$/;

    //password
    var passwordDigitRegex = /\d+/;
    var passwordLetterRegex = /[a-z]+/;
    var passwordSpecialCaracterRegex = /[!@#$%%^&*?]+/;

    var errors = [];

    if (!firstNameRegex.test(firstName)) {
        errors.push("Ime mora poceti velikim slovom");
    } else {
        console.log("Ime je ok");
    }

    if (!firstNameRegex.test(lastName)) {
        errors.push("Prezime mora poceti velikim slovom");
    } else {
        console.log("Prezime je ok");
    }

    // var marker = true;
    // if (!emailProvidersRegex.test(email)) {
    //     marker = false;
    //     console.log("email nije ok");
    // } else {
    //     // console.log("email je ok");
    //     marker = true;
    // }

    // if (marker) {
    //     if (
    //         !emailDigitRegex.test(email) &&
    //         !emailLetterRegex.test(email) &&
    //         !emailSpecialRegex.test(email)
    //     ) {
    //         // errors.push("Email nije ok");
    //         console.log("email nije ok 2 provera");
    //     } else {
    //         console.log("Email je ok");
    //     }
    // }

    // if (
    //     (!emailDigitRegex.test(email) && !emailLetterRegex.test(email)) ||
    //     (email == "" && !emailProvidersRegex.test(email))
    // ) {
    //     errors.push("Email nije ok");
    // } else {
    //     console.log("Email je ok");
    // }

    if (!emailRegex.test(email)) {
        errors.push("Email nije u dobrom formatu");
    } else {
        console.log("Email je ok");
    }

    if (!usernameRegex.test(username)) {
        errors.push(
            "Username mora sadrzati mala slova ili broj i specijalni karakter"
        );
    } else {
        console.log("username ok");
    }

    if (
        !passwordDigitRegex.test(password) &&
        !passwordLetterRegex.test(password) &&
        !passwordSpecialCaracterRegex.test(password)
    ) {
        errors.push(
            "Password mora sadrzati mala slova, minimum jedan broj i specijalan znak"
        );
    } else {
        console.log("password je ok");
    }

    if (errors.length != 0) {
        showErrors(errors);
    } else {
        // $("#reg_error").html("");

        $.ajax({
            type: "post",
            url: "/doRegist",
            data: {
                _token: $("input[name='_token']").val(),
                first_name: firstName,
                last_name: lastName,
                email: email,
                username: username,
                password: password
            },
            dataType: "json",
            success: function(data, text, xhr) {
                console.log(xhr);
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

        $("#reg_error").html(string);
    }
}
