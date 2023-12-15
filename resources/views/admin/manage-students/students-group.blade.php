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
        @if (session('error'))
            <div class="error-message col-md-5">
                <div class="alert bg-danger text-white fw-bold">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="success-message col-md-5">
                <div class="alert bg-success text-white fw-bold">
                    {{ session('success') }}
                </div>
            </div>
        @endif
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
                            <th scope="col" class="text-white">SEMESTER</th>
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
                            <td><input type="search" name="" class="form-control table-search-bar"
                                    placeholder="Search Semester" id=""></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($student_group as $key => $value)
                            @php
                                switch ($value->year) {
                                    case 1:
                                        $year = '1st Year';
                                        break;
                                    case 2:
                                        $year = '2nd Year';
                                        break;
                                    case 3:
                                        $year = '3rd Year';
                                        break;
                                    case 4:
                                        $year = '4th Year';
                                        break;
                                }

                                switch ($value->semester) {
                                    case 1:
                                        $semester = '1st Semester';
                                        break;
                                    case 2:
                                        $semester = '2nd Semester';
                                        break;
                                    case 3:
                                        $semester = '3rd Semester';
                                        break;
                                    case 4:
                                        $semester = '4th Semester';
                                        break;
                                    case 5:
                                        $semester = '5th Semester';
                                        break;
                                    case 6:
                                        $semester = '6th Semester';
                                        break;
                                    case 7:
                                        $semester = '7th Semester';
                                        break;
                                    case 8:
                                        $semester = '8th Semester';
                                        break;
                                }
                            @endphp
                            <tr>
                                <td>{{ $value->group_name }}</td>
                                <td>{{ $value->college_name }}</td>
                                <td>{{ $value->department_name }}</td>
                                <td>{{ $year }}</td>
                                <td>{{ $semester }}</td>
                                <td class="text-center">
                                    <label class="switch">
                                        <input type="checkbox" {{ $value->is_active == 1 ? 'checked' : '' }}
                                            onclick="statusChange({{ $value->group_id }},{{ $value->is_active }})"
                                            id="statusToggle">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <a class="icon-buttons" onclick="viewGroupStudents({{ $value->group_id }})"><i
                                            class="bx bx-show-alt"></i></a>
                                    <a class="icon-buttons"
                                        href="{{ route('edit-students-group', ['id' => $value->group_id]) }}"><i
                                            class="text-black bx bx-edit-alt"></i></a>
                                    <a onclick="deleteModalOpen({{ $value->group_id }})" class="text-black icon-buttons"><i
                                            class="bx bxs-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
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
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Students</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <table id="" class="table table-responsive">
                            <tbody id="view-group-students"></tbody>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="">
                    <div class="modal-body">
                        <input type="hidden" name="" id="group-delete-id">
                        <p>Do You Want to Delete this Record ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn background-info text-white" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                        <button type="button" onclick="delete_group()"
                            class="btn background-secondary text-white">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            $(".success-message").fadeIn().delay(3000).fadeOut();
            $(".error-message").fadeIn().delay(3000).fadeOut();
        });

        function viewGroupStudents(id) {
            $('#view-group-students').empty();
            $.ajax({
                type: 'GET',
                url: "{{ route('view-group-students') }}",
                data: {
                    id: id,
                },
                success: function(data) {
                    $('#view-group-students').append(data);
                    $("#viewGroup").modal('show');

                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function statusChange(group_id, data) {
            if (data == 1) {
                is_active = 2;
            } else {
                is_active = 1;
            }
            $.ajax({
                type: 'POST',
                url: '{{ route('group-status') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'group_id': group_id,
                    'is_active': is_active,
                },
            });
        }

        function deleteModalOpen(id) {
            $("#group-delete-id").val(id);
            $('#deleteModal').modal('show');
        }

        function delete_group() {
            var group_id = $("#group-delete-id").val();
            $.ajax({
                url: '{{ route('delete-group') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    'group_id': group_id,
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    location.reload();
                }
            });
        }
    </script>
@endsection
