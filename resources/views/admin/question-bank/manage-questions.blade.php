@extends('layouts/contentNavbarLayout')

@section('title', $sub_heading)

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/css/datatable-bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
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
            white-space: initial !important;
        }
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
        <div class="row">
            <div class="mb-2 d-flex justify-content-between">
                <a href="{{ route('add-questions') }}"><i class='plus-icon bx bxs-plus-circle'></i></a>
                <a class="ml-auto" href="{{ route('upload-questions') }}"><button
                        class="btn background-info text-white">Import
                        Questions</button></a>
            </div>
        </div>

        <div class="card ">
            <div class="card-datatable text-nowrap">
                <table class="dt-column-search table table-striped display">
                    <thead class="background-secondary ">
                        <tr>
                            <th class="text-white">Question Code</th>
                            <th class="text-white">Skills</th>
                            <th class="text-white">Questions</th>
                            <th class="text-white">Difficulty</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

        {{-- pagenations --}}

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




    {{-- delete Modal --}}
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
                        <input type="hidden" name="del_question_code" id="del_question_code">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn background-info text-white" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                        <button type="button" onclick="deleteQuestion()"
                            class="btn background-secondary text-white">Delete</button>
                    </div>
                </form>
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


                var c = t.DataTable({
                    ajax: "{{ route('ajax-get-questions') }}",
                    columns: [{
                            data: "question_code",
                            orderable: false
                        },
                        {
                            data: "skill_name",
                            orderable: false
                        },
                        {
                            data: "questions",
                            orderable: false,
                            render: function(data, type, row) {
                                var val = truncateText(data, 30);
                                var html = $("<html>").append(val);
                                return html.text();
                            }
                        },
                        {
                            data: "difficulty_name",
                            orderable: false
                        },
                        {
                            data: "is_active",
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return `
                <label class="switch">
                    <input type="checkbox" ${data == 1 ? 'checked' : ''} onclick="statusChange('${row.question_code}',${data})" id="statusToggle">
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
                <a class="icon-buttons "  onclick="viewQuestion('${row.question_code}')">
                    <i class="bx bx-show-alt"></i>
                </a>
                
                <a class="icon-buttons text-black" href="{{ url('/admin/question-bank/edit-questions/${d}') }}">
                <i class="bx bx-edit-alt"></i>
            </a>


                <a onclick="openDeleteModal('${row.question_code}')" class="text-black icon-buttons">
                    <i class="bx bxs-trash"></i>
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

        $(document).ready(() => {
            setTimeout(() => {
                $("input[type='search']").addClass("form-control");
                var targetElement = $('select[name="DataTables_Table_0_length"]');
                targetElement.addClass('form-control');
            }, 5);


        });


        function truncateTextInTable(maxWords) {
            var truncateElements = $(".truncate-text");
            truncateElements.each(function(element) {
                var words = element.textContent.trim().split(' ');
                if (words.length > maxWords) {
                    var truncatedText = words.slice(0, maxWords).join(' ') + '...';
                    element.textContent = truncatedText;
                }
            });
        }
        truncateTextInTable(20);

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

        function statusChange(question_code, data) {
            if (data == 1) {
                is_active = 2;
            } else {
                is_active = 1;
            }
            $.ajax({
                type: 'POST',
                url: '{{ route('questions-status') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'question_code': question_code,
                    'is_active': is_active,
                },
            });
        }

        function openDeleteModal(value) {
            $("#del_question_code").val(value);
            $("#deleteModal").modal('show');
        }


        function deleteQuestion() {
            var question_code = $("#del_question_code").val();
            $.ajax({
                url: '{{ route('delete-question') }}',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'question_code': question_code,
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    location.reload();
                }
            });
        }
    </script>


@endsection
