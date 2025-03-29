@extends('layouts.main')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
        <link rel="stylesheet"
            href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">
</head>

<body>
    <form id="reportform" class="report" method="post" action="{{ route('examReport') }}">
        @csrf
        <div class="row" style="position:relative; top:-35px;">
            <div class="col-12">
                <div class="card" style="padding:10px; background-color:white;">

                    <select id="examSelect" name="exam_id" class="form-select" aria-label="Default select example">
                        <option value="0">Please choose exam</option>
                        @foreach ($exam as $exam)
                        <option value="{{ $exam->exam_id }}">{{ $exam->title }}</option> @endforeach

                    </select>
                </div>
            </div>
        </div>
    </form>

    <div class="row"
            style="position:relative; top:-35px;">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div id="chart"></div>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div id="chart2"></div>
                </div>
            </div>
        </div>
        </div>



        <div class="row" style="position:relative; top:-40px;">
            <div class="col-12">

                <div class="card">
                    <div class="card-header" style="background-color:white;">
                        <div>

                            {{-- <a id="routeLink1" href="{{ route('exportExcelClassStructure', ['classId' => ":classId"]) }}">
                        <x-excelbtn />
                        </a>
                        <a id="routeLink2" href="{{ route('exportPdfClassStructure', ['id' => ":classId"]) }}">
                            <x-pdfbtn />
                        </a> --}}

                        </div>
                    </div>

                    <div class="card-body" style="padding-right:15px;padding-left:15px;">

                        <table id="example" class="table table-striped table-bordered"
                            style="width:100%; font-size:15px !important;">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Name</th>
                                    <th>Ic Number</th>
                                    <th>class</th>
                                    <th>average</th>
                                    <th>BM</th>
                                    <th>BI</th>
                                    <th>math</th>
                                    <th>science</th>
                                    <th>sejarah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($student_result as $student_result)
                                    <tr>

                                        <td>{{ $i }}</td>
                                        <td>{{ $student_result->name }}</td>
                                        <td>{{ $student_result->ic_number }}</td>
                                        <td>{{ $student_result->class_name }}</td>
                                        <td>{{ $student_result->average }}%</td>
                                        <td>{{ $student_result->bahasa_melayu }}%</td>
                                        <td>{{ $student_result->english }}%</td>
                                        <td>{{ $student_result->math }}%</td>
                                        <td>{{ $student_result->science }}%</td>
                                        <td>{{ $student_result->sejarah }}%</td>

                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>

        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script>
            var reportResult1 = @json($reportResult1);
            var reportResult2 = @json($reportResult2);
        </script>
        <script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="node_modules/apexcharts/dist/apexcharts.min.js"></script>
        <script src="js/examReport.js"></script>


        </body>

    </html>
@endsection
