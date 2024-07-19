$(document).ready(function () {
    $.validator.addMethod(
        "passwordMatch",
        function (value, element) {
            // Check if password and confirmpassword fields match
            return $("#password").val() === value;
        },
        "Passwords do not match"
    );

    $.validator.addMethod(
        "minAge",
        function (value, element, min) {
            var inputDate = new Date(value);
            var currentDate = new Date();
            var minAgeDate = new Date(
                currentDate.setFullYear(currentDate.getFullYear() - min)
            );

            return inputDate <= minAgeDate;
        },
        "You must be at least 18 years old."
    );

    $("#sign-up-form").validate({
        rules: {
            fname: {
                required: true,
                maxlength: 255,
            },
            lname: {
                required: true,
                maxlength: 255,
            },
            gender: {
                required: true,
            },
            dob: {
                required: true,
                date: true,
                minAge: 18,
            },
            phoneNumber: {
                required: true,
                maxlength: 11,
                remote: {
                    url: "/api/checkPhoneNumber",
                    type: "post",
                    data: {
                        email: function () {
                            return $("#phoneNumber").val();
                        },
                    },
                },
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "/api/checkEmail", // Endpoint to check email availability
                    type: "post",
                    data: {
                        email: function () {
                            return $("#email").val(); // Get the value of email input
                        },
                    },
                },
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
            address: {
                required: true,
            },
        },
        messages: {
            fname: {
                required: "Please enter your first name!",
            },
            lname: {
                required: "Please enter your last name!",
            },
            gender: {
                required: "Select a Gender!",
            },
            dob: {
                required: "Please enter your Date of Birth!",
                date: "Please enter a valid date format",
                minAge: "You must be at least 18 years old.",
            },
            address: {
                required: "Please enter your address!",
            },
            phoneNumber: {
                required: "Please enter your phone number!",
                remote: "This phone number is already taken!",
            },
            email: {
                required: "Please enter your email!",
                email: "Invalid email format!",
                remote: "This email is already taken!",
            },
            password: {
                required: "Please enter your password!",
            },
            confirmpassword: {
                required: "Please confirm your passwor!",
                minlength: "Password must be at least 6 characters long!",
                passwordMatch: "Passwords do not match!",
            },
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            formData.append("role", "customer");
            for (var pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }

            $.ajax({
                type: "POST",
                url: "/api/register",
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
