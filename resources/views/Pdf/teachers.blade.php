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
                    <td>{{ $teacher->teacher_id }}</td>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->ic_number }}</td>
                    <td>{{ $teacher->no_tell }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td class="{{ $teacher->is_class_teacher == 1 ? 'class-teacher-yes' : 'class-teacher-no' }}">
                        {{ $teacher->is_class_teacher == 1 ? 'Yes' : 'No' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
