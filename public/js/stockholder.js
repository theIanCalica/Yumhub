$(document).ready(function () {
    $("#btnImport").click(function () {
        $("#fileInput").click(); // Trigger file input click
    });

    $("#fileInput").on("change", function () {
        const allowedMimeTypes = [
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            "application/vnd.ms-excel",
        ];

        if (this.files.length > 0) {
            const file = this.files[0];
            if (allowedMimeTypes.includes(file.type)) {
                $("#importForm").submit();
            } else {
                Swal.fire({
                    title: "Warning!",
                    text: "Files only accepted are .csv and .excel",
                    icon: "warning",
                });
            }
        }
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

    $("#btnAdd").on("click", function () {
        openModal("add-modal");
    });
    $("#name").on("input", function () {
        const name = $(this).val().trim();

        if (name != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#sex").on("input", function () {
        const sex = $(this).val().trim();

        if (sex != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#dob").on("input", function () {
        const dob = $(this).val().trim();

        if (dob != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#address").on("input", function () {
        const address = $(this).val().trim();

        if (address != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#phoneNumber").on("input", function () {
        const phoneNumber = $(this).val().trim();

        if (phoneNumber != "") {
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

    $("#sharesOwned").on("input", function () {
        const sharesOwned = $(this).val().trim();

        if (sharesOwned != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#investmentDate").on("input", function () {
        const investmentDate = $(this).val().trim();

        if (investmentDate != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#prefferedContact").on("input", function () {
        const prefferedContact = $(this).val().trim();

        if (prefferedContact != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    // Validate formW
    $("#stockholderAddForm").validate({
        rules: {
            name: {
                required: true,
            },
            sex: {
                required: true,
                maxlength: 6,
            },
            dob: {
                required: true,
            },
            address: {
                required: true,
            },
            phoneNumber: {
                required: true,
                minlength: 11,
                maxlength: 11,
            },
            email: {
                required: true,
                email: true,
            },
            sharesOwned: {
                required: true,
                number: true,
            },
            investmentDate: {
                required: true,
                date: true,
            },
            prefferedContact: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "This field is required!",
            },
            sex: {
                required: "This field is required!",
                maxlength: "Male/Female only!",
            },
            dob: {
                required: "This field is required!",
            },
            address: {
                required: "This field is required!",
            },
            phoneNumber: {
                required: "This field is required!",
                minlength: "Invalid phone number!",
                maxlength: "Invalid phone number!",
            },
            email: {
                required: "This field is required!",
                email: "Invalid email!",
            },
            sharesOwned: {
                required: "This field is required!",
                number: "Not a valid number!",
            },
            investmentDate: {
                required: "This field is required!",
                date: "Not a valid date!",
            },
            prefferedContact: {
                required: "This field is required!",
            },
        },
        submitHandler: function (form) {
            const formData = new FormData(form);
            for (var pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }
            var table = $("#stockholdersTable").DataTable();

            $.ajax({
                type: "POST",
                url: "/api/stockholders",
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
                    var tr = $("<tr>");
                    table.ajax.reload();

                    closeModal("add-modal");
                    Swal.fire({
                        title: "Success!",
                        icon: "success",
                    });

                    $(form).find("input, select,textarea").val("");
                    $(form).validate().resetForm();
                },
                error: function (error) {
                    console.log(error);
                },
            });
        },
    });

    $("#stockholderEditForm").validate({
        rules: {
            name: {
                required: true,
            },
            sex: {
                required: true,
                maxlength: 6,
            },
            dob: {
                required: true,
            },
            address: {
                required: true,
            },
            phoneNumber: {
                required: true,
                minlength: 11,
                maxlength: 11,
            },
            email: {
                required: true,
                email: true,
            },
            sharesOwned: {
                required: true,
                number: true,
            },
            investmentDate: {
                required: true,
                date: true,
            },
            prefferedContact: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "This field is required!",
            },
            sex: {
                required: "This field is required!",
                maxlength: "Male/Female only!",
            },
            dob: {
                required: "This field is required!",
            },
            address: {
                required: "This field is required!",
            },
            phoneNumber: {
                required: "This field is required!",
                minlength: "Invalid phone number!",
                maxlength: "Invalid phone number!",
            },
            email: {
                required: "This field is required!",
                email: "Invalid email!",
            },
            sharesOwned: {
                required: "This field is required!",
                number: "Not a valid number!",
            },
            investmentDate: {
                required: "This field is required!",
                date: "Not a valid date!",
            },
            prefferedContact: {
                required: "This field is required!",
            },
        },
        submitHandler: function (form) {
            const formData = new FormData(form);
            formData.append("_method", "PUT");
            const id = formData.get("id");
            var table = $("#stockholdersTable").DataTable();
            for (var pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }

            $.ajax({
                type: "POST",
                url: `/api/stockholders/${id}`,
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
                    console.log("Success");
                    console.log(data);
                    table.ajax.reload();
                    closeModal("edit-modal");
                    Swal.fire({
                        title: "Success!",
                        text: "Updated Successfully!",
                        icon: "success",
                    });
                },
            });
        },
    });

    // Initialization of datatable
    $("#stockholdersTable").dataTable({
        ajax: {
            url: "/api/stockholders",
            dataSrc: "",
        },
        dom: '<"flex justify-between items-center"lf>t<"flex justify-between items-center"ip>',
        buttons: [
            "pdf",
            "excel",
            {
                text: "Add Stockholder",
                className:
                    "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800",
                action: function (e, dt, node, config) {
                    $("#riderAddForm").trigger("reset");
                    openModal("add-modal");
                },
            },
        ],
        columns: [
            { data: "id" },
            { data: "name" },
            { data: "sex" },
            {
                data: "dob",
                render: function (data, type, row) {
                    if (type === "display" || type === "filter") {
                        var date = new Date(data);
                        var options = {
                            year: "numeric",
                            month: "long",
                            day: "numeric",
                        };
                        return date.toLocaleDateString("en-US", options);
                    }
                    return data;
                },
            },
            { data: "address" },
            { data: "phoneNumber" },
            { data: "email" },
            { data: "sharesOwned" },
            {
                data: "investmentDate",
                render: function (data, type, row) {
                    if (type === "display" || type === "filter") {
                        var date = new Date(data);
                        var options = {
                            year: "numeric",
                            month: "long",
                            day: "numeric",
                        };
                        return date.toLocaleDateString("en-US", options);
                    }
                    return data;
                },
            },
            { data: "prefferedContact" },
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        "<i class='fi fi-rr-edit text-blue-500 editBtn' data-id='" +
                        data.id +
                        "'></i><i class='fi fi-rr-trash deleteBtn text-red-500' data-id='" +
                        data.id +
                        "'></i>"
                    );
                },
            },
        ],
        order: [[7, "asc"]],
    });

    $("#stockholdersTable tbody").on("click", "i.deleteBtn", function (e) {
        const stockholderID = $(this).data("id");
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
                    url: `/api/stockholders/${stockholderID}`,
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

    $("#stockholdersTable tbody").on("click", "i.editBtn", function (e) {
        const stockholderID = $(this).data("id");

        $.ajax({
            type: "GET",
            url: `/api/stockholders/${stockholderID}`,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data.id);
                $("#id").val(data.id);
                $("#editName").val(data.name);
                $("#editSex").val(data.sex);
                $("#editDob").val(data.dob);
                $("#editAddress").val(data.address);
                $("#editPhoneNumber").val(data.phoneNumber);
                $("#editEmail").val(data.email);
                $("#editSharesOwned").val(data.sharesOwned);
                $("#editInvestmentDate").val(data.investmentDate);
                $("#editPrefferedContact").val(data.prefferedContact);
                openModal("edit-modal");
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
});
