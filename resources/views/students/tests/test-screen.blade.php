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
                float: unset !important;
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
    </style>
    </head>

    <body>
        <div id="content-to-fullscreen">
            <!-- nav -->
            <nav class="navbar navbar-light bg-white">
                <div class="container">
                    <div class="nav-items-cont w-100 d-flex flex-column flex-md-row justify-content-between p-2">
                        <h6 class="m-0">MCQ Test</h6>
                        <div class="timer">
                            <b>Time Left</b>
                            <span id="hours" class="badge bg-secondary">00</span> :
                            <span id="minutes" class="badge bg-secondary">00</span> :
                            <span id="seconds" class="badge bg-secondary">00</span>
                        </div>
                        <div class="mt-2 mt-md-0">
                            <button type="button" class="btn fullscreen-btn btn-outline-info">
                                Switch Full Screen
                            </button>
                            <button type="button" class="btn btn-outline-info">Pause</button>
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
                    <div class="footer-btn">
                        {{-- <button type="button" class="btn btn-theme">Mark for Review & Next</button> --}}
                        <button type="button" class="btn btn-theme clear-response">Clear Response</button>
                        <button type="button" class="btn btn-info float-right save-next">Save & Next</button>
                    </div>
                </footer>
                <!-- end footer -->
            </main>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
        </script>

        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
        <script>
            $(function() {
                $("#side-bar .icon").click(function() {
                    $("body").toggleClass("side-bar-hide");
                });
            });

            var questionsData;
            var currentQuestionIndex = 0;
            var total_duration;
            var totalSeconds = localStorage.getItem("remainingSeconds");
            var timer;

            $(document).ready(function() {

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

                if (localStorage.getItem("currentQuestionIndex" + localStorage.getItem(
                        'section'))) {
                    currentQuestionIndex = parseInt(localStorage.getItem("currentQuestionIndex" + localStorage.getItem(
                        'section')));
                    setTimeout(() => {
                        $(".question" + localStorage.getItem("currentQuestionIndex" + localStorage.getItem(
                            'section'))).addClass('active');
                    }, 200);
                }

                function showQuestion(index) {
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
                }

                function saveAndNext() {

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
                    } else {}
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

                        $("#hours").text(("0" + hours).slice(-2));
                        $("#minutes").text(("0" + minutes).slice(-2));
                        $("#seconds").text(("0" + seconds).slice(-2));

                        if (totalSeconds < 1) {
                            clearInterval(timer);
                            $("form").submit();
                        } else {
                            localStorage.setItem("remainingSeconds", totalSeconds);
                        }
                    }, 1000);
                }



                $.ajax({
                    url: "{{ route('fetch-test-questions') }}",
                    type: "GET",
                    data: {
                        test_code: "{{ base64_decode(request()->segment(3)) }}",
                        course_id: {{ base64_decode(request()->segment(2)) }},
                    },
                    success: function(data) {
                        $(".sec_name").text(data[0].sections[localStorage.getItem("section")]);
                        $(data[0].sections).each(function(i, e) {
                            $(".header-bar").append(
                                `<button type="button" value="${i}" onclick="save_session(this.value)" class="btn section-button btn-success ms-3 py-1 px-5">${e}</button>`
                            );
                        })
                        questionsData = data[1][localStorage.getItem("section")];
                        var len_question = questionsData;
                        var html = "";
                        for (var i = 1; i <= len_question.length; i++) {
                            html += `<li><span class="question${i-1}">${i}</span></li>`;
                        }

                        $('.quiz_number').append(html);


                        showQuestion(currentQuestionIndex);
                        $(".save-next").click(function() {
                            saveAndNext();
                        });

                        if (localStorage.getItem('get_id') == null) {
                            saveStudentTestEntry();
                        } else {
                            var get_id = localStorage.getItem('get_id');
                            $("#student_test_entry_id").val(get_id);
                        }
                    }


                });




                $(".submit-test").on('click', function() {

                    var userResponse = window.prompt("Type Your Register No Submit the Test");
                    if (userResponse !== null) {
                        var lowerCaseResponse = userResponse;
                        if (lowerCaseResponse == "{{ session('userId') }}") {
                            localStorage.clear();
                            clearInterval(timer);
                            localStorage.removeItem("remainingSeconds");
                            totalSeconds = 00;
                            $("#hours").text("00");
                            $("#minutes").text("00");
                            $("#seconds").text("00");
                            window.location.href = "{{ route('student-dashboard') }}";
                        }
                    }


                })

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
                localStorage.setItem('section', value);
                location.reload();
            }
        </script>




    @endsection
