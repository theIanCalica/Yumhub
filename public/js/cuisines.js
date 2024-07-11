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

    $("#cuisinesTable").dataTable({
        ajax: {
            url: "/api/cuisines",
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
            { data: "name" },
            { data: "desc" },
            {
                data: "img_url",
                render: function (data, type, row) {
                    // Construct the full URL for the image
                    console.log(data.substring(7));
                    const imageUrl = "storage/" + data.substring(7);
                    return (
                        '<img src="' +
                        imageUrl +
                        '" alt="' +
                        "haha" +
                        '" class="w-full h-full object-cover"/>'
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

    $("#cuisineAddForm").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255,
            },
            desc: {
                required: true,
            },
            img: {
                required: true,
                fileType: /^image\/(jpeg|jpg|png)$/,
            },
        },
        messages: {
            name: {
                required: "This field is required!",
                maxlength: "Name cannot exceed 255 characters!",
            },
            desc: {
                required: "This field is required!",
            },
            img_url: {
                required: "This field is required!",
                fileType: "Only JPEG, JPG, PNG files are allowed!",
            },
        },
        submitHandler: function (form) {
            const formData = new FormData(form);
            for (var pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }

            $.ajax({
                type: "POST",
                url: "/api/cuisines",
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
                    var tr = $("<tr>");
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.cuisines.id)
                    );
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.cuisines.name)
                    );
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .html(data.cuisines.desc)
                    );
                    tr.append(
                        $("<th>")
                            .addClass(
                                "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            )
                            .append(
                                $("<img>")
                                    .attr("src", data.cuisines.img_url)
                                    .addClass("h-16 w-16 object-cover") // Adjust these classes as needed
                            )
                    );

                    tr.append(
                        $("<th>").html(
                            "<i class='fi fi-rr-edit text-blue-500 editBtn mr-10' data-id='" +
                                data.cuisines.id +
                                "'></i><i class='fi fi-rr-trash deleteBtn text-red-500' data-id='" +
                                data.cuisines.id +
                                "'></i>"
                        )
                    );
                    $("table tbody").append(tr);

                    closeModal();
                    Swal.fire({
                        title: "Success!",
                        text: "You added new cuisine!",
                        icon: "success",
                    });
                },
                error: function (error) {
                    console.log(error);
                },
            });
        },
    });

    $("#cuisineEditForm").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255,
            },
            desc: {
                required: true,
            },
            img: {
                required: true,
                fileType: /^image\/(jpeg|jpg|png)$/,
            },
        },
        messages: {
            name: {
                required: "This field is required!",
                maxlength: "Name cannot exceed 255 characters!",
            },
            desc: {
                required: "This field is required!",
            },
            img_url: {
                required: "This field is required!",
                fileType: "Only JPEG, JPG, PNG files are allowed!",
            },
        },
        submitHandler: function (form) {
            const formData = new FormData(form);
            formData.append("_method", "PUT");
            for (var pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }

            const table = $("#cuisinesTable").DataTable();
            const id = formData.get("id");

            $.ajax({
                type: "POST",
                url: `/api/cuisines/${id}`,
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

    $("#cuisinesTable tbody").on("click", "i.editBtn", function (e) {
        console.log("hi");
        const id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: `/api/cuisines/${id}`,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#editName").val(data.name);
                $("#editDesc").val(data.desc);
                openModal("edit-modal");
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#cuisinesTable tbody").on("click", "i.deleteBtn", function (e) {
        const cuisineID = $(this).data("id");
        const $row = $(this).closest("tr");

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
                    url: `/api/cuisines/${cuisineID}`,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        $row.fadeOut(2000, function () {
                            $row.remove();
                        });
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

    $("#name").on("input", function () {
        const name = $(this).val().trim();

        if (name != "" && name.length <= 255) {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#desc").on("input", function () {
        const desc = $(this).val().trim();

        if (desc != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#img").on("change", function () {
        const file = this.files[0];
        if (file) {
            const validTypes = ["image/jpeg", "image/png", "image/jpg"];
            if (validTypes.includes(file.type)) {
                $(this).removeClass("error");
                $(this).addClass("success");
            } else {
                $(this).removeClass("success");
                $(this).addClass("error");
            }
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#editName").on("input", function () {
        const name = $(this).val().trim();

        if (name != "" && name.length <= 255) {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#editDesc").on("input", function () {
        const desc = $(this).val().trim();

        if (desc != "") {
            $(this).removeClass("error");
            $(this).addClass("success");
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });

    $("#editImg").on("change", function () {
        const file = this.files[0];
        if (file) {
            const validTypes = ["image/jpeg", "image/png", "image/jpg"];
            if (validTypes.includes(file.type)) {
                $(this).removeClass("error");
                $(this).addClass("success");
            } else {
                $(this).removeClass("success");
                $(this).addClass("error");
            }
        } else {
            $(this).removeClass("success");
            $(this).addClass("error");
        }
    });
});
