@extends('layouts/contentNavbarLayout')

@section('title', 'Manage Test')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('assets/js/pagenation.js') }}"></script>
    <script src="{{ asset('assets/js/table-search.js') }}"></script>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="mb-2">
            {{-- Add test buttons --}}
            <a href="{{ url('admin/manage-test/add-test-common') }}"><button class=" btn background-info text-white">Add Test
                    Common</button></a>
            <a href="{{ url('admin/manage-test/add-test-individual') }}"><button class=" btn background-info text-white">Add
                    Test Individual</button></a>
        </div>
        <div class="card ">

            {{-- list of created tests --}}
            <div class="table-responsive  text-nowrap">
                <table id="example" class="table table-striped">
                    <thead class="">
                        <tr class="background-secondary">
                            <th scope="col" class="text-white text-center">TEST DATE</th>
                            <th scope="col" class="text-white text-center">SKILLS</th>
                            <th scope="col" colspan="3" class="text-white text-center">QUESTIONS</th>
                            <th scope="col" class="text-white text-center">STATUS</th>
                            <th scope="col" class="text-white text-center">ACTIONS</th>
                        </tr>
                        <tr class="background-grey">
                            <th>
                                <input type="search" name="search_date" class="form-control table-search-bar"
                                    placeholder="Search Date" id="search_date" onkeyup="searchTable('search_date', 0)">
                            </th>
                            <th>
                                <input type="search" name="search_skills" class="form-control table-search-bar"
                                    placeholder="Search Skills" id="search_skills"
                                    onkeyup="searchTable('search_skills', 5)">
                            </th>
                            <th>
                                EASY
                            </th>
                            <th>
                                MEDIUM
                            </th>
                            <th>
                                HARD
                            </th>

                            <th>

                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>



                        <tr>
                            <td>08-November-2023</td>
                            <td>PHP</td>
                            <td>30</td>
                            <td>40</td>
                            <td>40</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td class="fs-big text-center">
                                <a class="icon-buttons " data-bs-toggle="modal" data-bs-target="#viewModal"><i
                                        style="font-size: 1.5rem;" class="bx bx-show-alt"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>07-December-2023</td>
                            <td>PYTHON</td>
                            <td>30</td>
                            <td>40</td>
                            <td>40</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#viewModal"><i
                                        style="font-size: 1.5rem;" class="bx bx-show-alt"></i></a>
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

    {{-- View test details --}}
    <div class="modal fade modal-fullscreen" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Test Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="responsive">
                            <div class="accordion" id="testDetailsAccordion">
                                <div class="accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button " type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            <b>More Details</b>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#testDetailsAccordion">
                                        <div class="accordion-body">

                                            <p class="mb-2">
                                                TEST DATE: <span class="float-end"
                                                    style="font-size: 16px;">08-November-2023</span>
                                            </p>
                                            <p class="mb-2">
                                                SKILLS: <span class="float-end" style="font-size: 16px;">PYTHON</span>
                                            </p>
                                            <label class="mt-2" style="font-size: 16px; font-weight: 600;"
                                                for="">QUESTIONS:</label>
                                            <div class="d-flex mt-2 justify-content-between" style="font-size: 16px;">
                                                <p class="mb-0">EASY:</p>
                                                <p class="mb-0" style="font-weight: 600;"><span>30</span></p>
                                            </div>
                                            <div class="d-flex justify-content-between" style="font-size: 16px;">
                                                <p class="mb-0">MEDIUM:</p>
                                                <p class="mb-0" style="font-weight: 600;"><span>40</span></p>
                                            </div>
                                            <div class="d-flex justify-content-between" style="font-size: 16px;">
                                                <p class="mb-0">HARD:</p>
                                                <p class="mb-0" style="font-weight: 600;"><span>40</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 responsive">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>College Name</th>
                                        <th>Department</th>
                                        <th>Year</th>
                                        <th>Semester</th>
                                        <th>Batch</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><b>1</b></td>
                                        <td><b>Study World</b></td>
                                        <td><b>CSE</b></td>
                                        <td><b>1st Year</b></td>
                                        <td><b>1st Semester</b></td>
                                        <td><b>2022-2026</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>2</b></td>
                                        <td><b>PSG</b></td>
                                        <td><b>ECE</b></td>
                                        <td><b>2nd Year</b></td>
                                        <td><b>2nd Semester</b></td>
                                        <td><b>2023-2027</b></td>
                                    </tr>

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

    @endsection
