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

        input[type="checkbox"] {
            width: 25px;
            height: 25px;
        }

        .checkbox-span {
            font-size: 20px;
            margin-left: 10px;
            position: relative;
            bottom: 8px;
        }
    </style>
    <div class="card">
        <div class="container ">
            <div class="card-body">
                {{-- edit students groups fields --}}
                <form action="" method="post">
                    <div class="row col-12">
                        <div class="col-md-6 mb-3">
                            <label for="select-college">GROUP NAME:</label>
                            <input type="text" name="" placeholder="Group Name" value="PSG-ECE-1-2nd"
                                class="form-control" id="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="select-college">SELECT COLLEGE:</label>
                            <select name="" class="form-control" id="select-college">
                                <option value="">SELECT</option>
                                <option value="">STUDY WORLD COLLEGE OF ENGINEERING</option>
                                <option value="" selected>PSG COLLEGE OF INSTITUTIONS</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="select-deparment">SELECT DEPARTMENT:</label>
                            <select name="" class="form-control" id="select-deparment">
                                <option value="">SELECT</option>
                                <option value="">CSE</option>
                                <option value="" selected>ECE</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="select-year">SELECT YEAR:</label>
                            <select name="" class="form-control" id="select-year">
                                <option value="">SELECT</option>
                                <option value="" selected>1st Year</option>
                                <option value="">2nd Year</option>
                                <option value="">3rd Year</option>
                                <option value="">4th Year</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="select-semester">SELECT SEMESTER:</label>
                            <select name="" class="form-control" id="select-semester">
                                <option value="">SELECT</option>
                                <option value="">1st Semester</option>
                                <option value="" selected>2nd Semester</option>
                                <option value="">3rd Semester</option>
                                <option value="">4th Semester</option>
                                <option value="">5th Semester</option>
                                <option value="">6th Semester</option>
                                <option value="">7th Semester</option>
                                <option value="">8th Semester</option>
                            </select>
                        </div>
                    </div>
                    {{-- list of students in above selected fields --}}
                    <label class="mt-5"><b>EDIT STUDENTS:</b></label>
                    <div class="row col-12 mt-4">
                        <div class="col-md-4">
                            <input type="checkbox" checked name="" class="" id="">
                            <span class="checkbox-span">ADIPI MANOJ KUMAR</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" name="" class="" id="">
                            <span class="checkbox-span">ALAGU MANIKANDAN</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" checked name="" class="" id="">
                            <span class="checkbox-span">ANU PRIYA E.P </span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" name="" class="" id="">
                            <span class="checkbox-span">ANUSH KRISHNAN </span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" checked name="" class="" id="">
                            <span class="checkbox-span">ATHUL S JOTHI</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" name="" class="" id="">
                            <span class="checkbox-span">BOOMIGA</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" checked name="" class="" id="">
                            <span class="checkbox-span">EKAMBARAM BHANU PRAKASH</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" checked name="" class="" id="">
                            <span class="checkbox-span">HARI PRASATH C</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" name="" class="" id="">
                            <span class="checkbox-span">KAAVYAA S</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" name="" class="" id="">
                            <span class="checkbox-span">KABILAN T</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" checked name="" class="" id="">
                            <span class="checkbox-span">KONDAPANENI BHARGAV</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" checked name="" class="" id="">
                            <span class="checkbox-span">KONDAREDDY NIKHILESHWAR REDDY</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" name="" class="" id="">
                            <span class="checkbox-span">KOTHA CHETAN KUMAR</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" checked name="" class="" id="">
                            <span class="checkbox-span">MADINENI MADHVILATHA</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" name="" class="" id="">
                            <span class="checkbox-span">MALAVIKA R</span>
                        </div>
                    </div>
                    <div class="mt-4 d-flex justify-content-end">
                        <button type="submit" class="btn background-secondary text-white">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
