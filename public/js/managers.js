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
                console.log("Selected file:", file);
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

    $("#fname").on("input", function () {
        const fnameVal = $(this).val().trim();

        if (fnameVal !== "" && fnameVal.length <= 255) {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#lname").on("input", function () {
        const lnameVal = $(this).val().trim();

        if (lnameVal != "" && lnameVal.length <= 255) {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#sex").on("input", function () {
        const sex = $(this).val().trim();

        if (sex != "" && sex.length <= 10) {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("DOB").on("input", function () {
        const DOB = $(this).val().trim();

        if (DOB != "") {
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

    $("#hiredDate").on("input", function () {
        const hiredDateVal = $(this).val().trim();

        if (hiredDateVal != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#employmentStauts").on("click", function () {
        const employVal = $(this).val().trim();

        if (employVal != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#salary").on("click", function () {
        const salaryVal = $(this).val().trim();

        if (salaryVal !== "" && !isNaN(salaryVal)) {
            // Check if salaryVal is not empty and is a valid number
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
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

    $("#managersTable").DataTable({
        ajax: {
            url: "/api/managers",
            dataSrc: "",
        },
        dom: '<"flex justify-between items-center"lf>t<"flex justify-between items-center"ip>',
        columns: [
            { data: "id" },
            { data: "fname" },
            { data: "lname" },
            { data: "sex" },
            {
                data: "DOB",
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

            {
                data: "hiredDate",
                render: function (data, type, row) {
                    // Assuming 'data' is in ISO date format (e.g., "2024-07-17T00:00:00")
                    var date = new Date(data);
                    // Format date as "monthname day year" (e.g., "July 17 2024")
                    var formattedDate = date.toLocaleDateString("en-US", {
                        month: "long",
                        day: "numeric",
                        year: "numeric",
                    });
                    return formattedDate;
                },
            },
            { data: "employmentStatus" },
            { data: "salary" },

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
        order: [[1, "asc"]],
    });

    $("#managerAddForm").validate({
        rules: {
            fname: { required: true, maxlength: 255 },
            lname: { required: true, maxlength: 255 },
            sex: { required: true },
            DOB: { required: true },
            phoneNumber: { required: true, minlength: 11 },
            email: { required: true, email: true },
            hireddate: { required: true },
            status: { required: true },
            salary: { required: true, number: true },
            address: { required: true },
        },
        messages: {
            fname: { required: "This field is required!" },
            lname: { required: "This field is required!" },
            sex: { required: "This field is required!" },
            DOB: { required: "This field is required!" },
            phoneNumber: {
                required: "This field is required!",
                minlength: "Invalid phone number",
            },
            email: {
                required: "This field is required!",
                email: "Please enter a valid email address",
            },
            hireddate: { required: "This field is required!" },
            status: { required: "This field is required!" },
            salary: {
                required: "This field is required!",
                number: "Please enter a valid number",
            },
            address: { required: "This field is required!" },
        },
        submitHandler: function (form) {
            const formData = new FormData(form);
            for (var pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }
            var table = $("#managersTable").DataTable();
            $.ajax({
                type: "POST",
                url: "/api/managers",
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
                    table.ajax.reload();
                    closeModal("add-modal");
                    Swal.fire({
                        title: "Success!",
                        text: "You added new manager!",
                        icon: "success",
                    });
                },
                error: function (error) {
                    console.log(error);
                },
            });
        },
    });

    $("#managerEditForm").validate({
        rules: {
            fname: {
                required: true,
            },
            lname: {
                required: true,
            },
            sex: {
                required: true,
            },
            DOB: {
                required: true,
            },
            phoneNumber: {
                required: true,
                minlength: 11,
            },
            email: {
                required: true,
            },
            hireddate: {
                required: true,
            },
            status: {
                required: true,
            },
            salary: {
                required: true,
            },
            address: {
                required: true,
            },
        },
        messages: {
            fname: {
                required: "This field is required!",
            },
            lname: {
                required: "This field is required!",
            },
            sex: {
                required: "This field is required!",
            },
            DOB: {
                required: "This field is required!",
            },
            phoneNumber: {
                required: "This field is required!",
                minlength: "Invalid phone number",
            },
            email: {
                required: "This field is required!",
            },
            hireddate: {
                required: "This field is required!",
            },
            status: {
                required: "This field is required!",
            },
            salary: {
                required: "This field is required!",
            },
            address: {
                required: "This field is required!",
            },
        },
        submitHandler: function (form) {
            const formData = new FormData(form);
            formData.append("_method", "PUT");
            var table = $("#managersTable").DataTable();
            const id = formData.get("id");

            $.ajax({
                type: "POST",
                url: `/api/managers/${id}`,
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
                    table.ajax.reload();
                    closeModal("edit-modal");
                    Swal.fire({
                        title: "Success!",
                        text: "Updated Successfully!",
                        icon: "success",
                    });
                },
                error: function (data) {
                    console.log(data);
                },
            });
        },
    });

    $("#managersTable tbody").on("click", "i.editBtn", function (e) {
        const id = $(this).data("id");
        console.log(id);
        $.ajax({
            type: "GET",
            url: `/api/managers/${id}`,
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
                $("#editSex").val(data.sex);
                $("#editDob").val(data.DOB);
                $("#editAddress").val(data.address);
                $("#editPhoneNumber").val(data.phoneNumber);
                $("#editEmail").val(data.email);
                $("#editHiredDate").val(data.hiredDate);
                $("#editEmploymentStatus").val(data.employmentStatus);
                $("#editSalary").val(data.salary);
            },
            error: function (error) {
                console.log(error);
            },
        });
        openModal("edit-modal");
    });

    $("#managersTable tbody").on("click", "i.deleteBtn", function (e) {
        let managerID = $(this).data("id");
        let $row = $(this).closest("tr");
        console.log(managerID);

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
                    url: `/api/managers/${managerID}`,
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
});
