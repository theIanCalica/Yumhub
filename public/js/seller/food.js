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
            $.each(data, function (index, item) {
                $("#cuisine_id").append(
                    $("<option>", {
                        value: item.id,
                        text: item.name,
                    })
                );
            });
        },
        error: function (data) {
            console.log(data);
        },
    });

    $.ajax({
        type: "GET",
        url: "/api/categories",
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            $.each(data, function (index, item) {
                $("#category_id").append(
                    $("<option>", {
                        value: item.id,
                        text: item.name,
                    })
                );
            });
        },
        error: function (data) {
            console.log(data);
        },
    });

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
            $.each(data, function (index, item) {
                $("#editCuisine_id").append(
                    $("<option>", {
                        value: item.id,
                        text: item.name,
                    })
                );
            });
        },
        error: function (data) {
            console.log(data);
        },
    });

    $.ajax({
        type: "GET",
        url: "/api/categories",
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            $.each(data, function (index, item) {
                $("#editCategory_id").append(
                    $("<option>", {
                        value: item.id,
                        text: item.name,
                    })
                );
            });
        },
        error: function (data) {
            console.log(data);
        },
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

    $("#btnAdd").on("click", function () {
        openModal("add-modal");
    });

    $.validator.addMethod(
        "fileType",
        function (value, element, param) {
            return this.optional(element) || param.test(element.files[0].type);
        },
        "Only JPEG, JPG, PNG files are allowed!"
    );

    $("#addForm").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255,
            },
            cuisine_id: {
                required: true,
            },
            category_id: {
                required: true,
            },
            price: {
                required: true,
            },
            filePath: {
                required: true,
                fileType: /^image\/(jpeg|jpg|png)$/,
            },
        },
        messages: {
            name: {
                required: "Please enter food name!",
                maxlength: "Name must not exceed 255 characters!",
            },
            cuisine_id: {
                required: "Please select a cuisine",
            },
            category_id: {
                required: "Please select a category!",
            },
            price: {
                required: "Please enter a price",
            },
            filePath: {
                required: "Please upload a picture!",
                fileType: "Only JPEG, JPG, PNG files are allowed!",
            },
        },

        errorPlacement: function (error, element) {
            error.insertAfter(element);
            $(element).addClass("error");
        },
        success: function (label) {
            // Custom success function
            label.addClass("success");
            var input = $(label).prev("input");
            $(input).removeClass("error");
            $(input).addClass("success");
        },
    });

    $("#editForm").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255,
            },
            cuisine_id: {
                required: true,
            },
            category_id: {
                required: true,
            },
            price: {
                required: true,
            },
            filePath: {
                fileType: /^image\/(jpeg|jpg|png)$/,
            },
        },
        messages: {
            name: {
                required: "Please enter food name!",
                maxlength: "Name must not exceed 255 characters!",
            },
            cuisine_id: {
                required: "Please select a cuisine",
            },
            category_id: {
                required: "Please select a category!",
            },
            price: {
                required: "Please enter a price",
            },
            filePath: {
                fileType: "Only JPEG, JPG, PNG files are allowed!",
            },
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            $(element).addClass("error");
        },
        success: function (label) {
            // Custom success function
            label.addClass("success");
            var input = $(label).prev("input");
            $(input).removeClass("error");
            $(input).addClass("success");
        },
    });

    $("#foodsTable").dataTable({
        dom: '<"flex justify-between items-center"lf>t<"flex justify-between items-center"ip>',
    });
});
