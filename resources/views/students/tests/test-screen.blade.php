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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/monaco-editor@0.23.0/min/vs/loader.js"></script>
    <style>
        * {
            --side-bar-width: 420px;
            --qz-green: #28b163;
            --qz-violet: #915ab8;
            --qz-red: #c13a24;
            /* user-select: none; */
        }

        #content-to-fullscreen {
            background-color: #fff;
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

        #side-bar .icon i {
            transition: all 0.2s ease-in-out;
        }

        .side-bar-hide #side-bar {
            transform: translateX(var(--side-bar-width));
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

        .card::-webkit-scrollbar {
            width: 6px;
            /* Adjust as needed */
        }

        .card::-webkit-scrollbar-thumb {
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
    </style>
    </head>

    <body>

        <div id="content-to-fullscreen">
            <!-- nav -->
            <nav class="navbar navbar-light bg-white">
                <div class="container">
                    <div class="nav-items-cont w-100 d-flex flex-column flex-md-row justify-content-between p-2">
                        <h6 class="m-0">MCQ Test</h6>
                        {{-- <div class="timer">
                            <b>Time Left</b>
                            <span id="hours" class="badge hours bg-secondary">00</span> :
                            <span id="minutes" class="badge minutes bg-secondary">00</span> :
                            <span id="seconds" class="badge seconds bg-secondary">00</span>
                        </div> --}}
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
                            <button type="button" class="btn fullscreen-btn btn-outline-info">
                                Switch Full Screen
                            </button>
                            {{-- <button type="button" class="btn btn-outline-info">Pause</button> --}}
                        </div>
                    </div>
                </div>

            </nav>
            <!-- end nav -->
            <!-- side bar -->
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
                            {{-- <li><span class="active">1</span></li>
                            <li><span class="not_answered">2</span></li>
                            <li><span class="answered">3</span></li>
                            <li><span class="active">4</span></li> --}}
                        </ul>
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
                        <button type="button" class="btn btn-theme mark-for-review-button">Mark for Review & Next</button>
                        <button type="button" class="btn btn-theme clear-response">Clear Response</button>
                        <button type="button" class="btn btn-info float-right save-next">Save & Next</button>
                    </div>
                </footer>
                <!-- end footer -->
            </main>
        </div>

        <div id="programming_screen" class="programming_screen">
            <nav class="navbar navbar-light bg-white">
                <div class="container">
                    <div class="nav-items-cont w-100 d-flex flex-column flex-md-row justify-content-between p-2">
                        <h6 class="m-0 test-title"> </h6>
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
                            <button type="button" id="pro-fullscreen-btn"
                                class="btn  pro-fullscreen-btn btn-outline-info">
                                Switch Full Screen
                            </button>
                            {{-- <button type="button" class="btn btn-outline-info">Pause</button> --}}
                        </div>
                    </div>
                </div>

            </nav>
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
                                        <button type="button" class="btn btn-theme mx-4 verify-button">Verify</button>
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
                        <div class="col-4" style="max-height: 80vh;">
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






                        <div class="col-3" style="max-height: 80vh;">
                            <div class="card" style="height: 100%; overflow-y: auto;">

                                <div class="card-body">
                                    <div class="row col-12 ">

                                        <div class="">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                        data-bs-target="#home" type="button" role="tab"
                                                        aria-controls="home" aria-selected="true">Sample Test
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
                                                                <h6 class="fw-bold d-inline-block">Total Test Case: </h6>
                                                                <span
                                                                    class="test-case-count fw-bold text-success d-inline-block">
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="card mt-2">
                                                            <div class="card-body">
                                                                <h6 class="fw-bold d-inline-block">Passed Test Case: </h6>
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
                        <button type="button" class="btn btn-theme mx-4 previous-button">&laquo;</button>
                        <button type="button" class="btn btn-theme mx-4 save-next next-button">&raquo;</button>

                        <button type="button" class="btn btn-info mx-4 submit-test float-end"> Submit</button>
                    </div>
                </footer>
            </div>

        </div>



        <div class="mcq-grouping" id="mcq_grouping">

            <nav class="navbar navbar-light bg-white">
                <div class="container">
                    <div class="nav-items-cont w-100 d-flex flex-column flex-md-row justify-content-between p-2">
                        <h6 class="m-0">GROUPING MCQ</h6>
                        {{-- <div class="timer">
                            <b>Time Left</b>
                            <span id="hours" class="badge hours bg-secondary">00</span> :
                            <span id="minutes" class="badge minutes bg-secondary">00</span> :
                            <span id="seconds" class="badge seconds bg-secondary">00</span>
                        </div> --}}
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
                            <button type="button" class="btn fullscreen-btn btn-outline-info">
                                Switch Full Screen
                            </button>
                            {{-- <button type="button" class="btn btn-outline-info">Pause</button> --}}
                        </div>
                    </div>
                </div>

            </nav>
            <div class="row mb-5">
                <div class="section-buttons "></div>

            </div>
            <div class="row col-12">
                <div class="col-6">
                    <div class="passage-col">
                    </div>
                </div>
                <div class="col-6">
                    <div class="question-col">
                    </div>

                    <div class="mt-5">
                        <button type="button"
                            class="btn background-secondary text-white float-end grouping-save-next">Save &
                            Next</button>
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

            var questionsData;
            var question_code_for_save;
            var fetch_questions;
            var currentQuestionIndex = 0;
            var total_duration;
            var totalSeconds = localStorage.getItem("remainingSeconds");
            var timer;
            var run_question_inputs = [];
            var run_question_outputs = [];
            var verify_question_inputs = [];
            var verify_question_outputs = [];
            var question_category_value = [];

            $(document).ready(function() {


                if (localStorage.getItem('theme') == null) {
                    localStorage.setItem('theme', 'vs-light')
                }

                $(".submit-test").prop("disabled", true);


                function showQuestion(index) {

                    if (localStorage.getItem("question_category") == 2) {


                        var question = questionsData[index].question_for_test;

                        var mcqOptions = questionsData[index].mcq_options;
                        $(".question_count").text("Question No. " + (index + 1));
                        $(".org-marks").html(questionsData[index].question_marks)
                        $(".question-p").html(question.replaceAll('<p><br></p>', ""));
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


                        var question = questionsData[localStorage.getItem("section")][index].question_for_test
                            .questions;

                        question_code_for_save = questionsData[localStorage.getItem("section")][index].question_for_test
                            .question_code;
                        var testcasediv = "";
                        var coun = 1;
                        $(questionsData[localStorage.getItem("section")][index].test_cases).map((i, e) => {

                            testcasediv += `
                                    <h6 class="fw-bold">SAMPLE TEST CASE: ${coun ++}</h6>
                                    <div class="ms-2">
                                    <label class="fw-bold text-primary text-decoration-underline">Input</label>
                                    <p >${e.input}</p>
                                    <label class="fw-bold text-info text-decoration-underline ">Output</label>
                                    <p>${e.output}</p>
                                </div>
                                `;
                            run_question_inputs.push(e.input)
                            run_question_outputs.push(e.output)
                            // }
                            // 
                            verify_question_inputs.push(e.input);
                            verify_question_outputs.push(e.output);
                        })

                        $(".test-case-div").append(testcasediv);

                        var input_format = questionsData[localStorage.getItem("section")][index].question_for_test
                            .input_format
                        var output_format = questionsData[localStorage.getItem("section")][index].question_for_test
                            .output_format
                        var code_constraints = questionsData[localStorage.getItem("section")][index].question_for_test
                            .code_constraints


                        $(".programming-questions").html(question)
                        $(".input-format").html(input_format)
                        $(".output-format").html(output_format)
                        $(".code-constraints").html(code_constraints)

                    }


                }

                function markForReview() {
                    var markedQuestions = JSON.parse(localStorage.getItem('markedQuestions')) || [];

                    if (!markedQuestions.includes(currentQuestionIndex)) {

                        markedQuestions.push(currentQuestionIndex);

                        localStorage.setItem('markedQuestions', JSON.stringify(markedQuestions));

                        $('.quiz_number li:eq(' + currentQuestionIndex + ')').addClass('mark-for-review');

                        currentQuestionIndex++;

                        showQuestion(currentQuestionIndex)
                        localStorage.setItem("currentQuestionIndex" + localStorage.getItem('section'),
                            currentQuestionIndex + 1);
                    } else {
                        alert('Question already marked for review.');
                        currentQuestionIndex++;

                        showQuestion(currentQuestionIndex)

                        localStorage.setItem("currentQuestionIndex" + localStorage.getItem('section'),
                            currentQuestionIndex + 1);
                    }
                }



                var isReloaded = false;


                function saveAndNext() {



                    if (localStorage.getItem("question_category") == 2) {


                        var selectedAnswer = $("input[name='option']:checked");


                        if (selectedAnswer.length < 1) {
                            alert("Select Any one of the Option..!");
                            return false;
                        }


                        var remaiming_time = localStorage.getItem("remainingSeconds");

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
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {}


                        })


                        $(".question" + currentQuestionIndex).removeClass('active');

                        currentQuestionIndex++;


                        $(".question" + currentQuestionIndex).addClass('active');

                        localStorage.setItem("currentQuestionIndex" + localStorage.getItem('section'),
                            currentQuestionIndex);

                        if (currentQuestionIndex < questionsData.length) {

                            showQuestion(currentQuestionIndex);


                        } else {


                        }



                    } else if (localStorage.getItem("question_category") == 1) {

                        currentQuestionIndex++;

                        localStorage.setItem("currentQuestionIndex" + localStorage.getItem('section'),
                            currentQuestionIndex);


                        if (currentQuestionIndex < questionsData[0].length) {

                            showQuestion(currentQuestionIndex);

                            isReloaded = true;

                            location.reload();

                        } else {




                        }

                    }



                }

                $(".theme-button").click(function() {

                    localStorage.setItem("theme", $(this).attr("data-value"));

                    location.reload();

                });


                function previous() {

                    currentQuestionIndex--;


                    localStorage.setItem("currentQuestionIndex" + localStorage.getItem('section'),
                        currentQuestionIndex);


                    if (currentQuestionIndex < questionsData[0].length) {

                        showQuestion(currentQuestionIndex);

                        location.reload();
                    }

                }

                $(".mark-for-review-button").click(function() {
                    markForReview();
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

                        if (localStorage.getItem("question_category") == null || localStorage.getItem(
                                "question_category") == "undefined") {

                            localStorage.setItem('question_category', data[2][0]);
                        }


                        $(".sec_name").text(data[0].sections[localStorage.getItem("section")]);


                        if (localStorage.getItem('question_category') == 1) {

                            question_category_value = data[2];

                            $(data[0].sections).each(function(i, e) {

                                $(".section-name-div").append(
                                    `<button type="button" value="${i}" onclick="save_session(this.value)"  class="btn btn-sm section-button btn-success ms-3  ">${e}</button>`
                                );

                            });


                            questionsData = data[1];

                            showQuestion(currentQuestionIndex);

                            $(".save-next").click(function() {

                                saveAndNext();

                            });


                            $(".previous-button").click(function() {
                                previous();
                            });



                            $(".test-title").html("<b>Programming Examination</b>");

                            $(".programming_screen").show();

                            $("#content-to-fullscreen").hide();



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

                            var codes;
                            var editor;


                            setTimeout(() => {


                                require.config({
                                    paths: {
                                        vs: "https://cdn.jsdelivr.net/npm/monaco-editor@0.23.0/min/vs",
                                    },
                                });
                                require(["vs/editor/editor.main"], function() {


                                    var languageSelector = document.getElementById(
                                        "languageSelect");

                                    var codeEditor = document.getElementById("code-editor");

                                    var initialLoad = true;

                                    editor = monaco.editor.create(
                                        codeEditor, {
                                            value: `/* Type Your Code */`,
                                            language: languageSelector.value,
                                            theme: localStorage.getItem('theme'),
                                        }
                                    );



                                    if (localStorage.getItem(
                                            "typed_coding")) {
                                        editor.setValue(localStorage
                                            .getItem(
                                                "typed_coding" + localStorage
                                                .getItem('section') +
                                                currentQuestionIndex))
                                    }

                                    editor.setValue(localStorage
                                        .getItem(
                                            `typed_coding_${localStorage.getItem('section')}_${currentQuestionIndex}`
                                        ));

                                    codes = editor.getValue();

                                    languageSelector.addEventListener("change", function() {
                                        var selectedLanguage = this.value;

                                        if (!initialLoad) {
                                            var currentCode = editor.getValue();
                                            codes = currentCode;
                                        }

                                        editor.getModel().dispose();

                                        editor.setModel(monaco.editor.createModel(
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
                                                editor.setValue(savedCode);
                                            }
                                        }, 100);
                                    });


                                    $(".slider").remove();
                                });


                            }, 500);


                            function findLanguageById(id) {
                                return Object.values(languages).find(lang => lang.id === id);
                            }


                            $("#code-editor").on("keyup", function() {
                                setTimeout(() => {
                                    localStorage.setItem(
                                        `typed_coding_${localStorage.getItem('section')}_${currentQuestionIndex}`,
                                        editor.getValue());

                                }, 100);
                            });


                            $(".programming_run_button").click(function() {


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
                                        $("#sample_correct_testcase").empty();

                                        if (data[0].stderr != null) {
                                            var formattedStderr = data[0].stderr
                                                .replace(/\n/g, '<br>');

                                            $("#sample_correct_testcase").html(
                                                formattedStderr).addClass(
                                                "text-danger fw-bold");


                                            $("#home-tab").addClass("active");

                                            $("#home ").addClass("active show");

                                            $("#profile-tab").removeClass("active");

                                            $("#profile").removeClass("active show");

                                            return false;
                                        } else {

                                            $("#sample_correct_testcase").removeClass(
                                                "text-danger fw-bold");

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

                                                    test_case_correct = `
                                                <div class="accordion accordion-flush" id="sampleCrctExample${i}">
                                                            <div class="accordion-item rounded-3 border-0 shadow mb-2">
                                                                <h2 class="accordion-header">
                                                                    <button
                                                                        class="accordion-button text-success border-bottom collapsed fw-semibold"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#flush-collapseOne-${i}" aria-expanded="false"
                                                                        aria-controls="flush-collapseOne-${i}">
                                                                        Test Case Sample : ${i + 1}
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

                                                } else {

                                                    test_case_correct = `
                                                <div class="accordion accordion-flush" id="sampleCrctExample${i}">
                                                            <div class="accordion-item rounded-3 border-0 shadow mb-2">
                                                                <h2 class="accordion-header">
                                                                    <button
                                                                        class="accordion-button text-danger border-bottom collapsed fw-semibold"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#flush-collapseOne-${i}" aria-expanded="false"
                                                                        aria-controls="flush-collapseOne-${i}">
                                                                        Test Case Sample : ${i + 1}
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





                                        }




                                    },
                                    error: function(data) {
                                        alert('Something went wrong');
                                    }
                                })
                            });



                            $(".verify-button").click(function() {


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



                        } else if (localStorage.getItem('question_category') == 2) {

                            $(data[0].sections).each(function(i, e) {

                                $("#section-buttons").before(
                                    `<button type="button" value="${i}" onclick="save_session(this.value)"  class="btn btn-sm section-button btn-success ms-3  ">${e}</button>`
                                );

                            });



                            $("#content-to-fullscreen").show();

                            var marked_questions = localStorage.getItem('markedQuestions');
                            marked_questions = marked_questions ? JSON.parse(marked_questions) : [];

                            questionsData = data[1][localStorage.getItem("section")];
                            var len_question = questionsData;
                            var html = "";

                            for (var i = 1; i <= len_question.length; i++) {
                                var isMarked = marked_questions.includes(i - 1);
                                html +=
                                    `<li class="span-ques ${isMarked ? 'mark-for-review' : ''}" style="cursor:pointer"><span class="question${i-1}">${i}</span></li>`;
                            }

                            $('.quiz_number').append(html);

                            showQuestion(currentQuestionIndex);

                            $(".save-next").click(function() {
                                saveAndNext();
                            });



                        } else if (localStorage.getItem('question_category') == 3) {
                            var currentPassage = 0;

                            $(data[0].sections).each(function(i, e) {
                                $(".section-buttons").before(
                                    `<button type="button" value="${i}" onclick="save_session(this.value)"  class="btn btn-sm section-button btn-success ms-3  ">${e}</button>`
                                );
                            });

                            questionsData = data[1];

                            var questionCategories = data[2];

                            showPassageAndQuestions(currentQuestionIndex);

                            $(".grouping-save-next").click(function() {

                                saveAndNextCategory3();
                            });

                            $(".test-title").html("<b>Category 3: Passage Reading MCQ</b>");
                            $(".category3-screen").show();
                            $("#content-to-fullscreen").hide();

                            function showPassageAndQuestions(index) {
                                if (questionsData[0] && questionsData[
                                        0][index] && questionsData[0][
                                        index
                                    ]
                                    .question_for_test) {
                                    $(".passage-col").html(
                                        `<p>${questionsData[0][index].question_for_test.title}</p>`
                                    );

                                    if (questionsData[0][index].grouping_questions &&
                                        questionsData[0][
                                            index
                                        ].grouping_questions.length > 0) {
                                        $(".question-col").html(
                                            `<p>${questionsData[0][index].grouping_questions[currentPassage].questions}</p>`
                                        );

                                        var mcqOptions = questionsData[0][currentQuestionIndex]
                                            .mcq_options;



                                        mcqOptions[currentPassage].forEach(function(
                                            opt) {
                                            console.log(opt);
                                            $(".question-col").append(`
                    <div>
                        <label class="form-check-label">
                            <input type="radio" name="mcqOption" data-question="${opt.question_code}" data-groupid="${questionsData[0][index].grouping_questions[currentPassage].id}" value="${opt.id}">
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

                            function saveAndNextCategory3() {

                                if (currentPassage < questionsData[0][currentQuestionIndex]
                                    .grouping_questions.length - 1) {
                                    currentPassage++;
                                } else {
                                    currentQuestionIndex++;
                                    currentPassage = 0;
                                }
                                if (currentQuestionIndex < questionsData[0].length) {
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

                    if (localStorage.getItem('section') === null) {
                        localStorage.setItem('section', 0)
                    }


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


                    document.getElementById('pro-fullscreen-btn').addEventListener('click', function() {
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


                    document.getElementById('pro-fullscreen-btn').addEventListener('click', function() {
                        toggleFullScreen();
                    });


                    function toggleFullScreen() {


                        const element = document.getElementById('mcq_grouping');

                        if (!document.fullscreenElement) {
                            element.requestFullscreen();
                        } else {
                            if (document.exitFullscreen) {
                                document.exitFullscreen();
                            }
                        }
                    }


                }


                if (localStorage.getItem("currentQuestionIndex" + localStorage.getItem(
                        'section'))) {


                    currentQuestionIndex = parseInt(localStorage.getItem("currentQuestionIndex" + localStorage
                        .getItem(
                            'section')));


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

                    localStorage.clear();

                    clearInterval(timer);

                    localStorage.removeItem("remainingSeconds");

                    totalSeconds = 00;

                    $(".hours").text("00");
                    $(".minutes").text("00");
                    $(".seconds").text("00");

                    window.location.href = "{{ route('student-dashboard') }}";

                })

                setTimeout(() => {

                    $(".mark-for-review").on('click', function() {
                        alert();

                        var sp = $(this).children().attr("class");

                        var index = $(this).index();

                        showQuestion(index);

                    });
                }, 1000);


            });


            function saveStudentTestEntry() {

                $.ajax({
                    url: "{{ route('save-student-test-entry') }}",
                    type: "POST",
                    data: {
                        user_id: "{{ session('userId') }}",
                        total_questions: questionsData.length,
                        total_duration: total_duration,
                        course_id: {{ base64_decode(request()->segment(2)) }},
                        test_code: "{{ base64_decode(request()->segment(3)) }}"
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


            }



            function save_session(value) {

                var values = fetch_questions[2][value];

                localStorage.setItem('question_category', values);

                localStorage.setItem('section', value);

                location.reload();




            }
        </script>




    @endsection
