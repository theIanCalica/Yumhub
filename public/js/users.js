$(document).ready(function () {
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
            { data: "phoneNumber" },
            { data: "email" },
            { data: "region" },
            { data: "province" },
            { data: "city" },
            { data: "barangay" },
            { data: "street" },
            { data: "houseNo" },
            { data: "zipCode" },
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
            },
            phoneNumber: {
                required: true,
                maxlength: 11,
                minlength: 11,
            },
            password: {
                required: true,
                minlength: 6,
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
            region: {
                required: "Please enter the region where you live!",
                maxlength: "The region name must not exceed 255 characters!",
            },
            province: {
                required: "Please enter the province where you live!",
                maxlength: "The province name must not exceed 255 characters!",
            },
            city: {
                required: "Please enter the city where you live!",
                maxlength: "The city name must not exceed 255 characters!",
            },
            barangay: {
                required: "Please enter the barangay where you live!",
                maxlength: "The barangay name must not exceed 255 characters!",
            },
            street: {
                required: "Please enter the street where you live!",
                maxlength: "The street name must not exceed 255 characters!",
            },
            houseNo: {
                required: "Please enter the house number where you live!",
                maxlength: "The house number must not exceed 255 characters!",
            },
            zipCode: {
                required: "Please enter the zip code!",
                maxlength: "The zip code must not exceed 4 characters!",
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
                    console.log(data);
                    Swal.fire({
                        title: "Success!",
                        text: "You added a new user!",
                        icon: "success",
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
                            text: "You successfully deleted it!",
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
