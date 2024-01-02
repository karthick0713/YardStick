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
    <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
@endsection

@section('content')

    <style>
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
    </style>


    <div class="card">
        <div class="container">
            <div class="card-body">
                <form action="{{ route('save-test') }}" method="POST">
                    @csrf
                    {{-- Add test fields --}}




                    <div class="col-12 fw-bold">
                        <div class="row  mb-5 ms-2">

                            <div class="col-md-3">
                                <label for="title" class="mb-2">Title <span class="text-danger"> *</span></label>
                                <input type="text" name="test_title" id="title" class="form-control mb-3"
                                    placeholder="Title" required>
                            </div>


                            <div class="col-md-3">
                                <label for="test-assigned" class="mb-2">Questions <span class="text-danger">
                                        *</span></label>
                                <select name="question_type" id="question_type" onchange="opp_div_close()"
                                    class="form-control">
                                    <option value="0" disabled selected>SELECT</option>
                                    <option value="1">Select Questions</option>
                                    <option value="2">Random Questions</option>
                                </select>
                            </div>

                            <div class="col-md-2 text-center mt-2">
                                <button type="button" class="btn btn-sm mt-4 background-secondary text-white"
                                    onclick="open_section_modal()">
                                    Section & Duration</button>
                            </div>

                            <div class="col-md-4 exclude-prev-test mt-2">
                                <h5 class="fw-bold">Exclude questions from previous Tests?</h5>

                                <div class="form-check form-check-inline">
                                    <input style="height:30px;width:30px;" class="form-check-input ms-3" type="checkbox"
                                        id="excludeYes" value="yes">
                                    <label style="margin-top:5px" class="form-check-label ms-3" for="excludeYes">Yes</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input style="height:30px;width:30px;" class="form-check-input ms-3" type="checkbox"
                                        id="excludeNo" value="no">
                                    <label style="margin-top:5px" class="form-check-label ms-3" for="">No</label>
                                </div>

                                <button type="button" id="selected-tests" data-bs-toggle="modal"
                                    data-bs-target="#PreviousTestModal" style="display:none"
                                    class="btn background-secondary btn-sm text-white ms-3">SELECTED
                                    TESTS</button>
                            </div>


                            <div class="col-md-4  mt-2">
                                <h5 class="fw-bold">Practice Test ?</h5>

                                <div class="form-check form-check-inline">
                                    <input style="height:30px;width:30px;" class="form-check-input ms-3" type="checkbox"
                                        id="practice_yes" name="practice_status" value="yes">
                                    <label style="margin-top:5px" class="form-check-label ms-3"
                                        for="practice_yes">Yes</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input style="height:30px;width:30px;" class="form-check-input ms-3" type="checkbox"
                                        id="practice_no" name="practice_status" value="no">
                                    <label style="margin-top:5px" class="form-check-label ms-3" for="practice_no">No</label>
                                </div>

                                <button type="button" id="selected-tests" data-bs-toggle="modal"
                                    data-bs-target="#PreviousTestModal" style="display:none"
                                    class="btn background-secondary btn-sm text-white ms-3">SELECTED
                                    TESTS</button>
                            </div>

                            <div style="display:none" class="section-add-div">
                                <div class="d-flex justify-content-end">
                                    <button type="button" onclick="add_more_section()"
                                        class="btn background-secondary text-white ">Add
                                        Section</button>
                                </div>
                            </div>
                            <div class="col-md-2 question-select-module mt-2 ">

                                <button type="button" onclick="openModal()"
                                    class="btn ms-5 btn-sm mt-4 background-info text-white">View Selected
                                    Questions</button>
                            </div>

                            <div class="col show-after-question-select mt-2 mx-5" style="display: none">
                                <button type="button" onclick="show_div_table()"
                                    class="btn btn-sm ms-0 mt-4 background-secondary text-white">Show
                                    Questions</button>
                            </div>
                            <div class="col-md-1"></div>
                            <br>

                            <div class="random_questions_modules mt-5 mb-5">
                            </div>

                            <input type="hidden" name="section_name_select">
                            <input type="hidden" name="category_duration">
                            <input type="hidden" name="exclude_previous_test_question" id="exclude-tests">

                            <br>

                        </div>




                        <div class="selected_questions_modules">
                            <div class="row mb-3 text-center">
                                <div class="col-md-3 ms-4">
                                    <label for="section_name">SECTION NAME</label>
                                </div>
                            </div>
                            <div class="select_question_append_body">

                            </div>
                        </div>
                        <br>
                    </div>

                    {{-- table starts --}}
                    <div class="card dtable">

                    </div>
                    {{-- table ends --}}



                    <div class="d-flex justify-content-center">
                        <button type="button" class="mx-3 btn text-white" onclick="openPreviewModal()"
                            style="background-color:#4a6064">Preview</button>
                        <button type="submit" class="btn background-secondary text-white">Submit
                            Form</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>

    <div id="successPopup" class="hidden">
        <span id="succ_mess"></span>
    </div>


    <div class="modal fade" id="PreviousTestModal" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="staticBackdropLabel">Select Tests to exclude Questions.</h5>
                    <button type="button" class="btn-close" onclick="modal_close()"></button>
                </div>

                <div class="modal-body">
                    <table id="testsTable" class="display ms-5">
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
                                        <input style="height:30px;width:30px;" type="checkbox" name=""
                                            class="select-test-toexclude" value="{{ $tt->test_code }}" id="">
                                    </td>
                                    <td>{{ strtoupper($tt->title) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn  background-secondary text-white" onclick="exclude_tests()"
                        id="timing-submit">UPDATE</button>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="selectTiming" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="staticBackdropLabel">Enter Duration for each categories.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-display category-time-table">
                        <thead class="background-info ">
                            <tr>
                                <th class="text-white">Sections </th>
                                <th class="text-white">Duration (In Mins)</th>
                                <th class="text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody class="category-body">
                            <tr>
                                <td>
                                    <input type="text" class="form-control sec_name_select" name="section_name[]"
                                        placeholder="Enter Section Name ">
                                </td>
                                <td>
                                    <input type="text" name="section_duration[]"
                                        class="form-control category_duration"
                                        oninput=" this.value = this.value.replace(/[^0-9]/g, ''); " id=""
                                        placeholder="Enter Duration">
                                </td>
                                <td>
                                    <button style="border-radius:0%" class="btn background-secondary text-white"
                                        onclick="add_row()" type="button">+</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn  background-secondary text-white" onclick="time_update()"
                        id="timing-submit">UPDATE</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="viewQuestion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content modal-contents">
                <div class="modal-header">
                    <h5 class="modal-title emphasized-title" id="exampleModalLabel">View Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="question-details">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    {{-- view selected questions --}}

    <div class="modal fade" id="viewSelectedQuestions" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selected Questions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <table id="" class="table  table-striped table-bordered">
                            <tbody class="select-body">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        var data_for_count;


        $(document).ready(function() {

            localStorage.clear();

            $(".selected_questions_modules").hide();

            $('.exclude-prev-test input[type="checkbox"]').prop('checked', false);
            $('#excludeNo').prop('checked', true);

            $('.exclude-prev-test input[type="checkbox"]').click(function(e) {
                var checkboxes = $(this).closest('.col-md-4').find('input[type="checkbox"]');

                checkboxes.prop('checked',
                    false);
                $(this).prop('checked', true);
                if ($(this).attr('id') === 'excludeYes' && $(this).prop('checked')) {
                    $('#PreviousTestModal').modal('show');
                }
            });


            $(".question-select-module").hide();

            $('#testsTable').DataTable({
                paging: true,
                searching: true,
                ordering: false,
                info: true
            });


        });
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


        var questions = @json($question_banks);
        var groups = @json($groups);

        function time_update() {
            $("input[name='section_name_select']").val("");
            $("input[name='category_duration']").val("");

            var section_name = $(".sec_name_select");
            var sectionValue = [];
            section_name.each(function() {
                var vals = $(this).val().trim();
                if (vals !== '') {
                    sectionValue.push(vals);
                }
            });
            console.log(section_name);
            var duration = $(".category_duration");
            var duration_value = [];
            duration.map(function() {
                var value = $(this).val().trim();
                if (value !== '') {
                    duration_value.push(value);
                }
            });


            var len = $(".category-body tr").length;
            $("input[name='section_name_select']").val(sectionValue);
            $("input[name='category_duration']").val(duration_value);
            $("#selectTiming").modal('hide');
            add_section_rows();
        }


        function add_section_rows() {


            var section_name = $("input[name='section_name_select']").val().split(',');
            var cat_duration = $("input[name='category_duration']").val().split(',');
            if (section_name[0] == "" && cat_duration[0] == "") {
                return false;
            }

            if ($("#question_type").val() == 1) {


                var sec_name_map = section_name.map((e, index) => {

                    var getstore = localStorage.getItem(`selected_questions_value${index}`);
                    var vals;
                    if (getstore != "") {
                        vals = getstore;
                    } else {
                        vals = e;
                    }

                    return `
                        <div class="row">
                        <div class="col-md-3 ms-4">
                            <input type="text" name="input_section_name[]" value="${e}" class="form-control" > 
                        </div>
                        <div class="col-md-2 ms-4">
                            <input type="text" name="input_section_duration[]" value="${cat_duration[index]}" class="form-control" > 
                        </div>
                        <div class=" col-md-4 d-flex">
                            <button type="button" onclick="openSelectQuestionModal(${index})" class="btn btn-sm ms-4 background-secondary text-white">SELECT QUESTIONS</button>
                            <button type="button" onclick="openViewQuestionModal(${index})" class="btn btn-sm ms-4 background-info text-white">VIEW SELECTED QUESTIONS</button>
                            <input type="hidden" name="selected_questions_value[]" id="selected_questions_value${index}" value='${vals}' class="selected_questions_value" >
                        </div>
                        </div>
                        </div>
                        <br>

                        <div class="modal fade" id="select_questions_modal${index}" tabindex="-1" data-bs-backdrop="static"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="staticBackdropLabel">SELECT QUESTIONS </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="div-table-responsive">

                                        <table id="example${index}"
                                            class="table table-striped table-bordered ex-table dt-column-search${index}">
                                            <thead class="">
                                                <tr>
                                                    <th scope="col" class="text-black">
                                                    </th>
                                                    <th scope="col" class="text-black">Question Code</th>
                                                    <th scope="col" class="text-black">
                                                        Skills
                                                    </th>
                                                    <th scope="col" class="text-black">
                                                        Categories
                                                    </th>
                                                    <th scope="col" class="text-black">
                                                        Difficulties
                                                    </th>
                                                    <th scope="col" class="text-black">Questions</th>
                                                </tr>
                                            </thead>

                                            <tbody class="tbodys">
                                            </tbody>
                                        </table>
                                        <input type="hidden" name="" id="index" value="">
                                        <div class="mt-5 d-flex justify-content-end">
                                            <button type="button"
                                                class="btn background-info select-submit mx-4 text-white"
                                                onclick="select_questions()">SELECT
                                                QUESTIONS</button>
                                            <br>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                        `;
                })

                $(".select_question_append_body").html(sec_name_map);
                $(".selected_questions_modules").show();
                $(".random_questions_modules").hide();

            } else {
                var sec_name_map = section_name.map((e, index) => {
                    return `<div class="row col-12 mb-5">
                                    <div class="col text-center text-center">
                                        <label for="">SECTION</label>
                                        <input type="text" name="rand_section_name[]" id="" value="${e}" class="form-control" >
                                    </div>
                                    <div class="col text-center">
                                        <label for="">CATEGORY</label>
                                        <div class=" select2-dark">
                                            <select id="category${index}" name="category[${index}][]" class=" category_class select2 form-select " multiple>
                                                <option>All</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->category_id }}">
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col text-center">

                                        <label for="">SKILLS</label>
                                        <select id="skills${index}" name="skills[${index}][]" class="select2 form-select" onchange="set_topics(${index})" multiple>
                                            @foreach ($skills as $skill)
                                                <option value="{{ $skill->skill_id }}">
                                                    {{ $skill->skill_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col text-center">
                                        <label for="">TOPICS</label>
                                        <select id="topics${index}" name="topics[${index}][]" class="select2 form-select "  multiple>
                                           
                                        </select>
                                    </div>
                                    <div class="col text-center">

                                        <table style=" border-collapse: collapse;">
                                            <thead style="background-color: #dddddd;">
                                                <th
                                                    style=" border: 1px solid black; text-align: center; font-weight: bold;">
                                                    Easy <span class='easy_count_test'></span></th>
                                                <th
                                                    style=" border: 1px solid black; text-align: center; font-weight: bold;">
                                                    Medium  <span class='medium_count_test'></span></th>
                                                <th
                                                    style=" border: 1px solid black; text-align: center; font-weight: bold;">
                                                    Hard <span class='hard_count_test'></span></th>
                                                <th
                                                    style=" border: 1px solid black; text-align: center; font-weight: bold;">
                                                    Very Hard <span class='very_hard_count_test'></span></th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" name="easy[]" id=""  oninput=" this.value = this.value.replace(/[^0-9]/g, ''); "></td>
                                                    <td><input type="text" name="medium[]" id=""  oninput=" this.value = this.value.replace(/[^0-9]/g, ''); "></td>
                                                    <td><input type="text" name="hard[]" id="" oninput=" this.value = this.value.replace(/[^0-9]/g, ''); "></td>
                                                    <td><input type="text" name="very_hard[]" id="" oninput=" this.value = this.value.replace(/[^0-9]/g, ''); "></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="col text-center">
                                        <label for="">TAGS</label>
                                        <select name="question_tags[]" id="" class="form-control">
                                            <option value="">SELECT</option>
                                        </select>
                                    </div>
                                </div>`;
                });

                select2_func();

                $(".random_questions_modules").html(sec_name_map);
                $(".selected_questions_modules").hide();
                $(".random_questions_modules").show();

            }

        }


        function truncateText(text, maxWords) {
            var words = text.split(' ');
            if (words.length > maxWords) {
                return words.slice(0, maxWords).join(' ') + '...';
            }
            return text;
        }


        function opp_div_close() {
            time_update();
        }


        function openSelectQuestionModal(index) {



            if ($(`#example${index} thead tr`).length > 1) {
                $(`#example${index} thead tr`).last().remove();
            }





            var existingTable = $('#example' + index).DataTable();
            existingTable.destroy();

            t = $(".dt-column-search" + index);
            if (t.length) {
                $(`.dt-column-search${index} thead tr`)
                    .clone(!0)

                var c = t.DataTable({
                    ajax: {
                        url: "{{ route('get-filtered-questions') }}",
                        type: "GET",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                .attr(
                                    'content')
                        },
                        data: function(d) {
                            d.exclude_tests = $("#exclude-tests").val();
                        }
                    },
                    pageLength: 6,
                    columns: [{
                            data: "question_code",
                            orderable: false,
                            render: function(data, type, row) {
                                var checked;
                                if ($('#selected_questions_value' + index).val() != "") {
                                    var selected_ques = $('#selected_questions_value' + index).val().split(
                                        ',');

                                    if (selected_ques.includes(row.question_code)) {
                                        checked = "checked";
                                    } else {
                                        checked = "";
                                    }

                                }
                                var d = row.question_code;
                                return `
                                                 <input type="checkbox" style="height:25px;width:25px" name="select_question[]" value="${row.question_code}" ${checked} class="select_question${index}" >
                `;
                            },
                        },

                        {
                            data: "skill_name",
                            orderable: false
                        },
                        {
                            data: "topic_name",
                            orderable: false
                        },
                        {
                            data: "category_name",
                            orderable: false
                        },
                        {
                            data: "difficulty_name",
                            orderable: false
                        },
                        {
                            data: "questions",
                            orderable: false,
                            render: function(data, type, row) {
                                var val = truncateText(data, 10);
                                var html = $("<html>").append(val);
                                return html.text();
                            }
                        }

                    ],

                    orderCellsTop: !0,
                    dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                });
            }


            $(".dataTables_length").parent().remove();
            $('#index').val(index);
            $("#select_questions_modal" + index).modal('show');
        }



        function openViewQuestionModal(index) {

            $(".select-body").empty();
            var question_code = $(`#selected_questions_value${index}`).val();
            $.ajax({
                url: "{{ route('get-selected-questions') }}",
                type: "GET",
                data: {
                    question_code: question_code,
                },
                success: function(data) {
                    $(".select-body").html(data);
                    $("#viewSelectedQuestions").modal('show');
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                },
            });

        }


        function openPreviewModal() {
            $(".select-body").empty();
            var question_code = $('.selected_questions_value').map(function() {
                return $(this).val();
            }).get().join(',');

            console.log(question_code);

            $.ajax({
                url: "{{ route('get-selected-questions') }}",
                type: "GET",
                data: {
                    question_code: question_code,
                },
                success: function(data) {
                    $(".select-body").html(data);
                    $("#viewSelectedQuestions").modal('show');
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                },
            });
        }


        function select_questions() {
            var index = $("#index").val();
            var checkedValues = [];
            $(`.select_question${index}:checked`).each(function() {
                checkedValues.push($(this).val());
            });
            $(`#selected_questions_value${index}`).val(checkedValues);
            var localstore = localStorage.setItem(`selected_questions_value${index}`, checkedValues);
            $("#select_questions_modal" + index).modal('hide');
            showSuccessPopup("Questions Selected..!", 1500, 'success');
        }

        var topics = @json($topics);

        function set_topics(index) {
            var skill_select = $(`#skills${index}`);
            var topic_select = $(`#topics${index}`);
            var selected_skills = skill_select.val();
            var filtered_topics = topics.filter(topic => {
                var topic_skill_id = topic.skills_id.split(',');
                return selected_skills.some(skill => topic_skill_id.includes(skill));
            });

            topic_select.empty();

            filtered_topics.forEach(topic => {
                topic_select.append(`<option value="${topic.topic_id}">${topic.topic_name}</option>`);
            });

            topic_select.trigger('change');
        }



        function select2_func() {
            setTimeout(() => {
                var selects = $("select.select2");
                selects.each(function(i, select) {
                    $(select).select2({
                        placeholder: "Select Value",
                        allowClear: true
                    });
                });
            }, 200);
        }

        function exclude_tests() {

            var tests = [];
            $(".select-test-toexclude:checked").map(function() {
                tests.push($(this).val());
            });
            $("#exclude-tests").val(tests);

            $.ajax({
                    url: "{{ route('get-filtered-questions') }}",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr(
                                'content')
                    },
                    success: function(data) {
                        localStorage.setItem('data_for_count', JSON.stringify(data))
                    }
                }),

                modal_close();
            var questions = $("select[name='question_type']").val();
            if ($(".select-test-toexclude:checked").length > 0) {
                $("#selected-tests").show();
            }

            setTimeout(() => {
                data_for_count = JSON.parse(localStorage.getItem('data_for_count'));
            }, 200);

        }





        function viewQuestion(value) {
            $(".question-details").empty();
            $.ajax({
                type: "GET",
                url: "{{ route('view-detailed-questions') }}",
                data: {
                    value: value
                },
                success: (data) => {
                    $(".question-details").append(data);
                    $("#viewQuestion").modal('show');
                },
                error: (xhr) => {
                    console.log(xhr);
                }
            });

        }


        $(document).ready(function() {

            $('#category').change(function() {
                if ($(this).val() && $(this).val().includes('All')) {
                    $('#category option').prop('selected', true);
                } else {
                    $('#category option[value="All"]').prop('selected', false);
                }
            });

            $('#skills').change(function() {
                if ($(this).val() && $(this).val().includes('All')) {
                    $('#skills option').prop('selected', true);
                } else {
                    $('#skills option[value="All"]').prop('selected', false);
                }
            });


            $.ajax({
                url: "{{ route('ajax-get-skills') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var html = '  <option>All</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].skill_id + '">' + data[i].skill_name +
                            '</option>';
                    }
                    $('#skills').html(html);
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            })

        });


        function open_section_modal() {
            if ($("#question_type").val() != null) {
                $("#selectTiming").modal('show');
            } else {
                showSuccessPopup('Please Select Question Type', 1500, 'warning');
            }
        }



        function add_row() {


            var row = `
        <tr>
            <td>
                <input type="text" class="form-control sec_name_select" name="section_name[]"
                    placeholder="Enter Section Name ">
            </td>
            <td>
                <input type="text" name="section_duration[]" class="form-control category_duration"
                    oninput=" this.value = this.value.replace(/[^0-9]/g, ''); " id=""
                    placeholder="Enter Duration">
            </td>
            <td>
                <button style="border-radius:0%" class="btn background-info text-white remove-row" type="button">-</button>
            </td>
        </tr>
    `;

            $(".category-body").append(row);
            $(".category-body tr:last").slideDown('slow');
            $(".numeric-input").on("input", function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
            $(".remove-row").on("click", function() {
                remove_row(this);
            });

        }


        function remove_row(value) {
            $(value).closest('tr').fadeOut('slow', function() {
                $(this).slideUp('slow', function() {
                    $(this).remove();
                });
            });
        }

        function modal_close() {
            localStorage.clear();
            $(".tbodys").empty();
            if ($(".select-test-toexclude:checked").length === 0) {
                $("#excludeYes").prop('checked', false);
                $("#excludeNo").prop('checked', true);
            }
            $("#PreviousTestModal").modal('hide');
        }
    </script>


@endsection
