@extends('seller.layout.app')

@section('title', 'Restaurant Profile')

@section('content')
    <div class="flex justify-center mt-10 mb-20 pb-20">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-4xl">
            <form action="/update-profile" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="restaurant_id" id="restaurant_id" value="{{ $restaurant->id }}">

                <!-- Banner Image -->
                <div class="relative mb-24">
                    <img src="{{ $restaurant->banner }}" alt="Banner Image"
                        class="w-full h-60 object-cover rounded-t-lg border-4 border-indigo-500 mb-4">
                    <label for="banner_file"
                        class="absolute top-2 right-2 bg-white p-2 rounded-full shadow-md cursor-pointer">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7M5 12h14">
                            </path>
                        </svg>
                        <input type="file" id="banner_file" name="banner_file" class="hidden">
                    </label>
                </div>

                <!-- Profile Picture -->
                <div class="flex justify-center mb-8 relative -top-20">
                    <img src="{{ $restaurant->logo_filePath }}" alt="Profile Picture"
                        class="w-40 h-40 rounded-full border-4 border-indigo-500 object-cover">
                    <label for="logo_file"
                        class="absolute bottom-0 right-0 bg-white p-2 rounded-full shadow-md cursor-pointer">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7M5 12h14">
                            </path>
                        </svg>
                        <input type="file" id="logo_file" name="logo_file" class="hidden">
                    </label>
                </div>

                <!-- Profile Information Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="name" class="block text-gray-700 font-medium">Name</label>
                        <input type="text" id="name" name="name" value="{{ $restaurant->name }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="address" class="block text-gray-700 font-medium">Address</label>
                        <input type="text" id="address" name="address" value="{{ $restaurant->address }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 font-medium">Email</label>
                        <input type="email" id="email" name="email" value="{{ $restaurant->email }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>

                    <div>
                        <label for="phone" class="block text-gray-700 font-medium">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="{{ $restaurant->phoneNumber }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="bg-indigo-500 text-white px-6 py-3 rounded-md shadow-sm hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/seller/restaurant.js') }}"></script>
    @if (session()->has('text'))
        <script>
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('text') }}",
                icon: "{{ session('icon') }}"
            });
        </script>
    @endif
@endsection
