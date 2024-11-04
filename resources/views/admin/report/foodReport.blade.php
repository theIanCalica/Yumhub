<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Food Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 2em;
            color: #343a40;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table,
        th,
        td {
            border: 1px solid #dee2e6;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #e9ecef;
            color: #495057;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9ecef;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Food Report</h1>
    </div>
    <table>
        <thead>
            <tr>
                <th>Food Name</th>
                <th>Price</th>
                <th>Cuisine</th>
                <th>Category</th>
                <th>Restaurant</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($foods as $food)
                <tr>
                    <td>{{ $food->name }}</td>
                    <td>PHP {{ number_format($food->price, 2) }}</td>

                    <td>{{ $food->cuisine->name }}</td>
                    <td>{{ $food->category->name }}</td>
                    <td>{{ $food->restaurant->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
