@extends('layouts/contentNavbarLayout')

@section('title', $sub_heading)

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
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

        input[type="checkbox"] {
            width: 25px;
            height: 25px;
        }

        .checkbox-span {
            font-size: 20px;
            margin-left: 10px;
            position: relative;
            bottom: 8px;
        }
    </style>
    <div style="color:#9b9b9b;" class="">
        Note: You can only change the group of name and students.
    </div>
    <div class="card">
        <div class="container ">

            <div class="card-body">
                {{-- edit students groups fields --}}
                <form id="myForm">
                    <div class="row col-12">
                        <div class="col-md-6 mb-3">
                            <label for="select-college">GROUP NAME:</label>
                            <input type="text" name="edit_group_name" placeholder="Group Name" id="group-name"
                                onkeyup="nameCheck(this.value)" value="{{ $group_data->group_name }}" class="form-control"
                                id="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="select-college">SELECT COLLEGE:</label>
                            <select name="" class="form-control" id="select-college" disabled>
                                <option value="">SELECT</option>
                                @foreach ($colleges as $col)
                                    <option value="{{ $col->college_id }}"
                                        {{ $col->college_id == $group_data->college_id ? 'selected' : '' }}>
                                        {{ $col->college_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="select-deparment">SELECT DEPARTMENT:</label>
                            <select name="" class="form-control" id="select-deparment" disabled>
                                <option value="">SELECT</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->department_id }}"
                                        {{ $dept->department_id == $group_data->department_id ? 'selected' : '' }}>
                                        {{ $dept->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="select-year">SELECT YEAR:</label>
                            <select name="" class="form-control" id="select-year" disabled>
                                <option value="">SELECT</option>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="select-semester">SELECT SEMESTER:</label>
                            <select name="" class="form-control" id="select-semester" disabled>
                                <option value="">SELECT</option>
                                <option value="1">1st Semester</option>
                                <option value="2">2nd Semester</option>
                                <option value="3">3rd Semester</option>
                                <option value="4">4th Semester</option>
                                <option value="5">5th Semester</option>
                                <option value="6">6th Semester</option>
                                <option value="7">7th Semester</option>
                                <option value="8">8th Semester</option>
                            </select>
                        </div>
                    </div>
                    {{-- list of students in above selected fields --}}
                    <label class="mt-5"><b>EDIT STUDENTS:</b></label>
                    <div class="row col-12 mt-4 edit-students">

                    </div>
                    <div class="mt-4 d-flex justify-content-end">
                        <button type="submit" id="submitBtn" class="btn background-secondary text-white">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        var group_data = @json($group_data);
        $(document).ready(() => {

            var currentPath = window.location.pathname;
            var pathArray = currentPath.split('/');
            var finalIndex = pathArray[pathArray.length - 1];


            $.ajax({
                type: 'GET',
                url: '{{ route('get-data-for-edit') }}',
                data: {
                    id: group_data.group_id,
                },
                success: function(response) {
                    $(".edit-students").append(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });

            $('#select-year').find('option[value="' + group_data.year + '"]').prop('selected', true);
            $('#select-semester').find('option[value="' + group_data.semester + '"]').prop('selected', true);

            $('#myForm').on('submit', function() {
                event.preventDefault();
                var formData = new FormData($('#myForm')[0]);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                formData.append('group_id', finalIndex);

                $.ajax({
                    type: 'POST',
                    url: '{{ route('update-students-group') }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == '200') {
                            window.location.href =
                                "{{ route('managestudents-studentsgroup') }}";
                        }
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            });
        });

        function nameCheck(value) {
            $.ajax({
                type: 'GET',
                url: '{{ route('ajax-student-group-detail') }}',
                success: (response) => {
                    response.map((e) => {
                        if (e.group_name == value && group_data.group_name != value) {
                            alert("This Group Name is already in use !");
                            $("#group-name").val("");
                        }
                    });
                },
                error: (response) => {
                    console.log(response);
                }
            });
        }
    </script>

@endsection
