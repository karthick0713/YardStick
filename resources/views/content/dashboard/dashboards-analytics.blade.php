@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

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
    <div class="container">
        <div class="col-12">
            <div class="card full-height-card">
                <div class="dashboard-card-cover card-body row">
                    <div style="display: flex" class="col-md-3">
                        <div>
                            <i class='dashboard-icon-size bx bxs-user-rectangle'></i>
                        </div>
                        <div style="padding-top: 10px">
                            <b>Total Users</b><br>
                            <span class="icon-text-color">300</span>
                        </div>
                    </div>
                    <div style="display: flex" class="col-md-3">
                        <div>
                            <i class='dashboard-icon-size bx bxs-food-menu'></i>
                        </div>
                        <div style="padding-top: 10px">
                            <b>Total Questions</b><br>
                            <span class="icon-text-color">458</span>
                        </div>
                    </div>
                    <div style="display: flex" class="col-md-3">
                        <div>
                            <i class='dashboard-icon-size bx bx-bulb'></i>
                        </div>
                        <div style="padding-top: 10px">
                            <b>Total Quizzes</b><br>
                            <b class="icon-text-color">152 mins</b>
                        </div>
                    </div>
                    <div style="display: flex" class="col-md-3">
                        <div>
                            <i class='dashboard-icon-size bx bxs-book-bookmark'></i>
                        </div>
                        <div style="padding-top: 10px">
                            <b>Total Practice Sets</b><br>
                            <span class="icon-text-color">3</span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <label for=""><b>Quick Links</b></label>
            <div class="quick-positions">
                <div class="row mt-3 col-md-12">
                    <div class="col-md-3">
                        <a href="" class="text-primary">New Quiz Schedule</a>
                    </div>
                    <div class="col-md-3">
                        <a href="" class="text-primary">View Quizzes</a>
                    </div>
                    <div class="col-md-3">
                        <a href="" class="text-primary">Important Questions</a>
                    </div>
                    <div class="col-md-3">
                        <a href="" class="text-primary">Create New Topic</a>
                    </div>
                </div>
                <div class="row mt-2 col-md-12">
                    <div class="col-md-3">
                        <a href="" class="text-primary">Create New Quiz</a>
                    </div>
                    <div class="col-md-3">
                        <a href="" class="text-primary">View Practice Sets</a>
                    </div>
                    <div class="col-md-3">
                        <a href="" class="text-primary">Create New Comprehension</a>
                    </div>

                </div>

                <div class="row mt-2 col-md-12">
                    <div class="col-md-3">
                        <a href="" class="text-primary">Create Practice Sets</a>
                    </div>
                    <div class="col-md-3">
                        <a href="" class="text-primary">Create New Quiz</a>
                    </div>
                    <div class="col-md-3">
                        <a href="" class="text-primary">Create New Skill</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
