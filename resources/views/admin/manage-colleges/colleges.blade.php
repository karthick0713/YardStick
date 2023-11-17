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
    </style>

    <div class="container mt-4">
        <div class="mb-2">
            <a data-bs-toggle="modal" data-bs-target="#addCollege" class="button-plus-icon"><i
                    class='plus-icon bx bxs-plus-circle'></i></a>
        </div>
        <div class="card ">
            <!--<h5 class="card-header"><b>CollegeS</b></h5>-->

            {{-- list of colleges table --}}
            <div class="table-responsive  text-nowrap">
                <table id="example" class="table table-striped">
                    <thead class="background-secondary">
                        <tr class="text-white">
                            <th scope="col" class="text-white text-center">NAME</th>
                            <th scope="col" class="text-white text-center">EMAIL</th>
                            <th scope="col" class="text-white text-center">TOTAL USERS</th>
                            <th scope="col" class="text-white text-center">MOBILE</th>
                            <th scope="col" class="text-white text-center">ACTIVE</th>
                            <th scope="col" class="text-white text-center">ACTIONS</th>
                        </tr>

                        <tr class="background-grey">
                            <td class="text-center"><input type="search" name=""
                                    class="form-control table-search-bar" placeholder="Search Name" id=""></td>
                            <td class="text-center"><input type="search" name=""
                                    class="form-control table-search-bar" placeholder="Search Email" id=""></td>
                            <td class="text-center"><input type="search" name=""
                                    class="form-control table-search-bar" placeholder="Search Users" id=""></td>
                            <td class="text-center"><input type="search" name=""
                                    class="form-control table-search-bar" placeholder="Search Mobile" id=""></td>
                            <td class="text-center">

                            </td>
                            <td class="text-center"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Study World</td>
                            <td>studyworld@gmail.com</td>
                            <td>52 Users</td>
                            <td>9513578520</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#viewCollege"><i
                                        class="bx bx-show-alt"></i></a>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editCollege"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>PSG</td>
                            <td>psg@gmail.com</td>
                            <td>10 Users</td>
                            <td>9632587441</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#viewCollege"><i
                                        class="bx bx-show-alt"></i></a>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editCollege"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Test</td>
                            <td>test@gmail.com</td>
                            <td>47 Users</td>
                            <td>9632147850</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#viewCollege"><i
                                        class="bx bx-show-alt"></i></a>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editCollege"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
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
                        <form id="input-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="college" class="col-form-label">College Name:</label>
                                    <input type="text" class="form-control" id="" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="" class="col-form-label">Email:</label>
                                    <input type="text" class="form-control" id="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" class="col-form-label">Mobile No:</label>
                                    <input type="text" class="form-control" maxlength="10" id=""
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                    {{-- only numbers should be allowed --}}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="department" class="col-form-label">Alternate Mobile No:</label>
                                    <input type="text" class="form-control" maxlength="10" id=""
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                    {{-- only numbers should be allowed --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="batch" class="col-form-label">Address_1:</label>
                                    <input type="text" class="form-control" id="" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="batch" class="col-form-label">Address_2:</label>
                                    <input type="text" class="form-control" id="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="batch" class="col-form-label">City:</label>
                                    <input type="text" class="form-control" id="" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="state" class="col-form-label">State:</label>
                                    <select name="" class="form-control" id="state">
                                        <option value="" selected disabled>SELECT</option>
                                        <option value="">Tamil Nadu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="country" class="col-form-label">Country:</label>
                                    <select name="" class="form-control" id="country" required>
                                        <option value="" selected disabled>SELECT</option>
                                        <option value="">India</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pincode" class="col-form-label">Pincode:</label>
                                    <input type="text" class="form-control"
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
                            <tr>
                                <td>College Name:</td>
                                <td><b>Study World</b></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><b>studyworld@gmail.com</b></td>
                            </tr>
                            <tr>
                                <td>Mobile No:</td>
                                <td><b>9638552741</b></td>
                            </tr>
                            <tr>
                                <td>Alternate Mobile No:</td>
                                <td><b>9638552741</b></td>
                            </tr>
                            <tr>
                                <td>Address_1:</td>
                                <td><b>Mullaivadi</b></td>
                            </tr>
                            <tr>
                                <td>Address_2:</td>
                                <td><b>Attur</b></td>
                            </tr>
                            <tr>
                                <td>City:</td>
                                <td><b>Salem</b></td>
                            </tr>
                            <tr>
                                <td>State:</td>
                                <td><b>Tamil Nadu</b></td>
                            </tr>
                            <tr>
                                <td>Country:</td>
                                <td><b>India</b></td>
                            </tr>
                            <tr>
                                <td>Pincode:</td>
                                <td><b>636141</b></td>
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
    <div class="modal fade" id="editCollege" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit College Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="clearForm()"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row col-12">
                        <form id="input-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="College" class="col-form-label">College Name:</label>
                                    <input type="text" class="form-control" value="Study world" id=""
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="" class="col-form-label">Email:</label>
                                    <input type="text" class="form-control" value="studyworld@gmail.com"
                                        id="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" class="col-form-label">Mobile No:</label>
                                    <input type="text" class="form-control" maxlength="10" value="9638527410"
                                        id="" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                    {{-- only numbers should be allowed --}}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="department" class="col-form-label">Alternate Mobile No:</label>
                                    <input type="text" class="form-control" maxlength="10" id=""
                                        value="9895236741" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        required> {{-- only numbers should be allowed --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="batch" class="col-form-label">Address_1:</label>
                                    <input type="text" class="form-control" value="Sanganoor" id=""
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="batch" class="col-form-label">Address_2:</label>
                                    <input type="text" class="form-control" value="Gandhipuram" id=""
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="batch" class="col-form-label">City:</label>
                                    <input type="text" class="form-control" value="Coimbatore" id=""
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="state" class="col-form-label">State:</label>
                                    <select name="" class="form-control" id="state">
                                        <option value="" disabled>SELECT</option>
                                        <option value="" selected>Tamil Nadu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="country" class="col-form-label">Country:</label>
                                    <select name="" class="form-control" id="country" required>
                                        <option value="" disabled>SELECT</option>
                                        <option value="" selected>India</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pincode" class="col-form-label">Pincode:</label>
                                    <input type="text" class="form-control" value="636141"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="6"
                                        id="pincode" required> {{-- only numbers should be allowed --}}
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
    {{-- delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                    </div>
                    <h4 class="modal-title">Are you sure?</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
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
