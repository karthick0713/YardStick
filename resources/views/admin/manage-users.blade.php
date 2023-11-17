@extends('layouts/contentNavbarLayout')

@section('title', 'Manage Users')

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
                <button class="line-button active ">Users</button>
                <button class="line-button " id="">Users Group</button>
                <button class="line-button " id="">Import Users</button>
                <button class="line-button " id="">Import Users Groups</button>
            </div>
            <div class="line"></div>

        </div>

    </div>
    </div>

@endsection
