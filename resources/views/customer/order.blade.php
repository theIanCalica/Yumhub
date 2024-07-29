@extends('customer.layout.app')

@section('title', 'My Orders')

@section('content')
    <div class="container mx-auto px-4  py-20 mb-20 ">
        <h1 class="text-2xl font-bold mb-4 merriweather-bold">My Orders</h1>

        <table class="min-w-full border rounded-lg shadow-md">
            <thead class="">
                <tr class="text-left text-red-800">
                    <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Order ID</th>
                    <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Status</th>
                    <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Order Date</th>
                    <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">View items</th>
                </tr>
            </thead>
            <tbody id="order-items">
                <!-- Orders will be appended here -->
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    @php
        $user = Auth::user();
    @endphp

    <script>
        const user = @json($user);
        const userID = user.id;
        $(document).ready(function() {
            function updateOrdersTable(orders) {
                const tableBody = $('#order-items'); // Corrected ID
                tableBody.empty(); // Clear existing rows

                if (orders.length === 0) {
                    Swal.fire({
                        title: 'No Orders Found',
                        text: 'You have no orders at the moment.',
                        icon: 'info',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                orders.forEach(order => {
                    tableBody.append(`
                        <tr>
                            <td class="py-3 px-6">${order.id}</td>
                            <td class="py-3 px-6">${order.status}</td>
                            <td class="py-3 px-6">${order.order_date}</td>
                            <td class="py-3 px-6">
                                <button type="button" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600 view-items-btn" data-order-id="${order.id}">View Items</button>
                            </td>
                        </tr>
                    `);
                });
            }

            $.ajax({
                type: "GET",
                url: `/api/myOrders/${userID}`,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    updateOrdersTable(response.orders);
                },
                error: function(xhr, status, error) {
                    console.error("Failed to fetch orders:", error);
                }
            });
        });
    </script>
@endsection
