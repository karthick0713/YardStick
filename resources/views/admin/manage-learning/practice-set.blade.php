@extends('layouts/contentNavbarLayout')

@section('title', $heading)

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
            <button class="button-plus-icon"><i class='plus-icon bx bxs-plus-circle'></i></button>
        </div>
        {{-- Practice Set Table --}}
        <div class="table-container">
            <table id="example" class="table table-responsive table-stripped ">

                <thead class="">
                    <tr class="background-secondary">
                        <th scope="col" class="text-white">CODE</th>
                        <th scope="col" class="text-white">TITLE</th>
                        <th scope="col" class="text-white">CATEGORY</th>
                        <th scope="col" class="text-white">TYPE</th>
                        <th scope="col" class="text-white">VISIBILITY</th>
                        <th scope="col" class="text-white">STATUS</th>
                        <th scope="col" class="text-white">ACTIONS</th>
                    </tr>
                    <tr class="background-grey">
                        <th>
                            <input type="search" name="search_code" class="form-control table-search-bar"
                                placeholder="Search Code" id="search_code" onkeyup="searchTable('search_code', 0)">
                        </th>
                        <th>
                            <input type="search" name="search_title" class="form-control table-search-bar"
                                placeholder="Search Title" id="search_title" onkeyup="searchTable('search_title', 1)">
                        </th>
                        <th>
                            <input type="search" name="search_category" class="form-control table-search-bar"
                                placeholder="Search Category" id="search_category"
                                onkeyup="searchTable('search_category', 2)">
                        </th>
                        <th>
                            <input type="search" name="search_type" class="form-control table-search-bar"
                                placeholder="Search Type" id="search_type" onkeyup="searchTable('search_type', 3)">
                        </th>
                        <th>
                            <input type="search" name="search_visibility" class="form-control table-search-bar"
                                placeholder="Search Visibility" id="search_visibility"
                                onkeyup="searchTable('search_visibility', 4)">
                        </th>
                        <th>
                            <input type="search" name="search_status" class="form-control table-search-bar"
                                placeholder="Search Status" id="search_status" onkeyup="searchTable('search_status', 5)">
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>



                    <tr>
                        <td>php-A001</td>
                        <td>Hello World</td>
                        <td>Program</td>
                        <td>Context</td>
                        <td>Private</td>
                        <td><span class="badge bg-success">published</span></td>
                        <td>
                            <div class="dropdown">
                                <input class=" dropdown-toggle action-toggle" value="Actions" readonly
                                    data-toggle="dropdown" onclick="toggleDropdown(this)">

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="performAction('View', this)">View</a>
                                    <a class="dropdown-item" href="#" onclick="performAction('Edit', this)">Edit</a>
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('Delete', this)">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>JAVA-A001</td>
                        <td>Hello World</td>
                        <td>Program</td>
                        <td>Context</td>
                        <td>Private</td>
                        <td><span class="badge bg-success">published</span></td>
                        <td>
                            <div class="dropdown">
                                <input class=" dropdown-toggle action-toggle" value="Actions" readonly
                                    data-toggle="dropdown" onclick="toggleDropdown(this)">

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="performAction('View', this)">View</a>
                                    <a class="dropdown-item" href="#" onclick="performAction('Edit', this)">Edit</a>
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('Delete', this)">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>JAVA-A001</td>
                        <td>Hello World</td>
                        <td>Program</td>
                        <td>Context</td>
                        <td>Private</td>
                        <td><span class="badge bg-success">published</span></td>
                        <td>
                            <div class="dropdown">
                                <input class=" dropdown-toggle action-toggle" value="Actions" readonly
                                    data-toggle="dropdown" onclick="toggleDropdown(this)">

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('View', this)">View</a>
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('Edit', this)">Edit</a>
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('Delete', this)">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>JAVA-A001</td>
                        <td>Hello World</td>
                        <td>Program</td>
                        <td>Context</td>
                        <td>Private</td>
                        <td><span class="badge bg-success">published</span></td>
                        <td>
                            <div class="dropdown">
                                <input class=" dropdown-toggle action-toggle" value="Actions" readonly
                                    data-toggle="dropdown" onclick="toggleDropdown(this)">

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('View', this)">View</a>
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('Edit', this)">Edit</a>
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('Delete', this)">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>JAVA-A001</td>
                        <td>Hello World</td>
                        <td>Program</td>
                        <td>Context</td>
                        <td>Private</td>
                        <td><span class="badge bg-success">published</span></td>
                        <td>
                            <div class="dropdown">
                                <input class=" dropdown-toggle action-toggle" value="Actions" readonly
                                    data-toggle="dropdown" onclick="toggleDropdown(this)">

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('View', this)">View</a>
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('Edit', this)">Edit</a>
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('Delete', this)">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>JAVA-A001</td>
                        <td>Hello World</td>
                        <td>Program</td>
                        <td>Context</td>
                        <td>Private</td>
                        <td><span class="badge bg-success">published</span></td>
                        <td>
                            <div class="dropdown">
                                <input class=" dropdown-toggle action-toggle" value="Actions" readonly
                                    data-toggle="dropdown" onclick="toggleDropdown(this)">

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('View', this)">View</a>
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('Edit', this)">Edit</a>
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('Delete', this)">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>JAVA-A001</td>
                        <td>Hello World</td>
                        <td>Program</td>
                        <td>Context</td>
                        <td>Private</td>
                        <td><span class="badge bg-success">published</span></td>
                        <td>
                            <div class="dropdown">
                                <input class=" dropdown-toggle action-toggle" value="Actions" readonly
                                    data-toggle="dropdown" onclick="toggleDropdown(this)">

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('View', this)">View</a>
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('Edit', this)">Edit</a>
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('Delete', this)">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>go-A001</td>
                        <td>Hello World</td>
                        <td>Program</td>
                        <td>Context</td>
                        <td>Private</td>
                        <td><span class="badge bg-success">published</span></td>
                        <td>
                            <div class="dropdown">
                                <input class=" dropdown-toggle action-toggle" value="Actions" readonly
                                    data-toggle="dropdown" onclick="toggleDropdown(this)">

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('View', this)">View</a>
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('Edit', this)">Edit</a>
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('Delete', this)">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>JAVA-A001</td>
                        <td>Hello World</td>
                        <td>Program</td>
                        <td>Context</td>
                        <td>Private</td>
                        <td><span class="badge bg-success">published</span></td>
                        <td>
                            <div class="dropdown">
                                <input class=" dropdown-toggle action-toggle" value="Actions" readonly
                                    data-toggle="dropdown" onclick="toggleDropdown(this)">

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('View', this)">View</a>
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('Edit', this)">Edit</a>
                                    <a class="dropdown-item" href="#"
                                        onclick="performAction('Delete', this)">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>

            <div class="pagination-flex-container mt-5" id="pagination">
                <button class="page-link btn-sm" id="previous" disabled>Previous</button>
                <div id="page-numbers" class="pagination-flex-container"></div>
                <button class="page-link btn-sm" id="next">Next</button>
            </div>
        </div>
    </div>
@endsection
