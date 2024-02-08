@extends('layouts/studentTestNavbarLayout')
@section('title', 'Test')
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
    <script>
        document.body.classList.add('side-bar-hide');
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/monaco-editor@0.23.0/min/vs/loader.js"></script>

    <style>
        * {
            --side-bar-width: 420px;
            --qz-green: #010202;
            --qz-violet: #915ab8;
            --qz-red: #c13a24;
            /* user-select: none; */
        }

        #content-to-fullscreen {
            background-color: #fff;
        }

        .custom-alert {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px 20px;
            border-radius: 5px;
        }

        a {
            text-decoration: unset !important;
        }

        .nav-items-cont h6,
        .nav-items-cont .timer {
            padding: 8px 0;
        }

        #side-bar {
            position: fixed;
            width: var(--side-bar-width);
            right: 0;
            top: 70px;
            height: 100vh;
            background: #d9edf6;
            transition: all 0.5s ease-in-out;
            z-index: 70;
        }

        .accordion-button:not(.collapsed) {
            background-color: #ffffff;
        }

        #side-bar .icon i {
            transition: all 0.2s ease-in-out;
        }

        .side-bar-hide #side-bar {
            transform: translateX(var(--side-bar-width));
        }


        body:not(.side-bar-hide) .mcq-grouping {
            max-width: min(100% - var(--side-bar-width));
        }

        .side-bar-hide #side-bar .icon i {
            rotate: 180deg;
        }

        #side-bar .icon {
            background: #000;
            position: absolute;
            top: 50%;
            left: -20px;
            color: #fff;
            padding: 21px 5px;
            font-size: 12px;
            cursor: pointer;
        }

        .user-img {
            object-fit: cover;
            width: 45px;
            height: 45px;
        }

        .header-bar {
            padding: 10px 0;
        }

        main {
            width: min(100% - var(--side-bar-width));
            transition: all 0.5s ease-in-out;
        }

        footer {
            position: fixed;
            width: min(100% - var(--side-bar-width));
            bottom: 0;
            padding: 10px 15px;
            background: #f8f9fa;
            transition: all 0.5s ease-in-out;
        }

        .side_bar_footer {
            position: fixed;
            bottom: 0;
            padding: 10px 15px;
            width: var(--side-bar-width);
        }

        .btn-theme {
            background: #aad0f4;
        }

        .help-btn .btn {
            width: 48.5%;
        }

        ul.quiz_info li {
            list-style: none;
            margin: 10px 6px;
        }

        ul.quiz_info li span {
            padding: 2px 8px;
            background: #000;
            margin: 0 10px;
            color: #fff;
            display: inline-block;
            text-align: center;
        }

        ul.quiz_number.quiz_info li span {
            min-width: 34px;
        }

        ul.quiz_info li span.answered {
            background: var(--qz-green);
            border-radius: 1rem 1rem 0 0;
        }

        ul.quiz_info li span.marked {
            background: var(--qz-violet);
            border-radius: 50%;
        }

        .mark-for-review {
            background: #fff;
            color: #000;
            border-radius: 0 0 1rem 0;
            border-radius: 3rem;
            padding: 2px 14px;
            border: 1px solid #2b2b2b;
        }

        ul.quiz_info li span.not_visited {
            background: #fff;
            border: 1px solid #2b2b2b;
            border-radius: 0;
            color: #000;
        }

        ul.quiz_info li span.marked_answered {
            background: var(--qz-violet);
            border-radius: 50%;
        }

        ul.quiz_info li span.not_answered {
            background: var(--qz-red);
            border-radius: 0 0 1rem 1rem;
        }

        ul.quiz_info li span.active {
            background: #fff;
            color: #000;
            border-radius: 0 0 1rem 0;
            border-radius: 3rem;
            padding: 2px 14px;
            border: 1px solid #2b2b2b;
        }

        .quiz_list_number_box .list_title {
            background: #b4daed;
        }

        .question-button.marked {
            background-color: #00bf96 !important;
        }

        .side-bar-hide main,
        .side-bar-hide footer {
            width: 100%;
        }

        @media (max-width: 914px) {

            main,
            footer {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .footer-btn .btn {
                /* float: unset !important; */
                width: 100%;
                margin: 5px 0;
            }

            #side-bar {
                width: min(100% - 25px);
            }

            .side-bar-hide #side-bar {
                transform: translateX(min(100% - 0px));
            }
        }

        .programming_screen {
            background-color: #f2f2f2;
        }

        #code-editor {
            height: 45vw;
        }


        #content-to-fullscreen,
        .programming_screen {
            display: none;
        }

        .nav-tabs {
            border-bottom: unset !important;
        }

        .nav-link.active {
            border-bottom: 3px solid #EE7676 !important;
            background-color: #215D81 !important;
            color: white !important;
        }


        body::-webkit-scrollbar {
            width: 0px !important;
            background-color: #000;
            height: 1.4em !important;
        }

        #home,
        #profile {
            max-height: 600px !important;
        }

        .hidden-testcase-tab {
            display: none;
        }


        #clockdiv {
            font-family: sans-serif;
            color: #fff;
            display: inline-block;
            font-weight: 100;
            text-align: center;
            font-size: 15px;
        }

        #clockdiv>div {
            padding: 5px;
            border-radius: 3px;
            background: #00bf96;
            display: inline-block;
        }

        #clockdiv div>span {
            padding: 5px;
            border-radius: 3px;
            background: #00816a;
            display: inline-block;
        }

        /* Style for visible text */
        .smalltext {
            padding-top: 5px;
            font-size: 16px;
        }

        .card {
            height: 100%;
            overflow-y: auto;
            scrollbar-width: thin;
            /* Firefox */
            scrollbar-color: transparent transparent;
            /* Firefox */
        }

        ::-webkit-scrollbar {
            width: 6px;
            /* Adjust as needed */
        }

        ::-webkit-scrollbar-thumb {
            background-color: transparent;
            /* Hide scrollbar thumb */
        }

        .card {
            transition: margin-left 0.5s;
        }

        .hidden-card {
            margin-left: -100%;
            /* Adjust the value based on your layout */
        }

        #passageAccordion-2 {
            max-height: 55%;
            overflow: auto;
        }

        #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7);
            z-index: 9999;
            display: none;
        }

        #loader::after {
            content: '';
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            width: 60px;
            height: 60px;
            margin: -30px 0 0 -30px;
            border-radius: 50%;
            border: 6px solid #3498db;
            border-color: #3498db transparent #3498db transparent;
            animation: spin 1.2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    </head>

    <body>

        <div id="loader"></div>

        <div id="customAlert" class="custom-alert">
            <p>Please Select Any One of the Option..!</p>
        </div>

        <div id="all-test-screens" style="background-color:#ffffff !important">


            <nav class="navbar navbar-light bg-white">
                <div class="container">
                    <div class="nav-items-cont w-100 d-flex flex-column flex-md-row justify-content-between p-2">
                        <h6 class="m-0"></h6>
                        <div id="clockdiv">
                            <span class="fw-bold">TIME LEFT : &nbsp;&nbsp;</span>
                            <div>

                                <span class="hours" id="hour"></span>
                            </div>
                            <div>

                                <span class="minutes" id="minute"></span>
                            </div>
                            <div>
                                <span class="seconds" id="second"></span>
                            </div>
                        </div>
                        <div class="mt-2 mt-md-0">
                            <button type="button" id="fullscreen-btn" class="btn fullscreen-btn btn-outline-info">
                                Switch Full Screen
                            </button>
                            {{-- <button type="button" class="btn btn-outline-info">Pause</button> --}}
                        </div>
                    </div>
                </div>

            </nav>

            <div id="content-to-fullscreen">

                <aside>
                    <div id="side-bar" class="px-2  mt-3">
                        <div class="icon">
                            <i class="fa fa-chevron-right"></i>
                        </div>
                        <div class="user-info border-bottom py-2">
                            <img src="https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/user-male-circle-blue-512.png"
                                class="rounded-circle user-img" alt="user-img" />
                            <span class="fs-5 ms-2">{{ session('userName') }}</span>
                        </div>
                        <input type="hidden" name="student_test_entry_id" id="student_test_entry_id">
                        <ul class="quiz_info d-flex flex-wrap border-bottom py-2 ps-0">
                            <li><span class="answered">0</span>Answered</li>
                            <li><span class="marked">0</span>Marked</li>
                            <li><span class="not_visited">0</span>Not Visited</li>
                        </ul>
                        <div class="quiz_list_number_box">
                            <div class="list_title p-2"><b>SECTION</b> : <span class="sec_name"></span></div>
                            <ul class="quiz_number quiz_info d-flex flex-wrap border-bottom py-2">

                            </ul>
                        </div>

                        <div class="accordion" id="passageAccordion-1">

                        </div>
                        <div class="side_bar_footer border-top">
                            <div class="help-btn d-flex justify-content-between my-2">
                                <button class="btn btn-theme">Question Paper</button>
                                <button class="btn btn-theme">Instruction</button>
                            </div>
                            <button type="button" class="w-100 btn btn-info submit-test">Submit Test</button>
                        </div>
                    </div>
                </aside>
                <!-- end side bar -->
                <main>
                    <section>
                        <div id="content" class="bg-light">

                            <div id="section-buttons"></div>

                            <div class="container-fluid">
                                <!-- header bar -->
                                <div class="header-bar d-flex">

                                </div>
                                <!-- end of header bar -->
                                <div class="question-wrapper bg-white py-3 px-4 border-bottom">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="fw-bold question_count m-0">Question No. </p>
                                        </div>
                                        <div class="col-md-2">
                                            Marks <br />
                                            <span class="badge rounded-pill org-marks bg-success"></span>
                                            <span class="badge rounded-pill neg-marks bg-danger">-0.5</span>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="btn-group">
                                                <button type="button" class="btn dropdown-toggle py-0"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-warning"></i> Report
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="#">Wrong Question</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">Formatting Issue</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">Wrong Translation</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">Others</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- question box -->
                                <div class="question-box bg-white py-4 px-4">
                                    <p class="fs-5 question-p">

                                    </p>
                                    <hr />
                                    <div class="Answer-options">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- footer -->
                    <footer>
                        <div class="footer-btn ">
                            {{-- <button type="button" class="btn btn-theme mark-for-review-button">Mark for Review &
                                Next</button> --}}
                            <button type="button" class="btn btn-theme mx-4 previous-button">Previous</button>
                            <button type="button" class="btn btn-theme clear-response">Clear Response</button>
                            <button type="button" class="btn btn-info float-right save-next">Next</button>
                        </div>
                    </footer>
                    <!-- end footer -->
                </main>
            </div>

            <div id="programming_screen" class="programming_screen">

                <div>
                    <div class="header-bar">
                        <div class="row col-12">

                            <div class="col-5 section-name-div"></div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select name="" style="" class="form-control" id="languageSelect">
                                            <option value="c">C</option>
                                            <option value="cpp">C++</option>
                                            <option value="csharp">C#</option>
                                            <option value="java">Java</option>
                                            <option value="python">Python</option>
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="d-flex">
                                            <button type="button"
                                                class="btn btn-outline-info programming_run_button">&#x23F8;
                                                Compile & Run</button>
                                            <button type="button"
                                                class="btn btn-theme mx-4 verify-button">Verify</button>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="dropdown float-end">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="themeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                🎨
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="themeDropdown">
                                                <li><a class="dropdown-item theme-button" data-value="vs-dark"
                                                        href="#">Dark Theme</a></li>
                                                <li><a class="dropdown-item theme-button" data-value="vs-light"
                                                        href="#">Light Theme</a></li>
                                                <li><a class="dropdown-item theme-button" data-value="hc-black"
                                                        href="#">High-Contrast Theme</a>
                                                </li>
                                                <!-- Add more theme options as needed -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div>
                        <div class="row col-12">
                            <div class="col-4" style="max-height: 100vh;">
                                <div class="card" style="height: 100%; overflow-y: auto;">
                                    <div class="ms-1 card-body">
                                        <div class="programming-questions"></div>

                                        <label class="mt-4 fw-bold">INPUT FORMAT</label>
                                        <div class="mt-2 ms-2 input-format"></div>

                                        <label class="mt-4 fw-bold">OUTPUT FORMAT</label>
                                        <div class="mt-2 ms-2 output-format"></div>

                                        <label class="fw-bold mt-4"> CODE CONSTRAINTS</label>
                                        <div class="mt-2 ms-2 code-constraints"></div>

                                        <div class="mt-4  test-case-div"></div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-5">

                                <div id="code-editor"></div>
                            </div>


                            <div class="col-3" style="max-height: 100vh;">
                                <div class="card" style="height: 100%; overflow-y: auto;">

                                    <div class="card-body">
                                        <div class="row col-12 ">

                                            <div class="">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="home-tab"
                                                            data-bs-toggle="tab" data-bs-target="#home" type="button"
                                                            role="tab" aria-controls="home"
                                                            aria-selected="true">Sample Test
                                                            Case</button>
                                                    </li>
                                                    <li class="ms-2 nav-item" role="presentation">
                                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                                            data-bs-target="#profile" type="button" role="tab"
                                                            aria-controls="profile" aria-selected="false">Hidden Test
                                                            Case</button>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                                        aria-labelledby="home-tab">

                                                        <div id="sample_correct_testcase" class="mt-4">

                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="profile" role="tabpanel"
                                                        aria-labelledby="profile-tab">
                                                        <div class="verify-error mt-4 fw-bold text-danger"></div>
                                                        <div class="hidden-testcase-tab">
                                                            <div class="card mt-4">
                                                                <div class="card-body">
                                                                    <h6 class="fw-bold d-inline-block">Total Test Case:
                                                                    </h6>
                                                                    <span
                                                                        class="test-case-count fw-bold text-success d-inline-block">
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div class="card mt-2">
                                                                <div class="card-body">
                                                                    <h6 class="fw-bold d-inline-block">Passed Test Case:
                                                                    </h6>
                                                                    <span
                                                                        class="passed-case-count fw-bold text-success d-inline-block"></span>
                                                                </div>
                                                            </div>

                                                            <div class="card mt-2">
                                                                <div class="card-body">
                                                                    <h6 class="fw-bold d-inline-block">Rejected Test Case:
                                                                    </h6>
                                                                    <span
                                                                        class="rejected-case-count text-danger fw-bold d-inline-block"></span>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                    <footer>
                        <div class="col-12 footer-btn d-flex justify-content-center">
                            {{-- <button type="button" class="btn btn-theme">Mark for Review & Next</button> --}}
                            <button type="button" class="btn btn-theme mx-4 previous-button">Previous</button>
                            <button type="button" class="btn btn-theme mx-4 save-next ">Next</button>

                            <button type="button" class="btn btn-info mx-4 submit-test float-end"> Submit</button>
                        </div>
                    </footer>
                </div>

            </div>



            <div class="mcq-grouping" id="mcq_grouping" style="display:none;background-color:#ffffff !important;">

                <aside>
                    <div id="side-bar" class="px-2  mt-3">
                        <div class="icon">
                            <i class="fa fa-chevron-right"></i>
                        </div>
                        <div class="user-info border-bottom py-2">
                            <img src="https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/user-male-circle-blue-512.png"
                                class="rounded-circle user-img" alt="user-img" />
                            <span class="fs-5 ms-2">{{ session('userName') }}</span>
                        </div>
                        <input type="hidden" name="student_test_entry_id" id="student_test_entry_id">
                        <ul class="quiz_info d-flex flex-wrap border-bottom py-2 ps-0">
                            <li><span class="answered">0</span>Answered</li>
                            <li><span class="marked">0</span>Marked</li>
                            <li><span class="not_visited">0</span>Not Visited</li>
                        </ul>
                        <div class="quiz_list_number_box">
                            <div class="list_title p-2"><b>SECTION</b> : <span class="sec_name"></span></div>
                            <ul class="quiz_number quiz_info d-flex flex-wrap border-bottom py-2">

                            </ul>
                        </div>

                        <div class="accordion" id="passageAccordion-2">

                        </div>

                        <div class="side_bar_footer border-top">
                            <div class="help-btn d-flex justify-content-between my-2">
                                <button class="btn btn-theme">Question Paper</button>
                                <button class="btn btn-theme">Instruction</button>
                            </div>
                            <button type="button" class="w-100 btn btn-info submit-test">Submit Test</button>
                        </div>
                    </div>
                </aside>

                <div class="row col-12 mb-5">

                    <div class="col-5 section-buttons "></div>

                </div>
                <div class="row col-12">
                    <div class="col-6" style="max-height: 100vh; max-width: 100vw;">
                        <div class="card" style="height: 100%; overflow-y: auto;">
                            <div class="card-body">
                                <div class="passage-title"
                                    style="position: sticky; top: 0; background-color: #ffffff; z-index: 1;">
                                    <h5 class="fw-bold">Read the Below passage and Answer the questions:</h5>
                                </div>
                                <div class="passage-col">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6" style="max-height: 100vh; max-width: 100vw;">
                        <div class="card" style="height: 100%; overflow-y: auto;">
                            <div class="card-body ">
                                <div class="question-col">
                                </div>
                                <div class="mt-5">
                                    <button type="button"
                                        class="btn background-info text-white grouping-mark-for-review">Mark For
                                        Review</button>

                                    <button type="button" class="btn btn-theme mx-4 previous-button">Previous</button>

                                    <button type="button"
                                        class="btn background-secondary text-white float-end grouping-save-next">Save
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>


        </div>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>



        <script>
            $(function() {

                $("#side-bar .icon").click(function() {
                    $("body").toggleClass("side-bar-hide");
                });

            });

            var disable_finish_button = @json($test_parameters->disable_finish_button);

            var questionsData;
            var question_code_for_save;
            var fetch_questions;
            var currentQuestionIndex = 0;
            var total_duration;
            var totalSeconds = localStorage.getItem("remainingSeconds");
            var timer;
            var codes;
            var editor;
            var test_case_samples = [];
            var run_question_inputs = [];
            var run_question_outputs = [];
            var verify_question_inputs = [];
            var verify_question_outputs = [];
            var saved_questions = [];
            var currentPassage = 0;

            $(document).ready(function() {

                function showLoader() {
                    $("#loader").show();
                }

                function hideLoader() {
                    $("#loader").hide();
                }

                const languages = {
                    java: {
                        id: 'java',
                        name: 'Java',
                        extension: '.java'
                    },
                    python: {
                        id: 'python',
                        name: 'Python',
                        extension: '.py'
                    },
                    c: {
                        id: 'c',
                        name: 'C',
                        extension: '.c'
                    },
                    cpp: {
                        id: 'cpp',
                        name: 'C++',
                        extension: '.cpp'
                    },
                    csharp: {
                        id: 'csharp',
                        name: 'C#',
                        extension: '.cs'
                    },
                }


                if (disable_finish_button == 1) {
                    $(".submit-test").prop("disabled", true);
                }



                var marked_questions = localStorage.getItem('markedQuestions_cat2');

                marked_questions = marked_questions ? JSON.parse(marked_questions) : [];

                if (localStorage.getItem('section') === null) {
                    localStorage.setItem('section', 0)
                }

                setTimeout(() => {
                    $('button').each(function(i, e) {
                        if ($(this).val() == localStorage.getItem('section')) {
                            $(this).prop('disabled', true);
                        }
                    });
                }, 1000);

                if (localStorage.getItem('theme') == null) {
                    localStorage.setItem('theme', 'vs-light')
                }


                function pauseTimerForTwoSeconds() {

                    clearInterval(timer);

                    setTimeout(() => {

                        startTimer(totalSeconds);

                    }, 2000);
                }



                function showPassageAndQuestions(index) {

                    if (timer != null) {

                        pauseTimerForTwoSeconds();

                    }

                    showLoader();

                    setTimeout(() => {

                        $("#content-to-fullscreen").hide();

                        $("#programming_screen").hide();

                        $("#mcq_grouping").show();

                        hideLoader();


                    }, 2000);

                    if (questionsData && questionsData[index] && questionsData[
                            index
                        ]
                        .question_for_test) {
                        $(".passage-col").html(
                            `<p>${questionsData[index].question_for_test.title}</p>`
                        );

                        if (questionsData[index].grouping_questions &&
                            questionsData[
                                index
                            ].grouping_questions.length > 0) {
                            $(".question-col").html(
                                `<p>${questionsData[index].grouping_questions[currentPassage].questions}</p>`
                            );

                            var mcqOptions = questionsData[currentQuestionIndex]
                                .mcq_options;

                            mcqOptions[currentPassage].forEach(function(
                                opt) {
                                $(".question-col").append(`
                                    <div>
                                    <label class="form-check-label">
                                    <input type="radio" name="mcqOption" data-question="${opt.question_code}"  data-groupid="${questionsData[index].grouping_questions[currentPassage].id}" value="${opt.id}">
                                    ${opt.option_name}: ${opt.option_answer}
                                    </label>
                                    </div>
                                    `);
                            });
                        } else {
                            console.error("grouping_questions is undefined or empty at index",
                                index);
                        }
                    } else {
                        console.error(
                            "questionsData or question_for_test is undefined at index",
                            index);
                    }
                }




                function showQuestion(index) {

                    showLoader();


                    if (localStorage.getItem("question_category") == 2) {


                        if (timer != null) {

                            pauseTimerForTwoSeconds();

                        }


                        setTimeout(() => {

                            $("#content-to-fullscreen").show();

                            $("#programming_screen").hide();

                            $("#mcq_grouping").hide();

                            hideLoader();

                        }, 2000);



                        var question_cat_set = fetch_questions[1][localStorage.getItem('section')][
                            index
                        ].category

                        localStorage.setItem('question_category', question_cat_set);

                        var question = questionsData[index].question_for_test;

                        var mcqOptions = questionsData[index].mcq_options;
                        $(".question_count").text("Question No. " + (index + 1));
                        $(".org-marks").html(questionsData[index].question_marks)
                        $(".question-p").html(question.replaceAll('<p><br></p>', ""));
                        $(".question-p").attr('data-index', `${index}`);
                        $(".Answer-options").empty();

                        var optionsContainer = $("<div>", {
                            class: "options-container"
                        });


                        for (var i = 0; i < mcqOptions.length; i++) {


                            var optionIndex = i + 1;
                            var correctOptId = mcqOptions[i].id;
                            var optionValue = mcqOptions[i].correct_answer;
                            var optionText = mcqOptions[i].option_answer;
                            var optquesCode = mcqOptions[i].question_code;

                            var radioElement = $("<input>", {
                                class: "form-check-input",
                                type: "radio",
                                name: "option",
                                id: "option" + optionIndex,
                                value: btoa(correctOptId)
                            });

                            radioElement.attr('data-quest', btoa(optquesCode));

                            var labelElement = $("<label>", {
                                class: "form-check-label",
                                for: "option" + optionIndex
                            });

                            labelElement.html(optionText.replaceAll('<p><br></p>', ""));

                            optionsContainer.append($("<div>", {
                                class: "form-check"
                            }).append(radioElement, labelElement));

                        }

                        $(".Answer-options").append(optionsContainer);



                    } else if (localStorage.getItem("question_category") == 1) {

                        if (timer != null) {

                            pauseTimerForTwoSeconds();

                        }

                        setTimeout(() => {

                            $("#content-to-fullscreen").hide();

                            $("#programming_screen").show();

                            $("#mcq_grouping").hide();

                            hideLoader();

                        }, 2000);

                        run_question_inputs = [];
                        run_question_outputs = [];
                        verify_question_inputs = [];
                        verify_question_outputs = [];

                        $(".test-case-div").empty();

                        $("#sample_correct_testcase").empty();
                        $(".test-case-count").text("");
                        $(".passed-case-count").text("");
                        $(".rejected-case-count").text("");

                        var question_cat_set = fetch_questions[1][localStorage.getItem('section')][
                            index
                        ].category

                        localStorage.setItem('question_category', question_cat_set);

                        var programming_questions = fetch_questions[1][localStorage.getItem('section')][
                            index
                        ].question_for_test

                        var question = programming_questions.questions

                        var test_cases = fetch_questions[1][localStorage.getItem('section')][
                            index
                        ].test_cases;

                        question_code_for_save = programming_questions.question_code;

                        var testcasediv = "";
                        var coun = 1;

                        console.log(fetch_questions[1][localStorage.getItem('section')][
                            index
                        ]);

                        $(test_cases).map((i, e) => {

                            if (e.sample != 1) {
                                testcasediv += `
                                    <h6 class="fw-bold">SAMPLE TEST CASE: ${coun ++}</h6>
                                    <div class="ms-2">
                                    <label class="fw-bold text-primary text-decoration-underline">Input</label>
                                    <p >${e.input}</p>
                                    <label class="fw-bold text-info text-decoration-underline ">Output</label>
                                    <p>${e.output}</p>
                                </div>
                                `;
                            }


                            run_question_inputs.push(e.input);
                            run_question_outputs.push(e.output);
                            verify_question_inputs.push(e.input);
                            verify_question_outputs.push(e.output);
                            test_case_samples.push(e.sample);
                        })


                        $(".test-case-div").append(testcasediv);

                        var input_format = programming_questions.input_format
                        var output_format = programming_questions.output_format
                        var code_constraints = programming_questions.code_constraints


                        $(".programming-questions").html(question)
                        $(".input-format").html(input_format)
                        $(".output-format").html(output_format)
                        $(".code-constraints").html(code_constraints)



                        function code_editor() {

                            setTimeout(() => {


                                require.config({
                                    paths: {
                                        vs: "https://cdn.jsdelivr.net/npm/monaco-editor@0.23.0/min/vs",
                                    },
                                });
                                require(["vs/editor/editor.main"], function() {


                                    var languageSelector = document.getElementById(
                                        "languageSelect");

                                    var codeEditor = document.getElementById(
                                        "code-editor");

                                    var initialLoad = true;

                                    if (editor) {
                                        editor.dispose();
                                    }

                                    editor = monaco.editor.create(
                                        codeEditor, {
                                            value: `/* Type Your Code */`,
                                            language: languageSelector.value,
                                            theme: localStorage.getItem('theme'),
                                        }
                                    );


                                    function updateEditorValue() {
                                        var editorValueKey =
                                            `typed_coding_${localStorage.getItem('section')}_${currentQuestionIndex}`;
                                        var savedCode = localStorage.getItem(editorValueKey) || '';
                                        editor.setValue(savedCode);
                                    }

                                    updateEditorValue();


                                    codes = editor.getValue();

                                    languageSelector.addEventListener("change",
                                        function() {
                                            var selectedLanguage = this.value;

                                            if (!initialLoad) {
                                                var currentCode = editor.getValue();
                                                codes = currentCode;
                                            }

                                            editor.getModel().dispose();

                                            editor.setModel(monaco.editor
                                                .createModel(
                                                    initialLoad ? "" : codes,
                                                    selectedLanguage));

                                            initialLoad = false;
                                            setTimeout(() => {
                                                $(".slider").remove();
                                                var savedCode = localStorage
                                                    .getItem(
                                                        `typed_coding_${localStorage.getItem('section')}_${currentQuestionIndex}`
                                                    ) || '';

                                                if (savedCode) {
                                                    editor.setValue(
                                                        savedCode);
                                                }
                                            }, 100);
                                        });



                                    $(".slider").remove();
                                });


                            }, 2100);

                        }

                        code_editor();

                    } else if (localStorage.getItem("question_category") == 3) {

                        location.reload();

                        showPassageAndQuestions(index);

                    }


                }

                function markForReview() {

                    var markedQuestions = JSON.parse(localStorage.getItem('markedQuestions_cat2')) || [];

                    if (!markedQuestions.includes(currentQuestionIndex)) {

                        markedQuestions.push(currentQuestionIndex);

                        localStorage.setItem('markedQuestions_cat2', JSON.stringify(markedQuestions));

                        $('.quiz_number li:eq(' + currentQuestionIndex + ')').addClass('mark-for-review');

                        currentQuestionIndex++;

                        var question_cat_set = fetch_questions[1][localStorage.getItem('section')][
                            currentQuestionIndex
                        ].category;

                        localStorage.setItem('question_category', question_cat_set);

                        showQuestion(currentQuestionIndex);

                        localStorage.setItem("currentQuestionIndex" + localStorage.getItem('section'),
                            currentQuestionIndex);
                    } else {

                        alert('Question already marked for review.');

                        currentQuestionIndex++;

                        showQuestion(currentQuestionIndex)

                        localStorage.setItem("currentQuestionIndex" + localStorage.getItem('section'),
                            currentQuestionIndex);
                    }
                }



                var isReloaded = false;


                function saveAndNext() {

                    if (localStorage.getItem("question_category") == 2) {

                        var selectedAnswer = $("input[name='option']:checked");


                        if (selectedAnswer.length < 1) {
                            // showWarning();
                            alert('Please select an answer..!');
                            return false;
                        }


                        // var remaiming_time = localStorage.getItem("remainingSeconds");

                        $.ajax({


                            url: "{{ route('save-questions-answers') }}",
                            type: "POST",
                            data: {
                                test_entry_id: $("#student_test_entry_id").val(),
                                course_id: {{ base64_decode(request()->segment(2)) }},
                                test_code: "{{ base64_decode(request()->segment(3)) }}",
                                question_code: atob($(selectedAnswer).attr("data-quest")),
                                option_id: atob($(selectedAnswer).val()),
                                user_id: "{{ session('userId') }}",
                                question_index: currentQuestionIndex,
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {

                                setTimeout(() => {
                                    saved_questions.push(data);

                                    localStorage.setItem('savedQuestions', JSON.stringify(
                                        saved_questions));

                                }, 1000);
                            }


                        });


                        $(".question" + currentQuestionIndex).removeClass('active');

                        currentQuestionIndex++;


                        $(".question" + currentQuestionIndex).addClass('active');

                        localStorage.setItem("currentQuestionIndex" + localStorage.getItem('section'),
                            currentQuestionIndex);

                        console.log(fetch_questions[1][localStorage.getItem('section')].length);
                        if (currentQuestionIndex < fetch_questions[1][localStorage.getItem('section')].length) {

                            var question_cat_set = fetch_questions[1][localStorage.getItem('section')][
                                currentQuestionIndex
                            ].category;

                            localStorage.setItem('question_category', question_cat_set);

                            // showLoader();

                            // setTimeout(() => {

                            showQuestion(currentQuestionIndex);

                            // }, 2000);

                        } else {

                            // location.reload();

                        }



                    } else if (localStorage.getItem("question_category") == 1) {

                        currentQuestionIndex++;


                        localStorage.setItem("currentQuestionIndex" + localStorage.getItem('section'),
                            currentQuestionIndex);


                        if (currentQuestionIndex < fetch_questions[1][localStorage.getItem('section')].length) {


                            var question_cat_set = fetch_questions[1][localStorage.getItem('section')][
                                currentQuestionIndex
                            ].category;

                            localStorage.setItem('question_category', question_cat_set);

                            showQuestion(currentQuestionIndex);

                            isReloaded = true;

                            // location.reload();
                        } else {




                        }

                    }



                }


                function previous() {


                    if (currentQuestionIndex > 0) {

                        currentQuestionIndex--;

                        var question_cat_set = fetch_questions[1][localStorage.getItem('section')][
                            currentQuestionIndex
                        ].category;

                        localStorage.setItem('question_category', question_cat_set);

                        localStorage.setItem("currentQuestionIndex" + localStorage.getItem('section'),
                            currentQuestionIndex);

                        showQuestion(currentQuestionIndex);

                    } else {

                    }

                }

                $(".mark-for-review-button").click(function() {

                    markForReview();

                });


                function findLanguageById(id) {
                    return Object.values(languages).find(lang => lang.id === id);
                }



                $(".programming_run_button").click(function() {

                    showLoader();


                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var lang = $("#languageSelect option:selected").val()
                        .toLowerCase();
                    const languageIdToFind = lang;
                    const foundLanguage = findLanguageById(languageIdToFind);
                    var editorContent = editor.getValue();

                    $.ajax({
                        url: "{{ route('run-code') }}",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            content: editorContent,
                            language: foundLanguage.id,
                            stdin: run_question_inputs,
                            filename: `index${foundLanguage.extension}`,
                        },
                        success: function(data) {

                            hideLoader();

                            $("#sample_correct_testcase").empty();

                            if (data[0].stderr != null) {
                                var formattedStderr = data[0].stderr
                                    .replace(/\n/g, '<br>');

                                $("#sample_correct_testcase").html(
                                    formattedStderr).addClass(
                                    "text-danger fw-bold");


                                $("#home-tab").addClass("active");

                                $("#home").addClass("active show");

                                $("#profile-tab").removeClass("active");

                                $("#profile").removeClass("active show");

                                return false;
                            } else {


                                $("#sample_correct_testcase").removeClass(
                                    "text-danger fw-bold");

                                var k = 1;
                                var test_case_correct;
                                $(data).each(function(i, elem) {
                                    var cleanStdout = elem.stdout
                                        .trim()
                                        .split('\n').join('').split(
                                            '\r').join('');
                                    var cleanExpectedOutput =
                                        run_question_outputs[i]
                                        .trim().split('\n').join('')
                                        .split('\r').join('');


                                    if (arraysEqual(cleanStdout,
                                            cleanExpectedOutput)) {

                                        if (test_case_samples[i] == 0) {

                                            test_case_correct = `
                                                  <div class="accordion accordion-flush" id="sampleCrctExample${i}">
                                                              <div class="accordion-item rounded-3 border-0 shadow mb-2">
                                                                  <h2 class="accordion-header">
                                                                      <button
                                                                          class="accordion-button text-success border-bottom collapsed fw-semibold"
                                                                          type="button" data-bs-toggle="collapse"
                                                                          data-bs-target="#flush-collapseOne-${i}" aria-expanded="false"
                                                                          aria-controls="flush-collapseOne-${i}">
                                                                          Test Case Sample : ${k++}
                                                                      </button>
                                                                  </h2>
                                                                  <div id="flush-collapseOne-${i}" class="accordion-collapse collapse"
                                                                      data-bs-parent="#sampleCrctExample${i}">
                                                                      <div class="accordion-body mt-3">
                                                                          <div class="executed-output">
                                                                              <h6 class="fw-bold">Executed Output: </h6>
                                                                              <p>${elem.stdout}</p>
                                                                          </div>
                                                                          <div class="expected-output">
                                                                              <h6 class="fw-bold">Expected Output: </h6>
                                                                              <p>${run_question_outputs[i]}</p>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
  
                                                         `;

                                        }



                                        $("#sample_correct_testcase")
                                            .append(
                                                test_case_correct);

                                    } else {

                                        if (test_case_samples[i] == 0) {

                                            test_case_correct = `
                                                  <div class="accordion accordion-flush" id="sampleCrctExample${i}">
                                                              <div class="accordion-item rounded-3 border-0 shadow mb-2">
                                                                  <h2 class="accordion-header">
                                                                      <button
                                                                          class="accordion-button text-danger border-bottom collapsed fw-semibold"
                                                                          type="button" data-bs-toggle="collapse"
                                                                          data-bs-target="#flush-collapseOne-${i}" aria-expanded="false"
                                                                          aria-controls="flush-collapseOne-${i}">
                                                                          Test Case Sample : ${k++}
                                                                      </button>
                                                                  </h2>
                                                                  <div id="flush-collapseOne-${i}" class="accordion-collapse collapse"
                                                                      data-bs-parent="#sampleCrctExample${i}">
                                                                      <div class="accordion-body mt-3">
                                                                          <div class="executed-output">
                                                                              <h6 class="fw-bold">Executed Output: </h6>
                                                                              <p>${elem.stdout}</p>
                                                                          </div>
                                                                          <div class="expected-output">
                                                                              <h6 class="fw-bold">Expected Output: </h6>
                                                                              <p>${run_question_outputs[i]}</p>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
  
                                                         `;

                                            $("#sample_correct_testcase")
                                                .append(
                                                    test_case_correct);

                                        }
                                    }
                                });

                                function arraysEqual(arr1, arr2) {
                                    if (arr1.length !== arr2.length)
                                        return false;
                                    for (var i = 0; i < arr1.length; i++) {
                                        if (arr1[i] !== arr2[i])
                                            return false;
                                    }
                                    return true;
                                }


                                $("#home-tab").addClass("active");

                                $("#home ").addClass("active show");

                                $("#profile-tab").removeClass("active");

                                $("#profile").removeClass("active show");


                                hideLoader();



                            }


                        },
                        error: function(data) {
                            alert('Something went wrong');
                        }
                    })

                });



                $(".verify-button").click(function() {

                    showLoader();

                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var lang = $("#languageSelect option:selected").val()
                        .toLowerCase();
                    const languageIdToFind = lang;
                    const foundLanguage = findLanguageById(languageIdToFind);
                    var editorContent = editor.getValue();
                    $.ajax({
                        url: "{{ route('run-code') }}",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            content: editorContent,
                            language: foundLanguage.id,
                            stdin: verify_question_inputs,
                            filename: `index${foundLanguage.extension}`,
                        },
                        success: function(data) {

                            hideLoader();

                            if (data[0].stderr != null) {

                                var formattedStderr = data[0].stderr
                                    .replace(/\n/g, '<br>');

                                $(".verify-error").html(formattedStderr);


                                $("#home-tab").removeClass("active");

                                $("#home ").removeClass("active show");

                                $("#profile-tab").addClass("active");

                                $("#profile").addClass("active show");
                                return false;

                            } else {

                                $(".verify-error").empty();
                                var tot = data.length;

                                var passed_case = 0;

                                var rejected_case = 0;

                                $(data).each(function(i, elem) {
                                    var cleanStdout = elem.stdout
                                        .trim()
                                        .split('\n').join('').split(
                                            '\r').join('');
                                    var cleanExpectedOutput =
                                        verify_question_outputs[i]
                                        .trim().split('\n').join('')
                                        .split('\r').join('');

                                    if (arraysEqual(cleanStdout,
                                            cleanExpectedOutput)) {
                                        passed_case++;
                                    } else {
                                        rejected_case++;
                                    }
                                });

                                $(".test-case-count").text(tot);
                                $(".passed-case-count").text(passed_case);
                                $(".rejected-case-count").text(
                                    rejected_case);


                                function arraysEqual(arr1, arr2) {
                                    if (arr1.length !== arr2.length)
                                        return false;
                                    for (var i = 0; i < arr1.length; i++) {
                                        if (arr1[i] !== arr2[i])
                                            return false;
                                    }
                                    return true;
                                }

                                $("#home-tab").removeClass("active");

                                $("#home ").removeClass("active show");

                                $("#profile-tab").addClass("active");

                                $("#profile").addClass("active show");



                                $(".hidden-testcase-tab")
                                    .show();



                            }

                            $.ajax({

                                url: "{{ route('test-testcase-update') }}",
                                type: 'POST',
                                data: {
                                    question_code: question_code_for_save,
                                    code: editor.getValue(),
                                    datas: data,
                                    test_entry_id: localStorage
                                        .getItem('get_id'),
                                    student_reg_no: "{{ session('userId') }}",
                                    test_code: "  {{ base64_decode(request()->segment(3)) }}",
                                    course_id: "  {{ base64_decode(request()->segment(2)) }}",
                                    total_seconds: totalSeconds,
                                    passed_case: passed_case,
                                    rejected_case: rejected_case
                                },
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                success: function(data) {}

                            });



                        },
                        error: function(data) {
                            alert('Something went wrong');
                        }
                    })
                });





                $.ajax({


                    url: "{{ route('fetch-test-questions') }}",
                    type: "GET",
                    data: {
                        test_code: "{{ base64_decode(request()->segment(3)) }}",
                        course_id: {{ base64_decode(request()->segment(2)) }},
                    },
                    success: function(data) {

                        fetch_questions = data;

                        var passageAccordionItem = "";

                        var html = "";


                        var html = "";
                        var passageAccordionItem = "";

                        $(fetch_questions[1][localStorage.getItem('section')]).each(function(i, e) {

                            if (e.category == 2) {
                                var isMarked = marked_questions.includes(i);
                                html +=
                                    `<li class="span-ques li-ques${i} ${isMarked ? 'mark-for-review' : ''}" style="cursor:pointer"><span class="question${i}">${i+1}</span></li>`;
                            } else if (e.category == 3) {
                                var questionButtons = "";
                                for (var j = 1; j <= e.grouping_questions.length; j++) {
                                    questionButtons +=
                                        `<div class="col-2"><button type="button" class="btn btn-sm background-info text-white question-button" data-index="${i+1}" data-question="${j}" >${j}</button></div>`;
                                }
                                passageAccordionItem += `
            <div class="accordion-item mt-3">
                <h2 class="accordion-header" id="passageHeading${i}">
                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#passageCollapse${i}" aria-expanded="true" aria-controls="passageCollapse${i}">
                        Question ${i + 1}
                    </button>
                </h2>
                <div id="passageCollapse${i}" class="accordion-collapse collapse" aria-labelledby="passageHeading${i}" data-bs-parent="#passageAccordion-1">
                    <div class="accordion-body">
                        <div class= "mt-4 row col-12 ">
                            ${questionButtons}
                        </div>
                    </div>
                </div>
            </div>`;
                            }
                        });

                        if (html && passageAccordionItem) {
                            $('.quiz_number').append(html);
                            $("#passageAccordion-1").append(passageAccordionItem);
                        } else {
                            if (html) {
                                $('.quiz_number').append(html);
                            }
                            if (passageAccordionItem) {
                                $("#passageAccordion-2").append(passageAccordionItem);
                            }
                        }


                        if (localStorage.getItem("question_category") == null || localStorage.getItem(
                                "question_category") == "undefined") {

                            localStorage.setItem('question_category', data[1][0][0]['category']);

                        }


                        $(".sec_name").text(data[0].sections[localStorage.getItem("section")]);


                        if (localStorage.getItem('question_category') == 1) {

                            $(data[0].sections).each(function(i, e) {

                                $(".section-name-div").append(
                                    `<button type="button" value="${i}" onclick="save_session(this.value)" class="btn btn-sm section-button btn-success ms-3  ">${e}</button>`
                                );

                            });


                            questionsData = data[1][localStorage.getItem('section')];

                            setTimeout(() => {

                                showQuestion(currentQuestionIndex);
                            }, 1000);

                            $(".save-next").click(function() {

                                saveAndNext();

                            });


                            $(".previous-button").on('click', function() {

                                previous();

                            });

                            $(".test-title").html("<b>Programming Examination</b>");

                            $(".programming_screen").show();

                            $("#content-to-fullscreen").hide();




                            $("#code-editor").on("keyup", function() {

                                setTimeout(() => {
                                    localStorage.setItem(
                                        `typed_coding_${localStorage.getItem('section')}_${currentQuestionIndex}`,
                                        editor.getValue());
                                }, 500);

                            });


                            $(".theme-button").click(function() {

                                localStorage.setItem("theme", $(this).attr("data-value"));

                                showQuestion(currentQuestionIndex);

                            });






                        } else if (localStorage.getItem('question_category') == 2) {

                            $(".previous-button").on('click', function() {

                                previous();

                            });

                            $(data[0].sections).each(function(i, e) {

                                $("#section-buttons").before(
                                    `<button type="button" value="${i}" onclick="save_session(this.value)"  class="btn btn-sm section-button btn-success ms-3  ">${e}</button>`
                                );

                            });


                            $("#content-to-fullscreen").show();


                            questionsData = data[1][localStorage.getItem("section")];


                            showQuestion(currentQuestionIndex);


                            $(".save-next").click(function() {

                                var data_index = $(".question-p").attr('data-index');

                                data_index = parseInt(data_index);

                                $('.li-ques' + data_index).removeClass('mark-for-review');

                                marked_questions = marked_questions.filter(function(item) {
                                    return item !== data_index;
                                });

                                localStorage.setItem('markedQuestions_cat2', JSON.stringify(
                                    marked_questions));

                                saveAndNext();

                            });



                        } else if (localStorage.getItem('question_category') == 3) {


                            $(".previous-button").on('click', function() {

                                previous();

                            });

                            $(".mcq-grouping").show();

                            questionsData = data[1][localStorage.getItem('section')];



                            var current_pass_and_quest = [];

                            $(data[0].sections).each(function(i, e) {
                                $(".section-buttons").append(
                                    `<button type="button" value="${i}" onclick="save_session(this.value)"  class="btn btn-sm section-button btn-success ms-3  ">${e}</button> `
                                );

                            });

                            var markedQuestions_cat3 = JSON.parse(localStorage.getItem(
                                'markedQuestions_cat3')) || [];

                            markedQuestions_cat3 = markedQuestions_cat3.filter((item, index, self) => {
                                const strItem = JSON.stringify(item);
                                return index === self.findIndex(t => JSON.stringify(t) === strItem);
                            });


                            setTimeout(() => {

                                markedQuestions_cat3.forEach(function(questionIndex, i) {

                                    $(`.question-button[data-index="${currentQuestionIndex}"][data-question="${questionIndex[1] + 1}"]`)
                                        .addClass('marked');

                                });


                            }, 1000);

                            function markForReviews() {

                                var current_pass_and_quest = [currentQuestionIndex, currentPassage];

                                var isMarked = markedQuestions_cat3.some(function(question) {
                                    return question[0] === current_pass_and_quest[0] && question[
                                        1] === current_pass_and_quest[1];
                                });

                                if (!isMarked) {
                                    markedQuestions_cat3.push(current_pass_and_quest);
                                    localStorage.setItem('markedQuestions_cat3', JSON.stringify(
                                        markedQuestions_cat3));

                                    saveAndNextCategory3();

                                    setTimeout(function() {

                                        $(`.question-button[data-index="${currentQuestionIndex}"][data-question="${current_pass_and_quest[1] + 1}"]`)
                                            .addClass('marked');

                                    }, 500);
                                } else {
                                    alert('You have already marked this question');
                                    saveAndNextCategory3();
                                }
                            }


                            function navigateToMarkedQuestion(passageIndex, questionIndex) {
                                currentPassage = passageIndex -
                                    1;
                                currentQuestionIndex = questionIndex;
                                showPassageAndQuestions(currentQuestionIndex);
                            }


                            $(document).on("click", ".question-button.marked", function() {
                                var questionIndex = $(this).data('index');
                                var passageIndex = $(this).data('question');

                                navigateToMarkedQuestion(passageIndex, questionIndex);
                            });



                            $(".grouping-mark-for-review").click(function() {
                                markForReviews();
                            });


                            var questionCategories = data[2];

                            showPassageAndQuestions(currentQuestionIndex);

                            $(".grouping-save-next").click(function() {

                                if ($('input[type="radio"]:checked').length == 0) {
                                    alert('Please Select Any Option');
                                    return false;
                                }

                                var selectedAnswer = $("input[type='radio']:checked");

                                $.ajax({
                                    url: '{{ route('save-questions-answers') }}',
                                    type: 'POST',
                                    data: {
                                        test_entry_id: $("#student_test_entry_id").val(),
                                        course_id: {{ base64_decode(request()->segment(2)) }},
                                        test_code: "{{ base64_decode(request()->segment(3)) }}",
                                        question_code: $(selectedAnswer).attr(
                                            "data-question"),
                                        group_question_id: $(selectedAnswer).attr(
                                            "data-groupid"),
                                        option_id: $(selectedAnswer).val(),
                                        user_id: "{{ session('userId') }}",
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                            'content')
                                    },
                                    success: function(data) {
                                        saveAndNextCategory3();
                                    },
                                    error: function(data) {
                                        alert('Something went wrong');
                                    }
                                });



                            });

                            $(".test-title").html("<b>Category 3: Passage Reading MCQ</b>");
                            $(".category3-screen").show();
                            $("#content-to-fullscreen").hide();


                            function saveAndNextCategory3() {

                                if (currentPassage < questionsData[currentQuestionIndex]
                                    .grouping_questions.length - 1) {
                                    currentPassage++;
                                } else {
                                    currentQuestionIndex++;
                                    currentPassage = 0;
                                }
                                if (currentQuestionIndex < questionsData.length) {
                                    showPassageAndQuestions(currentQuestionIndex);
                                } else {
                                    currentQuestionIndex = 0;
                                    currentPassage = 0;
                                }

                                localStorage.setItem('currentPassage', currentPassage);

                                localStorage.setItem("currentQuestionIndex" + localStorage.getItem(
                                    'section'), currentQuestionIndex);
                                localStorage.setItem("currentPassage" + localStorage.getItem('section'),
                                    currentPassage);

                            }
                        }

                        if (localStorage.getItem('get_id') == null) {

                            saveStudentTestEntry();

                        } else {

                            var get_id = localStorage.getItem('get_id');

                            $("#student_test_entry_id").val(get_id);

                        }
                    }


                });



                if (localStorage.getItem('question_category') == 2) {

                    $(".test-title").text("MCQ Examination");

                    $(".clear-response").on('click', function() {
                        $("input[type='radio']").prop('checked', false);
                    });


                    $("#layout-menu").toggleClass("toggled");

                    document.getElementsByClassName('fullscreen-btn')[0].addEventListener('click', function() {
                        toggleFullScreen();
                    });


                    function toggleFullScreen() {


                        const element = document.getElementById('content-to-fullscreen');

                        if (!document.fullscreenElement) {
                            element.requestFullscreen();
                        } else {
                            if (document.exitFullscreen) {
                                document.exitFullscreen();
                            }
                        }
                    }


                } else if (localStorage.getItem('question_category') == 1) {


                    document.getElementById('fullscreen-btn').addEventListener('click', function() {
                        toggleFullScreen();
                    });


                    function toggleFullScreen() {


                        const element = document.getElementById('programming_screen');

                        if (!document.fullscreenElement) {
                            element.requestFullscreen();
                        } else {
                            if (document.exitFullscreen) {
                                document.exitFullscreen();
                            }
                        }
                    }


                } else if (localStorage.getItem('question_category') == 3) {

                    document.getElementById('fullscreen-btn').addEventListener('click', function() {
                        toggleFullScreen();
                    });

                    function toggleFullScreen() {


                        const element = document.getElementById('all-test-screens');

                        if (!document.fullscreenElement) {
                            element.requestFullscreen();
                        } else {
                            if (document.exitFullscreen) {
                                document.exitFullscreen();
                            }
                        }
                    }


                }


                if (localStorage.getItem("currentQuestionIndex" + localStorage.getItem('section'))) {


                    currentQuestionIndex = parseInt(localStorage.getItem("currentQuestionIndex" + localStorage
                        .getItem('section')));


                }


                if (totalSeconds) {

                    startTimer(parseInt(totalSeconds));

                    total_duration = totalSeconds / 60;


                } else {


                    $.ajax({


                        url: "{{ route('get-total-duration') }}",
                        type: "GET",
                        data: {
                            test_code: '{{ base64_decode(request()->segment(3)) }}'
                        },
                        success: function(totalDurationInMinutes) {

                            total_duration = totalDurationInMinutes;

                            total_time = totalDurationInMinutes;

                            totalSeconds = totalDurationInMinutes * 60;

                            startTimer(totalSeconds);
                        }


                    });


                }


                function startTimer(initialSeconds) {


                    timer = setInterval(function() {

                        totalSeconds--;

                        var hours = Math.floor(totalSeconds / 3600);
                        var minutes = Math.floor((totalSeconds % 3600) / 60);
                        var seconds = totalSeconds % 60;

                        $(".hours").text(("0" + hours).slice(-2));
                        $(".minutes").text(("0" + minutes).slice(-2));
                        $(".seconds").text(("0" + seconds).slice(-2));

                        if (totalSeconds < 1) {

                            $(".submit-test").prop("disabled", false);

                            $(".submit-test").trigger('click');

                            $("form").submit();
                            clearInterval(timer);
                        } else {
                            localStorage.setItem("remainingSeconds", totalSeconds);
                        }


                    }, 1000);


                }



                $(".submit-test").on('click', function() {

                    var remaining_time = localStorage.getItem("remaiming_seconds");

                    var time_taken_by_user = total_duration - (remaining_time / 60);

                    $.ajax({

                        url: '{{ route('update-test-entry') }}',
                        type: 'POST',
                        data: {
                            time_taken: time_taken_by_user,
                            test_entry_id: localStorage.getItem('get_id')
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {}

                    });

                    localStorage.clear();

                    clearInterval(timer);

                    localStorage.removeItem("remainingSeconds");

                    totalSeconds = 00;

                    $(".hours").text("00");
                    $(".minutes").text("00");
                    $(".seconds").text("00");

                    window.location.href = "{{ route('student-dashboard') }}";

                })


                $(document).on("click", ".mark-for-review", function() {

                    var sp = $(this).children().attr("class");

                    var index = $(this).index();

                    let found = false;

                    currentQuestionIndex--;

                    var question_cat_set = fetch_questions[1][localStorage.getItem('section')][
                        index
                    ].category;

                    localStorage.setItem('question_category', question_cat_set);

                    localStorage.setItem("currentQuestionIndex" + localStorage.getItem('section'),
                        index);

                    showQuestion(index);


                });

            });


            function saveStudentTestEntry() {

                var ip_address;

                var ip_city;

                fetch("https://api.ipify.org?format=json")
                    .then((response) => response.json())
                    .then((data) => {
                        ip_address = data.ip;
                        fetch(`https://ipapi.co/${data.ip}/json/`)
                            .then((response) => response.json())
                            .then((locationData) => {
                                ip_city = locationData.city;
                            })
                            .catch((error) => {
                                console.error("Error fetching location details:", error);
                            });
                    })
                    .catch((error) => {
                        console.error("Error fetching IP address:", error);
                    });
                var userAgent = navigator.userAgent;

                var os;
                if (userAgent.match(/Windows/i)) {
                    os = "Windows";
                } else if (userAgent.match(/Mac OS/i)) {
                    os = "Mac OS";
                } else if (userAgent.match(/Android/i)) {
                    os = "Android";
                } else if (userAgent.match(/iOS/i)) {
                    os = "iOS";
                } else if (userAgent.match(/Linux/i)) {
                    os = "Linux";
                } else {
                    os = "Unknown";
                }

                var browser;
                if (userAgent.match(/Chrome/i)) {
                    browser = "Google Chrome";
                } else if (userAgent.match(/Firefox/i)) {
                    browser = "Mozilla Firefox";
                } else if (userAgent.match(/Safari/i)) {
                    browser = "Apple Safari";
                } else if (userAgent.match(/Edge/i)) {
                    browser = "Microsoft Edge";
                } else if (userAgent.match(/Opera/i) || userAgent.match(/OPR\//i)) {
                    browser = "Opera";
                } else if (userAgent.match(/MSIE/i) || userAgent.match(/Trident/i)) {
                    browser = "Internet Explorer";
                } else {
                    browser = "Unknown";
                }

                setTimeout(() => {
                    $.ajax({
                        url: "{{ route('save-student-test-entry') }}",
                        type: "POST",
                        data: {
                            user_id: "{{ session('userId') }}",
                            total_questions: questionsData.length,
                            total_duration: total_time,
                            course_id: {{ base64_decode(request()->segment(2)) }},
                            test_code: "{{ base64_decode(request()->segment(3)) }}",
                            os: os,
                            browser: browser,
                            useragent: userAgent,
                            ip_address: ip_address,
                            ip_city: ip_city,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {

                            localStorage.setItem('get_id', data);

                            var get_id = localStorage.getItem('get_id');

                            $("#student_test_entry_id").val(get_id);

                        }
                    });
                }, 1500);


            }


            function save_session(value) {

                var values = fetch_questions[1][value][0].category;

                localStorage.setItem('question_category', values);

                localStorage.setItem('section', value);

                location.reload();

            }
        </script>




    @endsection
