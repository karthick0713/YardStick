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
    <script src="{{ asset('assets/js/pagenation.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
    <script src="{{ asset('assets/js/form-select.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
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
    </style>

    <div class="container mt-4">
        <div class="mb-2">
            <a data-bs-toggle="modal" data-bs-target="#addUser"><i class='plus-icon bx bxs-plus-circle'></i></a>
            <button class="button-plus-icon"></button>
        </div>
        <div class="card ">
            {{-- list of students table --}}
            <div class="table-responsive  text-nowrap">
                <table id="example" class="table table-striped">
                    <thead class="background-secondary">
                        <tr class="text-white">
                            <th scope="col" class="text-white">REGISTER NO</th>
                            <th scope="col" class="text-white">STUDENT NAME</th>
                            <th scope="col" class="text-white">COLLEGE</th>
                            {{-- <th scope="col" class="text-white">SEMESTER</th> --}}
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

                            {{-- <th><input type="search" name="" class="form-control table-search-bar"
                        placeholder="Search Semester" id="semester" onkeyup="searchTable('semester', 0)"></th> --}}
                            <th>
                                <input type="search" name="" class="form-control table-search-bar"
                                    placeholder="Search Mobile" id="mobile-no" onkeyup="searchTable('mobile-no', 0)">
                            </th>
                            <th>
                                {{-- <input type="search" name="" class="form-control table-search-bar"
                            placeholder="Search Email" id="email-id" onkeyup="searchTable('email-id', 0)"> --}}
                            </th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>721120104001
                            </td>
                            <td>ADIPI MANOJ KUMAR
                            </td>
                            <td>STUDY WORLD OF ENGINEERING
                            </td>
                            <td>8852698520
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#viewUser"><i
                                        class="bx bx-show-alt"></i></a>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editUser"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>721120104002
                            </td>
                            <td>ALAGU MANIKANDAN
                            </td>
                            <td>STUDY WORLD OF ENGINEERING
                            </td>
                            <td>9658741230
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#viewUser"><i
                                        class="bx bx-show-alt"></i></a>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editUser"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>721120104002
                            </td>
                            <td>ALAGU MANIKANDAN
                            </td>
                            <td>STUDY WORLD OF ENGINEERING
                            </td>
                            <td>8562321479
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#viewUser"><i
                                        class="bx bx-show-alt"></i></a>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editUser"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>721120104002
                            </td>
                            <td>ALAGU MANIKANDAN
                            </td>
                            <td>STUDY WORLD OF ENGINEERING
                            </td>
                            <td>8854712369
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#viewUser"><i
                                        class="bx bx-show-alt"></i></a>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editUser"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    class="text-black icon-buttons"><i class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>721120104002
                            </td>
                            <td>ALAGU MANIKANDAN
                            </td>
                            <td>STUDY WORLD OF ENGINEERING
                            </td>
                            <td>8745215820
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#viewUser"><i
                                        class="bx bx-show-alt"></i></a>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editUser"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    class="text-black icon-buttons"><i class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>721120104002
                            </td>
                            <td> KARTHICK RAJA
                            </td>
                            <td>STUDY WORLD OF ENGINEERING
                            </td>
                            <td>7845123698
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#viewUser"><i
                                        class="bx bx-show-alt"></i></a>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editUser"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    class="text-black icon-buttons"><i class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>721120104002
                            </td>
                            <td>ALAGU MANIKANDAN
                            </td>
                            <td>STUDY WORLD OF ENGINEERING
                            </td>
                            <td>9632587410
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#viewUser"><i
                                        class="bx bx-show-alt"></i></a>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editUser"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    class="text-black icon-buttons"><i class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>


        </div>

        <div class="pagination-flex-container justify-content-end  mt-5" id="pagination">
            <button class="page-link btn-sm" id="previous" disabled>Previous</button>
            <div id="page-numbers" class="pagination-flex-container"></div>
            <button class="page-link btn-sm" id="next">Next</button>
        </div>


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
                                        <select name="" class="form-control" required id="">
                                            <option value="" selected disabled>SELECT</option>
                                            <option value="">STUDY WORLD COLLEGE OF ENGINEERING</option>
                                        </select>
                                    </div>

                                    <div class="mt-1 col-md-6 mb-3">
                                        <label for="select2Dark" class="form-label">Skills:</label>
                                        <div class="mt-1 select2-dark">
                                            <select id="select2Dark" class="select2 form-select" multiple>
                                                <option value="1">PHP</option>
                                                <option value="2">PYTHON</option>
                                                <option value="2">C</option>
                                                <option value="2">C++</option>
                                                <option value="3">JAVA</option>
                                                <option value="4">ANGULAR</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-6 mb-3">
                                        <label for="department" class="col-form-label">Department:</label>
                                        <select name="" class="form-control" id="">
                                            <option value="" selected disabled>SELECT</option>
                                            <option value="">Computer Science and Technology</option>
                                        </select>
                                    </div>

                                    {{-- <div class="col-md-6 mb-3">
                                        <label for="batch" class="col-form-label">Batch:</label>
                                        <select name="" class="form-control" id="">
                                            <option value="" selected disabled>SELECT</option>
                                            <option value="">2022-2023</option>
                                        </select>
                                    </div> --}}

                                    <div class="col-md-6 mb-3">
                                        <label for="year" class="col-form-label">Year:</label>
                                        <select name="" class="form-control" id="">
                                            <option value="" selected disabled>SELECT</option>
                                            <option value="">1st Year</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="semester" class="col-form-label">Semester:</label>
                                        <select name="" class="form-control" id="">
                                            <option value="" selected disabled>SELECT</option>
                                            <option value="">First Semester</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="student-name" class="col-form-label">Student Name:</label>
                                        <input type="text" class="form-control" id="student-name" required>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <label for="register-no" class="col-form-label">Register No:</label>
                                        <input type="text" class="form-control" id="register-no" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email-id" class="col-form-label">Email Id:</label>
                                        <input type="email" class="form-control" id="email-id" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="mobile-no" class="col-form-label">Mobile No:</label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            maxlength="10" class="form-control" id="mobile-no" required>
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
                                <tr>
                                    <td>COLLEGE:</td>
                                    <td><b>Study World College of Engineering</b></td>
                                </tr>
                                <tr>
                                    <td>STUDENT NAME:</td>
                                    <td><b>ADIPI MANOJ KUMAR</b></td>
                                </tr>
                                <tr>
                                    <td>REGISTER NO:</td>
                                    <td><b>721120104001</b></td>
                                </tr>
                                <tr>
                                    <td>DEPARTMENT:</td>
                                    <td><b>CSE</b></td>
                                </tr>
                                <tr>
                                    <td>BATCH:</td>
                                    <td><b>2022-2024</b></td>
                                </tr>
                                <tr>
                                    <td>YEAR:</td>
                                    <td><b>3rd Year</b></td>
                                </tr>
                                <tr>
                                    <td>SEMESTER:</td>
                                    <td><b>6th sem</b></td>
                                </tr>
                                <tr>
                                    <td>EMAIL ID:</td>
                                    <td><b>adipimanojkumar@gmail.com</b></td>
                                </tr>
                                <tr>
                                    <td>MOBILE NO:</td>
                                    <td><b>8688219585</b></td>
                                </tr>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="clearForm()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row col-12">
                            <form id="input-form">

                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="client" class="col-form-label">College:</label>
                                        <select name="" class="form-control" required id="">
                                            <option value="" disabled>SELECT</option>
                                            <option value="" selected>STUDY WORLD COLLEGE OF ENGINEERING</option>
                                        </select>
                                    </div>

                                    <div class="mt-1 col-md-6 mb-3">
                                        <label for="select2Dark" class="form-label">Skills:</label>
                                        <div class="mt-1 select2-dark">
                                            <select id="select2Darks" class="select2 form-select" multiple>
                                                <option value="1" selected>PHP</option>
                                                <option value="2" selected>PYTHON</option>
                                                <option value="2">C</option>
                                                <option value="2">C++</option>
                                                <option value="3">JAVA</option>
                                                <option value="4" selected>ANGULAR</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <label for="edit-department" class="col-form-label">Department:</label>
                                        <select name="" class="form-control" id="">
                                            <option value="" disabled>SELECT</option>
                                            <option value="" selected>Computer Science and Technology</option>
                                        </select>
                                    </div>

                                    {{-- <div class="col-md-6 mb-3">
                                        <label for="edit-batch" class="col-form-label">Batch:</label>
                                        <select name="" class="form-control" id="">
                                            <option value="" disabled>SELECT</option>
                                            <option value="" selected>2022-2023</option>
                                        </select>
                                    </div> --}}

                                    <div class="col-md-6 mb-3">
                                        <label for="edit-year" class="col-form-label">Year:</label>
                                        <select name="" class="form-control" id="">
                                            <option value="" disabled>SELECT</option>
                                            <option value="" selected>1st Year</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="edit-semester" class="col-form-label">Semester:</label>
                                        <select name="" class="form-control" id="">
                                            <option value="" disabled>SELECT</option>
                                            <option value="" selected>First Semester</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="edit-student-name" class="col-form-label">Student Name:</label>
                                        <input type="text" class="form-control" value="ADIPI MANOJ KUMAR"
                                            id="edit-student-name" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="edit-register-no" class="col-form-label">Register No:</label>
                                        <input type="text" class="form-control" value="721120104001"
                                            id="edit-register-no" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="edit-email-id" class="col-form-label">Email Id:</label>
                                        <input type="email" class="form-control" value="adipimanojkumar@gmail.com"
                                            id="edit-email-id" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="edit-mobile-no" class="col-form-label">Mobile No:</label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            maxlength="10" value="8688219585" class="form-control" id="edit-mobile-no"
                                            required>
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

        {{-- delete modal --}}

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">
                        </div>
                        <h4 class="modal-title">Are you sure?</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close">&times;</button>
                    </div>
                    <form action="" method="">
                        <div class="modal-body">
                            <p>Do You Want to Delete this Record ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn background-info text-white" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                            <button type="submit" class="btn background-secondary text-white">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @endsection
