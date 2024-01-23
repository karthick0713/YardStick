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
        $tags = DB::table('master_tags')->where('is_active', 1)->where('trash_key', 1)->get();
        $heading = "Questions Banks";
        $sub_heading = "Add Questions";
        return view("admin.question-bank.add-questions", compact("heading", 'sub_heading', 'categories', 'tags'));
    }


    // public function save_questions(Request $request)
    // {


    //     $validator = Validator::make($request->all(), [
    //         'skill' => 'required',
    //         'difficulty' => 'required',
    //         'topic' => 'required',
    //         'category' => 'required',
    //         'marks' => 'required',
    //     ]);
    //     if ($validator->fails()) {
    //         Session::flash('error', __('An error has occurred'));
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    //     $randomCode = $this->generate_random_code();
    //     $data = array(
    //         'question_code' => $randomCode,
    //         'skills_id' => $request->input('skill'),
    //         'difficulties_id' => $request->input('difficulty'),
    //         'topics_id' => $request->input('topic'),
    //         'category' => $request->input('category'),
    //         'marks' => $request->input('marks'),
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     );
    //     if ($request->input('category') == 1) {
    //         $data['questions'] = $request->input('programming_question');
    //         $data['solutions'] = $request->input('programming_solution');
    //     } else {
    //         $data['questions'] = $request->input('mcq_question');
    //         $data['option_a'] = $request->input('opt_answer_a');
    //         $data['option_b'] = $request->input('opt_answer_b');
    //         $data['option_c'] = $request->input('opt_answer_c');
    //         $data['option_d'] = $request->input('opt_answer_d');
    //         $data['correct_option'] = $request->input('correct_option');
    //     }
    //     $value = DB::table('question_banks')->insertGetId($data);
    //     $question_code = DB::table('question_banks')->where('question_id', $value)->first();
    //     if ($question_code->category == 1) {
    //         $dataToInsert = [];
    //         foreach ($request->input('group-a') as $data) {
    //             $dataToInsert[] = [
    //                 'question_code' => $question_code->question_code,
    //                 'title_name' => $data['question_sub_title'],
    //                 'description' => $data['question_sub_description'],
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ];
    //         }

    //         $insert_data = DB::table('question_bank_entry')->insert($dataToInsert);
    //         if ($insert_data) {
    //             Session::flash('success', __('Question Added Successfully'));
    //             return redirect()->route('manage-questions');
    //         }
    //     }
    //     if ($value) {
    //         Session::flash('success', __('Question Added Successfully'));
    //         return redirect()->route('manage-questions');
    //     }
    // }



    public function save_questions(Request $request)
    {

        if ($request->input('category') == 1) {

            $language_for_test = $request->input('language_for_test');
            $tags = $request->input('tags');
            $question_code = uniqid();

            $data = [
                'question_code' => $question_code,
                'skills_id' => $request->input('skill'),
                'difficulties_id' => $request->input('difficulty'),
                'topics_id' => $request->input('topic'),
                'category' => $request->input('category'),
                'marks' => $request->input('marks'),
                'questions' => $request->input('programming_question'),
                'solutions' => $request->input('programming_solution'),
                'input_format' => $request->input('programming_question_input'),
                'output_format' => $request->input('programming_question_output'),
                'code_constraints' => $request->input('programming_question_code_constraints'),
                'output_run_language' => $request->input('language_select'),
                'saving_status' => $request->input('question_saving_status'),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (isset($language_for_test)) {
                $data['language_for_test'] = implode(',', $request->input('language_for_test'));
            }
            if (isset($tags)) {
                $data['tags'] = implode(',', $request->input('tags'));
            }

            $value = DB::table('question_banks')->insertGetId($data);

            $test_case_input = $request->input('test_case_input');

            if (isset($test_case_input)) {
                foreach ($test_case_input as $key => &$tc_input) {

                    $tc_data = [
                        'question_id' => $value,
                        'question_code' => $question_code,
                        'input' => $tc_input,
                        'output' => $request->input('test_case_output')[$key],
                        'sample' => $request->input('sample')[$key],
                        'weightage' => $request->input('test_case_weightage')[$key],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $ins_data = DB::table('programming_question_test_case')->insert($tc_data);
                }
            }
        } else if ($request->input('category') == 2) {

            $question_code = uniqid();
            $language_for_test = $request->input('language_for_test');
            $tags = $request->input('tags');
            $data = [
                'question_code' => $question_code,
                'skills_id' => $request->input('skill'),
                'difficulties_id' => $request->input('difficulty'),
                'topics_id' => $request->input('topic'),
                'category' => $request->input('category'),
                'marks' => 1,
                'questions' => $request->input('mcq_question'),
                'explanation' => $request->input('mcq_explanation'),
                'saving_status' => $request->input('question_saving_status'),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (isset($language_for_test)) {
                $data['language_for_test'] = implode(',', $request->input('language_for_test'));
            }
            if (isset($tags)) {
                $data['tags'] = implode(',', $request->input('tags'));
            }
            $value = DB::table('question_banks')->insertGetId($data);

            $opt_answer = $request->input('opt_answer');

            if (isset($opt_answer)) {
                foreach ($request->input('opt_answer') as $key => $mcq_dup) {
                    $option_name = chr(65 + $key);
                    $correct_answer = ($option_name == strtoupper($request->input('correct_option'))) ? 1 : 0;
                    $mcq_data[] = [
                        'question_id' => $value,
                        'question_code' => $question_code,
                        'option_name' => 'Option ' . $option_name,
                        'option_answer' => $mcq_dup,
                        'correct_answer' => $correct_answer,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                $ins_data = DB::table('question_bank_for_mcq')->insert($mcq_data);
            }
        } else if ($request->input('category') == 3) {
            $language_for_test = $request->input('language_for_test');
            $tags = $request->input('tags');
            $question_code = uniqid();

            $data = [
                'question_code' => $question_code,
                'skills_id' => $request->input('skill'),
                'difficulties_id' => $request->input('difficulty'),
                'topics_id' => $request->input('topic'),
                'category' => $request->input('category'),
                'marks' => $request->input('marks'),
                'saving_status' => $request->input('question_saving_status'),
                'title' => $request->input('mcq_grouping_title'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            if (isset($language_for_test)) {
                $data['language_for_test'] = implode(',', $request->input('language_for_test'));
            }
            if (isset($tags)) {
                $data['tags'] = implode(',', $request->input('tags'));
            }
            $value = DB::table('question_banks')->insertGetId($data);

            $grouping_mcq_question = $request->input('grouping_mcq_question');

            if (isset($grouping_mcq_question)) {
                foreach ($request->input('grouping_mcq_question') as $question) {
                    $insertedId = DB::table('mcq_grouping_questions')->insertGetId([
                        'question_id' => $value,
                        'question_code' => $question_code,
                        'questions' => $question,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $ins_data[] = $insertedId;
                }

                $grouping_opt_answer = $request->input('grouping_opt_answer');
                if (isset($grouping_opt_answer)) {
                    foreach ($request->input('grouping_opt_answer') as $key => $mcq_dup) {
                        foreach ($mcq_dup as $i => $c) {
                            $option_name = chr(65 + $i);
                            $co = $request->input('grouping_correct_option');
                            if (isset($co[$key])) {
                                $correct_option = strtoupper($co[$key]);
                                $correct_answer = ($option_name == $correct_option) ? 1 : 0;
                            } else {
                                $correct_answer = 0;
                            }

                            $mcq_data = [
                                'question_id' => $value,
                                'question_code' => $question_code,
                                'grouping_question_id' => $ins_data[$key - 1],
                                'option_name' => 'Option ' . $option_name,
                                'option_answer' => $c,
                                'correct_answer' => $correct_answer,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];

                            DB::table('question_bank_for_mcq')->insert($mcq_data);
                        }
                    }
                }
            }
        }

        return redirect()->route('manage-questions');
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
        if ($questions->category == 1) {
            $question_title = DB::table('programming_question_test_case')->where('question_code', $request->input('value'))->get();
            $marks = $questions->marks . ' Marks';
            $class = "border-bottom border-3";

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
      
            </div>
         
                 <div class="question-solution mt-5  ">
                     <h5 class="example">Solution</h5>
                     <pre>' . $questions->solutions . '</pre>
                     
                 </div>
            <hr>
                 <div class=" mt-5  ">
                 <h5 class="example">Input Format</h5>
                 <span>' . $questions->input_format . '</span>
                 
             </div>
             <hr>
             <div class=" mt-5  ">
             <h5 class="example">Output Format</h5>
             <span>' . $questions->output_format . '</span>
             
         </div>
         <hr>
         <div class=" mt-5  ">
         <h5 class="example">Code Constraints</h5>
         <span>' . $questions->code_constraints . '</span>
         </div>
        <hr>
        <div class=" mt-5  ">
        <h5 class="example">Test Case</h5><br>
        <table class="table table-responsive table-bordered table-stripped">
            <thead>
            <tr>
            <th>S.No</th>
            <th>Input</th>
            <th>Output</th>
            <th>Sample</th>
            <th>Weightage</th>
            </tr>
            </thead>
            <tbody>
            ';
            foreach ($question_title as $key => $qt) {
                echo "<tr>
                        <td>" . ($key + 1) . "</td>
                        <td>$qt->input</td>
                        <td>$qt->output</td>
                        <td>" . ($qt->sample == 1 ? 'Yes' : 'No') . "</td>
                        <td>$qt->weightage</td>
                      </tr>";
            }

            echo '
            </tbody>
        </table>
        </div>
     </div>
         
                ';
        } else if ($questions->category == 2) {

            $question_title = DB::table('question_bank_for_mcq')->where('question_code', $request->input('value'))->get();


            $marks = $questions->marks . ' Mark';
            $class = "border-bottom border-3";

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
      
            </div>
            ';
            foreach ($question_title as $key => $qt) {
                echo "
                <div class='question-statement " . ($qt->correct_answer == 1 ? 'code' : '') . " $class mt-5 '>
                    <h5>$qt->option_name</h5>
                    <p>
                        $qt->option_answer
                    </p>
                </div>
            ";
            }

            echo '
           
         <div class=" mt-5  ">
         <h5 class="example">Explanation</h5>
         <span>' . $questions->explanation . '</span>
         </div>
        
     </div>';
        } else if ($questions->category == 3) {

            $question_grouping = DB::table('mcq_grouping_questions')->where('question_code', $request->input('value'))->get();

            $marks = $questions->marks . ' Mark';
            $class = "border-bottom border-3";

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
   <hr>
   
   <div class="mt-3 mb-3">
   <h4 class="fw-bold">Title</h4>
   <p>
   ' . $questions->title . '
</p>
   </div>

   <hr>
   
            ';
            foreach ($question_grouping as $key => $qg) {

                echo ' <div class="question-statement ' . $class . ' mt-5 ">
       <h5 class="fw-bold"> Question No : ' . $key + 1 . '</h5>
       <p>
           ' . $qg->questions . '
       </p>
      
            </div>';

                $question_title = DB::table('question_bank_for_mcq')->where('question_code', $request->input('value'))->where('grouping_question_id', $qg->id)->get();

                foreach ($question_title as $qt) {
                    echo "
                    <div class='question-statement " . ($qt->correct_answer == 1 ? 'code' : '') . " $class mt-5 '>
                        <h6 >$qt->option_name</h6>
                        <p>
                            $qt->option_answer
                        </p>
                    </div>
                ";
                }
            }

            echo '
        
     </div>';
        }
    }

    // ($questions->correct_option == "a" ? "code" : "")


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
        $programming_question = DB::table('programming_question_test_case')->where('question_code', $question_code)->get();
        $mcq_question = DB::table('question_bank_for_mcq')->where('question_code', $question_code)->get();
        $test_case = DB::table('programming_question_test_case')->where('question_code', $question_code)->get();
        $mcq_grouping_question = DB::table('mcq_grouping_questions')->where('question_code', $question_code)->get();
        $tags = DB::table('master_tags')->where('is_active', 1)->where('trash_key', 1)->get();
        $heading = "Questions Banks";
        $sub_heading = "Edit Questions";
        return view("admin.question-bank.edit-questions", compact("heading", 'sub_heading', 'questions', 'programming_question', 'mcq_grouping_question', 'mcq_question', 'categories', 'test_case', 'tags'));
    }



    public function update_questions(Request $request)
    {

        // dd($request->input());

        if ($request->input('category_edit') == 1) {

            DB::table('programming_question_test_case')
                ->where('question_code', $request->input('question_code'))
                ->delete();

            $question_code = $request->input('question_code');

            $language_for_test = $request->input('language_for_test');
            $tags = $request->input('tags');

            $data = [
                'question_code' => $request->input('question_code'),
                'skills_id' => $request->input('skill'),
                'difficulties_id' => $request->input('difficulty'),
                'topics_id' => $request->input('topic'),
                'category' => $request->input('category_edit'),
                'marks' => $request->input('marks'),
                'questions' => $request->input('programming_question'),
                'solutions' => $request->input('programming_solution'),
                'input_format' => $request->input('programming_question_input'),
                'output_format' => $request->input('programming_question_output'),
                'code_constraints' => $request->input('programming_question_code_constraints'),
                'output_run_language' => $request->input('language_select'),
                'saving_status' => $request->input('question_saving_status'),
                'updated_at' => now(),
            ];

            if (isset($language_for_test)) {
                $data['language_for_test'] = implode(',', $request->input('language_for_test'));
            }
            if (isset($tags)) {
                $data['tags'] = implode(',', $request->input('tags'));
            }


            $value = DB::table('question_banks')->where('question_code', $question_code)->update($data);
            $question_id = DB::table('question_banks')->where('question_code', $question_code)->first();
            $test_case_input = $request->input('test_case_input');

            if (isset($test_case_input)) {
                foreach ($test_case_input as $key => $tc_input) {
                    $tc_data = [
                        'question_id' => $question_id->question_id,
                        'question_code' => $question_code,
                        'input' => $tc_input,
                        'output' => $request->input('test_case_output')[$key],
                        'sample' => $request->input('sample')[$key],
                        'weightage' => $request->input('test_case_weightage')[$key],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $ins_data = DB::table('programming_question_test_case')->insert($tc_data);
                }
            }
        } else if ($request->input('category_edit') == 2) {

            DB::table('question_bank_for_mcq')
                ->where('question_code', $request->input('question_code'))
                ->delete();


            $language_for_test = $request->input('language_for_test');
            $tags = $request->input('tags');

            $question_code = $request->input('question_code');

            $data = [
                'question_code' => $question_code,
                'skills_id' => $request->input('skill'),
                'difficulties_id' => $request->input('difficulty'),
                'topics_id' => $request->input('topic'),
                'category' => $request->input('category_edit'),
                'marks' => 1,
                'questions' => $request->input('mcq_question'),
                'explanation' => $request->input('mcq_explanation'),
                'saving_status' => $request->input('question_saving_status'),
                'updated_at' => now(),
            ];

            if (isset($language_for_test)) {
                $data['language_for_test'] = implode(',', $request->input('language_for_test'));
            }
            if (isset($tags)) {
                $data['tags'] = implode(',', $request->input('tags'));
            }

            $value = DB::table('question_banks')->where('question_code', $question_code)->update($data);
            $question_id = DB::table('question_banks')->where('question_code', $question_code)->first();

            $opt_answer = $request->input('opt_answer');

            if (isset($opt_answer)) {
                foreach ($request->input('opt_answer') as $key => $mcq_dup) {
                    $option_name = chr(65 + $key);
                    $correct_answer = ($option_name == strtoupper($request->input('correct_option'))) ? 1 : 0;
                    $mcq_data = [
                        'question_id' => $question_id->question_id,
                        'question_code' => $question_code,
                        'option_name' => 'Option ' . $option_name,
                        'option_answer' => $mcq_dup,
                        'correct_answer' => $correct_answer,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $ins_data = DB::table('question_bank_for_mcq')->insert($mcq_data);
                }
            }
        } else if ($request->input('category_edit') == 3) {


            DB::table('mcq_grouping_questions')
                ->where('question_code', $request->input('question_code'))
                ->delete();
            DB::table('question_bank_for_mcq')
                ->where('question_code', $request->input('question_code'))
                ->delete();

            $question_code = $request->input('question_code');

            $language_for_test = $request->input('language_for_test');
            $tags = $request->input('tags');

            $data = [
                'question_code' => $question_code,
                'skills_id' => $request->input('skill'),
                'difficulties_id' => $request->input('difficulty'),
                'topics_id' => $request->input('topic'),
                'category' => $request->input('category_edit'),
                'marks' => $request->input('marks'),
                'questions' => $request->input('mcq_questions'),
                'saving_status' => $request->input('question_saving_status'),
                'title' => $request->input('mcq_grouping_title'),
                'updated_at' => now(),
            ];

            if (isset($language_for_test)) {
                $data['language_for_test'] = implode(',', $request->input('language_for_test'));
            }
            if (isset($tags)) {
                $data['tags'] = implode(',', $request->input('tags'));
            }

            $value = DB::table('question_banks')->where('question_code', $question_code)->update($data);

            $grouping_mcq_question = $request->input('grouping_mcq_question');
            if (isset($grouping_mcq_question)) {
                foreach ($grouping_mcq_question as $question) {
                    $insertedId = DB::table('mcq_grouping_questions')->insertGetId([
                        'question_id' => $value,
                        'question_code' => $question_code,
                        'questions' => $question,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $ins_data[] = $insertedId;
                }
                $grouping_opt_answer = $request->input('grouping_opt_answer');
                if (isset($grouping_opt_answer)) {
                    foreach ($request->input('grouping_opt_answer') as $key => $mcq_dup) {
                        foreach ($mcq_dup as $i => $c) {
                            $option_name = chr(65 + $i);
                            $co = $request->input('grouping_correct_option');
                            if (isset($co[$key])) {
                                $correct_option = strtoupper($co[$key]);
                                $correct_answer = ($option_name == $correct_option) ? 1 : 0;
                            } else {
                                $correct_answer = 0;
                            }

                            $mcq_data = [
                                'question_id' => $value,
                                'question_code' => $question_code,
                                'grouping_question_id' => $ins_data[$key],
                                'option_name' => 'Option ' . $option_name,
                                'option_answer' => $c,
                                'correct_answer' => $correct_answer,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];

                            DB::table('question_bank_for_mcq')->insert($mcq_data);
                        }
                    }
                }
            }
        }
        return redirect()->route('manage-questions');
    }







    public function delete_question(Request $request)
    {
        $value = DB::table('question_banks')->where('question_code', $request->input('question_code'))->update(['trash_key' => 2]);
        if ($value) {
            return response()->json(['status' => 200, 'message' => 'Question deleted successfully']);
        } else {
            return response()->json(['message' => 'Something went wrong']);
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

                $ma_test = DB::table('test_creation')->where('test_code', $ex_test)->first();
                $prev_test = DB::table('test_section_wise_questions')->where('test_code', $ex_test)->get();
                foreach ($prev_test as $is => $pt) {
                    if ($ma_test->test_type == 1) {
                        $test_questions[] = $pt->common_test_question;
                    } else {
                        $test_questions[] = implode(',', [$pt->easy, $pt->medium, $pt->hard, $pt->very_hard]);
                    }
                }
            }

            $imp_var = implode(',', $test_questions);

            $questions = [];
            $processedCategories = [];

            $que = DB::table('question_banks')->where('is_active', 1)->where('trash_key', 1)->get();

            foreach ($que as $ques) {
                $category = $ques->category;

                if (in_array($category, $processedCategories)) {
                    continue;
                }

                $query = DB::table('question_banks')
                    ->leftJoin('master_skills', 'master_skills.skill_id', '=', 'question_banks.skills_id')
                    ->leftJoin('master_difficulties', 'master_difficulties.difficulty_id', '=', 'question_banks.difficulties_id')
                    ->leftJoin('master_topics', 'master_topics.topic_id', '=', 'question_banks.topics_id')
                    ->leftJoin('master_categories', 'master_categories.category_id', '=', 'question_banks.category')
                    ->select(
                        'question_banks.question_code',
                        'question_banks.is_active',
                        'question_banks.saving_status',
                        'master_topics.topic_name',
                        'master_skills.skill_name',
                        'master_categories.category_name',
                        'master_difficulties.difficulty_name'
                    )->where('question_banks.trash_key', 1)
                    ->whereNotIn('question_banks.question_code', explode(',', $imp_var))
                    ->where('question_banks.saving_status', 1)
                    ->where('question_banks.is_active', 1);

                $questionsField = ($category == 3) ? 'question_banks.title as questions' : 'question_banks.questions as questions';
                $query->addSelect(DB::raw($questionsField));

                $questionData = $query->where('category', $category)->get();

                foreach ($questionData as $question) {
                    $question->questions = strip_tags($question->questions);
                    $questions[] = $question;
                }

                $processedCategories[] = $category;
            }

            return DataTables::of($questions)->toJson();
        } else if ($exclude_test == null && $question_type == null) {

            $questions = [];
            $processedCategories = [];

            $que = DB::table('question_banks')->where('is_active', 1)->where('trash_key', 1)->get();

            foreach ($que as $ques) {
                $category = $ques->category;

                if (in_array($category, $processedCategories)) {
                    continue;
                }

                $query = DB::table('question_banks')
                    ->leftJoin('master_skills', 'master_skills.skill_id', '=', 'question_banks.skills_id')
                    ->leftJoin('master_difficulties', 'master_difficulties.difficulty_id', '=', 'question_banks.difficulties_id')
                    ->leftJoin('master_topics', 'master_topics.topic_id', '=', 'question_banks.topics_id')
                    ->leftJoin('master_categories', 'master_categories.category_id', '=', 'question_banks.category')
                    ->select(
                        'question_banks.question_code',
                        'question_banks.is_active',
                        'question_banks.saving_status',
                        'master_topics.topic_name',
                        'master_skills.skill_name',
                        'master_categories.category_name',
                        'master_difficulties.difficulty_name'
                    )->where('question_banks.trash_key', 1)
                    ->where('question_banks.saving_status', 1)
                    ->where('question_banks.is_active', 1);


                $questionsField = ($category == 3) ? 'question_banks.title as questions' : 'question_banks.questions as questions';
                $query->addSelect(DB::raw($questionsField));

                $questionData = $query->where('category', $category)->get();

                foreach ($questionData as $question) {
                    $question->questions = strip_tags($question->questions);
                    $questions[] = $question;
                }

                $processedCategories[] = $category;
            }

            return DataTables::of($questions)->toJson();
        } else if ($question_type == "for_filter_questions" && $exclude_test == null) {

            $questions = [];
            $processedCategories = [];

            $que = DB::table('question_banks')->where('is_active', 1)->where('trash_key', 1)->get();

            foreach ($que as $ques) {

                $category = $ques->category;

                if (in_array($category, $processedCategories)) {
                    continue;
                }

                $query = DB::table('question_banks')
                    ->leftJoin('master_skills', 'master_skills.skill_id', '=', 'question_banks.skills_id')
                    ->leftJoin('master_difficulties', 'master_difficulties.difficulty_id', '=', 'question_banks.difficulties_id')
                    ->leftJoin('master_topics', 'master_topics.topic_id', '=', 'question_banks.topics_id')
                    ->leftJoin('master_categories', 'master_categories.category_id', '=', 'question_banks.category')
                    ->select(
                        'question_banks.question_code',
                        'question_banks.is_active',
                        'question_banks.saving_status',
                        'master_topics.topic_name',
                        'master_skills.skill_name',
                        'master_categories.category_name',
                        'master_difficulties.difficulty_name'
                    )->where('question_banks.trash_key', 1);

                $questionsField = ($category == 3) ? 'question_banks.title as questions' : 'question_banks.questions as questions';
                $query->addSelect(DB::raw($questionsField));

                $filters = [
                    'skills', 'topics', 'difficulties', 'categories'
                ];

                foreach ($filters as $filter) {
                    $filterValues = $request->input($filter);
                    if (!is_null($filterValues)) {
                        $filterArray = explode(',', $filterValues);
                        $query->whereIn("question_banks.{$filter}_id", $filterArray);
                    }
                }

                $questionData = $query->where('category', $category)->get();

                foreach ($questionData as $question) {
                    $question->questions = strip_tags($question->questions);
                    $questions[] = $question;
                }

                $processedCategories[] = $category;
            }

            return Datatables::of($questions)->toJson();
        }
    }
}
