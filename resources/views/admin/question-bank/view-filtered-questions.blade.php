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
    <script src="{{ asset('assets/js/pagenation.js') }}"></script>
    <script src="{{ asset('assets/js/table-search.js') }}"></script>
@endsection

@section('content')

    <style>
        th,
        td {
            width: 15%;
            padding: 8px;
            text-align: left;
        }
    </style>

    <div class="container mt-4">

        <div class="card ">
            {{-- view filtered questions fields --}}
            {{--  --}}
            <h5 class="card-header text-sec-color"><b>PYTHON - EASY</b></h5> {{-- skills and difficulty --}}
            <div class="table-responsive  text-nowrap">
                {{-- list of filtered questions table --}}
                <table id="example" class="table table-striped">
                    <thead class="background-secondary">
                        <tr class="text-white">
                            <th scope="col" class="text-white text-center">QUESTIONS</th>
                            <th scope="col" class="text-white text-center">STATUS</th>
                            <th scope="col" class="text-white text-center">ACTIONS</th>
                        </tr>
                        <tr class="background-grey">
                            <td class="text-center"><input type="search" name=""
                                    class="form-control table-search-bar" placeholder="Search Questions" id="">
                            </td>

                            <td class="text-center">
                            </td>
                            <td class=""></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class=" truncate-text">
                                Write a program which can compute the factorial of a given numbers.
                                The results should be printed in a comma-separated sequence on a single line.
                                Suppose the following input is supplied to the program:
                                8
                            </td>

                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" checked id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>

                            <td class="text-center">
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#viewQuestion"><i
                                        class="bx bx-show-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class=" truncate-text">

                                Write a program which accepts a sequence of words separated by whitespace as input to print
                                the words composed of digits only.

                                Example:
                                If the following words is given as input to the program:

                                2 cats and 3 dogs.

                                Then, the output of the program should be:

                                ['2', '3']

                                In case of input data being supplied to the question, it should be assumed to be a console
                                input.


                            </td>

                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" id="statusToggle">
                                    <span class="slider round"></span>
                                </label>
                            </td>

                            <td class="text-center">
                                <a class="icon-buttons" data-bs-toggle="modal" data-bs-target="#viewQuestion"><i
                                        class="bx bx-show-alt"></i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        {{-- pagenations --}}
        <div class="pagination-flex-container justify-content-end mt-5" id="pagination">
            <button class="page-link btn-sm" id="previous" disabled>Previous</button>
            <div id="page-numbers" class="pagination-flex-container"></div>
            <button class="page-link btn-sm" id="next">Next</button>
        </div>
    </div>

    {{-- view questions modal --}}
    <div class="modal fade" id="viewQuestion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content modal-contents">
                <div class="modal-header">
                    <h5 class="modal-title emphasized-title" id="exampleModalLabel">View Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="question-details">


                        <div class="question-statement border-bottom border-3">
                            <h5>Question</h5>
                            <p>
                                Write a program which accepts a sequence of words separated by whitespace as input to print
                                the words composed of digits only.
                            </p>
                            <p class="example">Example:</p>
                            <p>
                                If the following words are given as input to the program:
                            </p>
                            <p class="code">2 cats and 3 dogs.</p>
                            <p>
                                Then, the output of the program should be:
                            </p>
                            <pre class="code">['2', '3']</pre>
                            <p>
                                In case of input data being supplied to the question, it should be assumed to be a console
                                input.
                            </p>
                        </div>

                        <div class="question-solution mt-5 border-bottom border-3">
                            <h5>Solution</h5>
                            <pre>
                    n = int(raw_input())
                    d = dict()
                    for i in range(1, n + 1):
                        d[i] = i * i
                  </pre>
                        </div>

                        <div class="question-hints mt-5">
                            <h5>Hints</h5>
                            <ul>
                                <li>If the output received is in decimal form, round it to the nearest value.</li>
                                <li>Assume input data is from the console.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .modal-contents {
            padding: 20px;
        }

        .question-details {
            padding: 20px;
            border: 1px solid #ccc;
        }

        h5 {
            margin-bottom: 10px;
        }

        .code {
            font-family: monospace;
            background-color: #eee;
            padding: 5px;
            border: 1px solid #ccc;
        }

        .example {
            font-weight: bold;
        }
    </style>

    <script>
        function truncateTextInTable(maxWords) {
            var truncateElements = document.querySelectorAll('.truncate-text');

            truncateElements.forEach(function(element) {
                var words = element.textContent.trim().split(' ');
                if (words.length > maxWords) {
                    var truncatedText = words.slice(0, maxWords).join(' ') + '...';
                    element.textContent = truncatedText;
                }
            });
        }
        truncateTextInTable(70);
    </script>

@endsection
