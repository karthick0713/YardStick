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

 .fs-20{
    font-size:20px;
 }


 .fs-30{
    font-size: 35px;
 }
 
 .radius-none{
    border-radius:0%;
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

.text-sec-color{
    font-weight: 1000;
}

.background-light{
    background-color:#e1e7eb;
}

span.badge{
    width:120px;
    text-align: center;
    border-radius: 0%;
}

</style>
<div class="container ms-5 mt-2  full-screen-content">
    <div class="col-12 ">
        <div class="row">
            <div  class="col-md-2">
            <div style="border-radius: 15px 15px 0 0; " class="card  h-100 ">
                <div style="border-radius: 15px 15px 0 0; " class="background-light">
                    <div class="fw-bold pt-2 mt-2 mb-2 fs-20 text-center ">
                    Total <br> Questions 
                    </div>
                </div>
                <div class="card radius-none background-secondary">
                    <div class=" mt-3 mb-3 text-center fw-bold fs-30 text-white">
                        75
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
                        65 
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
                        10 
                        </div>
                </div>
            </div>
            </div>

            <div class="col-md-2">
                <div style="border-radius: 15px 15px 0 0; " class="card  h-100 ">
                    <div style="border-radius: 15px 15px 0 0; " class="background-light">
                        <div class="fw-bold pt-2 mt-2 mb-2 fs-20 text-center ">
                        Right <br> Answer 
                        </div>
                    </div>
                    <div class="card radius-none background-secondary">
                        <div class=" mt-3 mb-3 text-center fw-bold fs-30 text-white">
                            50 
                            </div>
                    </div>
                </div>
                </div>

                <div class="col-md-2">
                    <div style="border-radius: 15px 15px 0 0; " class="card  h-100 ">
                        <div style="border-radius: 15px 15px 0 0; " class="background-light">
                            <div class="fw-bold pt-2 mt-2 mb-2 fs-20 text-center ">
                            Wrong <br> Answer 
                            </div>
                        </div>
                        <div class="card radius-none background-secondary">
                            <div class=" mt-3 mb-3 text-center fw-bold fs-30 text-white">
                                15 
                                </div>
                        </div>
                    </div>
                    </div>

                    <div class="col-md-2">
                        <div class="center h-100 p-3 bg-light d-flex flex-column justify-content-center">
                            <div class="mx-auto text-center">
                                <label for="" style="font-size:18px" class="mb-0 fw-bold  text-danger">Score</label>
                                <br>
                                <span class=" fs-30 text-sec-color">100</span>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</div>
<br><br>
<div>
    <h5 class="fw-bold mt-5 ms-4 ">Detailed Report</h5>
</div>
<div class="container mt-4">
    <div class="card " >
      <!--<h5 class="card-header"><b>CLIENTS</b></h5>-->
      <div class="table-responsive  text-nowrap">
        <table id="example" class="table table-striped">
          <thead class="background-secondary">
            <tr class="text-white">
                <th scope="col" class="text-white text-center">Question No.</th>
                <th scope="col" class="text-white text-center">Question</th>
                <th scope="col" class="text-white text-center">Status</th>
                <th scope="col" class="text-white text-center">Difficulty</th>
                <th scope="col" class="text-white text-center">Category</th>
                <th scope="col" class="text-white text-center">Points</th>
            </tr>
            <tr class="background-grey">
                <td class="text-center"><input type="search" name="" class="form-control table-search-bar"
                        placeholder="Search No." id=""></td>
                <td class="text-center"><input type="search" name="" class="form-control table-search-bar"
                    placeholder="Search Question" id=""></td>
                    <td class="text-center"><input type="search" name="" class="form-control table-search-bar"
                      placeholder="Search Status" id=""></td>
                 <td class="text-center"><input type="search" name="" class="form-control table-search-bar"
                    placeholder="Search Type" id=""></td>
                <td class="text-center">
                    <input type="search" name="" class="form-control table-search-bar"
                        placeholder="Search Category" id="">
                    </td>
                    <td class="text-center">
                        <input type="search" name="" class="form-control table-search-bar"
                            placeholder="Search Point" id="">
                        </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td >Hello World</td>
                <td ><span class="badge bg-success text-white">Completed</span></td>
                <td>Easy</td>
                <td >C Coding</td>
                <td class="fw-bold">
                   10/20
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td >Hello World</td>
                <td ><span class="badge bg-warning text-white">Pending</span></td>
                <td>Easy</td>
                <td >C Coding</td>
                <td class="fw-bold">
                   10/20
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td >Hello World</td>
                <td ><span class="badge bg-info text-white">Review</span></td>
                <td>Easy</td>
                <td >C Coding</td>
                <td class="fw-bold">
                   10/20
                </td>
            </tr>
            
           
        </tbody>
        </table>
      </div>
    </div>

        <div class="pagination-flex-container justify-content-end mt-5" id="pagination">
            <button class="page-link btn-sm" id="previous" disabled>Previous</button>
            <div id="page-numbers" class="pagination-flex-container"></div>
            <button class="page-link btn-sm" id="next">Next</button>
        </div>
    </div>


@endsection

