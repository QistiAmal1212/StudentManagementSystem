$(document).ready(function () {
    $('#example').DataTable({

    });

    $('#deleteBtn').click(function () {
        console.log("delete button has been click");
        if ($('input[name="selectedDocument[]"]:checked').length === 0) {
            Swal.fire({
                icon: 'error'
                , title: 'No Document Selected'
                , text: 'Please select at least one document to delete.'
            });
        } else {
            $('#deleteDocument').submit();
        }
    });

    $(".sidebar-item.active").removeClass("active");
    $("#document").addClass("active");


    $('#selectAllCheckbox').click(function () {
        $('input[name="selectedDocument[]"]').prop('checked', this.checked);
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
});
