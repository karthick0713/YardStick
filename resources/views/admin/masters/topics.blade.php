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
    <script src="{{ asset('assets/js/table-search.js') }}"></script>
    <script src="{{ asset('assets/js/form-select.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endsection

@section('content')


    <div class="container mt-4">


        <div class="mb-2">
            <a data-bs-toggle="modal" data-bs-target="#addtopics" class="button-plus-icon"><i
                    class='plus-icon bx bxs-plus-circle'></i></a>
        </div>
        <div class="card col-md-5">
            {{-- Topics table --}}
            <div class="table-responsive  text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr class="background-secondary">
                            <th scope="col" class="text-white text-center">TOPICS</th>
                            <th scope="col" class="text-white text-center">SKILLS</th>
                            <th scope="col" class="text-white text-center">ACTIVE</th>
                            <th scope="col" class="text-white text-center">ACTIONS</th>
                        </tr>
                        <tr class="background-grey">
                            <th class=" "><input type="search" name="" class="form-control table-search-bar"
                                    placeholder="Search Topics" id="search-topics" onkeyup="searchTable('search-topics',0)">
                            </th>
                            <th class=" "><input type="search" name="" class="form-control table-search-bar"
                                    placeholder="Search Skills" id="search-skills" onkeyup="searchTable('search-skills',1)">
                            </th>
                            <th></th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="">ARRAYS</td>
                            <td class="">PHP , JAVA</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>

                            <td class="text-center">
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editTopics"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="">STATEMENTS</td>
                            <td class="">PHP , PYTHON</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>

                            <td class="text-center">
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editTopics"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="">LOOPS</td>
                            <td class="">PYTHON , C</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>

                            <td class="text-center">
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editTopics"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="">OPERATORS</td>
                            <td class="">C , C++</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>

                            <td class="text-center">
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editTopics"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    {{-- add topics modal --}}


    <div class="modal fade" id="addtopics" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Topics</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="input-form">
                    @csrf
                    <div class="modal-body">
                        <div class="row col-12">
                            <div class="row">
                                <div class=" mb-3">
                                    <label for="topic-name" class="col-form-label"><b>Topic Name:</b></label>
                                    <input type="text" class="form-control" id="topic-name" required>
                                </div>
                            </div>
                            {{-- select multiple skills --}}
                            <div class=" mb-3">
                                <label for="topic-name" class="col-form-label"><b>Select Skill:</b></label>
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

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn text-white background-secondary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- edit Modal --}}


    <div class="modal fade" id="editTopics" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Topics</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="input-form">
                    @csrf
                    <div class="modal-body">

                        <div class="row">

                            <div class=" mb-3">
                                <label for="Topics" class="col-form-label"><b>Topic:</b></label>
                                <input type="text" class="form-control" id="Topics" value="Arrays" required>
                            </div>

                            {{-- select multiple skills --}}
                            <div class=" mb-3">
                                <label for="topic-name" class="col-form-label"><b>edit Skill:</b></label>
                                <div class="mt-1 select2-dark">
                                    <select id="select2Darks" class="select2 form-select" multiple>
                                        <option value="1" selected>PHP</option>
                                        <option value="2">PYTHON</option>
                                        <option value="2" selected>C</option>
                                        <option value="2">C++</option>
                                        <option value="3">JAVA</option>
                                        <option value="4" selected>ANGULAR</option>
                                    </select>
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
