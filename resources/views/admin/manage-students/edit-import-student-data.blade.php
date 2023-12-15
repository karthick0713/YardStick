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
        th {
            text-align: center;
        }

        span {
            color: red;
        }

        input:focus {
            width: 200px;
        }

        .form-control {
            border-radius: 0%;
        }
    </style>


    <div class="container">
        <div class="row col-12">
            <div class="table-responsive">

                <form id="submitForm" action="{{ route('submit-excel-edit-data') }}" method="post">

                    @if (count($data) == 0)
                        <style>
                            .unformmated_data {
                                display: none;
                            }
                        </style>
                    @endif
                    <div class="unformmated_data">
                        <div class="background-grey ">
                            <h4 class="fw-bold text-sec-color pt-2 pb-2 "> Correct Unformmatted Data</h4>
                        </div>
                        <br>

                        @csrf
                        <table class="collegeTable table table-bordered ">
                            <thead>
                                <th>College Name</th>
                                <th>Skills</th>
                                <th>Student Name</th>
                                <th>Register No</th>
                                <th>Email Id</th>
                                <th>Mobile No</th>
                                <th>Department</th>
                                <th>Year</th>
                                <th>Semester</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $i => $value)
                                    <tr>
                                        <td hidden>
                                            <input type="text" class="form-control" name="student_id[]"
                                                value="{{ $value->student_id }}" id="student_id" required>
                                        </td>
                                        <td><input type="text" class="form-control" name="college_id[]"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')"
                                                value="{{ $value->college_id }}" id="college_id" required></td>
                                        <td><input type="text" class="form-control" name="skills_id[]"
                                                value="{{ $value->skills_id }}" id="skills_id" required></td>
                                        <td class="text-center"><input type="text" class="form-control"
                                                name="student_name[]" value="{{ $value->student_name }}" id=""
                                                required>
                                        </td>
                                        <td class="text-center"><input type="text" class="form-control"
                                                onkeyup="register_no_check(this)" name="register_no[]"
                                                value="{{ $value->register_no }}" id="register_no" required>
                                            <span class="error-msg " id="register_no_error{{ $i }}"></span>
                                        </td>
                                        <td class="text-center"><input type="email" class="form-control" name="email_id[]"
                                                onkeyup="email_id_check(this)" value="{{ $value->email_id }}"
                                                id="email_id" required>
                                            <span class="error-msg " id="email_id_error{{ $i }}"></span>
                                        </td>
                                        <td class="text-center"><input type="text" class="form-control"
                                                onkeyup="mobile_no_check(this)" name="mobile_no[]"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10"
                                                value="{{ $value->mobile_no }}" id="mobile_no" required>
                                            <span class="error-msg " id="mobile_no_error{{ $i }}"></span>
                                        </td>
                                        <td class="text-center"><input type="text" class="form-control"
                                                name="department_id[]" value="{{ $value->department_id }}"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')" id="department_id"
                                                required>
                                        </td>
                                        <td class="text-center"><input type="text" class="form-control" name="year[]"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')"
                                                value="{{ $value->year }}" id="year" required>
                                        </td>
                                        <td class="text-center"> <input type="text" class="form-control"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')" name="semester[]"
                                                value="{{ $value->semester }}" id="semester" required>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <br>
                    @if (count($dup_data) == 0)
                        <style>
                            .dupData {
                                display: none;
                            }
                        </style>
                    @endif
                    <div class="dupData">
                        <div class="background-grey ">
                            <h4 class="fw-bold text-sec-color pt-2 pb-2 "> Duplicate Values</h4>
                        </div>
                        <br>
                        <p>Duplicate fields are removed. If you want to cancel this process <a href=""
                                class="text-white background-info text-decoration-underline"> click here</a></p>
                        <br>

                        <table class="dupTable table table-bordered ">
                            <thead>
                                <th>College Name</th>
                                <th>Skills</th>
                                <th>Student Name</th>
                                <th>Register No</th>
                                <th>Email Id</th>
                                <th>Mobile No</th>
                                <th>Department</th>
                                <th>Year</th>
                                <th>Semester</th>
                            </thead>
                            <tbody id="dup_body">
                                @foreach ($dup_data as $i => $value)
                                    <tr>
                                        <td hidden>
                                            <input type="text" class="form-control" name="student_id[]"
                                                value="{{ $value->student_id }}" id="student_id" required>
                                        </td>

                                        <td>
                                            <input type="text" class="form-control" name="college_id[]"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')"
                                                value="{{ $value->college_id }}" id="college_id" required>
                                        </td>

                                        <td>
                                            <input type="text" class="form-control" name="skills_id[]"
                                                value="{{ $value->skills_id }}" id="skills_id" required>
                                        </td>

                                        <td class="text-center">
                                            <input type="text" class="form-control" name="student_name[]"
                                                value="{{ $value->student_name }}" id="" required>
                                        </td>

                                        <td class="text-center">
                                            <input type="text" class="form-control" name="register_no[]"
                                                onkeyup="register_no_check(this)"
                                                data-register-no="{{ $value->register_no }}"
                                                value="{{ $value->register_no }}" id="register_no" required>
                                            <span class="error-msg " id="register_no_error{{ $i }}"></span>
                                        </td>

                                        <td class="text-center">
                                            <input type="email" class="form-control" name="email_id[]"
                                                onkeyup="email_id_check(this)" data-email-id="{{ $value->email_id }}"
                                                value="{{ $value->email_id }}" id="email_id" required>
                                            <span class="error-msg " id="email_id_error{{ $i }}"></span>
                                        </td>

                                        <td class="text-center">
                                            <input type="text" class="form-control mobile_no" name="mobile_no[]"
                                                value="{{ $value->mobile_no }}" id="mobile_no"
                                                data-mobile-no="{{ $value->mobile_no }}"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10"
                                                onkeyup="mobile_no_check(this)" required>
                                            <span class="error-msg " id="mobile_no_error{{ $i }}"></span>
                                        </td>

                                        <td class="text-center">
                                            <input type="text" class="form-control" name="department_id[]"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')"
                                                value="{{ $value->department_id }}" id="department_id" required>
                                        </td>

                                        <td class="text-center">
                                            <input type="text" class="form-control" name="year[]"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')"
                                                value="{{ $value->year }}" id="year" required>
                                        </td>

                                        <td class="text-center"> <input type="text" class="form-control"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')"
                                                name="semester[]" value="{{ $value->semester }}" id="semester"
                                                required>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" onclick="submitform()"
                            class="btn background-secondary text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {


            $("a").click(() => {
                window.location.href = "{{ route('managestudents-importstudents') }}";
            });


            localStorage.removeItem('submitId');

            function validateInput(input, regex, errorMsgSelector) {
                var isValid = regex.test(input.val());

                if (isValid) {
                    $(errorMsgSelector).text('');
                } else {
                    $(errorMsgSelector).text('Invalid input');
                }

                return isValid;
            }

            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            var mobileRegex = /^\d{10}$/;
            var pincodeRegex = /^[1-9][0-9]{5}$/;
            var stateRegex = /^\d{1,2}$/;

            $('#submitForm').on('keyup click', function(event) {
                var isValid = true;

                $('.collegeTable tbody tr').each(function() {
                    var email = $(this).find('[name="email_id[]"]');
                    var mobileNo = $(this).find('[name="mobile_no[]"]');

                    if (!validateInput(email, emailRegex, '#email_id_error' + $(this).index())) {
                        isValid = false;
                    }

                    if (!validateInput(mobileNo, mobileRegex, '#mobile_no_error' + $(this)
                            .index())) {
                        isValid = false;
                    }

                });

                if (isValid) {
                    event.preventDefault();
                    localStorage.setItem('submitId', 1);
                } else {
                    event.preventDefault();
                }
            });
        });


        var student_data = @json($students_data);

        $(document).ready(() => {
            var hasDuplication = false;
            var arrayData = [];
            $('.dupTable tr:gt(0)').each(function() {
                var studentName = $(this).find('td:eq(3) input').val();
                var registerNo = $(this).find('td:eq(4) input').val();
                var emailId = $(this).find('td:eq(5) input').val();
                var mobileNo = $(this).find('td:eq(6) input').val();

                var foundStudent = student_data.find(function(item) {
                    return item.student_name === studentName;
                });
                var foundemail = student_data.find(function(item) {
                    return item.email_id === emailId;
                });

                var foundRegisterNo = student_data.find(function(item) {
                    return item.register_no === registerNo;
                });

                var foundmobile = student_data.find(function(item) {
                    return item.mobile_no === Number(mobileNo);
                });

                if (foundStudent) {
                    $(this).find('td:eq(3) input').val("");
                    hasDuplication = true;
                }

                if (foundRegisterNo) {
                    $(this).find('td:eq(4) input').val("");
                    hasDuplication = true;
                }

                if (foundemail) {
                    $(this).find('td:eq(5) input').val("");
                    hasDuplication = true;
                }
                if (foundmobile) {
                    $(this).find('td:eq(6) input').val("");
                    hasDuplication = true;
                }

                arrayData.push(foundStudent, foundRegisterNo, foundemail, foundmobile)
            });

            if (arrayData.length > 100) {
                if (confirm('There are more than 100 duplicate fields. Do you want to Continue?')) {
                    return true;
                } else {
                    window.location.href = "{{ route('managestudents-importstudents') }}";
                }
            }
        });

        function check_duplicate_values(input_field, field_check, error_message) {
            var value = input_field.value;
            var valuesToCheck = student_data.map(function(col) {
                return col[field_check];
            });

            if (valuesToCheck.includes(value)) {
                alert(error_message);
                input_field.value = "";
            }
        }

        function email_id_check(input_field) {
            check_duplicate_values(input_field, 'email_id', 'This Email ID already exists!');
        }

        function mobile_no_check(input_field) {
            check_duplicate_values(input_field, 'mobile_no', 'This mobile number already exists!');
        }

        function register_no_check(input_field) {
            check_duplicate_values(input_field, 'register_no', 'This mobile number already exists!');
        }

        function submitform() {
            var submit = localStorage.getItem('submitId');
            if (submit == 1) {
                localStorage.removeItem('submitId');
                $('#submitForm').submit();
            }
        }
    </script>

@endsection
