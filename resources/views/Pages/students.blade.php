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
                                <label for="icNumber">IC Number:</label>
                                <input type="text" class="form-control" id="icNumber" name="icNumber" required>
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
                                <label for="familyIncome">Family Income:</label>
                                <input type="number" class="form-control" id="familyIncome" name="familyIncome" required>
                            </div>

                            <div class="form-group">
                                <label for="totalFamilyMember">Family member:</label>
                                <input type="number" class="form-control" id="totalFamilyMember" name="totalFamilyMember" required>
                            </div>

                            <div class="form-group">
                                <label for="class">Class:</label>
                                <select id="class" name="class" class="form-select form-select-lg mb-3" aria-label="Default select example">
                                    <option value="0">-----</option>
                                    @foreach($class as $class)
                                    <option value="{{ $class->classroomId }}">{{ $class->className }}</option>
                                    @endforeach
                                </select>

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="prev" class="btn btn-warning" style="display:none;" onclick="prevStep()">Previous</button>
                        <button type="button" id="next" class="btn btn-primary" onclick="nextStep()">Next</button>
                        <button type="submit" id="saveItem" class="btn btn-success" style="display: none;">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>





    <div id="importModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form id="importForm" style="width:95%; margin-left:2.5%;" action="{{ route('importStudents') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#333b46;">
                        <h5 class="modal-title" style="color:white;">import data</h5>
                        <button style="color:white;background-color:transparent;" type="button" class="close" data-dismiss="modal">&times;</button>
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
                        <button type="button" id="close3" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveItem2">Save</button>
                    </div>
            </form>
        </div>
    </div>
    </div>




    <div id="updateModal" class="modal fade" role="dialog">
        <div id="updateToastContainer" aria-live="polite" aria-atomic="true" style="position: fixed; top: 0; right: 0; margin: 20px; z-index: 1000;"></div>
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
                            <h5><span id="updateFirstStep" class="badge rounded-pill bg-secondary">1</span><span id="updateStepLine">_______________________________________</span><span style="background-color:grey;" class="badge rounded-pill bg-secondary">2</span></h5>
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
                                <label for="updateIcNumber">IC Number:</label>
                                <input type="text" class="form-control" id="updateIcNumber" name="updateIcNumber" required>
                            </div>
                            <div class="form-group">
                                <label for="updatePhone">Phone Number:</label>
                                <input type="text" class="form-control" id="updatePhone" name="updatePhone" required>
                            </div>
                            <div class="form-group">
                                <label for="updateEmail">Email:</label>
                                <input type="text" class="form-control" id="updateEmail" name="updateEmail" required>
                            </div>
                            <!-- Add more fields as needed -->
                        </div>
                        <div class="updateStep" id="updateStep2" style="display: none;width:95%; margin-left:2.5%;">
                            <!-- Similar fields as in the add form, you can customize as needed -->
                            <div class="form-group">
                                <label for="updateFamilyIncome">Family Income:</label>
                                <input type="number" class="form-control" id="updateFamilyIncome" name="updateFamilyIncome" required>
                            </div>
                            <div class="form-group">
                                <label for="updateTotalFamilyMember">Family member:</label>
                                <input type="number" class="form-control" id="updateTotalFamilyMember" name="updateTotalFamilyMember" required>
                            </div>
                            <div class="form-group">
                                <label for="updateClass">Class:</label>
                                <select id="updateClass" name="updateClass" class="form-select form-select-lg mb-3" aria-label="Default select example">
                                    <option value="0">-----</option>
                                    @foreach($class2 as $class)
                                    <option value="{{ $class->classroomId }}">{{ $class->className }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Add more fields as needed -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="updatePrev" class="btn btn-warning" style="display:none;" onclick="updatePrevStep()">Previous</button>
                        <button type="button" id="updateNext" class="btn btn-primary" onclick="updateNextStep()">Next</button>
                        <button type="submit" id="updateItem" class="btn btn-success" style="display: none;">Update</button>
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
                <form id="deleteStudent" class="deleteStudent" method="post" action="{{ route('deleteStudent') }}" enctype="multipart/form-data">
                    @method('DELETE')
                    @csrf
                    <div class="card-body" style="padding-right:15px;padding-left:15px;padding-top:10px;">
                        <div class="d-flex justify-content-between mb-3">

                        </div>
                        <table id="example" class="table table-striped table-bordered" style="width:100%; font-size:15px !important;">
                            <thead>
                                <tr>
                                    <th style="width:5%;"> <input type="checkbox" id="selectAllCheckbox" name="selectedStudent[]" /></th>
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
                                @foreach($students as $student)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selectedStudent[]" value="{{ $student->studentId }}" />
                                    </td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->icNumber }}</td>
                                    <td>{{ $student->noTell }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->className }}</td>
                                    <td>{{ $student->familyIncome }}</td>
                                    <td>{{ $student->totalFamilyMember }} person</td>
                                    <td>
                                        <center><i class="fas fa-edit updateBtn" data-student-id="{{ $student->studentId }}"></i></center>

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
                if ($('input[name="selectedStudent[]"]:checked').length === 0) {
                    Swal.fire({
                        icon: 'error'
                        , title: 'No Teacher Selected'
                        , text: 'Please select at least one teacher to delete.'
                    });
                } else {
                    $('#deleteStudent').submit();
                }
            });
            $(".sidebar-item.active").removeClass("active");
            $("#students").addClass("active");


            $('#selectAllCheckbox').click(function() {
                $('input[name="selectedStudent[]"]').prop('checked', this.checked);
            });





            $('#addStudent').submit(function(event) {



            });


        });
        $('#importBtn').click(function() {
            console.log("import button clicked.");
            $('#importModal').modal('show');
        });


        $('#importModal').on('click', '.close', function() {
            $('#importModal').modal('hide');
        });
        $('#importModal').on('click', '#close3', function() {
            $('#importModal').modal('hide');
        });




        $('#addBtn').click(function() {
            console.log("Add button clicked.");
            $('#addModal').modal('show');
        });

        $('#addModal').on('click', '.close', function() {
            $('#addModal').modal('hide');
        });





        $('.updateBtn').click(function() {
            console.log("update button clicked.");



            var studentId = $(this).data('student-id');
            $.ajax({
                url: '/getStudentDetail'
                , type: 'GET'
                , data: {
                    studentId: studentId

                }
                , success: function(studentDetail) {

                    console.log(studentDetail);


                    $('#updateModal').modal('show');
                    $('#updateId').val(studentDetail.studentId);
                    $('#updateName').val(studentDetail.name);
                    $('#updateIcNumber').val(studentDetail.icNumber);
                    $('#updatePhone').val(studentDetail.noTell);
                    $('#updateEmail').val(studentDetail.email);
                    $('#updateFamilyIncome').val(studentDetail.familyIncome);
                    $('#updateTotalFamilyMember').val(studentDetail.totalFamilyMember);
                    var studentClass = $('#updateClass');
                    var existingOption = studentClass.find('option[value="' + studentDetail.classroomId + '"]');
                    existingOption.prop('selected', true);

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

    </script>


    <script>
        let currentStep = 1;
        const totalSteps = 2;

        function nextStep() {
            if (currentStep < totalSteps) {


                var nameTest = $('#name').val();
                var emailTest = $('#emailStudent').val();
                var icNumberTest = $('#icNumber').val();
                var noTellTest = $('#phone').val();
                // Validate input length before submitting the form
                var name = $('#name').val();
                var email = $('#emailStudent').val();
                var icNumberLength = $('#icNumber').val().length;
                var noTellLength = $('#phone').val().length;

                var test1 = false;
                var test2 = false;
                var test3 = false;
                var test4 = false;
                console.log('Email:', email); // Add this line for debugging

                if (!/^[a-zA-Z ]+$/.test(name)) {
                    test1 = true;
                }

                if (icNumberLength !== 12) {
                    test2 = true;
                }

                if (noTellLength < 11 || noTellLength > 12) {
                    test3 = true;
                }


                if (!/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/.test(email)) {
                    test4 = true;
                }

                if (test1 || test2 || test3 || test4) {
                    var errorMessage = '';

                    if (test1) {
                        errorMessage += '* Name must be letters only\n';
                    }

                    if (test2) {
                        errorMessage += '* IC must be 12 digits\n';
                    }

                    if (test3) {
                        errorMessage += '* No Tell must be between 10 and 11 digits\n';
                    }

                    if (test4) {
                        errorMessage += '* Email must be in lowercase only\n';
                    }

                    showToast(errorMessage);
                    event.preventDefault();
                }
                if (nameTest != "" && emailTest != "" && icNumberTest != "" && noTellTest != "") {
                    if (test1 == false && test2 == false && test3 == false && test4 == false) {
                        currentStep++;
                        updateStepVisibility();
                    }

                }
            }
        }

        function showToast(errorMessage) {
            var toastContainer = document.getElementById('toastContainer');

            // Create a new Toast element
            var toast = document.createElement('div');
            toast.classList.add('toast');
            toast.classList.add('bg-danger'); // Customize the background color if needed
            toast.classList.add('text-white');
            toast.style.position = 'fixed';
            toast.style.top = '58%'
            toast.style.right = '13%'
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');

            // Create a Toast body
            var toastBody = document.createElement('div');
            toastBody.classList.add('toast-body');
            toastBody.innerText = errorMessage.trim();

            // Append the Toast body to the Toast
            toast.appendChild(toastBody);

            // Append the Toast to the Toast container
            toastContainer.appendChild(toast);

            // Show the Toast
            $(toast).toast('show');
        }

        function prevStep() {
            if (currentStep > 1) {
                currentStep--;
                updateStepVisibility();
            }
        }

        function updateStepVisibility() {

            for (let step = 1; step <= totalSteps; step++) {
                const stepDiv = document.getElementById('step' + step);
                const stepButton = document.getElementById('next');
                if (step === currentStep) {
                    stepDiv.style.display = 'block';
                    if (step === totalSteps) {
                        stepButton.style.display = 'none';
                        var firstStepElement = document.getElementById("firstStep");
                        var line = document.getElementById("stepLine");
                        firstStepElement.style.setProperty("background-color", "green", "important");
                        line.style.setProperty("color", "green", "important");
                        document.getElementById('saveItem').style.display = 'block';
                        document.getElementById('prev').style.display = 'block';
                    } else {
                        var firstStepElement = document.getElementById("firstStep");
                        var line = document.getElementById("stepLine");
                        firstStepElement.style.setProperty("background-color", "grey", "important");
                        line.style.setProperty("color", "grey", "important");
                        stepButton.style.display = 'block';
                        document.getElementById('saveItem').style.display = 'none';
                        document.getElementById('prev').style.display = 'none';
                    }
                } else {
                    stepDiv.style.display = 'none';
                }
            }
        }

    </script>

    <script>
        let updateCurrentStep = 1;
        const updateTotalSteps = 2;

        function updateNextStep() {
            if (updateCurrentStep < updateTotalSteps) {
                var updateNameTest = $('#updateName').val();
                var updateEmailTest = $('#updateEmail').val();
                var updateIcNumberTest = $('#updateIcNumber').val();
                var updateNoTellTest = $('#updatePhone').val();

                // Validate input length before moving to the next step
                var updateName = $('#updateName').val();
                var updateEmail = $('#updateEmail').val();
                var updateIcNumberLength = $('#updateIcNumber').val().length;
                var updateNoTellLength = $('#updatePhone').val().length;

                var updateTest1 = false;
                var updateTest2 = false;
                var updateTest3 = false;
                var updateTest4 = false;

                if (!/^[a-zA-Z ]+$/.test(updateName)) {
                    updateTest1 = true;
                }

                if (updateIcNumberLength !== 12) {
                    updateTest2 = true;
                }

                if (updateNoTellLength < 11 || updateNoTellLength > 12) {
                    updateTest3 = true;
                }

                if (!/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/.test(updateEmail)) {
                    updateTest4 = true;
                }

                if (updateTest1 || updateTest2 || updateTest3 || updateTest4) {
                    var updateErrorMessage = '';

                    if (updateTest1) {
                        updateErrorMessage += '* Name must be letters only\n';
                    }

                    if (updateTest2) {
                        updateErrorMessage += '* IC must be 12 digits\n';
                    }

                    if (updateTest3) {
                        updateErrorMessage += '* No Tell must be between 10 and 11 digits\n';
                    }

                    if (updateTest4) {
                        updateErrorMessage += '* Email must be in lowercase only\n';
                    }

                    updateShowToast(updateErrorMessage);
                } else if (updateNameTest !== "" && updateEmailTest !== "" && updateIcNumberTest !== "" && updateNoTellTest !== "") {
                    if (updateTest1 === false && updateTest2 === false && updateTest3 === false && updateTest4 === false) {
                        updateCurrentStep++;
                        updateUpdateStepVisibility();
                    }
                }
            }
        }

        function updateShowToast(errorMessage) {
            var updateToastContainer = document.getElementById('updateToastContainer');

            // Create a new Toast element
            var updateToast = document.createElement('div');
            updateToast.classList.add('toast');
            updateToast.classList.add('bg-danger'); // Customize the background color if needed
            updateToast.classList.add('text-white');
            updateToast.style.position = 'fixed';
            updateToast.style.top = '58%';
            updateToast.style.right = '13%';
            updateToast.setAttribute('role', 'alert');
            updateToast.setAttribute('aria-live', 'assertive');
            updateToast.setAttribute('aria-atomic', 'true');

            // Create a Toast body
            var updateToastBody = document.createElement('div');
            updateToastBody.classList.add('toast-body');
            updateToastBody.innerText = errorMessage.trim();

            // Append the Toast body to the Toast
            updateToast.appendChild(updateToastBody);

            // Append the Toast to the Toast container
            updateToastContainer.appendChild(updateToast);

            // Show the Toast
            $(updateToast).toast('show');
        }

        function updatePrevStep() {
            if (updateCurrentStep > 1) {
                updateCurrentStep--;
                updateUpdateStepVisibility();
            }
        }

        function updateUpdateStepVisibility() {
            for (let step = 1; step <= updateTotalSteps; step++) {
                const stepDiv = document.getElementById('updateStep' + step);
                const updateStepButton = document.getElementById('updateNext');
                if (step === updateCurrentStep) {
                    stepDiv.style.display = 'block';
                    if (step === updateTotalSteps) {
                        updateStepButton.style.display = 'none';
                        document.getElementById('updateItem').style.display = 'block';
                        document.getElementById('updatePrev').style.display = 'block';
                    } else {
                        updateStepButton.style.display = 'block';
                        document.getElementById('updateItem').style.display = 'none';
                        document.getElementById('updatePrev').style.display = 'none';
                    }
                } else {
                    stepDiv.style.display = 'none';
                }
            }
        }

    </script>









</body>
</html>
@endsection
