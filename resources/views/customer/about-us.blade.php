@extends('customer.layout.app')

@section('content')
    <div class="container mx-auto p-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
            <div class="p-4">
                <p class="text-yellow-400 mb-2 text-2xl">#1 on Online Food Hub</p>
                <h1 class="text-5xl font-semibold mb-4 merriweather-bold "> <span class="text-red-500">Revolutionize</span>
                    your <span class="text-yellow-500">dining</span> experience</h1>
                <p class="mb-4 text-m mt-2">Discover a world of flavors and convenience with YumHub, the ultimate
                    multi-vendor
                    food
                    ordering experience.</p>
                <button type="button"
                    class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-6 py-3 text-center me-2 mb-2 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-900">Sign
                    up</button>
            </div>
            <div class="flex justify-center p-4">
                <img src="{{ asset('images/burger.png') }}" alt="Delicious burger" class="object-cover" height="250"
                    width="500">
            </div>
        </div>
    </div>
@endsection
