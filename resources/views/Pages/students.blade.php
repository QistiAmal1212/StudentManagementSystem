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
    <div id="addModal" class="modal fade" role="dialog">
        <div id="toastContainer" aria-live="polite" aria-atomic="true" style="position: fixed; top: 0; right: 0; margin: 20px; z-index: 1000;"></div>
        <div class="modal-dialog">
            <form id="addStudent" class="addForm" method="post" action="{{ route('addStudent') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#333b46;">

                        <h5 class="modal-title" style="color:white;">Add New Student Data </h5>
                        <button style="color:white;" type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <h5><span id="firstStep" class="badge rounded-pill bg-secondary">1</span><span id="stepLine">_______________________________________</span><span style="background-color:grey;" class="badge rounded-pill bg-secondary">2</span></h5>
                        </center>

                        <br>




                        <div class="step" id="step1" style="width:95%; margin-left:2.5%;">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="ic_number">IC Number:</label>
                                <input type="text" class="form-control" id="ic_number" name="ic_number" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number:</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="emailStudent" name="email" required>
                            </div>
                        </div>
                        <div class="step" id="step2" style="display: none;width:95%; margin-left:2.5%;">

                            <div class="form-group">
                                <label for="family_income ">Family Income:</label>
                                <input type="number" class="form-control" id="family_income " name="family_income " required>
                            </div>

                            <div class="form-group">
                                <label for="total_family_member">Family member:</label>
                                <input type="number" class="form-control" id="total_family_member" name="total_family_member" required>
                            </div>

                            <div class="form-group">
                                <label for="class">Class:</label>
                                <select id="class" name="class" class="form-select form-select-lg mb-3" aria-label="Default select example">
                                    <option value="0">-----</option>
                                    @foreach ($class as $class)
                                    <option value="{{ $class->Classroom_id }}">{{ $class->class_name }}</option> @endforeach
                                </select>

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
        <button type="button" id="prev" class="btn btn-warning" style="display:none;"
            onclick="prevStep()">Previous</button>
        <button type="button" id="next" class="btn btn-primary" onclick="nextStep()">Next</button>
        <button type="submit" id="saveItem" class="btn btn-success" style="display: none;">Save</button>
        </div>
        </div>
        </form>
        </div>
        </div>





        <div id="importModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form id="importForm" style="width:95%; margin-left:2.5%;" action="{{ route('importStudents') }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#333b46;">
                            <h5 class="modal-title" style="color:white;">import data</h5>
                            <button style="color:white;background-color:transparent;" type="button" class="close"
                                data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">

                            <br>

                            <div class="mb-3">
                                <label for="file" class="form-label">Import excel here</label>
                                <input class="form-control" type="file" id="file" name="file">
                            </div>
                            <br>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="close3" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveItem2">Save</button>
                        </div>
                </form>
            </div>
        </div>
        </div>




        <div id="updateModal" class="modal fade" role="dialog">
            <div id="updateToastContainer" aria-live="polite" aria-atomic="true"
                style="position: fixed; top: 0; right: 0; margin: 20px; z-index: 1000;"></div>
            <div class="modal-dialog">
                <form id="updateStudent" class="updateForm" method="post" action="{{ route('updateStudent') }}">
                    @method('PUT')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#333b46;">
                            <h5 class="modal-title" style="color:white;">Update Student Data </h5>
                            <button style="color:white;" type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <center>
                                <h5><span id="updateFirstStep" class="badge rounded-pill bg-secondary">1</span><span
                                        id="updateStepLine">_______________________________________</span><span
                                        style="background-color:grey;" class="badge rounded-pill bg-secondary">2</span></h5>
                            </center>
                            <br>
                            <div class="updateStep" id="updateStep1" style="width:95%; margin-left:2.5%;">
                                <input type="hidden" name="updateId" id="updateId" class="updateId" />
                                <!-- Similar fields as in the add form, you can customize as needed -->
                                <div class="form-group">
                                    <label for="updateName">Name:</label>
                                    <input type="text" class="form-control" id="updateName" name="updateName" required>
                                </div>
                                <div class="form-group">
                                    <label for="updateic_number">IC Number:</label>
                                    <input type="text" class="form-control" id="updateic_number"
                                        name="updateic_number" required>
                                </div>
                                <div class="form-group">
                                    <label for="updatePhone">Phone Number:</label>
                                    <input type="text" class="form-control" id="updatePhone" name="updatePhone"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="updateEmail">Email:</label>
                                    <input type="text" class="form-control" id="updateEmail" name="updateEmail"
                                        required>
                                </div>
                                <!-- Add more fields as needed -->
                            </div>
                            <div class="updateStep" id="updateStep2" style="display: none;width:95%; margin-left:2.5%;">
                                <!-- Similar fields as in the add form, you can customize as needed -->
                                <div class="form-group">
                                    <label for="updatefamily_income ">Family Income:</label>
                                    <input type="number" class="form-control" id="updatefamily_income "
                                        name="updatefamily_income " required>
                                </div>
                                <div class="form-group">
                                    <label for="updatetotal_family_member">Family member:</label>
                                    <input type="number" class="form-control" id="updatetotal_family_member"
                                        name="updatetotal_family_member" required>
                                </div>
                                <div class="form-group">
                                    <label for="updateClass">Class:</label>
                                    <select id="updateClass" name="updateClass" class="form-select form-select-lg mb-3"
                                        aria-label="Default select example">
                                        <option value="0">-----</option>
                                        @foreach ($class2 as $class)
                                            <option value="{{ $class->Classroom_id }}">{{ $class->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Add more fields as needed -->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="updatePrev" class="btn btn-warning" style="display:none;"
                                onclick="updatePrevStep()">Previous</button>
                            <button type="button" id="updateNext" class="btn btn-primary"
                                onclick="updateNextStep()">Next</button>
                            <button type="submit" id="updateItem" class="btn btn-success"
                                style="display: none;">Update</button>
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

                            <a href="{{ route('exportExcelStudents') }}">
                                <x-excelbtn id="excelBtn" />
                            </a>
                            <a href="{{ route('exportPdfStudent') }}">
                                <x-pdfbtn id="pdfBtn" />
                            </a>
                            <x-importbtn id="importBtn" />

                            <input type="file" id="importFile" style="display: none;">
                        </div>
                    </div>
                    <form id="deleteStudent" class="deleteStudent" method="post" action="{{ route('deleteStudent') }}"
                        enctype="multipart/form-data">
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
                                                name="selectedStudent[]" /></th>
                                        <th style="width:35%;">Name</th>
                                        <th style="width:9.66%;">Ic number</th>
                                        <th style="width:9.66%;">No tell</th>
                                        <th style="width:9.66%;">Email</th>
                                        <th style="width:9.66%;">Class</th>
                                        <th style="width:9.66%;">Family income</th>
                                        <th style="width:9.66%;">Family member</th>
                                        <th style="width:2%;">Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="selectedStudent[]"
                                                    value="{{ $student->student_id }}" />
                                            </td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->ic_number }}</td>
                                            <td>{{ $student->no_tell }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->class_name }}</td>
                                            <td>{{ $student->family_income }}</td>
                                            <td>{{ $student->total_family_member }} person</td>
                                            <td>
                                                <center><i class="fas fa-edit updateBtn"
                                                        data-student-id="{{ $student->student_id }}"></i></center>

                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- Add more rows here -->
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="js/students.js"></script>

        </body>

    </html>
@endsection
