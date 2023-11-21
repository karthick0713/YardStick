@extends('layouts/contentNavbarLayout')
@section('title', 'Admin')
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection
@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection
@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection
@section('content')
    <style>
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


        .height {
            line-height: 0.7 !important;
        }

        tr {
            line-height: 1.5cm;
        }

        td {
            padding-left: 15px;
        }
    </style>
    <div class="container">
        <div class="main-body card">
            <div class="row gutters-sm">
                <div class="col-12 col-md-6 mb-3">
                    <div class="d-flex flex-row align-items-center ms-3 ms-md-5 mb-3 text-center">
                        <div class="image-background" style="background-color: #f0f0f0; padding: 10px; border-radius: 50%;">
                            <img src="{{ asset($data->profile_image) }}" alt="Admin" class="rounded-circle"
                                width="200">
                        </div>
                        <div class="mt-3">
                            <div class="ms-3 ms-md-4 text-md-right">
                                <h4 class="text-sec-color"><b>John Doe</b></h4>
                                <b class="text-secondary mb-1 role">Admin</b>
                            </div>
                        </div>
                    </div>
                    {{-- personal info fields --}}
                    <div style="background-color:#FFFBF6;" class="card">
                        <div class="d-flex justify-content-end mt-1 mx-3"></div>
                        <table class="table">
                            <tr>
                                <td>Email</td>
                                <td class="fw-bold">{{ $data->email_id }}</td>
                            </tr>
                            <tr>
                                <td>Contact No.</td>
                                <td class="fw-bold">{{ $data->contact_no }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td class="fw-bold">{{ $data->address }}</td>
                            </tr>
                            <tr class="height">
                                <td>Skills</td>
                                <td class="fw-bold">
                                    @php
                                        $skills = explode(',', $data->skills_id);
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
                            </tr>
                            <tr>
                                <td>Certifications</td>
                                <td class="fw-bold">{{ $data->certifications }}</td>
                            </tr>
                            <tr>
                                <td>Projects Done</td>
                                <td class="fw-bold">{{ $data->projects_done }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                {{-- edit button --}}
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <div class="d-flex mt-3 mx-3">
                            <a style="font-family: 'Khula', sans-serif; font-size:20px;"
                                href="{{ route('admin-profile-edit') }}" class="text-black">
                                <i class="bx bx-edit-alt"></i>Edit
                            </a>
                        </div>
                    </div>
                    {{-- password and security questions fields --}}
                    <div class="row gutters-sm">
                        <div class="col-12 mb-3">
                            <div style="background-color:#FFFBF6;" class="card">
                                <div class="d-flex justify-content-end mt-1 mx-3"></div>
                                <table class="table">
                                    <tr>
                                        <td>Password</td>
                                        <td>
                                            <div class="fw-bold m-0 p-0">
                                                **********
                                            </div>
                                            <div class="m-0 p-0"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Security Questions</td>
                                        <td class="fw-bold">{{ $data->security_questions }}</td>
                                    </tr>
                                    <tr>
                                        <td>Primary Mobile No.</td>
                                        <td class="fw-bold">{{ $data->primary_mobile_no }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
