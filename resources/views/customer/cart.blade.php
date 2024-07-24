@extends('customer.layout.app')

@section('title', 'My Cart')

@section('content')
    <div class="container mx-auto px-4  py-20 mb-20 ">
        <h1 class="text-2xl font-bold mb-4">My Cart</h1>

        <form action="#" method="POST">
            <table class="min-w-full border rounded-lg shadow-md">
                <thead class="">
                    <tr class="text-left text-red-800">
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Food Item</th>
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Cuisine</th>
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Category</th>
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Price</th>
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Quantity</th>
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Total</th>
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-yellow-100">
                        <td class="py-3 px-6">Cheeseburger</td>
                        <td class="py-3 px-6 text-red-600">American Cuisine</td>
                        <td class="py-3 px-6 text-center">Burger</td>
                        <td class="py-3 px-6 text-red-600">$8.99</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button type="button"
                                    class="qty-btn bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                                    data-action="decrement">-</button>
                                <input type="text" name="quantities[1]" value="1" min="1"
                                    class="qty-input w-12 text-center border border-gray-300 rounded">
                                <button type="button"
                                    class="qty-btn bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600"
                                    data-action="increment">+</button>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-red-600">$8.99</td>
                        <td class="py-3 px-6 text-center">

                            <button type="button"
                                class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600">Delete</button>
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-yellow-100">
                        <td class="py-3 px-6">Cheeseburger</td>
                        <td class="py-3 px-6 text-red-600">American Cuisine</td>
                        <td class="py-3 px-6 text-center">Burger</td>
                        <td class="py-3 px-6 text-red-600">$8.99</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button type="button"
                                    class="qty-btn bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                                    data-action="decrement">-</button>
                                <input type="text" name="quantities[1]" value="1" min="1"
                                    class="qty-input w-12 text-center border border-gray-300 rounded">
                                <button type="button"
                                    class="qty-btn bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600"
                                    data-action="increment">+</button>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-red-600">$8.99</td>
                        <td class="py-3 px-6 text-center">

                            <button type="button"
                                class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600">Delete</button>
                        </td>
                    </tr>
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
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Update
                    Cart</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Handle quantity changes
            $('.qty-btn').on('click', function() {
                var $input = $(this).siblings('.qty-input');
                var currentVal = parseInt($input.val(), 10);
                var action = $(this).data('action');

                if (action === 'increment') {
                    $input.val(currentVal + 1);
                } else if (action === 'decrement') {
                    if (currentVal > 1) {
                        $input.val(currentVal - 1);
                    }
                }
            });
        });

        $.ajax({
            type: "GET",
            url: "",

        });
    </script>
@endsection
