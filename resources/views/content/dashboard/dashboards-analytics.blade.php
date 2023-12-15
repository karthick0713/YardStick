@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

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
    <div class="container full-screen-content">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card">
                            <div class="background-light d-flex card-body">
                                <div>
                                    <i class='dashboard-icon-size bx bx-building'></i>
                                </div>
                                <div class="ms-3" style="padding-top: 10px">
                                    <label class="fw-bold" for="">Total Tests</label><br>
                                    <span class="text-sec-color fw-bold">{{ $data['total_duration'] }} hrs
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card">
                            <div class="background-light d-flex card-body">
                                <div>
                                    <i class='dashboard-icon-size bx bx-question-mark'></i>
                                </div>
                                <div class="ms-3" style="padding-top: 10px">
                                    <label class="fw-bold" for="">Total Questions</label><br>
                                    <span class="text-sec-color fw-bold">{{ $data['total_questions'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card">
                            <div class="background-light d-flex card-body">
                                <div>
                                    <i class='dashboard-icon-size bx bxs-user-rectangle'></i>
                                </div>
                                <div class="ms-3" style="padding-top: 10px">
                                    <label class="fw-bold" for="">Total Users</label><br>
                                    <span class="text-sec-color fw-bold">{{ $data['total_students'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card">
                            <div class="background-light d-flex card-body">
                                <div>
                                    <i class='dashboard-icon-size bx bx-briefcase'></i>
                                </div>
                                <div class="ms-3" style="padding-top: 10px">
                                    <label class="fw-bold" for="">Total Colleges</label><br>
                                    <span class="text-sec-color fw-bold">{{ $data['total_colleges'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
