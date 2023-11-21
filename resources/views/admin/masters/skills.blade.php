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

                        @foreach ($data as $key => $value)
                            <tr>
                                <td class=""><img src="{{ url($value->logo) }}" height="50" width="50"
                                        alt=""></td>
                                <td class="">{{ strtoupper($value->skill_name) }}</td>
                                <td class="text-center">
                                    <label class="switch">
                                        <input type="checkbox" {{ $value->is_active == 1 ? 'checked' : '' }}
                                            onclick="statusChange({{ $value->skill_id }},{{ $value->is_active }})"
                                            id="statusToggle">
                                        <span class="slider round"></span>
                                    </label>
                                </td>

                                <td class="text-center">
                                    <a class="icon-buttons" onclick="updateSkill({{ $value->skill_id }})"><i
                                            class="bx bx-edit-alt"></i></a>
                                    <a onclick="delete_modal({{ $value->skill_id }})" class="text-black icon-buttons"><i
                                            class="bx bxs-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach

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
                <form id="input-form" onsubmit="return submitForm()">
                    @csrf
                    <div class="modal-body">
                        <div class="row col-12">
                            <div class="row">
                                <div class=" mb-3">
                                    <label for="skill-logo" class="col-form-label"><b>Select
                                            Logo:</b>&nbsp;&nbsp;&nbsp;(Select only jpg, jpeg, png files.)</label>
                                    <input type="file" class="form-control" id="skill-logo" name="skill_logo"
                                        accept="image/jpeg, image/jpg, image/png" required>
                                    {{-- save images in lang-icons folder --}}
                                </div>
                                <div class=" mb-3">
                                    <label for="skill-name" class="col-form-label"><b>Skill Name:</b></label>
                                    <input type="text" class="form-control" id="skill-name" name="skill_name" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" onclick="submitForm()"
                            class="btn text-white background-secondary">Submit</button>
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
                <form id="edit-form" onsubmit="return editSkills()">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class=" mb-3">
                                <label for="skill-logo" class="col-form-label"><b>Logo:</b> &nbsp;&nbsp;&nbsp;(Select only
                                    jpg, jpeg, png files.)</label>
                                <input type="file" class="form-control" id="skill_logo" name="skill_logo"
                                    accept="image/jpeg, image/jpg, image/png" required>
                                <div id="fileInfo"></div>
                            </div>
                            <div class=" mb-3">
                                <label for="Skills" class="col-form-label"><b>Skill:</b></label>
                                <input type="text" class="form-control" id="skill_edit" name="skill_name" required>
                                <input type="hidden" class="form-control" id="skill_id" name="skill_id">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        <button type="button" onclick="editSkills()"
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
                <form onsubmit="return deleteSkill()">
                    <div class="modal-body">
                        <p>Do You Want to Delete this Record ?</p>
                    </div>
                    <input type="hidden" name="" id="skill_id_delete">
                    <div class="modal-footer">
                        <button type="button" class="btn background-info text-white" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                        <button type="button" onclick="deleteSkill()"
                            class="btn background-secondary text-white">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $(".success-message").fadeIn().delay(3000).fadeOut();
            $(".error-message").fadeIn().delay(3000).fadeOut();
        });

        function submitForm() {
            var formData = new FormData($('#input-form')[0]);
            $.ajax({
                url: '{{ route('add-skill') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    location.reload();
                }
            });
        }

        function updateSkill(id) {
            var datas = @json($data);
            $.each(datas, function(key, value) {
                if (value.skill_id == id) {
                    $("#skill_edit").val(value.skill_name);
                    $("#fileInfo").text(value.skill_name + '.png');
                    $("#skill_id").val(value.skill_id);

                }
            });
            $('#editSkills').modal('show');
        }

        function editSkills() {
            var formData = new FormData($('#edit-form')[0]);
            $.ajax({
                url: '{{ route('update-skill') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    location.reload();
                }
            });
        }

        function statusChange(value, status) {
            if (status == 1) {
                is_active = 2;
            } else {
                is_active = 1;
            }
            $.ajax({
                type: 'POST',
                url: '{{ route('skills-status') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'value': value,
                    'is_active': is_active,
                },
            });
        }

        function delete_modal(id) {
            var datas = @json($data);
            $.each(datas, function(key, value) {
                console.log(key, value);
                if (value.skill_id == id) {
                    $("#skill_id_delete").val(value.skill_id);
                }
            });
            $('#deleteModal').modal('show');
        }


        function deleteSkill() {
            var id = $("#skill_id_delete").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('skill-delete') }}',
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
