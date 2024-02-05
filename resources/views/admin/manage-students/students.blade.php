@extends('layouts/contentNavbarLayout')

@section('title', $sub_heading)

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatable-bootstrap5.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> --}}

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')

    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
    <script src="{{ asset('assets/js/form-select.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>

    <script src="{{ asset('assets/js/datatable-bootstrap5.js') }}"></script>
@endsection

@section('content')
    <style>
        .dropdown {
            position: relative;
        }

        .dropdown-toggle {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .dropdown-toggle:focus .dropdown-menu {
            display: block;
        }

        .dropdown-toggle .fa-caret-down {
            margin-left: 5px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: white;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-menu li {
            padding: 10px;
        }

        .dropdown-menu li a {
            color: black;
            text-decoration: none;
        }

        .dropdown-menu li a:hover {
            background-color: lightgray;
        }

        a {
            cursor: pointer;
        }

        .centered-text {
            text-align: center;
            line-height: 2;
        }

        select {
            background-image: url('{{ asset('assets/img/icons/down-arrow.png') }}') !important;
            background-repeat: no-repeat;
            background-position-x: 98%;
            background-position-y: center;
            padding-right: 20px;
        }

        select.open {
            background-image: url('{{ asset('assets/img/icons/up-arrow.png') }}');
        }

        .dataTables_empty {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 10px;
        }
    </style>
    <script src=" https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <div class="container mt-4">

        @if (session('error'))
            <div class="error-message col-md-5">
                <div class="alert bg-danger text-white fw-bold">
                    {{ session('error') }}
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

        <div class="mb-2">
            <a data-bs-toggle="modal" data-bs-target="#addUser"><i class='plus-icon bx bxs-plus-circle'></i></a>
            <button class="button-plus-icon"></button>
        </div>
        <div class="card ">

            {{-- <div class="table-responsive  text-nowrap">
                <table id="example" class="table table-striped display">
                    <thead class="background-secondary">
                        <tr class="text-white">
                            <th scope="col" class="text-white">REGISTER NO</th>
                            <th scope="col" class="text-white">STUDENT NAME</th>
                            <th scope="col" class="text-white">COLLEGE</th>
                          
                            <th scope="col" class="text-white">MOBILE</th>
                            <th scope="col" class="text-white">STATUS</th>
                            <th scope="col" class="text-white">ACTIONS</th>
                        </tr>
                        <tr class="background-grey">
                            <th><input type="search" name="" class="form-control table-search-bar"
                                    placeholder="Search Reg No" id="register-no" onkeyup="searchTable('register-no', 0)">
                            </th>
                            <th><input type="search" name="" class="form-control table-search-bar"
                                    placeholder="Search Student" id="student-name" onkeyup="searchTable('student-name', 0)">
                            </th>
                            <th><input type="search" name="" class="form-control table-search-bar"
                                    placeholder="Search College" id="college" onkeyup="searchTable('college', 0)"></th>

                            <th>
                                <input type="search" name="" class="form-control table-search-bar"
                                    placeholder="Search Mobile" id="mobile-no" onkeyup="searchTable('mobile-no', 0)">
                            </th>
                            <th>

                            </th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div> --}}

            <div class="card-datatable text-nowrap">
                <table class="dt-column-search table table-striped display">
                    <thead class="background-secondary ">
                        <tr>
                            <th class="text-white">Register No</th>
                            <th class="text-white">Student Name</th>
                            <th class="text-white">College</th>
                            <th class="text-white">Email</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>


        </div>
        {{-- 
        <div class="pagination-flex-container justify-content-end  mt-5" id="pagination">
            <button class="page-link btn-sm" id="previous" disabled>Previous</button>
            <div id="page-numbers" class="pagination-flex-container"></div>
            <button class="page-link btn-sm" id="next">Next</button>
        </div> --}}


        {{-- Add users Model --}}



        <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="clearForm()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row col-12">
                            <form id="input-form">

                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="College" class="col-form-label">College:</label>
                                        <select name="college" class="form-control" required id="select-college">
                                            <option value="" selected disabled>SELECT</option>
                                        </select>
                                    </div>

                                    <div class="mt-1 col-md-6 mb-3">
                                        <label for="select2Dark" class="form-label">Skills:</label>
                                        <div class="mt-1 select2-dark">
                                            <select id="select2Dark" name="skills[]" class="select2 form-select" multiple>
                                                @foreach ($skills as $skill)
                                                    <option value="{{ $skill->skill_id }}">{{ $skill->skill_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <label for="department" class="col-form-label">Department:</label>
                                        <select name="department" class="form-control" id="select-department">
                                            <option value="" selected disabled>SELECT</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="year" class="col-form-label">Year:</label>
                                        <select name="year" class="form-control" id="">
                                            <option value="" selected disabled>SELECT</option>
                                            <option value="1">1st Year</option>
                                            <option value="2">2nd Year</option>
                                            <option value="3">3rd Year</option>
                                            <option value="4">4th Year</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="" class="col-form-label">Semester:</label>
                                        <select name="semester" class="form-control" id="">
                                            <option value="" selected disabled>SELECT</option>
                                            <option value="1">First Semester</option>
                                            <option value="2">Second Semester</option>
                                            <option value="3">Third Semester</option>
                                            <option value="4">Fourth Semester</option>
                                            <option value="5">Fifth Semester</option>
                                            <option value="6">Sixth Semester</option>
                                            <option value="7">Seventh Semester</option>
                                            <option value="8">Eighth Semester</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="student-name" class="col-form-label">Student Name:</label>
                                        <input type="text" name="student_name" class="form-control" id="student-name"
                                            required>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <label for="register-no" class="col-form-label">Register No:</label>
                                        <input type="text" name="register_no" class="form-control" id="register-no"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email-id" class="col-form-label">Email Id:</label>
                                        <input type="email" name="email_id" class="form-control" id="email-id"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="mobile-no" class="col-form-label">Mobile No:</label>
                                        <input type="text" name="mobile_no"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10"
                                            class="form-control" id="mobile-no" required>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn text-white background-secondary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        {{-- View Modal --}}


        <div class="modal fade" id="viewUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View User Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <table id="" class="table table-responsive">
                                <tbody class="user_body">

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

        <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="edit-form">
                        <div class="modal-body">
                            <div class="row col-12">
                                @csrf
                                <div class="row edit_user_body">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn text-white background-secondary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- delete modal --}}

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">
                        </div>
                        <h4 class="modal-title">Are you sure?</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <form action="" method="">
                        <div class="modal-body">
                            <p>Do You Want to Delete this Record ?</p>
                            <input type="hidden" name="" id="student-delete-id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn background-info text-white" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                            <button type="button" onclick="deleteStudent()"
                                class="btn background-secondary text-white">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(() => {
                setTimeout(() => {
                    $("input[type='search']").addClass("form-control");
                    var targetElement = $('select[name="DataTables_Table_0_length"]');
                    targetElement.addClass('form-control');
                }, 5);
            });

            t = $(".dt-column-search");

            if (t.length) {
                $(".dt-column-search thead tr")
                    .clone(!0)
                    .appendTo(".dt-column-search thead"),
                    $(".dt-column-search thead tr:eq(1) th").each(function(a) {
                        var t = $(this).text();
                        $(this).html(
                                '<input type="text" class="form-control" placeholder="Search ' +
                                t +
                                '" />'
                            ),
                            $("input", this).on("keyup change", function() {
                                c.column(a).search() !== this.value &&
                                    c.column(a).search(this.value).draw();
                            });
                    });
                var c = t.DataTable({
                    ajax: "{{ route('fetch-students') }}",
                    columns: [{
                            data: "register_no",
                            orderable: false
                        },
                        {
                            data: "student_name",
                            orderable: false
                        },
                        {
                            data: "college_name",
                            orderable: false
                        },
                        {
                            data: "email_id",
                            orderable: false
                        },
                        {
                            data: "is_active",
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return `
                        <label class="switch">
                            <input type="checkbox" ${data == 1 ? 'checked' : ''} onclick="statusChange(${row.student_id},${data})" id="statusToggle">
                            <span class="slider round"></span>
                        </label>
                    `;
                            },
                        },
                        {
                            data: "student_id",
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return `
                        <a class="icon-buttons"  onclick="openViewUserModal(${row.student_id})">
                            <i class="bx bx-show-alt"></i>
                        </a>
                        <a class="icon-buttons" onclick="openEditUserModal(${row.student_id})">
                            <i class="bx bx-edit-alt"></i>
                        </a>
                        <a onclick="openDeleteModal(${row.student_id})" class="text-black icon-buttons">
                            <i class="bx bxs-trash"></i>
                        </a>
                    `;
                            },
                        },
                    ],
                    orderCellsTop: !0,
                    dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                });
            }



            function openViewUserModal(id) {
                $(".user_body").empty();
                $.ajax({
                    type: 'GET',
                    url: '{{ route('fetch-student-details') }}',
                    data: {
                        'student_id': id
                    },
                    success: function(response) {
                        $(".user_body").append(response);
                        $("#viewUser").modal('show');
                    }

                });

            }

            $(document).ready(() => {

                var college = @json($colleges);
                college.map((col) => {
                    $("#select-college").append('<option value="' + col.college_id + '">' + col
                        .college_name +
                        '</option>');
                    $("#edit-college").append('<option value="' + col.college_id + '">' + col.college_name +
                        '</option>');
                })

                var department = @json($departments);
                department.map((dept) => {
                    $("#select-department").append('<option value="' + dept.department_id + '">' + dept
                        .department_name +
                        '</option>');
                    $("#edit-department").append('<option value="' + dept.department_id + '">' + dept
                        .department_name +
                        '</option>');
                })

                $(".success-message").fadeIn().delay(3000).fadeOut();
                $(".error-message").fadeIn().delay(3000).fadeOut();


                $('#input-form').submit(function(event) {
                    event.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url: '{{ route('add-students') }}',
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

                $('#edit-form').submit(function(event) {
                    event.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url: '{{ route('edit-students') }}',
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

            function statusChange(student_id, data) {
                if (data == 1) {
                    is_active = 2;
                } else {
                    is_active = 1;
                }
                $.ajax({
                    type: 'POST',
                    url: '{{ route('student-status') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'student_id': student_id,
                        'is_active': is_active,
                    },
                });
            }

            function openEditUserModal(id) {
                $(".edit_user_body").empty();
                $.ajax({
                    type: 'GET',
                    url: '{{ route('get-edit-details') }}',
                    data: {
                        'student_id': id
                    },
                    success: function(response) {
                        $(".edit_user_body").append(response);
                        $("#editUser").modal('show');
                    }
                });
            }

            function openDeleteModal(id) {
                $("#student-delete-id").val(id);
                $('#deleteModal').modal('show');
            }

            function deleteStudent() {
                var studentId = $("#student-delete-id").val();
                $.ajax({
                    url: '{{ route('delete-student') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        'student_id': studentId,
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
