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

    </div>


    <div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                    </div>
                    <h4 class="modal-title">Result Details</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body" id="reportmodal">

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                    </div>
                    <h4 class="modal-title">Are you sure?</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form action="" method="">
                    <div class="modal-body">
                        <p>Do You Want to Delete this Record ?</p>
                        <input type="hidden" name="del_course_id" id="del_course_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn background-info text-white" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                        <button type="button" onclick="deleteCourse()"
                            class="btn background-secondary text-white">Delete</button>
                    </div>
                </form>
            </div>
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
                                var d = row.course_id;
                                return `
                                <div class='text-center'>

                        <a type="button" onclick="courseModal(${d})"> 
                <i class="bx bx-show-alt"></i> </a>

                    <a class="icon-buttons text-black" href="{{ url('/admin/edit-course/${btoa(d)}') }}">
                <i class="bx bx-edit-alt"></i>
                </a>

                
                <a onclick="openDeleteModal('${d}')" class="text-black icon-buttons">
                    <i class="bx bxs-trash"></i>
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

        function openDeleteModal(value) {
            $("#del_course_id").val(value);
            $("#deleteModal").modal('show');
        }


        $(document).ready(function() {
            $(".success-message").fadeIn().delay(3000).fadeOut();
            $(".error-message").fadeIn().delay(3000).fadeOut();
        })


        function deleteCourse() {
            var course_id = $("#del_course_id").val();
            $.ajax({
                url: '{{ route('delete-course') }}',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'course_id': course_id,
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    location.reload();
                }
            });
        }


        function courseModal(val) {

            $("#reportmodal").empty();
            $.ajax({
                url: '{{ route('course-detail') }}',
                type: 'GET',
                data: {
                    course_id: val
                },
                success: function(data) {
                    $("#reportmodal").append(data);
                    $("#courseModal").modal('show');
                }
            })

        }

        function download_report() {
            var college = $('#colleges').val() || '';
            var department = $('#department').val() || '';
            var year = $('#year').val() || '';
            var groups = $('#groups').val() || '';
            var test_code = $('#test_code').val() || '';
            var course_id = $('#course_id').val() || '';


            if (!college || !department || !year) {
                alert('Please select college, department, and year.');
                return;
            }

            let url = "{{ route('report-download') }}" +
                `?college=${college}&department=${department}&year=${year}&groups=${groups}&course_id=${course_id}&test_code=${test_code}`;

            window.open(url);

        }
    </script>


@endsection
