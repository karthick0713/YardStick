@extends('layouts/contentNavbarLayout')

@section('title', $sub_heading)

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tagify.css') }}">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">

@endsection

@section('vendor-script')

    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
    <script src="{{ asset('assets/js/tagify.js') }}"></script>
    <script src="{{ asset('assets/js/form-tagify.js') }}"></script>
    <script src="{{ asset('assets/js/form-select.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>

@endsection

@section('content')


    <style>
        .border-2 {
            border: 2px solid black;
        }

        table {
            border-collapse: unset !important;
        }

        select #languageSelect:not() {
            background-image: url('{{ asset('assets/img/icons/down-arrow.png') }}');
            background-repeat: no-repeat;
            background-position-x: 98%;
            background-position-y: center;
            padding-right: 20px;
        }

        select.open {
            background-image: url('{{ asset('assets/img/icons/up-arrow.png') }}');
        }

        .programming {
            display: none;
        }

        .mcq {
            display: none;
        }

        input[type="checkbox"] {
            width: 35px;
            height: 38px;
            margin-right: 8px;
            border: none;
            outline: none;
        }

        textarea {
            margin: 10px 0 10px 0;
            border-radius: 0% !important;
        }

        .copy-container {
            position: relative;
        }

        .copy-button {
            position: absolute;
            right: 0;
            top: 0;
            padding: 8px;
            cursor:
                pointer;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
        }

        .copy-success {
            color: #4caf50;
            margin-top: 5px;
        }

        .question-error-message,
        .solution-error-message {
            display: none;
            color: red;
        }

        .fw-bold p {
            font-weight: normal !important;
        }
    </style>

    <style>
        #compiler-editor {
            height: 500px;
            font-size: 16px;
        }
    </style>


    <div class=" container mt-4">
        <div class=" card-body">
            {{-- select fields to add new questions --}}
            <form action="{{ route('save-questions') }}" method="POST">
                @csrf
                <div class="  col-12 fw-bold">
                    <div class="row">
                        <div class="col-md-2 mb-2">
                            <label for="skills">Skills :</label>
                            <select name="skill" class="form-control" id="skills" onchange="get_topics(this.value)"
                                required>
                                <option value="0" selected disabled>SELECT</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="difficulties">Difficulty :</label>
                            <div class="d-flex">
                                <div class="col d-flex">
                                    <input type="radio" name="difficulty" value="1" id="easy">
                                    <label class="mt-1 ms-2 mx-1" for="easy">Easy</label>
                                </div>
                                <div class="col d-flex">
                                    <input type="radio" name="difficulty" value="2" id="medium">
                                    <label class="mt-1 ms-2 mx-1" for="medium">Medium</label>
                                </div>
                                <div class="col d-flex">
                                    <input type="radio" name="difficulty" value="3" id="hard">
                                    <label class="mt-1 ms-2 mx-1" for="hard">Hard</label>
                                </div>
                                <div class="col d-flex">
                                    <input type="radio" name="difficulty" value="4" id="very-hard">
                                    <label class="mt-1 ms-2 mx-1" for="very-hard">Very Hard</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="topics">Topics :</label>
                            <select name="topic" class="custom-select my-select form-control" id="topics" required>
                                <option value="" selected disabled>SELECT</option>
                            </select>
                        </div>

                        <div class="col-md-2 mb-1">
                            <label for="category">Category :</label>
                            <select name="category" class="custom-select my-select form-control" id="category"
                                onchange="switchCategory(this.value)" required>
                                <option value="" selected disabled>SELECT</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-1 mt-1 marks">
                            <label for="category">Marks :</label>
                            <input type="text" name="marks" class="form-control" id="marks" placeholder=" Marks"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 2)">
                        </div>
                        <div class="col-md-3" id="tagsContainer">
                            <div class="col-10 select2-dark">
                                <label for="tags" class="fw-bold">Tags:</label>
                                <select id="select2Darks" name="tags[]"
                                    class="select2 select-id-change form-select group-select" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->tag_id }}">{{ $tag->tag_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>





                    {{-- add fields for PROGRAMMING category  --}}

                    <div class="programming">

                        <div class="row">
                            <div class="mt-2">
                                <label for="programming-questions">Question :</label>
                                <div id="question-editor" onkeyup="get_value(this)" class="rice-text-area"
                                    style="height: 250px;background-color:white">
                                </div>
                                <input type="hidden" name="programming_question" class="full-editor-value">
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="col mt-2">
                                <label for="programming-questions">Input Format</label>
                                <textarea name="programming_question_input" class="form-control" id="" cols="30" rows="5"></textarea>
                            </div>
                            <div class="col mt-2">
                                <label for="programming-questions">Output Format</label>
                                <textarea name="programming_question_output" class="form-control" id="" cols="30" rows="5"></textarea>
                            </div>
                            <div class="col mt-2">
                                <label for="programming-questions">Code Constraints</label>
                                <textarea name="programming_question_code_constraints" class="form-control" id="" cols="30"
                                    rows="5"></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="question_saving_status" id="question_saving_status">

                        <div class="row col-12">
                            <div class="d-flex ">
                                <div class="col-3">
                                    <label for="">SELECT LANGUAGE: </label>
                                    <select name="language_select" class="form-control" id="languageSelect">
                                        <option value="customlang">SELECT LANGUAGE</option>
                                        {{-- <option value="abap">ABAP</option>
                                        <option value="apex">Apex</option>
                                        <option value="azcli">Azure CLI</option>
                                        <option value="bat">Batch File</option>
                                        <option value="bicep">Bicep</option>
                                        <option value="cameligo">Cameligo</option>
                                        <option value="clojure">Clojure</option>
                                        <option value="coffee">CoffeeScript</option> --}}
                                        <option value="csharp" data-keyword = "C">C</option>
                                        <option value="csharp" data-keyword = "cpp">C++</option>
                                        <option value="csharp" data-keyword = "csharp">C#</option>
                                        {{-- <option value="csp">CSP</option>
                                        <option value="css">CSS</option>
                                        <option value="dart">Dart</option>
                                        <option value="dockerfile">Dockerfile</option>
                                        <option value="ecl">ECL</option>
                                        <option value="elixir">Elixir</option>
                                        <option value="flow9">Flow9</option>
                                        <option value="fsharp">F#</option>
                                        <option value="go">Go</option>
                                        <option value="graphql">GraphQL</option>
                                        <option value="handlebars">Handlebars</option>
                                        <option value="hcl">HashiCorp Configuration Language</option>
                                        <option value="html">HTML</option>
                                        <option value="ini">INI</option> --}}
                                        <option value="java" data-keyword = "java">Java</option>
                                        {{-- <option value="javascript">JavaScript</option>
                                        <option value="julia">Julia</option>
                                        <option value="kotlin">Kotlin</option>
                                        <option value="less">Less</option>
                                        <option value="lexon">Lexon</option>
                                        <option value="liquid">Liquid</option>
                                        <option value="lua">Lua</option>
                                        <option value="m3">M3</option>
                                        <option value="markdown">Markdown</option>
                                        <option value="mips">MIPS Assembly</option>
                                        <option value="msdax">MSDAX</option>
                                        <option value="mysql">MySQL</option>
                                        <option value="objective-c">Objective-C</option>
                                        <option value="pascal">Pascal</option>
                                        <option value="pascaligo">Pascaligo</option>
                                        <option value="perl">Perl</option>
                                        <option value="pgsql">PostgreSQL</option>
                                        <option value="php">PHP</option>
                                        <option value="pla">PL/I</option>
                                        <option value="postiats">ATS</option>
                                        <option value="powerquery">PowerQuery</option>
                                        <option value="powershell">PowerShell</option>
                                        <option value="protobuf">Protocol Buffers</option>
                                        <option value="pug">Pug</option> --}}
                                        <option value="python" data-keyword = "python">Python</option>
                                        {{-- <option value="qsharp">Q#</option>
                                        <option value="r">R</option>
                                        <option value="razor">Razor</option>
                                        <option value="redis">Redis</option>
                                        <option value="redshift">Amazon Redshift</option>
                                        <option value="restructuredtext">reStructuredText</option>
                                        <option value="ruby">Ruby</option>
                                        <option value="rust">Rust</option>
                                        <option value="sb">SB</option>
                                        <option value="scala">Scala</option>
                                        <option value="scheme">Scheme</option>
                                        <option value="scss">SCSS</option>
                                        <option value="shell">Shell</option>
                                        <option value="solidity">Solidity</option>
                                        <option value="sophia">Sophia</option>
                                        <option value="sparql">SPARQL</option>
                                        <option value="sql">SQL</option>
                                        <option value="st">Structured Text (IEC 61131-3)</option>
                                        <option value="swift">Swift</option>
                                        <option value="systemverilog">SystemVerilog</option>
                                        <option value="tcl">Tcl</option>
                                        <option value="twig">Twig</option>
                                        <option value="typescript">TypeScript</option>
                                        <option value="vb">Visual Basic</option>
                                        <option value="xml">XML</option>
                                        <option value="yaml">YAML</option> --}}
                                    </select>
                                </div>


                                <div class="col-3 ms-5">
                                    <label for=""class="fw-bold">Select language for Test:</label>
                                    <select id="language_for_test" name="language_for_test[]"
                                        class="select2 select-id-change form-select group-select" multiple>
                                        <option value="csharp">C</option>
                                        <option value="csharp">C++</option>
                                        <option value="csharp">C#</option>
                                        <option value="java">Java</option>
                                        <option value="python">Python</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12 mt-2">
                            <div id="compiler-editor" onkeyup="solution_for_programming()"></div>
                            <input type="hidden" name="programming_solution" id="programming_solution">
                        </div>

                        <div class="row col-12 mt-2">


                            <div class="col-md-2">
                                <button type="button" class="btn btn-sm btn-primary play-button"
                                    onclick="run_code()">Run Code</button>
                            </div>
                            <div class="col-md-4 mb-4">

                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" onclick="add_test_case()"
                                    class="btn background-secondary text-white">Add Test Case</button>
                            </div>

                            <div class="col-6">
                                <label for="">Input</label>
                                <textarea name="code_input" class="form-control" id="code-input" cols="30" rows="5"
                                    placeholder="Enter Input"></textarea>
                            </div>
                            <div class="col-6">
                                <label for="">Output</label>
                                <textarea name="code_output" class="form-control" id="code-output" cols="30" rows="5"
                                    placeholder="Output" readonly></textarea>
                            </div>
                        </div>


                        <div class="mx-auto d-flex justify-content-end mt-4">

                        </div>


                        {{-- title, descriptions for add example,hints etc... --}}
                        <div class="card" style="background-color:#eceef1">
                            <div id="test-case-div" style="display:none" class="mt-3 ms-3 row col-12">
                                <h5 class="fw-bold">TEST CASES:</h5>
                                <div class="">
                                    <table class="table ">
                                        <thead class="">
                                            <tr>
                                                <th style="width:5%" class="text-center ">
                                                    S.No
                                                </th>
                                                <th style="width:40%" class="text-center ">
                                                    Input
                                                </th>
                                                <th style="width:40%" class="text-center ">
                                                    Output
                                                </th>
                                                <th style="width:5%" class="text-center ">
                                                    Sample
                                                </th>
                                                <th style="width:5%" class="text-center ">
                                                    Weightage
                                                </th>
                                                <th style="width:5%" class="text-center ">
                                                    Action
                                                </th>
                                            </tr>

                                        </thead>
                                        <tbody class="test-case-body">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                {{-- add fields for MCQ category  --}}
                <div class="mcq mb-5">

                    <div class="mt-2 mb-2 d-flex justify-content-end">
                        <button type="button" onclick="add_option()"
                            class="background-info text-white btn add-option-btn">Add Option</button>
                    </div>


                    <div class="mt-2">
                        <label for="mcq-questions">Question :</label>
                        <div style="height: 100px;width:100%">
                            <div class="question-options" onkeyup="get_value(this)" style="background-color:white"></div>
                        </div>
                        <input type="hidden" name="mcq_question" id="mcq-question">
                    </div>
                    <pre>
                        
    
                    </pre>
                    <div class="options-div">
                        <label for="" class="">( Click the Checkbox which has Correct Answer. )</label>
                        <div class="mt-2">
                            <label for="">Option A :</label>
                            <div class="d-flex">
                                <input type="checkbox" name="correct_option" value ="a"
                                    class="checkbox flex-column align-items-center" onclick="toggleCheck(this)"
                                    id="">

                                <div style="height: 100px;width:100%">
                                    <div class="question-options" onkeyup="get_value(this)"
                                        style="background-color:white">
                                    </div>
                                </div>
                                <input type="hidden" name="opt_answer[]" id="opt_answer_1">

                            </div>
                        </div>
                        <pre>


                    </pre>
                        <div class="mt-2">
                            <label for="">Option B :</label>
                            <div class="d-flex">
                                <input type="checkbox" name="correct_option" value ="b"
                                    class="checkbox flex-column align-items-center" onclick="toggleCheck(this)"
                                    id="">
                                <div style="height: 100px;width:100%">
                                    <div class="question-options" onkeyup="get_value(this)"
                                        style="background-color:white">
                                    </div>
                                </div>
                                <input type="hidden" name="opt_answer[]" id="opt_answer_2">

                            </div>
                        </div>
                        <pre>

                        
                    </pre>

                        <div class="mt-2">
                            <label for="">Option C :</label>
                            <div class="d-flex">
                                <input type="checkbox" name="correct_option" value ="c"
                                    class="checkbox flex-column align-items-center" onclick="toggleCheck(this)"
                                    id="">
                                <div style="height:100px;width:100%">
                                    <div class="question-options" onkeyup="get_value(this)"
                                        style="background-color:white">
                                    </div>
                                </div>
                                <input type="hidden" name="opt_answer[]" id="opt_answer_3">

                            </div>
                        </div>
                        <pre>


                    </pre>
                        <div class="mt-2">
                            <label for="">Option D :</label>
                            <div class="d-flex">
                                <input type="checkbox" name="correct_option" value ="d"
                                    class="checkbox flex-column align-items-center" onclick="toggleCheck(this)"
                                    id="">
                                <div style="height: 100px;width:100%">
                                    <div class="question-options" onkeyup="get_value(this)"
                                        style="background-color:white">
                                    </div>
                                </div>
                                <input type="hidden" name="opt_answer[]" id="opt_answer_4">


                            </div>
                        </div>
                    </div>





                    <br>
                    <div class="mt-5">

                        <h5 class="fw-bold">Explanation</h5>
                        <div class="">
                            <div id="explanation-editor" onkeyup="get_value(this)" class=""
                                style="height: 100px;background-color:white">
                            </div>
                        </div>
                        <input type="hidden" name="mcq_explanation" class="mcq_explanation">
                    </div>
                </div>


                <div style="display:none" class="mcq_grouping">

                    <div class="mt-4 title">
                        <h5 class="fw-bold">Title:</h5>
                        <div id="grouping-title-editor" onkeyup="get_value(this)" class=""
                            style="height: 150px;background-color:white">
                        </div>
                        <input type="hidden" name="mcq_grouping_title" class="">
                    </div>

                    <div class="mt-3 d-flex">
                        <div class="mt-2 mx-3">
                            <button type="button" class="btn background-secondary text-white"
                                onclick='add_question_for_mcq()'>Add Questions</button>
                        </div>

                    </div>


                    <div class="questions-for-mcq-grouping ">

                        <div style="background-color:#ececec" class="question-index question_1">

                            <div class="mt-4 ms-3 mx-3">
                                <br>
                                <div class="d-flex justify-content-end">
                                    <button type="button" value="1"
                                        onclick="add_grouping_question_options(this.value)"
                                        class="btn background-secondary text-white btn-sm mx-3 mcq-grouping-option-add-button">ADD
                                        OPTION
                                    </button>
                                    <button type="button" onclick="remove_questions(this)"
                                        class="btn background-info text-white btn-sm remove-questions">DELETE
                                        QUESTION</button>
                                </div>
                                <label for="mcq-questions">Question 1:</label>
                                <div style="height: 75px;width:100%">
                                    <div class="question-options" onkeyup="get_value(this)"
                                        style="background-color:white">
                                    </div>
                                </div>
                                <input type="hidden" name="grouping_mcq_question[1]" id="mcq-question">
                            </div>
                            <pre>
                            
        
                                </pre>
                            <div class="ms-3  mx-3 mcq-grouping-options ">
                                <label for="" class="">( Click the Checkbox which has Correct
                                    Answer.
                                    )</label>
                                <div class=" row grouping-options-append-div1">
                                    <div class="col-6">
                                        <div class="mt-2">
                                            <label for="">Option A :</label>
                                            <div class="d-flex">
                                                <input type="checkbox" name="grouping_correct_option[1]" value ="a"
                                                    class="checkbox flex-column align-items-center"
                                                    onclick="toggleCheck(this)" id="">

                                                <div style="height: 50px;width:100%;margin-bottom:60px">
                                                    <div class="question-options" onkeyup="get_value(this)"
                                                        style="background-color:white">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="grouping_opt_answer[1][]" id="opt_answer_1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mt-2">
                                            <label for="">Option B :</label>
                                            <div class="d-flex">
                                                <input type="checkbox" name="grouping_correct_option[1]" value ="b"
                                                    class="checkbox flex-column align-items-center"
                                                    onclick="toggleCheck(this)" id="">
                                                <div style="height: 50px;width:100%;margin-bottom:60px">
                                                    <div class="question-options" onkeyup="get_value(this)"
                                                        style="background-color:white">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="grouping_opt_answer[1][]" id="opt_answer_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mt-2">
                                            <label for="">Option C :</label>
                                            <div class="d-flex">
                                                <input type="checkbox" name="grouping_correct_option[1]" value ="c"
                                                    class="checkbox flex-column align-items-center"
                                                    onclick="toggleCheck(this)" id="">
                                                <div style="height:50px;width:100%;margin-bottom:60px">
                                                    <div class="question-options" onkeyup="get_value(this)"
                                                        style="background-color:white">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="grouping_opt_answer[1][]" id="opt_answer_3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mt-2">
                                            <label for="">Option D :</label>
                                            <div class="d-flex">
                                                <input type="checkbox" name="grouping_correct_option[1]" value ="d"
                                                    class="checkbox flex-column align-items-center"
                                                    onclick="toggleCheck(this)" id="">
                                                <div style="height: 50px;width:100%;margin-bottom:60px">
                                                    <div class="question-options" onkeyup="get_value(this)"
                                                        style="background-color:white">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="grouping_opt_answer[1][]" id="opt_answer_4">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>


                </div>





                <br>
                <div class="mt-4 d-flex justify-content-start">
                    <button type="button" class="btn background-secondary text-white" value="submit"
                        onclick="saving_status(this.value)">Submit</button>
                    <button type="button" style="background-color:#eceef1" value="draft"
                        onclick="saving_status(this.value)" class="btn ms-3 mx-3 fw-bold">Save as
                        Draft</button>
                    {{-- <button type="button" style="background-color:#eceef1" onclick="tag_display()" id="toggleButton"
                        class="btn ms-3 mx-3  fw-bold">Add
                        Tags</button> --}}
                </div>



            </form>
        </div>
    </div>



    <script src="{{ asset('assets/quill/quill.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>

    <script>
        function tag_display() {
            var tagsContainer = document.getElementById("tagsContainer");
            var button = document.getElementById("toggleButton");

            if (tagsContainer.style.display === "none") {
                tagsContainer.style.display = "flex";
                button.innerText = "Hide Tags";
            } else {
                tagsContainer.style.display = "none";
                button.innerText = "Add Tags";
            }
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
            nodejs: {
                id: 'nodejs',
                name: 'NodeJS',
                extension: '.js'
            },
            javascript: {
                id: 'javascript',
                name: 'JavaScript',
                extension: '.js'
            },
            groovy: {
                id: 'groovy',
                name: 'Groovy',
                extension: '.groovy'
            },
            jshell: {
                id: 'jshell',
                name: 'JShell',
                extension: '.jsh'
            },
            haskell: {
                id: 'haskell',
                name: 'Haskell',
                extension: '.hs'
            },
            tcl: {
                id: 'tcl',
                name: 'Tcl',
                extension: '.tcl'
            },
            lua: {
                id: 'lua',
                name: 'Lua',
                extension: '.lua'
            },
            ada: {
                id: 'ada',
                name: 'Ada',
                extension: '.ada'
            },
            commonlisp: {
                id: 'commonlisp',
                name: 'CommonLisp',
                extension: '.lisp'
            },
            d: {
                id: 'd',
                name: 'D',
                extension: '.d'
            },
            elixir: {
                id: 'elixir',
                name: 'Elixir',
                extension: '.ex'
            },
            erlang: {
                id: 'erlang',
                name: 'Erlang',
                extension: '.erl'
            },
            fsharp: {
                id: 'fsharp',
                name: 'F#',
                extension: '.fs'
            },
            fortran: {
                id: 'fortran',
                name: 'Fortran',
                extension: '.f'
            },
            assembly: {
                id: 'assembly',
                name: 'Assembly',
                extension: '.asm'
            },
            scala: {
                id: 'scala',
                name: 'Scala',
                extension: '.scala'
            },
            php: {
                id: 'php',
                name: 'PHP',
                extension: '.php'
            },
            python2: {
                id: 'python2',
                name: 'Python2',
                extension: '.py'
            },
            csharp: {
                id: 'csharp',
                name: 'C#',
                extension: '.cs'
            },
            perl: {
                id: 'perl',
                name: 'Perl',
                extension: '.pl'
            },
            ruby: {
                id: 'ruby',
                name: 'Ruby',
                extension: '.rb'
            },
            go: {
                id: 'go',
                name: 'Go',
                extension: '.go'
            },
            r: {
                id: 'r',
                name: 'R',
                extension: '.r'
            },
            racket: {
                id: 'racket',
                name: 'Racket',
                extension: '.rkt'
            },
            ocaml: {
                id: 'ocaml',
                name: 'OCaml',
                extension: '.ml'
            },
            vb: {
                id: 'vb',
                name: 'Visual Basic (VB.NET)',
                extension: '.vb'
            },
            bash: {
                id: 'bash',
                name: 'Bash',
                extension: '.sh'
            },
            clojure: {
                id: 'clojure',
                name: 'Clojure',
                extension: '.clj'
            },
            typescript: {
                id: 'typescript',
                name: 'TypeScript',
                extension: '.ts'
            },
            cobol: {
                id: 'cobol',
                name: 'Cobol',
                extension: '.cob'
            },
            kotlin: {
                id: 'kotlin',
                name: 'Kotlin',
                extension: '.kt'
            },
            pascal: {
                id: 'pascal',
                name: 'Pascal',
                extension: '.pas'
            },
            prolog: {
                id: 'prolog',
                name: 'Prolog',
                extension: '.pl'
            },
            rust: {
                id: 'rust',
                name: 'Rust',
                extension: '.rs'
            },
            swift: {
                id: 'swift',
                name: 'Swift',
                extension: '.swift'
            },
            octave: {
                id: 'octave',
                name: 'Octave',
                extension: '.m'
            },
            text: {
                id: 'text',
                name: 'Text',
                extension: '.txt'
            },
            brainfk: {
                id: 'brainfk',
                name: 'BrainFK',
                extension: '.bf'
            },
            coffeescript: {
                id: 'coffeescript',
                name: 'CoffeeScript',
                extension: '.coffee'
            },
            ejs: {
                id: 'ejs',
                name: 'EJS',
                extension: '.ejs'
            },
            mysql: {
                id: 'mysql',
                name: 'MySQL',
                extension: '.sql'
            },
            postgresql: {
                id: 'postgresql',
                name: 'PostgreSQL',
                extension: '.sql'
            },
            mongodb: {
                id: 'mongodb',
                name: 'MongoDB',
                extension: '.js'
            },
            sqlite: {
                id: 'sqlite',
                name: 'SQLite',
                extension: '.sqlite'
            },
            redis: {
                id: 'redis',
                name: 'Redis',
                extension: '.redis'
            },
            mariadb: {
                id: 'mariadb',
                name: 'MariaDB',
                extension: '.sql'
            },
            sqlserver: {
                id: 'sqlserver',
                name: 'Microsoft SQL Server',
                extension: '.sql'
            },
        };


        var editor = ace.edit("compiler-editor");
        editor.setTheme("ace/theme/dracula")
        editor.session.setMode("ace/mode/php");

        var userCode = editor.getValue();

        var languageSelect = $("#languageSelect");
        languageSelect.change(function() {
            var selectedLanguage = languageSelect.val();
            editor.session.setMode("ace/mode/" + selectedLanguage);
        });

        function findLanguageById(id) {
            return Object.values(languages).find(lang => lang.id === id);
        }

        function solution_for_programming() {
            $("#programming_solution").val(editor.getValue())
        }

        function run_code() {
            var codes = $('#code').val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var lang = $("#languageSelect option:selected").attr('data-keyword').toLowerCase();
            const languageIdToFind = lang;
            const foundLanguage = findLanguageById(languageIdToFind);
            $.ajax({
                url: "{{ route('run-code') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    content: editor.getValue(),
                    language: foundLanguage.id,
                    stdin: $("#code-input").val(),
                    filename: `index${foundLanguage.extension}`,
                },
                success: function(data) {
                    if (data.stderr == null) {
                        $("#code-output").removeClass('fw-bold text-danger');
                        $("#code-output").val("");
                        $("#code-output").val(data.stdout);
                    } else {
                        $("#code-output").addClass('fw-bold text-danger');
                        $("#code-output").val("");
                        $("#code-output").val(data.stderr);
                    }
                },
                error: function(data) {
                    alert('Something went wrong');
                }
            })
        }



        function add_test_case() {
            var input = $("#code-input").val();
            var output = $("#code-output").val();

            if (input == "" && output == "" || input == "" && output != "" || input != "" && output == "") {
                alert("Input and Output must not be empty..!");
                return false;
            }
            var index = $(".test-case-body tr").length + 1;
            var rows = `
        <tr>
            <td class='text-center'>${index}</td>
            <td class='text-center'><textarea name="test_case_input[]" class="form-control" rows="4">${input}</textarea></td>
            <td class='text-center'><textarea name="test_case_output[]" class="form-control" rows="4">${output}</textarea></td>
            <td class='text-center'><input type='checkbox' name="test_case_sample[]" onclick="testCaseSample(this)" value="1"> <input type='hidden' name="sample[]" value="0" > </td>
            <td class='text-center'><input type="number" name="test_case_weightage[]" value="0" class="form-control test_case_weightage"></td>
            <td class='text-center'><button type="button" onclick="remove_row(this)" class="btn btn-danger btn-sm">DELETE</button></td>
        </tr>
    `;
            $("#test-case-div").show();
            $(".test-case-body").append(rows);
        }


        function testCaseSample(val) {
            if ($(val).is(':checked')) {
                $(val).prop('checked', true);
                $(val).val(1);
                $(val).parent().find('input[type="hidden"]').val(1);
                $(val).closest('tr').find('input[name="test_case_weightage[]"]').val(0);
                $(val).closest('tr').find('input[name="test_case_weightage[]"]').prop('readonly', true);
            } else {
                $(val).prop('checked', false);
                $(val).val(0);
                $(val).parent().find('input[type="hidden"]').val(0);
                $(val).closest('tr').find('input[name="test_case_weightage[]"]').val("");
                $(val).closest('tr').find('input[name="test_case_weightage[]"]').prop('readonly', false);
            }
        }



        function remove_row(row) {
            if (confirm("Are you sure you want to remove")) {
                $(row).closest('tr').remove();
            }
        }





        $(document).ready(() => {
            get_skills();
            get_difficulties();
            var newOptions = document.querySelectorAll('.question-options:not(.quill-initialized)');
            quill_editor(newOptions);
        });



        function quill_editor(options) {
            options.forEach(function(editor, index) {
                if (!editor.classList.contains('quill-initialized')) {
                    new Quill(editor, {
                        theme: 'snow',
                        modules: {
                            toolbar: [
                                [{
                                    'font': []
                                }, {
                                    'size': []
                                }],
                                ['bold', 'italic', 'underline', 'strike'],
                                [{
                                    'color': []
                                }, {
                                    'background': []
                                }],
                                // [{
                                //     'script': 'super'
                                // }, {
                                //     'script': 'sub'
                                // }],
                                // [{
                                //     'header': '1'
                                // }, {
                                //     'header': '2'
                                // }, 'blockquote', 'code-block'],
                                // [{
                                //     'list': 'ordered'
                                // }, {
                                //     'list': 'bullet'
                                // }, {
                                //     'indent': '-1'
                                // }, {
                                //     'indent': '+1'
                                // }],
                                // [{
                                //     'direction': 'rtl'
                                // }],
                                // ['link', 'image', 'video'],
                                // ['clean']
                            ]
                        }
                    });

                    editor.classList.add('quill-initialized');
                }
            });
        }

        var optionCounter = 5;

        function add_option() {
            var optionLetter = String.fromCharCode(96 + optionCounter);

            var newOptionHtml = `
        <br>
        <div class="mt-5">
            <label for="">Option ${optionLetter.toUpperCase()} :</label>
            <div class="d-flex">
                <input type="checkbox" name="correct_option" value="${optionLetter}"
                    class="checkbox flex-column align-items-center" onclick="toggleCheck(this)" id="">
                <div style="height: 100px; width: 100%">
                    <div class="question-options" onkeyup="get_value(this)" style="background-color: white">
                    </div>
                </div>
                <input type="hidden" name="opt_answer[]" id="opt_answer_${optionCounter}">
                
            </div>
        </div>
    `;

            $('.options-div').append(newOptionHtml);
            optionCounter++;
            var newOptions = document.querySelectorAll('.question-options:not(.quill-initialized)');
            quill_editor(newOptions);
        }



        function get_value(element) {
            var quillContent = $(element).find('.ql-editor').html();
            var edit_value = $(element).parent().parent().find('input[type="hidden"]');
            edit_value.val(quillContent);

        }


        var quillFullEditor = new Quill("#question-editor", {
            theme: "snow",
            modules: {
                toolbar: [
                    [{
                        'font': []
                    }, {
                        'size': []
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    [{
                        'script': 'super'
                    }, {
                        'script': 'sub'
                    }],
                    [{
                        'header': '1'
                    }, {
                        'header': '2'
                    }, 'blockquote', 'code-block'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }, {
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    [{
                        'direction': 'rtl'
                    }],
                    ['link', 'image', 'video'],
                    ['clean']
                ],
            }
        });

        var quillFullEditor = new Quill("#grouping-title-editor", {
            theme: "snow",
            modules: {
                toolbar: [
                    [{
                        'font': []
                    }, {
                        'size': []
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    [{
                        'script': 'super'
                    }, {
                        'script': 'sub'
                    }],
                    [{
                        'header': '1'
                    }, {
                        'header': '2'
                    }, 'blockquote', 'code-block'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }, {
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    [{
                        'direction': 'rtl'
                    }],
                    ['link', 'image', 'video'],
                    ['clean']
                ],
            }
        });


        var quillFullEditor = new Quill("#explanation-editor", {
            theme: "snow",
            modules: {
                toolbar: [
                    [{
                        'font': []
                    }, {
                        'size': []
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    [{
                        'script': 'super'
                    }, {
                        'script': 'sub'
                    }],
                    [{
                        'header': '1'
                    }, {
                        'header': '2'
                    }, 'blockquote', 'code-block'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }, {
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    [{
                        'direction': 'rtl'
                    }],
                    ['link', 'image', 'video'],
                    ['clean'],
                ],
            }
        });



        function get_desc_value(element) {
            var quillContent = $(element).find('.ql-editor').html();
            $(element).parent().find('.question-sub-description').val(quillContent);
        }

        var question_index = 1;

        function add_question_for_mcq() {
            question_index++;
            var row = `
            <div style="background-color:#ececec" class="question-index question_${question_index}">

            <div class="mt-4 ms-3 mx-3">
                <br>
                <div class="d-flex justify-content-end">
                    <button type="button" value=""
                        onclick="add_grouping_question_options(this.value)"
                        class="btn background-secondary text-white btn-sm mx-3 mcq-grouping-option-add-button">ADD
                        OPTION
                    </button>
                    <button type="button" onclick="remove_questions(this)"
                        class="btn background-info text-white btn-sm remove-questions">DELETE
                        QUESTION</button>
                </div>
                <label for="mcq-questions">Question ${question_index}:</label>
                <div style="height: 75px;width:100%">
                    <div class="question-options" onkeyup="get_value(this)"
                        style="background-color:white">
                    </div>
                </div>
                <input type="hidden" name="grouping_mcq_question[${question_index}]" id="mcq-question">
            </div>
            <pre>


                </pre>
            <div class="ms-3  mx-3 mcq-grouping-options ">
                <label for="" class="">( Click the Checkbox which has Correct
                    Answer.
                    )</label>
                <div class=" row grouping-options-append-div${question_index}">
                    <div class="col-6">
                        <div class="mt-2">
                            <label for="">Option A :</label>
                            <div class="d-flex">
                                <input type="checkbox" name="grouping_correct_option[${question_index}]" value ="a"
                                    class="checkbox flex-column align-items-center"
                                    onclick="toggleCheck(this)" id="">

                                <div style="height: 50px;width:100%;margin-bottom:60px">
                                    <div class="question-options" onkeyup="get_value(this)"
                                        style="background-color:white">
                                    </div>
                                </div>
                                <input type="hidden" name="grouping_opt_answer[${question_index}][]" id="opt_answer_1">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-2">
                            <label for="">Option B :</label>
                            <div class="d-flex">
                                <input type="checkbox" name="grouping_correct_option[${question_index}]" value ="b"
                                    class="checkbox flex-column align-items-center"
                                    onclick="toggleCheck(this)" id="">
                                <div style="height: 50px;width:100%;margin-bottom:60px">
                                    <div class="question-options" onkeyup="get_value(this)"
                                        style="background-color:white">
                                    </div>
                                </div>
                                <input type="hidden" name="grouping_opt_answer[${question_index}][]" id="opt_answer_2">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-2">
                            <label for="">Option C :</label>
                            <div class="d-flex">
                                <input type="checkbox" name="grouping_correct_option[${question_index}]" value ="c"
                                    class="checkbox flex-column align-items-center"
                                    onclick="toggleCheck(this)" id="">
                                <div style="height:50px;width:100%;margin-bottom:60px">
                                    <div class="question-options" onkeyup="get_value(this)"
                                        style="background-color:white">
                                    </div>
                                </div>
                                <input type="hidden" name="grouping_opt_answer[${question_index}][]" id="opt_answer_3">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-2">
                            <label for="">Option D :</label>
                            <div class="d-flex">
                                <input type="checkbox" name="grouping_correct_option[${question_index}]" value ="d"
                                    class="checkbox flex-column align-items-center"
                                    onclick="toggleCheck(this)" id="">
                                <div style="height: 50px;width:100%;margin-bottom:60px">
                                    <div class="question-options" onkeyup="get_value(this)"
                                        style="background-color:white">
                                    </div>
                                </div>
                                <input type="hidden" name="grouping_opt_answer[${question_index}][]" id="opt_answer_4">

                            </div>
                        </div>
                    </div>
                </div>

            </div>


            </div>
            `;
            $(".questions-for-mcq-grouping").append(row);
            $(`.question_${question_index}`).find('.mcq-grouping-option-add-button').val(question_index)
            $('#marks').val(question_index)
            var newOptions = document.querySelectorAll('.question-options:not(.quill-initialized)');
            quill_editor(newOptions);
        }

        function remove_questions(val) {
            $(val).parent().parent().parent().remove();
            var mark = $("#marks").val();
            $("#marks").val(mark - 1)
        }


        var optionCounterGrouping = {
            1: 5
        };

        function add_grouping_question_options(value) {

            if (!(optionCounterGrouping[value])) {
                optionCounterGrouping[value] = 5;
            }

            var mcq_grouping = $(".mcq-grouping-options");
            var grouping_add_options = $(".grouping-options-append-div" + value);

            var optionLetter = String.fromCharCode(96 + optionCounterGrouping[value]);

            var newOptionHtml = `
        <div class="col-6" style="">
            <label for="">Option ${optionLetter.toUpperCase()} :</label>
            <div class="d-flex">
                <input type="checkbox" name="grouping_correct_option[${value}]" value="${optionLetter}"
                    class="checkbox flex-column align-items-center" onclick="toggleCheck(this)" id="">
                <div style="height: 50px; width: 100%;margin-bottom:60px">
                    <div class="question-options" onkeyup="get_value(this)" style="background-color: white">
                    </div>
                </div>
                <input type="hidden" name="grouping_opt_answer[${value}][]" id="opt_answer_${optionCounterGrouping}">
            </div>
        </div>
    `;

            $(grouping_add_options).append(newOptionHtml);
            optionCounterGrouping[value]++;
            var newOptions = document.querySelectorAll('.question-options:not(.quill-initialized)');
            quill_editor(newOptions);
        }





        function add_quill() {
            setTimeout(() => {
                var newItem = $('.groups_a:last');
                var quillCount = $('.quill-editor').length;
                var newQuillId = 'quill-editor-' + (quillCount + 1);
                var newHiddenInputId = 'question_sub_description_' + (quillCount + 1);
                newItem.find('.quill-editor').attr('id', newQuillId);
                newItem.find('.question-sub-description').attr('id', newHiddenInputId);
                newItem.find('.ql-toolbar').remove();
                newItem.appendTo('[data-repeater-list="group-a"]');
                new Quill('#' + newQuillId, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{
                                'font': []
                            }, {
                                'size': []
                            }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{
                                'color': []
                            }, {
                                'background': []
                            }],
                            [{
                                'script': 'super'
                            }, {
                                'script': 'sub'
                            }],
                            [{
                                'header': '1'
                            }, {
                                'header': '2'
                            }, 'blockquote', 'code-block'],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }, {
                                'indent': '-1'
                            }, {
                                'indent': '+1'
                            }],
                            [{
                                'direction': 'rtl'
                            }],
                            ['link', 'image', 'video'],
                            ['clean']
                        ],
                    }
                });
            }, 500);
        }


        function get_skills() {
            $.ajax({
                url: "{{ route('ajax-get-skills') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var html = '<option value="" selected disabled>SELECT</option>';
                    for (var i = 0; i < data.length; i++) {
                        var capitalizedSkillName = data[i].skill_name.charAt(0).toUpperCase() + data[i]
                            .skill_name.slice(1).toLowerCase();
                        html += '<option value="' + data[i].skill_id + '">' + capitalizedSkillName +
                            '</option>';
                    }
                    $('#skills').html(html);
                },
                error: function(data) {}
            })
        }

        function get_difficulties() {
            $.ajax({
                url: "{{ route('ajax-get-difficulties') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var html = '<option value="" selected disabled>SELECT</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].difficulty_id + '">' + data[i].difficulty_name +
                            '</option>';
                    }
                    $('#difficulties').html(html);
                },
                error: function(data) {}
            })
        }

        function get_topics(value) {
            $.ajax({
                url: "{{ route('ajax-get-topics') }}",
                type: "GET",
                dataType: "json",
                data: {
                    skill_id: value
                },
                success: function(data) {
                    var html = '<option value="" selected disabled>SELECT</option>';
                    for (var i = 0; i < data.length; i++) {
                        var capitalizedTopicName = data[i].topic_name.charAt(0).toUpperCase() + data[i]
                            .topic_name.slice(1).toLowerCase();
                        html += '<option value="' + data[i].topic_id + '">' + capitalizedTopicName +
                            '</option>';
                    }
                    $('#topics').html(html);
                },
                error: function(data) {}
            })
        }

        function switchCategory(value) {
            if (value == 1) {
                $(".programming").show();
                $("#marks").val('');
                $("#marks").prop('readonly', false);
                $(".mcq").hide();
                $(".mcq_grouping").hide();
            } else if (value == 3) {
                $(".programming").hide();
                $("#marks").val(1);
                $("#marks").prop('readonly', true);
                $(".mcq").hide();
                $(".mcq_grouping").show();
            } else {
                $(".programming").hide();
                $("#marks").val(1);
                $("#marks").prop('readonly', true);
                $(".mcq").show();
                $(".mcq_grouping").hide();
            }
        }

        function toggleCheck(checkbox) {

            var checkboxes = document.getElementsByClassName('checkbox');
            if ($("#category").val() == 2) {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i] !== checkbox) {
                        checkboxes[i].checked = false;
                    }
                }
            }

        }

        function classEach(className) {
            var sum = 0;
            $('.' + className).each(function() {
                sum += parseInt($(this).val(), 10) || 0;
            });
            return sum;
        }

        function saving_status(value) {
            if (value == "submit") {
                $("#question_saving_status").val("1");
                if ($("#category").val() == 1) {
                    var valus = classEach('test_case_weightage');
                    if (valus != 100) {
                        alert('Please Check Weightage');
                        return false;
                    }
                }
                $('form').submit()
            } else {
                $("#question_saving_status").val("2");
                var valus = classEach('test_case_weightage');

                $('form').submit()
            }
        }
    </script>


@endsection
