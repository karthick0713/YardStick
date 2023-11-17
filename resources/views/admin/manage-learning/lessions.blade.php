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
@endsection

@section('content')
    <div class="container mt-4">
        <div style="height:400px!important" class="col-6 mx-auto mt-4 py-4">
            {{-- add and remove lessions --}}
            <div class="text-center">
                <button class="btn background-secondary radius text-white ms-2">Add Lession</button>
                <button class="btn background-secondary radius text-white ms-2">Remove Lession</button>
            </div>
            <div class="mt-4 card-body background-light">
                <div class="text-center">
                    <span class="text-sec-color"><b>Choose a Skill</b></span>
                </div>
                <div class="mt-4">
                    <label>Sub Category <span class="important">*</span></label>
                    <select name="sub_category" class="form-control" id="">
                        <option value="" disabled selected>Select One</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label>Skill <span class="important">*</span></label>
                    <select name="skill" class="form-control" id="">
                        <option value="" disabled selected>Select One</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn background-secondary text-white" type="submit">Proceed</button>
                </div>
            </div>
        </div>

    </div>
@endsection
