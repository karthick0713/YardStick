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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
@endsection

@section('content')

    <style>
        table {
            border-collapse: unset !important;
        }

        select {
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
        }
    </style>
    <div class=" container mt-4">
        <div class=" card-body">
            {{-- select fields to edit questions --}}
            <form action="">
                <div class="  col-12 fw-bold">
                    <div class="row">
                        <div class="col-6 mb-1">
                            <label for="skills">Skills :</label>
                            <select name="" class="form-control" id="skills" required>
                                <option value="" disabled>SELECT</option>
                                <option value="" selected>PHP</option>
                                <option value="">PYTHON</option>
                            </select>
                        </div>

                        <div class="col-6">
                            <label for="difficulty">Difficulty :</label>
                            <select name="" class="custom-select my-select form-control" id="difficulty" required>
                                <option value="" disabled>SELECT</option>
                                <option value="1">Easy</option>
                                <option value="2"> selectedMedium</option>
                                <option value="3">Hard</option>
                            </select>
                        </div>


                        <div class="col-6">
                            <label for="topics">Topics :</label>
                            <select name="" class="custom-select my-select form-control" id="topics" required>
                                <option value="" disabled>SELECT</option>
                                <option value="1">Arrays</option>
                                <option value="2" selected>Statements</option>
                                <option value="3">Operators</option>
                            </select>
                        </div>

                        <div class="col-6 mb-1">
                            <label for="category">Category :</label>
                            <select name="" class="custom-select my-select form-control" id="category"
                                onchange="switchCategory(this.value)" required>
                                <option value="" disabled>SELECT</option>
                                <option value="1">Programming</option>
                                <option value="2" selected>MCQ</option>
                            </select>
                        </div>

                    </div>

                    {{-- edit fields for PROGRAMMING category  --}}

                    <div class="programming">

                        <div class="row">
                            <div class="mt-2">
                                <label for="questions">Question :</label>
                                <textarea name="" id="questions" class="form-control" placeholder="Enter Question" cols="30" required
                                    rows="10"></textarea>
                            </div>
                            <div class="mt-2">
                                <label for="solution">Solution :</label>
                                <textarea name="" id="solution" class="form-control" placeholder="Enter Solution" cols="30" required
                                    rows="10"></textarea>
                            </div>
                        </div>
                        <div class="mx-auto d-flex justify-content-end mt-4">

                        </div>


                        {{-- title, descriptions for edit example,hints etc... --}}

                        <div class="col-12">
                            <div class="card">
                                {{-- <h5 class="card-header">Form Repeater</h5> --}}
                                <div class=" card-body">
                                    <div class="form-repeater">
                                        <div data-repeater-list="group-a">
                                            <div data-repeater-item>
                                                <div class="row">
                                                    <div class=" mb-3 col-lg-5  mb-0">
                                                        <label class="form-label"
                                                            for="form-repeater-1-1"><b>Title</b></label>
                                                        <div class="d-flex align-items-center">
                                                            <input type="text"
                                                                class="d-flex align-items-center form-control"
                                                                placeholder="Enter Title" name=""
                                                                id="form-repeater-1-1">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 col-lg-5  mb-0">
                                                        <label class="form-label"
                                                            for="form-repeater-1-2"><b>Description</b></label>
                                                        <textarea name="" id="form-repeater-1-2" class="form-control" placeholder="Enter Description" cols="30"
                                                            rows="5"></textarea>
                                                    </div>
                                                    <div class=" col-lg-2 ">
                                                        <button type="button" style="margin-top:30px"
                                                            class="btn background-info text-white " data-repeater-delete>
                                                            -
                                                        </button>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="mb-0">
                                            <button type="button" class="btn background-secondary text-white"
                                                data-repeater-create>
                                                <i class="bx bx-plus me-1"></i>
                                                <span class="align-middle">Add</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



                {{-- edit fields for MCQ category  --}}
                <div class="mcq">

                    <div class="mt-2">
                        <label for="questions">Question :</label>
                        <textarea name="" id="questions" class="form-control mb-4" placeholder="Enter Question" cols="30"
                            required rows="4">
                            Among the residents of Exotica Apartments, the number of residents who own Audi cars is eight times the number of residents who own only Ford cars, the number of residents who own only Palio cars is twice the number of residents who own only Ford and Palio. The number of residents who own only Palio and Audi is same as the number of residents who own only Ford. The number of residents who own only Audi is average of the number of residents who own only Ford and only Palio. The number of residents who own only Audi and Palio is half the number of residents who own all the three cars. Each residents owns at least one of the three cars.
                        </textarea>
                    </div>
                    <label for="" class="">( Click the Checkbox which has Correct Answer. )</label>
                    <div class="mt-2">
                        <label for="">Option A :</label>
                        <div class="d-flex">
                            <input type="checkbox" name="" class="checkbox" onclick="toggleCheck(this)"
                                id="">
                            <input type="text" name="" value="120" class="form-control mb-4"
                                placeholder="Option A" id="">
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="">Option B :</label>
                        <div class="d-flex">
                            <input type="checkbox" name="" class="checkbox" onclick="toggleCheck(this)"
                                id="">
                            <input type="text" name="" class="form-control mb-4" value="110"
                                placeholder="Option B" id="">
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="">Option C :</label>
                        <div class="d-flex">
                            <input type="checkbox" name="" checked class="checkbox" onclick="toggleCheck(this)"
                                id="">
                            <input type="text" name="" class="form-control mb-4" value="100"
                                placeholder="Option C" id="">
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="">Option D :</label>
                        <div class="d-flex">
                            <input type="checkbox" name="" class="checkbox" onclick="toggleCheck(this)"
                                id="">
                            <input type="text" name="" class="form-control mb-4" value="90"
                                placeholder="Option D" id="">
                        </div>
                    </div>

                </div>




                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn background-secondary text-white">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function switchCategory(value) {
            if (value == 1) {
                $(".programming").show();
                $(".mcq").hide();
            } else {
                $(".programming").hide();
                $(".mcq").show();
            }
        }

        function toggleCheck(checkbox) {
            var checkboxes = document.getElementsByClassName('checkbox');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] !== checkbox) {
                    checkboxes[i].checked = false;
                }
            }
        }

        $(document).ready(function() {
            if ($("#category").val() == 1) {
                $(".programming").show();
                $(".mcq").hide();
            } else {
                $(".programming").hide();
                $(".mcq").show();
            }
        });
    </script>

@endsection
