
$(document).ready(function () {
    $('#example').DataTable({

    });
    $('#deleteBtn').click(function () {
        console.log("delete button has been click");
        if ($('input[name="selectedClass[]"]:checked').length === 0) {
            Swal.fire({
                icon: 'error'
                , title: 'No Class Selected'
                , text: 'Please select at least one Class to delete.'
            });
        } else {
            $('#deleteclassroom').submit();
        }
    });
    $(".sidebar-item.active").removeClass("active");
    $("#students").addClass("active");


    $('#selectAllCheckbox').click(function () {
        $('input[name="selectedClass[]"]').prop('checked', this.checked);
    });
    $(".sidebar-item.active").removeClass("active");
    $("#classroom").addClass("active");


    $('#selectAllCheckbox').click(function () {
        $('input[name="selectedClass[]"]').prop('checked', this.checked);
    });

    $('#deleteclassroom').submit(function (event) {
        // Check if any checkboxes are selected
        if ($('input[name="selectedClass[]"]:checked').length === 0) {
            Swal.fire({
                icon: 'error'
                , title: 'No Class Selected'
                , text: 'Please select at least one class to delete.'
                ,
            });
            event.preventDefault(); // Prevent form submission
        }
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



    $('.editBtn').click(function () {
        console.log("update button clicked.");
        $('#updateModal').modal('show');

        var classroom_id = $(this).data('class-id');
        $.ajax({
            url: '/getclassroomDetail'
            , type: 'GET'
            , data: {
                classroom_id: classroom_id

            }
            , success: function (classroom) {

                console.log(classroom);


                $('#updateModal').modal('show');
                $('#updateclass_name').val(classroom.class_name);
                $('#updateClassId').val(classroom.classroom_id);
                $('#updateForm').val(classroom.form);
                $('#updateteacher_id').val(classroom.teacher_id);
                var teacherSelect = $('#updateteacher_id');
                teacherSelect.append('<option value="' + classroom.teacher_id + '" selected>' + classroom.name + '</option>');




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

});
