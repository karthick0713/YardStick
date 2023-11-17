<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://www.markuptag.com/bootstrap/5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />

    <style>
    body {
    background-image: url('{{ asset('assets/img/logo/yardstick-logo3.png') }}');
    background-size: 16%; 
    background-position: left bottom ;
    background-repeat: no-repeat;
  }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg login-header">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/img/logo/yardstick-logo1.png') }}" alt="">
            </a>

            <div class="collapse navbar-collapse" id="mob-navbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-black" href="#">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-black ms-4" href="#">Signup</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg background-secondary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse justify-content-center" id="mob-navbar">
                <div class="row">
                    <div class="col">
                        <a class="nav-link fw-bold text-white" href="#">Home</a>
                    </div>
                    <div class="col ">
                        <a class="nav-link fw-bold text-white" href="#">About&nbsp;Us</a>
                    </div>
                    <div class="col ">
                        <a class="nav-link fw-bold text-white" href="#">Tests</a>
                    </div>
                    <div class="col">
                        <a class="nav-link fw-bold text-white" href="#">Our&nbsp;Clients</a>
                    </div>
                    <div class="col">
                        <a class="nav-link fw-bold text-white" href="#">Testimonials</a>
                    </div>
                    <div class="col">
                        <a class="nav-link fw-bold text-white" href="#">Associations</a>
                    </div>
                    <div class="col">
                        <a class="nav-link fw-bold text-white" href="#">Why&nbsp;Us?</a>
                    </div>
                    <div class="col">
                        <a class="nav-link fw-bold text-white" href="#">Placements</a>
                    </div>
                    <div class="col">
                        <a class="nav-link fw-bold text-white" href="#">Blog</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div
        style="">

        <div class="container">

            <div class="row justify-content-center mt-5">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body login-card-body">
                            <h4 class="text-center">Welcome to YardStick</h4>
                            <h5 class="mt-3 text-center ">Register to get started</h5>
                            <form action="{{ url('/login') }}" method="">
                                <div class="mb-3 mt-4">
                                    <input type="text" class="form-control login-fields " id="username"
                                        placeholder=" Name">
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control login-fields" id="email"
                                        placeholder="Email Id">
                                </div>
                                <div class="mb-3">
                                    <input type="int" maxlength="10" class="form-control login-fields" id="Mobile-Number"
                                        placeholder="Mobile Number">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control login-fields" id="password"
                                        placeholder="Password">
                                </div>
                                <div class="row mt-5">
                                    <div class="col d-flex align-items-center  justify-content-center">
                                        <button
                                            class="btn background-secondary text-white radius mx-3 w-25">Register</button>
                                    </div>
                                </div>
                                <!--<div class="row mt-4">-->
                                <!--    <div class="col d-flex justify-content-center">-->
                                <!--        <span>To create a new account <a href=""-->
                                <!--                style="color:#c23b3b">Sign-Up</a></span>-->
                                <!--    </div>-->
                                <!--</div>-->

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>
