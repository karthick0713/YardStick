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


                <form id="submitForm" action="{{ route('edit-college-data') }}" method="post" autocomplete="off">
                    @csrf
                    @if (count($data) == 0)
                        <style>
                            .collegeData {
                                display: none;
                            }
                        </style>
                    @endif
                    <div class="collegeData">
                        <div class="background-grey ">
                            <h4 class="fw-bold text-sec-color pt-2 pb-2 "> Correct Unformmatted Data</h4>
                        </div>
                        <br>
                        <table class="collegeTable table table-bordered ">
                            <thead>
                                <th>College Name</th>
                                <th>Email Id</th>
                                <th>Mobile No</th>
                                <th>Alternate Mobile No</th>
                                <th>Address 1</th>
                                <th>Address 2</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Pincode</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $i => $value)
                                    <tr>
                                        <td hidden>
                                            <input type="text" class="form-control" name="college_id[]"
                                                value="{{ $value->college_id }}" id="college_id" required>
                                        </td>
                                        <td><input type="text" class="form-control" name="college_name[]"
                                                value="{{ $value->college_name }}" id="college_name" required></td>
                                        <td class="text-center"><input type="email" class="form-control" name="email_id[]"
                                                value="{{ $value->email_id }}" id="" required>
                                            <span class="error-msg " id="email_error{{ $i }}"></span>
                                        </td>
                                        <td class="text-center"><input type="text" class="form-control"
                                                name="primary_mobile_no[]" value="{{ $value->primary_mobile_no }}"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10"
                                                id="primary_mobile_no" required>
                                            <span class="error-msg "
                                                id="primary_mobile_no_error{{ $i }}"></span>
                                        </td>
                                        <td class="text-center"><input type="text" class="form-control"
                                                name="alternate_mobile_no[]" value="{{ $value->alternate_mobile_no }}"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10"
                                                id="alternate_mobile_no" required>
                                            <span class="error-msg "
                                                id="alternate_mobile_no_error{{ $i }}"></span>
                                        </td>
                                        <td><input type="text" class="form-control" name="address_1[]"
                                                value="{{ $value->address_1 }}" id="address_1" required></td>
                                        <td><input type="text" class="form-control" name="address_2[]"
                                                value="{{ $value->address_2 }}" id="address_2" required></td>
                                        <td><input type="text" class="form-control" name="city[]"
                                                value="{{ $value->city }}" id="city" required></td>
                                        <td class="text-center"><input type="text" class="form-control" name="state_id[]"
                                                value="{{ $value->state_id }}" id="state_id" required>
                                            <span class="error-msg  " id="state_id_error{{ $i }}"></span>
                                        </td>
                                        <td class="text-center"><input type="text" class="form-control" name="country[]"
                                                value="{{ $value->country }}" id="country" required>
                                            <span class="error-msg " id="country_error{{ $i }}"></span>
                                        </td>
                                        <td class="text-center"> <input type="text" class="form-control" name="pincode[]"
                                                value="{{ $value->pincode }}" id="pincode" required>
                                            <span class="error-msg " id="pincode_error{{ $i }}"></span>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <br>
                    </div>
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
                        <p>Duplicate fields are removed. If you want to cancel this process <a
                                href="{{ route('managecolleges-colleges') }}"
                                class="text-white background-info text-decoration-underline"> click here</a></p>
                        <br>
                        <table class="dupTable table table-bordered ">
                            <thead>
                                <th>College Name</th>
                                <th>Email Id</th>
                                <th>Mobile No</th>
                                <th>Alternate Mobile No</th>
                                <th>Address 1</th>
                                <th>Address 2</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Pincode</th>
                            </thead>
                            <tbody id="dup_body">
                                @foreach ($dup_data as $i => $value)
                                    <tr>
                                        <input type="hidden" class="form-control duplicate-fields" name="college_id[]"
                                            value="{{ $value->college_id }}" id="college_id" required>
                                        <td><input type="text" class="form-control duplicate-fields"
                                                name="college_name[]" value="{{ $value->college_name }}"
                                                id="college_name" required>
                                            <span class="error-msg " id="college_name_error{{ $i }}"></span>
                                        </td>
                                        <td class="text-center"><input type="email"
                                                class="form-control duplicate-fields" name="email_id[]"
                                                onkeyup="email_id_check(this)" data-email-id = "{{ $value->email_id }}"
                                                value="{{ $value->email_id }}" id="" required>
                                            <span class="error-msg " id="email_error{{ $i }}"></span>
                                        </td>
                                        <td class="text-center">

                                            <input type="text" class="form-control duplicate-fields"
                                                name="primary_mobile_no[]"
                                                data-primary-mobile-no={{ $value->primary_mobile_no }}
                                                onkeyup="primary_mobile_check(this)"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10"
                                                value="{{ $value->primary_mobile_no }}" id="primary_mobile_no" required>

                                            <span class="error-msg "
                                                id="primary_mobile_no_error{{ $i }}"></span>

                                        </td>
                                        <td class="text-center">

                                            <input type="text" class="form-control duplicate-fields"
                                                name="alternate_mobile_no[]" onkeyup="alternate_mobile_check(this)"
                                                data-alternate-mobile-no="{{ $value->alternate_mobile_no }}"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10"
                                                value="{{ $value->alternate_mobile_no }}" id="alternate_mobile_no"
                                                required>

                                            <span class="error-msg "
                                                id="alternate_mobile_no_error{{ $i }}"></span>

                                        </td>
                                        <td><input type="text" class="form-control duplicate-fields"
                                                name="address_1[]" value="{{ $value->address_1 }}" id="address_1"
                                                required></td>
                                        <td><input type="text" class="form-control duplicate-fields"
                                                name="address_2[]" value="{{ $value->address_2 }}" id="address_2"
                                                required></td>
                                        <td><input type="text" class="form-control duplicate-fields" name="city[]"
                                                value="{{ $value->city }}" id="city" required></td>
                                        <td class="text-center"><input type="text" name="state_id[]"
                                                class="form-control duplicate-fields " value="{{ $value->state_id }}"
                                                id="state_id" required>
                                            <span class="error-msg " id="state_id_error{{ $i }}"></span>
                                        </td>
                                        <td class="text-center"><input type="text" name="country[]"
                                                class="form-control duplicate-fields" value="{{ $value->country }}"
                                                id="country" required>
                                            <span class="error-msg " id="country_error{{ $i }}"></span>
                                        </td>
                                        <td class="text-center"> <input type="text" name="pincode[]"
                                                class="form-control duplicate-fields " value="{{ $value->pincode }}"
                                                id="pincode" required>
                                            <span class="error-msg " id="pincode_error{{ $i }}"></span>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">

                        <button type="button" id='submitBtn'
                            class="btn ms-3 background-secondary text-white">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        var submit_form;
        $(window).on('beforeunload', function() {
            if (submit_form == null && submit_form == '') {
                var inputFields = document.querySelectorAll('input[type="text"], input[type="email"]');
                for (var i = 0; i < inputFields.length; i++) {
                    if (inputFields[i].value.trim() !== '') {
                        event.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
                        return event.returnValue;
                    }
                }
            }

        });
        var colleges;
        $(document).ready(() => {

            $("a").click(() => {
                window.location.href = "{{ route('managecolleges-colleges') }}";
            });


            $("#submitForm").click();
            $.ajax({
                url: "{{ route('ajax-get-colleges') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    colleges = response;

                    var hasDuplication = false;

                    $('.dupTable tr:gt(0)').each(function() {
                        var collegeName = $(this).find('td:eq(0) input').val();
                        var emailId = $(this).find('td:eq(1) input').val();
                        var mobileNo = $(this).find('td:eq(2) input').val();
                        var alternateMobileNo = $(this).find('td:eq(3) input').val();

                        var foundcollege = colleges.find(function(item) {
                            return item.college_name === collegeName;
                        });
                        var foundemail = colleges.find(function(item) {
                            return item.email_id === emailId;
                        });
                        var foundmobile = colleges.find(function(item) {
                            return item.email_id === emailId;
                        });
                        var foundaltermobile = colleges.find(function(item) {
                            return item.email_id === emailId;
                        });

                        if (foundcollege) {
                            $(this).find('td:eq(0) input').val("");
                            hasDuplication = true;
                        }

                        if (foundemail) {
                            $(this).find('td:eq(1) input').val("");
                            hasDuplication = true;
                        }
                        if (foundmobile) {
                            $(this).find('td:eq(2) input').val("");
                            hasDuplication = true;
                        }
                        if (foundaltermobile) {
                            $(this).find('td:eq(3) input').val("");
                            hasDuplication = true;
                        }


                    });
                    // if (hasDuplication) {
                    //     alert('Please Check Excel Fields and Try Again ');
                    //     window.location.href = "{{ route('managecolleges-colleges') }}";
                    // }



                },
                error: function(error) {
                    console.log(error);
                }
            });
            var valuesArray = [];
        });


        $(document).ready(function() {
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
                    var collegeName = $(this).find('[name="college_name[]"]');
                    var email = $(this).find('[name="email_id[]"]');
                    var mobileNo = $(this).find('[name="primary_mobile_no[]"]');
                    var alternateMobileNo = $(this).find('[name="alternate_mobile_no[]"]');
                    var stateId = $(this).find('[name="state_id[]"]');
                    var country = $(this).find('[name="country[]"]');
                    var pincode = $(this).find('[name="pincode[]"]');

                    if (!validateInput(collegeName, /.+/, '#college_name_error' + $(this)
                            .index())) {
                        isValid = false;
                    }

                    if (!validateInput(email, emailRegex, '#email_error' + $(this).index())) {
                        isValid = false;
                    }

                    if (!validateInput(mobileNo, mobileRegex, '#primary_mobile_no_error' + $(this)
                            .index())) {
                        isValid = false;
                    }

                    if (!validateInput(stateId, stateRegex, '#state_id_error' + $(this)
                            .index())) {
                        isValid = false;
                    }

                    if (!validateInput(pincode, pincodeRegex, '#pincode_error' + $(this)
                            .index())) {
                        isValid = false;
                    }

                    if (!validateInput(alternateMobileNo, mobileRegex,
                            '#alternate_mobile_no_error' + $(this).index())) {
                        isValid = false;
                    }

                });

                $('.dupTable tbody tr').each(function() {
                    var collegeName = $(this).find('[name="college_name[]"]');
                    var email = $(this).find('[name="email_id[]"]');
                    var mobileNo = $(this).find('[name="primary_mobile_no[]"]');
                    var alternateMobileNo = $(this).find('[name="alternate_mobile_no[]"]');
                    var stateId = $(this).find('[name="state_id[]"]');
                    var country = $(this).find('[name="country[]"]');
                    var pincode = $(this).find('[name="pincode[]"]');

                    if (!validateInput(collegeName, /.+/, '#college_name_error' + $(this)
                            .index())) {
                        isValid = false;
                    }

                    if (!validateInput(email, emailRegex, '#email_error' + $(this).index())) {
                        isValid = false;
                    }

                    if (!validateInput(mobileNo, mobileRegex, '#primary_mobile_no_error' + $(this)
                            .index())) {
                        isValid = false;
                    }

                    if (!validateInput(stateId, stateRegex, '#state_id_error' + $(this)
                            .index())) {
                        isValid = false;
                    }

                    if (!validateInput(pincode, pincodeRegex, '#pincode_error' + $(this)
                            .index())) {
                        isValid = false;
                    }

                    if (!validateInput(alternateMobileNo, mobileRegex,
                            '#alternate_mobile_no_error' + $(this).index())) {
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

        function submitform() {

            var submit = localStorage.getItem('submitId');
            if (submit == 1) {
                console.log('tt')
                $('#submitForm').submit();
            }
        }

        $(document).ready(function() {
            $("button").click(function() {
                $("#submitBtn").on("click", function() {
                    var submit = localStorage.getItem('submitId');
                    if (submit == 1) {
                        submit_form = true;
                        $("#submitForm").submit();
                    } else {
                        event.preventDefault();
                    }
                });
            })
        });

        function check_duplicate_values(input_field, field_check, error_message) {
            var value = input_field.value;
            var valuesToCheck = colleges.map(function(col) {
                return col[field_check];
            });

            if (valuesToCheck.includes(value)) {
                alert(error_message);
                input_field.value = "";
            }
        }

        function primary_mobile_check(input_field) {
            check_duplicate_values(input_field, 'primary_mobile_no', 'This mobile number already exists!');
        }

        function alternate_mobile_check(input_field) {
            check_duplicate_values(input_field, 'alternate_mobile_no', 'This mobile number already exists!');
        }

        function email_id_check(input_field) {
            check_duplicate_values(input_field, 'email_id', 'This Email ID already exists!');
        }
    </script>

@endsection
