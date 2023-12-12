$(document).ready(function () {
    $('#example').DataTable({

    });


    $(".sidebar-item.active").removeClass("active");
    $("#exam").addClass("active");




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
});