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
            @if (session('error'))
                <div class="error-message col-md-5">
                    <div class="alert bg-danger text-white fw-bold">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="success-message col-md-5">
                    <div class="alert bg-success text-white fw-bold">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            <div class="row col-12">
                <div class="col-5"></div>
                {{-- template download for import bulk questions --}}
                <div class="col-6 justify-content-center d-flex">
                    <div class="col-2">
                        <select name="" class="form-control " id="" required>
                            <option value="0">SELECT</option>
                            <option value="1">Programming</option>
                            <option value="2">MCQ</option>
                        </select>
                    </div>
                    <a download class="questions-template-button"><button
                            class="background-info btn text-white mx-3">Download Template</button></a>
                </div>

            </div>

            <div class="row justify-content-center mt-5">

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body background-light">
                            <div class="text-center fw-bold text-sec-color mt-3">Choose a File</div>

                            <form action="{{ route('import-excel-programming-questions') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 mt-4">
                                    <label class="ms-4" for="">Select Only a CSV, XLSX, or XLS file:</label>
                                    <input type="file" class="form-control login-fields" id="uploaded_file"
                                        name="uploaded_file" accept=".xlsx, .xls, .csv" required
                                        placeholder="Select a CSV, XLSX, or XLS file">
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

    <script>
        document.getElementById("uploaded_file").oninvalid = function(event) {
            event.target.setCustomValidity("Please Select Any File to Proceed !.");
        };

        $(document).ready(() => {
            $(".success-message").fadeIn().delay(3000).fadeOut();
            $(".error-message").fadeIn().delay(3000).fadeOut();

            $(".background-info").on('click', function() {
                if ($('select').val() == 0) {
                    $('select').each(function() {
                        alert("Please Select Any Format to Download..!");
                    });
                } else {
                    if ($('select').val() == 1) {
                        $(".questions-template-button").attr('href',
                            '{{ asset('import-templates/programming-questions-format.xlsx') }}')
                    } else if ($('select').val() == 2) {
                        $(".questions-template-button").attr('href',
                            '{{ asset('import-templates/mcq-questions-format.xlsx') }}')
                    }
                }
            });

        });
    </script>
@endsection
