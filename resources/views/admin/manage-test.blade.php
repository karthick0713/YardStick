@extends('layouts/contentNavbarLayout')

@section('title', 'Manage Test ')

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
                <button class="line-button active create-test">Create a Test</button>
                <button class="line-button create-quiz">Create a Quiz</button>
            </div>
            <div class="line"></div>

            <div class="manage-create-test-component">
                @include('components.manage--test.create-test-component')
            </div>

            <div class="manage-create-quiz-component">
                @include('components.manage--test.create-quiz-component')
            </div>


        </div>
    </div>

@endsection
