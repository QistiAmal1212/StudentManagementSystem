<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Detail</title>

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
    <h1>TEACHER DETAILS</h1>
    <table style="width: 100%;">
        <!-- Set the desired width here -->
        <thead>
            <tr>
                <th>Teacher Id</th>
                <th>Teacher Name</th>
                <th>Ic Number</th>
                <th>No Tell</th>
                <th>Email</th>
                <th>Class Teacher</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teachers as $teacher)
            <tr>
                <td>{{ $teacher->teacherId }}</td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->icNumber }}</td>
                <td>{{ $teacher->noTell }}</td>
                <td>{{ $teacher->email }}</td>
                <td class="{{ $teacher->isClassTeacher == 1 ? 'class-teacher-yes' : 'class-teacher-no' }}">
                    {{ $teacher->isClassTeacher == 1 ? 'Yes' : 'No' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
