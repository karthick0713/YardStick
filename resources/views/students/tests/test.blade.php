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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" />
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>


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
            border-radius: 5px;
            cursor: pointer;
            width: 75%;

        }

        label>p {
            padding-top: 18px !important;
        }

        .card-body {
            margin: 5px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .correct-answer {
            background-color: #155724;
            color: #fff;
        }

        .selected-answer {
            background-color: #bb2533;
            color: #fff;
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

        .background {
            background-color: #e1e7eb !important;
        }

        /* label.card-body {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                line-height: 0.1cm !important;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } */

        .custom-align-center {
            display: flex;
            align-items: center !important;
        }


        /* Primary Button with Outline */
        .btn-outline-primary {
            color: #e4ecf5;
            background-color: transparent;
            background-image: none;
            border-color: #e1e7eb;
        }

        .btn-outline-primary:hover {
            color: #fff;
            background-color: #e1e7eb;
            border-color: #e1e7eb;
        }

        .btn-outline-primary:focus,
        .btn-outline-primary.focus {
            box-shadow: 0 0 0 0.2rem rgba(150, 186, 224, 0.5);
        }

        .btn-outline-primary.disabled,
        .btn-outline-primary:disabled {
            color: #e1e7eb;
            background-color: transparent;
            border-color: #e1e7eb;
        }

        .btn-outline-primary:not(:disabled):not(.disabled):active,
        .btn-outline-primary:not(:disabled):not(.disabled).active,
        .show>.btn-outline-primary.dropdown-toggle {
            color: #fff;
            background-color: #e1e7eb;
            border-color: #e1e7eb;
        }

        .btn-outline-primary:not(:disabled):not(.disabled):active:focus,
        .btn-outline-primary:not(:disabled):not(.disabled).active:focus,
        .show>.btn-outline-primary.dropdown-toggle:focus {
            box-shadow: 0 0 0 0.2rem #ee7676;
        }

        .test-case-button {
            background-color: #e9ebec !important;
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
                                {{ $data['total_questions'] - count($test_question_details) > 0 ? $data['total_questions'] - count($test_question_details) : '-' }}
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

    <div class="container mt-4">
        <h5 class="report-title fw-bold mt-5 ms-4">DETAILED REPORT:</h5>
        <div id="resultDiv"></div>
    </div>

    <script>
        // var test_student_question_details = @json($test_question_details);
        // var question_details = @json($data['question_details']);
        // var mcqOptions = @json($data['mcq_options']);
        // var programmingTestCase = @json($data['programming_test_case']);


        // var programmingQuestions = question_details.filter(function(question) {
        //     return question.category == 1;
        // });

        // var mcqQuestions = question_details.filter(function(question) {
        //     return question.category == 2;
        // });

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
            var test_student_question_details = @json($test_question_details);
            var question_details = @json($data['question_details']);
            var mcqOptions = @json($data['mcq_options']);
            var programmingTestCase = @json($data['programming_test_case']);
            var sectionQuestions = question_details.filter(function(question) {
                return question.section_id == value;
            });

            $("#resultDiv").empty();

            console.log(question_details)

            $.each(sectionQuestions, function(index, question) {
                var cardContainer = $('<div>').addClass('card mb-4');
                var cardBody = $('<div>').addClass('card-body');

                var accordionContainer = $('<div>').addClass('accordion');
                var accordionItem = $('<div>').addClass('accordion-item');
                var accordionHeader = $('<h2>').addClass('accordion-header').attr('id', 'question-' +
                    index + '-header');

                var questionButton = $('<button>').addClass(
                        'accordion-button btn btn-outline-primary fw-bold')
                    .attr({
                        'type': 'button',
                        'data-bs-toggle': 'collapse',
                        'data-bs-target': '#question-' + index + '-content',
                        'aria-expanded': 'false',
                        'aria-controls': 'question-' + index + '-content'
                    })
                    .html(`Question ${index + 1}`);

                accordionHeader.append(questionButton);

                var accordionBody = $('<div>').addClass('accordion-collapse collapse')
                    .attr({
                        'id': 'question-' + index + '-content',
                        'aria-labelledby': 'question-' + index + '-header'
                    });

                var questionDiv = $('<div>').addClass('accordion-body ');
                var questionText = $('<p>').addClass('mb-0 fs-5').html(question.questions);
                questionDiv.append(questionText);

                var questionDetails = test_student_question_details.find(function(detail) {
                    return detail.question_code === question.question_code;
                });

                if (question.category == 1) {

                    var cardContainer = $('<div>').addClass('card mb-4');
                    var cardBody = $('<div>').addClass('card-body');

                    var accordionContainer = $('<div>').addClass('accordion container');
                    var accordionItem = $('<div>').addClass('accordion-item row');

                    var accordionHeader = $('<h2>').addClass('accordion-header ').attr('id', 'question-' +
                        index + '-header');
                    var questionButton = $('<button>').addClass(
                            'accordion-button w-100  btn btn-outline-primary fw-bold')
                        .attr({
                            'type': 'button',
                            'data-bs-toggle': 'collapse',
                            'data-bs-target': '#question-' + index + '-content',
                            'aria-expanded': 'false',
                            'aria-controls': 'question-' + index + '-content',
                            'data-bs-parent': '#accordion-parent'
                        });

                    questionButton.html(`Question ${index + 1}`);
                    accordionHeader.append(questionButton);

                    var accordionBody = $('<div>').addClass('accordion-collapse collapse col-12')
                        .attr({
                            'id': 'question-' + index + '-content',
                            'aria-labelledby': 'question-' + index + '-header'
                        });
                    var questionDiv = $('<div>').addClass('accordion-body col-12');
                    var newContainer = $('<div>').addClass('row');

                    var additionalInfoDiv = $('<div>').addClass('row col-12 mt-3');
                    var inputFormatDiv = $('<div>').addClass('col-4');
                    var inputFormatTitle = $('<h5>').addClass('fw-bold').html('Input Format:');
                    var inputFormatPre = $('<p>').html(programmingQuestion.input_format.replaceAll('\n',
                        '<br/>'));
                    inputFormatDiv.append(inputFormatTitle, inputFormatPre);

                    var outputFormatDiv = $('<div>').addClass('col-4');
                    var outputFormatTitle = $('<h5>').addClass('fw-bold').html('Output Format:');
                    var outputFormatPre = $('<p>').html(programmingQuestion.output_format.replaceAll('\n',
                        '<br/>'));
                    outputFormatDiv.append(outputFormatTitle, outputFormatPre);

                    var codeConstraintsDiv = $('<div>').addClass('col-4');
                    var codeConstraintsTitle = $('<h5>').addClass('fw-bold').html('Code Constraints:');
                    var codeConstraintsPre = $('<p>').html(programmingQuestion.code_constraints.replaceAll('\n',
                        '<br/>'));
                    codeConstraintsDiv.append(codeConstraintsTitle, codeConstraintsPre);

                    additionalInfoDiv.append(inputFormatDiv, outputFormatDiv, codeConstraintsDiv);

                    var questionSolutionDiv = $('<div>').addClass('col-6');
                    var solutionTitleDiv = $('<div>');
                    var solutionTitle = $('<h5>').addClass('fw-bold text-sec-color').html('SOLUTION :');
                    var questionSolutionPre = $('<pre>').addClass('language-cpp').text(programmingQuestion
                        .solutions);
                    questionSolutionDiv.append(solutionTitleDiv, solutionTitle,
                        questionSolutionPre);

                    var studentCodeDiv = $('<div>').addClass('col-6');
                    var studentCodeTitleDiv = $('<div>');
                    var studentCodeTitle = $('<h5>').addClass('fw-bold').html('YOUR CODE :');
                    var studentCodePre = $('<pre>').addClass('language-cpp');
                    var studentTestSolution = test_student_question_details.find(function(detail) {
                        return detail.question_code === programmingQuestion.question_code;
                    });
                    studentCodePre.text(studentTestSolution.student_code);
                    studentCodeDiv.append(studentCodeTitleDiv, studentCodeTitle, studentCodePre);

                    newContainer.append(additionalInfoDiv, questionSolutionDiv, studentCodeDiv);

                    var questionTitleDiv = $('<div>');
                    var questionTitle = $('<h5>').addClass('fw-bold').html('Question ' + (index + 1));

                    var questionTextDiv = $('<div>');
                    var questionText = $('<p>').html(programmingQuestion.questions);
                    questionTextDiv.append(questionText);

                    questionDiv.append(questionTitleDiv, questionTextDiv, newContainer);

                    accordionBody.append(questionDiv);

                    var testCasesAccordionContainer = $('<div>').addClass(
                        'accordion test-cases-accordion mt-3');
                    var testCasesAccordionItem = $('<div>').addClass('accordion-item row');

                    var testCasesAccordionHeader = $('<h2>').addClass('accordion-header').attr('id',
                        'test-cases-' + index + '-header');
                    var testCasesButton = $('<button>').addClass(
                            'accordion-button test-case-button w-100 btn btn-outline-primary fw-bold')
                        .attr({
                            'type': 'button',
                            'data-bs-toggle': 'collapse',
                            'data-bs-target': '#test-cases-' + index + '-content',
                            'aria-expanded': 'false',
                            'aria-controls': 'test-cases-' + index + '-content'
                        })
                        .text('Test Cases');

                    testCasesAccordionHeader.append(testCasesButton);

                    var testCasesAccordionBody = $('<div>').addClass('accordion-collapse collapse col-12')
                        .attr({
                            'id': 'test-cases-' + index + '-content',
                            'aria-labelledby': 'test-cases-' + index + '-header'
                        });

                    var testCasesRow = $('<div>').addClass('row');

                    $.each(programmingTestCase[index], function(testCaseIndex, testCase) {
                        var testCaseDiv = $('<div>').addClass(
                            'col-3 accordion-body rounded-2 text-center text-white  ms-5 mt-3');

                        var executedOutputDiv = $('<div>');
                        var executedOutputTitle = $('<h5>').addClass(
                                'fw-bold text-white mt-4  text-decoration-underline')
                            .html(
                                'Executed Output :');
                        var executedOutputPre = $('<pre>').text(testCase.executed_output);
                        executedOutputDiv.append(executedOutputTitle, executedOutputPre);

                        var expectedOutputDiv = $('<div>');
                        var expectedOutputTitle = $('<h5>').addClass(
                            'fw-bold text-white text-decoration-underline').html(
                            'Expected Output :');
                        var expectedOutputPre = $('<pre>').text(testCase.expected_output);
                        expectedOutputDiv.append(expectedOutputTitle, expectedOutputPre);

                        var executedOutputTrimmed = testCase.executed_output.trim().replaceAll(
                            /[\r\n]/g,
                            '');
                        var expectedOutputTrimmed = testCase.expected_output.trim().replaceAll(
                            /[\r\n]/g,
                            '');

                        var match = executedOutputTrimmed === expectedOutputTrimmed;
                        testCaseDiv.css('background-color', match ? '#3c7a3c' : '#cf3131');

                        testCaseDiv.append(executedOutputDiv, expectedOutputDiv);
                        testCasesRow.append(testCaseDiv);
                    });

                    testCasesAccordionBody.append(testCasesRow);
                    testCasesAccordionItem.append(testCasesAccordionHeader, testCasesAccordionBody);
                    testCasesAccordionContainer.append(testCasesAccordionItem);

                    accordionBody.append(testCasesAccordionContainer);
                    accordionItem.append(accordionHeader, accordionBody);
                    accordionContainer.append(accordionItem);

                    cardBody.append(accordionContainer);
                    cardContainer.append(cardBody);
                    $('#resultDiv').append(cardContainer);

                    resultDiv.innerHTML = resultDiv.innerHTML.replace(/<p><br><\/p>/g, '');

                    Prism.highlightAll();

                } else if (question.category == 2) {
                    var cardContainer = $('<div>').addClass('card mb-4');
                    var cardBody = $('<div>').addClass('card-body');

                    var accordionContainer = $('<div>').addClass('accordion');
                    var accordionItem = $('<div>').addClass('accordion-item');
                    var accordionHeader = $('<h2>').addClass('accordion-header').attr('id', 'question-' +
                        index + '-header');

                    var questionButton = $('<button>').addClass(
                            'accordion-button btn btn-outline-primary fw-bold')
                        .attr({
                            'type': 'button',
                            'data-bs-toggle': 'collapse',
                            'data-bs-target': '#question-' + index + '-content',
                            'aria-expanded': 'false',
                            'aria-controls': 'question-' + index + '-content'
                        })
                        .html(`Question ${index + 1}`);

                    accordionHeader.append(questionButton);

                    var accordionBody = $('<div>').addClass('accordion-collapse collapse')
                        .attr({
                            'id': 'question-' + index + '-content',
                            'aria-labelledby': 'question-' + index + '-header'
                        });

                    var questionDiv = $('<div>').addClass('accordion-body ');
                    var questionText = $('<p>').addClass('mb-0 fs-5').html(mcqQuestion.questions);
                    questionDiv.append(questionText);

                    var questionDetails = test_student_question_details.find(function(detail) {

                        return detail.question_code === mcqQuestion.question_code;
                    });

                    var optionsContainer = $('<div>').addClass(
                        'options-container');
                    highlightOptions(mcqOptions[index], questionDetails, optionsContainer);

                    questionDiv.append(optionsContainer);

                }

                accordionBody.append(questionDiv);
                accordionItem.append(accordionHeader, accordionBody);
                accordionContainer.append(accordionItem);
                cardBody.append(accordionContainer);
                cardContainer.append(cardBody);
                $('#resultDiv').append(cardContainer);
            });

            $('.accordion').each(function() {
                new bootstrap.Collapse($(this).find('.accordion-button'), {
                    toggle: false
                });
            });

            $('#resultDiv p:empty').remove();



            function highlightOptions(options, questionDetails, containerDiv) {
                $.each(options, function(index, option) {
                    var optionContainer = $('<div>').addClass('option-container ');
                    var radioInput = $('<input>').attr({
                        'type': 'radio',
                        'name': 'question_' + questionDetails.question_code,
                        'value': option.id
                    }).addClass('option-radio').prop('disabled', true);

                    var optionElement = $('<label>').addClass('row col-12');

                    if (option.id == questionDetails.correct_answer && option.id == questionDetails
                        .answer_selected) {
                        optionElement.addClass('correct-answer');
                        addTickOrCross(optionElement, true);
                    } else if (option.id == questionDetails.correct_answer) {
                        optionElement.addClass('correct-answer');
                        addTickOrCross(optionElement, true);
                    } else if (option.id == questionDetails.answer_selected) {
                        optionElement.addClass('selected-answer');
                        addTickOrCross(optionElement, false);
                    } else {
                        optionElement.addClass('normal-answer');
                    }

                    optionElement.html(option.option_answer.replace('<p><br></p>', ''));
                    optionContainer.append(optionElement);
                    containerDiv.append(optionContainer);
                });
            }


        }
    </script>


@endsection
