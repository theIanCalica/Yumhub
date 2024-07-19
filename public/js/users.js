$(document).ready(function () {
    $("#btnAdd").on("click", function () {
        openModal("add-modal");
    });
    function closeModal(modalId) {
        const $targetEl = document.getElementById(modalId);
        const modal = new Modal($targetEl);
        modal.hide();
    }

    function openModal(modalId) {
        const $targetEl = document.getElementById(modalId);
        const modal = new Modal($targetEl);
        modal.show();
    }

    $("#usersTable").dataTable({
        ajax: {
            url: "/api/users",
            dataSrc: "",
        },
        dom: "lBfrtip",
        buttons: [
            "pdf",
            "excel",
            {
                text: "Add User",
                className:
                    "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800",
                action: function (e, dt, node, config) {
                    $("#regionAddForm").trigger("reset");
                    openModal("add-modal");
                },
            },
        ],
        columns: [
            { data: "id" },
            { data: "fname" },
            { data: "lname" },
            { data: "gender" },
            { data: "dob" },
            { data: "phoneNumber" },
            { data: "email" },
            { data: "address" },
            { data: "role" },
            {
                data: "is_disabled",
                render: function (data, type, row) {
                    return data ? "Disabled" : "Active";
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        "<i class='fi fi-rr-edit text-blue-500 editBtn'  data-id='" +
                        data.id +
                        "'></i><i class='fi fi-rr-trash deleteBtn text-red-500' data-id='" +
                        data.id +
                        "'></i>"
                    );
                },
            },
        ],
        order: [[12, "asc"]],
    });

    $("#userAddForm").validate({
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
                },
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
            password: {
                required: true,
                minlength: 6,
            },
            address: {
                required: true,
            },
            role: {
                required: true,
                maxlength: 255,
            },
            isDisabled: {
                required: true,
            },
        },
        messages: {
            fname: {
                required: "Please enter your first name!",
                maxlength: "Your first name must not exceed 255 characters!",
            },
            lname: {
                required: "This field is required!",
                maxlength: "Your last name must not exceed 255 characters!",
            },
            gender: {
                required: "This field is required!",
            },
            dob: {
                required: "This field is required!",
                date: "Your date of birth must be a valid date!",
            },
            email: {
                required: "Please enter your email address!",
                email: "Please enter a valid email address!",
                remote: "Email already taken",
            },
            phoneNumber: {
                required: "Please enter your phone number!",
                maxlength: "Your phone number must be exactly 11 digits!",
                minlength: "Your phone number must be exactly 11 digits!",
            },
            password: {
                required: "Please enter your password!",
                minlength: "Your password must be at least 6 characters long!",
            },
            address: {
                required: "Please enter the address!",
            },
            role: {
                required: "Please select a user role!",
                maxlength: "The role must not exceed 255 characters!",
            },
            isDisabled: {
                required: "Please select the account status!",
            },
        },
        submitHandler: function (form) {
            const formData = new FormData(form);
            for (var pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }

            $.ajax({
                type: "POST",
                url: "/api/users",
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
                    console.log("rinun");
                    Swal.fire({
                        title: "Success!",
                        text: "You added a new user!",
                        icon: "success",
                    });

                    closeModal("add-modal");
                    $("#userAddForm")
                        .find("input, select")
                        .each(function () {
                            if ($(this).is("select")) {
                                $(this).prop("selectedIndex", 0); // Reset select to the first option
                            } else {
                                $(this).val(""); // Clear input values
                            }
                        });
                },
                error: function (data) {
                    console.log(data);
                },
            });
        },
    });

    $("#usersEditForm").validate({
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
            },
            phoneNumber: {
                required: true,
                maxlength: 11,
                minlength: 11,
            },
            address: {
                required: true,
            },
            role: {
                required: true,
                maxlength: 255,
            },
            is_Disabled: {
                required: true,
            },
        },
        messages: {
            fname: {
                required: "Please enter your first name!",
                maxlength: "Your first name must not exceed 255 characters!",
            },
            lname: {
                required: "This field is required!",
                maxlength: "Your last name must not exceed 255 characters!",
            },
            gender: {
                required: "This field is required!",
            },
            dob: {
                required: "This field is required!",
                date: "Your date of birth must be a valid date!",
            },
            email: {
                required: "Please enter your email address!",
                email: "Please enter a valid email address!",
            },
            phoneNumber: {
                required: "Please enter your phone number!",
                maxlength: "Your phone number must be exactly 11 digits!",
                minlength: "Your phone number must be exactly 11 digits!",
            },
            address: {
                required: "Please enter the address!",
            },
            role: {
                required: "Please select a user role!",
                maxlength: "The role must not exceed 255 characters!",
            },
            is_Disabled: {
                required: "Please select the account status!",
            },
        },
        submitHandler: function (form) {
            const formData = new FormData(form);
            formData.append("_method", "PUT");

            for (var pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }

            const table = $("#usersTable").DataTable();
            $.ajax({
                type: "POST",
                url: `/api/users/${id}`,
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
                    // table.ajax.reload();
                    Swal.fire({
                        title: "Success!",
                        text: "You updated the user's details!",
                        icon: "success",
                    });

                    closeModal("edit-modal");
                    $("#usersEditForm")
                        .find("input, select")
                        .each(function () {
                            if ($(this).is("select")) {
                                $(this).prop("selectedIndex", 0);
                            } else {
                                $(this).val("");
                            }
                        });
                },
                error: function (data) {
                    console.log(data);
                },
            });
        },
    });
    $("#usersTable tbody").on("click", "i.editBtn", function () {
        const id = $(this).data("id");
        console.log(id);

        $.ajax({
            type: "GET",
            url: `/api/users/${id}`,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#id").val(data.id);
                $("#editFname").val(data.fname);
                $("#editLname").val(data.lname);
                $("#editGender option").each(function () {
                    if ($(this).val() == data.gender) {
                        $(this).prop("selected", true);
                    }
                });
                $("#editAddress").val(data.address);
                $("#editDob").val(data.dob);
                $("#editPhoneNumber").val(data.phoneNumber);
                $("#editEmail").val(data.email);
                $("#editRole").val(data.role);
                $("#editIs_disabled").prop(
                    "selectedIndex",
                    data.is_disabled == 0 ? 1 : 2
                );

                openModal("edit-modal");
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
    $("#usersTable tbody").on("click", "i.deleteBtn", function () {
        const id = $(this).data("id");
        const $row = $(this).closest("tr");
        Swal.fire({
            title: "Do you want to delete this?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Yes",
            denyButtonText: `No`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: `/api/users/${id}`,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        $row.fadeOut(2000, function () {
                            $row.remove();
                        });
                        Swal.fire({
                            title: "Success!",
                            text: "You deleted a user!",
                            icon: "success",
                        });
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });
            }
        });
    });

    $("#fname").on("input", function () {
        const fname = $(this).val().trim();

        if (fname != "" && fname.length <= 255) {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#lname").on("input", function () {
        const lname = $(this).val().trim();

        if (lname != "" && lname.length <= 255) {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#gender").on("change", function () {
        const gender = $(this).val().trim();

        if (gender != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#phoneNumber").on("input", function () {
        const phoneNumber = $(this).val().trim();

        if (phoneNumber != "" && phoneNumber.length === 11) {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#email").on("input", function () {
        const email = $(this).val().trim();

        if (email != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#region").on("input", function () {
        const region = $(this).val().trim();

        if (region != "" && region.length <= 255) {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });
});
