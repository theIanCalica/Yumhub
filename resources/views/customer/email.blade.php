<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Confirmation</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 py-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="flex">
            <img src="{{ asset('logo/logo.png') }}" class="h-20" alt="Yumhub Logo">
            <h1 class="text-2xl font-bold text-gray-800 mt-4 ml-4 ">Email Confirmation</h1>
        </div>
        <p class="mt-4 text-gray-600">Hello {{ $user->fname . ' ' . $user->lname }},</p>
        <p class="mt-2 text-gray-600">Thank you for signing up! Please confirm your email address by clicking the button
            below.</p>

        <div class="mt-6 text-center">
            <a href="{{ url('/user/verify/' . $user->verifyUser->token) }}" class="">
                <button
                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-200 via-red-300 to-yellow-200 group-hover:from-red-200 group-hover:via-red-300 group-hover:to-yellow-200 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400">
                    <span
                        class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        Confirm
                    </span>
                </button></a>
        </div>

        <p class="mt-6 text-gray-600">If you did not sign up for this account, you can ignore this email.</p>

        <p class="mt-6 text-gray-600">Best regards,</p>
        <p class="text-gray-600">Yumhub</p>
    </div>
</body>

</html>
