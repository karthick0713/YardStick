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
    </style>


    <div class="card">
        <div class="container">
            <div class="card-body">
                <form action="{{ route('save-test') }}" method="POST">
                    @csrf
                    {{-- Add test fields --}}
                    <div class="col-12 fw-bold">
                        <div class="row  mb-5 ms-2">

                            <div class="col-md-6  text-center">
                                <label for="title" class="mb-2">Title <span class="text-danger">
                                        *</span></label>
                                <input type="text" style="height:45px" name="test_title" id="title"
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
                                <div class="ms-2 mx-3 mt-1 ">
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
                        </div>



                        <div class="mt-5 d-flex justify-content-end">
                            <button type="submit" class="btn background-secondary text-white">Submit</button>
                        </div>

                    </div>


                    <script>
                        $(document).ready(function() {
                            $('input[type="checkbox"]').click(function(e) {
                                var checkboxes = $(this).closest('.col-md-2').find('input[type="checkbox"]');
                                checkboxes.prop('checked', false);
                                $(this).prop('checked', true);
                            });

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
