$(document).ready(function () {
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

    $("#phoneNumber").on("input", function () {
        const phoneNumber = $(this).val().trim();

        if (phoneNumber != "" && phoneNumber.length() != 11) {
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

    $("#managersTable").dataTable({
        ajax: {
            url: "/api/managers",
            dataSrc: "",
        },
        dom: '<"flex justify-between items-center"lf>t<"flex justify-between items-center"ip>',
        buttons: [
            "pdf",
            "excel",
            {
                text: "Add Manager",
                className:
                    "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800",
                action: function (e, dt, node, config) {
                    $("#managerAddForm").trigger("reset");
                    openModal("add-modal");
                },
            },
        ],
        columns: [
            { data: "id" },
            { data: "fname" },
            { data: "lname" },
            { data: "sex" },
            { data: "DOB" },
            { data: "phoneNumber" },
            { data: "email" },
            { data: "hiredDate" },
            { data: "employmentStatus" },
            { data: "salary" },
            { data: "address" },
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
            fname: { required: true },
            lname: { required: true },
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
                    var tr = $("<tr>");
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.manager.id)
                    );
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.manager.fname)
                    );
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.manager.lname)
                    );
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.manager.sex)
                    );
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.manager.DOB)
                    );
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.manager.address)
                    );
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.manager.phoneNumber)
                    );
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.manager.email)
                    );
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.manager.hiredDate)
                    );
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.manager.employmentStatus)
                    );
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.manager.salary)
                    );
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.manager.salary)
                    );

                    tr.append(
                        $("<th>").html(
                            "<i class='fi fi-rr-edit text-blue-500 editBtn' data-id='" +
                                data.manager.id +
                                "'></i><i class='fi fi-rr-trash deleteBtn text-red-500' data-id='" +
                                data.manager.id +
                                "'></i>"
                        )
                    );
                    $("table tbody").append(tr);

                    closeModal();
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
