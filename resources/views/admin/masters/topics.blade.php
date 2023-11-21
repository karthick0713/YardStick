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
                        @foreach ($data as $key => $value)
                            <tr>
                                <td class="">{{ $value->topic_name }}</td>
                                <td class="">
                                    @php
                                        $skills = explode(',', $value->skills_id);
                                        $selectedSkillIds = json_encode($skills);
                                        $totalSkills = count($skills);
                                    @endphp

                                    @foreach ($skills as $index => $skillId)
                                        @php
                                            $val = DB::table('master_skills')
                                                ->where('skill_id', $skillId)
                                                ->first();
                                        @endphp
                                        @if ($val)
                                            {{ strtoupper($val->skill_name) }}
                                            @if ($index < $totalSkills - 1)
                                                ,
                                            @endif
                                        @endif
                                    @endforeach

                                </td>
                                <td class="text-center">
                                    <label class="switch">
                                        <input type="checkbox" {{ $value->is_active == 1 ? 'checked' : '' }}
                                            onclick="statusChange({{ $value->topic_id }},{{ $value->is_active }})"
                                            id="statusToggle">
                                        <span class="slider round"></span>
                                    </label>
                                </td>

                                <td class="text-center">
                                    <a class="icon-buttons" onclick="editModal({{ $value->topic_id }})"><i
                                            class="bx bx-edit-alt"></i></a>
                                    <a class="text-black icon-buttons" onclick="deleteModal({{ $value->topic_id }})"><i
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

    {{-- add topics modal --}}


    <div class="modal fade" id="addtopics" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Topics</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="input-form" onsubmit="return submitForm()">
                    @csrf
                    <div class="modal-body">
                        <div class="row col-12">
                            <div class="row">
                                <div class=" mb-3">
                                    <label for="topic-name" class="col-form-label"><b>Topic Name:</b></label>
                                    <input type="text" class="form-control" id="topic-name" required>
                                </div>
                            </div>
                            @php

                            @endphp
                            {{-- select multiple skills --}}
                            <div class=" mb-3">
                                <label for="topic-name" class="col-form-label"><b>Select Skill:</b></label>
                                <div class="mt-1 select2-dark">
                                    <select id="select2Dark" class="select2 form-select" multiple>
                                        @foreach ($fetch_skills as $key => $skill)
                                            <option value="{{ $skill->skill_id }}">{{ strtoupper($skill->skill_name) }}
                                            </option>
                                        @endforeach
                                    </select>
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


    <div class="modal fade" id="editTopics" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Topics</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="input-form" onsubmit="return editTopics()">
                    @csrf
                    <div class="modal-body">

                        <div class="row">

                            <div class=" mb-3">
                                <label for="Topics" class="col-form-label"><b>Topic:</b></label>
                                <input type="text" class="form-control" id="topic_name" required>
                                <input type="hidden" class="form-control" id="topic_id">
                            </div>

                            {{-- select multiple skills --}}
                            <div class=" mb-3">
                                <label for="topic-name" class="col-form-label"><b>edit Skill:</b></label>
                                <div class="mt-1 select2-dark">
                                    <select id="select2Darks" name="skills[]" class="select2 form-select"
                                        multiple="multiple">

                                    </select>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        <button type="button" onclick="editTopics()"
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <form onsubmit="return deleteTopics()">
                    <div class="modal-body">
                        <p>Do You Want to Delete this Record ?</p>
                        <input type="hidden" name="" id="topic_delete_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn background-info text-white" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                        <button type="button" onclick="deleteTopics()"
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

        let data1 = [];

        @foreach ($fetch_skills as $key => $skill)

            data1.push({
                id: "{{ $skill->skill_id }}",
                name: "{{ strtoupper($skill->skill_name) }}",
            });
        @endforeach



        function submitForm() {
            var topicName = $('#topic-name').val();
            var selectedSkills = $('#select2Dark').val();
            $.ajax({
                url: '{{ route('add-topic') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    topic_name: topicName,
                    skills: selectedSkills
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    location.reload();
                }
            });
        }



        function editModal(id) {

            var datas = @json($data);
            console.log(datas);
            $.each(datas, function(key, value) {
                if (value.topic_id == id) {
                    $("#topic_name").val(value.topic_name);
                    $("#topic_id").val(value.topic_id);
                    @php 
                    if(isset($selectedSkillIds)){
                    @endphp
                    
                    var selectedSkillIds = <?= $selectedSkillIds ?>;
                    data1.map((item) => {
                        item.selected = selectedSkillIds.includes(item.id) ? true : false;
                        console.log(selectedSkillIds, item.id);
                        return item;

                    })
                    data1.map((item) => {
                        var newOption = new Option(item.name, item.id, true, item.selected);
                        $('#select2Darks').append(newOption).trigger('change');
                    })

                    @php
                    }
                    @endphp

                }
            });
            $('#editTopics').modal('show');
        }



        function editTopics() {
            var topicId = $("#topic_id").val();
            var topicName = $('#topic_name').val();
            var selectedSkills = $('#select2Darks').val();
            $.ajax({
                url: '{{ route('edit-topic') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    topic_name: topicName,
                    topic_id: topicId,
                    skills: selectedSkills
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
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
                url: '{{ route('topic-status') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'value': value,
                    'is_active': is_active,
                },
            });

        }

        function deleteModal(id) {
            var datas = @json($data);
            $.each(datas, function(key, value) {
                console.log(key, value);
                if (value.topic_id == id) {
                    $("#topic_delete_id").val(value.topic_id);
                }
            });
            $('#deleteModal').modal('show');
        }

        function deleteTopics() {
            var topicId = $("#topic_delete_id").val();
            $.ajax({
                url: '{{ route('delete-topic') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    topic_id: topicId,
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    location.reload();
                }
            });
        }
    </script>

@endsection
