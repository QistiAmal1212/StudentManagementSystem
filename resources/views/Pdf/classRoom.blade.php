<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom Detail</title>

    <!-- Add some basic styling for better appearance -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            /* Set to 100% initially */
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            font-size: 8px;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .class-teacher-yes {
            color: #28a745;
        }

        .class-teacher-no {
            color: #dc3545;
        }

    </style>
</head>
<body>
    <h1>CLASSROOM DETAILS</h1>
    <table style="width: 100%;">
        <thead>
            <tr>

                <th>Class Name</th>
                <th>Class Teacher</th>
                <th>Form</th>
                <th>Total student</th>

            </tr>
        </thead>
        <tbody>
            @foreach($classRoom as $classRoom)
            <tr>
                <td>{{ $classRoom->className }}</td>
                <td>{{ $classRoom->name }}</td>
                <td>{{ $classRoom->form }}</td>
                <td>1000</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
