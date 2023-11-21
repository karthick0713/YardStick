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
    <script src="{{ asset('assets/js/form-select.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endsection
@section('content')

    <style>
        body {
            margin-top: 20px;
            color: #1a202c;
            text-align: left;
        }

        .main-body {
            padding: 15px;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col,
        .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }

        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }

        .h-100 {
            height: 100% !important;
        }

        .shadow-none {
            box-shadow: none !important;
        }

        tr {
            line-height: 1.5cm;
        }

        option{
            line-height: 0.5cm !important;
        }
        
        td {
            padding-left: 15px;
        }

        .password-toggle {
            position: relative;
        }

        #password {
            padding-right: 30px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 5px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        #password[type="password"] {
            -webkit-text-security: disc;
        }
    </style>
    <div class="container">

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


        <div class="main-body card">
            <form id="edit-form" onsubmit="return editProfile()">
                <div class="row col-12 gutters-sm">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex flex-row align-items-center ms-5 mb-5 text-center">
                            <div class="image-background"
                                style="background-color: #f0f0f0; padding: 10px; border-radius: 50%;">
                                <img src="{{asset($data->profile_image)}}" alt="Admin"
                                    class="rounded-circle" width="200">
                            </div>

                            <div class="mt-3">
                                <div style="margin-left:100px" class="text-right">
                                    <h4 class="text-sec-color"><input type="text" name="user_name" class="form-control"
                                            placeholder="Name" value="{{$data->name}}" id="user_name"></h4>
                                    <b class="text-secondary mb-1 role">Admin</b>
                                </div>
                            </div>
                        </div>
                        <div style="margin-left:70px">
                            <input type="file" name="user_image" id="user_image">
                        </div>
                        <div style="background-color:#FFFBF6;margin-top:60px" class="card ">

                            <div class="d-flex justify-content-end mt-1 mx-3">
                            </div>


                            {{-- edit personal info's --}}
                            <table id="contact-form">
                                @php
                                    $skills_id = explode(',',$data->skills_id);
                                    $selectedSkillIds = json_encode($skills_id);
                                @endphp
                                <tr>
                                    <td>Email</td>
                                    <td><input type="email" name="email_id" class="form-control" placeholder="Email"
                                            value="{{ $data->email_id }}" id="email_id"></td>
                                </tr>
                                <tr>
                                    <td>Contact No.</td>
                                    <td><input type="text" name="contact_no" class="form-control" placeholder="Contact No."
                                            value="{{ $data->contact_no }}" id="contact_no"></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><input type="text" name="address" class="form-control" placeholder="Address"
                                            value="{{ $data->address }}" id="address"></td>
                                </tr>
                                <tr>
                                    <td>Skills</td>
                                    <td><div class=" mb-3">
                                        <div class="mt-1 select2-dark">
                                            <select id="skills_id" name="skills_id[]"  class="select2 form-select"
                                                multiple="multiple">
        
                                            </select>
                                        </div>
                                    </div></td>
                                </tr>
                                <tr>
                                    <td>Certifications</td>
                                    <td><input type="text" name="certifications" class="form-control"
                                            placeholder="Certifications" value="{{ $data->certifications }}" id="certifications">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Projects Done</td>
                                    <td><input type="text" name="projects_done" placeholder="Projects Done"
                                            class="form-control" value="{{ $data->projects_done }}" id="projects_done"></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class=" mb-3">
                            <div style="margin-top:110px; " class="d-flex mx-3">
                            </div>
                        </div>

                        <div style="margin-top:148px;" class="row gutters-sm">
                            <div class=" mb-3">
                                <div style="background-color:#FFFBF6;" class="card ">
                                    <div class="d-flex justify-content-end mt-1 mx-3">
                                    </div>
                                    {{-- edit password and security questions --}}
                                    <table id="contact-form">
                                        <tr>
                                            <td>Password</td>
                                            <td>
                                                <div class="password-toggle">
                                                    <input type="password" id="password" value="{{ $data->password }}" name="password"
                                                        class="form-control" placeholder="Password">
                                                    <span class="toggle-password" id="togglePassword">
                                                        <i class="bx bx-show"></i>
                                                    </span>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Security Questions</td>
                                            <td><input type="text" name="security_questions" class="form-control"
                                                    placeholder="Security Questions"
                                                    value="{{ $data->security_questions }}" id="security_questions"></td>
                                        </tr>
                                        <tr>
                                            <td>Primary Mobile No.</td>
                                            <td><input type="text" name="primary_mobile_no" class="form-control"
                                                    placeholder="Mobile No" value="{{ $data->primary_mobile_no }}"
                                                    id="primary_mobile_no"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-end">
                            <button type="button" onclick="editProfile()" class="btn background-secondary text-white">Update Profile</button>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>

        $(document).ready(()=>{
            $(".success-message").fadeIn().delay(3000).fadeOut();
            $(".error-message").fadeIn().delay(3000).fadeOut();
        });

        const passwordField = document.getElementById("password");
        const togglePassword = document.getElementById("togglePassword");

        togglePassword.addEventListener("click", function() {
            if (passwordField.type === "password") {
                passwordField.type = "text";
                togglePassword.innerHTML = '<i class="bx bx-hide"></i>';
            } else {
                passwordField.type = "password";
                togglePassword.innerHTML = '<i class="bx bx-show"></i>';
            }
        });
        
        let data1 = [];

        var fetch_skills = @json($skills);
        $.each(fetch_skills, function(key, value) {
            data1.push({
                id: value.skill_id,
                text: value.skill_name,
            });
        });

        $(document).ready(() => {
            var datas = @json($data);
            @php
                if(isset($selectedSkillIds)){
            @endphp

            var selectedSkillIds = <?= $selectedSkillIds ?>;
            data1.map((item) => {
                item.selected = selectedSkillIds.includes(String(item.id)) ? true : false;
                console.log(selectedSkillIds, item.id);
                return item;
            })
            data1.map((item) => {
                var newOption = new Option(item.text, item.id, true, item.selected);
                $('#skills_id').append(newOption).trigger('change');
            })

            @php
                }
            @endphp

           
        })

        function editProfile() {
            var formData = new FormData($('#edit-form')[0]);
            console.log(formData);
            $.ajax({
                url: '{{ route('admin-edit-profile') }}',
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

    </script>
@endsection
