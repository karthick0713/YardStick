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
                    <ul>
                        @foreach (session('error') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

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
                    <tbody id="difficulty_tbody">

                        @foreach ($data as $key => $value)
                            <tr>
                                <td class="">{{ $value->difficulty_name }}</td>
                                <td class="text-center">
                                    <label class="switch">
                                        <input type="checkbox" value="{{ $value->difficulty_id }}"
                                            {{ $value->is_active == 1 ? 'checked' : '' }}
                                            onclick="statusChange(this.value,{{ $value->is_active }})" id="statusToggle">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <a class="icon-buttons" onclick="editDifficulty({{ $value->difficulty_id }})"><i
                                            class="bx bx-edit-alt"></i></a>
                                    <a data-bs-toggle="modal" onclick="delete_diff({{ $value->difficulty_id }})"
                                        class="text-black icon-buttons"><i class="bx bxs-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach

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
                <form id="edit-form" onsubmit="return updateDifficulty()">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class=" mb-3">
                                <label for="difficulty" class="col-form-label">Difficulty:</label>
                                <input type="text" class="form-control" id="difficulty-edit" required>
                                <input type="hidden" class="form-control" id="difficulty_id">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        <button type="button" onclick="updateDifficulty()"
                            class="btn text-white background-secondary">Submit</button>
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
                <form onsubmit="return deleteDifficulty()">
                    <div class="modal-body">
                        <p>Do You Want to Delete this Record ?</p>
                        <input type="hidden" name="" id="difficulty_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn background-info text-white" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                        <button type="button" onclick="deleteDifficulty()"
                            class="btn background-secondary text-white">Delete</button>
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
                        localStorage.setItem('response', response.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            location.reload();
                        } else {
                            location.reload();
                        }
                    }
                });
            });

            $(".success-message").fadeIn().delay(3000).fadeOut();
            $(".error-message").fadeIn().delay(3000).fadeOut();
        });

        function statusChange(value, status) {
            if (status == 1) {
                is_active = 2;
            } else {
                is_active = 1;
            }
            $.ajax({
                type: 'POST',
                url: '{{ route('difficulty-status') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'value': value,
                    'is_active': is_active,
                },
            });
        }

        function editDifficulty(id) {
            var datas = @json($data);
            $.each(datas, function(key, value) {
                if (value.difficulty_id == id) {
                    $("#difficulty-edit").val(value.difficulty_name);
                    $("#difficulty_id").val(value.difficulty_id);
                }
            });
            $('#editDifficulty').modal('show');
        }

        function updateDifficulty() {
            var difficulty = $("#difficulty-edit").val();
            var id = $("#difficulty_id").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('difficulty-update') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'difficulty': difficulty,
                    'id': id,
                },
                success: function(response) {
                    localStorage.setItem('response', response.message);
                    location.reload();
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        location.reload();
                    } else {
                        location.reload();
                    }
                }
            });
        }

        function delete_diff(id) {
            var datas = @json($data);
            $.each(datas, function(key, value) {
                if (value.difficulty_id == id) {
                    $("#difficulty_id").val(value.difficulty_id);
                }
            });
            $('#deleteModal').modal('show');
        }

        function deleteDifficulty() {
            var id = $("#difficulty_id").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('difficulty-delete') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id,
                },
                success: function(response) {
                    localStorage.setItem('response', response.message);
                    location.reload();
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        location.reload();
                    } else {
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection
