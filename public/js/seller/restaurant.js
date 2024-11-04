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
                required: true,
                email: true,
            },
            phoneNumber: {
                required: true,
                minlength: 11,
                maxlength: 11,
            },
            operatingHours: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter your restaurant name!",
                maxlength: "Name cannot be longer than 255 characters!",
            },
            address: {
                required: "Please enter your address!",
                maxlength: "Address cannot be longer than 255 characters!",
            },
            email: {
                required: "Please enter your email address!",
                email: "Please enter a valid email address!",
            },
            phoneNumber: {
                required: "Please enter your phone number!",
                minlength: "Phone number must be exactly 11 characters!",
                maxlength: "Phone number must be exactly 11 characters!",
            },
            operatingHours: {
                required: "Please enter the operating hours!",
            },
        },
        submitHandler: function (form) {
            const formData = new FormData(form);
            formData.append("_method", "PUT");
            const id = formData.get("restaurant_id");
            console.log(id);

            $.ajax({
                type: "POST",
                url: `/api/restaurants/${id}`,
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
                    $("#profileForm")
                        .find("input.success")
                        .removeClass("success");

                    Swal.fire({
                        title: "Success!",
                        text: "Updated Successfully!",
                        icon: "success",
                    });
                },
                error: function (error) {
                    console.log(error);
                    Swal.fire({
                        title: "Error!",
                        text: "An error occurred while updating.",
                        icon: "error",
                    });
                },
            });
        },
        success: function (label, element) {
            $(element).removeClass("error").addClass("success");
            $(label).remove();
        },
        errorPlacement: function (error, element) {
            error.addClass("error");
            $(element).addClass("error");
            error.insertAfter(element);
        },
    });
});
