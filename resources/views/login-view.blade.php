<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://www.markuptag.com/bootstrap/5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            background-image: url('{{ asset('assets/img/logo/yardstick-logo3.png') }}');
            background-size: 16%;
            /* You can change this value to your preferred size */
            background-position: left bottom;
            background-repeat: no-repeat;
        }

        button.active {
            background-color: rgba(33, 93, 129, 1);
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
                        <a class="nav-link fw-bold text-black ms-4" href="#">Signup</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Navbar for Navigation Links -->
    <nav class="navbar navbar-expand-lg background-secondary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse justify-content-center" id="mob-navbar">
                <div class="row">
                    <!-- Add Bootstrap responsive classes for columns -->
                    <div class="col">
                        <a class="nav-link fw-bold text-white" href="#">Home</a>
                    </div>
                    <div class="col">
                        <a class="nav-link fw-bold text-white" href="#">About&nbsp;Us</a>
                    </div>
                    <div class="col">
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

    <!-- Login Form -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body login-card-body">
                        <div class="login-body-title mt-3">Glad to see you!</div>
                        <div class="invalid-message mt-5">
                            <div id="invalidCredentialsAlert" class="alert alert-danger alert-dismissible"
                                role="alert" style="display: none;">
                                Invalid Credentials
                            </div>

                            <div id="select-alert" class="alert alert-danger alert-dismissible" role="alert"
                                style="display: none;">
                                Please Select Your Role !

                            </div>

                            <div id="validation-message" class="alert alert-danger alert-dismissible" role="alert"
                                style="display: none;">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>

                        </div>
                        <div class="row  col-12">
                            <div class="col-md-4 text-center">
                                <button class="btn btn-secondary radius my-2 btn-block" value="3"
                                    onclick="setAction(this,this.value)">Student</button>
                            </div>

                            <div class="col-md-4 text-center">
                                <button class="btn btn-secondary radius my-2 btn-block" value="2"
                                    onclick="setAction(this,this.value)">Institution </button>
                            </div>
                            <div class="col-md-4 text-center">
                                <button class="btn btn-secondary radius my-2 btn-block" value="1"
                                    onclick="setAction(this,this.value)">Admin</button>
                            </div>
                        </div>
                        <form id="loginForm">
                            <div class="mb-3 mt-4">
                                <input type="email" class="form-control login-fields " id="username" name="email"
                                    placeholder="Email">
                                <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control login-fields" id="password"
                                    name="password" placeholder="Password">
                            </div>
                            <div class="row mt-5">
                                <div class="col d-flex align-items-center justify-content-center">
                                    <button type="submit"
                                        class="btn background-secondary text-white radius mx-3 w-25">Login</button>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col d-flex justify-content-center">
                                    <span>To create a new account <a href="{{ url('/register') }}"
                                            style="color:#c23b3b">Sign-Up</a></span>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="{{ asset('assets/js/login.js') }}"></script>
<script src="{{ asset('assets/js/bootstraps4.js') }}"></script>



</html>
