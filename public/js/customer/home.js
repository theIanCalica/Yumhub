$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/cuisines",
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

    $.ajax({
        type: "GET",
        url: `/api/categories`,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            const container = $("#categoryButtons");
            if (Array.isArray(data)) {
                // Iterate over each category object
                data.forEach(function (category) {
                    // Create a new button element
                    var button = $("<button>")
                        .addClass(
                            "text-yellow-400 categoryBtn mt-5 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-900"
                        )
                        .text(category.name)
                        .appendTo(container);
                    button.click(function () {
                        alert(category.name);
                    });
                });
            } else {
                console.error("Invalid data format:", data);
            }
        },
    });
});
