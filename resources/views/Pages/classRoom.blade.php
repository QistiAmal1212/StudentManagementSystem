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


<body>
    <x-statusMessage />
    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form method="post" id="formAdd" class="" action="{{ route('addclassroom') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#333b46;">
                        <h5 class="modal-title" style="color:white;">Add New classroom</h5>
                        <button type="button" style="color:white;" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div style="width:95%; margin-left:2.5%;">
                            <div class="form-group">
                                <label for="class_name">Class Name:</label>
                                <input type="text" class="form-control" id="class_name" name="class_name" required>
                            </div>



                            <div class="form-group">
                                <label for="form">Form:</label>
                                <input type="number" class="form-control" id="form" name="form" min="1" max="6" required>
                            </div>


                            <div class="form-group">
                                <label for="classTeacher">classroom Teacher:</label>
                                <select id="classTeacher" name="teacher_id" class="form-select form-select-lg mb-3" aria-label="Default select example" required>
                                    <option value="">--</option>
                                    @foreach ($teachers as $teachers)
                                    <option value="{{ $teachers->teacher_id }}">{{ $teachers->name }}</option> @endforeach
                                </select>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
        <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="saveItem">Save</button>
        </div>
        </div>
        </form>
        </div>
        </div>




        <div id="updateModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form method="post" id="updateclassroom" class="" action="{{ route('updateclassroom') }}">
                    @method('PUT')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#333b46;">
                            <h5 class="modal-title" style="color:white;">Update classroom</h5>
                            <button type="button" style="color:white;" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="updateClassId" name="updateClassId" required>
                            <div style="width:95%; margin-left:2.5%;">
                                <div class="form-group">
                                    <label for="updateclass_name">Class Name:</label>
                                    <input type="text" class="form-control" id="updateclass_name" name="updateclass_name"
                                        required>
                                </div>



                                <div class="form-group">
                                    <label for="updateForm">Form:</label>
                                    <input type="number" class="form-control" id="updateForm" name="updateForm"
                                        min="1" max="6" required>
                                </div>


                                <div class="form-group">
                                    <label for="updateteacher_id">classroom Teacher:</label>
                                    <select id="updateteacher_id" name="updateteacher_id"
                                        class="form-select form-select-lg mb-3" aria-label="Default select example"
                                        required>
                                        <option value="">--</option>
                                        @foreach ($teachers2 as $teachers)
                                            <option value="{{ $teachers->teacher_id }}">{{ $teachers->name }}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="close2" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="UpdateItem">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header" style="background-color:white;">
                        <div>
                            <x-addbtn id="addBtn" />
                            <x-deletebtn id="deleteBtn" />
                            <a href="{{ route('exportExcelclassroom') }}">
                                <x-excelbtn id="excelBtn" />
                            </a>
                            <a href="{{ route('exportPdfclassroom') }}">
                                <x-pdfbtn id="pdfBtn" />
                            </a>
                        </div>
                    </div>
                    <form id="deleteclassroom" class="deleteclassroom" method="post"
                        action="{{ route('deleteclassroom') }}" enctype="multipart/form-data">
                        @method('DELETE')
                        @csrf
                        <div class="card-body" style="padding-right:15px;padding-left:15px;padding-top:10px;">
                            <div class="d-flex justify-content-between mb-3">

                            </div>
                            <table id="example" class="table table-striped table-bordered"
                                style="width:100%; font-size:15px !important;">
                                <thead>
                                    <tr>
                                        <th style="width:5%;"> <input type="checkbox" id="selectAllCheckbox"
                                                name="selectedClass[]" /></th>
                                        <th style="width:20%;">Class Name</th>
                                        <th style="width:30%;">Class Teacher</th>
                                        <th style="width:20%;">Form</th>
                                        <th style="width:20%;">Total student</th>
                                        <th style="width:5%;">Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $j = 1;
                                    @endphp
                                    @foreach ($classroom as $classroom)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="selectedClass[]"
                                                    value="{{ $classroom->classroom_id }}" />
                                            </td>
                                            <td>{{ $classroom->class_name }}</td>
                                            <td>{{ $classroom->name }}</td>
                                            <td>{{ $classroom->form }}</td>
                                            <td>{{ $totalstudent[$j] }}</td>
                                            <td>
                                                <center><i class="fas fa-edit editBtn"
                                                        data-class-id="{{ $classroom->classroom_id }}"></i></center>
                                            </td>
                                        </tr>
                                        @php
                                            $j++;
                                        @endphp
                                    @endforeach
                                    <!-- Add more rows here -->
                                </tbody>
                            </table>
                        </div>
                </div>
                </form>

            </div>
        </div>

        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="js/classroom.js"></script>


        </body>

    </html>
@endsection
