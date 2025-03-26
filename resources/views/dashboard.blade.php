@extends('layouts.main')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

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
                                            <h5 class="card-title">classroom</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="home"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">
                                        <x-text-counting>{{ $totalclassroom }}</x-text-counting>
                                    </h1>
                                    <div class="mb-0">
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> Last update
                                        </span>
                                        @if ($latestDate1)
                                            <span class="text-muted">{{ $latestDate1->updated_at->format('d-m-Y') }}</span>
                                        @else
                                            ---
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">classroom Teacher</h5>
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

                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> Last update
                                        </span>
                                        @if ($latestDate2)
                                            <span class="text-muted">{{ $latestDate2->updated_at->format('d-m-Y') }}</span>
                                        @else
                                            ---
                                        @endif
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
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> Last update
                                        </span>
                                        @if ($latestDate3)
                                            <span class="text-muted">{{ $latestDate3->updated_at->format('d-m-Y') }}</span>
                                        @else
                                            ---
                                        @endif
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
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> Last update
                                        </span>
                                        @if ($latestDate4)
                                            <span class="text-muted">{{ $latestDate4->updated_at->format('d-m-Y') }}</span>
                                        @else
                                            ---
                                        @endif
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

                        <h5 class="card-title mb-0">classroom</h5>
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
                                    $j = 1;
                                @endphp
                                @foreach ($classroom as $classroom)
                                    <tr>
                                        {{-- <td>{{ $classroom->classroom_id }}</td> --}}
                                        <td>{{ $classroom->class_name }}</td>
                                        <td>{{ $classroom->name }}</td>
                                        <td>{{ $classroom->form }}</td>
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



        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="node_modules/apexcharts/dist/apexcharts.min.js"></script>
        <script>
            var totalStudentForEachForm = @json($totalStudentForEachForm);
            var totalPoorStudentForEachForm = @json($totalPoorStudentForEachForm);
        </script>
        <script src="../js/dashboard.js"></script>

    </body>

    </html>
@endsection
