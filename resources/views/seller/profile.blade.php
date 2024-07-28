@extends('seller.layout.app')

@section('title', 'My Profile')

@php
    $user = Auth::user();
@endphp

@section('styles')
    <style>
        label.error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }

        input.error {
            border-color: red;
        }

        input.success {
            border-color: green;
        }

        select.success {
            border-color: green;
        }

        select.error {
            border-color: red;
        }
    </style>
@endsection

@section('content')
    <div class="flex justify-center mt-10 mb-20 pb-20">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-4xl">
            <form method="POST" enctype="multipart/form-data" id="profileForm">
                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">

                <!-- Profile Picture -->
                <div class="flex flex-col items-center mb-8 relative">
                    <img id="profileImage" src="{{ $user->filePath }}" alt="Profile Picture"
                        class="w-40 h-40 rounded-full border-4 border-red-500 mb-4 object-cover">

                    <!-- Upload Button with Icon -->
                    <label for="profilePicture"
                        class="absolute bottom-10 right-1/2 flex items-center justify-center w-10 h-10 bg-red-500 rounded-full shadow-md cursor-pointer transform translate-x-1/2 translate-y-1/2">
                        <i class="fi fi-rr-camera text-white text-xl"></i>
                        <input type="file" id="profilePicture" name="profilePicture" class="hidden" accept="image/*">
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="fname" class="block text-gray-700 font-medium">First Name</label>
                        <input type="text" id="fname" name="fname" value="{{ $user->fname }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="lname" class="block text-gray-700 font-medium">Last Name</label>
                        <input type="text" id="lname" name="lname" value="{{ $user->lname }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="gender" class="block text-gray-700 font-medium">Gender</label>
                        <select name="gender" id="gender" required
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                            <option value="" disabled>Select a Gender</option>
                            <option value="Men" {{ $user->gender == 'Men' ? 'selected' : '' }}>Men</option>
                            <option value="Women" {{ $user->gender == 'Women' ? 'selected' : '' }}>Women</option>
                        </select>
                    </div>
                    <div>
                        <label for="dob" class="block text-gray-700 font-medium">Date of Birth</label>
                        <input type="date" id="dob" name="dob" value="{{ $user->dob }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 font-medium">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}"
                            data-id="{{ $user->id }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="phone" class="block text-gray-700 font-medium">Phone Number</label>
                        <input type="text" id="phoneNumber" name="phoneNumber" maxlength="11"
                            data-id="{{ $user->id }}" value="{{ $user->phoneNumber }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="bg-red-500 text-white px-6 py-3 rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Save Changes
                    </button>
                    <a href="{{ route('changePass.seller') }}">
                        <button type="button"
                            class="bg-transparent text-red-700 ml-5 hover:text-white border border-red-700 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 px-6 py-3 rounded-md shadow-sm">
                            Change Password
                        </button>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/seller/profile.js') }}"></script>
    @if (session()->has('text'))
        <script>
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('text') }}",
                icon: "{{ session('icon') }}"
            });
        </script>
    @endif
    <script>
        function previewImage(event) {
            const input = event.target;
            const img = document.getElementById('profileImage');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
