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
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <div class="mb-2">
            <a data-bs-toggle="modal" data-bs-target="#addDepartment" class="button-plus-icon"><i
                    class='plus-icon bx bxs-plus-circle'></i></a>
        </div>
        <div class="card col-md-5">
            <!--<h5 class="card-header"><b>DEPARTMENT</b></h5>-->
            <div class="table-responsive  text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr class="background-secondary">
                            <th scope="col" class="text-white text-center">DEPARTMENT</th>
                            <th scope="col" class="text-white text-center">ACTIVE</th>
                            <th scope="col" class="text-white text-center">ACTIONS</th>
                        </tr>
                        <tr class="background-grey">
                            <th class=" "><input type="search" name="" class="form-control table-search-bar"
                                    placeholder="Search Department" id="search-department"
                                    onkeyup="searchTable('search-department',0)"></th>
                            <th></th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $key => $value)
                            <tr>
                                <td class="">{{ $value->department_name }}</td>
                                <td class="text-center">
                                    <label class="switch">
                                        <input type="checkbox" {{ $value->is_active == 1 ? 'checked' : '' }}
                                            onclick="statusChange({{ $value->department_id }},{{ $value->is_active }})"
                                            id="statusToggle">
                                        <span class="slider round"></span>
                                    </label>
                                </td>

                                <td class="text-center">
                                    <a class="icon-buttons" onclick="editModal({{ $value->department_id }})"><i
                                            class="bx bx-edit-alt"></i></a>
                                    <a class="text-black icon-buttons"
                                        onclick="deleteModal({{ $value->department_id }})"><i class="bx bxs-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>


    {{-- Add Department Modal --}}

    <div class="modal fade" id="addDepartment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="input-form">
                    @csrf
                    <div class="modal-body">
                        <div class="row col-12">
                            <div class="row">
                                <div class=" mb-3">
                                    <label for="Department-name" class="col-form-label"><b>Department Name:</b></label>
                                    <input type="text" class="form-control" id="department-name" required>
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


    <div class="modal fade" id="editDepartment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="" onsubmit="return updateDepartment()">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class=" mb-3">
                                <label for="department" class="col-form-label"><b>Department Name:</b></label>
                                <input type="text" class="form-control" id="department-edit" required>
                                <input type="hidden" class="form-control" id="department_id">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        <button type="button" onclick="updateDepartment()"
                            class="btn text-white background-secondary">Submit</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form action="" method="">
                    <div class="modal-body">
                        <p>Do You Want to Delete this Record ?</p>
                        <input type="hidden" name="" id="department_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn background-info text-white" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                        <button type="button" onclick="deleteDepartment()"
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
                var department = $("#department-name").val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('add-department') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'department': department,
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
                url: '{{ route('department-status') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'value': value,
                    'is_active': is_active,
                },
            });
        }

        function editModal(id) {
            var datas = @json($data);
            $.each(datas, function(key, value) {
                if (value.department_id == id) {
                    $("#department-edit").val(value.department_name);
                    $("#department_id").val(value.department_id);
                }
            });
            $('#editDepartment').modal('show');
        }

        function updateDepartment() {
            var department = $("#department-edit").val();
            var id = $("#department_id").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('department-update') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'department': department,
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

        function deleteModal(id) {
            var datas = @json($data);
            $.each(datas, function(key, value) {
                if (value.department_id == id) {
                    $("#department_id").val(value.department_id);
                }
            });
            $('#deleteModal').modal('show');
        }

        function deleteDepartment() {
            var id = $("#department_id").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('department-delete') }}',
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
