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

    $("#addBtn").on("click", function () {
        openModal("add-modal");
    });

    $("#articlesTable").dataTable({
        ajax: {
            url: "/api/get-articles",
            dataSrc: "",
        },
        dom: '<"flex justify-between items-center"lf>t<"flex justify-between items-center"ip>',
        buttons: [
            "pdf",
            "excel",
            {
                text: "Add Cuisine",
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
            { data: "title" },
            { data: "category" },
            {
                data: "filePath",
                render: function (data, type, row) {
                    return (
                        '<img src="' +
                        data +
                        '" alt="' +
                        "haha" +
                        '" class="w-full h-full object-cover" style="width:150px"/>'
                    );
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        "<i class='fi fi-rr-edit text-blue-500 editBtn' data-id='" +
                        data.id +
                        "'></i><i class='fi fi-rr-trash deleteBtn text-red-500' data-id='" +
                        data.id +
                        "'></i>"
                    );
                },
            },
        ],
        order: [[1, "asc"]],
    });

    $.validator.addMethod(
        "fileType",
        function (value, element, param) {
            return this.optional(element) || param.test(element.files[0].type);
        },
        "Only JPEG, JPG, PNG files are allowed!"
    );

    $("#addForm").validate({
        ignore: [],
        rules: {
            title: {
                required: true,
                maxlength: 255,
            },
            content: {
                required: true,
            },
            category: {
                required: true,
            },
            filePath: {
                required: true,
                fileType: /^image\/(jpeg|jpg|png)$/,
            },
        },
        messages: {
            title: {
                required: "please enter the title!",
                maxlength: "Title cannot exceed 255 characters!",
            },
            content: {
                required: "Please enter the content!",
            },
            category: {
                required: "Please select a category",
            },
            filePath: {
                required: "This field is required!",
                fileType: "Only JPEG, JPG, PNG files are allowed!",
            },
        },
        submitHandler: function (form) {
            const formData = new FormData(form);
            const table = $("#articlesTable").DataTable();

            $.ajax({
                type: "POST",
                url: "/api/articles",
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
                    table.ajax.reload();
                    closeModal("add-modal");
                    $("#addForm").find("input, textarea").val("");
                    Swal.fire({
                        title: "Success!",
                        text: "You added new Article!",
                        icon: "success",
                    });
                },
                error: function (error) {
                    console.log(error);
                },
            });
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "content") {
                error.insertAfter("#content"); // Place error message below the CKEditor
            } else {
                error.insertAfter(element);
            }
        },
    });

    $("#editForm").validate({
        ignore: [],
        rules: {
            title: {
                required: true,
                maxlength: 255,
            },
            content: {
                required: true,
            },
            category: {
                required: true,
            },
            filePath: {
                required: true,
                fileType: /^image\/(jpeg|jpg|png)$/,
            },
        },
        messages: {
            title: {
                required: "please enter the title!",
                maxlength: "Title cannot exceed 255 characters!",
            },
            content: {
                required: "Please enter the content!",
            },
            category: {
                required: "Please select a category",
            },
            filePath: {
                required: "This field is required!",
                fileType: "Only JPEG, JPG, PNG files are allowed!",
            },
        },
        submitHandler: function (form) {
            const formData = new FormData(form);
            formData.append("_method", "PUT");
            const table = $("#articlesTable").DataTable();
            const id = formData.get("id");

            $.ajax({
                type: "POST",
                url: `/api/articles/${id}`,
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
                    table.ajax.reload();
                    $("#cuisineEditForm").find("input, textarea").val("");
                    closeModal("edit-modal");
                    Swal.fire({
                        title: "Success!",
                        text: "Updated Successfully!",
                        icon: "success",
                    });
                },
                error: function (error) {
                    console.log(error);
                },
            });
        },
    });

    $("#articlesTable tbody").on("click", "i.editBtn", function (e) {
        const id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: `/api/articles/${id}`,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#editTitle").val(data.title);
                $("#editCategory option").each(function () {
                    if ($(this).val() === data.category) {
                        $(this).prop("selected", true);
                    } else {
                        $(this).prop("selected", false);
                    }
                });
                $("#editContent").val(data.content);
                openModal("edit-modal");
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
    $("#articlesTable tbody").on("click", "i.deleteBtn", function (e) {
        const id = $(this).data("id");
        const table = $("#articlesTable").DataTable();
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
                    url: `/api/articles/${id}`,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {
                        table.ajax.reload();
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
