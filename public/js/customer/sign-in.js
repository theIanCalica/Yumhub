$(document).ready(function () {
    $("#sign-in-form").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 6,
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
            const formData = new FormData(form);
            for (var pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }

            $.ajax({
                type: "POST",
                url: "/api/sign-in/auth",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) {},
            });
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
