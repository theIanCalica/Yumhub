$(document).ready(function () {
    $("#profileForm").validate({
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
            email: {
                required: true,
                email: true,
                remote: {
                    url: "/api/checkEmail",
                    type: "post",
                    data: {
                        email: function () {
                            return $("#email").val();
                        },
                    },
                    dataFilter: function (response) {
                        return response;
                        console.log(response);
                        // var json = JSON.parse(response);
                        // if (json.valid) {
                        //     return true;
                        // } else {
                        //     return "This email is already taken.";
                        // }
                    },
                },
            },
            phoneNumber: {
                required: true,
                minlength: 11,
                maxlength: 11,
                remote: {
                    url: "/api/checkPhoneNumber",
                    type: "post",
                    data: {
                        phoneNumber: function () {
                            return $("#phoneNumber").val();
                        },
                    },
                    dataFilter: function (response) {
                        var json = JSON.parse(response);
                        if (json.valid) {
                            return true;
                        } else {
                            return "This phone number is already taken.";
                        }
                    },
                },
            },
            address: {
                required: true,
            },
            profilePicture: {},
        },
        messages: {
            fname: {
                required: "Please enter your first name!",
                maxlength: "First Name must not exceed 255 characters!",
            },
            lname: {
                required: "Please enter your last name!",
                maxlength: "Last Name must not exceed 255 characters!",
            },
            gender: {
                required: "Please select your gender!",
            },
            dob: {
                required: "Please enter your date of birth!",
                date: "Invalid date format!",
            },
            email: {
                required: "Please enter your email!",
                email: "Not a valid email!",
                remote: "Email already taken!",
            },
            phoneNumber: {
                required: "Please enter your phone number!",
                minlength: "Not a valid phone number!",
                maxlength: "Not a valid phone number!",
                remote: "Phone number already taken!",
            },
            address: {
                required: "Please enter your address!",
            },
            profilePicture: {},
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
        submitHandler: function (form) {
            const formData = new FormData(form);
            formData.append("_method", "PUT");

            const id = formData.get("user_id");
            $.ajax({
                type: "POST",
                url: `/api/update-admin/${id}`,
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
                    $("#fname").val(data.user.fname);
                    $("#lname").val(data.user.lname);
                    $("#gender option").each(function () {
                        if ($(this).val() == data.user.gender) {
                            $(this).prop("selected", true);
                        }
                    });
                    $("#dob").val(data.user.dob);
                    $("#email").val(data.user.email);
                    $("#phoneNumber").val(data.user.phoneNumber);
                    $("#address").val(data.user.address);
                    $("#profilePicture").val(data.user.filePath);
                },
            });
        },
    });
});
