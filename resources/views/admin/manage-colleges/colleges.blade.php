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
    <script src="{{ asset('assets/js/pagenation.js') }}"></script>

    <script src="{{ asset('assets/js/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
@endsection

@section('content')

    <style>
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

        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }
    </style>

    <div class="container mt-4">

        @if (session('success'))
            <div class="success-message col-md-5">
                <div class="alert bg-success text-white fw-bold">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="error-message col-md-5">
                <div class="alert bg-danger text-white fw-bold">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        <div class="mb-2">
            <a data-bs-toggle="modal" data-bs-target="#addCollege" class="button-plus-icon"><i
                    class='plus-icon bx bxs-plus-circle'></i></a>
        </div>
        <div class="card ">
            <!--<h5 class="card-header"><b>CollegeS</b></h5>-->

            {{-- list of colleges table --}}
            <div class="table-responsive  text-nowrap">
                <table id="dtExample" class=" display table table-striped">
                    <thead class="background-secondary">
                        <tr class="text-white">
                            <th scope="col" class="text-white text-center">NAME</th>
                            <th scope="col" class="text-white text-center">EMAIL</th>
                            <th scope="col" class="text-white text-center">TOTAL STUDENTS</th>
                            <th scope="col" class="text-white text-center">MOBILE</th>
                            <th scope="col" class="text-white text-center">ACTIVE</th>
                            <th scope="col" class="text-white text-center">ACTIONS</th>
                        </tr>

                        <tr class="background-grey">
                            <th scope="col"><input type="search" name="" class="form-control"
                                    placeholder="Search college" id=""></th>
                            <th scope="col"><input type="search" name="" class="form-control"
                                    placeholder="Search email" id=""></th>
                            <th scope="col"><input type="search" name="" class="form-control"
                                    placeholder="Search students" id=""> </th>
                            <th scope="col"><input type="search" name="" class="form-control"
                                    placeholder="Search mobile" id=""></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $key => $value)
                            <tr>
                                <td>{{ $value->college_name }}</td>
                                <td>{{ $value->email_id }}</td>

                                <td>
                                    @php
                                        $total_students = DB::table('master_students')
                                            ->where('college_id', $value->college_id)
                                            ->where('error_key', 0)
                                            ->where('trash_key', 1)
                                            ->get();
                                        echo count($total_students) . ' students';

                                    @endphp
                                </td>
                                <td>{{ $value->primary_mobile_no }}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" {{ $value->is_active == 1 ? 'checked' : '' }}
                                            onclick="statusChange({{ $value->college_id }},{{ $value->is_active }})"
                                            id="statusToggle">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <a class="icon-buttons" onclick="viewCollege({{ $value->college_id }})"><i
                                            class="bx bx-show-alt"></i></a>
                                    <a class="icon-buttons" onclick="editModal({{ $value->college_id }})"><i
                                            class="bx bx-edit-alt"></i></a>
                                    <a onclick="deleteModal({{ $value->college_id }})" class="text-black icon-buttons"><i
                                            class="bx bxs-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>


                    </tfoot>
                </table>
            </div>
        </div>

        {{-- pagenations --}}
        <div class="pagination-flex-container justify-content-end mt-5" id="pagination">
            <button class="page-link btn-sm" id="previous" disabled>Previous</button>
            <div id="page-numbers" class="pagination-flex-container"></div>
            <button class="page-link btn-sm" id="next">Next</button>
        </div>
    </div>

    {{-- add college Modal --}}

    <div class="modal fade" id="addCollege" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New College</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="clearForm()"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row col-12">
                        <form id="add-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="college" class="col-form-label">College Name:</label>
                                    <input type="text" name="college_name" class="form-control" id=""
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="" class="col-form-label">Email:</label>
                                    <input type="email" name="email_id" class="form-control" id="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" class="col-form-label">Mobile No:</label>
                                    <input type="text" name="mobile_no" class="form-control" maxlength="10"
                                        id="" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                    {{-- only numbers should be allowed --}}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="department" class="col-form-label">Alternate Mobile No:</label>
                                    <input type="text" name="alternate_mobile" class="form-control" maxlength="10"
                                        id="" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                    {{-- only numbers should be allowed --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="batch" class="col-form-label">Address_1:</label>
                                    <input type="text" name="address_1" class="form-control" id="" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="batch" class="col-form-label">Address_2:</label>
                                    <input type="text" name="address_2" class="form-control" id="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="batch" class="col-form-label">City:</label>
                                    <input type="text" name="city" class="form-control" id="" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="state" class="col-form-label">State:</label>
                                    <select name="state" class="form-control" id="state-details">
                                        <option value="" selected disabled>SELECT</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="country" class="col-form-label">Country:</label>
                                    <select name="country" class="form-control" id="country" required>
                                        <option value="" selected disabled>SELECT</option>
                                        <option value="1">India</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pincode" class="col-form-label">Pincode:</label>
                                    <input type="text" name="pincode" class="form-control"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="6"
                                        id="pincode" required> {{-- only numbers should be allowed --}}
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn text-white background-secondary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- view modal --}}
    <div class="modal fade" id="viewCollege" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View College Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <table id="" class="table table-responsive">
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- edit Modal --}}
    <div class="modal fade" id="editCollege" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit College Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row col-12">
                        <form id="edit-form" onsubmit="return editCollege()">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="College" class="col-form-label">College Name:</label>
                                    <input type="text" class="form-control" id="edit_college_name"
                                        name="edit_college_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="" class="col-form-label">Email:</label>
                                    <input type="text" class="form-control" name="edit_email" id="edit_email"
                                        id="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" class="col-form-label">Mobile No:</label>
                                    <input type="text" class="form-control" maxlength="10" id="edit_mobile_no"
                                        name="edit_mobile_no" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        required>
                                    {{-- only numbers should be allowed --}}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="department" class="col-form-label">Alternate Mobile No:</label>
                                    <input type="text" class="form-control" maxlength="10" id="edit_alternate_mobile"
                                        name="edit_alternate_mobile"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                    <input type="hidden" name="college_id" id="college_id">
                                    {{-- only numbers should be allowed --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="batch" class="col-form-label">Address_1:</label>
                                    <input type="text" class="form-control" value="" id="edit_address_1"
                                        name="edit_address_1" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="batch" class="col-form-label">Address_2:</label>
                                    <input type="text" class="form-control" value="" id="edit_address_2"
                                        name="edit_address_2" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="batch" class="col-form-label">City:</label>
                                    <input type="text" class="form-control" value="" id="edit_city"
                                        name="edit_city" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="state" class="col-form-label">State:</label>
                                    <select name="edit_state" class="form-control" id="edit_state">
                                        <option value="" disabled>SELECT</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="country" class="col-form-label">Country:</label>
                                    <select name="edit_country" class="form-control" id="edit_country" required>
                                        <option value="" disabled>SELECT</option>
                                        <option value="1">India</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pincode" class="col-form-label">Pincode:</label>
                                    <input type="text" class="form-control" value=""
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="6"
                                        name="edit_pincode" id="edit_pincode" required> {{-- only numbers should be allowed --}}
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="editCollege()"
                        class="btn text-white background-secondary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                    </div>
                    <h4 class="modal-title">Are you sure?</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form onsubmit="return deleteCollege()">
                    <div class="modal-body">
                        <p>Do You Want to Delete this Record ?</p>
                        <input type="hidden" name="" id="delete_college_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn background-info text-white" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                        <button type="button" onclick="deleteCollege()"
                            class="btn background-secondary text-white">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            $(".success-message").fadeIn().delay(3000).fadeOut();
            $(".error-message").fadeIn().delay(3000).fadeOut();
            fetch_state();

            $('#add-form').submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('add-college') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        location.reload();
                    }
                });
            });

        })

        function fetch_state() {
            var states = @json($states);
            var stateDropdown = $('#state-details');
            var editStates = $('#edit_state');
            states.map((value) => {
                stateDropdown.append('<option value="' + value.id + '">' + value.state + '</option>');
                editStates.append('<option value="' + value.id + '">' + value.state + '</option>');
            })
        }

        function viewCollege(id) {
            var country;
            var colleges = @json($data);
            console.log(colleges);
            $("#tbody").empty();
            colleges.map((col) => {
                if (col.college_id == id) {
                    switch (col.country) {
                        case '1':
                            country = "India";
                            break;
                        default:
                            country = "";
                    }
                    var tbody =
                        `<tr><td>College Name:</td><td class="fw-bold">${col.college_name}</td></tr><tr><td>Email:</td><td class="fw-bold">${col.email_id}</td></tr><tr><td>Mobile No:</td><td class="fw-bold">${col.primary_mobile_no}</td></tr><tr><td>Alternate Mobile No:</td><td class="fw-bold">${col.alternate_mobile_no}</td></tr><tr><td>Address_1:</td><td class="fw-bold">${col.address_1}</td></tr><tr><td>Address_2:</td><td class="fw-bold">${col.address_2}</td></tr><tr><td>City:</td><td class="fw-bold">${col.city}</td></tr><tr><td>State:</td><td class="fw-bold">${col.state}</td></tr><tr><td>Country:</td><td class="fw-bold">${country}</td></tr><tr><td>Pincode:</td><td class="fw-bold">${col.pincode}</td></tr>`;
                    $("#tbody").append(tbody);
                    $("#viewCollege").modal('show');
                }
            })
        }

        function editModal(id) {
            var colleges = @json($data);
            colleges.map((col) => {
                if (col.college_id == id) {
                    $("#edit_college_name").val(col.college_name)
                    $("#edit_email").val(col.email_id)
                    $("#edit_mobile_no").val(col.primary_mobile_no)
                    $("#edit_alternate_mobile").val(col.alternate_mobile_no)
                    $("#edit_address_1").val(col.address_1)
                    $("#edit_address_2").val(col.address_2)
                    $("#edit_city").val(col.city)
                    $("#edit_state option").filter(function() {
                        return $(this).val() == col.state_id;
                    }).prop('selected', true);
                    $("#edit_country option").filter(function() {
                        return $(this).val() == col.state_id;
                    }).prop('selected', true);
                    $("#edit_pincode").val(col.pincode)
                    $("#college_id").val(col.college_id)
                    $("#editCollege").modal('show');
                }
            })
        }


        function editCollege() {
            var formData = new FormData($('#edit-form')[0]);
            console.log(formData);
            $.ajax({
                url: '{{ route('edit-college') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    location.reload();
                }
            });
        }

        function statusChange(value, status) {
            if (status == 1) {
                is_active = 2;
            } else {
                is_active = 1;
            }
            $.ajax({
                type: 'POST',
                url: '{{ route('college-status') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'college_id': value,
                    'is_active': is_active,
                },
            });
        }

        function deleteModal(id) {
            $("#delete_college_id").val(id);
            $("#deleteModal").modal('show');
        }

        function deleteCollege() {
            var college_id = $("#delete_college_id").val();
            $.ajax({
                url: '{{ route('delete-college') }}',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'college_id': college_id,
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    location.reload();
                }
            });
        }
    </script>

@endsection
