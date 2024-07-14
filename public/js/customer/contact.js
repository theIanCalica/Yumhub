$(document).ready(function () {
    $("#submitForm").validate({
        rules: {
            fname: {
                required: true,
                maxlength: 255,
            },
            lname: {
                required: true,
                maxlength: 255,
            },
            email: {
                email: true,
                required: true,
            },
            subject: {
                required: true,
            },
            message: {
                required: true,
            },
        },
        messages: {
            fname: {
                required: "Please enter your first name!",
                maxlength: "First name must not exceed 255 characters!",
            },
            lname: {
                required: "Please enter your last name!",
                maxlength: "Last name must not exceed 255 characters!",
            },
            email: {
                email: "Invalid Email!",
                required: "Please enter your email!",
            },
            subject: {
                required: "Please enter the subject!",
            },
            message: {
                required: "Please enter your message",
            },
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            element.addClass("error").removeClass("success");
        },
        success: function (label, element) {
            $(element).removeClass("error").addClass("success");
        },
        submitHandler: function (form) {
            const formData = new FormData(form);
            for (var pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }

            $.ajax({
                type: "POST",
                url: "/api/contactMessages",
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
                    const tr = $("<tr>");
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.contactMessage.id)
                    );

                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.contactMessage.fname)
                    );

                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.contactMessage.lname)
                    );

                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.contactMessage.email)
                    );

                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.contactMessage.subject)
                    );

                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.contactMessage.message)
                    );

                    $("table tbody").append(tr);
                    // Clear input fields and remove classes
                    $("#submitForm")[0].reset();
                    $("#submitForm input, #submitForm textarea").removeClass(
                        "error success"
                    );
                    $("#submitForm label.error").remove();
                    Swal.fire({
                        title: "Success!",
                        text: "You added new manager!",
                        icon: "success",
                    });
                },
                error: function (data) {
                    console.log(data);
                },
            });
        },
    });
    $("#fname").on("input", function () {
        const fname = $(this).val().trim();

        if (fname !== "" && fname.length <= 255) {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#lname").on("input", function () {
        const lname = $(this).val().trim();

        if (lname !== "" && lname.length <= 255) {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#email").on("input", function () {
        const email = $(this).val().trim();

        if (email !== "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#subject").on("input", function () {
        const subject = $(this).val().trim();

        if (subject != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#message").on("input", function () {
        const message = $(this).val().trim();

        if (message != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });
});
