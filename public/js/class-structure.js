$(document).ready(function () {
    $('#example').DataTable({

    });

    $(".sidebar-item.active").removeClass("active");
    $("#classStructure").addClass("active");


    $('#class').on('change', function () {
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
                , success: function (data) {
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

                    data.forEach(function (classStructure) {
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
                , error: function (error) {
                    console.error('Error:', error);
                }


            });
        }
    });
});