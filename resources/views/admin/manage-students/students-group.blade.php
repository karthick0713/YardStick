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
@endsection

@section('content')

    <style>
        .modal td {
            font-weight: bold !important;
        }
    </style>
    <div class="container mt-4">
        <div class="mb-2">
            <a href="{{ route('add-students-group') }}"><button class="button-plus-icon"><i
                        class='plus-icon bx bxs-plus-circle'></i></button></a>
        </div>

        {{-- list of the students groups --}}
        <div class="card ">
            <div class="table-responsive  text-nowrap">
                <table id="example" class="table table-striped">
                    <thead class="background-secondary">
                        <tr class="text-white">
                            <th scope="col" class="text-white">GROUP NAME</th>
                            <th scope="col" class="text-white">COLLEGE</th>
                            <th scope="col" class="text-white">DEPARTMENT</th>
                            <th scope="col" class="text-white">YEAR</th>
                            <th scope="col" class="text-white">STATUS</th>
                            <th scope="col" class="text-white">ACTIONS</th>
                        </tr>
                        <tr class="background-grey">
                            <td><input type="search" name="" class="form-control table-search-bar"
                                    placeholder="Search Group" id=""></td>
                            <td><input type="search" name="" class="form-control table-search-bar"
                                    placeholder="Search College" id=""></td>
                            <td><input type="search" name="" class="form-control table-search-bar"
                                    placeholder="Search Department" id=""></td>
                            <td><input type="search" name="" class="form-control table-search-bar"
                                    placeholder="Search Year" id=""></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>CSE-2nd-A</td>
                            <td>STUDY WORLD COLLEGE OF ENGINEERING</td>
                            <td>CSE</td>
                            <td>2nd Year</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#viewGroup"><i
                                        class="bx bx-show-alt"></i></a>
                                <a class="icon-buttons" href="{{ route('edit-students-group') }}"><i
                                        class="text-black  bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>ECE-1st-B</td>
                            <td>PSG COLLEGE OF INSTITUTIONS</td>
                            <td>ECE</td>
                            <td>1st Year</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#viewGroup"><i
                                        class="bx bx-show-alt"></i></a>
                                <a class="icon-buttons" href="{{ route('edit-students-group') }}"><i
                                        class="text-black bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination-flex-container mt-5 justify-content-end" id="pagination">
            <button class="page-link btn-sm" id="previous" disabled>Previous</button>
            <div id="page-numbers" class="pagination-flex-container"></div>
            <button class="page-link btn-sm" id="next">Next</button>
        </div>
    </div>


    <div class="modal fade" id="viewGroup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Students</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <table id="" class="table table-responsive">
                            <tr>
                                <td>1.</td>
                                <td>ADIPI MANOJ KUMAR</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>ALAGU MANIKANDAN</td>

                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>KOTHA CHETAN KUMAR</td>

                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>HARI PRASATH C</td>

                            </tr>
                            <tr>
                                <td>5.</td>
                                <td>ATHUL S JOTHI
                                </td>

                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>BOOMIGA</td>

                            </tr>
                            <tr>
                                <td>7.</td>
                                <td>EKAMBARAM BHANU PRAKASH</td>

                            </tr>
                            <tr>
                                <td>8.</td>
                                <td>KONDAREDDY NIKHILESHWAR REDDY</td>

                            </tr>
                            <tr>
                                <td>9.</td>
                                <td>MADINENI MADHVILATHA</td>

                            </tr>
                            <tr>
                                <td>10.</td>
                                <td>MALAVIKA R</td>

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
