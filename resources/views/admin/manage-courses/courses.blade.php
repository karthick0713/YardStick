@extends('layouts/contentNavbarLayout')

@section('title', 'Manage Test')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatable-bootstrap5.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('assets/js/datatable-bootstrap5.js') }}"></script>
@endsection

@section('content')
    <div class="container mt-4">
        @if (session('error'))
            <div class="error-message col-md-5">
                <div class="alert bg-danger text-white fw-bold">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="success-message col-md-5">
                <div class="alert bg-success text-white fw-bold">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="mb-2">
            {{-- Add test buttons --}}
            <a href="{{ route('create-new-course') }}"><button class=" btn background-info text-white">Create
                    Courses
                </button></a>

        </div>
        <div class="card ">

            {{-- list of created tests --}}
            <div class="table-responsive  text-nowrap">
                <table id="example" class="table table-striped dt-column-search">
                    <thead>
                        <tr class="background-secondary">
                            <th scope="col" class="text-white text-center">Course Name</th>
                            <th scope="col" class="text-white text-center"> Validate From</th>
                            <th scope="col" class="text-white text-center"> Validate To</th>
                            <th scope="col" class="text-white text-center">Total Colleges</th>
                            <th scope="col" class="text-white text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        {{-- pagenations --}}
        <div class="pagination-flex-container justify-content-end mt-5" id="pagination">
            <button class="page-link btn-sm" id="previous" disabled>Previous</button>
            <div id="page-numbers" class="pagination-flex-container"></div>
            <button class="page-link btn-sm" id="next">Next</button>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            t = $(".dt-column-search");

            if (t.length) {
                $(".dt-column-search thead tr")
                    .clone(!0)
                    .appendTo(".dt-column-search thead"),
                    $(".dt-column-search thead tr:eq(1) th").each(function(a) {
                        var t = $(this).text();
                        $(this).html(
                                '<input type="text" class="form-control" placeholder="Search ' +
                                t +
                                '" />'
                            ),
                            $("input", this).on("keyup change", function() {
                                c.column(a).search() !== this.value &&
                                    c.column(a).search(this.value).draw();
                            });
                    });


                var c = t.DataTable({
                    ajax: "{{ route('get-course-details') }}",
                    columns: [{
                            data: "course_title",
                            orderable: false,
                            render: function(data, type, row) {
                                return data.toUpperCase();
                            }
                        },
                        {
                            data: "validity_from",
                            orderable: false,
                            render: function(data, type, row) {
                                var dateObject = new Date(data);
                                var options = {
                                    weekday: 'long',
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                };
                                return dateObject.toLocaleDateString('en-US', options);
                            }
                        },
                        {
                            data: "validity_to",
                            orderable: false,
                            render: function(data, type, row) {
                                var dateObject = new Date(data);
                                var options = {
                                    weekday: 'long',
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                };
                                return dateObject.toLocaleDateString('en-US', options);
                            }
                        },
                        {
                            data: "total_colleges",
                            orderable: false,
                            render: function(data, type, row) {
                                return data + ' COLLEGES';
                            }
                        },

                        {
                            data: "course_id",
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                var d = row.question_code;
                                return `
                                <div class=''>
                    <a class="icon-buttons"  onclick="openViewModal('${row.test_code}')">
                        <i class="bx bx-show-alt"></i>
                    </a>
                    </div>
                `;
                            },
                        },
                    ],

                    orderCellsTop: !0,
                    dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                });

                $(".dt-column-search tbody").on({
                    mouseenter: function() {
                        $(this).data("originalContent", $(this).text());
                        var orig = $(this).text($(this).text() + "📋");
                        $(this).css("cursor", "pointer");
                    },
                    mouseleave: function() {
                        $(this).text($(this).data("originalContent"));
                        $(this).css("cursor", "pointer");
                    },
                    click: function() {
                        var contentToCopy = $(this).data("originalContent");
                        var tempInput = $("<input>");
                        $("body").append(tempInput);
                        tempInput.val(contentToCopy).select();
                        document.execCommand("copy");
                        tempInput.remove();
                        $(this).text(contentToCopy + "✅");
                        setTimeout(function() {
                            $(this).text(contentToCopy);
                        }.bind(this), 2000);
                    },
                }, "td:first-child");
            }



        });

        $(document).ready(function() {
            $(".success-message").fadeIn().delay(3000).fadeOut();
            $(".error-message").fadeIn().delay(3000).fadeOut();
        })
    </script>


@endsection
