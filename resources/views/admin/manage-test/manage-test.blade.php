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


    <style>

    </style>

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
            <a href="{{ route('create-new-test') }}"><button class=" btn background-info text-white">Create
                    Test
                </button></a>

        </div>
        <div class="card ">

            {{-- list of created tests --}}
            <div class="table-responsive  text-nowrap">
                <table id="example" class="table table-striped dt-column-search">
                    <thead>
                        <tr class="background-secondary">
                            <th scope="col" class="text-white text-center">Test Name</th>
                            <th scope="col" class="text-white text-center">No Of Sections</th>
                            <th scope="col" class="text-white text-center">No of Questions</th>
                            <th scope="col" class="text-white text-center">Total Duration</th>
                            <th scope="col" class="text-white text-center">Test Type</th>
                            <th scope="col" class="text-white text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- View test details --}}
    <div class="modal fade modal-fullscreen" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Test Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="test-modal">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(() => {

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
                        ajax: "{{ route('get-test-details') }}",
                        columns: [{
                                data: "title",
                                orderable: false,
                            },
                            {
                                data: "section_count",
                                orderable: false,
                                render: function(data, type, row) {
                                    return data + ' SECTIONS';
                                }
                            },
                            {
                                data: "total_questions",
                                orderable: false,
                                render: function(data, type, row) {
                                    return data + ' QUESTIONS';
                                }
                            },
                            {
                                data: "total_duration",
                                orderable: false,
                                render: function(data, type, row) {
                                    return data + ' MINUTES';
                                }
                            },
                            {
                                data: "test_type",
                                orderable: false,
                                render: function(data, type, row) {
                                    if (data == 1) {
                                        return "SELECTED QUESTIONS"
                                    } else {
                                        return "RANDOM QUESTIONS"
                                    }
                                }
                            },
                            {
                                data: "test_id",
                                orderable: false,
                                searchable: false,
                                render: function(data, type, row) {
                                    var d = row.test_code;
                                    return `
                                <div class='text-center'>

                    <a class="icon-buttons text-black" href="{{ url('/admin/edit-test/${btoa(d)}') }}">
                <i class="bx bx-edit-alt"></i>

                
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

                }


                $(".success-message").fadeIn().delay(3000).fadeOut();
                $(".error-message").fadeIn().delay(3000).fadeOut();
            });

            function openViewModal(test_code) {
                $(".test-modal").empty();
                $.ajax({
                    url: "{{ route('get-detailed-question-view') }}",
                    type: "GET",
                    data: {
                        test_code: test_code
                    },
                    success: (response) => {
                        $(".test-modal").append(response);
                        $("#viewModal").modal("show");
                    },
                    error: (xhr) => {
                        alert('Something went wrong..!');
                    }
                });
            }
        </script>

    @endsection
