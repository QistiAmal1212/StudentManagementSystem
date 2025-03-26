
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
            $('#deleteclass_room').submit();
        }
    });
    $(".sidebar-item.active").removeClass("active");
    $("#students").addClass("active");


    $('#selectAllCheckbox').click(function () {
        $('input[name="selectedClass[]"]').prop('checked', this.checked);
    });
    $(".sidebar-item.active").removeClass("active");
    $("#class_room").addClass("active");


    $('#selectAllCheckbox').click(function () {
        $('input[name="selectedClass[]"]').prop('checked', this.checked);
    });

    $('#deleteclass_room').submit(function (event) {
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

        var class_room_id = $(this).data('class-id');
        $.ajax({
            url: '/getclass_roomDetail'
            , type: 'GET'
            , data: {
                class_room_id: class_room_id

            }
            , success: function (class_room) {

                console.log(class_room);


                $('#updateModal').modal('show');
                $('#updateclass_name').val(class_room.class_name);
                $('#updateClassId').val(class_room.class_room_id);
                $('#updateForm').val(class_room.form);
                $('#updateteacher_id').val(class_room.teacher_id);
                var teacherSelect = $('#updateteacher_id');
                teacherSelect.append('<option value="' + class_room.teacher_id + '" selected>' + class_room.name + '</option>');




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
