@extends('layouts/StudentNavbarLayout')

@section('title', $sub_heading)

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
   body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

td{
    @media (max-width: 600px) {
        font-size:13px;
        line-height: 0.75cm;
    }
}

.extra{
    @media (max-width: 600px) {
       display:none;
    }
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}

tr{
    line-height: 1.5cm;
}

td{ 
    padding-left: 15px;
}

.password-toggle {
    position: relative;
}

#password {
    padding-right: 30px; 
}

.toggle-password {
    position: absolute;
    top: 50%;
    right: 5px;
    transform: translateY(-50%);
    cursor: pointer;
}

#password[type="password"] {
    -webkit-text-security: disc;
}
</style>
<div class="container">
    <div class="main-body card">
        <form action="">
          <div class="row col-12 gutters-sm">
            <div class="col-md-6 mb-3">
                <div class="d-flex flex-column align-items-center text-center">
                    <div class="mb-3">
                        <div class="image-background" style="background-color: #f0f0f0; padding: 10px; border-radius: 50%;">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="200">
                            
                        </div>
                        
                    </div>
                    <div style="margin-left:70px">
                        <input type="file" title="Choose File to Update" name="" id="">
                    </div>
                    <br>
                
                    <div>
                        <div class="text-center text-md-right">
                            <div class="d-flex">
                                <label class="pt-2" for="">Name: </label>
                                <input type="text" name="" class="ms-1  form-control" placeholder="Name" value="Adipi Manoj Kumar" id="">
                            </div><br>
                            <div class="d-flex">
                            <label class="pt-2" for="">Year: </label>
                            <select name="" class="ms-3 form-control" id="">
                                <option value="" selected disabled>SELECT YEAR</option>
                                <option value="">1st year</option>
                                <option value="" selected>2nd year</option>
                                <option value="">3rd year</option>
                                <option value="">4th year</option>
                            </select>
                        </div><br>
                            COLLEGE NAME : <span class="fw-bold"> STUDY WORLD</span>
                        </div>
                    </div>
                </div>
                
               
                <div style="background-color:#FFFBF6;margin-top:60px" class="card ">

                    <div class="d-flex justify-content-end mt-1 mx-3">
                        {{-- <a href="" class="text-black "><i class="bx bx-edit-alt">Edit</i></a> --}}
                    </div>
                    <table id="contact-form">
                        <tr >
                          <td >Email</td>
                          <td><input type="email" name="" class="form-control" placeholder="Email" value="adipimanojkumar@gmail.com" id=""></td>
                        </tr>
                        <tr>
                          <td>Contact No.</td>
                          <td><input type="text" name="" class="form-control" placeholder="Contact No." value="9638552741" id=""></td>
                        </tr>
                        <tr>
                          <td>Address</td>
                          <td><input type="text" name="" class="form-control" placeholder="Address" value="Salem" id=""></td>
                        </tr>
                        <tr>
                          <td>Skills</td>
                          <td><input type="text" name="" class="form-control" placeholder="Skills" value="xxxxxx" id=""></td>
                        </tr>
                        <tr>
                          <td>Certifications</td>
                          <td><input type="text" name="" class="form-control" placeholder="Certifications" value="xxxxxx" id=""></td>
                        </tr>
                        <tr>
                          <td>Projects Done</td>
                          <td><input type="text" name="" placeholder="Projects Done" class="form-control" value="xxxxxx" id=""></td>
                        </tr>
                      </table>
                  </div>
              </div>
              
            <div class=" col-md-6">
              <div class="extra mb-3">
                <div style="margin-top:110px; " class="d-flex mx-3">
                    {{-- <a href="" class="text-black "><i class="bx bx-edit-alt">Edit</i></a> --}}
                </div>
            </div>

              <div  class="row gutters-sm">
                <div class=" mb-3">
                    <div style="background-color:#FFFBF6;" class="card ">
                        <div class="d-flex justify-content-end mt-1 mx-3">
                            {{-- <a href="" class="text-black "><i class="bx bx-edit-alt">Edit</i></a> --}}
                        </div>
                        <table id="contact-form">
                            <tr >
                              <td >Password</td>
                              <td>
                                <div class="password-toggle">
                                    <input type="password" id="password" value="123456" class="form-control" placeholder="Password">
                                    <span class="toggle-password" id="togglePassword">
                                        <i class="bx bx-show"></i>
                                    </span>
                                </div>
                            </td>
                            
                            </tr>
                            <tr>
                              <td>Security Questions</td>
                              <td><input type="text" name="" class="form-control" placeholder="Security Questions" value="xxxxxx" id=""></td>
                            </tr>
                            <tr>
                              <td>Primary Mobile No.</td>
                              <td><input type="text" name="" class="form-control" placeholder="Mobile No" value="9513578520" id=""></td>
                            </tr>
                          </table>
                      </div>
                </div>
              </div>
              <br>
              <div class="d-flex justify-content-end">
                    <button type="submit" class="btn background-secondary text-white">Update Profile</button>
              </div>


            </div>
          </div>
        </form>
        </div>
    </div>

    <script>
      const passwordField = document.getElementById("password");
const togglePassword = document.getElementById("togglePassword");

togglePassword.addEventListener("click", function() {
    if (passwordField.type === "password") {
        passwordField.type = "text";
        togglePassword.innerHTML = '<i class="bx bx-hide"></i>'; 
    } else {
        passwordField.type = "password";
        togglePassword.innerHTML = '<i class="bx bx-show"></i>'; 
    }
});

    </script>
@endsection
