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
    $("#loginBtn").on("click", function () {
        console.log("hi");
    });
});
