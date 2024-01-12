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
        .fs-20 {
            font-size: 20px;
        }


        .fs-30 {
            font-size: 35px;
        }

        .radius-none {
            border-radius: 0%;
        }

        .center {
            width: 180px;
            border-radius: 50%;
            border: 8px solid #F44;
            display: flex;
            align-items: center;
            text-align: center;
            background-color: #FFFBF6;
        }

        .text-sec-color {
            font-weight: 1000;
        }

        .background-light {
            background-color: #e1e7eb;
        }

        span.badge {
            width: 120px;
            text-align: center;
            border-radius: 0%;
        }


        .question-container {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }

        .option-container {
            display: flex;
            align-items: center;
            margin: 5px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 75%;

        }

        .card-body {
            margin: 5px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .correct-answer {
            background-color: #d4edda;
            color: #155724;
        }

        .selected-answer {
            background-color: #f8d7da;
            color: #721c24;
        }

        .normal-answer {
            background-color: #fff;
            color: #000;
        }

        .option-radio {
            margin-right: 10px;
        }

        .tick {
            color: #155724;
            margin-left: auto;
        }

        .cross {
            color: #721c24;
            margin-left: auto;
        }

        .tick::before {
            content: '\2713';
            color: #155724;
            margin-right: 5px;
        }

        .cross::before {
            content: '\2717';
            color: #721c24;
            margin-right: 5px;
        }

        #resultDiv {
            display: none;
        }
    </style>


    <div class="container ms-5 mt-2">

        <div class="row col-12 mb-4">
            <h6 class="fw-bold text-sec-color">SELECT SECTION :</h6>
            <div class="col-4 mb-4">
                <select name="" onchange="fetch_questions_answers(this.value)" class="form-control"
                    id="question_section">
                </select>
            </div>
        </div>

        <div class="col-12 ">



            <div class="row">
                <div class="col-md-2">
                    <div style="border-radius: 15px 15px 0 0; " class="card  h-100 ">
                        <div style="border-radius: 15px 15px 0 0; " class="background-light">
                            <div class="fw-bold pt-2 mt-2 mb-2 fs-20 text-center ">
                                Total <br> Questions
                            </div>
                        </div>
                        <div class="card radius-none background-secondary">
                            <div class=" mt-3 mb-3 text-center fw-bold fs-30 text-white">
                                {{ $data['total_questions'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div style="border-radius: 15px 15px 0 0; " class="card  h-100 ">
                        <div style="border-radius: 15px 15px 0 0; " class="background-light">
                            <div class="fw-bold pt-2 mt-2 mb-2 fs-20 text-center ">
                                No. of <br> Attempted
                            </div>
                        </div>
                        <div class="card radius-none background-secondary">
                            <div class=" mt-3 mb-3 text-center fw-bold fs-30 text-white">
                                {{ count($test_question_details) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div style="border-radius: 15px 15px 0 0; " class="card  h-100 ">
                        <div style="border-radius: 15px 15px 0 0; " class="background-light">
                            <div class="fw-bold pt-2 mt-2 mb-2 fs-20 text-center ">
                                No. of <br> Unattempted
                            </div>
                        </div>
                        <div class="card radius-none background-secondary">
                            <div class=" mt-3 mb-3 text-center fw-bold fs-30 text-white">
                                {{ $test_details->total_questions - count($test_question_details) > 0 ? $test_details->total_questions - count($test_question_details) : '-' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div style="border-radius: 15px 15px 0 0; " class="card  h-100 ">
                        <div style="border-radius: 15px 15px 0 0; " class="background-light">
                            <div class="fw-bold pt-2 mt-2 mb-2 fs-20 text-center ">
                                Total <br> Marks
                            </div>
                        </div>
                        <div class="card radius-none background-secondary">
                            <div class=" mt-3 mb-3 text-center fw-bold fs-30 text-white">

                                {{ $data['total_question_marks'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div style="border-radius: 15px 15px 0 0; " class="card  h-100 ">
                        <div style="border-radius: 15px 15px 0 0; " class="background-light">
                            <div class="fw-bold pt-2 mt-2 mb-2 fs-20 text-center ">
                                Marks <br> Taken
                            </div>
                        </div>
                        <div class="card radius-none background-secondary">
                            <div class=" mt-3 mb-3 text-center fw-bold fs-30 text-white">
                                {{ $data['total_marks'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="center h-100 p-3 bg-light d-flex flex-column justify-content-center">
                        <div class="mx-auto text-center">
                            <label for="" style="font-size:18px" class="mb-0 fw-bold  text-danger">Score</label>
                            <br>
                            <span
                                class=" fs-30 text-sec-color">{{ round(($data['total_marks'] / $data['total_question_marks']) * 100, 2) }}
                                %</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <br><br>
    <div class="container mt-4">
        <h5 class="fw-bold mt-5 ms-4">DETAILED REPORT:</h5>
        <div class="card">
            <div id="resultDiv"></div>
        </div>
    </div>

    <script>
        var test_student_question_details = @json($test_question_details);
        var question_details = @json($data['question_details']);
        var mcqOptions = @json($data['mcq_options']);
        var programmingTestCase = @json($data['programming_test_case']);

        var programmingQuestions = question_details.filter(function(question) {
            return question.category == 1;
        });

        var mcqQuestions = question_details.filter(function(question) {
            return question.category == 2;
        });

        var categories = [];

        $(function() {
            $.ajax({
                url: '{{ route('ajax-get-sections') }}',
                type: 'GET',
                data: {
                    test_code: '{{ base64_decode(request()->segment(4)) }}',
                },
                success: function(data) {
                    var html = '<option value="" selected disabled>SELECT</option>';
                    for (var i = 0; i < data.length; i++) {
                        categories.push({
                            cat: data[i].category,
                            opt_id: data[i].id
                        });

                        var capitalizedSectionName = data[i].section_name.charAt(0).toUpperCase() +
                            data[i].section_name.slice(1).toLowerCase();
                        html += '<option value="' + data[i].id + '">' + capitalizedSectionName +
                            '</option>';
                    }
                    $('#question_section').html(html);
                }
            });
        });


        var resultDiv = document.getElementById('resultDiv');


        function fetch_questions_answers(value) {

            if (categories.some(category => category.opt_id == value)) {

                var matchingCategory = categories.find(category => category.opt_id == value);



                if (matchingCategory.cat == 1) {

                    programmingQuestions.forEach(function(programmingQuestion, index) {
                        var questionDiv = document.createElement('div');
                        questionDiv.classList.add('question-container', 'mb-4');

                        var questionText = document.createElement('p');
                        questionText.innerHTML = `Question ${index + 1}: ` + programmingQuestion.questions;

                        var questionDetails = test_student_question_details.find(function(detail) {
                            return detail.question_code === programmingQuestion.question_code;
                        });

                        questionDiv.appendChild(questionText);

                        highlightOptions(mcqOptions[index], questionDetails, questionDiv);

                        resultDiv.appendChild(questionDiv);

                        resultDiv.innerHTML = resultDiv.innerHTML.replace(/<p><br><\/p>/g, '');
                    });



                } else if (matchingCategory.cat == 2) {


                    mcqQuestions.forEach(function(mcqQuestion, index) {
                        var questionDiv = document.createElement('div');
                        questionDiv.classList.add('question-container', 'mb-4');

                        var questionText = document.createElement('p');
                        questionText.innerHTML = `Question ${index + 1}: ` + mcqQuestion.questions;

                        var questionDetails = test_student_question_details.find(function(detail) {
                            return detail.question_code === mcqQuestion.question_code;
                        });

                        questionDiv.appendChild(questionText);

                        highlightOptions(mcqOptions[index], questionDetails, questionDiv);

                        resultDiv.appendChild(questionDiv);

                        resultDiv.innerHTML = resultDiv.innerHTML.replace(/<p><br><\/p>/g, '');
                    });

                }

                $("#resultDiv").show();

            }



            function highlightOptions(options, questionDetails, containerDiv) {
                options.forEach(function(option, index) {
                    var optionContainer = document.createElement('div');
                    optionContainer.classList.add('option-container');

                    var radioInput = document.createElement('input');
                    radioInput.type = 'radio';
                    radioInput.name = 'question_' + questionDetails.question_code;
                    radioInput.value = option.id;
                    radioInput.classList.add('option-radio');
                    radioInput.disabled = true;

                    var optionElement = document.createElement('label');
                    optionElement.classList.add('card-body');

                    if (option.id == questionDetails.correct_answer && option.id == questionDetails
                        .answer_selected) {
                        optionElement.classList.add('correct-answer');
                        addTickOrCross(optionElement, true);
                    } else if (option.id == questionDetails.correct_answer) {
                        optionElement.classList.add('correct-answer');
                        addTickOrCross(optionElement, true);
                    } else if (option.id == questionDetails.answer_selected) {
                        optionElement.classList.add('selected-answer');
                        addTickOrCross(optionElement, false);
                    } else {
                        optionElement.classList.add('normal-answer');
                    }

                    optionElement.innerHTML = option.option_answer;
                    optionElement.innerHTML = optionElement.innerHTML.replaceAll('<p><br></p>', '');

                    optionContainer.appendChild(radioInput);
                    optionContainer.appendChild(optionElement);
                    containerDiv.appendChild(optionContainer);
                });
            }

            function addTickOrCross(optionElement, isCorrect) {
                var iconElement = document.createElement('span');
                iconElement.classList.add(isCorrect ? 'tick' : 'cross');
                iconElement.innerHTML = isCorrect ? '&#10003;' : 'X';
                optionElement.appendChild(iconElement);
            }




        }
    </script>


@endsection
