$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "api/regions",
        dataType: "json",
        success: function (data) {
            console.log(data);
        },
    });
});
