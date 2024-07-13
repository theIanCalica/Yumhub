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
                required: "This field is required!",
                maxlength: "Your First Name must not exceed 255 characters!",
            },
            lname: {
                required: "This field is required!",
                maxlength: "Your Last Name must not exceed 255 characters!",
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
    });
    $("#userAdd").on("click", function (e) {
        e.preventDefault();
        const data = $(`#userAddForm`)[0];
        const formData = new FormData(data);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ", " + pair[1]);
        }

        $.ajax({
            type: "POST",
            url: "/api/users",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
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
