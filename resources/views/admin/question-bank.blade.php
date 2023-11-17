@extends('layouts/contentNavbarLayout')

@section('title', 'Question Bank')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('assets/js/single-pagenation.js') }}"></script>
    <script src="{{ asset('assets/js/single-table-search.js') }}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="col-12 mt-3">
            <div class="button-container">
                <button class="line-button active imported-questions">Import Questions</button>
                <button class="line-button que-questions" id="dropdown-questions">Questions</button>
            </div>
            <div class="line"></div>

            <div class="imported-question-component">
                @include('components.question--bank.create-imported-questions-component')
            </div>

            <div class="question-component">
                @include('components.question--bank.create-questions-component')
            </div>

        </div>

        {{-- <div>
                <button class="button-plus-icon"><i class='plus-icon bx bxs-plus-circle'></i></button>
            </div> --}}
    </div>
    </div>

@endsection
