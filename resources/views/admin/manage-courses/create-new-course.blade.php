@extends('layouts/contentNavbarLayout')

@section('title', $sub_heading)

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatable-bootstrap5.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('assets/js/form-select.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
    <script src="{{ asset('assets/js/datatable-bootstrap5.js') }}"></script>
@endsection

@section('content')

    <style>
        input[type="checkbox"] {
            height: 25px !important;
            width: 25px !important;
            border: none;
        }

        table {
            border-collapse: unset !important;
        }

        .category-time-table th {
            width: 50%;
            border-radius: 4px;
        }

        .category-time-table td {
            padding-left: 10px;
            padding-right: 0;
        }


        .category-time-table input[type="text"] {
            border-radius: 0%;
        }

        .category-time-table select {
            border-radius: 0%;
        }

        select {
            background-image: url('{{ asset('assets/img/icons/down-arrow.png') }}');
            background-repeat: no-repeat;
            background-position-x: 98%;
            background-position-y: center;
            padding-right: 20px;
        }

        select.open {
            background-image: url('{{ asset('assets/img/icons/up-arrow.png') }}');
        }

        #successPopup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
        }

        #succ_mess {
            margin-top: 10px;
        }

        .dtable {
            background-color: #eceef1;
        }

        .modal img {
            max-width: 100%;
            height: auto;
        }

        #testsTable th,
        #testsTable td {
            border: 1px solid #ddd;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .checkbox-item input {
            margin-right: 10px;
        }

        table thead th {
            pointer-events: none;
        }
    </style>


    <div class="card">
        <div class="container">
            <div class="card-body">
                <form action="{{ route('save-course') }}" method="POST">
                    @csrf
                    {{-- Add test fields --}}
                    <div class="col-12 fw-bold">
                        <div class="row  mb-3 ms-2">

                            <div class="col-md-6  text-center">
                                <label for="title" class="mb-2">Title <span class="text-danger">
                                        *</span></label>
                                <input type="text" style="height:45px" name="course_name" id="title"
                                    class="form-control mb-3" placeholder="Title" required>
                            </div>

                            <div class="col-md-3  text-center">
                                <label for="validity_from" class="mb-2">Validity From <span class="text-danger">
                                        *</span></label>
                                <input type="date" style="height:45px" name="validity_from" id="validity_from"
                                    class="form-control mb-3" required>
                            </div>
                            <div class="col-md-3  text-center">
                                <label for="validity_to" class="mb-2">Validity To <span class="text-danger">
                                        *</span></label>
                                <input type="date" style="height:45px" name="validity_to" id="validity_to"
                                    class="form-control mb-3" required>
                            </div>
                            <br>

                        </div>
                        <div class="visibility-view col-12">
                            <div style="background-color:#f9fafb" class="card">
                                <div class="ms-2 mx-3  ">
                                    <div class="form-repeater">
                                        <div class="d-flex background-secondary  " style="align-items: center;">
                                            <div class="mb-3 col text-center mb-0">
                                                <label class="form-label text-white" for="form-repeater-1-1"><b
                                                        style="  position: relative;bottom: -10px;">College</b></label>
                                            </div>
                                            <div class="mb-3 col text-center mb-0">
                                                <label class="form-label text-white" for="form-repeater-1-1"><b
                                                        style="  position: relative;bottom: -10px;">department</b></label>
                                            </div>
                                            <div class="mb-3 col text-center mb-0">
                                                <label class="form-label text-white" for="form-repeater-1-1"><b
                                                        style="  position: relative;bottom: -10px;">year</b></label>
                                            </div>
                                            <div class="mb-3 col text-center mb-0">
                                                <label class="form-label text-white" for="form-repeater-1-1"><b
                                                        style="  position: relative;bottom: -10px;">select
                                                        group</b></label>
                                            </div>
                                            <div class="mb-3 col text-center mb-0">
                                                <label class="form-label text-white" for="form-repeater-1-1"><b
                                                        style="  position: relative;bottom: -10px;">actions</b></label>
                                            </div>
                                        </div>
                                        <div class="form-repeater-group" data-repeater-list="group-a">
                                            <div data-repeater-item>
                                                <div class="row rows-div mt-1">
                                                    <div class=" mb-2 col mb-0">
                                                        <label class="form-label" for="form-repeater-1-1"><b></b></label>
                                                        <div class="d-flex align-items-center">
                                                            <select name="colleges" class="form-control colleges">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class=" mb-2 col mb-0">
                                                        <label class="form-label" for="form-repeater-1-1"><b></b></label>
                                                        <div class="d-flex align-items-center">
                                                            <select name="departments" class="form-control departments">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class=" mb-2 col mb-0">
                                                        <label class="form-label" for="form-repeater-1-1"><b></b></label>
                                                        <div class="d-flex align-items-center">
                                                            <select name="year" class="form-control year">
                                                                <option value=" " selected>SELECT
                                                                </option>
                                                                <option value="1">1st Year</option>
                                                                <option value="2">2nd Year</option>
                                                                <option value="3">3rd Year</option>
                                                                <option value="4">4th Year</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class=" mb-2 col mb-0">
                                                        <label class="form-label" for="form-repeater-1-1"><b></b></label>
                                                        <div class=" select2-dark">
                                                            <select id="select2Darks" name="groups"
                                                                class=" select-id-change form-select group-select"
                                                                multiple>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="text-center pt-0 col-lg-2 ">
                                                        <button type="button" style="margin-top:24px"
                                                            class="btn background-info text-white " data-repeater-delete>
                                                            -
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-5 ms-3">
                                            <button type="button" class="btn background-secondary add-btn text-white"
                                                id="changeIdButton" data-repeater-create>
                                                <i class="bx bx-plus me-1"></i>
                                                <span class="align-middle">Add</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex mt-3 ">
                                {{-- <button type="button" style="background-color:#cd0000"
                                    class="btn text-white mx-4">Create
                                    Course</button> --}}
                                <button type="button" style="background-color:#cd0000" data-bs-toggle="modal"
                                    onclick="openTestModal()" data-bs-target="#testModal" class="btn text-white ms-4">Add
                                    Test</button>
                            </div>

                            <br>
                        </div>

                        <div class="mt-3 test_append_div">

                        </div>

                        <br>


                        <div class="mt-5 d-flex justify-content-end">
                            <button type="submit" onclick="$('form').submit()"
                                class="btn background-secondary text-white">Submit</button>
                        </div>


                    </div>

                    <div class="modal fade" id="testModal" tabindex="-1" data-bs-backdrop="static"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="staticBackdropLabel">Select Tests</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row col-12">
                                        <table id="testsTable" style=""
                                            class="table table-striped table-bordered display ">
                                            <thead>
                                                <tr>
                                                    <th>Select</th>
                                                    <th>Title</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tests as $tt)
                                                    <tr>

                                                        <td>
                                                            <input style="height:30px;width:30px;" type="checkbox"
                                                                name="select_test[]" class="select-test"
                                                                onclick="test_params(this.value)"
                                                                value="{{ $tt->test_code }},{{ $tt->title }}"
                                                                id="{{ $tt->test_code }}">
                                                        </td>
                                                        <td><label
                                                                for="{{ $tt->test_code }}">{{ strtoupper($tt->title) }}</label>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn  background-secondary text-white"
                                        data-bs-dismiss="modal" aria-label="Close" id="tests-submit">OK</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <script>
        $(document).keypress(
            function(event) {
                if (event.which == '13') {
                    event.preventDefault();
                }
            });


        function openTestModal() {

            var existingTable = $('#testsTable').DataTable();
            existingTable.destroy();

            $('#testsTable').DataTable({
                pageLength: 6,
                orderable: false,
                searchable: false
            });
            $("th").removeClass("sorting");
            $(".dataTables_length").parent().remove();
        }


        let timerInterval;

        function showSuccessPopup(message, time_limit, type) {
            Swal.fire({
                title: message,
                timer: time_limit,
                icon: type,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    $(".swal2-loader").css('display', 'none');
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            })
        }

        var selectedTests = [];

        function test_params(value) {
            var index = selectedTests.indexOf(value);
            if (index === -1) {
                selectedTests.push(value);
            } else {
                selectedTests.splice(index, 1);
            }
            add_tests(selectedTests);
        }



        function add_tests(tests) {

            var rows = '';
            tests.forEach((test, i) => {
                var testCode = test.split(',')[0];
                var title = test.split(',')[1];

                rows += `
                                <div class="row col-12 mb-3">
                                <div class="col-md-3">
                                    <input type="hidden" name="test_code[]" class="form-control test_code${i}" value="${testCode}" >
                                    <input type="text"  name="title[]" class="form-control test_title${i}" value="${title}" readonly>
                                </div>
                                <input type="hidden" name="test_group_name[]" class="form-control test_group_name${i}" >
                                <input type="hidden" name="shuffle_ques[]" class="form-control shuffle_ques${i}" >
                                <input type="hidden" name="dis_fin_btn[]" class="form-control dis_fin_btn${i}" >
                                <input type="hidden" name="re_att[]" class="form-control re_att${i}" >
                                <input type="hidden" name="start_test_date[]" class="form-control start_test_date${i}" >
                                <input type="hidden" name="end_test_date[]" class="form-control end_test_date${i}" >
                                <input type="hidden" name="display_result[]" class="form-control display_result${i}" >
                                <input type="hidden" name="select_reattempt[]" class="form-control select_reattempt${i}" >
                                <input type="hidden" name="display_result_date[]" class="form-control display_result_date${i}" >

                                <div class="col-md-2">
                                <button type="button" style="background-color:#cd0000" class="btn text-white openParamButton"
                                    onclick="openParamsModal(${i})" class="btn text-white ms-4">Set Parameters</button>
                                    <i title='Please Fill the Parameter..!' style='cursor:pointer;color:red' class='bx bxs-info-circle icon-info${i}' ></i>
                                    <i title='Validated..!' style='cursor:pointer;color:green;display:none' class='bx bxs-check-circle icon-check${i}'></i>
                                </div>
                                <div class="col-md-2">
                                <button type="button" style="background-color:#cd0000" onclick="openNegativeModal(${i})" 
                                    class="btn text-white ms-4">Add -Ve Marks 
                                    </button>

                                    <input type="hidden" name="input_negative_marks[]" class="form-control input_negative_marks${i}" >
                                <input type="hidden" name="input_question_code[]" class="form-control input_question_code${i}" >
                                </div>
                              
                                <br>
                                </div>

                                <div class="modal fade" id="openParamsModal${i}" tabindex="-1" data-bs-backdrop="static"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body ms-4 mx-4">
                                    <div class="form-div">

                                        <div class="row col-12">
                                            <label for="testGroupTitle">Group Title</label>
                                            <input type="text" class="ms-3 form-control mb-3" placeholder="Enter Group Title" id="testGroupTitle" name="test_group_title">
                                        </div>

                                        <div class="row   col-12">
                                            <div class="col">
                                                <label for="">Start Date Time</label>
                                                <input type="datetime-local" name="start_date_time" id=""
                                                    class="form-control">
                                            </div>
                                            <div class="col text-center">
                                                <span class="fw-bold">to</span>
                                            </div>
                                            <div class="col">
                                                <label for="">End Date Time</label>
                                                <input type="datetime-local" name="end_date_time" id=""
                                                    class="form-control">

                                            </div>
                                        </div>
                                        <br>
                                        <input type="hidden" name="index" id="index" class="form-control">
                                        <div class="row col-12">
                                            <div class="col-md-6 "
                                                style="border: 2px solid rgb(116, 119, 119); padding: 15px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                                <div class="mt-3 checkbox-item">
                                                    <input type="checkbox" name="shuffle_questions" id="shuffleQuestions"
                                                        value="1">
                                                    <label for="shuffleQuestions">Shuffle Questions</label>
                                                </div>
                                                <div class="mt-3 checkbox-item">
                                                    <input type="checkbox" name="disable_finish_button"
                                                        id="disableFinishButton" value="1">
                                                    <label for="disableFinishButton">Disable Finish Button</label>
                                                </div>
                                                <div class="mt-3 checkbox-item">
                                                    <label for="reAttempts">Re-Attempts</label>
                                                    <select style="width:95px" name="re_attempts"
                                                        class="ms-2 form-control" id="">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="Unlimited">Unlimited</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">

                                            </div>
                                            <div class="col-md-5"
                                                style="border: 2px solid rgb(116, 119, 119); padding: 15px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                                <h6>Display Result</h6>
                                                <div class="">
                                                    <input type="radio" name="result_status" id="immediate_result"  checked 
                                                        value="1">
                                                    <label for="immediate_result">Immediate</label>
                                                </div>

                                                <div class="">
                                                    <input type="radio" name="result_status" id="display_later"
                                                        value="2">
                                                    <label for="display_later">Later</label>
                                                    <input style="width:200px" type="datetime-local" name="result_date"
                                                        class="form-control" id="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn  background-secondary text-white"
                                        data-bs-dismiss="modal" aria-label="Close" onclick="param_value_update()"
                                        id="tests-submit">UPDATE</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="openNegativeMarkModal${i}" tabindex="-1" data-bs-backdrop="static"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="staticBackdropLabel">Select Tests</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row col-12">
                                        <table id="negativeMarkentry${i}" 
                                            class="table table-striped table-bordered display ">
                                            <thead>
                                                    <th>Questions Code</th>
                                                    <th>Questions</th>
                                                    <th>Negative Mark</th>
                                            </thead>
                                            <tbody class='neg_body${i}'>
                                              
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" onclick="store_negative_marks(${i})" class="btn store_negative_marks${i} background-secondary text-white"
                                      id="">OK</button>
                                </div>

                            </div>
                        </div>
                    </div>


                                `;
            });
            $(".test_append_div").html(rows);
        }


        function store_negative_marks(index) {
            var question_code_array = [];
            var negativeMarksArray = [];

            var table = $('#negativeMarkentry' + index).DataTable();

            table.rows().data().each(function(rowData) {
                var question_code_values = rowData[0];
                question_code_array.push(question_code_values);
            });
            table.column(2).nodes().each(function(cell, i) {
                var negativeMarksValue = $(cell).find('.negative_marks' + index).val();
                negativeMarksArray.push(negativeMarksValue);
            });
            $(".input_question_code" + index).val(question_code_array);
            $(".input_negative_marks" + index).val(negativeMarksArray);

            $("#openNegativeMarkModal" + index).modal('hide');
        }

        function openParamsModal(index) {
            $("#index").val(index);
            $("#openParamsModal" + index).modal('show');
        }

        function param_value_update() {
            var shuffle_questions;
            var disable_finish_button;
            var result_date;
            var index = $("#index").val();
            var display_result = $("input[type='radio']:checked").val();

            if ($("input[name='shuffle_questions']:checked").length > 0) {
                shuffle_questions = $("input[name='shuffle_questions']:checked").val();
            } else {
                shuffle_questions = 0;
            }

            if ($("input[name='disable_finish_button']:checked").length > 0) {
                disable_finish_button = $("input[name='disable_finish_button']:checked").val();
            } else {
                disable_finish_button = 0;
            }

            if (display_result == 1) {
                result_date = 0;
            } else {
                result_date = $("input[name='result_date']").val();
            }

            var test_group_name = $("input[name='test_group_title']").val();

            $(".test_group_name" + index).val(test_group_name);
            $(".shuffle_ques" + index).val(shuffle_questions);
            $(".dis_fin_btn" + index).val(disable_finish_button);
            $(".re_att" + index).val($("select[name='re_attempts']").val());
            $(".start_test_date" + index).val($("input[name='start_date_time']").val());
            $(".end_test_date" + index).val($("input[name='end_date_time']").val());
            $(".display_result" + index).val(display_result);
            $(".display_result_date" + index).val(result_date);
            $(".icon-info" + index).hide();
            $(".icon-check" + index).show();
            openNegativeModal(index);
        }


        function openNegativeModal(index) {
            $(".neg_body" + index).empty();
            var test_code = $(".test_code" + index).val();
            $.ajax({
                url: "{{ route('get-test-questions') }}",
                type: "GET",
                data: {
                    test_code: test_code,
                    index: index
                },
                success: (data) => {
                    $(".neg_body" + index).append(data);
                    $("#openNegativeMarkModal" + index).modal('show');
                    var existingTable = $('#negativeMarkentry' + index).DataTable();
                    existingTable.destroy();
                    $("#negativeMarkentry" + index).DataTable({
                        pageLength: 50,
                        orderable: false,
                        searchable: false,
                    });
                    $("th").removeClass("sorting");
                    $(`#negativeMarkentry${index}_length`).parent().parent().remove();
                },
                error: (xhr) => {
                    alert('Something went wrong!');
                }
            })
        }

        $(document).ready(function() {

            $.ajax({
                url: "{{ route('ajax-get-colleges') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var html =
                        '<option value="" selected  >SELECT</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].college_id +
                            '">' +
                            data[i].college_name +
                            '</option>';
                    }

                    $('.colleges').map(function() {
                        if (!$(this).val()) {
                            $(this).html(html);
                        }
                    });

                },
                error: function(data) {
                    console.log('Error:', data);
                }
            })

            $.ajax({
                url: "{{ route('ajax-get-departments') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var html =
                        '<option value="" selected  >SELECT</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].department_id +
                            '">' + data[i].department_name +
                            '</option>';
                    }
                    $('.departments').map(function() {
                        if (!$(this).val()) {
                            $(this).html(html);
                        }
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            })
        });



        function showSuccessPopup(message, color) {
            var successPopup = document.getElementById('successPopup');
            successPopup.style.display = 'block';
            successPopup.style.backgroundColor = color;
            $("#succ_mess").text(message);
            setTimeout(function() {
                successPopup.style.display = 'none';
            }, 3000);
        }


        function date_val(value) {
            $("#end-date").prop('min', value);
            $("#end-date").val("");
        }

        var groups = @json($groups);

        $(document).ready(function() {
            $('.container').on('change', '.colleges , .departments , .year', function() {
                var nameAttribute = $(this).attr('name');
                var match = nameAttribute.match(/\[([0-9]+)\]/);
                var newRow = $(this).parent().parent().parent().parent();
                var collegesDropdown = newRow.find('.colleges');
                var departmentsDropdown = newRow.find('.departments');
                var yearDropdown = newRow.find('.year');
                var groupsDropdown = newRow.find('.group-select');
                var selectedCollege = collegesDropdown.val();
                var selectedDepartment = departmentsDropdown.val();
                var selectedYear = yearDropdown.val();
                if (selectedCollege !== null && selectedDepartment !== null &&
                    selectedYear !==
                    null) {
                    var filteredGroups = groups.filter(function(group) {
                        return group.college_id == selectedCollege &&
                            group.department_id == selectedDepartment &&
                            group.year == selectedYear;
                    });
                    groupsDropdown.empty();
                    groupsDropdown.append('<option value="all">All</option>');
                    $.each(filteredGroups, function(index, value) {
                        groupsDropdown.append(
                            '<option value="' + value.group_id + '">' + value
                            .group_name +
                            '</option>');
                    });
                }
            });

        });


        $(document).ready(function() {

            $(".add-btn,#visibility").on('click change', () => {
                setTimeout(() => {
                    $.ajax({
                        url: "{{ route('ajax-get-colleges') }}",
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var html =
                                '<option value=" " selected disabled>SELECT</option>';
                            var i;
                            for (i = 0; i < data.length; i++) {
                                html += '<option value="' + data[i].college_id +
                                    '">' +
                                    data[i].college_name +
                                    '</option>';
                            }

                            $('.colleges').map(function() {
                                if (!$(this).val()) {
                                    $(this).html(html);
                                }
                            });

                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    })

                    $.ajax({
                        url: "{{ route('ajax-get-departments') }}",
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var html =
                                '<option value=" " selected disabled>SELECT</option>';
                            var i;
                            for (i = 0; i < data.length; i++) {
                                html += '<option value="' + data[i].department_id +
                                    '">' + data[i].department_name +
                                    '</option>';
                            }
                            $('.departments').map(function() {
                                if (!$(this).val()) {
                                    $(this).html(html);
                                }
                            });
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    })
                }, 200);

            });


            setTimeout(() => {
                var selects = $("select.select-id-change");
                selects.each(function(i, select) {
                    $(select).select2({
                        placeholder: "SELECT GROUPS",
                        allowClear: true
                    });
                });
            }, 200);
            $('#changeIdButton').on('click', () => {
                setTimeout(() => {
                    var selects = $("select.select-id-change");
                    selects.each(function(i, select) {
                        $(select).select2({
                            placeholder: "SELECT GROUPS",
                            allowClear: true
                        });
                    });
                }, 1);
            });

        });

        function visible_change(value) {
            if (value == 1) {
                $('.visibility-view').show();
            } else {
                $('.visibility-view').hide();
            }
        }


        function questiontype(value) {
            if (value == 1) {
                $(".question-select-module").show();
                $(".random-question-module").hide();
            } else {
                $(".random-question-module").show();
                $(".question-select-module").hide();
            }
        }


        function solution_show(val) {
            if (val.value == 3 && val.checked) {
                $("#solution_show_date").show();
                $("#solution-date").prop('required', true)
            } else {
                $("#solution_show_date").hide();
                $("#solution-date").prop('required', false)
            }
        }
    </script>


@endsection
