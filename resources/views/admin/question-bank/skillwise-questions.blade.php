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
    {{-- <script src="{{ asset('assets/js/pagenation.js') }}"></script> --}}
    <script src="{{ asset('assets/js/table-search.js') }}"></script>
@endsection

@section('content')

    </head>

    <style>
        @media (min-width: 992px) {
            .custom-card {
                width: 48%;
            }
        }

        @media (max-width: 991px) {
            .custom-card {
                width: 100%;
            }
        }

        .custom-card {
            width: 100%;
            margin-bottom: 15px;
            max-width: 100%;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            background-color: #e8f0f5
        }

        .custom-card:hover {
            transform: scale(1.05);
        }

        .btn-outline-primary {
            color: rgba(33, 93, 129, 1);
            outline: none;
            border-color: rgb(238, 118, 118);
        }

        .btn-outline-primary:hover {
            background-color: rgb(238, 118, 118);
            border-color: rgba(33, 93, 129, 1);
        }


        .btn-outline-primary:focus {
            background-color: rgba(33, 93, 129, 1);
        }

        .tick-mark {
            position: relative;
            top: 1%;
            left: 0;
        }

        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .button-container button {
            flex-grow: 1;
            margin-bottom: 10px;
        }
    </style>

    <body>
        <div class="">
            <div class="container mt-5">
                {{-- select fields to filter questions --}}
                <form action="{{ route('view-filter-questions') }}" method="">
                    <div class="row col-12">
                        <div class=" col-md-4 mb-4">
                            <div class="card custom-card">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h6 class="card-title m-0 me-2"></h6>
                                </div>
                                {{-- select Difficulty --}}
                                <div class="card-body text-center">
                                    <div class="mx-auto mb-4">
                                        <span class=""><b>DIFFICULTY </b></span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-outline-primary mx-1">Easy-75</button>
                                        <button type="button" class="btn btn-outline-primary mx-1">Medium-70</button>
                                        <button type="button" class="btn btn-outline-primary mx-1">Hard-55</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- select category --}}
                        <div class=" col-md-4 mb-4">
                            <div class="card custom-card">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h6 class="card-title m-0 me-2"></h6>
                                </div>
                                <div class="card-body text-center">
                                    <div class="mx-auto mb-4">
                                        <span class=""><b>CATEGORY</b></span>
                                    </div>

                                    <div class="button-container">
                                        <button type="button" class="btn btn-outline-primary mx-1">Programming</button>
                                        <button type="button" class="btn btn-outline-primary mx-1">MCQ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- select topics --}}
                        <div class=" col-md-4 mb-4">
                            <div class="card custom-card">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h6 class="card-title m-0 me-2"></h6>
                                </div>
                                <div class="card-body text-center">
                                    <div class="mx-auto mb-4">
                                        <span class=""><b>TOPICS</b></span>
                                    </div>
                                    <div class="button-container">
                                        <button type="button" class="btn btn-outline-primary mx-1">Arrays</button>
                                        <button type="button" class="btn btn-outline-primary mx-1">Operators</button>
                                        <button type="button" class="btn btn-outline-primary mx-1">Statements</button>
                                        <button type="button" class="btn btn-outline-primary mx-1">Variables</button>
                                        <button type="button" class="btn btn-outline-primary mx-1">Datatypes</button>
                                        <button type="button" class="btn btn-outline-primary mx-1">Keywords</button>
                                        <button type="button" class="btn btn-outline-primary mx-1">Threads</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn background-secondary text-white">Check Questions</button>
                    </div>
                </form>
            </div>

        </div>

        <script>
            const buttons = document.querySelectorAll('.card-body button');
            const selectedValues = [];

            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    const tickMark = button.querySelector('.tick-mark');

                    if (button.classList.contains('active')) {
                        button.classList.remove('active');
                        tickMark.parentNode.removeChild(tickMark);
                        selectedValues.splice(selectedValues.indexOf(button.dataset.value), 1);
                    } else {
                        button.classList.add('active');
                        const tickMark = document.createElement('span');
                        tickMark.classList.add('tick-mark');
                        tickMark.innerHTML = '&#x2713;';
                        button.prepend(tickMark);
                        selectedValues.push(button.dataset.value);
                    }

                    console.log('Selected values:', selectedValues);
                });
            });
        </script>
    @endsection
