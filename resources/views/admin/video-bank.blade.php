@extends('layouts/contentNavbarLayout')

@section('title', 'Video Bank ')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('assets/js/video-bank.js') }}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="col-12 mt-3">
            <div class="button-container">
                <button class="line-button active ">Video Bank</button>
            </div>
            <div class="line"></div>
            <div class="">
                @include('components.video--bank.create-video-bank-component')
            </div>


        </div>
    </div>

@endsection
