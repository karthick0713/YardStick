@extends('layouts/studentNavbarLayout')

@section('title', $heading)

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
            /* grid-template-rows: repeat(4, 1fr); */
            gap: 10px;
        }

        .cards {
            width: 100%;
            padding: 20px;
            margin: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f2f2f2;
            text-align: center;
        }

        .no-data-message {
            color: #555;
            font-style: italic;
        }
    </style>
    <div class="container ">
        <div class="col-12">
            <div class="row">
                <div class="mt-3">
                    <div class="grid-container">
                        @foreach ($tests as $key => $test)
                            @if ($test_params[$key]->practice_status == 'yes')
                                <div class="grid-item">
                                    <div class="card h-100">
                                        <div class="background-light card-body">
                                            <div class="d-flex justify-content-end">

                                                <a href="{{ route('student-test-screen', [request()->segment(3), base64_encode($test->test_code)]) }}"
                                                    class="btn background-secondary text-white btn-sm">Start
                                                    Test</a>
                                            </div>
                                            <div class=" fw-bold">
                                                <img src="{{ asset('assets/img/svg/test-icon.svg') }} " width="50"
                                                    height="50" alt=" {{ $test_params[$key]->title }}">
                                            </div>

                                            <h5 class="fw-bold mt-3">
                                                {{ $test_params[$key]->title }}
                                            </h5>
                                            <div class="row mt-4 col-12">
                                                <div class="col-6 ">
                                                    <i class="bx text-info bx-archive"></i><label class="">Practice
                                                        Test</label>
                                                    <br>
                                                    <span
                                                        class="ms-4 fw-bold">{{ ucfirst($test_params[$key]->practice_status) }}</span>
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
                                                    <i class='bx text-info bx-time'></i><label class="">Total
                                                        Duration
                                                    </label>
                                                    <br>
                                                    <span class=" ms-4 fw-bold">
                                                        @php
                                                            $tot_duration = DB::table('test_section_wise_questions')
                                                                ->select(DB::raw('SUM(duration) as duration'))
                                                                ->where('test_code', $test->test_code)
                                                                ->first();
                                                            $total_duration = $tot_duration->duration;
                                                            if ($total_duration < 60) {
                                                                echo $total_duration . ' Mins';
                                                            } else {
                                                                $converted_time = date('H:i', mktime(0, $total_duration));
                                                                echo $converted_time . ' Hours';
                                                            }

                                                        @endphp
                                                    </span>
                                                </div>
                                                <div class="col-6">
                                                    <i class='bx text-info bx-question-mark'></i> <label
                                                        class="">Total
                                                        Questions
                                                    </label>
                                                    <br>
                                                    <span class=" ms-4 fw-bold">
                                                        @php
                                                            $test_type = DB::table('test_creation')
                                                                ->where('test_code', $test->test_code)
                                                                ->first();
                                                            if ($test_type->test_type == 1) {
                                                                $test_question = DB::table('test_section_wise_questions')
                                                                    ->where('test_code', $test->test_code)
                                                                    ->get();

                                                                $count = 0;

                                                                foreach ($test_question as $tq) {
                                                                    $count += count(explode(',', $tq->common_test_question));
                                                                }

                                                                echo $count . ' questions';
                                                            } else {
                                                                $test_question = DB::table('test_section_wise_questions')
                                                                    ->where('test_code', $test->test_code)
                                                                    ->get();

                                                                foreach ($test_question as $tq) {
                                                                    $count = 0;

                                                                    foreach (['easy', 'medium', 'hard', 'very_hard'] as $difficulty) {
                                                                        if (!empty($tq->$difficulty)) {
                                                                            $count += count(explode(',', $tq->$difficulty));
                                                                        }
                                                                    }

                                                                    echo $count . ' questions';
                                                                }
                                                            }
                                                        @endphp
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row col-12 mt-4">
                                                <div class="col-6">
                                                    <i class='bx text-info bx-calendar'></i><label class="">Start
                                                        Date</label>
                                                    <br>
                                                    <span class=" ms-4 fw-bold">
                                                        @php
                                                            $dateString = $test->start_date;
                                                            $dateTime = new DateTime($dateString);
                                                            $formattedDate = $dateTime->format('j M, y H:i');
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
                                                    $formattedDate = $dateTime->format('j M, y H:i');
                                                    echo $formattedDate;
                                                    ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($test_params[$key]->practice_status == 'no')
                                @php
                                    $practice = DB::table('students_test_entries')
                                        ->where('test_code', $test->test_code)
                                        ->where('student_reg_no', session('userId'))
                                        ->count();
                                @endphp
                                @if ($practice > 0)
                                @else
                                    <div class="grid-item">

                                        <div class="card h-100">
                                            <div class="background-light card-body">
                                                <div class="d-flex justify-content-end">

                                                    <a href="{{ route('student-test-screen', [request()->segment(3), base64_encode($test->test_code)]) }}"
                                                        class="btn background-secondary text-white btn-sm">Start
                                                        Test</a>


                                                </div>
                                                <div class=" fw-bold">
                                                    <img src="{{ asset('assets/img/svg/test-icon.svg') }} " width="50"
                                                        height="50" alt=" {{ $test_params[$key]->title }}">
                                                </div>

                                                <h5 class="fw-bold mt-3">
                                                    {{ $test_params[$key]->title }}
                                                </h5>
                                                <div class="row mt-4 col-12">
                                                    <div class="col-6 ">
                                                        <i class="bx text-info bx-archive"></i><label
                                                            class="">Practice
                                                            Test</label>
                                                        <br>
                                                        <span
                                                            class="ms-4 fw-bold">{{ ucfirst($test_params[$key]->practice_status) }}</span>
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
                                                        <i class='bx text-info bx-time'></i><label class="">Total
                                                            Duration
                                                        </label>
                                                        <br>
                                                        <span class=" ms-4 fw-bold">
                                                            @php
                                                                $tot_duration = DB::table('test_section_wise_questions')
                                                                    ->select(DB::raw('SUM(duration) as duration'))
                                                                    ->where('test_code', $test->test_code)
                                                                    ->first();
                                                                $total_duration = $tot_duration->duration;
                                                                if ($total_duration < 60) {
                                                                    echo $total_duration . ' Mins';
                                                                } else {
                                                                    $converted_time = date('H:i', mktime(0, $total_duration));
                                                                    echo $converted_time . ' Hours';
                                                                }

                                                            @endphp
                                                        </span>
                                                    </div>
                                                    <div class="col-6">
                                                        <i class='bx text-info bx-question-mark'></i> <label
                                                            class="">Total
                                                            Questions
                                                        </label>
                                                        <br>
                                                        <span class=" ms-4 fw-bold">
                                                            @php
                                                                $test_type = DB::table('test_creation')
                                                                    ->where('test_code', $test->test_code)
                                                                    ->first();
                                                                if ($test_type->test_type == 1) {
                                                                    $test_question = DB::table('test_section_wise_questions')
                                                                        ->where('test_code', $test->test_code)
                                                                        ->get();

                                                                    $count = 0;

                                                                    foreach ($test_question as $tq) {
                                                                        $count += count(explode(',', $tq->common_test_question));
                                                                    }

                                                                    echo $count . ' questions';
                                                                } else {
                                                                    $test_question = DB::table('test_section_wise_questions')
                                                                        ->where('test_code', $test->test_code)
                                                                        ->get();

                                                                    foreach ($test_question as $tq) {
                                                                        $count = 0;

                                                                        foreach (['easy', 'medium', 'hard', 'very_hard'] as $difficulty) {
                                                                            if (!empty($tq->$difficulty)) {
                                                                                $count += count(explode(',', $tq->$difficulty));
                                                                            }
                                                                        }

                                                                        echo $count . ' questions';
                                                                    }
                                                                }
                                                            @endphp
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row col-12 mt-4">
                                                    <div class="col-6">
                                                        <i class='bx text-info bx-calendar'></i><label class="">Start
                                                            Date</label>
                                                        <br>
                                                        <span class=" ms-4 fw-bold">
                                                            @php

                                                                $dateString = $test->start_date;
                                                                $dateTime = new DateTime($dateString);
                                                                $formattedDate = $dateTime->format('j M, y H:i');
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
                                                        $formattedDate = $dateTime->format('j M, y H:i');
                                                        echo $formattedDate;
                                                        ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- 
    <a href="{{ route('student-report', [request()->segment(3), base64_encode($test->test_code)]) }}"
        class="btn background-secondary text-white btn-sm"> View Result</a> --}}


    <div class="container">
        <div class="col-12 mt-5">
            <h5 class="fw-bold text-danger">COMPLETED TESTS</h5>
            <div class="row">
                <div class="grid-container">
                    @foreach ($tests as $key => $test)
                        @php
                            $givenTimestamp = strtotime($test->display_result_date);
                            $currentTimestamp = time();

                            $testCode = $test->test_code;
                            $courseId = $test->course_id;
                            $studentRegNo = session('userId');

                            $studentTestEntry = DB::select(
                                "
    SELECT test_code, course_id, student_reg_no, COUNT(*) as total_entries
    FROM students_test_entries
    WHERE test_code = :testCode AND course_id = :courseId AND student_reg_no = :studentRegNo
    GROUP BY test_code, course_id, student_reg_no
",
                                [
                                    'testCode' => $testCode,
                                    'courseId' => $courseId,
                                    'studentRegNo' => $studentRegNo,
                                ],
                            );

                            $numRows = count($studentTestEntry);
                        @endphp

                        @if ($numRows > 0)
                            <div class="grid-item">
                                <div class="card h-100">
                                    <div class="background-light card-body">
                                        <div class="d-flex justify-content-end">

                                            @if ($test->display_result_status != 1)
                                                @if ($currentTimestamp >= $givenTimestamp)
                                                    <a href="{{ route('student-report', [request()->segment(3), base64_encode($test->test_code)]) }}"
                                                        class="btn background-secondary text-white btn-sm"> View Result</a>
                                                @endif
                                            @else
                                                <a href="{{ route('student-report', [request()->segment(3), base64_encode($test->test_code)]) }}"
                                                    class="btn background-secondary text-white btn-sm"> View Result</a>
                                            @endif

                                        </div>
                                        <div class=" fw-bold">
                                            <img src="{{ asset('assets/img/svg/test-icon.svg') }} " width="50"
                                                height="50" alt=" {{ $test_params[$key]->title }}">
                                        </div>

                                        <h5 class="fw-bold mt-3">
                                            {{ $test_params[$key]->title }}
                                        </h5>
                                        <div class="row mt-4 col-12">
                                            <div class="col-6 ">
                                                <i class="bx text-info bx-archive"></i><label class="">Practice
                                                    Test</label>
                                                <br>
                                                <span
                                                    class="ms-4 fw-bold">{{ ucfirst($test_params[$key]->practice_status) }}</span>
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
                                                <i class='bx text-info bx-time'></i><label class="">Total
                                                    Duration
                                                </label>
                                                <br>
                                                <span class=" ms-4 fw-bold">
                                                    @php
                                                        $tot_duration = DB::table('test_section_wise_questions')
                                                            ->select(DB::raw('SUM(duration) as duration'))
                                                            ->where('test_code', $test->test_code)
                                                            ->first();
                                                        $total_duration = $tot_duration->duration;
                                                        if ($total_duration < 60) {
                                                            echo $total_duration . ' Mins';
                                                        } else {
                                                            $converted_time = date('H:i', mktime(0, $total_duration));
                                                            echo $converted_time . ' Hours';
                                                        }

                                                    @endphp
                                                </span>
                                            </div>
                                            <div class="col-6">
                                                <i class='bx text-info bx-question-mark'></i> <label class="">Total
                                                    Questions
                                                </label>
                                                <br>
                                                <span class=" ms-4 fw-bold">
                                                    @php
                                                        $test_type = DB::table('test_creation')
                                                            ->where('test_code', $test->test_code)
                                                            ->first();
                                                        if ($test_type->test_type == 1) {
                                                            $test_question = DB::table('test_section_wise_questions')
                                                                ->where('test_code', $test->test_code)
                                                                ->get();
                                                            foreach ($test_question as $tq) {
                                                                $count = count(explode(',', $tq->common_test_question));
                                                            }
                                                            echo $count . ' questions';
                                                        } else {
                                                            $test_question = DB::table('test_section_wise_questions')
                                                                ->where('test_code', $test->test_code)
                                                                ->get();
                                                            foreach ($test_question as $tq) {
                                                                $count = 0;
                                                                foreach (['easy', 'medium', 'hard', 'very_hard'] as $difficulty) {
                                                                    if (!empty($tq->$difficulty)) {
                                                                        $count += count(explode(',', $tq->$difficulty));
                                                                    }
                                                                }
                                                                echo $count . ' questions';
                                                            }
                                                        }
                                                    @endphp
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row col-12 mt-4">
                                            <div class="col-6">
                                                <i class='bx text-info bx-calendar'></i><label class="">Start
                                                    Date</label>
                                                <br>
                                                <span class=" ms-4 fw-bold">
                                                    @php
                                                        $dateString = $test->start_date;
                                                        $dateTime = new DateTime($dateString);
                                                        $formattedDate = $dateTime->format('j M, y H:i');
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
                                                $formattedDate = $dateTime->format('j M, y H:i');
                                                echo $formattedDate;
                                                ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>



@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script></script>
