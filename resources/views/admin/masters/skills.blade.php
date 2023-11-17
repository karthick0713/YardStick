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
    <script src="{{ asset('assets/js/table-search.js') }}"></script>
@endsection

@section('content')


    <div class="container mt-4">


        <div class="mb-2">
            <a data-bs-toggle="modal" data-bs-target="#addskill" class="button-plus-icon"><i
                    class='plus-icon bx bxs-plus-circle'></i></a>
        </div>
        <div class="card col-md-5">
            <!--<h5 class="card-header"><b>SKILLS</b></h5>-->
            <div class="table-responsive  text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr class="background-secondary">
                            <th scope="col" class="text-white text-center">LOGO</th>
                            <th scope="col" class="text-white text-center">SKILLS NAME</th>
                            <th scope="col" class="text-white text-center">ACTIVE</th>
                            <th scope="col" class="text-white text-center">ACTIONS</th>
                        </tr>
                        <tr class="background-grey">
                            <th></th>
                            <th class=" "><input type="search" name="" class="form-control table-search-bar"
                                    placeholder="Search Skills" id="search-skills" onkeyup="searchTable('search-skills',0)">
                            </th>
                            <th></th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class=""><img src="{{ asset('assets/img/lang-icons/php.png') }}" height="50"
                                    width="50" alt=""></td>
                            <td class="">PHP</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>

                            <td class="text-center">
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editSkills"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class=""><img src="{{ asset('assets/img/lang-icons/python.png') }}" height="50"
                                    width="50" alt="">
                            </td>
                            <td class="">PYTHON</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>

                            <td class="text-center">
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editSkills"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class=""><img src="{{ asset('assets/img/lang-icons/java.png') }}" height="50"
                                    width="50" alt=""></td>
                            <td class="">JAVA</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>

                            <td class="text-center">
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editSkills"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class=""><img src="{{ asset('assets/img/lang-icons/c.png') }}" height="50"
                                    width="50" alt=""></td>
                            <td class="">C</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>

                            <td class="text-center">
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editSkills"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    class="text-black icon-buttons"><i class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    {{-- add new skill modal --}}

    <div class="modal fade" id="addskill" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Skill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="input-form">
                    @csrf
                    <div class="modal-body">
                        <div class="row col-12">
                            <div class="row">
                                <div class=" mb-3">
                                    <label for="skill-logo" class="col-form-label"><b>Select
                                            Logo:</b>&nbsp;&nbsp;&nbsp;(Select only jpg, jpeg, png files.)</label>
                                    <input type="file" class="form-control" id="skill-logo"
                                        accept="image/jpeg, image/jpg, image/png" required>
                                    {{-- save images in lang-icons folder --}}
                                </div>
                                <div class=" mb-3">
                                    <label for="skill-name" class="col-form-label"><b>Skill Name:</b></label>
                                    <input type="text" class="form-control" id="skill-name" required>
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


    <div class="modal fade" id="editSkills" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Skills</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="input-form">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class=" mb-3">
                                <label for="skill-logo" class="col-form-label"><b>Logo:</b> &nbsp;&nbsp;&nbsp;(Select only
                                    jpg, jpeg, png files.)</label>
                                <input type="file" class="form-control" id="skill-logo"
                                    accept="image/jpeg, image/jpg, image/png" required>
                            </div>
                            <div class=" mb-3">
                                <label for="Skills" class="col-form-label"><b>Skill:</b></label>
                                <input type="text" class="form-control" id="Skills" value="Python" required>
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
