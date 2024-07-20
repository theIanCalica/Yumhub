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

    $("#btnAdd").on("click", function () {
        openModal("add-modal");
    });

    $("#foodsTable").dataTable({
        ajax: {
            url: "/api/getFoods",
            dataSrc: "",
        },
        dom: '<"flex justify-between items-center"lf>t<"flex justify-between items-center"ip>',
        columns: [
            { data: "id" },
            { data: "name" },
            { data: "cuisine_id" },
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
});
