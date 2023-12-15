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
                <form action="{{ route('set-filter-session') }}" method="POST">
                    @csrf
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
                                    <div class=" button-container">

                                        @foreach ($difficulty as $diff)
                                            @php
                                                $val = DB::table('question_banks')
                                                    ->where('difficulties_id', $diff->difficulty_id)
                                                    ->where('skills_id', $skills->skill_id)
                                                    ->where('trash_key', 1)
                                                    ->where('is_active', 1)
                                                    ->get();
                                            @endphp
                                            <button type="button" value="{{ $diff->difficulty_id }}"
                                                class="btn btn-outline-primary difficulty_button mx-1">{{ $diff->difficulty_name }}-{{ count($val) }}</button>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="difficulties" id="difficulties">
                                    <input type="hidden" name="skills" id="skills" value="{{ $skills->skill_id }}">

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
                                        <input type="hidden" name="categories" id="categories">
                                        @foreach ($category as $cat)
                                            <button type="button" value="{{ $cat->category_id }}"
                                                class="btn btn-outline-primary mx-1 category_button">{{ $cat->category_name }}</button>
                                        @endforeach
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
                                        <input type="hidden" name="topics" id="topics">
                                        @foreach ($topics as $top)
                                            <button type="button" value="{{ $top->topic_id }}"
                                                class="btn btn-outline-primary mx-1 topic_button">{{ $top->topic_name }}</button>
                                        @endforeach
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

                });
            });


            $(document).ready(function() {
                var categoryArray = [];
                var difficultyArray = [];
                var topicArray = [];

                $(".category_button").on("click", function() {
                    var valueToAdd = $(this).val();
                    var index = categoryArray.indexOf(valueToAdd);
                    if (index === -1) {
                        categoryArray.push(valueToAdd);
                        $("#categories").val(categoryArray);
                    } else {
                        categoryArray.splice(index, 1);
                        $("#categories").val(categoryArray);
                    }
                });

                $(".difficulty_button").on("click", function() {
                    var valueToAdd = $(this).val();
                    var index = difficultyArray.indexOf(valueToAdd);
                    if (index === -1) {
                        difficultyArray.push(valueToAdd);
                        $("#difficulties").val(difficultyArray);
                    } else {
                        difficultyArray.splice(index, 1);
                        $("#difficulties").val(difficultyArray);
                    }
                });

                $(".topic_button").on("click", function() {
                    var valueToAdd = $(this).val();
                    var index = topicArray.indexOf(valueToAdd);
                    if (index === -1) {
                        topicArray.push(valueToAdd);
                        $("#topics").val(topicArray);
                    } else {
                        topicArray.splice(index, 1);
                        $("#topics").val(topicArray);
                    }
                });
            });
        </script>
    @endsection
