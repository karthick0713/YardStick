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
                <div class="background-grey ">
                    <h4 class="fw-bold text-sec-color pt-2 pb-2 "> Correct Unformmatted Data</h4>
                </div>
                <br>

                <form id="submitForm" action="{{ route('edit-college-data') }}" method="post">
                    @csrf
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
                                            id="primary_mobile_no" required>
                                        <span class="error-msg " id="primary_mobile_no_error{{ $i }}"></span>
                                    </td>
                                    <td class="text-center"><input type="text" class="form-control"
                                            name="alternate_mobile_no[]" value="{{ $value->alternate_mobile_no }}"
                                            id="alternate_mobile_no" required>
                                        <span class="error-msg " id="alternate_mobile_no_error{{ $i }}"></span>
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
                        {{-- <div class="d-flex justify-content-end align-items-center">
                        <label for="" class="fw-bold text-sec-color">Do You want to edit the data ?</label>
                        <button type="button" onclick="editDuplicate()"
                            class="btn ms-2 btn-sm background-info text-white">Yes</button>
                        <button type="button" onclick="editDuplicateNo()"
                            class="btn ms-1 btn-sm background-info text-white">No</button>
                    </div> --}}
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
                                        <td hidden>
                                            <input type="text" class="form-control duplicate-fields"
                                                value="{{ $value->college_id }}" id="college_id" required readonly>
                                        </td>
                                        <td><input type="text" class="form-control duplicate-fields"
                                                value="{{ $value->college_name }}" id="college_name" required readonly>
                                        </td>
                                        <td class="text-center"><input type="email" class="form-control duplicate-fields"
                                                value="{{ $value->email_id }}" id="" required readonly>
                                            <span class="error-msg " id="email_error{{ $i }}"></span>
                                        </td>
                                        <td class="text-center"><input type="text"
                                                class="form-control duplicate-fields"
                                                value="{{ $value->primary_mobile_no }}" id="primary_mobile_no" required
                                                readonly>
                                            <span class="error-msg "
                                                id="primary_mobile_no_error{{ $i }}"></span>
                                        </td>
                                        <td class="text-center"><input type="text"
                                                class="form-control duplicate-fields"
                                                value="{{ $value->alternate_mobile_no }}" id="alternate_mobile_no"
                                                required readonly>
                                            <span class="error-msg "
                                                id="alternate_mobile_no_error{{ $i }}"></span>
                                        </td>
                                        <td><input type="text" class="form-control duplicate-fields"
                                                value="{{ $value->address_1 }}" id="address_1" required readonly></td>
                                        <td><input type="text" class="form-control duplicate-fields"
                                                value="{{ $value->address_2 }}" id="address_2" required readonly></td>
                                        <td><input type="text" class="form-control duplicate-fields"
                                                value="{{ $value->city }}" id="city" required readonly></td>
                                        <td class="text-center"><input type="text"
                                                class="form-control duplicate-fields " value="{{ $value->state_id }}"
                                                id="state_id" required readonly>
                                            <span class="error-msg  " id="state_id_error{{ $i }}"></span>
                                        </td>
                                        <td class="text-center"><input type="text"
                                                class="form-control duplicate-fields" value="{{ $value->country }}"
                                                id="country" required readonly>
                                            <span class="error-msg " id="country_error{{ $i }}"></span>
                                        </td>
                                        <td class="text-center"> <input type="text"
                                                class="form-control duplicate-fields " value="{{ $value->pincode }}"
                                                id="pincode" required readonly>
                                            <span class="error-msg " id="pincode_error{{ $i }}"></span>
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
        // $(window).on('beforeunload', function() {
        //     var inputFields = document.querySelectorAll('input[type="text"], input[type="email"]');
        //     for (var i = 0; i < inputFields.length; i++) {
        //         if (inputFields[i].value.trim() !== '') {
        //             event.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
        //             return event.returnValue;
        //         }
        //     }
        // });


        $(document).ready(function() {
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

            $('#submitForm').on('click', function(event) {
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
                localStorage.removeItem('submitId');
                $('#submitForm').submit();
            }
        }
    </script>

@endsection
