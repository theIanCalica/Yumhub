@extends('customer.layout.app')

@section('styles')
    <style>
        .outer-wrapper {
            border-radius: 0.5rem 0.5rem 0 0;
            /* Rounded top corners */
        }

        .inner-wrapper {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            border-radius: inherit;
            overflow: hidden;
            /* Ensures no part of the content exceeds the border-radius */
        }
    </style>
@endsection

@section('content')
    <div class="container mx-auto p-4 ">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 pl-3 bg-zinc-50" style="height: 500px">
            <div class="  rounded-lg p-6">
                <div class="flex  items-center space-x-2 pl-3">
                    <span class="bg-red-100 flex items-center space-x-2 shadow-md rounded-full p-2">
                        <img src="{{ asset('pics/love.png') }}" alt="Love icon" class="w-5 h-5">
                        <h2 class="text-sm mb-0 trust">People Trust Us</h2>
                    </span>


                </div>
                <p class="text-gray-700 font-bold text-5xl mt-5  merriweather-bold " style="width: 450px">We're <span
                        class="text-red-500">Serious</span> For <span class="text-red-500">
                </p>

                <p class="text-gray-700 font-bold text-5xl mt-5  merriweather-bold " style="width: 450px"><span
                        class="text-red-500">Food</span> &
                    <span class="text-yellow-400">Delivery</span>
                </p>

                <p class="my-7 text-xl ">Best cooks and best delivery guys all at your service. Hot Tasty food will reach
                    you in 60
                    minutes.</p>

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
            <div class="rounded-lg p-6">
                <img src="{{ asset('images/home_1.png') }}" alt="">
                <h2 class="text-lg font-bold mb-2"></h2>
                <p class="text-gray-700">Description for item 2.</p>
            </div>

        </div>
        <div class="mt-24">
            <h1 class="text-center font-bold text-5xl andika-bold">Various <span class="text-red-500">Cuisines</span></h1>
            <p class="text-center text-lg mt-5 inter-subtext">Savor the exquisite flavors of our various cuisines,
                meticulously crafted to
                offer an
                unforgettable culinary
                experience.</p>
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                        <div class="relative">
                            <img class="w-full h-48 object-cover" src="https://via.placeholder.com/150" alt="Chicken Tikka">
                            <div class="absolute top-0 right-0 m-2 p-2 bg-white rounded-full text-red-500 font-bold">$15
                            </div>
                        </div>
                        <div class="px-6 py-4">
                            <div class="flex items-center">
                                <img class="w-10 h-10 rounded-full mr-4" src="https://via.placeholder.com/40"
                                    alt="Avatar">
                                <img class="w-10 h-10 rounded-full mr-4" src="https://via.placeholder.com/40"
                                    alt="Avatar">
                                <span class="text-yellow-500 text-xl">★</span>
                                <span class="ml-1 text-gray-700">(4.8)</span>
                            </div>
                            <div class="mt-4 text-center">
                                <div class="font-bold text-xl mb-2 text-red-600">Chicken Tikka</div>
                                <p class="text-gray-700 text-base">
                                    Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.
                                </p>
                            </div>
                        </div>
                        <div class="px-6 py-4 text-center">
                            <button class="bg-red-500 text-white rounded-full px-4 py-2">Order Now</button>
                        </div>
                    </div>


                </div>
                <div>
                    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                        <div class="relative">
                            <img class="w-full h-48 object-cover" src="https://via.placeholder.com/150" alt="Chicken Tikka">
                            <div class="absolute top-0 right-0 m-2 p-2 bg-white rounded-full text-red-500 font-bold">$15
                            </div>
                        </div>
                        <div class="px-6 py-4">
                            <div class="flex items-center">
                                <img class="w-10 h-10 rounded-full mr-4" src="https://via.placeholder.com/40"
                                    alt="Avatar">
                                <img class="w-10 h-10 rounded-full mr-4" src="https://via.placeholder.com/40"
                                    alt="Avatar">
                                <span class="text-yellow-500 text-xl">★</span>
                                <span class="ml-1 text-gray-700">(4.8)</span>
                            </div>
                            <div class="mt-4 text-center">
                                <div class="font-bold text-xl mb-2 text-red-600">Chicken Tikka</div>
                                <p class="text-gray-700 text-base">
                                    Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.
                                </p>
                            </div>
                        </div>
                        <div class="px-6 py-4 text-center">
                            <button class="bg-red-500 text-white rounded-full px-4 py-2">Order Now</button>
                        </div>
                    </div>


                </div>
                <div>
                    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                        <div class="relative">
                            <img class="w-full h-48 object-cover" src="https://via.placeholder.com/150" alt="Chicken Tikka">
                            <div class="absolute top-0 right-0 m-2 p-2 bg-white rounded-full text-red-500 font-bold">$15
                            </div>
                        </div>
                        <div class="px-6 py-4">
                            <div class="flex items-center">
                                <img class="w-10 h-10 rounded-full mr-4" src="https://via.placeholder.com/40"
                                    alt="Avatar">
                                <img class="w-10 h-10 rounded-full mr-4" src="https://via.placeholder.com/40"
                                    alt="Avatar">
                                <span class="text-yellow-500 text-xl">★</span>
                                <span class="ml-1 text-gray-700">(4.8)</span>
                            </div>
                            <div class="mt-4 text-center">
                                <div class="font-bold text-xl mb-2 text-red-600">Chicken Tikka</div>
                                <p class="text-gray-700 text-base">
                                    Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.
                                </p>
                            </div>
                        </div>
                        <div class="px-6 py-4 text-center">
                            <button class="bg-red-500 text-white rounded-full px-4 py-2">Order Now</button>
                        </div>
                    </div>


                </div>
                <div>
                    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                        <div class="relative">
                            <img class="w-full h-48 object-cover" src="https://via.placeholder.com/150"
                                alt="Chicken Tikka">
                            <div class="absolute top-0 right-0 m-2 p-2 bg-white rounded-full text-red-500 font-bold">$15
                            </div>
                        </div>
                        <div class="px-6 py-4">
                            <div class="flex items-center">
                                <img class="w-10 h-10 rounded-full mr-4" src="https://via.placeholder.com/40"
                                    alt="Avatar">
                                <img class="w-10 h-10 rounded-full mr-4" src="https://via.placeholder.com/40"
                                    alt="Avatar">
                                <span class="text-yellow-500 text-xl">★</span>
                                <span class="ml-1 text-gray-700">(4.8)</span>
                            </div>
                            <div class="mt-4 text-center">
                                <div class="font-bold text-xl mb-2 text-red-600">Chicken Tikka</div>
                                <p class="text-gray-700 text-base">
                                    Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.
                                </p>
                            </div>
                        </div>
                        <div class="px-6 py-4 text-center">
                            <button class="bg-red-500 text-white rounded-full px-4 py-2">Order Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-36">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2:gap-4">

                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-bold mb-2">Item 2</h2>
                    <p class="text-gray-700">Description for item 2.</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">

                    <p class="text-gray-700 font-black merriweather-bold text-3xl mt-5 " style="width: 350px">We are <span
                            class="text-red-500">more</span>
                        than
                        <span class="text-yellow-400">multiple</span> service
                    </p>
                    <p class="mt-5">Discover YumHub, your go-to app for transportation and delicious meals crafted by top
                        chefs. In addition to light refreshment such as baked goods or snacks.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 inter-subtext mt-7">
                        <div>
                            <ul class="list-disc list-inside">
                                <li class="flex items-center ">
                                    <img src="{{ asset('icons/laptop.png') }}" class="h-8 w-8 mr-2"
                                        alt="24/7 Service Icon">
                                    Online Order
                                </li>
                                <li class="flex items-center mt-5">
                                    <img src="{{ asset('icons/burger.png') }}" class="h-8 w-8 mr-2"
                                        alt="24/7 Service Icon">
                                    Quality Food
                                </li>
                                <li class="flex items-center mt-5">
                                    <img src="{{ asset('icons/chef.png') }}" class="h-8 w-8 mr-2"
                                        alt="24/7 Service Icon">
                                    Super Chef
                                </li>
                            </ul>
                        </div>
                        <div>
                            <ul class="list-disc list-inside">
                                <li class="flex items-center">
                                    <img src="{{ asset('icons/24-hours.png') }}" class="h-8 w-8 mr-2"
                                        alt="24/7 Service Icon">
                                    24/7 Service
                                </li>
                                <li class="flex items-center mt-5">
                                    <img src="{{ asset('icons/layers.png') }}" class="h-8 w-8 mr-2"
                                        alt="24/7 Service Icon">
                                    Organized Foodhut Place
                                </li>
                                <li class="flex items-center mt-5">
                                    <img src="{{ asset('icons/clean.png') }}" class="h-8 w-8 mr-2"
                                        alt="24/7 Service Icon">
                                    Clean Kitchen
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="mt-36">
            <div class="text-center merriweather-bold">
                <h1 class="capitalize text-black text-4xl"><span class="text-red-500">Menu</span> that <span
                        class="text-yellow-400">Always</span> make you
                </h1>
                <h1 class="capitalize text-black text-4xl">Fall In <span class="text-red-500">love</span>
                </h1>
            </div>
            <div class="flex justify-center " id="categoryButtons">

            </div>

        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/customer/home.js') }}"></script>
@endsection
