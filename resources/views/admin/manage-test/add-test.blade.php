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
                <form action="">
                    {{-- Add test fields --}}
                    <div class="col-12 fw-bold">
                        <div class="row  mb-5 ms-2">

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
                                    required> {{-- Only numbers should be allowed --}}
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
                                </div>
                                <div class="col">
                                    <label for="end-date" class="mb-2 ms-2 ">End Date:</label>
                                    <input type="date" name="" id="" class="ms-2 form-control"
                                        required>{{-- Html date format --}}
                                </div>
                            </div>

                            <div class="col-md-4 d-flex ">
                                <div class="col">
                                    <label for="start-time" class="mb-2">Start Time:</label>
                                    <input type="time" name="" id="" class="form-control" required>
                                </div>
                                <div class="col">
                                    <label for="end-time" class="mb-2 ms-2 ">End Time:</label>
                                    <input type="time" name="" id="" class="ms-2 form-control"
                                        required> {{-- Html time format --}}
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="test-assigned" class="mb-2">Test Assigned to:</label>
                                <input type="text" name="" placeholder="Test Assigned to" id="test-assigned"
                                    class="form-control mb-3" required>
                            </div>

                            <div class="col">
                                <div class="mt-2 d-flex">
                                    <label class="align-items-center" for="category">Questions:</label>
                                    <div class="col text-center">
                                        <label class="ms-2" for="category">Easy (100)</label>{{-- change the numbers to dynamically from db --}}
                                        <input type="number" class="form-control " name="" required
                                            placeholder="Easy" id="">
                                    </div>
                                    <div class="col  text-center">
                                        <label class="ms-3" for="category">Medium (125)</label>{{-- change the numbers to dynamically from db --}}
                                        <input type="number" class="form-control ms-2" name="" required
                                            placeholder="Medium" id="">
                                    </div>
                                    <div class="col  text-center">
                                        <label class="ms-3" for="category">Hard (137)</label> {{-- change the numbers to dynamically from db --}}
                                        <input type="number" class="form-control ms-3" name="" required
                                            placeholder="Hard" id="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
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
                                        <div data-repeater-list="group-a">
                                            <div data-repeater-item>
                                                <div class="row rows-div mt-1">
                                                    <div class=" mb-2 col mb-0">
                                                        <label class="form-label" for="form-repeater-1-1"><b></b></label>
                                                        <div class="d-flex align-items-center">
                                                            <select name="client" class="form-control" id="client"
                                                                required>
                                                                <option value="" selected disabled>SELECT</option>
                                                                <option value="StudyWorld">Study World </option>
                                                                <option value="PSG">PSG</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class=" mb-2 col mb-0">
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
                                                    <div class=" mb-2 col mb-0">
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
                                                    <div class=" mb-2 col mb-0">
                                                        <label class="form-label" for="form-repeater-1-1"><b></b></label>
                                                        <div class=" select2-dark">
                                                            <select id="select2Darks"
                                                                class=" select-id-change form-select" multiple>
                                                                <option value="1">STUDYWORLD-2-3RD-ECE</option>
                                                                <option value="1">STUDYWORLD-3-5TH-ECE</option>
                                                                <option value="1">STUDYWORLD-4-7TH-CIVIL</option>
                                                                <option value="1">PSG-1-2ND-CSE</option>
                                                                <option value="1">PSG-2-3RD-MECH</option>
                                                                <option value="1">PSG-4-7TH-IT</option>
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
                                            <button type="button" class="btn background-secondary text-white"
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
        $(document).ready(function() {

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
    </script>


@endsection
