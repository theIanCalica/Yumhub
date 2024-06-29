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
            { data: "hired-date" },
            { data: "employment-status" },
            { data: "salary" },
            { data: "address" },
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        "<i class='fi fi-rr-edit text-blue-500 editBtn' data-id='" +
                        data.id +
                        "' data-name='" +
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
                    // Add the new item to the table
                    // var tr = $("<tr>");
                    // tr.append(
                    //     $("<th>")
                    //         .addClass(
                    //             "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    //         )
                    //         .html(data.region.id)
                    // );
                    // tr.append(
                    //     $("<th>")
                    //         .addClass(
                    //             "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    //         )
                    //         .html(data.region.regionName)
                    // );
                    // $("table tbody").append(tr);
                    // // Sort the table rows by the region name
                    // var rows = $("table tbody tr").get();
                    // rows.sort(function (a, b) {
                    //     var A = $(a).children("th").eq(1).text().toUpperCase();
                    //     var B = $(b).children("th").eq(1).text().toUpperCase();
                    //     return A < B ? -1 : A > B ? 1 : 0;
                    // });
                    // $.each(rows, function (index, row) {
                    //     $("table").children("tbody").append(row);
                    // });
                    // closeModal();
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
            const formDate = new FormData(form);
            for (var pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }
            $.ajax({
                type: "PUT",
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
                    console.log(data);
                },
                error: function (data) {
                    console.log(data);
                },
            });
        },
    });

    $("#managersTable tbody").on("click", "i.deleteBtn", function (e) {
        let id = $(this).data("id");
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
