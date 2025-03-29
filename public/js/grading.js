$(document).ready(function () {
    $('#examSelect').on('change', function () {
        var Value = $('#examSelect').val();
        if (Value != "0") {
            $('#classroomSelect').fadeIn();
            var selectInput = $('#classroomSelect');



            $.ajax({
                url: '/getClassData'
                , type: 'GET'
                , data: {
                    exam_id: selectedValue,
                }
                , success: function (data) {

                    $("#classroomSelect").empty();

                    data.forEach(function (classroom) {
                        newelement += '<option value="' + classroom.classroom_id + '">' + classroom.class_name + '</option>';
                    });

                    selectInput.append(newelement);

                }
                , error: function (error) {
                    console.error('Error:', error);
                }


            });
        }
        else {
            $('#classroomSelect').fadeOut();
        }
    });

    $('#searchButton').on('click', function () {

        var selectedValue1 = $('#examSelect').val();
        var selectedValue2 = $('#classroomSelect').val();
        var table = $('#cardT');


        if (selectedValue1 == "0" || selectedValue2 == "0") {
            alert("please fill all form");
            table.fadeOut();
            console.log('out');
        } else {
            table.fadeIn();
            console.log('in');


            $.ajax({
                url: '/getstudent_result'
                , type: 'GET'
                , data: {
                    classroom_id: selectedValue2,
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

                    data[1].forEach(function (student_resultPending) {
                        newelement +=
                            '<tr>' +
                            '<td>' + (student_resultPending.result_id) + '</td>' +
                            '<td>' + (student_resultPending.name) + '</td>' +
                            '<td>' + (student_resultPending.status) + '</td>' +
                            '<td>' + (student_resultPending.ic_number) + '</td>' +
                            '<td>' + (student_resultPending.average !== null ? student_resultPending.average : '-') + '</td>' +
                            '<td>' + (student_resultPending.bahasa_melayu !== null ? student_resultPending.bahasa_melayu : '-') + '</td>' +
                            '<td>' + (student_resultPending.english !== null ? student_resultPending.english : '-') + '</td>' +
                            '<td>' + (student_resultPending.math !== null ? student_resultPending.math : '-') + '</td>' +
                            '<td>' + (student_resultPending.science !== null ? student_resultPending.science : '-') + '</td>' +
                            '<td>' + (student_resultPending.sejarah !== null ? student_resultPending.sejarah : '-') + '</td>' +
                            '<td>  <center><i class="fas fa-edit updateBtn" data-student-id="' + student_resultPending.ic_number +
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

                    data[0].forEach(function (student_result) {
                        newelement +=
                            '<tr>' +
                            '<td>' + student_result.result_id + '</td>' +
                            '<td>' + student_result.name + '</td>' +
                            '<td>' + student_result.status + '</td>' +
                            '<td>' + student_result.ic_number + '</td>' +
                            '<td>' + (student_result.average !== null ? student_result.average : '-') + '</td>' +
                            '<td>' + (student_result.bahasa_melayu !== null ? student_result.bahasa_melayu : '-') + '</td>' +
                            '<td>' + (student_result.english !== null ? student_result.english : '-') + '</td>' +
                            '<td>' + (student_result.math !== null ? student_result.math : '-') + '</td>' +
                            '<td>' + (student_result.science !== null ? student_result.science : '-') + '</td>' +
                            '<td>' + (student_result.sejarah !== null ? student_result.sejarah : '-') + '</td>' +
                            '<td>  <center><i class="fas fa-edit updateBtn" data-student-id="' + student_result.ic_number +
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
            url: '/getstudent_result2'
            , type: 'GET'
            , data: {
                studentIc: studentIc

            }
            , success: function (student_result) {

                console.log(student_result);


                $('#updateModal').modal('show');
                $('#name').val(student_result.name);
                $('#bahasa_melayu').val(student_result.bahasa_melayu);
                $('#english').val(student_result.english);
                $('#math').val(student_result.math);
                $('#science').val(student_result.science);
                $('#sejarah').val(student_result.sejarah);
                $('#updateId').val(student_result.ic_number);
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
