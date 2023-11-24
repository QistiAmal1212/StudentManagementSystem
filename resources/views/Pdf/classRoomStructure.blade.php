<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom Detail{{ $id }}</title>

    <link rel="stylesheet" type="text/css" href="../resources/views/Pdf/pdfCss.css">
</head>
<body>
    <h4>CLASSROOM STRUCTURE</h4>
    <table i style="width:100%;">
        ' <thead>
            <tr>
                <th colspan="2" style="font-weight:normal !important;"> Class Name : {{ $classRoomDetail[0]->className }}</th>
                <th colspan="3" style="font-weight:normal !important;">Class Teacher :{{ $classRoomDetail[0]->teacher_name }} </th>
            </tr>
            <tr>
                <th>student name</th>
                <th>Ic number</th>
                <th>No Tell</th>
                <th>Email</th>
                <th>Family Income</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classRoomDetail as $classRoomDetail)

            <tr>
                <td> {{ $classRoomDetail->name }} </td>
                <td> {{ $classRoomDetail->icNumber }} </td>
                <td> {{ $classRoomDetail->noTell }} </td>
                <td> {{ $classRoomDetail->email }} </td>
                <td> {{ $classRoomDetail->familyIncome }} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
