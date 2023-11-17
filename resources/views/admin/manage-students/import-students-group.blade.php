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
    <script src="{{ asset('assets/js/single-pagenation.js') }}"></script>
    <script src="{{ asset('assets/js/single-table-search.js') }}"></script>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="container">

            <div class="row col-12">
                <div class="col-5"></div>
                {{-- template download for entry the student groups data --}}
                <div class="col-6 justify-content-center d-flex">
                    <a download="" href="{{ asset('import-templates/users-import-template.xlsx') }}"><button
                            class="background-info btn text-white">Download Template</button></a>
                </div>

            </div>

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
                                    <div class="col d-flex align-items-center  justify-content-center">
                                        <button class="btn background-secondary text-white mx-3 w-25">Proceed</button>
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
