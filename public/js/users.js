$(document).ready(function () {
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
            { data: "regionName" },
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
        // order: [[1, "asc"]],
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
});
