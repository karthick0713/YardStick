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
        /* @media only screen and (max-width: 600px) {
                        body {
                            font-size: 14px;
                        }

                        .container {
                            width: 100%;
                        }

                    }

                    .scrolling-container {
                        overflow-x: auto;
                    }

                    @media only screen and (max-width:450px) {
                        .ms-2, .mx-3, .mt-1, .ms-3 {
                            margin-left: 10px;
                            margin-right: 10px;
                            margin-top: 5px;
                        }

                    } */


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
                <form action="">
                    <div class="col-12 fw-bold">
                        <div class="row  mb-5 ms-2">
                            {{-- test creation fields --}}
                            <div class="col-md-4">
                                <label for="title" class="mb-2">Title:</label>
                                <input type="text" name="" id="title" class="form-control mb-3"
                                    placeholder="Title" required>
                            </div>

                            <div class="col-md-4">
                                <label for="skills" class="mb-2">Skills:</label>
                                <select name="skills" class="form-control mb-3" id="skills" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="php">PHP</option>
                                    <option value="Python">Python</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="category" class="mb-2">Category:</label>
                                <select name="category" class="form-control mb-3" id="category" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="php">PHP</option>
                                    <option value="Python">Python</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="visibility" class="mb-2">Visibility:</label>
                                <select name="visibility" class="form-control mb-3" id="visibility" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="Private">Private</option>
                                    <option value="Public">Public</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="duration" class="mb-2">Duration (In Mins):</label>
                                <input type="text" name="" placeholder="Duration" id=""
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control  mb-3"
                                    required>{{-- Only numbers should be allowed --}}
                            </div>

                            <div class="col-md-4">
                                <label for="marks" class="mb-2">Marks:</label>
                                <input type="text" name="" placeholder="Marks" id=""
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control  mb-3"
                                    required>{{-- Only numbers should be allowed --}}
                            </div>

                            <div class="col-md-4">
                                <label for="pass-percentage" class="mb-2">Pass Percentage %:</label>
                                <input type="text" name="" placeholder="Pass Percentage" id=""
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control  mb-3"
                                    required>{{-- Only numbers should be allowed --}}
                            </div>

                            <div class="col-md-4">
                                <label for="shuffle-questions" class="mb-2">Shuffle Questions:</label>
                                <select name="shuffle-questions" class="form-control mb-3" id="shuffle-questions" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="restrict-attempts" class="mb-2">Restrict Attempts:</label>
                                <select name="restrict-attempts" class="form-control mb-3" id="restrict-attempts" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="disable-finish-button" class="mb-2">Disable Finish Button:</label>
                                <select name="disable-finish-button" class="form-control mb-3" id="disable-finish-button"
                                    required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="enable-question-list" class="mb-2">Enable Question List View:</label>
                                <select name="enable-question-list" class="form-control mb-3" id="enable-question-list"
                                    required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="hide-solutions" class="mb-2">Hide Solutions:</label>
                                <select name="hide-solutions" class="form-control mb-3" id="hide-solutions" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="show-leaderboard" class="mb-2">Show Leaderboard:</label>
                                <select name="show-leaderboard" class="form-control mb-3" id="show-leaderboard" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="schedule-type" class="mb-2">Schedule Type:</label>
                                <select name="schedule-type" class="form-control mb-3" id="schedule-type" required>
                                    <option value="" selected disabled>SELECT</option>
                                    <option value="Fixed">Fixed</option>
                                    <option value="Flexible">Flexible</option>
                                </select>
                            </div>

                            <div class="col-md-4 d-flex ">
                                <div class="col">
                                    <label for="start-date" class="mb-2">Start Date:</label>
                                    <input type="date" name="" id="" class="form-control" required>
                                </div>{{-- html date format --}}
                                <div class="col">
                                    <label for="end-date" class="mb-2 ms-2 ">End Date:</label>
                                    <input type="date" name="" id="" class="ms-2 form-control"
                                        required>{{-- html date format --}}
                                </div>
                            </div>

                            <div class="col-md-4 d-flex ">
                                <div class="col">
                                    <label for="start-time" class="mb-2">Start Time:</label>
                                    <input type="time" name="" id="" class="form-control" required>
                                </div>{{-- html time format --}}
                                <div class="col">
                                    <label for="end-time" class="mb-2 ms-2 ">End Time:</label>
                                    <input type="time" name="" id="" class="ms-2 form-control"
                                        required>{{-- html time format --}}
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="test-assigned" class="mb-2">Test Assigned to:</label>
                                <input type="text" name="" placeholder="Test Assigned to" id="test-assigned"
                                    class="form-control mb-3" required>
                            </div>

                            <div class="col-md-4">
                                <label class=" mb-2" for="">Topics:</label>
                                <div class=" select2-dark">{{-- topics multiselect fields --}}
                                    <select id="select2D" class="select2 select-id-change form-select" multiple>
                                        <option value="2">PHP</option>
                                        <option value="2">PYTHON</option>
                                        <option value="2">C</option>
                                        <option value="2">C++</option>
                                        <option value="3">JAVA</option>
                                        <option value="4">ANGULAR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col mt-3 d-flex justify-content-end">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#selectQuestions"
                                    class="btn btn-sm background-secondary text-white">Select Questions</button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#viewSelectedQuestions"
                                    class="btn  ms-3  btn-sm background-info text-white">View Selected Questions</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div style="background-color:#f9fafb" class="card">
                                {{-- form rerpeater fields --}}
                                <div class="ms-2 mx-3 mt-1">
                                    <div class="form-repeater">
                                        <div class="d-md-flex background-secondary align-items-center">
                                            <div class="mb-3 col-md text-center mb-0">
                                                <label class="form-label text-white" for="form-repeater-1-1"><b
                                                        style="  position: relative;bottom: -10px;">College</b></label>
                                            </div>
                                            <div class="mb-3 col-md text-center mb-0">
                                                <label class="form-label text-white" for="form-repeater-1-1"><b
                                                        style="  position: relative;bottom: -10px;">Department</b></label>
                                            </div>
                                            <div class="mb-3 col-md text-center mb-0">
                                                <label class="form-label text-white" for="form-repeater-1-1"><b
                                                        style="  position: relative;bottom: -10px;">Year</b></label>
                                            </div>
                                            <div class="mb-3 col-md text-center mb-0">
                                                <label class="form-label text-white" for="form-repeater-1-1"><b
                                                        style="  position: relative;bottom: -10px;">Select
                                                        Group</b></label>
                                            </div>
                                            <div class="mb-3 col-md text-center mb-0">
                                                <label class="form-label text-white" for="form-repeater-1-1"><b
                                                        style="  position: relative;bottom: -10px;">Actions</b></label>
                                            </div>
                                        </div>
                                        <div data-repeater-list="group-a">
                                            <div data-repeater-item>
                                                <div class="row rows-div mt-1">
                                                    <div class="mb-2 col-md">
                                                        <label class="form-label" for="form-repeater-1-1"><b></b></label>
                                                        <div class="d-flex align-items-center">
                                                            <select name="client" class="form-control" id="client"
                                                                required>
                                                                <option value="" selected disabled>SELECT</option>
                                                                <option value="">STUDY WORLD</option>
                                                                <option value="">PSG</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2 col-md">
                                                        <label class="form-label" for="form-repeater-1-1"><b></b></label>
                                                        <div class="d-flex align-items-center">
                                                            <select name="department" class="form-control"
                                                                id="department" required>
                                                                <option value="" selected disabled>SELECT</option>
                                                                <option value="All">All</option>
                                                                <option value="ECE">ECE</option>
                                                                <option value="CSE">CSE</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2 col-md">
                                                        <label class="form-label" for="form-repeater-1-1"><b></b></label>
                                                        <div class="d-flex align-items-center">
                                                            <select name="year" class="form-control" id="year"
                                                                required>
                                                                <option value="" selected disabled>SELECT</option>
                                                                <option value="All">All</option>
                                                                <option value="1st Year">1st Year</option>
                                                                <option value="2nd Year">2nd Year</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2 col-md">
                                                        <label class="form-label" for="form-repeater-1-1"><b></b></label>
                                                        <div class="select2-dark">
                                                            <select id="select2Darks" class="select-id-change form-select"
                                                                multiple>
                                                                <option value="1">STUDYWORLD-2-3RD-ECE</option>
                                                                <option value="1">STUDYWORLD-3-5TH-ECE</option>
                                                                <option value="1">STUDYWORLD-4-7TH-CIVIL</option>
                                                                <option value="1">PSG-1-2ND-CSE</option>
                                                                <option value="1">PSG-2-3RD-MECH</option>
                                                                <option value="1">PSG-4-7TH-IT</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="text-center pt-0 col-md-2">
                                                        <button type="button" style="margin-top:24px"
                                                            class="btn background-info text-white" data-repeater-delete>
                                                            -
                                                        </button>{{-- remove current row --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-5 ms-3">
                                            <button type="button" class="btn background-secondary text-white"
                                                id="changeIdButton" data-repeater-create>
                                                <i class="bx bx-plus me-1"></i>
                                                <span class="align-middle">Add</span>{{-- Add option to add multiple fields --}}
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

    {{-- select questions of selected topics --}}
    <div class="modal fade" id="selectQuestions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Questions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <table id="" class="table table-responsive">
                            <tbody class="select_question">
                                <tr>
                                    <td><input type="checkbox" name="" style="height:30px;width:30px"
                                            id=""></td>
                                    <td>
                                        Write a program which can compute the factorial of a given numbers.
                                        The results should be printed in a comma-separated sequence on a single line.
                                        Suppose the following input is supplied to the program:
                                        8
                                        Then, the output should be:
                                        40320
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  background-secondary text-white"
                        data-bs-dismiss="modal">SELECT</button>
                </div>
            </div>
        </div>
    </div>

    {{-- view selected questions --}}

    <div class="modal fade" id="viewSelectedQuestions" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selected Questions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <table id="" class="table table-responsive">
                            <tbody class="select_question">
                                <tr>
                                    <td>1)</td>
                                    <td>
                                        Write a program which can compute the factorial of a given numbers.
                                        The results should be printed in a comma-separated sequence on a single line.
                                        Suppose the following input is supplied to the program:
                                        8
                                        Then, the output should be:
                                        40320
                                    </td>
                                </tr>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(() => {
                var selects = $("select.select-id-change");
                selects.each(function(i, select) {
                    $(select).select2({
                        placeholder: "SELECT VALUES",
                        allowClear: true
                    });
                });
            }, 200);

            $('#changeIdButton').on('click', () => {
                setTimeout(() => {
                    var selects = $("select.select-id-change");
                    selects.each(function(i, select) {
                        $(select).select2({
                            placeholder: "SELECT VALUES",
                            allowClear: true
                        });
                    });
                }, 1);
            });
        });
    </script>


@endsection
