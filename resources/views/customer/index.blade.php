@extends('customer.layout.app')

@section('styles')
    <style>

    </style>
@endsection

@section('content')
    <div class="container mx-auto p-4 bg-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex  items-center space-x-2">
                    <span class="bg-red-100 flex items-center space-x-2 shadow-md">
                        <img src="{{ asset('pics/love.png') }}" alt="Love icon" class="w-5 h-5">

                        <h2 class="text-sm  mb-2 trust">People Trust Us </h2>
                    </span>

                </div>
                <p class="text-gray-700 font-bold text-3xl mt-5">We're <span class="text-red-500">Serious</span> For Food &
                    Delivery</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-bold mb-2">Item 2</h2>
                <p class="text-gray-700">Description for item 2.</p>
            </div>

        </div>
    </div>
@endsection
