@extends('layouts.main')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">

</head>

<body>
    <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
    <div class="row">
        <div class="col-xl-6 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">ClassRoom</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="home"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    <x-text-counting>{{ $totalClassRoom }}</x-text-counting>
                                </h1>
                                <div class="mb-0">
                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> Last update </span>
                                    {{-- <span class="text-muted">{{ $latestDate1->updated_at->format('d-m-Y')  }}</span> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">ClassRoom Teacher</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="briefcase"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    <x-text-counting>{{ $totalTeachers }}</x-text-counting>
                                </h1>
                                <div class="mb-0">
                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> Last update </span>
                                    {{-- <span class="text-muted">{{ $latestDate2->updated_at->format('d-m-Y')  }}</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Students</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="users"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    <x-text-counting>{{ $totalStudents }}</x-text-counting>
                                </h1>
                                <div class="mb-0">
                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> Last update </span>
                                    {{-- <span class="text-muted">{{ $latestDate3->updated_at->format('d-m-Y')  }}</span> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">PoorStudent</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="user-minus"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    <x-text-counting>{{ $totalPoorStudents }}</x-text-counting>
                                </h1>
                                <div class="mb-0">
                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> Last update </span>
                                    /
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-xxl-7">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Total Student</h5>
                </div>
                <div class="card-body py-3">
                    <div class="chart chart-sm">
                        <div id="chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <h5 class="card-title mb-0">Classroom</h5>
                </div>
                <div class="card-body" style="padding-right:15px;padding-left:15px;padding-top:10px;">
                    <table id="example" class="table table-bordered" style="width:100% ">
                        <thead>
                            <tr>
                                {{-- <th>Class Uuid</th> --}}
                                <th>Class Name</th>
                                <th>Class Teacher</th>
                                <th>Form</th>
                                <th>Total student</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $j=1;
                            @endphp
                            @foreach($classRoom as $classRoom)

                            <tr>
                                {{-- <td>{{ $classRoom->classroomId }}</td> --}}
                                <td>{{ $classRoom->className }}</td>
                                <td>{{ $classRoom->name }}</td>
                                <td>{{ $classRoom->form }}</td>
                                <td>{{ $totalstudent[$j] }}</td>

                            </tr>
                            @php
                            $j++;
                            @endphp
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>



    <!-- jQuery -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- ApexCharts -->
    <script src="node_modules/apexcharts/dist/apexcharts.min.js"></script>

    <script>
        var totalStudentForEachForm = @json($totalStudentForEachForm);
        var totalPoorStudentForEachForm = @json($totalPoorStudentForEachForm);
        var options = {
            series: [{

                    name: 'Total student'
                    , data: totalStudentForEachForm
                }
                , {
                    name: 'poor student'
                    , data: totalPoorStudentForEachForm
                }
            ]
            , chart: {
                type: 'bar'
                , height: 250
            }
            , plotOptions: {
                bar: {
                    horizontal: false
                    , columnWidth: '55%'
                    , endingShape: 'rounded'
                }
            , }
            , dataLabels: {
                enabled: false
            }
            , stroke: {
                show: true
                , width: 2
                , colors: ['transparent']
            }
            , xaxis: {
                categories: ['Form1', 'Form2', 'Form3', 'Form4', 'Form5', 'Form6']
            , }
            , yaxis: {
                title: {
                    text: 'Total student'
                }
            }
            , fill: {
                opacity: 1
                , colors: ['#1f78b4', '#a6cee3']
            }
            , tooltip: {
                y: {
                    formatter: function(val) {
                        return val
                    }
                }
            }
            , legend: {
                markers: {
                    fillColors: ['#1f78b4', '#a6cee3'] // Set your legend marker colors here
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

    </script>


    <script>
        $(document).ready(function() {
            $('#example').DataTable({


            });



        });

    </script>

    {{-- <script>
        $(document).ready(function() {
            var txtElement = $(".txt").text();
            var endValue = parseInt(txtElement, 10); // Parse as an integer
            let startValue = 0;
            var duration = 10000;
            var step = (endValue - startValue) / (duration / 10); // Calculate step

            function updateCount(timestamp) {
                if (startValue < endValue) {
                    startValue += step * (timestamp - lastTimestamp);
                    if (startValue > endValue) {
                        startValue = endValue;
                    }
                    $(".txt").text(Math.round(startValue)); // Update the displayed value
                    lastTimestamp = timestamp;
                    requestAnimationFrame(updateCount);
                }
            }

            var lastTimestamp = performance.now();
            requestAnimationFrame(updateCount);
        });

    </script> --}}


</body>

</html>
@endsection
