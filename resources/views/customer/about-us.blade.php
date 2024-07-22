@extends('customer.layout.app')

@section('content')
    <div class="container mx-auto p-10">
        <!-- First Part -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-20">
            <div class="p-4">
                <p class="text-yellow-400 mb-2 text-2xl">#1 on Online Food Hub</p>
                <h1 class="text-5xl font-semibold mb-4 merriweather-bold">
                    <span class="text-red-500">Revolutionize</span>
                    your <span class="text-yellow-500">dining</span> experience
                </h1>
                <p class="mb-4 text-m mt-2">Discover a world of flavors and convenience with YumHub, the ultimate
                    multi-vendor food ordering experience.</p>
                <a href="{{ route('sign-up') }}">
                    <button type="button"
                        class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-6 py-3 text-center me-2 mb-2 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-900">
                        Sign up
                    </button>
                </a>
            </div>
            <div class="flex justify-center p-4">
                <img src="{{ asset('images/burger.png') }}" alt="Delicious burger" class="object-cover" height="250"
                    width="500">
            </div>
        </div>

        <!-- Second Part -->
        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 bg-white shadow-lg rounded-lg">
                <img src="{{ asset('images/burger_1.jpg') }}" alt="Delicious Burgers"
                    class="w-full h-48 object-cover rounded-t-lg mb-4">
                <h2 class="text-3xl font-semibold mb-3 merriweather-bold text-red-500">Delicious Burgers</h2>
                <p class="text-gray-700">Indulge in our mouth-watering burgers made with fresh ingredients and premium
                    quality meats.</p>
            </div>
            <div class="p-8 bg-white shadow-lg rounded-lg">
                <img src="{{ asset('images/pizza.jpg') }}" alt="Tasty Pizzas"
                    class="w-full h-48 object-cover rounded-t-lg mb-4">
                <h2 class="text-3xl font-semibold mb-3 merriweather-bold text-red-500">Tasty Pizzas</h2>
                <p class="text-gray-700">Savor our hand-crafted pizzas with a variety of toppings and flavors to suit every
                    taste.</p>
            </div>
            <div class="p-8 bg-white shadow-lg rounded-lg">
                <img src="{{ asset('images/salad.jpg') }}" alt="Healthy Salads"
                    class="w-full h-48 object-cover rounded-t-lg mb-4">
                <h2 class="text-3xl font-semibold mb-3 merriweather-bold text-red-500">Healthy Salads</h2>
                <p class="text-gray-700">Enjoy our fresh and nutritious salads made with the finest ingredients for a
                    wholesome meal.</p>
            </div>
        </div>

        <!-- Third Part -->
        <div class="flex flex-col items-center text-center mt-20">
            <h1 class="text-red-500 text-4xl font-semibold mb-2 merriweather-bold">Discover our features</h1>
            <p class="text-gray-700 mb-8">Empowering foodies and vendors with innovative features</p>
        </div>

        <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="p-8 bg-white shadow-lg rounded-lg">
                <h3 class="text-xl font-semibold mb-2 merriweather-bold text-red-500">Data Security</h3>
                <p class="text-gray-700">Secure transactions ensure your data is protected.</p>
            </div>
            <div class="p-8 bg-white shadow-lg rounded-lg">
                <h3 class="text-xl font-semibold mb-2 merriweather-bold text-red-500">Quick Checkout</h3>
                <p class="text-gray-700">Streamlined checkout process saves your time</p>
            </div>
            <div class="p-8 bg-white shadow-lg rounded-lg">
                <h3 class="text-xl font-semibold mb-2 merriweather-bold text-red-500">Real-Time Updates</h3>
                <p class="text-gray-700">Experience zero lags with real-time menu updates</p>
            </div>
            <div class="p-8 bg-white shadow-lg rounded-lg">
                <h3 class="text-xl font-semibold mb-2 merriweather-bold text-red-500">Fast and Easy</h3>
                <p class="text-gray-700">Effortlessly place and receive orders within minutes</p>
            </div>
        </div>

        <!-- Fourth Part -->
        <div class="mt-16">
            <div class="flex flex-col items-center text-center mb-8">
                <h1 class="text-red-500 text-4xl font-semibold mb-2 merriweather-bold">Customer Reviews</h1>
                <p class="text-gray-700">What our happy customers are saying</p>
            </div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide p-8 bg-white shadow-lg rounded-lg">
                        <img src="{{ asset('images/john.jpg') }}" alt="Customer Photo"
                            class="w-28 h-28 rounded-full mx-auto mb-4">
                        <p class="text-gray-700 mb-4">"YumHub has revolutionized the way I order food. The variety and
                            quality are unbeatable!"</p>
                        <p class="text-yellow-500 font-semibold">- John Doe</p>
                    </div>
                    <div class="swiper-slide p-8 bg-white shadow-lg rounded-lg">
                        <img src="{{ asset('images/jane.jpg') }}" alt="Customer Photo"
                            class="w-28 h-28 rounded-full mx-auto mb-4">
                        <p class="text-gray-700 mb-4">"I love the convenience and the fast delivery. YumHub never
                            disappoints!"</p>
                        <p class="text-yellow-500 font-semibold">- Jane Smith</p>
                    </div>
                    <div class="swiper-slide p-8 bg-white shadow-lg rounded-lg">
                        <img src="{{ asset('images/MIC.jpg') }}" alt="Customer Photo"
                            class="w-28 h-28 rounded-full mx-auto mb-4">
                        <p class="text-gray-700 mb-4">"A fantastic platform with excellent customer service and delicious
                            food options."</p>
                        <p class="text-yellow-500 font-semibold">- Michael Brown</p>
                    </div>
                    <div class="swiper-slide p-8 bg-white shadow-lg rounded-lg">
                        <img src="{{ asset('images/smith.jpg') }}" alt="Customer Photo"
                            class="w-28 h-28 rounded-full mx-auto mb-4">
                        <p class="text-gray-700 mb-4">"The best multi-vendor food app I've used. Highly recommend YumHub!"
                        </p>
                        <p class="text-yellow-500 font-semibold">- Emily Wilson</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- SwiperJS Initialization -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
    </script>
@endsection



@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endsection
