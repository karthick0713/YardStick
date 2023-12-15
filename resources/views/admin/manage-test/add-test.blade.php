@extends('layouts/contentNavbarLayout')

@section('title', $sub_heading)

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
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
@endsection

@section('content')

    <style>
        table {
            border-collapse: unset !important;
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
    </style>
    <div class="card">
        <div class="container ">
            <div class="card-body">
                <form action="{{ route('save-common-test') }}" method="POST">
                    @csrf
                    {{-- Add test fields --}}
                    <div class="col-12 fw-bold">
                        <div class="row  mb-5 ms-2">

                            <div class="col-md-4">
                                <label for="title" class="mb-2">Title:</label>
                                <input type="text" name="test_title" id="title" class="form-control mb-3"
                                    placeholder="Title" required>
                            </div>

                            <div class="col-md-4">
                                <label for="skills" class="mb-2">Skills:</label>
                                <select name="skills" class="form-control mb-3" id="skills" onchange="count()" required>

                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="category" class="mb-2">Category:</label>
                                <select name="category" class="form-control mb-3" id="category" onchange="count()"
                                    required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Programming</option>
                                    <option value="2">MCQ</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="visibility" class="mb-2">Visibility:</label>
                                <select name="visibility" class="form-control mb-3" id="visibility"
                                    onchange="visible_change(this.value)" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Private</option>
                                    <option value="2">Public</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="duration" class="mb-2">Duration (In Mins):</label>
                                <input type="text" name="duration" placeholder="Duration" id=""
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control  mb-3"
                                    required>{{-- Only numbers should be allowed --}}
                            </div>

                            <div class="col-md-4">
                                <label for="marks" class="mb-2">Marks:</label>
                                <select name="marks" class="form-control mb-3" id="marks" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Mode</option>
                                    <option value="2">Auto</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="pass-percentage" class="mb-2">Pass Percentage %:</label>
                                <input type="text" name="pass_percentage" placeholder="Pass Percentage" id=""
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control  mb-3"
                                    required>{{-- Only numbers should be allowed --}}
                            </div>

                            <div class="col-md-4">
                                <label for="shuffle-questions" class="mb-2">Shuffle Questions:</label>
                                <select name="shuffle_questions" class="form-control mb-3" id="shuffle-questions" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="restrict-attempts" class="mb-2">Restrict Attempts:</label>
                                <select name="restrict_attempts" class="form-control mb-3" id="restrict-attempts" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="disable-finish-button" class="mb-2">Disable Finish Button:</label>
                                <select name="disable_finish_button" class="form-control mb-3" id="disable-finish-button"
                                    required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="enable-question-list" class="mb-2">Enable Question List View:</label>
                                <select name="enable_question_list" class="form-control mb-3" id="enable-question-list"
                                    required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="hide-solutions" class="mb-2">Hide Solutions:</label>
                                <select name="hide_solutions" class="form-control mb-3" id="hide-solutions" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="show-leaderboard" class="mb-2">Show Leaderboard:</label>
                                <select name="show_leaderboard" class="form-control mb-3" id="show-leaderboard" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="schedule-type" class="mb-2">Schedule Type:</label>
                                <select name="schedule_type" class="form-control mb-3" id="schedule-type" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="1">Fixed</option>
                                    <option value="2">Flexible</option>
                                </select>
                            </div>

                            <div class="col-md-4  ">
                                <label for="start_date" class="mb-2">Start Date:</label>
                                <input type="date" name="start_date" id="" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label for="end_date" class="mb-2 ms-2 ">End Date:</label>
                                <input type="date" name="end_date" class="form-control" required>{{-- Html date format --}}
                            </div>

                            <div class="col-md-4 d-flex ">
                                <div class="col">
                                    <label for="start_time" class="mb-2">Start Time:</label>
                                    <input type="time" name="start_time" id="" class="form-control"
                                        required>
                                </div>
                                <div class="col">
                                    <label for="end_time" class="mb-2 ms-2 ">End Time:</label>
                                    <input type="time" name="end_time" id="" class="ms-2 form-control"
                                        required> {{-- Html time format --}}
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="test-assigned" class="mb-2">Test Assigned to:</label>
                                <input type="text" name="test_assigned_to" placeholder="Test Assigned to"
                                    id="test-assigned" class="form-control mb-3" required>
                            </div>


                            <br>
                            <div class="random-question-modules">

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
                                                                <option value="" selected disabled>SELECT</option>
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
                        <div class="mt-5 d-flex justify-content-end">
                            <button type="submit" class="btn background-secondary text-white">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        var questions = @json($question_banks);
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
                    $.each(filteredGroups, function(index, value) {
                        groupsDropdown.append(
                            '<option value="' + value.group_id + '">' + value
                            .group_name +
                            '</option>');
                    });
                }
            });

        });

        // $(".group-select").append('<option value="' + optionValue + '">' + optionText + '</option>');

        function count() {
            var skill = $("#skills").val();
            var category = $("#category").val();
            let count = questions.filter(el => el.skills_id == skill)
            let difficulty = @json($difficulties);

            difficulty.map((e) => {
                return e.count = 0;
            })
            count.map((e) => {
                difficulty.map((el) => {
                    if (el.difficulty_id == e.difficulties_id && category == null) {
                        return el['count'] = el['count'] +
                            1;
                    }
                    if (el.difficulty_id == e.difficulties_id && e.category == category) {
                        return el['count'] = el['count'] +
                            1;
                    }
                })
            })
            difficulty.map((e) => {
                $("span#diff_" + e.difficulty_id).html('&nbsp' + e['count'] + '&nbsp');
            })

        }


        $(document).ready(function() {


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
                    // console.log(data);
                    var html = '<option value="" selected disabled>SELECT</option>';
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
    </script>


@endsection
