@extends('layouts.main')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">
</head>

<body>
    <x-statusMessage />

    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="toastContainer" aria-live="polite" aria-atomic="true" style="position: fixed; top: 0; right: 0; margin: 20px; z-index: 1000;"></div>

            <form id="addTeacher" class="addTeacher" action="{{ route('addTeacher') }}" method="post">

                @csrf
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#333b46;">
                        <h5 class="modal-title" style="color:white;">Add New Teacher Data</h5>
                        <button style="color:white;" type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div style="width:95%; margin-left:2.5%;">

                            <div class="form-group">
                                <label for="name">Name<span class="text-danger">*</span>:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="icNumber">IC Number<span class="text-danger">*</span>:</label>
                                <input type="text" class="form-control" id="icNumber" name="icNumber" required>
                            </div>
                            <div class="form-group">
                                <label for="noTell">No tell<span class="text-danger">*</span>:</label>
                                <input type="text" class="form-control" id="noTell" name="noTell" placeholder="60xxxxxxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email<span class="text-danger">*</span>:</label>
                                <input type="email" class="form-control" id="emailTeacher" name="email" placeholder="example@gmail.com" required>
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


    <!-- Add this modal after the existing addModal -->
    <div id="updateModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="toastContainer2" aria-live="polite" aria-atomic="true" style="position: fixed; top: 0; right: 0; margin: 20px; z-index: 1000;"></div>

            <form id="updateTeacher" class="updateTeacher" action="{{ route('updateTeacher') }}" method="post">
                @method('PUT')
                @csrf
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#333b46;">
                        <h5 class="modal-title" style="color:white;">Update Teacher Data</h5>
                        <button style="color:white;" type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div style="width:95%; margin-left:2.5%;">
                            <!-- Add input fields for updating data -->
                            <input type="hidden" class="form-control" id="updateId" name="updateId" required>
                            <div class="form-group">
                                <label for="updateName">Name<span class="text-danger">*</span>:</label>
                                <input type="text" class="form-control" id="updateName" name="updateName" required>
                            </div>
                            <div class="form-group">
                                <label for="updateIcNumber">IC Number<span class="text-danger">*</span>:</label>
                                <input type="text" class="form-control" id="updateIcNumber" name="updateIcNumber" required>
                            </div>
                            <div class="form-group">
                                <label for="updateNoTell">No tell<span class="text-danger">*</span>:</label>
                                <input type="text" class="form-control" id="updateNoTell" name="updateNoTell" placeholder="60xxxxxxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="updateEmail">Email<span class="text-danger">*</span>:</label>
                                <input type="email" class="form-control" id="updateEmail" name="updateEmail" placeholder="example@gmail.com" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closeUpdate" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="updateItem">Update</button>
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
                        <x-addbtn type="button" id="addBtn" />

                        <x-deleteBtn type="button" id="deleteBtn" />
                        <a href="{{ route('exportExcelTeachers') }}">
                            <x-excelbtn type="button" id="excelBtn" />
                        </a>
                        <a href="{{ route('exportPdfTeacher') }}">
                            <x-pdfbtn type="button" id="pdfBtn" /></a>

                        {{-- <x-importbtn id="importBtn" /> --}}

                        <input type="file" id="importFile" style="display: none;">
                    </div>
                </div>
                <form id="deleteTeacher" class="deleteTeacher" method="post" action="{{ route('deleteTeacher') }}" enctype="multipart/form-data">
                    @method('DELETE')
                    @csrf
                    <div class="card-body" style="padding-right:15px;padding-left:15px;padding-top:10px;">
                        <div class="d-flex justify-content-between mb-3">

                        </div>
                        <table id="example" class="table table-striped table-bordered" style="width:100%; font-size:15px !important;">
                            <thead>
                                <tr>
                                    <th style="width:5%;"> <input type="checkbox" id="selectAllCheckbox" name="selectedTeacher[]" /></th>
                                    <th style="width:35%;">Name</th>
                                    <th style="width:15.33%;">Ic number</th>
                                    <th style="width:15.33%;">No tell</th>
                                    <th style="width:15.33%;">Email</th>
                                    <th style="width:7%;">Is Class Teacher</th>
                                    <th style="width:7%;">Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teachers as $teacher)
                                <tr>
                                    <td style="width:5%;">
                                        <input type="checkbox" name="selectedTeacher[]" value="{{ $teacher->teacherId }}" />
                                    </td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->icNumber }}</td>
                                    <td>{{ $teacher->noTell }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>
                                        @if( $teacher->isClassTeacher == 1)
                                        <span>yes</span>
                                        @else
                                        <span>no</span>
                                        @endif
                                    </td>

                                    <td>
                                        <center><i class="fas fa-edit editBtn" data-teacher-id="{{ $teacher->teacherId }}"></i></center>

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="js/teachers.js"></script>

</body>
</html>
@endsection
