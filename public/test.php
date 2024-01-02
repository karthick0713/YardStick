@extends('layouts/studentNavbarLayout')

@section('title', 'Dashboard')

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
<style>
    a {
        color: black;
    }

    a:hover .background-light {
        color: white;
        background-color: rgb(238, 118, 118);
    }

    a:hover .text-info {
        background-color: aliceblue
    }

    .background-light {
        background-color: #d9eaf3;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: repeat(4, 1fr);
        gap: 10px;

        @media (max-width: 600px) {
            grid-template-columns: 1fr;
            /* Display as a single column on smaller screens */
            grid-template-rows: repeat(5, 1fr);
        }
    }
</style>
<div class="container full-screen-content">
    <div class="col-12">
        <div class="row">
            <div class="container mt-5">
                <div class="grid-container">
                    @foreach ($tests as $key => $test)
                    <div class="grid-item">
                        <a href="">
                            <div class="card h-100">
                                <div class="background-light card-body">

                                    <div class=" fw-bold">
                                        <img src="{{ url('assets/img/svg/test-icon.svg') }} " width="50" height="50" alt="Python">
                                    </div>

                                    <h5 class="fw-bold mt-3">
                                        {{ $test_params[$key]->title }}
                                    </h5>
                                    <div class="row mt-4 col-12">
                                        <div class="col-6 ">
                                            <i class="bx text-info bx-archive"></i><label class="">Practice
                                                Test</label>
                                            <br>
                                            <span class="ms-4 fw-bold">{{ ucfirst($test_params[$key]->practice_status) }}</span>
                                        </div>
                                        <div class="col-6">
                                            <i class="bx text-info bx-archive"></i><label class="">Total
                                                Sections</label>
                                            <br>
                                            <span class="ms-4 fw-bold">
                                                {{ count($test_sections[$key]) }} Sections
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row col-12 mt-4">
                                        <div class="col-6">
                                            <i class='bx text-info bx-calendar'></i> <label class="">Start
                                                Date</label>
                                            <br>
                                            <span class=" ms-4 fw-bold">
                                                @php
                                                $dateString = $test->start_date;
                                                $dateTime = new DateTime($dateString);
                                                $formattedDate = $dateTime->format('j M, y');
                                                echo $formattedDate;
                                                @endphp

                                            </span>
                                        </div>
                                        <div class="col-6">
                                            <i class='bx text-info bx-calendar'></i> <label class="">End
                                                Date</label>
                                            <br>
                                            <span class=" ms-4 fw-bold"><?php
                                                                        $dateString = $test->end_date;
                                                                        $dateTime = new DateTime($dateString);
                                                                        $formattedDate = $dateTime->format('j M, y');
                                                                        echo $formattedDate;
                                                                        ?>
                                            </span>
                                        </div>
                                    </div>


                                </div>


                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script></script>