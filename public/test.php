@extends('layouts/contentNavbarLayout')

@section('title', $sub_heading)

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
<script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ asset('assets/js/jquery-repeater.js') }}"></script>
<script src="{{ asset('assets/js/forms-extras.js') }}"></script>
{{-- <script src="{{ asset('assets/quill/katex.js') }}"></script> --}}

@endsection

@section('content')

<style>
.fw-bold p {
    font-weight: normal !important;
}

table {
    border-collapse: unset !important;
}

select {
    background-image: url('{{ asset('assets/img/icons/down-arrow.png') }}');
    background-repeat: no-repeat;
    background-position-x: 98%;
    background-position-y: center;
    padding-right: 20px;
}

select.open {
    background-image: url('{{ asset('assets/img/icons/up-arrow.png') }}');
}

.programming {
    display: none;
}

.mcq {
    display: none;
}

input[type="checkbox"] {
    width: 35px;
    height: 38px;
    margin-right: 8px;
    border: none;
    outline: none;
}

select,
input {
    margin: 10px 0 10px 0;
    height: 45px;
    border-radius: 0% !important;
}

textarea {
    margin: 10px 0 10px 0;
    border-radius: 0% !important;
}

.copy-container {
    position: relative;
}

.copy-button {
    position: absolute;
    right: 0;
    top: 0;
    padding: 8px;
    cursor: pointer;
    background-color: #4caf50;
    color: #fff;
    border: none;
    border-radius: 4px;
}

.copy-success {
    color: #4caf50;
    margin-top: 5px;
}

