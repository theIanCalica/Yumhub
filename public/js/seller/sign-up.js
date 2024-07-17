$(document).ready(function () {
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
                minlength: 11,
                remote: {
                    url: "/api/checkPhoneNumber",
                    type: "post",
                    data: {
                        phoneNumber: function () {
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
                equalTo: "#password",
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
                equalTo: "Passwords do not match!",
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
                    $("#seller_id").val(data.seller.id);
                    $("#restoForm").submit();
                    // window.location.href = "/sign-in";
                },
                error: function (data) {
                    console.log(data);
                },
            });
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        success: function (label) {
            // Custom success function
            label.addClass("text-green-500"); // Example: add a Tailwind CSS class for green text
            var input = $(label).prev("input");
            $(input).removeClass("border-red-500");
            $(input).addClass("border-green-500");
        },
    });

    $("#restoForm").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255,
            },
            address: {
                required: true,
            },
            phoneNumber: {
                required: true,
                maxlength: 11,
                minlength: 11,
                remote: {
                    url: "/api/checkRestoPhoneNum",
                    type: "post",
                    data: {
                        phoneNumber: function () {
                            return $("#phoneNumber").val();
                        },
                    },
                },
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "/api/restoCheckEmail", // Endpoint to check email availability
                    type: "post",
                    data: {
                        email: function () {
                            return $("#email").val(); // Get the value of email input
                        },
                    },
                },
            },
            logo: {
                required: true,
                accept: "image/png, image/jpeg, image/jpg",
            },
            desc: {
                required: true,
            },
            opHours: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter your restaurant's name!",
                maxlength: "Restaurant name must not exceed 255 characters!",
            },
            address: {
                required: "Please enter the address of your restaurant!",
            },
            phoneNumber: {
                required: "Please enter the phone number of your restaurant!",
                minlength: "Phone number must be exactly 11 digits!",
                maxlength: "Phone number must be exactly 11 digits!",
                remote: "Phone Number already taken!",
            },
            email: {
                required: "Please enter your email!",
                email: "Invalid email format!",
                remote: "Email already taken!",
            },
            logo: {
                required: true,
                accept: "image/png, image/jpeg, image/jpg",
            },
            desc: {
                required: "Please enter description of restaurant!",
            },
            opHours: {
                required: "PLease ebter operating hours",
            },
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        success: function (label) {
            // Custom success function
            label.addClass("text-green-500"); // Example: add a Tailwind CSS class for green text
            var input = $(label).prev("input");
            $(input).removeClass("border-red-500");
            $(input).addClass("border-green-500");
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
