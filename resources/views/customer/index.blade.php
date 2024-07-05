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
                <p>Best cooks and best delivery guys all at your service. Hot Tasty food will reach you in 60 minutes.</p>

                <form>
                    <label for="search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="search"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search" required />
                        <button type="submit"
                            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>
                <div class="flex">
                    <button type="button"
                        class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Order
                        Now!</button>
                    <button type="button"
                        class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Order
                        Now!</button>
                </div>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-bold mb-2">Item 2</h2>
                <p class="text-gray-700">Description for item 2.</p>
            </div>

        </div>
    </div>
@endsection
