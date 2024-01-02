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

class ManageCourseController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set("Asia/Kolkata");
    }


    public function manage_courses()
    {
        $heading = 'Manage Courses';
        $sub_heading = "Courses";
        return view('admin.manage-courses.courses', compact('heading', 'sub_heading'));
    }

    public function create_new_course()
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
        $heading = "Manage Course";
        $sub_heading = "Create New Course";
        return view("admin.manage-courses.create-new-course", compact('heading', 'sub_heading', 'difficulties', 'question_banks', 'groups', 'group_entry', 'categories', 'tests'));
    }

    public function get_test_questions(Request $request)
    {
        $test_code = $request->input('test_code');
        $index = $request->input('index');
        $tests = DB::table('test_creation')->where('test_code', $test_code)->first();
        if ($tests->test_type == 1) {
            $questions = DB::table('test_section_wise_questions')->where('test_code', $test_code)->get();
            $exp_questions = '';
            foreach ($questions as $question) {
                $exp_questions .= $question->common_test_question . ',';
            }
            $imp_questions = rtrim($exp_questions, ',');
            $val_ques = explode(',', $imp_questions);
            foreach ($val_ques as $vq) {
                $que = DB::table('question_banks')->where('question_code', $vq)->first();
                if ($que->category == 3) {
                    $words = str_word_count(strip_tags($que->title), 1);
                } else {
                    $words = str_word_count(strip_tags($que->questions), 1);
                }
                $truncated_questions = implode(' ', array_slice($words, 0, 50));

                if (count($words) > 50) {
                    $truncated_questions .= '...';
                }
                echo '
                <tr>
                <td style="width: 20% !important">' . $que->question_code . '</td>
                <td style="width: 60% !important">' . $truncated_questions  . '</td>
                <td style="width: 20% !important">
                <input type="number" name="negative_marks[]"  class="form-control negative_marks' . $index . '" >
                </td>
                </tr>
                ';
            }
        } else {


            $questions = DB::table('test_section_wise_questions')->where('test_code', $test_code)->get();
            $easy_questions = null;
            $medium_questions = null;
            $hard_questions = null;
            $very_hard_questions = null;
            foreach ($questions as $question) {
                $easy_questions .= $question->easy . ',';
                $medium_questions .= $question->medium . ',';
                $hard_questions .= $question->hard . ',';
                $very_hard_questions .= $question->very_hard . ',';
            }

            $all_questions = rtrim($easy_questions . $medium_questions . $hard_questions . $very_hard_questions, ',');
            $imploded_all_questions = implode(',', explode(',', $all_questions));
            $val_ques = explode(',', $imploded_all_questions);
            foreach ($val_ques as $v => $vq) {

                $que = DB::table('question_banks')->where('question_code', $vq)->first();
                if ($que->category == 3) {
                    $words = str_word_count(strip_tags($que->title), 1);
                } else {
                    $words = str_word_count(strip_tags($que->questions), 1);
                }
                $truncated_questions = implode(' ', array_slice($words, 0, 50));

                if (count($words) > 50) {
                    $truncated_questions .= '...';
                }
                echo '
                <tr>
                <td style="width: 20% !important">' . $que->question_code . '</td>
                <td style="width: 60% !important">' . ($truncated_questions)  . '</td>
                <td style="width: 20% !important">
    <input type="number" name="negative_marks[]"  class="form-control negative_marks' . $index . '" value="0" >
    </td>
                </tr>
                ';
            }
        }
    }


    public function save_course(Request $request)
    {

        $data = [
            'course_title' => $request->input('course_name'),
            'validity_from' => $request->input('validity_from'),
            'validity_to' => $request->input('validity_to'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $course_id = DB::table('course_creation')->insertGetId($data);

        $group_a = $request->input('group-a');

        if (isset($group_a)) {
            foreach ($group_a as $group) {
                $ins_data[] = [
                    'course_id' => $course_id,
                    'college_id' => $group['colleges'],
                    'department_id' => $group['departments'],
                    'year' => $group['year'],
                    'groups_id' => implode(',', $group['groups']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('course_allocate_to_students')->insert($ins_data);
        }

        $test_code =  $request->input('test_code');
        $negative_marks = $request->input('input_negative_marks');

        if (isset($test_code)) {
            foreach ($test_code as $key => $tc) {
                $up_data[] = [
                    'test_code' => $tc,
                    'course_id' => $course_id,
                    'start_date' =>  $request->input('start_test_date')[$key],
                    'end_date' =>  $request->input('end_test_date')[$key],
                    'shuffle_questions' => $request->input('shuffle_ques')[$key],
                    'disable_finish_button' =>  $request->input('dis_fin_btn')[$key],
                    're_attempts' =>  $request->input('re_att')[$key],
                    'display_result_status' =>  $request->input('display_result')[$key],
                    'display_result_date' =>  $request->input('display_result_date')[$key],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('course_test_parameters')->insert($up_data);


            if (isset($negative_marks)) {
                foreach ($negative_marks as $k => $neg) {
                    $neg_data[] = [
                        'test_code' => $tc,
                        'course_id' => $course_id,
                        'question_codes' => $request->input('input_question_code')[$k],
                        'negative_marks' => $neg,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                DB::table('course_negative_marks')->insert($neg_data);
            }
        }



        Session::flash('success', 'Courses Added Successfully..!');
        return redirect()->route('manage-courses');
    }

    public function get_course_details(Request $request)
    {

        $courses = DB::table('course_creation')
            ->where('is_active', 1)
            ->where('trash_key', 1)
            ->get();

        $data = [];

        foreach ($courses as $course) {

            $total_col = DB::table('course_allocate_to_students')->where('course_id', $course->course_id)->count();


            $data[] = [
                'course_title' => $course->course_title,
                'validity_from' => $course->validity_from,
                'validity_to' => $course->validity_to,
                'total_colleges' => $total_col,
                'course_id' => $course->course_id,
            ];
        }

        return DataTables::of($data)->toJson();
    }
}
