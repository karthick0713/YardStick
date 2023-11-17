@extends('layouts/contentNavbarLayout')

@section('title', $sub_heading)

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
    <div class="container mt-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="col-12 text-center mt-3">
                        <a download="" href="{{ asset('import-templates/client-import-template.xlsx') }}">
                            <button class="background-info btn text-white">Download Template</button>
                        </a>
                    </div>
                </div>
            </div>
            {{-- college import fields --}}
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body background-light">
                            <div class="text-center fw-bold text-sec-color mt-3">Choose a File</div>
                            <form action="" method="">
                                <div class="mb-3 mt-4">
                                    <label class="ms-4" for="">Select Only a CSV, XLSX, or XLS file:</label>
                                    <input type="file" class="form-control login-fields" id="username"
                                        accept=".xlsx, .xls, .csv" placeholder="">
                                </div>
                                <div class="row mt-5">
                                    <div class="col d-flex align-items-center justify-content-center">
                                        <button class="btn background-secondary text-white mx-3">Proceed</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
