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
            $.each(data, function (index, item) {
                $("#cuisine").append(
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
            console.log(data);
            $.each(data, function (index, item) {
                $("#category").append(
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
            cuisine: {
                required: true,
            },
            category: {
                required: true,
            },
            desc: {
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
            cuisine: {
                required: "Please select a cuisine",
            },
            category: {
                required: "Please select a category!",
            },
            desc: {
                required: "Please enter a description",
            },
            price: {
                required: "Please enter a price",
            },
            filePath: {
                required: "Please upload a picture!",
                fileType: "Only JPEG, JPG, PNG files are allowed!",
            },
        },
        submitHandler: function (form) {
            var formData = new FormData(form);

            $.ajax({
                type: "POST",
                url: "/api/foods",
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

        errorPlacement: function (error, element) {
            error.insertAfter(element);
            $(element).addClass("error");
        },
        success: function (label) {
            // Custom success function
            label.addClass("text-green-500"); // Example: add a Tailwind CSS class for green text
            var input = $(label).prev("input");
            $(input).removeClass("error");
            $(input).addClass("success");
        },
    });
    // $("#foodsTable").dataTable({
    //     ajax: {
    //         url: "/api/getFoods",
    //         dataSrc: "",
    //     },
    //     dom: '<"flex justify-between items-center"lf>t<"flex justify-between items-center"ip>',
    //     columns: [
    //         { data: "id" },
    //         { data: "name" },
    //         { data: "cuisine_id" },
    //         { data: "desc" },
    //         {
    //             data: "img_url",
    //             render: function (data, type, row) {
    //                 // Construct the full URL for the image
    //                 console.log(data.substring(7));
    //                 const imageUrl = "storage/" + data.substring(7);
    //                 return (
    //                     '<img src="' +
    //                     imageUrl +
    //                     '" alt="' +
    //                     "haha" +
    //                     '" class="w-full h-full object-cover"/>'
    //                 );
    //             },
    //         },
    //         {
    //             data: null,
    //             render: function (data, type, row) {
    //                 return (
    //                     "<i class='fi fi-rr-edit text-blue-500 editBtn' data-id='" +
    //                     data.id +
    //                     "'></i><i class='fi fi-rr-trash deleteBtn text-red-500' data-id='" +
    //                     data.id +
    //                     "'></i>"
    //                 );
    //             },
    //         },
    //     ],
    //     order: [[1, "asc"]],
    // });

    // $("#name").on("input", function () {
    //     const name = $(this).val().trim();

    //     if (name != "") {
    //         $(this).removeClass("error");
    //         $(this).addClass("success");
    //     } else {
    //         $(this).removeClass("success");
    //         $(this).addClass("error");
    //     }
    // });

    $("#cuisine").on("change", function () {
        const cuisine = $(this).val().trim();

        if (cuisine != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#category").on("change", function () {
        const category = $(this).val().trim();

        if (cuisine != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#desc").on("change", function () {
        const desc = $(this).val().trim();

        if (desc != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });
});
