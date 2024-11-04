$(document).ready(function () {
    function openModal() {
        $("#edit-modal").removeClass("hidden"); // Remove 'hidden' class to show the modal
    }

    function closeModal() {
        $("#edit-modal").addClass("hidden");
    }

    $("#closeBtn").on("click", function () {
        closeModal();
    });
    $("#ordersTable").DataTable({
        ajax: {
            url: "/api/orderForAdmin",
            dataSrc: "",
        },
        dom: '<"flex justify-between items-center"lf>t<"flex justify-between items-center"ip>',
        columns: [
            { data: "id" },
            {
                data: "order_date",
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
            { data: "status" },
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

    $("#ordersTable tbody").on("click", "i.editBtn", function () {
        const id = $(this).data("id");

        $.ajax({
            type: "GET",
            url: `/api/orderSingle/${id}`,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#orderID").val(data.id);
                $("#order_date").val(data.order_date);
                $("#status option").each(function () {
                    // Check the value or text of the option
                    if ($(this).val() === data.status) {
                        // Set this option as selected
                        $(this).prop("selected", true);
                    }
                });
                openModal();
            },
            error: function (data) {
                console.log(data);
            },
        });
    });

    $("#orderEditForm").on("submit", function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        formData.append("_method", "PUT");
        const table = $("#ordersTable").DataTable();
        const orderID = $("#orderID").val();
        $.ajax({
            type: "POST",
            url: `/api/update-Order-Admin/${orderID}`,
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                table.ajax.reload();
                closeModal();
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
    });
});
