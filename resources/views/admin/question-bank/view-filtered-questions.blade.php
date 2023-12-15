@extends('layouts/contentNavbarLayout')

@section('title', $sub_heading)

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
        th,
        td {
            width: 15%;
            padding: 8px;
            text-align: left;
        }

        table {
            /* white-space: initial !important; */
        }
    </style>

    <div class="container mt-4">

        <div class="card ">
            <div class="card-datatable text-nowrap">
                <table class="dt-column-search table table-striped display">
                    <thead class="background-secondary ">
                        <tr>
                            <th class="text-white">Question Code</th>
                            <th class="text-white">Questions</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- view questions modal --}}


    <div class="modal fade" id="viewQuestion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content modal-contents">
                <div class="modal-header">
                    <h5 class="modal-title emphasized-title" id="exampleModalLabel">View Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="question-details">
                        {{--  --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {

            function truncateText(text, maxWords) {
                var words = text.split(' ');
                if (words.length > maxWords) {
                    return words.slice(0, maxWords).join(' ') + '...';
                }
                return text;
            }

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


                var difficulties = "{{ $data['difficulties'] }}";
                var categories = "{{ $data['categories'] }}";
                var topics = "{{ $data['topics'] }}";
                var skills = "{{ $data['skills'] }}";

                var c = t.DataTable({
                    ajax: {
                        url: "{{ route('get-filtered-questions') }}",
                        type: "GET",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: function(d) {
                            d.difficulties = difficulties;
                            d.categories = categories;
                            d.topics = topics;
                            d.skills = skills;
                        }
                    },
                    columns: [{
                            data: "question_code",
                            orderable: false
                        },

                        {
                            data: "questions",
                            orderable: false,
                            render: function(data, type, row) {
                                var val = truncateText(data, 20);
                                var html = $("<html>").append(val);
                                return html.text();
                            }
                        },

                        {
                            data: "is_active",
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return `
                                        <label class="switch">
                                            <input type="checkbox" ${data == 1 ? 'checked' : ''} disabled id="statusToggle">
                                            <span class="slider round"></span>
                                        </label>
                                    `;
                            },
                        },
                        {
                            data: "question_code",
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                var d = row.question_code;
                                return `
                                            <a class="icon-buttons text-center"  onclick="viewQuestion('${row.question_code}')">
                                                <i class="bx bx-show-alt"></i>
                                            </a>
                                            
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


            $(".success-message").fadeIn().delay(3000).fadeOut();
            $(".error-message").fadeIn().delay(3000).fadeOut();
        });

        function viewQuestion(value) {
            $(".question-details").empty();
            $.ajax({
                type: "GET",
                url: "{{ route('view-detailed-questions') }}",
                data: {
                    value: value
                },
                success: (data) => {
                    $(".question-details").append(data);
                    $("#viewQuestion").modal('show');
                },
                error: (xhr) => {
                    console.log(xhr);
                }
            });

        }
    </script>

@endsection
