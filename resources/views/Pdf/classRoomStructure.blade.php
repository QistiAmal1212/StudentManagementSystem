<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>classroom Detail{{ $id }}</title>

    <link rel="stylesheet" type="text/css" href="../resources/views/Pdf/pdfCss.css">
</head>

<body>
    <h4>classroom STRUCTURE</h4>
    <table i style="width:100%;">
        ' <thead>
            <tr>
                <th colspan="2" style="font-weight:normal !important;"> Class Name :
                    {{ $classroomDetail[0]->class_name }}</th>
                <th colspan="3" style="font-weight:normal !important;">Class Teacher
                    :{{ $classroomDetail[0]->teacher_name }} </th>
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
            @foreach ($classroomDetail as $classroomDetail)
                <tr>
                    <td> {{ $classroomDetail->name }} </td>
                    <td> {{ $classroomDetail->ic_number }} </td>
                    <td> {{ $classroomDetail->no_tell }} </td>
                    <td> {{ $classroomDetail->email }} </td>
                    <td> {{ $classroomDetail->family_income }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
