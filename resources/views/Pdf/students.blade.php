<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Detail</title>

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
    <h1>STUDENT DETAILS</h1>
    <table style="width: 100%;">
        <!-- Set the desired width here -->
        <thead>
            <tr>
                <th>Student Id</th>
                <th>Student Name</th>
                <th>Ic Number</th>
                <th>No Tell</th>
                <th>Email</th>
                <th>Family Income</th>
                <th>Total Family Member</th>
                <th>Class</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->studentId }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->icNumber }}</td>
                <td>{{ $student->noTell }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->familyIncome }}</td>
                <td>{{ $student->totalFamilyMember }}</td>
                <td>{{ $student->classroomId }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
