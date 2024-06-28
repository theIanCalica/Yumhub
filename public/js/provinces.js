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

    $("#provinceAddForm").validate({
        rules: {
            provinceName: {
                required: true,
            },
            region_id: {
                required: true,
            },
        },
    });
});
