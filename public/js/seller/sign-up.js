$(document).ready(function () {
    $("#sign-up-form").validate({
        rules: {
            fname: {
                required: true,
            },
            lname: {
                required: true,
            },

            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 6,
            },
            confirmpassword: {
                required: true,
                minlength: 6,
                passwordMatch: true, // Use the custom method for matching passwords
            },
        },
        messages: {
            email: {
                required: "Please enter your email",
            },
            password: {
                required: "Please enter your password",
            },
            confirmpassword: {
                required: "Please confirm your password",
                minlength: "Password must be at least 6 characters long",
                passwordMatch: "Passwords do not match",
            },
        },
        submitHandler: function (form) {
            var formData = new FormData(form);

            formData.append("role", "seller");
            // Log each form entry to the console
            for (var pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }

            $.ajax({
                type: "POST",
                url: "/api/users",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    sessionStorage.setItem(
                        "successMessage",
                        "Your request was successful!"
                    );
                    $("#sign-up-form").find("input").val("");
                    window.location.href = "/sign-in";
                },
                error: {},
            });
        },
        success: function (label, element) {
            $(element).removeClass("error").addClass("success");
        },
    });
    $("#fname").on("input", function () {
        const fnameVal = $(this).val().trim();

        if (fnameVal != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#lname").on("input", function () {
        const lnameVal = $(this).val().trim();

        if (lnameVal != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });
    $("#email").on("input", function () {
        const emailVal = $(this).val().trim();

        if (emailVal != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
        }
    });

    $("#password").on("input", function () {
        const passwordVal = $(this).val().trim();

        if (passwordVal !== "" && passwordVal.length > 6) {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#confirmpassword").on("input", function () {
        const confirmPasswordVal = $(this).val().trim();

        if (confirmPasswordVal !== "" && confirmPasswordVal.length > 6) {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
        }
    });
});
