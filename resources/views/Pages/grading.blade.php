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
    <x-statusMessage />
    <div id="updateModal" class="modal fade" role="dialog">
        <div id="updateToastContainer" aria-live="polite" aria-atomic="true" style="position: fixed; top: 0; right: 0; margin: 20px; z-index: 1000;"></div>
        <div class="modal-dialog">
            <form id="updateResult" class="updateForm" method="post" action="{{ route('updateResult') }}">
                @method('PUT')
                @csrf
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#333b46;">
                        <h5 class="modal-title" style="color:white;">Update Student Result</h5>
                        <button style="color:white;" type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                        <div class="updateDiv" id="updateDiv" style="width:95%; margin-left:2.5%;">
                            <input type="hidden" name="updateId" id="updateId" class="updateId" />
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bahasa_melayu">bahasa_melayu:</label>
                                            <input type="number" class="form-control grade-input" id="bahasa_melayu" name="bahasa_melayu" required min="0" max="100" step="0.01">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="english">english:</label>
                                            <input type="number" class="form-control grade-input" id="english" name="english" required min="0" max="100" step="0.01">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="math">math:</label>
                                            <input type="number" class="form-control grade-input" id="math" name="math" required min="0" max="100" step="0.01">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="science">science:</label>
                                            <input type="number" class="form-control grade-input" id="science" name="science" required min="0" max="100" step="0.01">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sejarah">sejarah:</label>
                                            <input type="number" class="form-control grade-input" id="sejarah" name="sejarah" required min="0" max="100" step="0.01">
                                        </div>
                                    </div>

                                </div>
                                <div class="result">
                                    <span class="font-weight-bold">Average Result: </span><span id="avg">0</span><br>
                                    <span class="font-weight-bold">Pass/Fail: </span><span id="status" class="text-muted">-</span>
                                </div>
                            </div>




                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="updateItem" class="btn btn-success" style="">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


















    <div class="row">
        <div class="col-12">
            <div class="card" style="padding:20px; background-color:white;">
                <div class="d-flex align-items-center">
                    <!-- First Select Input -->

                    <select id="examSelect" name="exam_id" class="form-select" aria-label="Default select example" style="margin-right:10px;">
                        <option value="0">Please Select Exam</option>
                        @foreach ($exam as $exam)
                        <option value="{{ $exam->exam_id }}">{{ $exam->title }}</option> @endforeach
                    </select>


                    <select id="class_roomSelect"
            name="class_room" class="form-select" aria-label="Default select example"
            style="margin-right:10px;display:none;">
        <option value="0">Please select class_room</option>
        @foreach ($class_room as $class_room)
            <option value="{{ $class_room->class_room_id }}">{{ $class_room->class_name }}</option>
        @endforeach
        </select>

        <!-- Search Button -->
        <button id="searchButton" type="button" class="btn btn-info" style="height:30px;"><span
                style="position:relative; top:-5px;">Search</span></button>
        </div>
        </div>
        </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div id="cardT" class="card" style="display:none;">
                    <div class="card-header" style="background-color:white;">
                        <div>
                            <button class="btn btn-warning switch1" data-target="example">Pending</button>
                            <button class="btn btn-success switch2" data-target="example2">Successful</button>

                        </div>
                    </div>

                    <div id="cardtable" class="card-body" style="padding-right:15px;padding-left:15px;padding-top:10px;">
                        <div class="d-flex justify-content-between mb-3">

                        </div>
                        {{-- <table id="example" class="table table-striped table-bordered" style="width:100%; font-size:15px !important;">
                        <thead>
                            <tr>
                                <th style="width:70%;">Exam Title</th>
                                <th style="width:25%;">Form</th>
                                <th style="width:5%;">Update</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>

                                <td></td>
                                <td></td>
                                <td>
                                    <center><i class="fas fa-edit"></i></center>

                                </td>
                            </tr>

                        </tbody>
                    </table>



                    <table id="example2" class="table table-striped table-bordered" style="width:100%; font-size:15px !important;display:none;">
                        <thead>
                            <tr>
                                <th style="width:70%;">Exam Title2</th>
                                <th style="width:25%;">Form</th>
                                <th style="width:5%;">Update</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>

                                <td></td>
                                <td></td>
                                <td>
                                    <center><i class="fas fa-edit"></i></center>

                                </td>
                            </tr>

                        </tbody>
                    </table> --}}
                    </div>

                </div>

            </div>
        </div>


        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="js/grading.js"></script>

        </body>

    </html>
@endsection
