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
                required: "Please enter your email!",
                email: "Invalid email format!",
            },
            password: {
                required: "Please enter your password",
                minlength: "Password must be atleast 6 characters!",
            },
        },
        submitHandler: function (form) {
            const formData = new FormData(form);
            $.ajax({
                type: "POST",
                url: "/sign-in/auth",
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
                    if (data.status == 300) {
                        Swal.fire({
                            title: data.title,
                            text: data.message,
                            icon: data.icon,
                        });
                    }
                    if (data.status === 200) {
                        sessionStorage.setItem("title", data.title);
                        sessionStorage.setItem("message", data.message);
                        sessionStorage.setItem("icon", data.icon);
                        if (data.role === "Admin") {
                            window.location.href = "/admin/";
                        } else if (data.role === "Seller") {
                            console.log("seller");
                            window.location.href = "/seller/";
                        } else if (data.role === "Customer") {
                            window.location.href = "/";
                        }
                    } else if (data.status === 500) {
                        Swal.fire({
                            title: data.title,
                            text: data.message,
                            icon: data.icon,
                        });
                    }
                },
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
