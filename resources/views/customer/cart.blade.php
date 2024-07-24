@extends('customer.layout.app')

@section('title', 'My Cart')

@php
    $user = Auth::user();
@endphp
@section('content')
    <div class="container mx-auto px-4  py-20 mb-20 ">
        <h1 class="text-2xl font-bold mb-4 merriweather-bold">My Cart</h1>

        <form action="#" method="POST">
            <table class="min-w-full border rounded-lg shadow-md">
                <thead class="">
                    <tr class="text-left text-red-800">
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Food Item</th>
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Picture</th>
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Price</th>
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Quantity</th>
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Total</th>
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Actions</th>
                    </tr>
                </thead>
                <tbody id="cart-items">

                </tbody>
                <tfoot class="">
                    <tr class="">
                        <td colspan="5" class="py-3 px-6 text-right font-semibold text-red-800">Total</td>
                        <td class="py-3 px-6 text-red-600">$60.44</td>
                        <td class="py-3 px-6"></td>
                    </tr>
                </tfoot>
            </table>

            <div class="mt-4">
                <button type="button" id="checkoutBtn"
                    class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                    Confirm Order</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            const user = @json($user);
            const userId = user.id;
            loadCart();
            // Handle quantity changes using event delegation
            $(document).on('click', '.qty-btn', function() {
                var $input = $(this).siblings('.qty-input');
                var currentVal = parseInt($input.val(), 10);
                var action = $(this).data('action');
                var id = $input.data('id');
                console.log(id);

                var newVal;
                if (action === 'increment') {
                    newVal = currentVal + 1;
                } else if (action === 'decrement') {
                    if (currentVal > 1) {
                        newVal = currentVal - 1;
                    } else {
                        return; // Prevent decrementing below 1
                    }
                }

                // Update the input value
                $input.val(newVal);

                var formData = new FormData();
                formData.append("quantity", newVal); // Your data payload
                formData.append("_method", "PUT"); // Simulate PUT request


                $.ajax({
                    type: "POST",
                    url: `/api/cartItems/${id}`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        const price = parseFloat($input.closest('tr').find('td').eq(2).text()
                            .replace('₱', ''));
                        const subtotal = price * newVal;
                        $input.closest('tr').find('td').eq(4).text(`₱${subtotal.toFixed(2)}`);

                        // Recalculate total price
                        recalculateTotal();
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            });

            function recalculateTotal() {
                let totalPrice = 0;
                $('#cart-items tr').each(function() {
                    const subtotal = parseFloat($(this).find('td').eq(4).text().replace('₱', ''));
                    totalPrice += isNaN(subtotal) ? 0 : subtotal;
                });
                $('tfoot').find('td').eq(1).text(`₱${totalPrice.toFixed(2)}`);
            }

            function loadCart() {
                $.ajax({
                    type: "POST",
                    url: "/api/getCartFood",
                    data: {
                        user_id: userId
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    dataType: "json",
                    success: function(data) {
                        let totalPrice = 0; // Initialize total price
                        $('#cart-items').empty(); // Clear existing rows

                        data.forEach(function(item) {
                            let itemTotal = item.food.price * item.qty;
                            totalPrice += itemTotal;

                            $('#cart-items').append(`
                    <tr class="border-b hover:bg-yellow-100">
                        <td class="py-3 px-6">${item.food.name}</td>
         <td class="py-3 px-6">
    <img src="${item.food.filePath}" alt="${item.food.name}" class="w-16 h-16 object-cover" />
</td>

                        <td class="py-3 px-6 text-red-600">₱${item.food.price}</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button type="button"
                                    class="qty-btn bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                                    data-action="decrement">-</button>
                                <input type="text" name="quantities[${item.id}]" value="${item.qty}" min="1"
                                    class="qty-input w-12 text-center border border-gray-300 rounded" data-id="${item.id}">
                                <button type="button"
                                    class="qty-btn bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600"
                                    data-action="increment">+</button>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-red-600">₱${itemTotal}</td>
                        <td class="py-3 px-6 text-center">
                            <button type="button"
                                class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600 deleteBtn" data-id="${item.id}">Delete</button>
                        </td>
                    </tr>
                `);
                        });
                        $('tfoot').find('td').eq(1).text(`₱${(totalPrice)}`);
                    },
                    error: function(xhr, status, error) {
                        console.error("Failed to fetch cart items:", error);
                    }
                });
            }


            $(document).on('click', '.deleteBtn', function() {
                const id = $(this).data("id");
                console.log(id);

                Swal.fire({
                    title: "Do you want to delete it?",
                    icon: "question",
                    showDenyButton: true,
                    confirmButtonText: "Yes",
                    denyButtonText: `No!`
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Item Removed",
                            text: "The food item has been successfully removed from your cart.",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                        $.ajax({
                            type: "DELETE",
                            url: `/api/cartItems/${id}`,
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                    "content"
                                ),
                            },
                            dataType: "json",
                            success: function(data) {
                                console.log(data);
                                loadCart();
                            },
                        });

                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });

            });


            $("#checkoutBtn").on("click", function() {
                const user = @json($user);
                const user_id = user.id;
                console.log(user_id);
                $.ajax({
                    type: "POST",
                    url: "/api/checkout",
                    data: {
                        user_id: user_id,
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        window.location.href = data.sessionUrl;
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endsection
