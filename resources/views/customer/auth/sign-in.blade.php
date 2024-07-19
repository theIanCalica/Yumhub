<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign in</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favlogo.png') }}">



    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.1/dist/jquery.validate.min.js"></script>
    <script src="{{ asset('js/customer/sign-in.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        label.error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }

        input.error {
            border-color: red;
        }

        label.success {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }

        input.success {
            border-color: green;
        }
    </style>
</head>

<body>
    @if (session('icon'))
        <script>
            Swal.fire({
                icon: '{{ session('icon') }}',
                title: '{{ session('message') }}',
            });
        </script>
    @endif
    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
        <a href="" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
            <img src="{{ asset('logo/logo.png') }}" class="mr-4 h-36" alt="Yumhub Logo">
        </a>
        <!-- Card -->
        <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-2xl text-center font-bold text-gray-900 dark:text-white">
                Sign in
            </h2>
            <form class="mt-8 space-y-6" action="#" id="sign-in-form">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        email</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="name@company.com" required>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        required>
                </div>
                <div class="flex items-start">
                    <button type="submit" id="loginBtn"
                        class="w-full px-5 py-3 text-base font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login
                        to your account</button>
                    <a href="#"
                        class="ml-auto text-sm text-primary-700 hover:underline dark:text-primary-500">Lost
                        Password?</a>
                </div>

                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Not registered? <a class="text-primary-700 hover:underline dark:text-primary-500"
                        href="{{ route('sign-up') }}">Create account</a>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    // Check if there's a success message from the previous page
    var successMessage = sessionStorage.getItem('successMessage');
    if (successMessage) {
        // Display success message using SweetAlert
        Swal.fire({
            title: "Success!",
            text: "You are now registered!",
            icon: "success"
        });
        // Clear the success message from sessionStorage
        sessionStorage.removeItem('successMessage');
    }
</script>

</html>
