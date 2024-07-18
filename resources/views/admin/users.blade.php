@extends('admin.layout.app')

@section('title', 'Users')

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

@section('scripts')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="{{ asset('js/users.js') }}"></script>
@endsection

@section('content')
    {{-- Add Modal --}}
    <div id="add-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-7xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        Add User
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="extralarge-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="userAddForm">
                    <div class="grid gap-4 mb-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        <!-- Personal Information -->
                        <div class="col-span-2 md:col-span-3 lg:col-span-4">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white">Personal Information</h4>
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                                Name</label>
                            <input type="text" name="fname" id="fname"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter First Name" required="">
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                                Name</label>
                            <input type="text" name="lname" id="lname"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter Last Name" required="">
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="gender"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender
                            </label>
                            <select name="gender" id="gender"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" disabled selected>Select a gender</option>
                                <option value="Men">Men</option>
                                <option value="Women">Women</option>
                            </select>
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Address
                            </label>
                            <input type="text" name="address" id="address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="">
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                                of Birth
                            </label>
                            <input type="date" name="dob" id="dob"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="">
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="phoneNumber"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                                Number
                            </label>
                            <input type="tel" name="phoneNumber" id="phoneNumber"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter Phone Number" required="" maxlength="11">
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                            </label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter Email" required="">
                        </div>


                        <!-- Account Details -->
                        <div class="col-span-2 md:col-span-3 lg:col-span-4 mt-4">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white">Account Details</h4>
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Password
                            </label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter Password" required="">
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="confirmPassword"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Password
                            </label>
                            <input type="password" name="confirmPassword" id="confirmPassword"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Confirm Password" required="">
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="zipCode"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role
                            </label>
                            <select name="role" id="role"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" selected disabled>Select a Role</option>
                                <option value="Customer">Customer</option>
                                <option value="Vendor">Vendor</option>
                                <option value="Admin">Admin</option>
                            </select>

                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="is_Disabled"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                            </label>
                            <select name="is_Disabled" id="is_Disabled"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" selected disabled>Select a Status</option>
                                <option value="1">Active</option>
                                <option value="0">Disabled</option>
                            </select>

                        </div>
                    </div>
                    <button type="submit" id="regionAdd"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-full font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add New User
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="edit-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-7xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        Add User
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="extralarge-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="userAddForm">
                    <div class="grid gap-4 mb-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        <!-- Personal Information -->
                        <div class="col-span-2 md:col-span-3 lg:col-span-4">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white">Personal Information</h4>
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="fname"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                                Name</label>
                            <input type="text" name="fname" id="fname"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter First Name" required="">
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="lname"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                                Name</label>
                            <input type="text" name="lname" id="lname"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter Last Name" required="">
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="gender"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender
                            </label>
                            <select name="gender" id="gender"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" disabled selected>Select a gender</option>
                                <option value="Men">Men</option>
                                <option value="Women">Women</option>
                            </select>
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Address
                            </label>
                            <input type="text" name="address" id="address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="">
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="dob"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                                of Birth
                            </label>
                            <input type="date" name="dob" id="dob"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="">
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="phoneNumber"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                                Number
                            </label>
                            <input type="tel" name="phoneNumber" id="phoneNumber"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter Phone Number" required="" maxlength="11">
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                            </label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter Email" required="">
                        </div>


                        <!-- Account Details -->
                        <div class="col-span-2 md:col-span-3 lg:col-span-4 mt-4">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white">Account Details</h4>
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Password
                            </label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter Password" required="">
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="confirmPassword"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Password
                            </label>
                            <input type="password" name="confirmPassword" id="confirmPassword"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Confirm Password" required="">
                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="zipCode"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role
                            </label>
                            <select name="role" id="role"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" selected disabled>Select a Role</option>
                                <option value="Customer">Customer</option>
                                <option value="Vendor">Vendor</option>
                                <option value="Admin">Admin</option>
                            </select>

                        </div>
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <label for="is_Disabled"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                            </label>
                            <select name="is_Disabled" id="is_Disabled"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" selected disabled>Select a Status</option>
                                <option value="1">Active</option>
                                <option value="0">Disabled</option>
                            </select>

                        </div>
                    </div>
                    <button type="submit" id="regionAdd"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-full font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add New User
                    </button>
                </form>
            </div>
        </div>
    </div>


    <div class="px-4 pt-6">
        <div
            class="p-10 w-full bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">

            <div>
                <h1 class="text-2xl mb-2">Users</h1>
                <button id="btnAdd"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" data-modal-target="add-modal" data-modal-toggle="add-modal">
                    Add User
                </button>
                <div class="overflow-x-auto">
                    <table class="w-dvw text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                        id="usersTable">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    First Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Last Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Gender
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Date of Birth
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Phone Number
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Account Status
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    First Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Last Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Gender
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Date of Birth
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Phone Number
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Account Status
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>

        </div>
    </div>


@endsection
