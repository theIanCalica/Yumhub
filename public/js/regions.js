$(document).ready(function () {
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add("hidden");
        modal.setAttribute("aria-hidden", "true");
        modal.removeAttribute("aria-modal");
        modal.removeAttribute("role");

        // Remove backdrop
        const backdrop = document.querySelector("[modal-backdrop]");
        if (backdrop) {
            backdrop.remove();
        }
    }

    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        const backdrop = document.getElementById("modal-backdrop");

        modal.classList.remove("hidden");
        modal.setAttribute("aria-hidden", "false");
        modal.setAttribute("aria-modal", "true");
        modal.setAttribute("role", "dialog");

        // Show backdrop
        backdrop.classList.remove("hidden");
    }

    $.ajax({
        type: "GET",
        url: "api/regions",
        dataType: "json",
        success: function (data) {
            console.log(data);
            $.each(data, function (key, value) {
                var tr = $("<tr>").addClass(
                    "bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                );
                var id = $("<th>")
                    .addClass(
                        "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    )
                    .html(value.id);
                tr.append(id);
                var th = $("<th>")
                    .addClass(
                        "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    )
                    .html(value.regionName);
                tr.append(th);

                // Create Edit button
                var editButton = $("<button>")
                    .addClass(
                        "px-4 py-2 text-sm font-medium text-blue-600 hover:underline"
                    )
                    .html("Edit")
                    .on("click", function () {
                        // Edit button click handler
                        // Implement your edit functionality here
                        alert(
                            "Edit button clicked for region: " +
                                value.regionName
                        );
                    });

                // Create Delete button
                var deleteButton = $("<button>")
                    .addClass(
                        "px-4 py-2 text-sm font-medium text-red-600 hover:underline"
                    )
                    .html("Delete")
                    .on("click", function () {
                        // Delete button click handler
                        // Implement your delete functionality here
                        alert(
                            "Delete button clicked for region: " +
                                value.regionName
                        );
                    });

                // Create a table cell for buttons and append the buttons
                var tdButtons = $("<td>").addClass(
                    "px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                );
                tdButtons.append(editButton).append(deleteButton);
                tr.append(tdButtons);

                // Append the row to the table
                $("#regionTable").append(tr);
            });
        },
    });

    $("#regionAdd").on("click", function (e) {
        e.preventDefault();
        var data = $(`#regionAddForm`)[0];
        let formData = new FormData(data);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ", " + pair[1]);
        }

        $.ajax({
            type: "POST",
            url: "/api/regions",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                closeModal("add-modal");

                // Add the new item to the table
                var tr = $("<tr>");
                tr.append(
                    $("<th>")
                        .addClass(
                            "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        )
                        .html(data.region.id)
                );
                tr.append(
                    $("<th>")
                        .addClass(
                            "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        )
                        .html(data.region.regionName)
                );
                $("table tbody").append(tr);

                // Sort the table rows by the region name
                var rows = $("table tbody tr").get();
                rows.sort(function (a, b) {
                    var A = $(a).children("th").eq(1).text().toUpperCase();
                    var B = $(b).children("th").eq(1).text().toUpperCase();
                    return A < B ? -1 : A > B ? 1 : 0;
                });

                $.each(rows, function (index, row) {
                    $("table").children("tbody").append(row);
                });

                // Hide the modal
                const modal = document.getElementById("add-modal");
                modal.classList.add("hidden");
            },
        });
    });
});
