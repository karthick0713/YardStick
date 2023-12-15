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
            width: 350px;
        }

        .form-control {
            border-radius: 0%;
        }

        .error-message {
            display: none;
        }
    </style>


    <div class="container">
        <div class="error-message col-md-5">
            <div class="alert bg-danger text-white fw-bold">
                All fields are required..!
            </div>
        </div>
        <div class="row col-12">
            <div class="table-responsive">

                <form id="submitForm" action="{{ route('submit-edited-imported-group-data') }}" method="post">
                    @csrf
                    @if (count($group_data) == 0)
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
                        <p>Duplicate fields are removed. If you want to cancel this process <a href="#"
                                class="text-white redirect background-info text-decoration-underline"> click here</a></p>
                        <br>

                        <table class="dupTable table table-bordered ">
                            <thead>
                                <th>Group Name</th>
                                <th>College</th>
                                <th>Department</th>
                                <th>Year</th>
                                <th>Semester</th>
                                <th>Students</th>
                            </thead>
                            <tbody id="dup_body">
                                @foreach ($group_data as $i => $value)
                                    @php
                                        $students = DB::table('student_group_entry')
                                            ->where('group_id', $value->group_id)
                                            ->get();
                                        $stu_reg_no_array = [];
                                        foreach ($students as $stu) {
                                            $stu_reg_no_array[] = $stu->register_no;
                                        }
                                        $stu_reg_no = implode(', ', $stu_reg_no_array);
                                    @endphp

                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="group_name[]"
                                                onkeyup="group_name_check(this)" value="{{ $value->group_name }}"
                                                id="" required>
                                            <span class="error-msg " id="{{ $i }}_error"></span>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="college_id[]"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')"
                                                value="{{ $value->college_id }}" id="" required>
                                            <span class="error-msg " id="{{ $i }}_error"></span>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="department_id[]"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')"
                                                value="{{ $value->department_id }}" id="" required>
                                            <span class="error-msg " id="{{ $i }}_error"></span>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="year[]"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')"
                                                value="{{ $value->year }}" id="" required>
                                            <span class="error-msg " id="{{ $i }}_error"></span>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="semester[]"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')"
                                                value="{{ $value->semester }}" id="" required>
                                            <span class="error-msg " id="{{ $i }}_error"></span>
                                        </td>
                                        <td>

                                            <input type="text" class="form-control" name="students[]"
                                                oninput=" this.value = this.value.replace(/[^0-9]/g, '')"
                                                value="{{ $stu_reg_no }}" id="" required>
                                            <span class="error-msg " id="{{ $i }}_error"></span>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" onclick="checkInputValues()"
                            class="btn background-secondary text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var groups = @json($org_group);

        $(document).ready(function() {
            $(".redirect").click(() => {
                window.location.href = "{{ route('managestudents-importstudents') }}";
            });

            var hasDuplication = false;

            $('.dupTable tr:gt(0)').each(function() {
                var groupName = $(this).find('td:eq(0) input').val();
                var foundGroup = groups.find(function(item) {
                    return item.group_name === groupName;
                });

                if (foundGroup) {
                    $(this).find('td:eq(0) input').val("");
                    hasDuplication = true;
                }
            });

        });


        function check_duplicate_values(input_field, field_check, error_message) {
            var value = input_field.value;
            var valuesToCheck = groups.map(function(col) {
                return col[field_check];
            });

            if (valuesToCheck.includes(value)) {
                alert(error_message);
                input_field.value = "";
            }
        }

        function group_name_check(input_field) {
            check_duplicate_values(input_field, 'group_name', 'This Group Name already exists!');
        }

        function checkInputValues() {
            var table = document.querySelector(".dupTable");
            var rows = table.querySelectorAll("tbody tr");
            var error_display = false;
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                for (var j = 0; j < cells.length; j++) {
                    var input = cells[j].querySelector("input");
                    var value = input.value.trim();
                    if (value === "") {
                        if (!error_display) {
                            $(".error-message").fadeIn().delay(3000).fadeOut();
                            error_display = true;
                        }
                    }
                }
            }

            if (!error_display) {
                $("#submitForm").submit();
            }
        }
    </script>

@endsection
