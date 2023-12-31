{{-- @php
    $containerNav = $containerNav ?? 'container-fluid';
    $navbarDetached = $navbarDetached ?? '';

@endphp

<!-- Navbar -->
@if (isset($navbarDetached) && $navbarDetached == 'navbar-detached')
    <nav class="layout-navbar {{ $containerNav }} navbar navbar-expand-xl {{ $navbarDetached }} align-items-center bg-navbar-theme"
        id="layout-navbar">
@endif
@if (isset($navbarDetached) && $navbarDetached == '')
    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="{{ $containerNav }}">
@endif

<!--  Brand demo (display only for navbar-full and hide on below xl) -->
@if (isset($navbarFull))
    <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{ url('/') }}" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
                @include('_partials.macros', ['width' => 25, 'withbg' => '#696cff'])
            </span>
            <span class="app-brand-text demo menu-text fw-bolder">{{ config('variables.templateName') }}</span>
        </a>
    </div>
@endif

<!-- ! Not required for layout-without-menu -->
@if (!isset($navbarHideToggle))
    <div
        class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ? ' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
@endif

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                aria-label="Search...">
        </div>
    </div>
    <!-- /Search -->
    <ul class="navbar-nav flex-row align-items-center ms-auto">

        <!-- Place this tag where you want the button to render. -->
        <li class="nav-item lh-1 me-3">
            <a class="github-button" href="https://github.com/themeselection/sneat-html-laravel-admin-template-free"
                data-icon="octicon-star" data-size="large" data-show-count="true"
                aria-label="Star themeselection/sneat-html-laravel-admin-template-free on GitHub">Star</a>
        </li>

        <!-- User -->
       
        <!--/ User -->
    </ul>
</div>

@if (!isset($navbarDetached))
    </div>
@endif --}}
{{-- </nav> --}}

<style>
    .contents {
        justify-content: space-evenly;
    }
</style>
<header class=" p-3">
    <div class="container">
        <div class="row">

            <div class="d-flex contents">
                @if (!isset($navbarHideToggle))
                    <div
                        class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ? ' d-xl-none ' : '' }}">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                @endif

                <div class="col-md-6 mt-3">
                    <span>
                        @php
                            if ($sub_heading) {
                                $values = ' | ' . $sub_heading;
                            } else {
                                $values = '';
                            }
                        @endphp
                        <h4 class="navbar-title fw-bold">

                            {{-- header title --}}

                            @if ($heading != 'Dashboard')
                                <i class='bx bx-left-arrow-alt' onclick="window.history.back()"></i>
                            @endif
                            {{ $heading . $values }}
                        </h4>
                    </span>
                </div>

                <div class="col-md-6 d-flex justify-content-end align-items-center">
                    <i class="bx-notifi-menu bx bx-bell me-2 mx-3"></i>
                    <div class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                            data-bs-toggle="dropdown">
                            <div class="avatar avatar-online">
                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                    class="w-px-40 h-auto rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-online">
                                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                                    class="w-px-40 h-auto rounded-circle">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <span class="fw-semibold d-block">{{ Session::get('userName') }}</span>
                                            <small class="text-muted">
                                                @php
                                                    if (Session::get('role') == 1) {
                                                        echo 'Admin';
                                                    } elseif (Session::get('role') == 3) {
                                                        echo 'Student';
                                                    }
                                                @endphp
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            @php
                                if (Session::get('role') == 1) {
                                    $url = 'admin/profile';
                                } elseif (Session::get('role') == 3) {
                                    $url = 'student/profile';
                                }
                            @endphp
                            <li>
                                <a class="dropdown-item" href="{{ url($url) }}">
                                    <i class="bx bx-user me-2"></i>
                                    <span class="align-middle">My Profile</span>
                                </a>
                            </li>

                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class='bx bx-power-off me-2'></i>
                                    <span class="align-middle">Log Out</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
</header>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



<!-- / Navbar -->
