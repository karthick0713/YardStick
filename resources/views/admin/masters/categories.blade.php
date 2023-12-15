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

    </style>


    <div class="container mt-4">
        @if (session('success'))
            <div class="success-message col-md-5">
                <div class="alert bg-success text-white fw-bold">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="error-message col-md-5">
                <div class="alert bg-danger text-white fw-bold">
                    <ul>
                        @foreach (session('error') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="mb-2">
            <a data-bs-toggle="modal" data-bs-target="#add_category" class="button-plus-icon"><i
                    class='plus-icon bx bxs-plus-circle'></i></a>
        </div>
        <div class="card col-md-5">
            {{-- list of difficulties table --}}
            <div style="margin:10px" class="table-responsive  text-nowrap">
                <table class="dt-column-search table table-striped display">
                    <thead>
                        <tr class="background-secondary">
                            <th scope="col" class="text-white text-center">Category Name</th>
                            <th scope="col" class="text-white text-center">Status</th>
                            <th scope="col" class="text-white text-center">Actions</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

    {{-- add new category modal --}}

    <div class="modal fade" id="add_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="input-form">
                    @csrf
                    <div class="modal-body">
                        <div class="row col-12">
                            <div class="row">
                                <div class=" mb-3">
                                    <label for="category-name" class="col-form-label">Category Name:</label>
                                    <input type="text" class="form-control" name="category" id="category-add" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn text-white background-secondary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- edit Modal --}}


    <div class="modal fade" id="edit_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit-form" onsubmit="return updateCategory()">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class=" mb-3">
                                <label for="category" class="col-form-label">Category:</label>
                                <input type="text" class="form-control" id="category-edit" required>
                                <input type="hidden" class="form-control" id="category_id">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        <button type="button" onclick="updateCategory()"
                            class="btn text-white background-secondary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- delete modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                    </div>
                    <h4 class="modal-title">Are you sure?</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form onsubmit="return deleteCategory()">
                    <div class="modal-body">
                        <p>Do You Want to Delete this Record ?</p>
                        <input type="hidden" name="" id="category_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn background-info text-white" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                        <button type="button" onclick="deleteCategory()"
                            class="btn background-secondary text-white">Delete</button>
                    </div>
                </form>
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
                    ajax: "{{ route('ajax-get-categories') }}",
                    columns: [{
                            data: "category_name",
                            orderable: false
                        },
                        {
                            data: "is_active",
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return `
                                <div class="text-center">
                            <label class="switch">
                                <input type="checkbox" ${data == 1 ? 'checked' : ''} ${row.category_id == 1 ? 'disabled' : ''}  onclick="statusChange('${row.category_id}',${data})" id="statusToggle">
                                <span class="slider round"></span>
                            </label>
                        </div>
                                `;
                            },
                        },
                        {
                            data: "category_id",
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                var d = row.category_id;
                                return `
                                <div class="text-center">
                                    <a class="icon-buttons" onclick="openEditModal(${row.category_id})">
                            <i class="bx bx-edit-alt"></i>
                        </a>
                            <a onclick="openDeleteModal('${row.category_id}')" class="text-black icon-buttons">
                                <i class="bx bxs-trash"></i>
                            </a>
                        </div>
                                `;
                            },
                        },
                    ],

                    order: [
                        [2, 'asc']
                    ],
                    orderCellsTop: true,
                    dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                });

            }
        })


        $(document).ready(function() {
            $('#input-form').submit(function(event) {
                event.preventDefault();
                var category = $("#category-add").val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('category-add') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'category': category,
                    },
                    success: function(response) {
                        localStorage.setItem('response', response.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            location.reload();
                        } else {
                            location.reload();
                        }
                    }
                });
            });

            $(".success-message").fadeIn().delay(3000).fadeOut();
            $(".error-message").fadeIn().delay(3000).fadeOut();
        });

        function statusChange(value, status) {
            if (value == 1) {
                alert('You are not allowed to edit this category');
            } else {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('category-status') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'value': value,
                    },
                });
            }
        }

        function openEditModal(id) {
            if (id == 1) {
                alert('You are not allowed to edit this category');
            } else {
                var datas = @json($data);
                $.each(datas, function(key, value) {
                    if (value.category_id == id) {
                        $("#category-edit").val(value.category_name);
                        $("#category_id").val(value.category_id);
                    }
                });
                $('#edit_category').modal('show');
            }

        }

        function updateCategory() {
            var category = $("#category-edit").val();
            var id = $("#category_id").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('category-update') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'category': category,
                    'id': id,
                },
                success: function(response) {
                    localStorage.setItem('response', response.message);
                    location.reload();
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        location.reload();
                    } else {
                        location.reload();
                    }
                }
            });
        }

        function openDeleteModal(id) {
            if (id == 1) {
                alert('You are not allowed to edit this category');
            } else {
                var datas = @json($data);
                $.each(datas, function(key, value) {
                    if (value.category_id == id) {
                        $("#category_id").val(value.category_id);
                    }
                });
                $('#deleteModal').modal('show');
            }
        }

        function deleteCategory() {
            var id = $("#category_id").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('category-delete') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id,
                },
                success: function(response) {
                    localStorage.setItem('response', response.message);
                    location.reload();
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        location.reload();
                    } else {
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection
