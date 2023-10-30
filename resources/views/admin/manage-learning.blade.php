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
        <div class="col-12 mt-3">
            <div class="button-container">
                <button class="line-button practice-sets active">Practice Sets</button>
                <button class="line-button manage-learning-lessons">Lessons</button>
                <button class="line-button manage-learning-videos">Videos</button>
            </div>
            <div class="line"></div>

            <div class="practice-set-component">
                @include('components.manage--learning.create-practice-set-component')
            </div>
            <div class="lession-component ">
                @include('components.manage--learning.create-lession-component')
            </div>
            <div class="video-component ">
                @include('components.manage--learning.create-video-component')
            </div>
        </div>

    </div>

@endsection
