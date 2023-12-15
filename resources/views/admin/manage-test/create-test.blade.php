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

                            <div class="col-md-4">
                                <label for="title" class="mb-2">Title <span class="text-danger"> *</span></label>
                                <input type="text" name="test_title" id="title" class="form-control mb-3"
                                    placeholder="Title" required>
                            </div>

                            <div class="col-md-4">
                                <label for="skills" class="mb-2">Skills <span class="text-danger"> *</span></label>
                                <div class="select2-dark">
                                    <select id="skills" name="skills[]" class="select2 form-select " multiple
                                        onchange="count()">

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <label for="category" class="mb-2">Category <span class="text-danger"> *</span></label>
                                <div class=" select2-dark">
                                    <select id="category" name="category[]" class=" select2 form-select " multiple
                                        onchange="count()">
                                        <option>All</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}">{{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1 text-center mt-2">
                                <button type="button" class="btn btn-sm mt-4 background-secondary text-white"
                                    title="Choose time for each category" data-bs-toggle="modal"
                                    data-bs-target="#selectTiming">
                                    Duration</button>
                            </div>

                            <div class="col-md-4">
                                <label for="visibility" class="mb-2">Visibility <span class="text-danger">
                                        *</span></label>
                                <select name="visibility" class="form-control mb-3" id="visibility"
                                    onchange="visible_change(this.value)" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Private</option>
                                    <option value="2">Public</option>
                                </select>
                            </div>

                            {{-- <div class="col-md-4">
                                <label for="duration" class="mb-2">Duration (In Mins) <span class="text-danger">
                                        *</span></label>
                                <input type="text" name="duration" placeholder="Duration" id=""
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control  mb-3"
                                    required>{{-- Only numbers should be allowed --}}
                            {{-- </div>  --}}

                            <div class="col-md-4">
                                <label for="marks" class="mb-2">Marks <span class="text-danger"> *</span></label>
                                <select name="marks" class="form-control mb-3" id="marks" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Mode</option>
                                    <option value="2">Auto</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="pass-percentage" class="mb-2">Pass Percentage % <span class="text-danger">
                                        *</span></label>
                                <input type="text" name="pass_percentage" placeholder="Pass Percentage" id=""
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control  mb-3"
                                    required>{{-- Only numbers should be allowed --}}
                            </div>

                            <div class="col-md-4">
                                <label for="shuffle-questions" class="mb-2">Shuffle Questions <span class="text-danger">
                                        *</span></label>
                                <select name="shuffle_questions" class="form-control mb-3" id="shuffle-questions" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="restrict-attempts" class="mb-2">Restrict Attempts <span class="text-danger">
                                        *</span></label>
                                <select name="restrict_attempts" class="form-control mb-3" id="restrict-attempts" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="disable-finish-button" class="mb-2">Disable Finish Button <span
                                        class="text-danger"> *</span></label>
                                <select name="disable_finish_button" class="form-control mb-3" id="disable-finish-button"
                                    required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="enable-question-list" class="mb-2">Enable Question List View <span
                                        class="text-danger"> *</span></label>
                                <select name="enable_question_list" class="form-control mb-3" id="enable-question-list"
                                    required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="hide-solutions" class="mb-2">Hide Solutions <span class="text-danger">
                                        *</span></label>
                                <select name="hide_solutions" class="form-control mb-3" id="hide-solutions"
                                    onchange="solution_show(this.value)" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                    <option value="3">Show After Particular Date</option>
                                </select>
                            </div>

                            <div class="col-md-4 " style="display:none" id="solution_show_date">
                                <label for="solution_date" class="mb-2 ">Solution Show Date <span class="text-danger">
                                        *</span></label>
                                <input type="date" name="solution_date" class="form-control"
                                    id="solution-date">{{-- Html date format --}}
                            </div>

                            <div class="col-md-4">
                                <label for="show-leaderboard" class="mb-2">Show Leaderboard <span class="text-danger">
                                        *</span></label>
                                <select name="show_leaderboard" class="form-control mb-3" id="show-leaderboard" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="schedule-type" class="mb-2">Schedule Type <span class="text-danger">
                                        *</span></label>
                                <select name="schedule_type" class="form-control mb-3" id="schedule-type" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Fixed</option>
                                    <option value="2">Flexible</option>
                                </select>
                            </div>

                            <div class="col-md-4  ">
                                <label for="start_date" class="mb-2">Start Date</label>
                                <input type="date" name="start_date" id="start-date" class="form-control"
                                    onchange="date_val(this.value)">
                            </div>

                            <div class="col-md-4">
                                <label for="end_date" class="mb-2 ms-2 ">End Date </label>
                                <input type="date" name="end_date" id="end-date"
                                    class="form-control">{{-- Html date format --}}
                            </div>

                            <div class="col-md-4 d-flex ">
                                <div class="col">
                                    <label for="start_time" class="mb-2">Start Time</label>
                                    <input type="time" name="start_time" id="" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="end_time" class="mb-2 ms-2 ">End Time</label>
                                    <input type="time" name="end_time" id=""
                                        class="ms-2 form-control  mb-3">
                                    {{-- Html time format --}}
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="test-assigned" class="mb-2">Test Assigned to <span class="text-danger">
                                        *</span></label>
                                <input type="text" name="test_assigned_to" placeholder="Test Assigned to"
                                    id="test-assigned" class="form-control mb-3" required>
                            </div>

                            <div class="col-md-4">
                                <label for="test-assigned" class="mb-2">Questions <span class="text-danger">
                                        *</span></label>
                                <select name="question_type" id="" class="form-control"
                                    onchange="questiontype(this.value)">
                                    <option selected disabled>SELECT</option>
                                    <option value="1">Select Questions</option>
                                    <option value="2">Random Questions</option>
                                </select>
                            </div>

                            <div class="col mt-2">
                                <h5 class="fw-bold">Exclude questions from previous Tests?</h5>
                                <div class="form-check form-check-inline">
                                    <input style="height:30px;width:30px;" class="form-check-input" type="checkbox"
                                        id="excludeYes" value="yes">
                                    <label style="margin-top:5px" class="form-check-label ms-3"
                                        for="excludeYes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input style="height:30px;width:30px;" class="form-check-input ms-3" type="checkbox"
                                        id="excludeNo" value="no">
                                    <label style="margin-top:5px" class="form-check-label ms-3"
                                        for="excludeNo">No</label>
                                </div>
                            </div>


                            <div class="col-md-3 question-select-module mt-2" style="display:none">

                                <button type="button"
                                    class="btn btn-sm selectQuesiton mt-4 background-secondary text-white">Select
                                    Questions</button>
                                <button type="button" onclick="openModal()"
                                    class="btn  ms-3  btn-sm mt-4 background-info text-white">View Selected
                                    Questions</button>
                            </div>


                            <div class="mt-3 random-question-module" style="display: none">
                                <label class="align-items-center" for="">Difficulties:</label>
                                <br>
                                <div class="row col-12">

                                    @foreach ($difficulties as $difficulty)
                                        <div class="col-md-2 text-center  ">
                                            <label class="ms-2"
                                                for="">{{ ucfirst($difficulty->difficulty_name) }}
                                                (<span id="diff_{{ lcfirst($difficulty->difficulty_id) }}">
                                                    @php
                                                        $arrays = [];
                                                        foreach ($question_banks as $key => $ques) {
                                                            if ($ques->difficulties_id == $difficulty->difficulty_id) {
                                                                array_push($arrays, $ques->difficulties_id);
                                                            }
                                                        }
                                                        echo count($arrays);
                                                    @endphp
                                                </span>)
                                            </label>{{-- change the numbers to dynamically from db --}}
                                            <input type="hidden" name="difficulty_id[]" class="form-control"
                                                value="{{ $difficulty->difficulty_id }}">
                                            <input type="number" class="form-control" name="difficulty_questions[]"
                                                id="diff_{{ lcfirst($difficulty->difficulty_name) }}"
                                                placeholder="{{ ucfirst($difficulty->difficulty_name) }}" id="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <input type="hidden" name="timing_category_name">
                            <input type="hidden" name="category_duration">
                            <input type="hidden" name="exclude_previous_test_question" id="exclude-tests">
                            <div class="">
                                <input type="hidden" name="selected_questions" class="store-selected-values">
                            </div>

                            <br>

                        </div>
                        <div class="visibility-view col-12">
                            <div style="background-color:#f9fafb" class="card">
                                <div class="ms-2 mx-3 mt-1 ">
                                    <div class="form-repeater">
                                        <div class="d-flex background-secondary  " style="align-items: center;">
                                            {{-- Select the fields to assign the test --}}
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
                                                                <option value="" selected disabled>SELECT
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
                                                        </button>{{-- delete current field --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-5 ms-3">
                                            <button type="button" class="btn background-secondary add-btn text-white"
                                                id="changeIdButton" data-repeater-create>
                                                <i class="bx bx-plus me-1"></i>{{-- options to add multiple fields --}}
                                                <span class="align-middle">Add</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <pre>


                        </pre>

                        {{-- table starts --}}
                        <div class="card dtable">
                            <div class="div-table-responsive" style="display:none">
                                <div class="d-flex justify-content-end">
                                    <button type="button" id="select-submit"
                                        class="btn background-info text-white mt-2 mx-3">SELECT </button>
                                </div>
                                <table id="example" class="table table-stripped ex-table dt-column-search">
                                    <thead class="">
                                        <tr>
                                            <th scope="col" class="text-black text-center">
                                            </th>
                                            <th scope="col" class="text-black text-center">Question Code</th>
                                            <th scope="col" class="text-black text-center">
                                                Skills
                                            </th>
                                            <th scope="col" class="text-black text-center">
                                                Categories
                                            </th>
                                            <th scope="col" class="text-black text-center">
                                                Difficulties
                                            </th>
                                            <th scope="col" class="text-black text-center">Questions</th>
                                            <th scope="col" class="text-black text-center">ACTIONS</th>
                                        </tr>
                                    </thead>

                                    <tbody class="tbodys">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- table ends --}}

                        <div class="mt-5 d-flex justify-content-end">
                            <button type="submit" class="btn background-secondary text-white">Submit</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <th class="text-white">Category </th>
                                <th class="text-white">Duration (In Mins)</th>
                                <th class="text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody class="category-body">
                            <tr>
                                <td>
                                    <select name="" class="form-control timing_category_name" id="">
                                        <option value="">SELECT</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="" class="form-control category_duration"
                                        oninput=" this.value = this.value.replace(/[^0-9]/g, ''); " id="">
                                </td>
                                <td>
                                    <button style="border-radius:0%" class="btn background-secondary text-white"
                                        onclick = "add_row()" type="button">+</button>
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

    {{-- select questions of selected topics --}}
    {{-- <div class="modal fade" id="selectQuestions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Questions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> --}}

    {{-- </div>
                <div class="modal-footer">
                    <button type="button" class="btn  background-secondary text-white"
                        id="select-submit">SELECT</button>
                </div>
            </div>
        </div>
    </div> --}}

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
                        <table id="" class="table table-stripped table-responsive">
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
        $(document).ready(function() {
            $('.form-check-input').on('change', function() {
                if (this.value == "yes" && this.checked) {
                    $("#PreviousTestModal").modal('show');
                }
                $('.form-check-input').not(this).prop('checked', false);

            });

            $('#testsTable').DataTable({
                paging: true,
                searching: true,
                ordering: false,
                info: true
            });

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


        var questions = @json($question_banks);
        var groups = @json($groups);

        function time_update() {
            var selected_categories = $(".timing_category_name option:selected");
            var categoryValue = [];
            selected_categories.each(function() {
                categoryValue.push($(this).val());
            });

            var duration = $(".category_duration");
            var duration_value = [];
            duration.map(function() {
                duration_value.push($(this).val());
            });

            $("input[name='timing_category_name']").val(categoryValue);
            $("input[name='category_duration']").val(duration_value);
            var message = "Duration for category Updated Successfully.";
            $("#selectTiming").modal('hide');
            showSuccessPopup(message, 'green');
        }

        function date_val(value) {
            $("#end-date").prop('min', value);
            $("#end-date").val("");
        }


        function exclude_tests() {
            var tests = [];
            $(".select-test-toexclude:checked").map(function() {
                tests.push($(this).val());
            });

            $("#exclude-tests").val(tests);
            $("#PreviousTestModal").modal('hide');
        }

        $(document).ready(() => {

            $('#select-submit').on('click', function() {
                var checkedValues = [];
                $('.select_question:checked').each(function() {
                    checkedValues.push($(this).val());
                });
                $(".store-selected-values").val(checkedValues);
                showSuccessPopup('Questions selected successfully !', 'green');
                $(".div-table-responsive").hide();
            });

            $('.selectQuesiton').on('click', function() {

                var cat_check = $("#category").val();
                var skill_check = $("#skills").val();
                var visibility_check = $("#visibility").val();
                var exclu_test = $(".form-check-input:checked").val();
                var input_test_values = $("input[name='exclude_previous_test_question']").val();

                if (cat_check != "" && skill_check != "" && visibility_check != null) {

                    showSuccessPopup('Scroll down to see the questions !', 'green')
                    if ($('#example thead tr').length > 1) {
                        $('#example thead tr').last().remove();
                    }

                    $('.div-table-responsive').show();
                    var skills = $("#skills").val();
                    var category = $("#category").val();

                    var existingTable = $('#example').DataTable();
                    existingTable.destroy();


                    function truncateText(text, maxWords) {
                        var words = text.split(' ');
                        if (words.length > maxWords) {
                            return words.slice(0, maxWords).join(' ') + '...';
                        }
                        return text;
                    }

                    t = $(".dt-column-search");
                    if (t.length) {
                        $(".dt-column-search thead tr")
                            .clone(!0)
                            .appendTo(".dt-column-search thead"),
                            $(".dt-column-search thead tr:eq(1) th").each(function(a) {
                                var t = $(this).text();
                                $(this).html(
                                        '<input type="text" class="form-control" placeholder="Search ' +
                                        t +
                                        '" />'
                                    ),
                                    $("input", this).on("keyup change", function() {
                                        c.column(a).search() !== this.value &&
                                            c.column(a).search(this.value).draw();
                                    });
                            });


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
                                    d.skills = skills;
                                    d.categories = category;
                                    d.exclude_tests = $("#exclude-tests").val();
                                }
                            },
                            columns: [{
                                    data: "question_code",
                                    orderable: false,
                                    render: function(data, type, row) {
                                        var d = row.question_code;
                                        return `
                                                 <input type="checkbox" style="height:25px;width:25px" name="select_question[]" value="${row.question_code}" class="select_question" >
                `;
                                    },
                                },
                                {
                                    data: "question_code",
                                    orderable: false
                                },
                                {
                                    data: "skill_name",
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
                                },
                                {
                                    data: "question_code",
                                    orderable: false,
                                    searchable: false,
                                    render: function(data, type, row) {
                                        var d = row.question_code;
                                        return `<div class="text-center">
                        <a class="icon-buttons text-center"  onclick="viewQuestion('${row.question_code}')">
                            <i class="bx bx-show-alt"></i>
                        </a>
                    </div>
                    `;
                                    },
                                },

                            ],

                            orderCellsTop: !0,
                            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                        });
                    }
                } else {
                    var cat_check = $("#category").val();
                    var skill_check = $("#skills").val();
                    var visibility_check = $("#visibility").val();

                    var missingFields = [];

                    if (cat_check == "") {
                        missingFields.push('Category');
                    }

                    if (skill_check == "") {
                        missingFields.push('Skills');
                    }

                    if (!visibility_check) {
                        missingFields.push('Visibility');
                    }

                    if (missingFields.length > 0) {
                        var missingFieldsString = missingFields.join(', ');
                        showSuccessPopup('Please fill in the following fields: ' +
                            missingFieldsString +
                            '!',
                            '#dd3131')
                    }
                }

            });


            $('.selectQuesiton').on('click', function() {
                $('thead tr input').first().hide();
                $('thead tr input').last().hide();
                $(".dataTables_length").parent().parent().remove();
            });
        });


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

        function count() {
            var skills = $("#skills").val() || [];
            var categories = $("#category").val() || [];
            let difficulty = @json($difficulties);

            difficulty.forEach((el) => {
                el.count = 0;

                skills.forEach((skill) => {
                    categories.forEach((category) => {
                        el.count += questions.filter(q =>
                            q.skills_id == skill &&
                            el.difficulty_id == q.difficulties_id &&
                            (Array.isArray(q.category) ? q.category.includes(category) :
                                q
                                .category == category)
                        ).length;
                    });
                });

                $("span#diff_" + el.difficulty_id).html('&nbsp;' + el.count + '&nbsp;');
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

            $('.visibility-view').hide();
            $(".add-btn,#visibility").on('click change', () => {
                setTimeout(() => {
                    $.ajax({
                        url: "{{ route('ajax-get-colleges') }}",
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var html =
                                '<option value="" selected disabled>SELECT</option>';
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
                                '<option value="" selected disabled>SELECT</option>';
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

        function visible_change(value) {
            if (value == 1) {
                $('.visibility-view').show();
            } else {
                $('.visibility-view').hide();
            }
        }

        function openModal() {
            $(".select-body").empty();
            var question_code = $(".store-selected-values").val();
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

        function questiontype(value) {
            if (value == 1) {
                $(".question-select-module").show();
                $(".random-question-module").hide();
            } else {
                $(".random-question-module").show();
                $(".question-select-module").hide();
            }
        }


        function add_row() {

            var categories = @json($categories);

            var selectOptions = categories.map(category => {
                return '<option value="' + category.category_id + '">' + category.category_name +
                    '</option>';
            });

            var row = `
        <tr>
            <td>
                <select name="timing_category_name[]" class="form-control timing_category_name ">
                    <option>SELECT</option>
                    ${selectOptions}
                </select>
            </td>
            <td>
                <input type="text" name="category_duration[]" class="form-control category_duration numeric-input">
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

        function solution_show(value) {
            if (value == 3) {
                $("#solution_show_date").show();
                $("#solution-date").prop('required', true)
                showSuccessPopup("Please Select solution date !", '#665E00')
            } else {
                $("#solution_show_date").hide();
                $("#solution-date").prop('required', false)
            }
        }
    </script>


@endsection
