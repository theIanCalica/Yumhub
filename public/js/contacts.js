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

    $("#contactsTable").dataTable({
        ajax: {
            url: "/api/contactMessages",
            dataSrc: "",
        },
        dom: '<"flex justify-between items-center"lf>t<"flex justify-between items-center"ip>',
        buttons: [
            "pdf",
            "excel",
            {
                text: "Add Category",
                className:
                    "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800",
                action: function (e, dt, node, config) {
                    $("#categoryAddForm").trigger("reset");
                    openModal("add-modal");
                },
            },
        ],
        columns: [
            { data: "id" },
            { data: "fname" },
            { data: "lname" },
            { data: "email" },
            { data: "subject" },
            { data: "status" },
            {
                data: "created_at",
                render: function (data, type, row) {
                    if (type === "display" && data) {
                        // Convert the date string to a Date object
                        var date = new Date(data);

                        // Options for formatting date
                        var options = {
                            year: "numeric",
                            month: "long",
                            day: "2-digit",
                        };

                        // Format the date as "Month Day, Year"
                        return date.toLocaleDateString("en-US", options);
                    }
                    return data;
                },
            },

            {
                data: null,
                render: function (data, type, row) {
                    return (
                        "<i class='fi fi-rr-edit text-blue-500 editBtn' data-id='" +
                        data.id +
                        "'></i>"
                    );
                },
            },
        ],
        order: [[1, "asc"]],
    });

    $("#updateForm").validate({
        rules: {
            status: {
                required: true,
            },
        },
        messages: {
            status: {
                required: "Status is required!",
            },
        },
        submitHandler: function (form) {
            const formData = new FormData(form);
            const id = formData.get("id");
            const table = $("#contactsTable").DataTable();
            formData.append("_method", "PUT");
            for (var pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }
            $.ajax({
                type: "POST",
                url: `/api/contactMessages/${id}`,
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
    $("#contactsTable tbody").on("click", "i.editBtn", function () {
        const id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: `/api/contactMessages/${id}`,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#id").val(data.id);
                $("#fname").val(data.fname);
                $("#lname").val(data.lname);
                $("#email").val(data.email);
                $("#subject").val(data.subject);
                $("#message").val(data.message);
                $("#status option").each(function () {
                    // Check if the option value matches the data response
                    if ($(this).val() === data.status) {
                        // Set the option as selected
                        $(this).prop("selected", true);
                    }
                });
                openModal("edit-modal");
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
});
