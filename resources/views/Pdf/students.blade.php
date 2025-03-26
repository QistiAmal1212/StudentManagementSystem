<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Detail</title>


    <link rel="stylesheet" type="text/css" href="../resources/views/Pdf/pdfCss.css">
</head>

<body>
    <h4>STUDENT DETAILS</h4>
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
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->student_id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->ic_number }}</td>
                    <td>{{ $student->no_tell }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->family_income }}</td>
                    <td>{{ $student->total_family_member }}</td>
                    <td>{{ $student->class_room_id }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
