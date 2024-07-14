@extends('customer.layout.app')

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
    </style>
@endsection

@section('content')
    <div class="container mb-12" style="margin-top: 200px">
        <h1 class="font-medium text-2xl text-center">Contact Us</h1>
        <h1 class="font-black text-5xl merriweather-bold text-center mt-4">Let's Talk</h1>
        <p class="text-center mt-3">Drop us a line through the form below and we'll get back to you</p>
        <div class="flex justify-center mt-10">
            <form id="submitForm">
                <div class="grid grid-cols-2 gap-10 px-10 w-full">
                    <div>
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-red-500 block w-full px-4 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                            placeholder="Enter your first name" required>
                    </div>
                    <div>
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-500 focus:border-red-500 block w-full px-4 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                            placeholder="Enter your last name" required>
                    </div>

                </div>
                <div class="px-10 mt-5 ">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-red-500 block w-full px-4 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                        placeholder="Enter your email" required="">
                </div>
                <div class="px-10 mt-5 ">
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" id="subject"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-red-500 block w-full px-4 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                        placeholder="Enter the subject" required="">
                </div>
                <div class="px-10 mt-5 ">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Enter your message"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-red-500 block w-full px-4 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"></textarea>

                </div>
                <div class="px-10 mt-5">
                    <button type="submit"
                        class="text-yellow-400 w-full hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-900">Submit</button>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/customer/contact.js') }}"></script>
@endsection
