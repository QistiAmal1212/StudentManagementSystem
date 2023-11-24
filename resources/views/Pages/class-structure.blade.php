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


    <div class="row">
        <div class="col-12">
            <div class="card" style="padding:20px; background-color:white;">
                <label for="class">Choose Class:</label>
                <select id="class" name="classId" class="form-select" aria-label="Default select example">
                    <option value="0">-----</option>
                    @foreach($classRoom as $classRoom)
                    <option value="{{ $classRoom->classroomId }}">{{ $classRoom->className }}</option>
                    @endforeach

                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

            <div class="card" id="cardT" style="display:none;">
                <div class="card-header" style="background-color:white;">
                    <div>
                        <a id="routeLink1" href="{{ route('exportExcelClassStructure', ['classId' => ":classId"]) }}">
                            <x-excelbtn />
                        </a>

                        <a id="routeLink2" href="{{ route('exportPdfClassStructure', ['id' => ":classId"]) }}">
                            <x-pdfbtn />
                        </a>



                    </div>
                </div>
                <div id="cardtable" class="card-body" style="padding-right:15px;padding-left:15px;padding-top:10px;">
                    <div class="d-flex justify-content-between mb-3">

                    </div>




                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({

            });

            $(".sidebar-item.active").removeClass("active");
            $("#classStructure").addClass("active");


            $('#class').on('change', function() {
                var selectedValue = $(this).val();
                var table = $('#cardT');


                if (selectedValue == "0") {
                    table.fadeOut();


                } else {
                    table.fadeIn();
                    var selectedValue = $('#class').val();

                    $.ajax({
                        url: '/getclassStructure'
                        , type: 'GET'
                        , data: {
                            classId: selectedValue
                        }
                        , success: function(data) {
                            var classStructureTable = $('#cardtable'); // Use #example ID
                            classStructureTable.empty(); // Clear existing table data if any
                            var exportPdfLink2 = '{{ route("exportPdfClassStructure", ["id" => ":classId"]) }}';
                            exportPdfLink2 = exportPdfLink2.replace(':classId', selectedValue);

                            var exportPdfLink1 = '{{ route("exportExcelClassStructure", ["id" => ":classId"]) }}';
                            exportPdfLink1 = exportPdfLink1.replace(':classId', selectedValue);

                            var newelement =

                                '<table id="example" class="table table-striped table-bordered" style="width:100%; font-size:15px !important;">' +
                                ' <thead>' +
                                '<tr>' +
                                ' <th colspan="2" style="font-weight:normal !important;"> Class Name : ' + data[0].className + '</th>' +
                                '  <th colspan="3" style="font-weight:normal !important;">Class Teacher : ' + data[0].teacher_name + '</th>' +
                                '</tr>' +
                                '<tr>' +
                                '<th>student name</th>' +
                                '<th>Ic number</th>' +
                                '<th>No Tell</th>' +
                                '<th>Email</th>' +
                                '<th>Family Income</th>' +
                                '</tr>' +
                                '</thead>' +
                                '<tbody>';

                            data.forEach(function(classStructure) {
                                newelement +=
                                    '<tr>' +
                                    '<td>' + classStructure.name + '</td>' +
                                    '<td>' + classStructure.icNumber + '</td>' +
                                    '<td>' + classStructure.noTell + '</td>' +
                                    '<td>' + classStructure.email + '</td>' +
                                    '<td>' + classStructure.familyIncome + '</td>' +
                                    '</tr>';
                            });

                            newelement += '</tbody></table>';

                            classStructureTable.append(newelement);
                            $('#routeLink1').attr('href', exportPdfLink1);
                            $('#routeLink2').attr('href', exportPdfLink2);
                            $('#example').DataTable();

                        }
                        , error: function(error) {
                            console.error('Error:', error);
                        }


                    });
                }
            });
        });

    </script>

</body>
</html>
@endsection
