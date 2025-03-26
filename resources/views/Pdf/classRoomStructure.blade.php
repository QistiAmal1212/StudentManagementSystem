<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom Detail{{ $id }}</title>

    <link rel="stylesheet" type="text/css" href="../resources/views/Pdf/pdfCss.css">
</head>

<body>
    <h4>Classroom STRUCTURE</h4>
    <table i style="width:100%;">
        ' <thead>
            <tr>
                <th colspan="2" style="font-weight:normal !important;"> Class Name :
                    {{ $ClassroomDetail[0]->class_name }}</th>
                <th colspan="3" style="font-weight:normal !important;">Class Teacher
                    :{{ $ClassroomDetail[0]->teacher_name }} </th>
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
            @foreach ($ClassroomDetail as $ClassroomDetail)
                <tr>
                    <td> {{ $ClassroomDetail->name }} </td>
                    <td> {{ $ClassroomDetail->ic_number }} </td>
                    <td> {{ $ClassroomDetail->no_tell }} </td>
                    <td> {{ $ClassroomDetail->email }} </td>
                    <td> {{ $ClassroomDetail->family_income }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
