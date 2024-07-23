@extends('seller.layout.app')

@section('title', 'Restaurant Profile')

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
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
    <div class="flex justify-center mt-10 mb-20 pb-20">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-4xl">
            <form method="POST" enctype="multipart/form-data" id="profileForm">
                <input type="hidden" name="restaurant_id" id="restaurant_id" value="{{ $restaurant->id }}">

                <!-- Banner Image -->
                <div class="relative mb-24">
                    <img src="{{ $restaurant->banner }}" alt="Banner Image" id="bannerImage"
                        class="w-full h-72 object-cover rounded-t-lg border-4 border-indigo-500 mb-4">
                    <label for="banner_file"
                        class="absolute top-2 right-2 bg-white rounded-full shadow-md cursor-pointer flex items-center justify-center w-10 h-10 group hover:bg-indigo-500">
                        <i class="fi fi-rr-camera text-indigo-500 group-hover:text-white"></i>
                        <input type="file" id="banner_file" name="banner_file" class="hidden">
                    </label>
                </div>

                <!-- Profile Picture -->
                <div class="flex justify-center  relative -top-20">
                    <img src="{{ $restaurant->logo_filePath }}" alt="Profile Picture" id="profileImage"
                        class="w-40 h-40 rounded-full border-4 border-indigo-500 object-cover">
                    <label for="logo_file"
                        class="absolute top-3/4 left-1/2 transform -translate-x-1/2 bg-white p-2 rounded-full shadow-md cursor-pointer flex items-center justify-center w-12 h-12">
                        <i class="fi fi-rr-camera text-indigo-500"></i>
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
                        <input type="text" id="phoneNumber" name="phoneNumber" value="{{ $restaurant->phoneNumber }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="md:col-span-2 flex justify-center">
                        <div class="w-full md:w-1/2">
                            <label for="operatingHours" class="block text-gray-700 font-medium">Operating Hours</label>
                            <input type="text" id="operatingHours" name="operatingHours"
                                value="{{ $restaurant->operatingHours }}"
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
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
    <script>
        $(document).ready(function() {
            $('#banner_file').on('change', function(event) {
                var file = event.target.files[0];
                if (file) {
                    var fileType = file.type;
                    var validTypes = ['image/jpeg', 'image/jpg', 'image/png'];

                    if (validTypes.includes(fileType)) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#bannerImage').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(file);
                    } else {
                        Swal.fire({
                            title: 'Invalid file type',
                            text: 'Please select a JPEG, JPG, or PNG image.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });

                        $(this).val('');
                    }
                }
            });

            $('#logo_file').on('change', function(event) {
                var file = event.target.files[0];
                if (file) {
                    var fileType = file.type;
                    var validTypes = ['image/jpeg', 'image/jpg', 'image/png'];

                    if (validTypes.includes(fileType)) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#profileImage').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(file);
                    } else {
                        Swal.fire({
                            title: 'Invalid file type',
                            text: 'Please select a JPEG, JPG, or PNG image.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });

                        // Clear the file input
                        $('#logo_file').val('');
                    }
                }
            });
        });
    </script>

@endsection
