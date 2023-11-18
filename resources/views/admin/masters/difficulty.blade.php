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

    <style>

    </style>


    <div class="container mt-4">
        {{-- <div class="mb-2">
            <a  data-bs-toggle="modal" data-bs-target="#addCategory" class="button-plus-icon"><i class='plus-icon bx bxs-plus-circle'></i></a>
        </div>
        <div class="table-container col-5">
            <table id="example" class="table table-responsive "> <!-- Corrected class attribute -->
                <thead class="background-secondary">
                    <tr class="text-white">
                        <th scope="col" class="text-white text-center">CATEGORY NAME</th>
                        <th scope="col" class="text-white text-center">ACTIVE</th>
                        <th scope="col" class="text-white text-center">ACTIONS</th>
                    </tr>
                    <tr class="background-grey">
                        <th class=" "><input type="search" name="" class="form-control table-search-bar"
                                placeholder="Search Category" id="search-category" onkeyup="searchTable('search-category',0)"></th>
                        <th></th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="">Easy</td>
                        <td class="text-center">
                            <label class="switch">
                                <input type="checkbox" checked id="statusToggle">
                                <span class="slider round"></span>
                            </label>
                        </td>

                        <td class="text-center">
                            <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editCategory"><i class="bx bx-edit-alt"></i></a>         
                            <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i class="bx bxs-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="">Medium</td>
                        <td class="text-center">
                            <label class="switch">
                                <input type="checkbox"  id="statusToggle">
                                <span class="slider round"></span>
                            </label>
                        </td>

                        <td class="text-center">
                            <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editCategory"><i class="bx bx-edit-alt"></i></a>         
                            <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i class="bx bxs-trash"></i></a>
                        </td>
                    </tr>

                    
                    <tr>
                        <td class="">Hard</td>
                        <td class="text-center">
                            <label class="switch">
                                <input type="checkbox"  id="statusToggle">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td class="text-center">
                            <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editCategory"><i class="bx bx-edit-alt"></i></a>         
                            <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i class="bx bxs-trash"></i></a>
                        </td>
                    </tr>
                   
                </tbody>

            </table> --}}
        {{-- <div class="pagination-flex-container mt-5" id="pagination">
                <button class="page-link btn-sm" id="previous" disabled>Previous</button>
                <div id="page-numbers" class="pagination-flex-container"></div>
                <button class="page-link btn-sm" id="next">Next</button>
            </div> --}}
        {{-- </div> --}}
        <div class="mb-2">
            <a data-bs-toggle="modal" data-bs-target="#addDifficulty" class="button-plus-icon"><i
                    class='plus-icon bx bxs-plus-circle'></i></a>
        </div>
        <div class="card col-md-5">
            {{-- list of difficulties table --}}
            <div class="table-responsive  text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr class="background-secondary">
                            <th scope="col" class="text-white text-center">Difficulty NAME</th>
                            <th scope="col" class="text-white text-center">ACTIVE</th>
                            <th scope="col" class="text-white text-center">ACTIONS</th>
                        </tr>
                        <tr class="background-grey">
                            <th class=" "><input type="search" name="" class="form-control table-search-bar"
                                    placeholder="Search Difficulty" id="search-difficulty"
                                    onkeyup="searchTable('search-difficulty',0)"></th>
                            <th></th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="">Easy</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>

                            <td class="text-center">
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editDifficulty"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="">Medium</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>

                            <td class="text-center">
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editDifficulty"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-black icon-buttons"><i
                                        class="bx bxs-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="">Hard</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>

                            <td class="text-center">
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#editDifficulty"><i
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

    {{-- add new difficulty modal --}}

    <div class="modal fade" id="addDifficulty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Difficulty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="input-form">
                    @csrf
                    <div class="modal-body">
                        <div class="row col-12">
                            <div class="row">
                                <div class=" mb-3">
                                    <label for="difficulty-name" class="col-form-label">Difficulty Name:</label>
                                    <input type="text" class="form-control" name="difficulty" id="difficulty-add"
                                        required>
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


    <div class="modal fade" id="editDifficulty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Difficulty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class=" mb-3">
                                <label for="difficulty" class="col-form-label">Difficulty:</label>
                                <input type="text" class="form-control" id="difficulty" value="Easy" required>
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

    <script>
        $(document).ready(function() {
            $('#input-form').submit(function(event) {
                event.preventDefault();
                var difficulty = $("#difficulty-add").val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('difficulty-add') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'difficulty': difficulty,
                    },
                    success: function(response) {
                        $('#message').html('<div class="alert alert-success">' + response
                            .message + '</div>');
                        console.log(response);
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = '<div class="alert alert-danger">';
                            $.each(errors, function(key, value) {
                                errorMessage += '<p>' + value + '</p>';
                            });
                            errorMessage += '</div>';
                            $('#message').html(errorMessage);
                        } else {
                            $('#message').html(
                                '<div class="alert alert-danger">An error occurred.</div>');
                        }
                    }
                });
            });
        });
    </script>
@endsection
