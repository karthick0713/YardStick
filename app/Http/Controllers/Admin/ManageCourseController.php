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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
                <input type="number" name="negative_marks[]"  class="form-control negative_marks' . $index . '" value="0" >
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
            $ins_data = [];

            foreach ($group_a as $group) {
                $data = [
                    'course_id' => $course_id,
                    'college_id' => $group['colleges'],
                    'department_id' => $group['departments'],
                    'year' => $group['year'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                if (isset($group['groups'])) {
                    $data['groups_id'] = implode(',', $group['groups']);
                }

                $ins_data[] = $data;
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
                    'test_grouping_name' =>  $request->input('test_group_name')[$key],
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


    public function edit_course($id)
    {

        $id = base64_decode($id);

        $tests = DB::table('test_creation')
            ->where('is_active', 1)
            ->leftJoin('course_test_parameters', function ($join) use ($id) {
                $join->on('test_creation.test_code', '=', 'course_test_parameters.test_code')
                    ->where('course_test_parameters.course_id', '=', $id);
            })
            ->whereNull('course_test_parameters.test_code')
            ->select('test_creation.*')
            ->get();


        $question_banks = DB::table('question_banks')->where('is_active', 1)->where('trash_key', 1)->get();
        $difficulties = DB::table('master_difficulties')->where('is_active', 1)->where('trash_key', 1)->get();
        $categories = DB::table('master_categories')->where('is_active', 1)->where('trash_key', 1)->get();
        $groups = DB::table('student_group')->where('is_active', 1)->where('trash_key', 1)->where('error_key', 0)->get();
        $group_entry = array();
        foreach ($groups as $group) {
            $group_entry[] = DB::table('student_group_entry')->where('group_id', $group->group_id)->get();
        }

        $data = [
            'course_details' => DB::table('course_creation')->where('course_id', $id)->first(),
            'course_allocate' => DB::table('course_allocate_to_students')->where('course_id', $id)->get(),
            'colleges' => DB::table('master_colleges')->where('is_active', 1)->where('trash_key', 1)->where('error_key', 0)->get(),
            'departments' => DB::table('master_departments')->where('is_active', 1)->where('trash_key', 1)->get(),
            'course_test_params' => DB::table('course_test_parameters')->where('course_id', $id)->get(),
        ];
        $heading = "Manage Course";
        $sub_heading = "Edit Course";
        return view("admin.manage-courses.edit-course", compact('heading', 'sub_heading', 'difficulties', 'question_banks', 'groups', 'group_entry', 'categories', 'tests', 'data'));
    }



    public function edit_negative_marks(Request $request)
    {

        $test_code = $request->input('test_code');
        $index = $request->input('index');
        $tests = DB::table('test_creation')->where('test_code', $test_code)->first();
        $course_test = DB::table('course_negative_marks')->where('course_id', $request->input('course_id'))->where('test_code', $test_code)->first();
        $negative_marks = explode(',', $course_test->negative_marks ?? '');

        if ($tests->test_type == 1) {
            $questions = DB::table('test_section_wise_questions')->where('test_code', $test_code)->get();
            $exp_questions = '';
            foreach ($questions as $question) {
                $exp_questions .= $question->common_test_question . ',';
            }
            $imp_questions = rtrim($exp_questions, ',');
            $val_ques = explode(',', $imp_questions);
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

                $current_negative_marks = isset($negative_marks[$v]) ? $negative_marks[$v] : 0;

                echo '
                <tr>
                    <td style="width: 20% !important">' . $que->question_code . '</td>
                    <td style="width: 60% !important">' . ($truncated_questions)  . '</td>
                    <td style="width: 20% !important">
                        <input type="number" name="negative_marks[]" class="form-control negative_marks' . $index . '" value="' . $current_negative_marks . '">
                    </td>
                </tr>';
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

                $current_negative_marks = isset($negative_marks[$v]) ? $negative_marks[$v] : 0;

                echo '
                <tr>
                    <td style="width: 20% !important">' . $que->question_code . '</td>
                    <td style="width: 60% !important">' . ($truncated_questions)  . '</td>
                    <td style="width: 20% !important">
                        <input type="number" name="negative_marks[]" class="form-control negative_marks' . $index . '" value="' . $current_negative_marks . '">                                                                                                                                 
                    </td>
                </tr>';
            }
        }
    }

    public function update_course(Request $request)
    {

        // dd($request->input());


        $where = [
            'course_id' => $request->input('course_id')
        ];

        $data = [
            'course_title' => $request->input('course_name'),
            'validity_from' => $request->input('validity_from'),
            'validity_to' => $request->input('validity_to'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $course_id = DB::table('course_creation')->where($where)->update($data);

        $group_a = $request->input('group-a');

        DB::table('course_allocate_to_students')->where($where)->delete();
        DB::table('course_test_parameters')->where($where)->delete();
        DB::table('course_negative_marks')->where($where)->delete();

        $update_data = [];

        $colleges = $request->input('colleges');

        $groups = $request->input('groups');


        foreach ($colleges as $keys => $col) {
            $data = [
                'course_id' => $course_id,
                'college_id' => $col,
                'department_id' => $request->input('departments')[$keys],
                'year' => $request->input('year')[$keys],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (isset($groups)) {
                $data['groups_id'] = implode(',', $groups);
            }

            $update_data[] = $data;
        }
        DB::table('course_allocate_to_students')->insert($update_data);


        if (isset($group['colleges']) || isset($group['departments']) || isset($group['year']) || isset($group['groups'])) {
            $ins_data = [];

            foreach ($group_a as $group) {
                $data = [
                    'course_id' => $course_id,
                    'college_id' => isset($group['colleges']) ? $group['colleges'] : null,
                    'department_id' => isset($group['departments']) ? $group['departments'] : null,
                    'year' => isset($group['year']) ? $group['year'] : null,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ];

                if (isset($group['groups'])) {
                    $data['groups_id'] = implode(',', $group['groups']);
                }

                $ins_data[] = $data;
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

        if ($course_id) {
            Session::flash('success', 'Courses Updated Successfully..!');
            return redirect()->route('manage-courses');
        }
    }


    public function delete_course(Request $request)
    {
        $course_id = $request->input('course_id');
        $value = DB::table('course_creation')->where('course_id', $course_id)->update(['is_active' => 2]);
        if ($value) {
            return response()->json(array('status' => 200));
        }
    }


    public function course_test_delete(Request $request)
    {
        $delete = DB::table('course_test_parameters')->where('course_id', $request->input('course_id'))->where('test_code', $request->input('test_code'))->delete();
        if ($delete) {
            return response()->json(array('status' => 200, 'message' => 'Deleted Successfully'));
        }
    }

    public function allocated_course_reports(Request $request)
    {
        $course_id = $request->input('course_id');
        $course_test = DB::table('course_test_parameters as c')
            ->leftJoin('test_creation as t', 't.test_code', '=', 'c.test_code')
            ->select('t.*', 'c.*')
            ->where('course_id', $course_id)->get();

        $course_allocate = DB::table('course_allocate_to_students')->where('course_id', $course_id)->get();

        foreach ($course_test as $ct) {
            echo  "<style>
                    #report_table{
                        font-family: arial, sans-serif;
                        border-collapse: collapse;
                        width: 100%;
                      }
                      
                     #report_table td, #report_table th {
                        border: 1px solid #dddddd;
                        text-align: left;
                        padding: 8px;
                      }
                      
                     #report_table tr:nth-child(even) {
                        background-color: #dddddd;
                      }
                    </style>";
            echo "
                    <h4>$ct->title</h4>
                    <table id='report_table'>
                    <thead>
                        <tr>
                            <th>Colleges</th>
                            <th>Departments</th>
                            <th>Year</th>  
                            <th>Groups</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                    <tr>
                        <td>
                            <select name='colleges' id='colleges' class='form-control'>
                                <option value=''>SELECT</option>";

            foreach ($course_allocate as $ca) {
                $college = null;

                if ($ca->college_id !== null) {
                    $college = DB::table('master_colleges')->where('college_id', $ca->college_id)->first();
                }

                echo "<option value='" . ($ca->college_id ?? '') . "'>" . ($college ? $college->college_name : '') . "</option>";
            }

            echo "</select>
                        </td>
                        <td>
                            <select name='department' id='department' class='form-control'>
                                <option value=''>SELECT</option>";

            foreach ($course_allocate as $ca) {
                $department = null;

                if ($ca->department_id !== null) {
                    $department = DB::table('master_departments')->where('department_id', $ca->department_id)->first();
                } else {
                    $department = DB::table('master_departments')->where('is_active', 1)->get();
                }

                if ($department) {
                    if ($ca->department_id !== null) {
                        echo "<option value='" . ($ca->department_id ?? '') . "'>" . $department->department_name . "</option>";
                    } else {
                        foreach ($department as $dept) {
                            echo "<option value='" . $dept->department_id . "'>" . $dept->department_name . "</option>";
                        }
                    }
                }
            }

            echo "</select>
            </td>
            <td>
                <select name='year' id='year' class='form-control'>
                    <option value=''>SELECT</option>
                    <option value='1'>1st Year</option>
                    <option value='2'>2nd Year</option>
                    <option value='3'>3rd Year</option>
                    <option value='4'>4th Year</option>
                </select>
            </td>
            <td>
            <input type='hidden' name='' id='test_code' value='$ct->test_code'>
            <input type='hidden' name='' id='course_id' value='$course_id'>
                <select name='groups' id='groups' class='form-control'";

            foreach ($course_allocate as $ca) {
                $groups_id = null;

                if ($ca->groups_id !== null) {
                    $groups_ids = explode(',', $ca->groups_id);
                    foreach ($groups_ids as $group_id) {
                        $group = DB::table('student_group')->where('group_id', $group_id)->first();
                        echo "><option value='" . $group_id . "'>" . $group->group_name . "</option>";
                    }
                } else {
                    echo " disabled>";
                }
            }
            echo "</select>
            </td>
            <td>
            <button type='button' class='btn btn-primary btn-sm' onclick='download_report()'>Download Report</button>
            </td>
        </tr>
        </tbody>
        </table>";
        }
    }

    function convertMinutesToHoursAndMinutes($minutes)
    {
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        if ($hours > 0 && $remainingMinutes > 0) {
            return "$hours hrs $remainingMinutes mins";
        } elseif ($hours > 0 && $remainingMinutes == 0) {
            return "$hours hrs";
        } else {
            return "$remainingMinutes mins";
        }
    }

    public function download_test_report(Request $request)
    {

        if ($request->input('groups') == null) {
            $where = [
                'college_id' => $request->input('college'),
                'department_id' => $request->input('department'),
                'year' => $request->input('year'),
            ];

            $students_report = [];

            $students_list = DB::table('master_students')->where($where)->get();

            foreach ($students_list as $sl) {
                $student_test_entry = DB::table('students_test_entries')
                    ->where('student_reg_no', $sl->register_no)
                    ->where('course_id', $request->input('course_id'))
                    ->where('test_code', $request->input('test_code'))
                    ->get();

                $total_mark_for_each_questions = 0;
                $total_mark_taken_for_this_question = 0;

                foreach ($student_test_entry as $st) {
                    $student_test_sub_entry = DB::table('students_test_questions_answers_entry')
                        ->where('test_entry_id', $st->id)
                        ->get();

                    foreach ($student_test_sub_entry as $ss) {
                        $total_mark_for_each_questions += $ss->mark_for_each_question;
                        $total_mark_taken_for_this_question += $ss->mark_taken_for_this_question;
                    }
                }

                if ($student_test_entry->isEmpty()) {
                    $total_mark_for_each_questions = 0;
                    $total_mark_taken_for_this_question = 0;
                }

                $student_report = [
                    'student_name' => $sl->student_name,
                    'email_id' => $sl->email_id,
                    'total_mark_for_each_questions' => $total_mark_for_each_questions,
                    'total_mark_taken_for_this_question' => $total_mark_taken_for_this_question,
                ];

                if ($student_test_entry->isEmpty()) {
                    $student_report['user_os'] = 0;
                    $student_report['ip_address'] = 0;
                    $student_report['browser'] = 0;
                    $student_report['user_agent'] = 0;
                    $student_report['city'] = 0;
                    $student_report['time_taken'] = 0;
                    $student_report['total_duration'] = 0;
                } else {
                    $student_report['user_os'] = $st->user_os;
                    $student_report['ip_address'] = $st->ip_address;
                    $student_report['browser'] = $st->browser;
                    $student_report['user_agent'] = $st->user_agent;
                    $student_report['city'] = $st->city;
                    $student_report['time_taken'] = $st->time_taken;
                    $student_report['total_duration'] =  $st->total_duration;
                }

                $students_report[] = $student_report;
            }

            $spreadsheet = new Spreadsheet();

            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'Student Name');
            $sheet->setCellValue('B1', 'Student Email Id');
            $sheet->setCellValue('C1', 'Total Marks for Each Question');
            $sheet->setCellValue('D1', 'Total Marks Taken for This Question');
            $sheet->setCellValue('E1', 'Total Time');
            $sheet->setCellValue('F1', 'Time Taken');
            $sheet->setCellValue('G1', 'User OS');
            $sheet->setCellValue('H1', 'IP Address');
            $sheet->setCellValue('I1', 'Browser');
            $sheet->setCellValue('J1', 'User Agent');
            $sheet->setCellValue('K1', 'City');


            $sheet->getColumnDimension('A')->setWidth(30);
            $sheet->getColumnDimension('B')->setWidth(30);
            $sheet->getColumnDimension('C')->setWidth(30);
            $sheet->getColumnDimension('D')->setWidth(35);
            $sheet->getColumnDimension('E')->setWidth(25);
            $sheet->getColumnDimension('F')->setWidth(25);
            $sheet->getColumnDimension('G')->setWidth(25);
            $sheet->getColumnDimension('H')->setWidth(25);
            $sheet->getColumnDimension('I')->setWidth(25);
            $sheet->getColumnDimension('J')->setWidth(25);
            $sheet->getColumnDimension('K')->setWidth(25);

            $row = 2;

            foreach ($students_report as $report) {
                $total_duration_hours = $this->convertMinutesToHoursAndMinutes($report['total_duration']);
                $time_taken = $this->convertMinutesToHoursAndMinutes($report['time_taken']);

                $sheet->setCellValue('A' . $row, $report['student_name']);
                $sheet->setCellValue('B' . $row, $report['email_id']);
                $sheet->setCellValue('C' . $row, $report['total_mark_for_each_questions']);
                $sheet->setCellValue('D' . $row, $report['total_mark_taken_for_this_question']);
                $sheet->setCellValue('E' . $row, $total_duration_hours);
                $sheet->setCellValue('F' . $row, $time_taken);
                $sheet->setCellValue('G' . $row, $report['user_os']);
                $sheet->setCellValue('H' . $row, $report['ip_address']);
                $sheet->setCellValue('I' . $row, $report['browser']);
                $sheet->setCellValue('J' . $row, $report['user_agent']);
                $sheet->setCellValue('K' . $row, $report['city']);
                $row++;
            }



            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="student_report.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        }
    }
}