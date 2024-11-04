<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - YumHub Laravel</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .receipt-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            background: linear-gradient(to right, #ffffff, #f9f9f9);
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-header img {
            max-width: 120px;
            margin-bottom: 15px;
        }

        .receipt-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            margin: 0;
        }

        .receipt-details,
        .receipt-footer {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .receipt-details h2,
        .receipt-footer h2 {
            font-size: 20px;
            font-weight: 600;
            color: #4a5568;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .receipt-details p,
        .receipt-footer p {
            margin: 8px 0;
            font-size: 14px;
            color: #4a5568;
        }

        .receipt-items {
            margin-bottom: 20px;
        }

        .receipt-items h2 {
            font-size: 20px;
            font-weight: 600;
            color: #4a5568;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .receipt-items table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .receipt-items thead {
            background-color: #f7fafc;
        }

        .receipt-items th,
        .receipt-items td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .receipt-items th {
            font-weight: 700;
            color: #2d3748;
        }

        .receipt-items td {
            color: #4a5568;
        }

        .receipt-footer p {
            font-size: 16px;
            font-weight: 700;
            color: #e53e3e;
            margin-top: 10px;
        }

        .receipt-footer a {
            color: #3182ce;
            text-decoration: none;
            font-weight: 600;
        }

        .receipt-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <img src="{{ public_path('icons/favlogo/fav.png') }}" alt="YumHub Logo">
            <h1>YumHub Laravel</h1>
        </div>

        <div class="receipt-details">
            <h2>Receipt Details</h2>
            <p><strong>Order Number:</strong> {{ $order->id }}</p>
            <p><strong>Date:</strong> {{ $order->order_date }}</p>
            <p><strong>Customer Name:</strong> {{ $user->fname . ' ' . $user->lname }}</p>
            <p><strong>Delivery Address:</strong> {{ $user->address }}</p>
        </div>

        <div class="receipt-items">
            <h2>Items Ordered</h2>
            <table>
                <thead>
                    <tr>
                        <th>Food</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItems as $item)
                        <tr>
                            <td>{{ $item->food->name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>${{ number_format($item->food->price, 2) }}</td>
                            <td>${{ number_format($item->food->price * $item->qty, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="receipt-footer">
            <h2>Total Amount</h2>
            <p>${{ number_format(
                $orderItems->sum(function ($item) {
                    return $item->food->price * $item->qty;
                }),
                2,
            ) }}
            </p>
            <p>Thank you for your purchase!</p>
            <p>For inquiries, please contact us at <a href="mailto:support@yumhub.com">support@yumhub.com</a></p>
        </div>
    </div>
</body>

</html>
