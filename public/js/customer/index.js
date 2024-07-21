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
});
