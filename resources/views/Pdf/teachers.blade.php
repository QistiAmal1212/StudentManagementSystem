<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Detail</title>

    <link rel="stylesheet" type="text/css" href="../resources/views/Pdf/pdfCss.css">
</head>

<body>
    <h4>TEACHER DETAILS</h4>
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
            @foreach ($teachers as $teacher)
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
