@extends('customer.layout.app')

@section('title', 'My Orders')

@section('content')
    <div class="container mx-auto px-4  py-20 mb-20 ">
        <h1 class="text-2xl font-bold mb-4 merriweather-bold">My Orders</h1>

        <table class="min-w-full border rounded-lg shadow-md" id="orderTable">
            <thead class="">
                <tr class="text-left text-red-800">
                    <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Order ID</th>
                    <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Status</th>
                    <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Order Date</th>
                    <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Receipt</th>
                    <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">View items</th>
                </tr>
            </thead>
            <tbody id="order-items">
                <!-- Orders will be appended here -->
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <!-- Modal -->
    <div id="orderItemsModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg overflow-hidden shadow-lg w-3/4 max-w-lg">
            <div class="px-4 py-2 flex justify-between items-center border-b">
                <h2 class="text-xl font-bold merriweather-bold">Order Items</h2>
                <button id="closeModalBtn" class="text-red-500 text-2xl">&times;</button>
            </div>
            <div class="p-4">
                <table class="min-w-full border rounded-lg shadow-md">
                    <thead>
                        <tr class="text-left text-red-800">
                            <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Item Name</th>
                            <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Quantity</th>
                            <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Price</th>
                        </tr>
                    </thead>
                    <tbody id="modal-order-items">
                        <!-- Order items will be appended here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')
    @php
        $user = Auth::user();
        $receiptRoute = route('receipt', ['orderID' => 'ORDER_ID_PLACEHOLDER']);
    @endphp

    <script>
        const user = @json($user);
        const userID = user.id;
        $(document).ready(function() {

            $('#closeModalBtn').click(function() {
                $('#orderItemsModal').addClass('hidden');
            });

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
                    const receiptUrl = `{{ $receiptRoute }}`.replace('ORDER_ID_PLACEHOLDER', order.id);
                    tableBody.append(`
                        <tr>
                            <td class="py-3 px-6">${order.id}</td>
                            <td class="py-3 px-6">${order.status}</td>
                            <td class="py-3 px-6">${order.order_date}</td>
                       
                                    <td class="py-3 px-6">
                                              <a href="${receiptUrl}">
                                        <button type="button" class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600 receipt-btn" data-order-id="${order.id}">Receipt</button>
                                      </a>  
                                        </td>
                              
                           
                            <td class="py-3 px-6">
                                <button type="button" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600 view-items-btn" data-order-id="${order.id}">View Items</button>
                            </td>
                        </tr>
                    `);
                });
            }

            function showOrderItemsModal(orderItems) {
                var $modalBody = $('#modal-order-items');
                $modalBody.empty(); // Clear existing content

                // Check if orderItems is an array and has the expected format
                if (Array.isArray(orderItems)) {
                    orderItems.forEach(function(item) {
                        // Access the nested order and food objects
                        var orderDetails = item.order; // Assuming there's an order object
                        var foodDetails = item.food; // Assuming there's a food object

                        // Extract details from the nested food object
                        var foodName = foodDetails.name || "Unknown";
                        var foodPrice = foodDetails.price || "0";
                        var quantity = item.qty || "0"; // Directly from the item

                        // Create a table row with the extracted details
                        var row = `
                <tr>
                    <td class="py-3 px-6 border-b border-yellow-300">${foodName}</td>
                    <td class="py-3 px-6 border-b border-yellow-300">${quantity}</td>
                    <td class="py-3 px-6 border-b border-yellow-300">${foodPrice}</td>
                </tr>
            `;
                        $modalBody.append(row);
                    });
                } else {
                    console.log('Invalid data format for order items:', orderItems);
                }

                // Show the modal
                $('#orderItemsModal').removeClass('hidden');
            }




            $("#orderTable tbody").on("click", ".view-items-btn", function() {

                const orderID = $(this).data("order-id");
                $.ajax({
                    type: "GET",
                    url: `/api/my-order-items/${orderID}`,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);

                        showOrderItemsModal(data);
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });
            });

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
