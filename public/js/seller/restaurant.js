$(document).ready(function () {
    $("#profileForm").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255,
            },
            address: {
                required: true,
                maxlength: 255,
            },
            email: {
                email: true,
                required: true,
            },
            phoneNumber: {
                required: true,
                minlength: 11,
                maxlength: 11,
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
