<!DOCTYPE html>
<html>

<head>
    <title>Stockholders Report</title>
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

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
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
            word-wrap: break-word;
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

        /* Set specific widths for columns */
        th:nth-child(1),
        td:nth-child(1) {
            width: 15%;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 10%;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 15%;
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 20%;
        }

        th:nth-child(5),
        td:nth-child(5) {
            width: 15%;
        }

        th:nth-child(6),
        td:nth-child(6) {
            width: 20%;
        }

        th:nth-child(7),
        td:nth-child(7) {
            width: 10%;
        }

        th:nth-child(8),
        td:nth-child(8) {
            width: 15%;
        }

        th:nth-child(9),
        td:nth-child(9) {
            width: 15%;
        }

        /* Additional styles for separation */
        th,
        td {
            border-right: 2px solid #dee2e6;
        }

        th:last-child,
        td:last-child {
            border-right: none;
            /* Remove border from the last column */
        }

        tr:last-child td {
            border-bottom: none;
            /* Remove bottom border from the last row */
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Stockholders Report</h1>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Shares Owned</th>
                    <th>Investment Date</th>
                    <th>Preferred Contact</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stockholders as $stockholder)
                    <tr>
                        <td>{{ $stockholder->name }}</td>
                        <td>{{ $stockholder->email }}</td>
                        <td>{{ $stockholder->phoneNumber }}</td>
                        <td>{{ $stockholder->sharesOwned }}</td>
                        <td>{{ \Carbon\Carbon::parse($stockholder->investmentDate)->format('F d, Y') }}</td>
                        <td>{{ $stockholder->prefferedContact }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
