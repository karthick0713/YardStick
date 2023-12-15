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
    @if (session('error'))
        <div class="error-message col-md-5">
            <div class="alert bg-danger text-white fw-bold">
                <ul>
                    @if (is_array(session('error')))
                        @foreach (session('error') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @else
                        @foreach (session('error')->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    @endif


    @if (session('success'))
        <div class="success-message col-md-5">
            <div class="alert bg-success text-white fw-bold">
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="card">
        <div class="container ">


            <div class="card-body">
                {{-- Make students group fields --}}
                <form action="{{ route('save-student-group') }}" method="post">
                    @csrf
                    <div class="row col-12">
                        <div class="col-md-6 mb-3">
                            <label for="select-college">GROUP NAME:</label>
                            <input type="text" name="group_name" placeholder="Group Name" onkeyup="nameCheck(this.value)"
                                id="group-name" class="form-control" id="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="select-college">SELECT COLLEGE:</label>
                            <select name="college_id" class="form-control" id="select-college" onchange="getStudents()">
                                <option value="" selected>SELECT</option>
                                @foreach ($colleges as $col)
                                    <option value="{{ $col->college_id }}">{{ $col->college_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="select-deparment">SELECT DEPARTMENT:</label>
                            <select name="department_id" class="form-control" id="select-deparment"
                                onchange="getStudents()">
                                <option value="" selected>SELECT</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->department_id }}">{{ $dept->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="select-year">SELECT YEAR:</label>
                            <select name="year" class="form-control" id="select-year" onchange="getStudents()">
                                <option value="" selected>SELECT</option>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="select-semester">SELECT SEMESTER:</label>
                            <select name="semester" class="form-control" id="select-semester" onchange="getStudents()">
                                <option value="" selected>SELECT</option>
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
                        {{-- <div class="col-md-6 mb-3">
                            <div class="col-md-2 mt-4">
                                <button type="button" class="btn background-secondary text-white btn-sm"
                                    onclick="getStudents()">Get
                                    Students</button>
                            </div>
                        </div> --}}
                    </div>

                    {{-- list of students in above selected fields --}}
                    <div class="select_students_for_add_group">

                    </div>

                    <div class="mt-4 d-none d-flex submit-btn justify-content-end">
                        <button type="submit" class="btn background-secondary  text-white">Make Group</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.success-message').fadeIn().delay(3000).fadeOut();
            $('.error-message').fadeIn().delay(3000).fadeOut();
        });

        function getStudents() {

            $(".select_students_for_add_group").empty();
            var college = $("#select-college").val();
            var department = $("#select-deparment").val();
            var year = $("#select-year").val();
            var semester = $("#select-semester").val();
            if (college == "" || department == "" || year == "" || semester == "") {
                return false;
            } else {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('get-students-for-group') }}',
                    data: {
                        'college': college,
                        'department': department,
                        'year': year,
                        'semester': semester,
                    },
                    success: function(response) {
                        $(".select_students_for_add_group").append(response);
                        if (response.status == 200) {
                            $("#submit-btn").hide();
                        } else {
                            $("#submit-btn").show();
                        }
                    }
                });
            }
        }

        function nameCheck(value) {
            $.ajax({
                type: 'GET',
                url: '{{ route('ajax-student-group-detail') }}',
                success: (response) => {
                    response.map((e) => {
                        if (e.group_name == value) {
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
