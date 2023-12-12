@extends('layouts.main')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">

</head>

<body>

    <div class="row">
        <div class="col-12">
            <div class="card" style="padding:20px; background-color:white;">
                <label for="class">Choose Class:</label>
                <select id="class" name="classId" class="form-select" aria-label="Default select example">
                    <option value="0">-----</option>
                    @foreach($classRoom as $classRoom)
                    <option value="{{ $classRoom->classroomId }}">{{ $classRoom->className }}</option>
                    @endforeach

                </select>
            </div>
        </div>
    </div>





    <div class="row">
        <div class="col-12">
            <div class="card" id="cardT" style="display:none;">
                <div class="card-header" style="background-color:white;">
                    <div>
                        <a id="routeLink1" href="{{ route('exportExcelClassStructure', ['classId' => ":classId"]) }}">
                            <x-excelbtn />
                        </a>
                        <a id="routeLink2" href="{{ route('exportPdfClassStructure', ['id' => ":classId"]) }}">
                            <x-pdfbtn />
                        </a>
                    </div>
                </div>
                <div id="cardtable" class="card-body" style="padding-right:15px;padding-left:15px;padding-top:10px;">
                    <div class="d-flex justify-content-between mb-3">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script>
        var exportPdfLink2 = '{{ route("exportPdfClassStructure", ["id" => ":classId"]) }}';

        var exportPdfLink1 = '{{ route("exportExcelClassStructure", ["id" => ":classId"]) }}';

    </script>
    <script src="js/class-structure.js"></script>
</body>
</html>
@endsection
