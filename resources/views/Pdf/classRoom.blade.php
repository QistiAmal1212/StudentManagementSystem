<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom Detail</title>

    <link rel="stylesheet" type="text/css" href="../resources/views/Pdf/pdfCss.css">
</head>
<body>
    <h4>CLASSROOM DETAILS</h4>
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
