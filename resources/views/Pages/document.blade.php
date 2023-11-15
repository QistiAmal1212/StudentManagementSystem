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
            <form method="post" id="formAdd" class="formAdd" action="{{ route('addDocument') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#333b46;">
                        <h5 class="modal-title" style="color:white;">Add New Document</h5>
                        <button type="button" style="color:white;" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div style="width:95%; margin-left:2.5%;">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">Upload File:</label>
                                <input class="form-control" type="file" id="file" name="file" required>
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
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header" style="background-color:white;">
                    <div>
                        <x-addbtn id="addBtn" />
                        <x-deletebtn id="deleteBtn" />


                        <input type="file" id="importFile" style="display: none;">
                    </div>
                </div>
                <form id="deleteDocument" class="deleteDocument" method="post" action="{{ route('deleteDocument') }}" enctype="multipart/form-data">
                    @method('DELETE')
                    @csrf
                    <div class="card-body" style="padding-right:15px;padding-left:15px;padding-top:10px;">
                        <div class="d-flex justify-content-between mb-3">

                        </div>
                        <table id="example" class="table table-striped table-bordered" style="width:100%; font-size:15px !important;">
                            <thead>
                                <tr>
                                    <th style="width:5%;"> <input type="checkbox" id="selectAllCheckbox" name="selectedClass[]" /></th>
                                    <th style="width:75%;">Title</th>
                                    <th style="width:25%;">view</th>
                                    {{-- <th style="width:5%;">Update</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @Foreach($documents as $documents)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selectedDocument[]" value="{{ $documents->documentId}}" />
                                    </td>
                                    <td>{{$documents->title }}</td>
                                    <td><a href="{{ $documents->documentPath}}">view document</a></td>
                                    {{-- <td>
                                        <center><i class="fas fa-edit"></i></center>

                                    </td> --}}
                                </tr>
                                @endforeach
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


            $('#selectAllCheckbox').click(function() {
                $('input[name="selectedDocument[]"]').prop('checked', this.checked);
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
        });

    </script>




</body>
</html>
@endsection
