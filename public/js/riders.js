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

    $("#managerAddForm").validate({
        rules: {
            fname: {
                required: true,
            },
            lname: {
                required: true,
            },
            sex: {
                required: true,
            },
            DOB: {
                required: true,
            },
            phoneNumber: {
                required: true,
                minlength: 11,
            },
            email: {
                required: true,
            },
            hireddate: {
                required: true,
            },
            status: {
                required: true,
            },
            salary: {
                required: true,
            },
            address: {
                required: true,
            },
            motorModel: {
                required: true,
            },
        },
        messages: {
            fname: {
                required: "This field is required!",
            },
            lname: {
                required: "This field is required!",
            },
            sex: {
                required: "This field is required!",
            },
            DOB: {
                required: "This field is required!",
            },
            phoneNumber: {
                required: "This field is required!",
                minlength: "Invalid phone number",
            },
            email: {
                required: "This field is required!",
            },
            hireddate: {
                required: "This field is required!",
            },
            status: {
                required: "This field is required!",
            },
            salary: {
                required: "This field is required!",
            },
            address: {
                required: "This field is required!",
            },
            motorModel: {
                required: "This field is required!",
            },
        },
        submitHandler: function (form) {
            const formData = new FormData(form);
            for (var pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }

            $.ajax({
                type: "POST",
                url: "/api/riders",
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
                    // Add the new item to the table
                    // var tr = $("<tr>");
                    // tr.append(
                    //     $("<th>")
                    //         .addClass(
                    //             "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    //         )
                    //         .html(data.region.id)
                    // );
                    // tr.append(
                    //     $("<th>")
                    //         .addClass(
                    //             "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    //         )
                    //         .html(data.region.regionName)
                    // );
                    // $("table tbody").append(tr);
                    // // Sort the table rows by the region name
                    // var rows = $("table tbody tr").get();
                    // rows.sort(function (a, b) {
                    //     var A = $(a).children("th").eq(1).text().toUpperCase();
                    //     var B = $(b).children("th").eq(1).text().toUpperCase();
                    //     return A < B ? -1 : A > B ? 1 : 0;
                    // });
                    // $.each(rows, function (index, row) {
                    //     $("table").children("tbody").append(row);
                    // });
                    // closeModal();
                },
            });
        },
    });

    $("#managerEditForm").validate({
        rules: {
            fname: {
                required: true,
            },
            lname: {
                required: true,
            },
            sex: {
                required: true,
            },
            DOB: {
                required: true,
            },
            phoneNumber: {
                required: true,
                minlength: 11,
            },
            email: {
                required: true,
            },
            hireddate: {
                required: true,
            },
            status: {
                required: true,
            },
            salary: {
                required: true,
            },
            address: {
                required: true,
            },
        },
        messages: {
            fname: {
                required: "This field is required!",
            },
            lname: {
                required: "This field is required!",
            },
            sex: {
                required: "This field is required!",
            },
            DOB: {
                required: "This field is required!",
            },
            phoneNumber: {
                required: "This field is required!",
                minlength: "Invalid phone number",
            },
            email: {
                required: "This field is required!",
            },
            hireddate: {
                required: "This field is required!",
            },
            status: {
                required: "This field is required!",
            },
            salary: {
                required: "This field is required!",
            },
            address: {
                required: "This field is required!",
            },
        },
        submitHandler: function (form) {
            const formDate = new FormData(form);
            for (var pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }
            $.ajax({
                type: "PUT",
                url: "/api/managers",
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
    });
});