.question-error-message,
.solution-error-message {
    display: none;
    color: red;
}
</style>
<div class=" container mt-4">
    <div class=" card-body">
        {{-- select fields to add new questions --}}
        <form action="{{ route('save-questions') }}" method="POST">
            @csrf
            <div class="  col-12 fw-bold">
                <div class="row">
                    <div class="col-6 mb-1">
                        <label for="skills">Skills :</label>
                        <select name="skill" class="form-control" id="skills" onchange="get_topics(this.value)"
                            required>
                            <option value="0" selected disabled>SELECT</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="difficulties">Difficulty :</label>
                        <select name="difficulty" class="custom-select my-select form-control" id="difficulties"
                            required>
                            <option value="" selected disabled>SELECT</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="topics">Topics :</label>
                        <select name="topic" class="custom-select my-select form-control" id="topics" required>
                            <option value="" selected disabled>SELECT</option>
                        </select>
                    </div>

                    <div class="col-6 mb-1">
                        <label for="category">Category :</label>
                        <select name="category" class="custom-select my-select form-control" id="category" disabled
                            onchange="switchCategory(this.value)" required>
                            @foreach ($categories as $cat)
                            <option value="{{ $cat->category_id }}"
                                {{ $cat->category_id == $questions->category ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6 mb-1 marks">
                        <label for="category">Marks :</label>
                        <input type="text" name="marks" class="form-control" id="marks" placeholder=" Marks"
                            value="{{ $questions->marks }}"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 2)">
                    </div>

                </div>

                {{-- add fields for PROGRAMMING category  --}}

                @if ($questions->category == 1)
                <div class="row">
                    <div class="mt-2">
                        <label for="programming-questions">Question :</label>
                        <div id="question-editor" onkeyup="get_programming_value(this)" class="rice-text-area"
                            style="height: 250px;background-color:white">
                        </div>
                        <input type="hidden" name="programming_question" class="full-editor-value">
                    </div>
                </div>
                <div class="mt-2">
                    <label for="solution">Solution :</label>
                    <div id="solution-editor" class="rice-text-area" onkeyup="get_programming_value(this)"
                        style="height: 250px;background-color:white">
                    </div>
                    <input type="hidden" name="programming_solution" class="full-editor-value">
                </div>
                <div class="mx-auto d-flex justify-content-end mt-4">

                </div>


                {{-- title, descriptions for add example,hints etc... --}}

                <div class="col-12">
                    <div class="card">
                        {{-- <h5 class="card-header">Form Repeater</h5> --}}
                        <div class=" card-body">
                            <div class="form-repeater">
                                <div data-repeater-list="group-a">
                                    <div data-repeater-item class="groups_a">
                                        <div class="row">
                                            <div class=" mb-3 col-lg-5  mb-0">
                                                <label class="form-label fw-bold" for="form-repeater-1-1">Title</label>

                                                <div class="d-flex align-items-center">
                                                    <input type="text" class="d-flex align-items-center form-control"
                                                        placeholder="Enter Title" name="question_sub_title"
                                                        id="form-repeater-1-1">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-5  mb-0">
                                                <label class="form-label fw-bold"
                                                    for="form-repeater-1-2">Description</label>
                                                <div class="rice-text" onkeyup="get_desc_value(this)"
                                                    style="height: 80px;background-color:white">
                                                    <div class="quill-editor" id="quill-editor-1"></div>
                                                </div>
                                                <input type="hidden" name="question_sub_description"
                                                    class="question-sub-description" id="">

                                            </div>
                                            <div class=" col-lg-2 ">
                                                <button type="button" style="margin-top:30px"
                                                    class="btn background-info text-white " data-repeater-delete>
                                                    -
                                                </button>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <hr>
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <button type="button" class="btn background-secondary text-white"
                                        onclick="add_quill()" data-repeater-create>
                                        <i class="bx bx-plus me-1"></i>
                                        <span class="align-middle">Add</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @else
            {{-- add fields for MCQ category  --}}

            <div class="mt-2">
                <label for="mcq-questions">Question :</label>
                <div style="height: 100px;width:100%">
                    <div class="question-options" onkeyup="get_value(this)" style="background-color:white"></div>
                </div>
                <input type="hidden" name="mcq_question" id="mcq-question">
            </div>
            <pre>


</pre>
            <label for="" class="">( Click the Checkbox which has Correct Answer. )</label>
            <div class="mt-2">
                <label for="">Option A :</label>
                <div class="d-flex">
                    <input type="checkbox" name="correct_option" value="a"
                        class="checkbox flex-column align-items-center" onclick="toggleCheck(this)" id="">

                    <div style="height: 100px;width:100%">
                        <div class="question-options" onkeyup="get_value(this)" style="background-color:white">
                        </div>
                    </div>
                    <input type="hidden" name="opt_answer_a" id="opt_answer_1">
                </div>
            </div>
            <pre>


                    </pre>
            <div class="mt-2">
                <label for="">Option B :</label>
                <div class="d-flex">
                    <input type="checkbox" name="correct_option" value="b"
                        class="checkbox flex-column align-items-center" onclick="toggleCheck(this)" id="">
                    <div style="height: 100px;width:100%">
                        <div class="question-options" onkeyup="get_value(this)" style="background-color:white">
                        </div>
                    </div>
                    <input type="hidden" name="opt_answer_b" id="opt_answer_2">
                </div>
            </div>
            <pre>


                    </pre>

            <div class="mt-2">
                <label for="">Option C :</label>
                <div class="d-flex">
                    <input type="checkbox" name="correct_option" value="c"
                        class="checkbox flex-column align-items-center" onclick="toggleCheck(this)" id="">
                    <div style="height:100px;width:100%">
                        <div class="question-options" onkeyup="get_value(this)" style="background-color:white">
                        </div>
                    </div>
                    <input type="hidden" name="opt_answer_c" id="opt_answer_3">
                </div>
            </div>
            <pre>


                    </pre>
            <div class="mt-2">
                <label for="">Option D :</label>
                <div class="d-flex">
                    <input type="checkbox" name="correct_option" value="d"
                        class="checkbox flex-column align-items-center" onclick="toggleCheck(this)" id="">
                    <div style="height: 100px;width:100%">
                        <div class="question-options" onkeyup="get_value(this)" style="background-color:white">
                        </div>
                    </div>
                    <input type="hidden" name="opt_answer_d" id="opt_answer_4">

                </div>
            </div>
            @endif






            <br>
            <div class="mt-4 d-flex justify-content-end">
                <button type="button" class="btn background-secondary text-white"
                    onclick="validation_check()">Submit</button>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('assets/quill/quill.js') }}"></script>

