$(document).ready(function () {
    $.validator.addMethod(
        "passwordMatch",
        function (value, element) {
            // Check if password and confirmpassword fields match
            return $("#password").val() === value;
        },
        "Passwords do not match"
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
            region: {
                required: true,
                maxlength: 255,
            },
            province: {
                required: true,
                maxlength: 255,
            },
            city: {
                required: true,
                maxlength: 255,
            },
            barangay: {
                required: true,
                maxlength: 255,
            },
            street: {
                required: true,
                maxlength: 255,
            },
            houseNo: {
                required: true,
                maxlength: 255,
            },
            zipCode: {
                required: true,
                maxlength: 4,
            },
        },
        messages: {
            fname: {
                required: "Please enter your first name!",
            },
            lname: {
                required: "This field is required!",
            },
            gender: {
                required: "This field is required!",
            },
            dob: {
                required: "This field is required!",
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
            region: {
                required: "Please enter your region!",
                maxlength: "Region name can't exceed 255 characters!",
            },
            province: {
                required: "Please enter your province!",
                maxlength: "Province name can't exceed 255 characters!",
            },
            city: {
                required: "Please enter your city!",
                maxlength: "City name can't exceed 255 characters!",
            },
            barangay: {
                required: "Please enter your barangay!",
                maxlength: "Barangay name can't exceed 255 characters!",
            },
            street: {
                required: "Please enter your street!",
                maxlength: "Barangay name can't exceed 255 characters!",
            },
            houseNo: {
                required: "Please enter your house number!",
                maxlength: "House number name can't exceed 255 characters!",
            },
            zipCode: {
                required: "Please enter your zip code!",
                maxlength: "Zip code can't exceed 4 characters!",
            },
        },
        submitHandler: function (form) {
            var formData = new FormData(form);

            formData.append("role", "customer");

            // Log each form entry to the console
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
