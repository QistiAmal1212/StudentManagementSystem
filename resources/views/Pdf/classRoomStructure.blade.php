<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>class_room Detail{{ $id }}</title>

    <link rel="stylesheet" type="text/css" href="../resources/views/Pdf/pdfCss.css">
</head>

<body>
    <h4>class_room STRUCTURE</h4>
    <table i style="width:100%;">
        ' <thead>
            <tr>
                <th colspan="2" style="font-weight:normal !important;"> Class Name :
                    {{ $class_roomDetail[0]->class_name }}</th>
                <th colspan="3" style="font-weight:normal !important;">Class Teacher
                    :{{ $class_roomDetail[0]->teacher_name }} </th>
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
            @foreach ($class_roomDetail as $class_roomDetail)
                <tr>
                    <td> {{ $class_roomDetail->name }} </td>
                    <td> {{ $class_roomDetail->ic_number }} </td>
                    <td> {{ $class_roomDetail->no_tell }} </td>
                    <td> {{ $class_roomDetail->email }} </td>
                    <td> {{ $class_roomDetail->family_income }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
