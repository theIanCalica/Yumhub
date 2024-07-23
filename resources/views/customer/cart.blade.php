@extends('customer.layout.app')

@section('title', 'My Cart')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">My Cart</h1>

        <form action="#" method="POST">
            @csrf
            @method('PUT') <!-- Use PUT or PATCH for updates -->

            <table class="min-w-full  border  rounded-lg shadow-md">
                <thead class="">
                    <tr class="text-left text-red-800">
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Food Item</th>
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Category</th>
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Price</th>
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Quantity</th>
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Total</th>
                        <th class="py-3 px-6 border-b border-yellow-300 merriweather-bold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row 1 -->
                    <tr class="border-b hover:bg-yellow-100">
                        <td class="py-3 px-6">Cheeseburger</td>
                        <td class="py-3 px-6 text-red-600">$8.99</td>
                        <td class="py-3 px-6 text-center">2</td>
                        <td class="py-3 px-6 text-red-600">$17.98</td>
                        <td class="py-3 px-6 text-center">
                            <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Edit</button>
                            <button class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600">Delete</button>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="border-b hover:bg-yellow-100">
                        <td class="py-3 px-6">Veggie Pizza</td>
                        <td class="py-3 px-6 text-red-600">$12.49</td>
                        <td class="py-3 px-6 text-center">1</td>
                        <td class="py-3 px-6 text-red-600">$12.49</td>
                        <td class="py-3 px-6 text-center">
                            <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Edit</button>
                            <button class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600">Delete</button>
                        </td>
                    </tr>
                    <!-- Row 3 -->
                    <tr class="border-b hover:bg-yellow-100">
                        <td class="py-3 px-6">Chicken Wings</td>
                        <td class="py-3 px-6 text-red-600">$9.99</td>
                        <td class="py-3 px-6 text-center">3</td>
                        <td class="py-3 px-6 text-red-600">$29.97</td>
                        <td class="py-3 px-6 text-center">
                            <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Edit</button>
                            <button class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600">Delete</button>
                        </td>
                    </tr>
                </tbody>
                <tfoot class="">
                    <tr class="">
                        <td colspan="3" class="py-3 px-6 text-right font-semibold text-red-800">Total</td>
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

{{-- @foreach ($orders as $order)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $order->food->name }}</td>
                            <td class="py-2 px-4 border-b">{{ number_format($order->food->price, 2) }} PHP</td>
                            <td class="py-2 px-4 border-b">
                                <input type="number" name="quantities[{{ $order->id }}]" value="{{ $order->quantity }}"
                                    min="1" class="w-full border border-gray-300 rounded-lg py-1 px-2">
                            </td>
                            <td class="py-2 px-4 border-b">
                                {{ number_format($order->food->price * $order->quantity, 2) }} PHP
                            </td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('cart.remove', $order->id) }}"
                                    class="text-red-500 hover:underline">Remove</a>
                            </td>
                        </tr>
                    @endforeach --}}
{{-- Footer --}}
{{-- <tr>
                        <td colspan="4" class="py-2 px-4 border-t text-right font-bold">Total:</td>
                        <td class="py-2 px-4 border-t font-bold">
                            {{ number_format(
                                $orders->sum(function ($order) {
                                    return $order->food->price * $order->quantity;
                                }),
                                2,
                            ) }}
                            PHP
                        </td>
                    </tr> --}}
