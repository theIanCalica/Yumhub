@extends('seller.layout.app')

@section('title', 'Profile')

@section('content')
    <div class="flex justify-center mt-10 mb-20 pb-20">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-4xl">
            <form action="/update-profile" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                <!-- Profile Picture -->
                <div class="flex flex-col items-center mb-8">
                    <img src="{{ $user->filePath }}" alt="Profile Picture"
                        class="w-40 h-40 rounded-full border-4 border-indigo-500 mb-4 object-cover">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="fname" class="block text-gray-700 font-medium">First Name</label>
                        <input type="text" id="fname" name="fname" value="{{ $user->fname }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="lname" class="block text-gray-700 font-medium">Last Name</label>
                        <input type="text" id="lname" name="lname" value="{{ $user->lname }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="gender" class="block text-gray-700 font-medium">Gender</label>
                        <select name="gender" id="gender" required
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="" disabled>Select a Gender</option>
                            <option value="Men" {{ $user->gender == 'Men' ? 'selected' : '' }}>Men</option>
                            <option value="Women" {{ $user->gender == 'Women' ? 'selected' : '' }}>Women</option>
                        </select>
                    </div>
                    <div>
                        <label for="dob" class="block text-gray-700 font-medium">Date of Birth</label>
                        <input type="date" id="dob" name="dob" value="{{ $user->dob }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 font-medium">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="phone" class="block text-gray-700 font-medium">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="{{ $user->phoneNumber }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="bg-indigo-500 text-white px-6 py-3 rounded-md shadow-sm hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Save Changes
                    </button>
                    <a href="{{ route('changePass.seller') }}">
                        <button type="button"
                            class="bg-transparent text-indigo-700 ml-5 hover:text-white border border-indigo-700 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 px-6 py-3 rounded-md shadow-sm">
                            Change Password
                        </button>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
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
