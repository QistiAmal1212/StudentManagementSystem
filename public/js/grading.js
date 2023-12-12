$(document).ready(function () {
    $('#examSelect').on('change', function () {
        var Value = $('#examSelect').val();
        if (Value != "0") {
            $('#classRoomSelect').fadeIn();
            var selectInput = $('#classRoomSelect');



            $.ajax({
                url: '/getClassData'
                , type: 'GET'
                , data: {
                    examId: selectedValue,
                }
                , success: function (data) {

                    $("#classRoomSelect").empty();

                    data.forEach(function (classRoom) {
                        newelement += '<option value="' + classRoom.classroomId + '">' + classRoom.className + '</option>';
                    });

                    selectInput.append(newelement);

                }
                , error: function (error) {
                    console.error('Error:', error);
                }


            });
        }
        else {
            $('#classRoomSelect').fadeOut();
        }
    });

    $('#searchButton').on('click', function () {

        var selectedValue1 = $('#examSelect').val();
        var selectedValue2 = $('#classRoomSelect').val();
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
                    classroomId: selectedValue2,
                    examId: selectedValue1
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
                        '<th>English</th>' +
                        '<th>Math</th>' +
                        '<th>Science</th>' +
                        '<th>Sejarah</th>' +
                        '<th>edit</th>' +

                        '</tr>' +
                        '</thead>' +
                        '<tbody>';

                    data[1].forEach(function (studentResultPending) {
                        newelement +=
                            '<tr>' +
                            '<td>' + (studentResultPending.resultId) + '</td>' +
                            '<td>' + (studentResultPending.name) + '</td>' +
                            '<td>' + (studentResultPending.status) + '</td>' +
                            '<td>' + (studentResultPending.icNumber) + '</td>' +
                            '<td>' + (studentResultPending.average !== null ? studentResultPending.average : '-') + '</td>' +
                            '<td>' + (studentResultPending.Bahasa_Melayu !== null ? studentResultPending.Bahasa_Melayu : '-') + '</td>' +
                            '<td>' + (studentResultPending.English !== null ? studentResultPending.English : '-') + '</td>' +
                            '<td>' + (studentResultPending.Math !== null ? studentResultPending.Math : '-') + '</td>' +
                            '<td>' + (studentResultPending.Science !== null ? studentResultPending.Science : '-') + '</td>' +
                            '<td>' + (studentResultPending.Sejarah !== null ? studentResultPending.Sejarah : '-') + '</td>' +
                            '<td>  <center><i class="fas fa-edit updateBtn" data-student-id="' + studentResultPending.icNumber +
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
                        '<th>English</th>' +
                        '<th>Math</th>' +
                        '<th>Science</th>' +
                        '<th>Sejarah</th>' +
                        '<th>Edit</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';

                    data[0].forEach(function (studentResult) {
                        newelement +=
                            '<tr>' +
                            '<td>' + studentResult.resultId + '</td>' +
                            '<td>' + studentResult.name + '</td>' +
                            '<td>' + studentResult.status + '</td>' +
                            '<td>' + studentResult.icNumber + '</td>' +
                            '<td>' + (studentResult.average !== null ? studentResult.average : '-') + '</td>' +
                            '<td>' + (studentResult.Bahasa_Melayu !== null ? studentResult.Bahasa_Melayu : '-') + '</td>' +
                            '<td>' + (studentResult.English !== null ? studentResult.English : '-') + '</td>' +
                            '<td>' + (studentResult.Math !== null ? studentResult.Math : '-') + '</td>' +
                            '<td>' + (studentResult.Science !== null ? studentResult.Science : '-') + '</td>' +
                            '<td>' + (studentResult.Sejarah !== null ? studentResult.Sejarah : '-') + '</td>' +
                            '<td>  <center><i class="fas fa-edit updateBtn" data-student-id="' + studentResult.icNumber +
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
                $('#Bahasa_Melayu').val(studentResult.Bahasa_Melayu);
                $('#English').val(studentResult.English);
                $('#Math').val(studentResult.Math);
                $('#Science').val(studentResult.Science);
                $('#Sejarah').val(studentResult.Sejarah);
                $('#updateId').val(studentResult.icNumber);
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