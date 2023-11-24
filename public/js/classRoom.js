
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
            $('#deleteClassRoom').submit();
        }
    });
    $(".sidebar-item.active").removeClass("active");
    $("#students").addClass("active");


    $('#selectAllCheckbox').click(function () {
        $('input[name="selectedClass[]"]').prop('checked', this.checked);
    });
    $(".sidebar-item.active").removeClass("active");
    $("#classRoom").addClass("active");


    $('#selectAllCheckbox').click(function () {
        $('input[name="selectedClass[]"]').prop('checked', this.checked);
    });

    $('#deleteClassRoom').submit(function (event) {
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

        var classRoomId = $(this).data('class-id');
        $.ajax({
            url: '/getClassRoomDetail'
            , type: 'GET'
            , data: {
                classRoomId: classRoomId

            }
            , success: function (classRoom) {

                console.log(classRoom);


                $('#updateModal').modal('show');
                $('#updateClassName').val(classRoom.className);
                $('#updateClassId').val(classRoom.classroomId);
                $('#updateForm').val(classRoom.form);
                $('#updateTeacherId').val(classRoom.teacherId);
                var teacherSelect = $('#updateTeacherId');
                teacherSelect.append('<option value="' + classRoom.teacherId + '" selected>' + classRoom.name + '</option>');




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