<script>
$(document).ready(() => {
    get_skills();
    get_difficulties();
    get_topics('{{ $questions->skills_id }}');
    if ({
            {
                $questions - > category
            }
        } == 2) {
        $("#marks").prop({
            readonly: true,
            required: true
        });
    }
    $(".success-message").fadeIn().delay(3000).fadeOut();
    $(".error-message").fadeIn().delay(3000).fadeOut();

    var categories_of = {
        {
            $questions - > category
        }
    };

    if (categories_of == 1) {
        let question =
            <?= json_encode($questions->questions, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?>;

        let solutions =
            <?= json_encode($questions->solutions, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?>;
        $("#question-editor").children().html(question);
        $("#solution-editor").children().html(solutions);

    }
});


var question_detail = @json($question_detail);
setTimeout(() => {
    $(".groups_a").first().hide();
    for (var i = 1; i < question_detail.length; i++) {
        $('[data-repeater-create]').trigger('click');
        var newItem = $('.groups_a:last');
        var quillCount = $('.quill-editor').length;
        var newQuillId = 'quill-editor-' + (quillCount + 1);
        var newHiddenInputId = 'question_sub_description_' + (quillCount + 1);
        newItem.find('.quill-editor').attr('id', newQuillId);
        newItem.find('.question-sub-description').attr('id', newHiddenInputId);
        newItem.find('.ql-toolbar').remove();
        newItem.appendTo('[data-repeater-list="group-a"]');
        new Quill('#' + newQuillId, {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        'font': []
                    }, {
                        'size': []
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    [{
                        'script': 'super'
                    }, {
                        'script': 'sub'
                    }],
                    [{
                        'header': '1'
                    }, {
                        'header': '2'
                    }, 'blockquote', 'code-block'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }, {
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    [{
                        'direction': 'rtl'
                    }],
                    ['link', 'image', 'video'],
                    ['clean']
                ],
            }
        });

        $('#' + newQuillId).children().html(question_detail[i]['description']);
        $("input[name='group-a[" + i + "][question_sub_title]']").val(question_detail[i]['title_name']);
    }
}, 500);

function get_programming_value(element) {
    var quillContent = $(element).find('.ql-editor').html();
    var edit_value = $(element).parent().find('input[type="hidden"]');
    edit_value.val(quillContent);
}


var quillEditors = document.querySelectorAll('.question-options');
quillEditors.forEach(function(editor, index) {
    new Quill(editor, {
        theme: 'snow',
        modules: {
            toolbar: [
                [{
                    'font': []
                }, {
                    'size': []
                }],
                ['bold', 'italic', 'underline', 'strike'],
                [{
                    'color': []
                }, {
                    'background': []
                }],
                [{
                    'script': 'super'
                }, {
                    'script': 'sub'
                }],
                [{
                    'header': '1'
                }, {
                    'header': '2'
                }, 'blockquote', 'code-block'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }, {
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }],
                [{
                    'direction': 'rtl'
                }],
                ['link', 'image', 'video'],
                ['clean']
            ],
        }
    });


});

function get_value(element) {
    var quillContent = $(element).find('.ql-editor').html();
    var edit_value = $(element).parent().parent().find('input[type="hidden"]');
    edit_value.val(quillContent);
}


var quillFullEditor = new Quill("#question-editor", {
    theme: "snow",
    modules: {
        toolbar: [
            [{
                'font': []
            }, {
                'size': []
            }],
            ['bold', 'italic', 'underline', 'strike'],
            [{
                'color': []
            }, {
                'background': []
            }],
            [{
                'script': 'super'
            }, {
                'script': 'sub'
            }],
            [{
                'header': '1'
            }, {
                'header': '2'
            }, 'blockquote', 'code-block'],
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }, {
                'indent': '-1'
            }, {
                'indent': '+1'
            }],
            [{
                'direction': 'rtl'
            }],
            ['link', 'image', 'video'],
            ['clean']
        ],
    }
});

var quillSolutionEditor = new Quill("#solution-editor", {
    theme: "snow",
    modules: {
        toolbar: [
            [{
                'font': []
            }, {
                'size': []
            }],
            ['bold', 'italic', 'underline', 'strike'],
            [{
                'color': []
            }, {
                'background': []
            }],
            [{
                'script': 'super'
            }, {
                'script': 'sub'
            }],
            [{
                'header': '1'
            }, {
                'header': '2'
            }, 'blockquote', 'code-block'],
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }, {
                'indent': '-1'
            }, {
                'indent': '+1'
            }],
            [{
                'direction': 'rtl'
            }],
            ['link', 'image', 'video'],
            ['clean']
        ],
    }
});

function get_desc_value(element) {
    var quillContent = $(element).find('.ql-editor').html();
    $(element).parent().find('.question-sub-description').val(quillContent);
}


var descEditor = new Quill("#quill-editor-1", {
    'theme': 'snow',
    modules: {
        toolbar: [
            [{
                'font': []
            }, {
                'size': []
            }],
            ['bold', 'italic', 'underline', 'strike'],
            [{
                'color': []
            }, {
                'background': []
            }],
            [{
                'script': 'super'
            }, {
                'script': 'sub'
            }],
            [{
                'header': '1'
            }, {
                'header': '2'
            }, 'blockquote', 'code-block'],
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }, {
                'indent': '-1'
            }, {
                'indent': '+1'
            }],
            [{
                'direction': 'rtl'
            }],
            ['link', 'image', 'video'],
            ['clean']
        ],
    }
})

