$(document).ready(function () {

    $('#example').DataTable({

    });
    $('#deleteBtn').click(function () {
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


    $('#selectAllCheckbox').click(function () {
        $('input[name="selectedStudent[]"]').prop('checked', this.checked);
    });





    $('#addStudent').submit(function (event) {



    });


});
$('#importBtn').click(function () {
    console.log("import button clicked.");
    $('#importModal').modal('show');
});


$('#importModal').on('click', '.close', function () {
    $('#importModal').modal('hide');
});
$('#importModal').on('click', '#close3', function () {
    $('#importModal').modal('hide');
});




$('#addBtn').click(function () {
    console.log("Add button clicked.");
    $('#addModal').modal('show');
});

$('#addModal').on('click', '.close', function () {
    $('#addModal').modal('hide');
});





$('.updateBtn').click(function () {
    console.log("update button clicked.");



    var studentId = $(this).data('student-id');
    $.ajax({
        url: '/getStudentDetail'
        , type: 'GET'
        , data: {
            studentId: studentId

        }
        , success: function (studentDetail) {

            console.log(studentDetail);


            $('#updateModal').modal('show');
            $('#updateId').val(studentDetail.studentId);
            $('#updateName').val(studentDetail.name);
            $('#updateIcNumber').val(studentDetail.icNumber);
            $('#updatePhone').val(studentDetail.noTell);
            $('#updateEmail').val(studentDetail.email);
            $('#updatefamily_income ').val(studentDetail.family_income);
            $('#updatetotal_family_member').val(studentDetail.total_family_member);
            var studentClass = $('#updateClass');
            var existingOption = studentClass.find('option[value="' + studentDetail.classroomId + '"]');
            existingOption.prop('selected', true);

        }
        , error: function (error) {
            console.error(error);
        }
    });


});

$('#updateModal').on('click', '.close', function () {
    $('#updateModal').modal('hide');
});

$('#updateModal').on('click', '#close2', function () {
    $('#updateModal').modal('hide');
});











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













