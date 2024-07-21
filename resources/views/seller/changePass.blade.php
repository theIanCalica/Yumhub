@extends('seller.layout.app')

@section('title', 'Profile')

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

        textarea.error {
            border-color: red;
        }

        textarea.success {
            border-color: green;
        }

        input.error {
            border-color: red;
        }

        input.success {
            border-color: green;
        }

        select.error {
            border-color: red;
        }

        select.success {
            border-color: green;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
    <div class="flex justify-center mt-20 mb-20 pb-20">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-4xl">
            <form method="POST" id="changePassForm" action="{{ route('seller.update.password') }}">
                @csrf
                @method('post')

                {{-- User id --}}
                <input type="hidden" name="user_id" value="{{ $user->id }}" id="user_id">
                <!-- Old Password -->
                <div class="mb-4">
                    <label for="old_password" class="block text-gray-700 font-semibold mb-2">Old Password</label>
                    <input type="password" name="old_password" id="old_password" required=""
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- New Password -->
                <div class="mb-4">
                    <label for="new_password" class="block text-gray-700 font-semibold mb-2">New Password</label>
                    <input type="password" name="new_password" id="new_password" required=""
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="confirm_password" class="block text-gray-700 font-semibold mb-2">Confirm New
                        Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" required=""
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
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
    <script src="{{ asset('js/seller/changePass.js') }}"></script>
@endsection
