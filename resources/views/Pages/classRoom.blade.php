@extends('layouts.main')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <x-statusMessage />
    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form method="post" id="formAdd" class="" action="{{ route('addClassRoom') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#333b46;">
                        <h5 class="modal-title" style="color:white;">Add New ClassRoom</h5>
                        <button type="button" style="color:white;" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div style="width:95%; margin-left:2.5%;">
                            <div class="form-group">
                                <label for="className">Class Name:</label>
                                <input type="text" class="form-control" id="className" name="className" required>
                            </div>



                            <div class="form-group">
                                <label for="form">Form:</label>
                                <input type="number" class="form-control" id="form" name="form" min="1" max="6" required>
                            </div>


                            <div class="form-group">
                                <label for="classTeacher">ClassRoom Teacher:</label>
                                <select id="classTeacher" name="teacherId" class="form-select form-select-lg mb-3" aria-label="Default select example" required>
                                    <option value="">--</option>
                                    @foreach($teachers as $teachers)
                                    <option value="{{ $teachers->teacherId }}">{{ $teachers->name }}</option>
                                    @endforeach
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
            <form method="post" id="updateClassRoom" class="" action="{{ route('updateClassRoom') }}">
                @method('PUT')
                @csrf
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#333b46;">
                        <h5 class="modal-title" style="color:white;">Update ClassRoom</h5>
                        <button type="button" style="color:white;" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="updateClassId" name="updateClassId" required>
                        <div style="width:95%; margin-left:2.5%;">
                            <div class="form-group">
                                <label for="updateClassName">Class Name:</label>
                                <input type="text" class="form-control" id="updateClassName" name="updateClassName" required>
                            </div>



                            <div class="form-group">
                                <label for="updateForm">Form:</label>
                                <input type="number" class="form-control" id="updateForm" name="updateForm" min="1" max="6" required>
                            </div>


                            <div class="form-group">
                                <label for="updateTeacherId">ClassRoom Teacher:</label>
                                <select id="updateTeacherId" name="updateTeacherId" class="form-select form-select-lg mb-3" aria-label="Default select example" required>
                                    <option value="">--</option>
                                    @foreach($teachers2 as $teachers)
                                    <option value="{{ $teachers->teacherId }}">{{ $teachers->name }}</option>
                                    @endforeach
                                </select>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close2" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                        <a href="{{ route('exportExcelClassRoom') }}">
                            <x-excelbtn id="excelBtn" />
                        </a>
                        <a href="{{ route('exportPdfClassRoom') }}">
                            <x-pdfbtn id="pdfBtn" />
                        </a>
                        {{-- <x-importbtn onclick="handleImportClick()" /> --}}

                        {{-- <input type="file" id="importFile" style="display: none;"> --}}
                    </div>
                </div>
                <form id="deleteClassRoom" class="deleteClassRoom" method="post" action="{{ route('deleteClassRoom') }}" enctype="multipart/form-data">
                    @method('DELETE')
                    @csrf
                    <div class="card-body" style="padding-right:15px;padding-left:15px;padding-top:10px;">
                        <div class="d-flex justify-content-between mb-3">

                        </div>
                        <table id="example" class="table table-striped table-bordered" style="width:100%; font-size:15px !important;">
                            <thead>
                                <tr>
                                    <th style="width:5%;"> <input type="checkbox" id="selectAllCheckbox" name="selectedClass[]" /></th>
                                    <th style="width:20%;">Class Name</th>
                                    <th style="width:30%;">Class Teacher</th>
                                    <th style="width:20%;">Form</th>
                                    <th style="width:20%;">Total student</th>
                                    <th style="width:5%;">Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($classRoom as $classRoom)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selectedClass[]" value="{{ $classRoom->classroomId }}" />
                                    </td>
                                    <td>{{ $classRoom->className }}</td>
                                    <td>{{ $classRoom->name }}</td>
                                    <td>{{ $classRoom->form }}</td>
                                    <td>1000</td>
                                    <td>
                                        <center><i class="fas fa-edit editBtn" data-class-id="{{ $classRoom->classroomId }}"></i></center>

                                    </td>
                                </tr>
                                @endforeach
                                <!-- Add more rows here -->
                            </tbody>
                        </table>
                    </div>
            </div>
            </form>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            $('#example').DataTable({

            });
            $('#deleteBtn').click(function() {
                console.log("delete button has been click");
                if ($('input[name="selectedClass[]"]:checked').length === 0) {
                    Swal.fire({
                        icon: 'error'
                        , title: 'No Class Selected'
                        , text: 'Please select at least one Class to delete.'
                    });
                } else {
                    $('#deleteClassRoom').submit();
                }
            });
            $(".sidebar-item.active").removeClass("active");
            $("#students").addClass("active");


            $('#selectAllCheckbox').click(function() {
                $('input[name="selectedClass[]"]').prop('checked', this.checked);
            });
            $(".sidebar-item.active").removeClass("active");
            $("#classRoom").addClass("active");


            $('#selectAllCheckbox').click(function() {
                $('input[name="selectedClass[]"]').prop('checked', this.checked);
            });

            $('#deleteClassRoom').submit(function(event) {
                // Check if any checkboxes are selected
                if ($('input[name="selectedClass[]"]:checked').length === 0) {
                    Swal.fire({
                        icon: 'error'
                        , title: 'No Class Selected'
                        , text: 'Please select at least one class to delete.'
                    , });
                    event.preventDefault(); // Prevent form submission
                }
            });





            $('#addBtn').click(function() {
                console.log("Add button clicked.");
                $('#addModal').modal('show');
            });

            $('#addModal').on('click', '.close', function() {
                $('#addModal').modal('hide');
            });

            $('#addModal').on('click', '#close', function() {
                $('#addModal').modal('hide');
            });



            $('.editBtn').click(function() {
                console.log("update button clicked.");
                $('#updateModal').modal('show');

                var classRoomId = $(this).data('class-id');
                $.ajax({
                    url: '/getClassRoomDetail'
                    , type: 'GET'
                    , data: {
                        classRoomId: classRoomId

                    }
                    , success: function(classRoom) {

                        console.log(classRoom);


                        $('#updateModal').modal('show');
                        $('#updateClassName').val(classRoom.className);
                        $('#updateClassId').val(classRoom.classroomId);
                        $('#updateForm').val(classRoom.form);
                        $('#updateTeacherId').val(classRoom.teacherId);
                        var teacherSelect = $('#updateTeacherId');
                        teacherSelect.append('<option value="' + classRoom.teacherId + '" selected>' + classRoom.name + '</option>');




                    }
                    , error: function(error) {
                        console.error(error);
                    }
                });
            });

            $('#updateModal').on('click', '.close', function() {
                $('#updateModal').modal('hide');
            });

            $('#updateModal').on('click', '#close2', function() {
                $('#updateModal').modal('hide');
            });

        });

    </script>
</body>
</html>
@endsection
