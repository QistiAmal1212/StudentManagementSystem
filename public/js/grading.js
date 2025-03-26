$(document).ready(function () {
    $('#examSelect').on('change', function () {
        var Value = $('#examSelect').val();
        if (Value != "0") {
            $('#class_roomSelect').fadeIn();
            var selectInput = $('#class_roomSelect');



            $.ajax({
                url: '/getClassData'
                , type: 'GET'
                , data: {
                    exam_id: selectedValue,
                }
                , success: function (data) {

                    $("#class_roomSelect").empty();

                    data.forEach(function (class_room) {
                        newelement += '<option value="' + class_room.class_room_id + '">' + class_room.class_name + '</option>';
                    });

                    selectInput.append(newelement);

                }
                , error: function (error) {
                    console.error('Error:', error);
                }


            });
        }
        else {
            $('#class_roomSelect').fadeOut();
        }
    });

    $('#searchButton').on('click', function () {

        var selectedValue1 = $('#examSelect').val();
        var selectedValue2 = $('#class_roomSelect').val();
        var table = $('#cardT');


        if (selectedValue1 == "0" || selectedValue2 == "0") {
            alert("please fill all form");
            table.fadeOut();
            console.log('out');
        } else {
            table.fadeIn();
            console.log('in');


            $.ajax({
                url: '/getStudentResult'
                , type: 'GET'
                , data: {
                    class_room_id: selectedValue2,
                    exam_id: selectedValue1
                }
                , success: function (data) {
                    var resultTable = $('#cardtable');
                    resultTable.empty(); // Clear existing table data if any


                    var newelement =

                        '<table id="example" class="table table-striped table-bordered" style="width:100%; font-size:15px !important;">' +
                        ' <thead>' +
                        '<tr>' +
                        '<th>result ID</th>' +
                        '<th>name</th>' +
                        '<th>status</th>' +
                        '<th>Ic Number</th>' +
                        '<th>average</th>' +
                        '<th>Malay</th>' +
                        '<th>english</th>' +
                        '<th>math</th>' +
                        '<th>science</th>' +
                        '<th>sejarah</th>' +
                        '<th>edit</th>' +

                        '</tr>' +
                        '</thead>' +
                        '<tbody>';

                    data[1].forEach(function (studentResultPending) {
                        newelement +=
                            '<tr>' +
                            '<td>' + (studentResultPending.result_id) + '</td>' +
                            '<td>' + (studentResultPending.name) + '</td>' +
                            '<td>' + (studentResultPending.status) + '</td>' +
                            '<td>' + (studentResultPending.ic_number) + '</td>' +
                            '<td>' + (studentResultPending.average !== null ? studentResultPending.average : '-') + '</td>' +
                            '<td>' + (studentResultPending.bahasa_melayu !== null ? studentResultPending.bahasa_melayu : '-') + '</td>' +
                            '<td>' + (studentResultPending.english !== null ? studentResultPending.english : '-') + '</td>' +
                            '<td>' + (studentResultPending.math !== null ? studentResultPending.math : '-') + '</td>' +
                            '<td>' + (studentResultPending.science !== null ? studentResultPending.science : '-') + '</td>' +
                            '<td>' + (studentResultPending.sejarah !== null ? studentResultPending.sejarah : '-') + '</td>' +
                            '<td>  <center><i class="fas fa-edit updateBtn" data-student-id="' + studentResultPending.ic_number +
                            '"></i></center></td>' +
                            '</tr>';
                    });
                    newelement += '</tbody></table>';
                    newelement += '<table id="example2" class="table table-striped table-bordered" style="width:100%; font-size:15px !important;display:none;">' +
                        ' <thead>' +
                        '<tr>' +
                        '<th>result ID</th>' +
                        '<th>name</th>' +
                        '<th>status</th>' +
                        '<th>Ic Number</th>' +
                        '<th>average</th>' +
                        '<th>Malay</th>' +
                        '<th>english</th>' +
                        '<th>math</th>' +
                        '<th>science</th>' +
                        '<th>sejarah</th>' +
                        '<th>Edit</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';

                    data[0].forEach(function (studentResult) {
                        newelement +=
                            '<tr>' +
                            '<td>' + studentResult.result_id + '</td>' +
                            '<td>' + studentResult.name + '</td>' +
                            '<td>' + studentResult.status + '</td>' +
                            '<td>' + studentResult.ic_number + '</td>' +
                            '<td>' + (studentResult.average !== null ? studentResult.average : '-') + '</td>' +
                            '<td>' + (studentResult.bahasa_melayu !== null ? studentResult.bahasa_melayu : '-') + '</td>' +
                            '<td>' + (studentResult.english !== null ? studentResult.english : '-') + '</td>' +
                            '<td>' + (studentResult.math !== null ? studentResult.math : '-') + '</td>' +
                            '<td>' + (studentResult.science !== null ? studentResult.science : '-') + '</td>' +
                            '<td>' + (studentResult.sejarah !== null ? studentResult.sejarah : '-') + '</td>' +
                            '<td>  <center><i class="fas fa-edit updateBtn" data-student-id="' + studentResult.ic_number +
                            '"></i></center></td>' +
                            '</tr>';
                    });


                    newelement += '</tbody></table>';



                    resultTable.append(newelement);




                    $('#example').DataTable({

                    });



                    // Handle button click event to switch tables
                    $(".switch1").on("click", function () {
                        $("#example2").DataTable().destroy();
                        $("#example2").hide();

                        $("#example").show();
                        $("#example").DataTable({

                        });

                    });
                    $(".switch2").on("click", function () {
                        $("#example").DataTable().destroy();
                        $("#example").hide();

                        $("#example2").show();
                        $("#example2").DataTable({

                        });
                    });




                }
                , error: function (error) {
                    console.error('Error:', error);
                }


            });
        }
    });




    $(document).on('click', '.updateBtn', function () {
        console.log("update button clicked.");

        var studentIc = $(this).data();
        console.log(studentIc);
        $.ajax({
            url: '/getStudentResult2'
            , type: 'GET'
            , data: {
                studentIc: studentIc

            }
            , success: function (studentResult) {

                console.log(studentResult);


                $('#updateModal').modal('show');
                $('#name').val(studentResult.name);
                $('#bahasa_melayu').val(studentResult.bahasa_melayu);
                $('#english').val(studentResult.english);
                $('#math').val(studentResult.math);
                $('#science').val(studentResult.science);
                $('#sejarah').val(studentResult.sejarah);
                $('#updateId').val(studentResult.ic_number);
                calculateAverage();
            }
            , error: function (error) {
                console.error(error);
            }
        });
    });



    function calculateAverage() {
        var total = 0;
        var count = 0;
        var hasFailed = false;

        $('.grade-input').each(function () {
            var value = parseFloat($(this).val());
            if (!isNaN(value)) {
                total += value;
                count++;

                // Check if any grade is below 40
                if (value < 40) {
                    hasFailed = true;
                }
            }
            else {
                hasFailed = true;
            }
        });

        var average = count > 0 ? total / count : 0;
        $('#avg').text(average.toFixed(2));

        // Update pass/fail status
        var passFail = hasFailed ? 'Fail' : 'Pass';
        $('#status').text(passFail);
    }

    $('.grade-input').on('input', function () {
        calculateAverage();
    });




    $('#updateModal').on('click', '.close', function () {
        $('#updateModal').modal('hide');
    });

    $('#updateModal').on('click', '#close2', function () {
        $('#updateModal').modal('hide');
    });



    $(".sidebar-item.active").removeClass("active");
    $("#grading").addClass("active");

});
