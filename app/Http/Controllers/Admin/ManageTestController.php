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


    // public function save_common_test(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'test_title' => 'required',
    //         'skills' => 'required',
    //         'category' => 'required',
    //         'visibility' => 'required',
    //         'duration' => 'required',
    //         'marks' => 'required',
    //         'pass_percentage' => 'required',
    //         'shuffle_questions' => 'required',
    //         'restrict_attempts' => 'required',
    //         'disable_finish_button' => 'required',
    //         'enable_question_list' => 'required',
    //         'hide_solutions' => 'required',
    //         'show_leaderboard' => 'required',
    //         'schedule_type' => 'required',
    //         'test_assigned_to' => 'required',
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date',
    //         'start_time' => 'required',
    //         'end_time' => 'required',
    //         'difficulty_questions' => 'required|array'
    //     ]);

    //     if ($validator->fails()) {
    //         Session::flash('error', $validator->errors());
    //         return redirect()->route('manage-test');
    //     }

    //     $test_code = $this->generate_random_code();

    //     $data = [
    //         'test_code' => $test_code,
    //         'title' => $request->input('test_title'),
    //         'test_type' => 1,
    //         'skills_id' => $request->input('skills'),
    //         'category' => $request->input('category'),
    //         'visibility' => $request->input('visibility'),
    //         'duration' => $request->input('duration'),
    //         'marks' => $request->input('marks'),
    //         'pass_percentage' => $request->input('pass_percentage'),
    //         'shuffle_questions' => $request->input('shuffle_questions'),
    //         'restrict_attempts' => $request->input('restrict_attempts'),
    //         'disable_finish_button' => $request->input('disable_finish_button'),
    //         'enable_question_list_view' => $request->input('enable_question_list'),
    //         'hide_solutions' => $request->input('hide_solutions'),
    //         'show_leaderboard' => $request->input('show_leaderboard'),
    //         'schedule_type' => $request->input('schedule_type'),
    //         'test_assigned_to' => $request->input('test_assigned_to'),
    //         'start_date' => $request->input('start_date'),
    //         'end_date' => $request->input('end_date'),
    //         'start_time' => $request->input('start_time'),
    //         'end_time' => $request->input('end_time'),
    //         'created_at' => now(),
    //         'updated_at' => now()
    //     ];

    //     $val = DB::table('test_creation')->insert($data);

    //     $question_code = DB::table('question_banks')
    //         ->select('question_code', 'difficulties_id')
    //         ->where('skills_id', $request->input('skills'))
    //         ->where('category', $request->input('category'))
    //         ->where('is_active', 1)
    //         ->where('trash_key', 1)
    //         ->get()
    //         ->toArray();
    //     $array_data = [];
    //     foreach ($request->input('difficulty_id') as $key => $diff) {
    //         foreach ($question_code as $qc) {
    //             if ($qc->difficulties_id == $diff) {
    //                 $array_data[$diff][] = $qc;
    //             }
    //         }
    //     }

    //     foreach ($request->input('difficulty_id') as $key => $dif) {

    //         if (isset($array_data[$dif])) {
    //             $questions = $array_data[$dif];
    //             shuffle($questions);

    //             $selected_questions = array_slice($questions, 0, $request->input('difficulty_questions')[$key]);

    //             $selected_question_codes = array_map(function ($question) {
    //                 return $question->question_code;
    //             }, $selected_questions);

    //             $diff_data[] = [
    //                 'test_code' => $test_code,
    //                 'difficulty_id' => $dif,
    //                 'question_count' => $request->input('difficulty_questions')[$key],
    //                 'test_questions' => implode(',', $selected_question_codes),
    //                 'created_at' => now(),
    //                 'updated_at' => now()
    //             ];
    //         }
    //     }

    //     $in = DB::table('test_creation_difficulty_wise_count')->insert($diff_data);

    //     if ($request->input('visibility') == 1) {
    //         $group_a = $request->input('group-a');
    //         if (isset($group_a)) {
    //             foreach ($group_a as $group) {
    //                 $ins_data[] = [
    //                     'test_code' => $test_code,
    //                     'college_id' => $group['colleges'],
    //                     'department_id' => $group['departments'],
    //                     'year' => $group['year'],
    //                     'groups_id' => implode(',', $group['groups']),
    //                     'created_at' => now(),
    //                     'updated_at' => now(),
    //                 ];
    //             }
    //         }
    //     }

    //     $grp = DB::table('test_create_for_groups')->insert($ins_data);

    //     if ($in) {
    //         Session::flash('success', 'Test Created Successfully!');
    //         return redirect()->route('manage-test');
    //     }
    // }


    public function get_test_details()
    {
        $tests = DB::table('test_creation')
            ->leftJoin('master_skills', 'master_skills.skill_id', '=', 'test_creation.skills_id')
            ->where('test_creation.is_active', 1)
            ->where('test_creation.trash_key', 1)
            ->select('test_creation.*', 'master_skills.skill_name')
            ->get();
        return DataTables::of($tests)->toJson();
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
        $categories = DB::table('master_categories')->where('is_active', 1)->where('trash_key', 1)->get();
        $groups = DB::table('student_group')->where('is_active', 1)->where('trash_key', 1)->where('error_key', 0)->get();
        $group_entry = array();
        foreach ($groups as $group) {
            $group_entry[] = DB::table('student_group_entry')->where('group_id', $group->group_id)->get();
        }
        $heading = "Manage Tests";
        $sub_heading = "Create New Test";
        return view("admin.manage-test.create-test", compact('heading', 'sub_heading', 'difficulties', 'question_banks', 'groups', 'group_entry', 'categories', 'tests'));
    }


    public function get_selected_questions(Request $request)
    {
        $question_code = explode(',', $request->input('question_code'));
        foreach ($question_code as $key => $qc) {
            $questions = DB::table('question_banks')->where('question_code', $qc)->get();
            foreach ($questions as  $que) {
                echo '
                <tr>
                <td>' . ($key) . '.</td>
                <td>' . $que->question_code . '</td>
                <td>' . $que->questions . '</td>
                </tr>
                ';
            }
        }
    }

    public function save_test(Request $request)
    {
        // dd($request->input());

        $validator = Validator::make($request->all(), [
            'test_title' => 'required',
            'skills' => 'required',
            'category' => 'required',
            'visibility' => 'required',
            'marks' => 'required',
            'pass_percentage' => 'required',
            'shuffle_questions' => 'required',
            'restrict_attempts' => 'required',
            'disable_finish_button' => 'required',
            'enable_question_list' => 'required',
            'hide_solutions' => 'required',
            'show_leaderboard' => 'required',
            'schedule_type' => 'required',
            'test_assigned_to' => 'required',
        ]);

        if ($validator->fails()) {
            dd('error', $validator->errors());
            // return redirect()->route('manage-test');
        }

        $test_code = uniqid();
        $test_questions = $request->input('selected_questions');
        $data = [
            'test_code' => $test_code,
            'title' => $request->input('test_title'),
            'skills_id' => $request->input('skills'),
            'category' => $request->input('category'),
            'visibility' => $request->input('visibility'),
            'marks' => $request->input('marks'),
            'pass_percentage' => $request->input('pass_percentage'),
            'shuffle_questions' => $request->input('shuffle_questions'),
            'restrict_attempts' => $request->input('restrict_attempts'),
            'disable_finish_button' => $request->input('disable_finish_button'),
            'enable_question_list_view' => $request->input('enable_question_list'),
            'hide_solutions' => $request->input('hide_solutions'),
            'show_leaderboard' => $request->input('show_leaderboard'),
            'schedule_type' => $request->input('schedule_type'),
            'test_assigned_to' => $request->input('test_assigned_to'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'question_type' => $request->input('question_type'),
            'created_at' => now(),
            'updated_at' => now()
        ];

        if ($request->input('skills')[0] == "All") {
            $skills = DB::table('master_skills')->where("trash_key", 1)->where('is_active', 1)->get();
            $imp_skills = [];
            foreach ($skills as $sk) {
                $imp_skills[] = $sk->skill_id;
            }
            $data['skills_id'] = implode(',', $imp_skills);
        } else {
            $data['skills_id'] = implode(',', $request->input('skills'));
        }

        if ($request->input('category')[0] == "All") {
            $category = DB::table('master_categories')->where("trash_key", 1)->where('is_active', 1)->get();
            $imp_category = [];
            foreach ($category as $cat) {
                $imp_category[] = $cat->category_id;
            }
            $data['category'] = implode(',', $imp_category);
        } else {
            $data['category'] = implode(',', $request->input('category'));
        }

        if ($request->input('hide_solutions') == 3) {
            $data['show_solution_after_particular_date'] = $request->input('solution_date');
        }

        if ($request->input('question_type') == 1) {
            $data['test_type'] = 2;
        } else {
            $data['test_type'] = 1;
        }



        $timing_cat_name = $request->input('timing_category_name');
        $category_duration = $request->input('category_duration');

        $tcn = explode(',', $timing_cat_name);
        $cd = explode(',', $category_duration);

        foreach ($tcn as $key => $tc) {
            $cat_data[] = [
                'test_code' => 'test_code',
                'category_id' => $cd[$key],
                'time_duration' => $tc,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        $cat_insert = DB::table('test_category_wise_duration')->insert($cat_data);

        $question_code = DB::table('question_banks')
            ->select('question_code', 'difficulties_id')
            ->where('skills_id', $request->input('skills'))
            ->where('category', $request->input('category'))
            ->where('is_active', 1)
            ->where('trash_key', 1)
            ->get()
            ->toArray();

        if ($request->input('question_type') == 2) {
            $array_data = [];
            foreach ($request->input('difficulty_id') as $key => $diff) {
                foreach ($question_code as $qc) {
                    if ($qc->difficulties_id == $diff) {
                        $array_data[$diff][] = $qc;
                    }
                }
            }

            foreach ($request->input('difficulty_id') as $key => $dif) {

                if (isset($array_data[$dif])) {
                    $questions = $array_data[$dif];
                    shuffle($questions);

                    $selected_questions = array_slice($questions, 0, $request->input('difficulty_questions')[$key]);

                    $selected_question_codes = array_map(function ($question) {
                        return $question->question_code;
                    }, $selected_questions);

                    $diff_data[] = [
                        'test_code' => $test_code,
                        'difficulty_id' => $dif,
                        'question_count' => $request->input('difficulty_questions')[$key],
                        'test_questions' => implode(',', $selected_question_codes),
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }

            $in = DB::table('test_creation_difficulty_wise_count')->insert($diff_data);
        } else {
            if (isset($test_questions)) {
                $data['test_questions'] = $request->input('selected_questions');
            }
        }

        $val = DB::table('test_creation')->insert($data);

        if ($request->input('visibility') == 1) {
            $group_a = $request->input('group-a');
            if (isset($group_a)) {
                foreach ($group_a as $group) {
                    $ins_data = [
                        'test_code' => $test_code,
                        'college_id' => $group['colleges'],
                        'department_id' => $group['departments'],
                        'year' => $group['year'],
                        'groups_id' => implode(',', $group['groups']),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $grp = DB::table('test_create_for_groups')->insert($ins_data);
                }
            }
        }
        if ($val) {
            Session::flash('success', 'Test Created Successfully!');
            return redirect()->route('manage-test');
        }
    }
}
