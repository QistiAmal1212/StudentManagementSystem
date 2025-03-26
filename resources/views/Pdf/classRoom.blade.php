<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>class_room Detail</title>

    <link rel="stylesheet" type="text/css" href="../resources/views/Pdf/pdfCss.css">
</head>

<body>
    <h4>class_room DETAILS</h4>
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
            @foreach ($class_room as $class_room)
                <tr>
                    <td>{{ $class_room->class_name }}</td>
                    <td>{{ $class_room->name }}</td>
                    <td>{{ $class_room->form }}</td>
                    <td>1000</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
