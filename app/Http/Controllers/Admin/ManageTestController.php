<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

class ManageTestController extends Controller
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
        $existingCode = DB::table('test_creation')->where('test_code', $code)->exists();
        return $existingCode;
    }

    public function manage_test()
    {
        $heading = "Manage Tests";
        $sub_heading = "Create Contest";
        return view("admin.manage-test.manage-test", compact('heading', 'sub_heading'));
    }

    public function createQuiz()
    {
        $heading = "Manage Tests";
        $sub_heading = "Create Quiz";
        return view("admin.manage-test.create-quiz", compact('heading', 'sub_heading'));
    }


    public function get_test_details()
    {
        $tests = DB::table('test_creation')
            ->where('is_active', 1)
            ->where('trash_key', 1)
            ->get();

        $data = [];

        foreach ($tests as $test) {
            $ts = DB::table('test_section_wise_questions')->where('test_code', $test->test_code)->get();
            $easyCount = 0;
            $mediumCount = 0;
            $hardCount = 0;
            $veryHardCount = 0;
            $common_test_questionCount = 0;
            $total_duration = 0;
            $total_sections = "";
            foreach ($ts as $record) {
                $easyCount += $record->easy ? count(explode(',', $record->easy)) : 0;
                $mediumCount += $record->medium ? count(explode(',', $record->medium)) : 0;
                $hardCount += $record->hard ? count(explode(',', $record->hard)) : 0;
                $veryHardCount += $record->very_hard ? count(explode(',', $record->very_hard)) : 0;
                $common_test_questionCount   += count(explode(',', $record->common_test_question));
                $total_duration += $record->duration;
                $total_sections .= $record->section_name . ',';
                $section_count = count(explode(',', $total_sections)) - 1;
            }

            $total_questions = $easyCount + $mediumCount + $hardCount + $veryHardCount + $common_test_questionCount;

            $data[] = [
                'title' => $test->title,
                'section_count' => $section_count,
                'total_questions' => $total_questions,
                'total_duration' => $total_duration,
                'test_type' => $test->test_type,
                'test_code' => $test->test_code,
            ];
        }

        return DataTables::of($data)->toJson();
    }


    public function get_detailed_question_view(Request $request)
    {

        $tests = DB::table('test_creation')
            ->leftJoin('master_skills', 'master_skills.skill_id', '=', 'test_creation.skills_id')
            ->select('test_creation.*', 'master_skills.skill_name')
            ->where('test_code', $request->input('test_code'))->first();
        $test_difficulty = DB::table('test_creation_difficulty_wise_count')
            ->leftJoin('master_difficulties', 'master_difficulties.difficulty_id', '=', 'test_creation_difficulty_wise_count.difficulty_id')
            ->select('test_creation_difficulty_wise_count.*', 'master_difficulties.difficulty_name')
            ->where('test_creation_difficulty_wise_count.test_code', $request->input('test_code'))
            ->get();
        $test_groups = DB::table('test_create_for_groups')->where('test_code', $request->input('test_code'))->get();
        $carbonDate = Carbon::parse($tests->start_date);
        $longDate = $carbonDate->format('l, F j, Y');
        echo '<div class="responsive">
            <div class="accordion" id="testDetailsAccordion">
                <div class="accordion-item active">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button " type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <span class="fw-bold">More Details</span>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show"
                        aria-labelledby="headingOne" data-bs-parent="#testDetailsAccordion">
                        <div class="accordion-body">

                            <p class="mb-2">
                                TEST DATE: <span class="float-end"
                                    style="font-size: 16px;">' . $longDate . '</span>
                            </p>
                            <p class="mb-2">
                                SKILLS: <span class="float-end" style="font-size: 16px;">' . strtoupper($tests->skill_name) . '</span>
                            </p>
                            <label class="mt-2" style="font-size: 16px; font-weight: 600;"
                                for="">QUESTIONS:</label>
                                ';
        foreach ($test_difficulty as $td) {

            echo '
            <div class="d-flex mt-2 justify-content-between" style="font-size: 16px;">
            <p class="mb-0">' . strtoupper($td->difficulty_name) . ':</p>
            <p class="mb-0" style="font-weight: 600;"><span>' . $td->question_count .  ' Questions</span></p>
        </div>
       
            ';
        }

        echo '</div>
                    </div>
                </div>
            </div>
            ';
        if ($test_groups) {
            echo '
            <br>
            <div class="accordion" id="testDetailsAccordion2">
                <div class="accordion-item active">
                    <h2 class="accordion-header" id="headingOne2">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne2" aria-expanded="false" aria-controls="collapseOne2">
                            <b>Group Details</b>
                        </button>
                    </h2>
                    <div id="collapseOne2" class="accordion-collapse collapse " aria-labelledby="headingOne2"
                        data-bs-parent="#testDetailsAccordion2">
                        <div class="accordion-body">
                        <div id="collapseOne" class="accordion-collapse collapse show"
                        aria-labelledby="headingOne" data-bs-parent="#testDetailsAccordion">
                        <div class="accordion-body">
                        <table class="table table-bordered">
                        <thead>
                        <th>Group Name</th>
                        <th>College</th>
                        <th>Department</th>
                        <th>Year</th>
                        </thead>
                        <tbody>
                        ';
            foreach ($test_groups as  $group) {
                $gr = explode(',', $group->groups_id);
                foreach ($gr as $gr_group) {
                    $gname = DB::table('student_group')
                        ->leftJoin('master_departments', 'master_departments.department_id', '=', 'student_group.department_id')
                        ->leftJoin('master_colleges', 'master_colleges.college_id', '=', 'student_group.college_id')
                        ->select('master_departments.department_name', 'student_group.*', 'master_colleges.college_name')
                        ->where('group_id', $gr_group)
                        ->first();
                    echo '<tr>
                            <td>' . $gname->group_name . '</td>
                            <td>' . $gname->college_name . '</td>
                            <td>' . $gname->department_name . '</td>
                            <td>' . $gname->year . '</td>
                            </tr>';
                }
            }
            echo '</tbody>
                        </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
        echo '</div>
        <br>
        ';
    }


    public function create_new_test()
    {
        $tests = DB::table('test_creation')->where('is_active', 1)->get();
        $question_banks = DB::table('question_banks')->where('is_active', 1)->where('trash_key', 1)->get();
        $difficulties = DB::table('master_difficulties')->where('is_active', 1)->where('trash_key', 1)->get();
        $skills = DB::table('master_skills')->where('is_active', 1)->where('trash_key', 1)->get();
        $categories = DB::table('master_categories')->where('is_active', 1)->where('trash_key', 1)->get();
        $topics = DB::table('master_topics')->where('is_active', 1)->where('trash_key', 1)->get();
        $groups = DB::table('student_group')->where('is_active', 1)->where('trash_key', 1)->where('error_key', 0)->get();
        $group_entry = array();
        foreach ($groups as $group) {
            $group_entry[] = DB::table('student_group_entry')->where('group_id', $group->group_id)->get();
        }
        $heading = "Manage Tests";
        $sub_heading = "Create New Test";
        return view("admin.manage-test.create-test", compact('heading', 'sub_heading', 'difficulties', 'question_banks', 'groups', 'group_entry', 'topics', 'categories', 'tests', 'skills'));
    }


    public function get_selected_questions(Request $request)
    {
        $question_code = explode(',', $request->input('question_code'));
        foreach ($question_code as $key => $qc) {
            $questions = DB::table('question_banks')->where('question_code', $qc)->get();
            foreach ($questions as  $que) {

                if ($que->category == 3) {
                    $questions_word = $que->title;
                } else {
                    $questions_word = $que->questions;
                }
                echo '
                <tr>
                <td>' . ($key + 1) . '.</td>
                <td>' . $que->question_code . '</td>
                <td>' . $questions_word . '</td>
                </tr>
                ';
            }
        }
    }

    public function save_test(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'test_title' => 'required',
            'question_type' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
            return redirect()->route('manage-test');
        }
        $test_code = uniqid();

        if ($request->input('question_type') == 1) {

            $data = [
                'test_code' => $test_code,
                'title' => $request->input('test_title'),
                'test_type' => $request->input('question_type'),
                'practice_status' => $request->input('practice_status'),
                'exclude_tests' => $request->input('exclude_tests'),
                'exclude_tests_code' => $request->input('exclude_previous_test_question'),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $value = DB::table('test_creation')->insert($data);

            $questions = $request->input('selected_questions_value');

            foreach ($request->input('input_section_name') as $key => $sec_name) {
                $ins_data[] = [
                    'test_code' => $test_code,
                    'section_name' => $sec_name,
                    'duration' => $request->input('input_section_duration')[$key],
                    'common_test_question' => $questions[$key],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $ins_value = DB::table('test_section_wise_questions')->insert($ins_data);

            if ($value && $ins_value) {
                Session::flash('success', 'Test Created Successfully..!');
                return redirect()->route('manage-test');
            }
        } else {


            $test_data = [
                'test_code' => $test_code,
                'title' => $request->input('test_title'),
                'test_type' => $request->input('question_type'),
                'practice_status' => $request->input('practice_status'),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $values = DB::table('test_creation')->insert($test_data);

            $section_name = $request->input('rand_section_name');

            $data = [];

            $remove_quest = [];
            $sec_duration = explode(',', $request->input('category_duration'));
            foreach ($section_name as $key => $s_name) {
                $category = $request->input('category')[$key];
                $skills = $request->input('skills')[$key];
                $topics = $request->input('topics')[$key];

                $difficulty_values = [
                    'easy' => 1,
                    'medium' => 2,
                    'hard' => 3,
                    'very_hard' => 4,
                ];

                $section_data['datas'] = [
                    'test_code' => $test_code,
                    'section_name' => $s_name,
                    'duration' => $sec_duration[$key],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                foreach ($difficulty_values as $diff => $value) {
                    $count = $request->input($diff)[$key];
                    $questions = DB::table('question_banks')
                        ->where('is_active', 1)
                        ->where('trash_key', 1)
                        ->whereIn('category', $category)
                        ->whereIn('skills_id', $skills)
                        ->whereIn('topics_id', $topics)
                        ->where('difficulties_id', $value)
                        ->whereNotIn('question_banks.question_code', $remove_quest)
                        ->inRandomOrder()
                        ->take($count)
                        ->get();

                    $question_code = $questions->pluck('question_code')->toArray();
                    $imp_questions = implode(',', $question_code);
                    $remove_quest[] = $imp_questions;
                    $section_data['questions'][$diff] = $imp_questions;
                }
                $data[] = array_merge($section_data['datas'], $section_data['questions']);
            }

            $ins_data = DB::table('test_section_wise_questions')->insert($data);

            if ($values && $ins_data) {
                Session::flash('success', 'Test Created Successfully..!');
                return redirect()->route('manage-test');
            }
        }
    }


    public function edit_test($test_code)
    {
        $question_banks = DB::table('question_banks')->where('is_active', 1)->where('trash_key', 1)->get();
        $difficulties = DB::table('master_difficulties')->where('is_active', 1)->where('trash_key', 1)->get();
        $skills = DB::table('master_skills')->where('is_active', 1)->where('trash_key', 1)->get();
        $categories = DB::table('master_categories')->where('is_active', 1)->where('trash_key', 1)->get();
        $topics = DB::table('master_topics')->where('is_active', 1)->where('trash_key', 1)->get();
        $groups = DB::table('student_group')->where('is_active', 1)->where('trash_key', 1)->where('error_key', 0)->get();
        $group_entry = array();
        $tests = DB::table('test_creation')->where('test_code', base64_decode($test_code))->first();
        $test_sec_ques = DB::table('test_section_wise_questions')->where('test_code', base64_decode($test_code))->get();
        foreach ($groups as $group) {
            $group_entry[] = DB::table('student_group_entry')->where('group_id', $group->group_id)->get();
        }
        $heading = "Manage Tests";
        $sub_heading = "Edit Test";
        return view('admin.manage-test.edit-test', compact('tests', 'test_sec_ques', 'heading', 'sub_heading', 'difficulties', 'question_banks', 'groups', 'group_entry', 'topics', 'categories', 'skills'));
    }
}