function add_quill() {
    setTimeout(() => {
        var newItem = $('.groups_a:last');
        var quillCount = $('.quill-editor').length;
        var newQuillId = 'quill-editor-' + (quillCount + 1);
        var newHiddenInputId = 'question_sub_description_' + (quillCount + 1);
        newItem.find('.quill-editor').attr('id', newQuillId);
        newItem.find('.question-sub-description').attr('id', newHiddenInputId);
        newItem.find('.ql-toolbar').remove();
        newItem.appendTo('[data-repeater-list="group-a"]');
        new Quill('#' + newQuillId, {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        'font': []
                    }, {
                        'size': []
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    [{
                        'script': 'super'
                    }, {
                        'script': 'sub'
                    }],
                    [{
                        'header': '1'
                    }, {
                        'header': '2'
                    }, 'blockquote', 'code-block'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }, {
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    [{
                        'direction': 'rtl'
                    }],
                    ['link', 'image', 'video'],
                    ['clean']
                ],
            }
        });
    }, 500);
}

function get_skills() {
    $.ajax({
        url: "{{ route('ajax-get-skills') }}",
        type: "GET",
        dataType: "json",
        success: function(data) {
            var html = '<option value=""  disabled>SELECT</option>';
            var i;
            for (i = 0; i < data.length; i++) {
                html += '<option value="' + data[i].skill_id + '"  ' + (data[i].skill_id === {
                        {
                            $questions - > skills_id
                        }
                    } ? 'selected' : '') + '>' + data[i].skill_name +
                    '</option>';
            }
            $('#skills').html(html);
        },
        error: function(data) {
            console.log('Error:', data);
        }
    })
}

function get_difficulties() {
    $.ajax({
        url: "{{ route('ajax-get-difficulties') }}",
        type: "GET",
        dataType: "json",
        success: function(data) {
            var html = '<option value=""  disabled>SELECT</option>';
            var i;
            for (i = 0; i < data.length; i++) {
                html += '<option value="' + data[i].difficulty_id + '"  ' + (data[i].difficulty_id == {
                        {
                            $questions - > difficulties_id
                        }
                    } ? 'selected' : '') + ' >' + data[i]
                    .difficulty_name +
                    '</option>';
            }
            $('#difficulties').html(html);
        },
        error: function(data) {
            console.log('Error:', data);
        }
    })
}

function get_topics(value) {

    $.ajax({
        url: "{{ route('ajax-get-topics') }}",
        type: "GET",
        dataType: "json",
        data: {
            skill_id: value
        },

        success: function(data) {
            var html = '<option value=""  disabled>SELECT</option>';
            var i;
            for (i = 0; i < data.length; i++) {
                html += '<option value="' + data[i].topic_id + '"  ' + (data[i].topic_id === {
                        {
                            $questions - > topics_id
                        }
                    } ? 'selected' : '') + '>' + data[i].topic_name +
                    '</option>';
            }
            $('#topics').html(html);
        },
        error: function(data) {
            console.log('Error:', data);
        }
    })
}

function switchCategory(value) {
    if (value == 1) {
        $(".programming").show();
        $("#marks").val('');
        $("#marks").prop('readonly', false);
        $(".mcq").hide();
    } else {
        $(".programming").hide();
        $("#marks").val(1);
        $("#marks").prop('readonly', true);
        $(".mcq").show();
    }
}

function toggleCheck(checkbox) {
    var checkboxes = document.getElementsByClassName('checkbox');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] !== checkbox) {
            checkboxes[i].checked = false;
        }
    }
}

function validation_check() {
    var category = $("#category").val();
    if (category != 1) {
        var valid = false;
        if ($('input[type="checkbox"]:checked').length > 0) {
            valid = true;
        } else {
            alert("Please check the correct answer checkbox !");
        }
        if (valid) {
            $('form').submit();
        }
    } else if (category == 1) {
        var scrollPosition = $(window).scrollTop();
        var valid = false;
        var programming_question = $("#programming-questions").val();
        var solution = $("#solution").val();
        if (programming_question == "") {
            valid = false;
            $(".question-error-message").show().fadeIn().delay(3000).fadeOut();
            $('html, body').animate({
                scrollTop: $("#programming-questions").offset().top
            }, 100);
            return false;
        } else if (solution == "") {
            valid = false;
            $(".solution-error-message").show().fadeIn().delay(3000).fadeOut();
            $('html, body').animate({
                scrollTop: $("#solution").offset().top
            }, 100);
            return false;
        } else {
            $('form').submit();
        }

        return false;
    }
}
</script>

@endsection