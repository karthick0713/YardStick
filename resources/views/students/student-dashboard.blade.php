@extends('layouts/studentNavbarLayout')

@section('title', 'Dashboard')

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
        a {
            color: black;
        }

        a:hover .background-light {
            color: white;
            background-color: rgb(238, 118, 118);
            transition: 0.3s;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);

            gap: 10px;

            @media (max-width: 600px) {
                grid-template-columns: 1fr;
                /* Display as a single column on smaller screens */
                grid-template-rows: repeat(5, 1fr);
            }
        }
    </style>
    <div class="container full-screen-content">
        <div class="col-12">
            <div class="row">
                <div class="col-md-2  mb-4">
                    <div class="card h-100">
                        <div class="background-light d-flex card-body">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="61" height="61" viewBox="0 0 61 61"
                                    fill="none">
                                    <rect width="61" height="61" rx="5" fill="#215D81" />
                                    <path
                                        d="M51.6363 51H10V49.1818H51.6363V51ZM12.5454 11H23.0363V51H12.5454V11ZM21.2182 12.8182H14.3635V49.1818H21.2182V12.8182ZM21.2363 21.4182H30V51H21.2363L21.2363 21.4182ZM28.1818 23.2363H23.0546V49.1818H28.1818V23.2363ZM38.5818 12.7273H49.0727V51H38.5818V12.7273ZM47.2545 14.5454H40.4V49.1818H47.2545V14.5454ZM28.1818 16.2H40.4181V51H28.1818V16.2ZM38.6 18.0182H30V49.1818H38.6V18.0182ZM29.0908 42.3272H22.1455V40.509H29.0909L29.0908 42.3272ZM36.0182 44.0546H32.5455V42.2363H36.0182L36.0182 44.0546ZM22.1455 44.0546H13.4545V42.2363H22.1454L22.1455 44.0546ZM22.1455 19.7637H13.4545V17.9454H22.1454L22.1455 19.7637Z"
                                        fill="white" />
                                </svg>
                            </div>
                            <div class="ms-3 fw-bold" style="padding-top: 
                            10px">
                                Enrolled<br>
                                <label for="" class="icon-text-color">3</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2  mb-4">
                    <div class="card h-100">
                        <div class="background-light d-flex card-body">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="61" height="61" viewBox="0 0 61 61"
                                    fill="none">
                                    <rect width="61" height="61" rx="5" fill="#215D81" />
                                    <path
                                        d="M17.2887 43.1982L37.0671 14.7021C37.1802 14.5281 37.3268 14.3788 37.4982 14.263C37.6696 14.1472 37.8623 14.0673 38.0649 14.028C38.2675 13.9887 38.4758 13.9908 38.6775 14.0342C38.8793 14.0776 39.0704 14.1615 39.2394 14.2807C39.4084 14.4 39.552 14.5523 39.6616 14.7286C39.7712 14.9048 39.8446 15.1015 39.8774 15.3069C39.9102 15.5123 39.9018 15.7223 39.8527 15.9244C39.8036 16.1264 39.7147 16.3165 39.5914 16.4833L18.9007 46.2944C18.7824 46.4654 18.6311 46.6107 18.4559 46.7216C18.2808 46.8325 18.0852 46.9067 17.881 46.9397C17.6768 46.9728 17.4681 46.9641 17.2674 46.9141C17.0666 46.8641 16.8778 46.7738 16.7123 46.6487L5.61644 38.2556C5.45454 38.1332 5.31814 37.9797 5.21503 37.8041C5.11192 37.6285 5.04412 37.4341 5.0155 37.232C4.95769 36.8239 5.06299 36.4094 5.30823 36.0796C5.55346 35.7499 5.91854 35.5318 6.32316 35.4735C6.72777 35.4153 7.13878 35.5215 7.46576 35.7688L17.2887 43.1982ZM39.2123 28.3487C38.8036 28.3487 38.4116 28.1849 38.1226 27.8934C37.8336 27.6019 37.6712 27.2066 37.6712 26.7944C37.6712 26.3822 37.8336 25.9868 38.1226 25.6953C38.4116 25.4039 38.8036 25.2401 39.2123 25.2401H48.4589C48.8676 25.2401 49.2596 25.4039 49.5486 25.6953C49.8376 25.9868 50 26.3822 50 26.7944C50 27.2066 49.8376 27.6019 49.5486 27.8934C49.2596 28.1849 48.8676 28.3487 48.4589 28.3487H39.2123ZM33.0479 37.6743C32.6392 37.6743 32.2472 37.5106 31.9582 37.2191C31.6692 36.9276 31.5069 36.5323 31.5069 36.1201C31.5069 35.7078 31.6692 35.3125 31.9582 35.021C32.2472 34.7295 32.6392 34.5658 33.0479 34.5658H48.4558C48.8645 34.5658 49.2565 34.7295 49.5455 35.021C49.8346 35.3125 49.9969 35.7078 49.9969 36.1201C49.9969 36.5323 49.8346 36.9276 49.5455 37.2191C49.2565 37.5106 48.8645 37.6743 48.4558 37.6743H33.0479ZM26.8836 47C26.4748 47 26.0829 46.8363 25.7938 46.5448C25.5048 46.2533 25.3425 45.8579 25.3425 45.4457C25.3425 45.0335 25.5048 44.6382 25.7938 44.3467C26.0829 44.0552 26.4748 43.8914 26.8836 43.8914H48.4558C48.8645 43.8914 49.2565 44.0552 49.5455 44.3467C49.8346 44.6382 49.9969 45.0335 49.9969 45.4457C49.9969 45.8579 49.8346 46.2533 49.5455 46.5448C49.2565 46.8363 48.8645 47 48.4558 47H26.8836Z"
                                        fill="white" />
                                </svg>
                            </div>
                            <div class="ms-3 fw-bold" style="padding-top: 10px">
                                Questions Solved<br>
                                <span class="icon-text-color">3</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2  mb-4">
                    <div class="card h-100">
                        <div class="background-light d-flex card-body">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="61" height="61" viewBox="0 0 61 61"
                                    fill="none">
                                    <rect width="61" height="61" rx="5" fill="#215D81" />
                                    <path
                                        d="M22.75 32.825C23.3958 32.825 23.945 32.5987 24.3976 32.1461C24.8502 31.6935 25.076 31.1448 25.075 30.5C25.075 29.8542 24.8487 29.3049 24.3961 28.8523C23.9435 28.3997 23.3948 28.174 22.75 28.175C22.1042 28.175 21.5549 28.4013 21.1023 28.8539C20.6497 29.3065 20.424 29.8552 20.425 30.5C20.425 31.1458 20.6513 31.695 21.1039 32.1476C21.5565 32.6002 22.1052 32.826 22.75 32.825ZM30.5 32.825C31.1458 32.825 31.695 32.5987 32.1476 32.1461C32.6002 31.6935 32.826 31.1448 32.825 30.5C32.825 29.8542 32.5987 29.3049 32.1461 28.8523C31.6935 28.3997 31.1448 28.174 30.5 28.175C29.8542 28.175 29.3049 28.4013 28.8523 28.8539C28.3997 29.3065 28.174 29.8552 28.175 30.5C28.175 31.1458 28.4013 31.695 28.8539 32.1476C29.3065 32.6002 29.8552 32.826 30.5 32.825ZM38.25 32.825C38.8958 32.825 39.445 32.5987 39.8976 32.1461C40.3502 31.6935 40.576 31.1448 40.575 30.5C40.575 29.8542 40.3487 29.3049 39.8961 28.8523C39.4435 28.3997 38.8948 28.174 38.25 28.175C37.6042 28.175 37.0549 28.4013 36.6023 28.8539C36.1497 29.3065 35.924 29.8552 35.925 30.5C35.925 31.1458 36.1513 31.695 36.6039 32.1476C37.0565 32.6002 37.6052 32.826 38.25 32.825ZM30.5 46C28.3558 46 26.3408 45.5929 24.455 44.7786C22.5692 43.9643 20.9287 42.8602 19.5337 41.4662C18.1388 40.0712 17.0346 38.4308 16.2214 36.545C15.4082 34.6592 15.001 32.6442 15 30.5C15 28.3558 15.4071 26.3408 16.2214 24.455C17.0357 22.5692 18.1398 20.9287 19.5337 19.5337C20.9287 18.1388 22.5692 17.0346 24.455 16.2214C26.3408 15.4082 28.3558 15.001 30.5 15C32.6442 15 34.6592 15.4071 36.545 16.2214C38.4308 17.0357 40.0712 18.1398 41.4662 19.5337C42.8612 20.9287 43.9659 22.5692 44.7801 24.455C45.5944 26.3408 46.001 28.3558 46 30.5C46 32.6442 45.5929 34.6592 44.7786 36.545C43.9643 38.4308 42.8602 40.0712 41.4662 41.4662C40.0712 42.8612 38.4308 43.9659 36.545 44.7801C34.6592 45.5944 32.6442 46.001 30.5 46ZM30.5 42.9C33.9617 42.9 36.8937 41.6987 39.2962 39.2962C41.6987 36.8937 42.9 33.9617 42.9 30.5C42.9 27.0383 41.6987 24.1062 39.2962 21.7037C36.8937 19.3012 33.9617 18.1 30.5 18.1C27.0383 18.1 24.1062 19.3012 21.7037 21.7037C19.3012 24.1062 18.1 27.0383 18.1 30.5C18.1 33.9617 19.3012 36.8937 21.7037 39.2962C24.1062 41.6987 27.0383 42.9 30.5 42.9Z"
                                        fill="white" />
                                </svg>
                            </div>
                            <div class="ms-3 fw-bold" style="padding-top: 10px">
                                Assessment Pending<br>
                                <span class="icon-text-color">1</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2  mb-4">
                    <div class="card h-100">
                        <div class="background-light d-flex card-body">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="61" height="61" viewBox="0 0 61 61"
                                    fill="none">
                                    <rect width="61" height="61" rx="5" fill="#215D81" />
                                    <path
                                        d="M35.896 25.222L28.174 32.962L25.204 29.992C25.0426 29.8036 24.8441 29.6505 24.6208 29.5425C24.3974 29.4344 24.1542 29.3737 23.9063 29.3642C23.6584 29.3546 23.4112 29.3964 23.1802 29.4869C22.9492 29.5773 22.7395 29.7146 22.564 29.89C22.3886 30.0654 22.2514 30.2752 22.1609 30.5062C22.0704 30.7372 22.0286 30.9844 22.0382 31.2323C22.0477 31.4802 22.1085 31.7234 22.2165 31.9467C22.3245 32.1701 22.4776 32.3686 22.666 32.53L26.896 36.778C27.0642 36.9448 27.2637 37.0768 27.483 37.1664C27.7023 37.256 27.9371 37.3014 28.174 37.3C28.6462 37.298 29.0987 37.1105 29.434 36.778L38.434 27.778C38.6027 27.6107 38.7366 27.4116 38.828 27.1922C38.9194 26.9729 38.9664 26.7376 38.9664 26.5C38.9664 26.2624 38.9194 26.0271 38.828 25.8078C38.7366 25.5884 38.6027 25.3893 38.434 25.222C38.0968 24.8867 37.6405 24.6986 37.165 24.6986C36.6895 24.6986 36.2333 24.8867 35.896 25.222ZM31 13C27.4399 13 23.9598 14.0557 20.9997 16.0335C18.0397 18.0114 15.7326 20.8226 14.3702 24.1117C13.0078 27.4008 12.6513 31.02 13.3459 34.5116C14.0404 38.0033 15.7547 41.2106 18.2721 43.7279C20.7894 46.2453 23.9967 47.9596 27.4884 48.6541C30.98 49.3487 34.5992 48.9922 37.8883 47.6298C41.1774 46.2675 43.9886 43.9603 45.9665 41.0003C47.9443 38.0402 49 34.5601 49 31C49 28.6362 48.5344 26.2956 47.6298 24.1117C46.7253 21.9278 45.3994 19.9435 43.7279 18.2721C42.0565 16.6006 40.0722 15.2748 37.8883 14.3702C35.7044 13.4656 33.3638 13 31 13ZM31 45.4C28.152 45.4 25.3679 44.5554 22.9998 42.9732C20.6317 41.3909 18.786 39.1419 17.6961 36.5106C16.6062 33.8794 16.3211 30.984 16.8767 28.1907C17.4323 25.3974 18.8038 22.8315 20.8177 20.8177C22.8315 18.8038 25.3974 17.4323 28.1907 16.8767C30.984 16.3211 33.8794 16.6062 36.5106 17.6961C39.1419 18.786 41.3909 20.6317 42.9732 22.9998C44.5555 25.3679 45.4 28.1519 45.4 31C45.4 34.8191 43.8829 38.4818 41.1823 41.1823C38.4818 43.8829 34.8191 45.4 31 45.4Z"
                                        fill="white" />
                                </svg>
                            </div>
                            <div class="ms-3 fw-bold" style="padding-top: 10px">
                                Completed<br>
                                <span class="icon-text-color">0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2  mb-4">
                    <div class="card h-100">
                        <div class="background-light d-flex card-body">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="61" height="61" viewBox="0 0 61 61"
                                    fill="none">
                                    <rect width="61" height="61" rx="5" fill="#215D81" />
                                    <path
                                        d="M31.0511 15C35.4831 15 39.4961 16.7967 42.4008 19.7014C45.3055 22.6061 47.1022 26.6191 47.1022 31.0511C47.1022 35.4831 45.3055 39.4961 42.4008 42.4008C39.4961 45.3053 35.4831 47.1022 31.0511 47.1022C26.6191 47.1022 22.6061 45.3053 19.7014 42.4008C16.7967 39.4961 15 35.4831 15 31.0511C15 26.6191 16.7967 22.6061 19.7014 19.7014C22.6061 16.7967 26.6191 15 31.0511 15ZM40.936 21.1662C38.4065 18.6365 34.9115 17.072 31.0511 17.072C27.1906 17.072 23.6957 18.6365 21.1662 21.1662C18.6365 23.6957 17.072 27.1906 17.072 31.0511C17.072 34.9114 18.6365 38.4065 21.1662 40.936C23.6955 43.4654 27.1906 45.0302 31.0511 45.0302C34.9115 45.0302 38.4067 43.4654 40.936 40.936C43.4657 38.4065 45.0302 34.9114 45.0302 31.0511C45.0302 27.1906 43.4657 23.6957 40.936 21.1662Z"
                                        fill="white" stroke="white" stroke-width="1.33342" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.072 31.0511C11.072 25.9452 13.0214 21.2946 16.2162 17.8034L14.6875 16.4052C11.1553 20.2653 9 25.4069 9 31.0511C9 36.6953 11.1553 41.8369 14.6875 45.697L16.2162 44.2988C13.0214 40.8076 11.072 36.157 11.072 31.0511Z"
                                        fill="white" stroke="white" stroke-width="1.33342" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M45.1865 17.8034C48.3813 21.2946 50.3307 25.9452 50.3307 31.0511C50.3307 36.157 48.3813 40.8076 45.1865 44.2988L46.7151 45.697C50.2474 41.8369 52.4027 36.6953 52.4027 31.0511C52.4027 25.4069 50.2474 20.2653 46.7151 16.4052L45.1865 17.8034Z"
                                        fill="white" stroke="white" stroke-width="1.33342" />
                                    <path
                                        d="M31.0178 20.2918C31.0178 19.7199 30.5537 19.2558 29.9818 19.2558C29.4099 19.2558 28.9458 19.7199 28.9458 20.2918V31.0722C28.9458 31.3462 29.0524 31.5954 29.2262 31.7806L36.0841 39.9911C36.4507 40.429 37.1029 40.4871 37.5411 40.1205C37.979 39.7541 38.037 39.1017 37.6704 38.6637L31.0178 30.6992V20.2918Z"
                                        fill="white" stroke="white" stroke-width="1.33342" />
                                </svg>
                            </div>
                            <div class="ms-3 fw-bold" style="padding-top: 10px">
                                Study Hours<br>
                                <span class="icon-text-color">120 mins</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2  mb-4">
                    <div class="card h-100">
                        <div class="background-light d-flex card-body">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="61" height="61"
                                    viewBox="0 0 61 61" fill="none">
                                    <rect width="61" height="61" rx="5" fill="#215D81" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M33.3466 6.1848C32.7581 6.09162 32.6617 7.48074 32.0676 7.43406C31.4737 7.38737 31.5958 6 31 6C30.4042 6 30.5263 7.38737 29.9324 7.43406C29.3383 7.48074 29.2419 6.09162 28.6534 6.1848C28.065 6.27798 28.4027 7.62936 27.8234 7.76806C27.2439 7.90715 26.9315 6.55012 26.3648 6.73415C25.7981 6.91817 26.343 8.2001 25.7925 8.42809C25.2418 8.65588 24.721 7.36441 24.19 7.63481C23.6591 7.9054 24.3977 9.08598 23.8898 9.39742C23.3819 9.70866 22.6653 8.51465 22.1832 8.8648C21.7012 9.21495 22.6155 10.2654 22.1624 10.6525C21.7094 11.0394 20.8149 9.97205 20.3934 10.3934C19.9721 10.8149 21.0394 11.7094 20.6525 12.1624C20.2654 12.6155 19.215 11.7012 18.8648 12.1834C18.5147 12.6653 19.7087 13.3819 19.3974 13.89C19.086 14.3981 17.9054 13.6591 17.6348 14.1902C17.3642 14.721 18.6559 15.242 18.4279 15.7925C18.1999 16.343 16.918 15.7981 16.734 16.3648C16.5499 16.9315 17.9071 17.2439 17.7681 17.8234C17.6292 18.4029 16.278 18.065 16.1846 18.6536C16.0914 19.2421 17.4805 19.3383 17.4339 19.9324C17.3872 20.5263 16 20.4042 16 21C16 21.5958 17.3872 21.4739 17.4339 22.0678C17.4805 22.6617 16.0914 22.7581 16.1846 23.3466C16.278 23.9352 17.6292 23.5973 17.7681 24.1766C17.9071 24.7561 16.5499 25.0687 16.734 25.6354C16.918 26.202 18.1999 25.6572 18.4279 26.2077C18.6559 26.7582 17.3642 27.2791 17.6348 27.81C17.9054 28.3409 19.086 27.6021 19.3974 28.1102C19.7087 28.6183 18.5147 29.3347 18.8648 29.8168C19.215 30.299 20.2654 29.3847 20.6525 29.8378C21.0394 30.2908 19.9721 31.1853 20.3934 31.6066C20.8149 32.0281 21.7094 30.9608 22.1624 31.3477C22.6155 31.7346 21.7012 32.785 22.1832 33.1352C22.6653 33.4855 23.3819 32.2915 23.8898 32.6028C24.3977 32.9142 23.6591 34.0948 24.19 34.3654C24.721 34.6358 25.2418 33.3443 25.7925 33.5721C26.343 33.8001 25.7981 35.082 26.3648 35.266C26.9315 35.4501 27.2439 34.093 27.8234 34.2319C28.4027 34.3708 28.065 35.7222 28.6534 35.8154C29.2419 35.9086 29.3383 34.5194 29.9324 34.5661C30.5263 34.6128 30.4042 36.0002 31 36.0002C31.5958 36.0002 31.4737 34.6128 32.0676 34.5661C32.6617 34.5194 32.7581 35.9086 33.3466 35.8154C33.935 35.7222 33.5973 34.3708 34.1766 34.2319C34.7561 34.093 35.0685 35.4501 35.6352 35.266C36.2019 35.082 35.657 33.8001 36.2075 33.5721C36.7582 33.3443 37.279 34.6358 37.81 34.3654C38.3409 34.0948 37.6023 32.9142 38.1102 32.6028C38.6181 32.2915 39.3347 33.4855 39.8168 33.1352C40.2988 32.785 39.3845 31.7346 39.8376 31.3477C40.2906 30.9608 41.1851 32.0281 41.6066 31.6066C42.028 31.1853 40.9606 30.2908 41.3475 29.8378C41.7346 29.3847 42.785 30.299 43.1352 29.8168C43.4853 29.3347 42.2913 28.6183 42.6026 28.1102C42.914 27.6021 44.0946 28.3409 44.3652 27.81C44.6358 27.2791 43.3441 26.7582 43.5721 26.2077C43.8001 25.6572 45.082 26.202 45.266 25.6354C45.4501 25.0687 44.0929 24.7561 44.2319 24.1766C44.3708 23.5973 45.722 23.9352 45.8154 23.3466C45.9086 22.7581 44.5195 22.6617 44.5661 22.0678C44.6128 21.4739 46 21.5958 46 21C46 20.4042 44.6128 20.5263 44.5661 19.9324C44.5195 19.3383 45.9086 19.2421 45.8154 18.6536C45.722 18.065 44.3708 18.4029 44.2319 17.8234C44.0929 17.2439 45.4501 16.9315 45.266 16.3648C45.082 15.7981 43.8001 16.343 43.5721 15.7925C43.3441 15.242 44.6358 14.721 44.3652 14.1902C44.0946 13.6591 42.914 14.3981 42.6026 13.89C42.2913 13.3819 43.4853 12.6653 43.1352 12.1834C42.785 11.7012 41.7346 12.6155 41.3475 12.1624C40.9606 11.7094 42.028 10.8149 41.6066 10.3934C41.1851 9.97205 40.2906 11.0394 39.8376 10.6525C39.3845 10.2654 40.2988 9.21495 39.8168 8.8648C39.3347 8.51465 38.6181 9.70866 38.1102 9.39742C37.6023 9.08598 38.3409 7.9054 37.81 7.63481C37.279 7.36441 36.7582 8.65588 36.2075 8.42809C35.657 8.2001 36.2019 6.91817 35.6352 6.73415C35.0685 6.55012 34.7561 7.90715 34.1766 7.76806C33.5973 7.62936 33.935 6.27798 33.3466 6.1848ZM31 8.67553C34.4031 8.67553 37.4844 10.0551 39.7146 12.2854C41.9449 14.5158 43.3245 17.5969 43.3245 21C43.3245 24.4031 41.9449 27.4844 39.7146 29.7146C37.4844 31.9447 34.4031 33.3245 31 33.3245C27.5969 33.3245 24.5156 31.9447 22.2854 29.7146C20.0551 27.4844 18.6755 24.4031 18.6755 21C18.6755 17.5969 20.0551 14.5158 22.2854 12.2854C24.5156 10.0551 27.5969 8.67553 31 8.67553Z"
                                        fill="#FFFBF7" />
                                    <path
                                        d="M31.3245 9C34.7275 9 37.8088 10.3796 40.0391 12.6098C42.2694 14.8403 43.6489 17.9214 43.6489 21.3245C43.6489 24.7275 42.2694 27.8088 40.0391 30.0391C37.8088 32.2694 34.7275 33.6489 31.3245 33.6489C27.9214 33.6489 24.8401 32.2694 22.6098 30.0391C20.3796 27.8088 19 24.7275 19 21.3245C19 17.9214 20.3796 14.8403 22.6098 12.6098C24.8401 10.3796 27.9214 9 31.3245 9ZM38.9143 13.7346C36.9722 11.7922 34.2887 10.5908 31.3245 10.5908C28.3603 10.5908 25.6768 11.7922 23.7346 13.7346C21.7922 15.6768 20.5908 18.3603 20.5908 21.3245C20.5908 24.2885 21.7922 26.9722 23.7346 28.9143C25.6768 30.8565 28.3603 32.0581 31.3245 32.0581C34.2887 32.0581 36.9722 30.8565 38.9143 28.9143C40.8567 26.9722 42.0581 24.2885 42.0581 21.3245C42.0581 18.3603 40.8567 15.6768 38.9143 13.7346Z"
                                        fill="#FFFBF7" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M24.7192 32.389H37.281V55.3483L31.0001 45.5509L24.7192 55.3483V32.389Z"
                                        fill="#FFFBF7" />
                                    <path
                                        d="M31.0002 23.632C32.4539 23.632 33.6323 22.4536 33.6323 21C33.6323 19.5464 32.4539 18.3679 31.0002 18.3679C29.5466 18.3679 28.3682 19.5464 28.3682 21C28.3682 22.4536 29.5466 23.632 31.0002 23.632Z"
                                        fill="#FFFBF7" />
                                </svg>
                            </div>
                            <div class="ms-3 fw-bold" style="padding-top: 10px">
                                Grade<br>
                                <span class="icon-text-color">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 mb-2">
                <h5 class="fw-bold">Enrolled Courses</h5>
            </div>

            <div class="container mt-5">
                <div class="grid-container">

                    @foreach ($courses as $key => $course)
                        <div class="grid-item">
                            <a href="{{ url('student/test-overview/' . base64_encode($course->course_id)) }}">
                                <div class="card h-100">
                                    <div class="background-light card-body">
                                        <div class="text-center">
                                            {{-- <img src="{{ asset('assets/img/lang-icons/python.png') }} " width="50"
                                                height="50" alt="Python"> --}}
                                        </div>
                                        <div class="text-center fw-bold">
                                            {{ strtoupper($course->course_title) }}
                                        </div>
                                        <div class="row mt-4 col-12">
                                            <div class="col-6 ">
                                                <i class="bx text-info bx-archive"></i><label class="">Total
                                                    Tests</label>
                                                <br>
                                                <span class="ms-4 fw-bold">{{ $course_params[$key] }} Tests</span>
                                            </div>


                                            <div class="col-6 ">
                                                <i class="bx text-info bx-calendar"></i><label class="">Validity
                                                    From
                                                </label>
                                                <br>
                                                <span
                                                    class="ms-4 fw-bold">{{ date('d-m-Y', strtotime($course->validity_from)) }}</span>
                                            </div>

                                        </div>
                                        <div class="row mt-4 col-12">

                                            <div class="col-6">
                                                <i class="bx text-info bx-calendar"></i><label class="">Validity
                                                    To</label>
                                                <br>
                                                <span
                                                    class="ms-4 fw-bold">{{ date('d-m-Y', strtotime($course->validity_to)) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script></script>
