$(document).ready(function () {
    $("#changePassForm").validate({
        rules: {
            old_password: {
                required: true,
                minlength: 6,
            },
            new_password: {
                required: true,
                minlength: 6,
            },
            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: "#new_password",
            },
        },
        messages: {
            old_password: {
                required: "Please enter your old password!",
                minlength: "Password must be at least 6 characters long!",
            },
            new_password: {
                required: "Please enter your new password!",
                minlength: "Password must be at least 6 characters long!",
            },
            confirm_password: {
                required: "Please confirm your new password!",
                minlength: "Password must be at least 6 characters long!",
                equalTo: "Passwords do not match!",
            },
        },
        success: function (label, element) {
            $(element).removeClass("error");
            $(element).addClass("success");
            $(label).remove();
        },
        errorPlacement: function (error, element) {
            error.addClass("success");
            $(element).addClass("error");
            error.insertAfter(element);
        },
    });
});
