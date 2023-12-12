@extends('layouts.main')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">
</head>

<body>

    <x-statusMessage />
    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form method="post" id="formAdd" class="formAdd" action="{{ route('addExam') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#333b46;">
                        <h5 class="modal-title" style="color:white;">Add New Exam</h5>
                        <button type="button" style="color:white;" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div style="width:95%; margin-left:2.5%;">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="form">Form:</label>
                                <input type="number" class="form-control" id="form" name="form" min="1" max="6" required>
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
                    </div>
                </div>

                <div class="card-body" style="padding-right:15px;padding-left:15px;padding-top:10px;">
                    <div class="d-flex justify-content-between mb-3">

                    </div>
                    <table id="example" class="table table-striped table-bordered" style="width:100%; font-size:15px !important;">
                        <thead>
                            <tr>
                                <th style="width:70%;">Exam Title</th>
                                <th style="width:25%;">Form</th>
                                <th style="width:5%;">Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exam as $exam)
                            <tr>

                                <td>{{ $exam->title }}</td>
                                <td>{{ $exam->form }}</td>
                                <td>
                                    <center><i class="fas fa-edit"></i></center>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="js/exam.js"></script>

</body>
</html>
@endsection
