<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;
use Yajra\DataTables\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;

class QuestionBankController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Kolkata");
    }

    function generate_random_code()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $code = '';

        do {
            $code = '';
            for ($i = 0; $i <= 20; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }
        } while ($this->check_existing_code($code));

        return $code;
    }

    function check_existing_code($code)
    {
        $existingCode = DB::table('question_banks')->where('question_code', $code)->exists();
        return $existingCode;
    }

    public function manageQuestions()
    {
        $heading = "Questions Banks";
        $sub_heading = "Manage Questions";
        return view("admin.question-bank.manage-questions", compact("heading", 'sub_heading'));
    }

    public function addQuestions()
    {
        $categories = DB::table('master_categories')->where('is_active', 1)->where('trash_key', 1)->get();
        $heading = "Questions Banks";
        $sub_heading = "Add Questions";
        return view("admin.question-bank.add-questions", compact("heading", 'sub_heading', 'categories'));
    }

    public function save_questions(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'skill' => 'required',
            'difficulty' => 'required',
            'topic' => 'required',
            'category' => 'required',
            'marks' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error', __('An error has occurred'));
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $randomCode = $this->generate_random_code();
        $data = array(
            'question_code' => $randomCode,
            'skills_id' => $request->input('skill'),
            'difficulties_id' => $request->input('difficulty'),
            'topics_id' => $request->input('topic'),
            'category' => $request->input('category'),
            'marks' => $request->input('marks'),
            'created_at' => now(),
            'updated_at' => now(),
        );
        if ($request->input('category') == 1) {
            $data['questions'] = $request->input('programming_question');
            $data['solutions'] = $request->input('programming_solution');
        } else {
            $data['questions'] = $request->input('mcq_question');
            $data['option_a'] = $request->input('opt_answer_a');
            $data['option_b'] = $request->input('opt_answer_b');
            $data['option_c'] = $request->input('opt_answer_c');
            $data['option_d'] = $request->input('opt_answer_d');
            $data['correct_option'] = $request->input('correct_option');
        }
        $value = DB::table('question_banks')->insertGetId($data);
        $question_code = DB::table('question_banks')->where('question_id', $value)->first();
        if ($question_code->category == 1) {
            $dataToInsert = [];
            foreach ($request->input('group-a') as $data) {
                $dataToInsert[] = [
                    'question_code' => $question_code->question_code,
                    'title_name' => $data['question_sub_title'],
                    'description' => $data['question_sub_description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $insert_data = DB::table('question_bank_entry')->insert($dataToInsert);
            if ($insert_data) {
                Session::flash('success', __('Question Added Successfully'));
                return redirect()->route('manage-questions');
            }
        }
        if ($value) {
            Session::flash('success', __('Question Added Successfully'));
            return redirect()->route('manage-questions');
        }
    }

    public function view_detailed_question(Request $request)
    {

        $questions = DB::table('question_banks')
            ->leftJoin('master_skills', 'master_skills.skill_id', '=', 'question_banks.skills_id')
            ->leftJoin('master_difficulties', 'master_difficulties.difficulty_id', '=', 'question_banks.difficulties_id')
            ->leftJoin('master_topics', 'master_topics.topic_id', '=', 'question_banks.topics_id')
            ->select('question_banks.*', 'master_topics.topic_name', 'master_skills.skill_name', 'master_difficulties.difficulty_name')
            ->where('question_code', $request->input('value'))
            ->first();
        // return $questions->question;
        $question_title = DB::table('question_bank_entry')->where('question_code', $request->input('value'))->get();
        if ($questions->category == 1) {
            $marks = $questions->marks . ' Marks';
            $class = "border-bottom border-3";
        } else {
            $marks = '1 Mark';
            $class = "";
        }

        echo '<style>
            .modal-contents {
                padding: 20px;
            }
    
            .question-details {
                padding: 20px;
                border: 1px solid #ccc;
            }

            .modal img {
                max-width: 100%;  
                height: auto;
            }
    
            h5 {
                margin-bottom: 10px;
            }
    
            .code {
                font-family: monospace;
                background-color: #eee;
                padding: 5px;
                border: 1px solid #ccc;
                margin-bottom: 15px;
            }
    
            .example {
                font-weight: bold;
            }
        </style>';
        echo '<div class="row mb-4">
       <div class="col-3 border-end border-3">
           <h5>Skills</h5>
           <ul>
               <li>' . $questions->skill_name . '</li>
           </ul>
       </div>
       <div class="col-3 border-end border-3">
       <h5>Topics</h5>
       <ul>
           <li>' . $questions->topic_name . '</li>
       </ul>
   </div>
       <div class="col-3 border-end border-3">
       <h5>Difficulty</h5>
           <ul>
               <li>' . $questions->difficulty_name . '</li>
           </ul>
   </div>
       <div class="col-3">
           <h5>Marks</h5>
           <ul>
               <li>' . $marks . '</li>
           </ul>
       </div>
       
   </div>

   <div class="question-statement ' . $class . ' mt-5 ">
       <h5>Question</h5>
       <p>
           ' . $questions->questions . '
       </p>
       ';
        if ($questions->category == 1) {
            foreach ($question_title as $qt) {
                echo '<p class="example">' . $qt->title_name . '</p>
            <p>
                ' . $qt->description . '
            </p>
           ';
            }

            echo '
            </div>
         
                 <div class="question-solution mt-5  ">
                     <h5 class="example">Solution</h5>
                     <pre>' . $questions->solutions . '</pre>
                     
                 </div>
         
                ';
        } else {
            echo '
            <div class="' . ($questions->correct_option == "a" ? "code" : "") . '">
            <p class="example ">Option A</p>
            <p>
                ' . $questions->option_a . '
            </p>
            </div>
            <div class="' . ($questions->correct_option == "b" ? "code" : "") . '">
            <p class="example">Option B</p>
            <p>
                ' . $questions->option_b . '
            </p>
            </div>
            <div class="' . ($questions->correct_option == "c" ? "code" : "") . '">
            <p class="example">Option C</p>
            <p>
                ' . $questions->option_c . '
            </p>
            </div>
            <div class="' . ($questions->correct_option == "d" ? "code" : "") . '">
            <p class="example">Option D</p>
            <p>
                ' . $questions->option_d . '
            </p>
            </div>
           ';
        }
    }


    public function question_status(Request $request)
    {
        $value = DB::table('question_banks')->where('question_code', $request->input('question_code'))->update(['is_active' => $request->input('is_active')]);
        if ($value) {
            return response()->json(['status' => 200]);
        }
    }

    public function editQuestions($question_code)
    {
        $categories = DB::table('master_categories')->where('is_active', 1)->where('trash_key', 1)->get();
        $questions = DB::table('question_banks')->where('question_code', $question_code)->first();
        $question_detail = DB::table('question_bank_entry')->where('question_code', $question_code)->get();
        $heading = "Questions Banks";
        $sub_heading = "Edit Questions";
        return view("admin.question-bank.edit-questions", compact("heading", 'sub_heading', 'questions', 'question_detail', 'categories'));
    }


    public function update_questions(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'edit_skills' => 'required',
            'edit_topics' => 'required',
            'edit_difficulty' => 'required',
            'edit_marks' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Please Check All Fields!');
            return redirect()->back();
        }
        $data = array(
            'question_code' => $request->input('question_code'),
            'skills_id' => $request->input('edit_skills'),
            'difficulties_id' => $request->input('edit_difficulty'),
            'topics_id' => $request->input('edit_topics'),
            'category' => $request->input('edit_category'),
            'marks' => $request->input('edit_marks'),
            'updated_at' => now(),
        );
        if ($request->input('edit_category') == 1) {
            $data['questions'] = $request->input('programming_question');
            $data['solutions'] = $request->input('programming_solution');
        } else {
            $data['questions'] = $request->input('mcq_question');
            $data['option_a'] = $request->input('opt_answer_a');
            $data['option_b'] = $request->input('opt_answer_b');
            $data['option_c'] = $request->input('opt_answer_c');
            $data['option_d'] = $request->input('opt_answer_d');
            $data['correct_option'] = $request->input('correct_option');
        }

        $value = DB::table('question_banks')->where('question_code', $request->input('question_code'))->update($data);
        if ($request->input('edit_category') == 1) {
            DB::table('question_bank_entry')->where('question_code', $request->input('question_code'))->delete();
            $update_data = array();
            if ($request->input('title_name')) {
                for ($i = 0; $i < count($request->input('title_name')); $i++) {
                    // dd($request->input('title_name')[$i]);
                    $update_data[$i]['question_code'] = $request->input('question_code');
                    $update_data[$i]['title_name'] = $request->input('title_name')[$i];
                    $update_data[$i]['description'] = $request->input('description')[$i];
                    $update_data[$i]['created_at'] = now();
                    $update_data[$i]['updated_at'] = now();
                }
                // dd($update_data);
                $up =  DB::table('question_bank_entry')->insert($update_data);
            }
            if ($request->input('group-a')[0]['question_sub_title'] != null && $request->input('group-a')[0]['question_sub_description'] != null) {
                dd($request->input('group-a'));
                foreach ($request->input('group-a') as $key => $group) {
                    $insert_data = [
                        'question_code' => $request->input('question_code'),
                        'title_name' => $request->input('question_sub_title')[$key],
                        'description' => $request->input('question_sub_description')[$key],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $in =  DB::table('question_bank_entry')->insert($insert_data);
                }
            }
        }

        if ($value) {
            Session::flash('success', 'Question Edited Successfully!');
            return redirect()->route('manage-questions');
        } else {
            Session::flash('error', 'Something went wrong! Please try again later.');
            return redirect()->route('manage-questions');
        }
    }


    public function delete_question(Request $request)
    {
        $value = DB::table('question_banks')->where('question_code', $request->input('question_code'))->update(['trash_key' => 2]);
        if ($value) {
            return response()->json(['status' => 200]);
        }
    }


    public function uploadQuestions()
    {
        $heading = "Questions Banks";
        $sub_heading = "Upload Questions";
        return view("admin.question-bank.upload-questions", compact("heading", 'sub_heading'));
    }

    public function import_excel_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uploaded_file' => 'required|file|mimes:xls,xlsx,csv',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
            return redirect()->back();
        }

        if ($request->hasFile('uploaded_file') && $request->file('uploaded_file')->isValid()) {

            $the_file = $request->file('uploaded_file');
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range = range(2, $row_limit);
            $column_range = range('F', $column_limit);
            $startcount = 1;
            $item = [];
            foreach ($row_range as $row) {
                $sheetA = $sheet->getCell('A' . $row)->getValue();
                $skills = $sheet->getCell('B' . $row)->getValue();
                if ($skills != "") {
                    $data = [
                        'skills' => $sheet->getCell('B' . $row)->getValue(),
                        'difficulty' => $sheet->getCell('C' . $row)->getValue(),
                        'topics' => $sheet->getCell('D' . $row)->getValue(),
                        'category' => $sheet->getCell('E' . $row)->getValue(),
                        'question' => $sheet->getCell('F' . $row)->getValue(),
                        'solution' => $sheet->getCell('G' . $row)->getValue(),
                        'title' => $sheet->getCell('H' . $row)->getValue(),
                        'description' => $sheet->getCell('I' . $row)->getValue(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    array_push($item, $data);
                } else {
                    $data = [
                        'skills' => $sheet->getCell('B' . $row)->getValue(),
                        'difficulty' => $sheet->getCell('C' . $row)->getValue(),
                        'topics' => $sheet->getCell('D' . $row)->getValue(),
                        'category' => $sheet->getCell('E' . $row)->getValue(),
                        'question' => $sheet->getCell('F' . $row)->getValue(),
                        'solution' => $sheet->getCell('G' . $row)->getValue(),
                        'title' => $sheet->getCell('H' . $row)->getValue(),
                        'description' => $sheet->getCell('I' . $row)->getValue(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                array_push($item, $data);
                $startcount++;
            }
            dd($item);
        } else {
            Session::flash('error', __('An error has occurred'));
            return redirect()->back();
        }
    }

    public function filter_questions($skill)
    {
        $currentUrl = url()->current();
        $pathSegments = explode('/', $currentUrl);
        $lastSegment = array_pop($pathSegments);

        $value = DB::table('master_skills')->whereIn('skill_name', [$lastSegment])->get();
        if (count($value) == 0) {
            abort(404);
        }
        $skills = DB::table('master_skills')->where('skill_name', $lastSegment)->first();
        $difficulty = DB::table('master_difficulties')->where('trash_key', 1)->where('is_active', 1)->get();
        $category = DB::table('master_categories')->where('trash_key', 1)->where('is_active', 1)->get();
        $topics = DB::table('master_topics')
            ->whereRaw("FIND_IN_SET($skills->skill_id, skills_id)")
            ->where('trash_key', 1)->where('is_active', 1)->get();
        $heading = "Questions Banks";
        $sub_heading = $skill;
        return view("admin.question-bank.skillwise-questions", compact("heading", 'sub_heading', 'skills', 'category', 'difficulty', 'topics'));
    }


    public function set_filter_session(Request $request)
    {
        Session::forget('filter_session');

        $data = [
            'skills' => $request->input('skills'),
            'difficulties' => $request->input('difficulties'),
            'categories' => $request->input('categories'),
            'topics' => $request->input('topics'),
        ];

        Session::put('filter_session', $data);
        return redirect()->route('view-filter-questions');
    }


    public function viewFilterQuestions(Request $request)
    {
        $data = Session::get('filter_session');
        $heading = "Questions Banks";
        $sub_heading = "View Questions";
        return view("admin.question-bank.view-filtered-questions", compact("heading", 'sub_heading', "data"));
    }


    public function get_filtered_question(Request $request)
    {

        if ($request->input('exclude_tests') != null) {
            $exclude_test = $request->input('exclude_tests');
        } else {
            $exclude_test = null;
        }

        if ($request->input('question_type') == "for_filter_questions") {
            $question_type = $request->input('question_type');
        } else {
            $question_type = null;
        }

        $difficulties = $request->input('difficulties');

        if ($exclude_test != null && $question_type == null) {


            $tests = explode(',', $exclude_test);
            $test_questions = [];
            foreach ($tests as $key => $ex_test) {
                $previous_tests = DB::table('test_creation')->where('test_code', $ex_test)->first();
                if ($previous_tests->test_type == 2) {
                    $test_questions[] = $previous_tests->test_questions;
                } elseif ($previous_tests->test_type == 1) {
                    $diff_wise_questions = DB::table('test_creation_difficulty_wise_count')->where('test_code', $ex_test)->get();
                    foreach ($diff_wise_questions as $diff_question) {
                        $test_questions[] = $diff_question->test_questions;
                    }
                }
            }
            $imp_var = implode(',', $test_questions);

            $questions = DB::table('question_banks')
                ->leftJoin('master_skills', 'master_skills.skill_id', '=', 'question_banks.skills_id')
                ->leftJoin('master_difficulties', 'master_difficulties.difficulty_id', '=', 'question_banks.difficulties_id')
                ->leftJoin('master_topics', 'master_topics.topic_id', '=', 'question_banks.topics_id')
                ->leftJoin('master_categories', 'master_categories.category_id', '=', 'question_banks.category')
                ->select('question_banks.question_code', 'question_banks.questions', 'master_categories.category_name', 'question_banks.is_active', 'master_topics.topic_name', 'master_skills.skill_name', 'master_difficulties.difficulty_name')
                // ->whereNotIn('question_banks.question_code', explode(',', $imp_var))
                ->whereNotIn('question_banks.question_code', explode(',', $imp_var))
                ->orWhereNull('question_banks.question_code')

                ->where('question_banks.trash_key', 1)
                ->get();


            return DataTables::of($questions)->toJson();


            // 
        } else if ($exclude_test == null && $question_type == null) {

            $questions = DB::table('question_banks')
                ->leftJoin('master_skills', 'master_skills.skill_id', '=', 'question_banks.skills_id')
                ->leftJoin('master_difficulties', 'master_difficulties.difficulty_id', '=', 'question_banks.difficulties_id')
                ->leftJoin('master_topics', 'master_topics.topic_id', '=', 'question_banks.topics_id')
                ->leftJoin('master_categories', 'master_categories.category_id', '=', 'question_banks.category')
                ->select('question_banks.question_code', 'question_banks.questions', 'master_categories.category_name', 'question_banks.is_active', 'master_topics.topic_name', 'master_skills.skill_name', 'master_difficulties.difficulty_name')
                ->where('question_banks.trash_key', 1)
                ->get();

            return DataTables::of($questions)->toJson();

            // return DataTables::of($result)->toJson();
        } else if ($question_type == "for_filter_questions" && $exclude_test == null) {

            $difficulties = $request->input('difficulties');
            $categories = $request->input('categories');
            $topics = $request->input('topics');
            $skills = $request->input('skills');

            $topicsArray = !is_null($topics) ? explode(',', $topics) : [];
            $skillsArray = !is_null($skills) ? explode(',', $skills) : [];
            $difficultiesArray = !is_null($difficulties) ? explode(',', $difficulties) : [];
            $categoriesArray = !is_null($categories) ? explode(',', $categories) : [];

            $result = DB::table('question_banks')
                ->when($skillsArray, function ($query) use ($skillsArray) {
                    return $query->leftJoin('master_skills', 'question_banks.skills_id', '=', 'master_skills.skill_id')
                        ->whereIn('skills_id', $skillsArray);
                })
                ->when($topicsArray, function ($query) use ($topicsArray) {
                    return $query->leftJoin('master_topics', 'question_banks.topics_id', '=', 'master_topics.id')
                        ->whereIn('topics_id', $topicsArray);
                })
                ->when($difficultiesArray, function ($query) use ($difficultiesArray) {
                    return $query->leftJoin('master_difficulties', 'question_banks.difficulties_id', '=', 'master_difficulties.difficulty_id')
                        ->whereIn('difficulties_id', $difficultiesArray);
                })
                ->when($categoriesArray, function ($query) use ($categoriesArray) {
                    return $query->leftJoin('master_categories', 'question_banks.category', '=', 'master_categories.category_id')
                        ->whereIn('category_id', $categoriesArray);
                })
                ->where('question_banks.trash_key', 1)
                ->where('question_banks.is_active', 1);

            $column_to_select = [
                'question_banks.*',
            ];

            if (!empty($skillsArray)) {
                $column_to_select[] = 'master_skills.skill_id';
                $column_to_select[] = 'master_skills.skill_name';
            }

            if (!empty($topicsArray)) {
                $column_to_select[] = 'master_topics.topic_id';
                $column_to_select[] = 'master_topics.topic_name';
            }
            if (!empty($categoriesArray)) {
                $column_to_select[] = 'master_categories.category_id';
                $column_to_select[] = 'master_categories.category_name';
            }

            $result->select($column_to_select);
            $result = $result->get();
            return DataTables::of($result)->toJson();
        }
    }
}
