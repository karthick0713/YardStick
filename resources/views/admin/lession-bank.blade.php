@extends('layouts/contentNavbarLayout')

@section('title', 'Lession Bank')

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
                <button class="line-button active ">Lessions</button>
            </div>
            <div class="line"></div>

            <div class="">
                @include('components.lession--bank.create-lessions-component')
            </div>

        </div>

        {{-- <div>
                <button class="button-plus-icon"><i class='plus-icon bx bxs-plus-circle'></i></button>
            </div> --}}
    </div>
    </div>

@endsection
