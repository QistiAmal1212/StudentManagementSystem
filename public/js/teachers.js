$(document).ready(function () {
    $('#example').DataTable();

    $('#deleteBtn').click(function () {
        console.log("delete button has been click");
        if ($('input[name="selectedTeacher[]"]:checked').length === 0) {
            Swal.fire({
                icon: 'error'
                , title: 'No Teacher Selected'
                , text: 'Please select at least one teacher to delete.'
            });
        } else {
            $('#deleteTeacher').submit();
        }
    });


    $('#addTeacher').submit(function (event) {
        // Validate input length before submitting the form
        var name = $('#name').val();
        var email = $('#emailTeacher').val();
        var ic_numberLength = $('#ic_number').val().length;
        var no_tellLength = $('#no_tell').val().length;

        var test1 = false;
        var test2 = false;
        var test3 = false;
        var test4 = false;
        console.log('Email:', email); // Add this line for debugging

        if (!/^[a-zA-Z ]+$/.test(name)) {
            test1 = true;
        }

        if (ic_numberLength !== 12) {
            test2 = true;
        }

        if (no_tellLength < 11 || no_tellLength > 12) {
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


    });




    $('#updateTeacher').submit(function (event) {
        // Validate input length before submitting the form
        var name = $('#updateName').val();
        var email = $('#updateEmail').val();
        var ic_numberLength = $('#updateic_number').val().length;
        var no_tellLength = $('#updateno_tell').val().length;

        var test1 = false;
        var test2 = false;
        var test3 = false;
        var test4 = false;
        console.log('Email:', email); // Add this line for debugging

        if (!/^[a-zA-Z ]+$/.test(name)) {
            test1 = true;
        }

        if (ic_numberLength !== 12) {
            test2 = true;
        }

        if (no_tellLength < 11 || no_tellLength > 12) {
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

            showToast2(errorMessage);
            event.preventDefault();
        }


    });

    function showToast(errorMessage) {
        var toastContainer = document.getElementsByclass_name('toastContainer')[0];


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

    function showToast2(errorMessage) {
        var toastContainer = document.getElementsByclass_name('toastContainer2')[0];


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



    $(".sidebar-item.active").removeClass("active");
    $("#teachers").addClass("active");


    $('#selectAllCheckbox').click(function () {
        $('input[name="selectedTeacher[]"]').prop('checked', this.checked);
    });


    $('#addBtn').click(function () {
        console.log("Add button clicked.");
        $('#addModal').modal('show');
    });

    $('#addModal').on('click', '.close', function () {
        $('#addModal').modal('hide');
    });

    $('#addModal').on('click', '#close', function () {
        $('#addModal').modal('hide');
    });

    $('#updateModal').on('click', '.close', function () {
        $('#updateModal').modal('hide');
    });

    $('#updateModal').on('click', '#closeUpdate', function () {
        $('#updateModal').modal('hide');
    });




    $('.editBtn').click(function () {
        var teacher_id = $(this).data('teacher-id');
        $.ajax({
            url: '/getTeacherDetail'
            , type: 'GET'
            , data: {
                teacher_id: teacher_id

            }
            , success: function (teacherDetail) {

                console.log(teacherDetail);


                $('#updateModal').modal('show');
                $('#updateId').val(teacherDetail.teacher_id);
                $('#updateName').val(teacherDetail.name);
                $('#updateic_number').val(teacherDetail.ic_number);
                $('#updateno_tell').val(teacherDetail.no_tell);
                $('#updateEmail').val(teacherDetail.email);



            }
            , error: function (error) {
                console.error(error);
            }
        });
    });


});
