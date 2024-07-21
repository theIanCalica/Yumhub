<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Sign up</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favlogo.png') }}">


    {{-- Font for logo --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <style>
        .merriweather-bold {
            font-family: "Merriweather", serif;
            font-weight: 700;
            font-style: normal;
        }

        .roboto-regular {
            font-family: "Roboto", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

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

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .form-card {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .step-indicator div {
            width: 100px;
            padding: 10px;
            text-align: center;
            border-radius: 8px;
            background-color: #e0e0e0;
            color: #666;
        }

        .step-indicator .active {
            background-color: #ffc107;
            color: #fff;
        }
    </style>
</head>

<body class="roboto-regular dark:bg-gray-900">
    <div class="form-container">
        <div class="logo-container">
            <img src="{{ asset('logo/logo.png') }}" class="h-36" alt="Yumhub Logo">
        </div>
        <div class="form-card dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white text-center">Create an Account</h2>
            <h3 class="text-base text-gray-900 dark:text-white text-center">Be a seller</h3>
            <div class="step-indicator">
                <div id="step-1-indicator" class="active">Step 1</div>
                <div id="step-2-indicator">Step 2</div>
            </div>
            <form class="mt-8 space-y-6" action="#" id="sign-up-form" enctype="multipart/form-data">
                <!-- Step 1: Personal Details -->
                <div id="step-1" class="step">
                    <div class="mt-3">
                        <h1 class="font-black merriweather-bold text-2xl">Personal Details</h1>
                    </div>
                    <div class="mt-5">
                        <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            First Name</label>
                        <input type="text" name="fname" id="fname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-yellow-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type your first name" required>
                    </div>
                    <div class="mt-5">
                        <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            Last Name</label>
                        <input type="text" name="lname" id="lname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-yellow-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type your last name" required>
                    </div>
                    <div class="mt-5">
                        <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            Gender</label>
                        <select name="gender" id="gender"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-yellow-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" selected disabled>Select a Gender</option>
                            <option value="Men">Men</option>
                            <option value="Women">Women</option>
                        </select>
                    </div>
                    <div class="mt-5">
                        <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                            of
                            Birth</label>
                        <input type="date" name="dob" id="dob"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-yellow-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                    </div>
                    <div class="mt-5">
                        <label for="phoneNumber"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            Phone Number</label>
                        <input type="tel" name="phoneNumber" id="phoneNumber"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-yellow-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="09*********" required maxlength="11">
                    </div>
                    <div class="mt-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            email</label>
                        <input type="text" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-yellow-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="name@company.com" required>
                    </div>
                    <div class="mt-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Profile Picture</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            name="filePath" id="filePath" type="file">
                    </div>
                    <div class="mt-5">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-yellow-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                    </div>
                    <div class="mt-5">
                        <label for="confirmpassword"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                            password</label>
                        <input type="password" name="confirmpassword" id="confirmpassword" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-yellow-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                    </div>
                    <button type="button" id="next-step-1"
                        class="w-full px-5 mt-5 py-3 text-base font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Next
                    </button>
                </div>
            </form>
            <!-- Step 2: Restaurant Details -->
            <div id="step-2" class="step" style="display:none;">
                <form class="mt-8 space-y-6" action="#" id="restoForm">

                    <input type="hidden" name="owner_id" id="owner_id">
                    <div class="mt-3">
                        <h1 class="font-black merriweather-bold text-2xl">Restaurant Details</h1>
                    </div>
                    <div class="mt-5">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Restaurant
                            Name</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-yellow-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Enter your restaurant name" required>
                    </div>
                    <div class="mt-5">
                        <label for="address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Restaurant
                            Address</label>
                        <input type="text" name="address" id="address"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-yellow-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Enter your restaurant address" required>
                    </div>
                    <div class="mt-5">
                        <label for="phoneNumber"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Restaurant Phone
                            Number</label>
                        <input type="tel" name="phoneNumber" id="restoPhone"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-yellow-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="09*********" required>
                    </div>
                    <div class="mt-5">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Restaurant Phone
                            Number</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-yellow-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Enter your email" required>
                    </div>
                    <div class="mt-5">

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="logo">Upload Logo</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="logo" name="logo_filePath" type="file" accept=".png, .jpg, .jpeg">

                    </div>
                    <div class="mt-5">
                        <label for="desc"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description
                        </label>
                        <textarea name="desc" id="desc" cols="30" rows="5" required
                            placeholder="Describe your restaurant"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-400 focus:border-yellow-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
                    </div>
                    <div class="mt-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="opHours">Operating Hours</label>
                        <input
                            class="block w-full text-sm text-gray-900 border focus:ring-yellow-400 focus:border-yellow-400 border-gray-300 rounded-lg  bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="opHours" name="operatingHours" type="text" placeholder="8 AM to 4 PM">
                    </div>
                    <button type="button" id="prev-step-2"
                        class="w-full mt-5 px-5 py-3 text-base font-medium text-center text-white bg-gray-400 rounded-lg hover:bg-gray-500 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Previous
                    </button>
                    <button type="button" id="submitBtn"
                        class="w-full mt-5 px-5 py-3 text-base font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Submit
                    </button>
                </form>
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.1/dist/jquery.validate.min.js"></script>
    <script src="{{ asset('js/seller/sign-up.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#next-step-1').on('click', function() {

                if ($("#sign-up-form").valid()) {
                    $('#step-1').hide();
                    $('#step-2').show();
                    $('#step-1-indicator').removeClass('active').css({
                        'background-color': '#4CAF50',
                        'color': '#fff' // Change text color to white
                    });
                    $('#step-2-indicator').addClass('active');
                }

            });

            $('#prev-step-2').on('click', function() {
                $('#step-2').hide();
                $('#step-1').show();
                $('#step-2-indicator').removeClass('active');
                $('#step-1-indicator').addClass('active').css('background-color',
                    '#ffc107'); // Restore background color to original
            });

            $("#submitBtn").on("click", function() {

                if ($("#restoForm").valid()) {
                    $("#sign-up-form").submit();
                }

            });
        });
    </script>

</body>

</html>
