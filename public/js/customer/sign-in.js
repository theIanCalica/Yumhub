$(document).ready(function () {
    $("#sign-in-form").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "Please enter your email",
            },
            password: {
                required: "Please enter your password",
            },
        },
        submitHandler: function (form) {
            // Form submission if valid
            console.log("Form submitted!");
            // You can perform AJAX submission or other actions here
        },
    });

    $("#email").on("input", function () {
        const email = $(this).val().trim();

        // Regular expression for email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (emailRegex.test(email)) {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#password").on("input", function () {
        const password = $(this).val().trim();

        if (password.length <= 6) {
            $(this).removeClass("success");
            $(this).addClass("error");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });
});
