<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - YumHub Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .receipt-container {
            max-width: 800px;
            margin: 20px auto;
        }

        .receipt-header img {
            max-width: 150px;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="receipt-container bg-white p-6 rounded-lg shadow-lg">
        <div class="receipt-header text-center mb-6">
            <img src="{{ asset('icons/favlogo/fav.png') }}" alt="YumHub Logo" class="mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mt-2">YumHub Laravel</h1>
        </div>

        <div class="receipt-details mb-6">
            <h2 class="text-xl font-semibold text-gray-700 bg-gray-100 p-2 rounded-md">Receipt Details</h2>
            <p class="mt-2"><strong>Order Number:</strong> #123456</p>
            <p><strong>Date:</strong> July 26, 2024</p>
            <p><strong>Customer Name:</strong> John Doe</p>
            <p><strong>Delivery Address:</strong> 123 Elm Street, Springfield</p>
        </div>

        <div class="receipt-items mb-6">
            <h2 class="text-xl font-semibold text-gray-700 bg-gray-100 p-2 rounded-md">Items Ordered</h2>
            <table class="w-full mt-2 bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left border-b">Description</th>
                        <th class="p-2 text-left border-b">Quantity</th>
                        <th class="p-2 text-left border-b">Price</th>
                        <th class="p-2 text-left border-b">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2 border-b">Cheeseburger</td>
                        <td class="p-2 border-b">2</td>
                        <td class="p-2 border-b">$5.00</td>
                        <td class="p-2 border-b">$10.00</td>
                    </tr>
                    <tr>
                        <td class="p-2 border-b">Fries</td>
                        <td class="p-2 border-b">1</td>
                        <td class="p-2 border-b">$2.50</td>
                        <td class="p-2 border-b">$2.50</td>
                    </tr>
                    <tr>
                        <td class="p-2 border-b">Soft Drink</td>
                        <td class="p-2 border-b">3</td>
                        <td class="p-2 border-b">$1.50</td>
                        <td class="p-2 border-b">$4.50</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="receipt-footer text-right">
            <h2 class="text-xl font-semibold text-gray-700 bg-gray-100 p-2 rounded-md">Total Amount</h2>
            <p class="text-2xl font-bold text-red-600 mt-2">$17.00</p>
            <p class="mt-2">Thank you for your purchase!</p>
            <p>For inquiries, please contact us at <a href="mailto:support@yumhub.com"
                    class="text-blue-600">support@yumhub.com</a></p>
        </div>
    </div>
</body>

</html>
