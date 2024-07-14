@extends('customer.layout.app')

@section('content')
    <div class="container" style="margin-top: 200px">
        <h1 class="font-medium text-2xl text-center">Contact Us</h1>
        <h1 class="font-black text-5xl merriweather-bold text-center mt-4">Let's Talk</h1>
        <p class="text-center mt-3">Drop us a line through the form below and we'll get back to you</p>
        <div class="flex justify-center mt-10">
            <form action="">
                <div class="grid grid-cols-2 gap-10 px-10 w-full">
                    <input type="text" name="fname" id="fname1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-red-500 block w-full px-4 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                        placeholder="Type your first name" required>
                    <input type="text" name="lname" id="lname"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-500 focus:border-red-500 block w-full px-4 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                        placeholder="Type your last name" required>
                </div>
            </form>
        </div>
    </div>
@endsection
