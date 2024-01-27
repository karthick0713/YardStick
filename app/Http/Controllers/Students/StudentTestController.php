<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use PDO;
use Yajra\DataTables\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;

class StudentTestController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set("Asia/Kolkata");
    }


    public function test_overview($id)
    {
        $heading = "Test OverView";
        $sub_heading = "";
        $tests = DB::table('course_test_parameters')->where('course_id', base64_decode($id))->get();
        $test_params = [];
        $test_sections = [];
        foreach ($tests as $t) {
            $test_params[] = DB::table('test_creation')->where('test_code', $t->test_code)->first();
            $test_sections[] = DB::table('test_section_wise_questions')->where('test_code', $t->test_code)->get();
        }

        return view('students.tests.student-test-view', compact('heading', 'sub_heading', 'test_params', 'tests', 'test_sections'));
    }


    public function test_taking_screen()
    {
        return view('students.tests.test-screen');
    }


    public function fetch_test_questions(Request $request)
    {
        $questions = DB::table('test_creation')->where('test_code', $request->input('test_code'))->first();
        $negative_marks = DB::table('course_negative_marks')->where('test_code', $request->input('test_code'))->first();
        // $neg_marks  = explode(',', $negative_marks->question_codes);
        if ($questions && $questions->test_type == 1) {
            $sections = [];
            $testQuestions = [];
            $questionsData = [];

            $sectionQuestions = DB::table('test_section_wise_questions')->where('test_code', $questions->test_code)->get();

            foreach ($sectionQuestions as $sectionQuestion) {
                $sections[] = $sectionQuestion->section_name;
                $testQuestions[] = explode(',', $sectionQuestion->common_test_question);
            }

            foreach ($testQuestions as $key => $t) {
                foreach ($t as $k => $questionCode) {
                    $ques = DB::table('question_banks')->where('question_code', $questionCode)->first();
                    if ($ques && $ques->category == 2) {
                        $mcq = DB::table('question_bank_for_mcq')->select('option_name', 'question_code', 'option_answer', 'id', 'correct_answer')->where('question_code', $questionCode)->get()->toArray();

                        $questionsData[$key][] = [
                            'category' => $ques->category,
                            'question_for_test' => $ques->questions,
                            'question_marks' => $ques->marks,
                            'mcq_options' => $mcq,

                        ];
                    } else if ($ques && $ques->category == 1) {
                        $test_cases = DB::table('programming_question_test_case')->where('question_code', $questionCode)->get();
                        $questionsData[$key][] = [
                            'category' => $ques->category,
                            'question_for_test'  => $ques,
                            'test_cases' => $test_cases
                        ];
                    } else if ($ques && $ques->category == 3) {
                        $grouping = DB::table('mcq_grouping_questions')->where('question_code', $questionCode)->get()->toArray();
                        $mcq = [];
                        foreach ($grouping as $g => $group) {
                            $mcq[] = DB::table('question_bank_for_mcq')->select('option_name', 'question_code', 'option_answer', 'id', 'correct_answer')->where('question_code', $questionCode)->where('grouping_question_id', $group->id)->get()->toArray();
                        }

                        $questionsData[$key][] = [
                            'category' => $ques->category,
                            'question_for_test'  => $ques,
                            'grouping_questions' => $grouping,
                            'mcq_options' => $mcq,
                        ];
                    }
                }
                $question_category[$key] = $ques->category;
            }



            $data = [
                'sections' => $sections,
                'test_questions' => $testQuestions,
            ];

            return [$data, $questionsData, $question_category];
        } elseif ($questions && $questions->test_type == 2) {
            $sections = [];
            $testQuestions = [];
            $questionsData = [];
            $sectionQuestions = DB::table('test_section_wise_questions')->where('test_code', $questions->test_code)->get();

            foreach ($sectionQuestions as $sectionQuestion) {
                $sections[] = $sectionQuestion->section_name;
                foreach (['easy', 'medium', 'hard', 'very_hard'] as $difficulty) {
                    if (!empty($sectionQuestion->$difficulty)) {
                        $questionsByDifficulty = explode(',', $sectionQuestion->$difficulty);
                        $testQuestions = array_merge($testQuestions, $questionsByDifficulty);
                    }
                }
            }
            foreach ($testQuestions as $key => $questionCode) {
                $ques = DB::table('question_banks')->where('question_code', $questionCode)->first();

                if ($ques && $ques->category == 2) {
                    $mcq = DB::table('question_bank_for_mcq')->select('option_name', 'question_code', 'option_answer', 'id', 'correct_answer')->where('question_code', $questionCode)->get()->toArray();
                    $questionsData[$key][] = [
                        'category' => $ques->category,
                        'question_for_test' => $ques->questions,
                        'question_marks' => $ques->marks,
                        'mcq_options' => $mcq,
                    ];
                }
            }
            $question_category[$key][] = $ques->category;
            $data = [
                'sections' => $sections,
                'test_questions' => $testQuestions,
            ];
            return [$data, $questionsData, $question_category];
        }
    }

    public function get_total_duration(Request $request)
    {
        $tot_duration = DB::table('test_section_wise_questions')
            ->select(DB::raw('SUM(duration) as duration'))
            ->where('test_code', $request->input('test_code'))
            ->first();
        return $tot_duration->duration;
    }


    public function save_student_test_entry(Request $request)
    {

        $data = [
            'student_reg_no' => $request->input('user_id'),
            'total_duration' => $request->input('total_duration'),
            'course_id' => $request->input('course_id'),
            'test_code' => $request->input('test_code'),
            'created_at' => now(),
        ];
        $value = DB::table('students_test_entries')->insertGetId($data);
        return $value;
    }


    public function student_test_questions_answers_update(Request $request)
    {

        $question_code = $request->input('question_code');

        $question = DB::table('question_banks')->where('question_code', $question_code)->first();

        $selected_option = DB::table('question_bank_for_mcq')->where('question_code', $question->question_code)->where('id', $request->input('option_id'))->first();

        if ($question->category == 2) {
            $correct_option = DB::table('question_bank_for_mcq')->where('question_code', $question->question_code)->where('correct_answer', 1)->first();
            if ($selected_option->correct_answer == $correct_option->correct_answer) {
                $ans = $question->marks;
            } else {
                $ans = 0;
            }
        } else if ($question->category == 3) {
            $correct_option = DB::table('question_bank_for_mcq')->where('question_code', $question->question_code)->where('grouping_question_id', $request->input('group_question_id'))->where('correct_answer', 1)->first();
            if ($selected_option->correct_answer == $correct_option->correct_answer) {
                $ans = 1;
            } else {
                $ans = 0;
            }
        }


        $data = [
            'student_reg_no' => $request->input('user_id'),
            'test_entry_id' => $request->input('test_entry_id'),
            'test_code' => $request->input('test_code'),
            'course_id' => $request->input('course_id'),
            'category_id' => $question->category,
            'question_code' => $question_code,
            'mark_taken_for_this_question' => $ans,
            'mark_for_each_question' => $question->marks,
            'answer_selected' => $request->input('option_id'),
            'correct_answer' => $correct_option->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if ($question->category == 3) {
            $data['group_question_id'] = $request->input('group_question_id');
        }


        DB::table('students_test_questions_answers_entry')->insert($data);
    }




    public function verify_testcase_update(Request $request)
    {

        $where = [
            'question_code' => $request->input('question_code'),
            'test_entry_id' => $request->input('test_entry_id'),
            'student_reg_no' => $request->input('student_reg_no'),
            'test_code' => $request->input('test_code'),
            'course_id' => $request->input('course_id'),
        ];

        DB::table('students_test_questions_answers_entry')->where($where)->delete();

        DB::table('student_test_programming_test_cases')->where('test_entry_id', $request->input('test_entry_id'))->where('question_code', $request->input('question_code'))->delete();

        $question = DB::table('question_banks')->where('question_code', $request->input('question_code'))->first();



        $test_cases = $request->input('datas');

        $default_test_case = DB::table('programming_question_test_case')->where('question_code', $request->input('question_code'))->get();

        $weightage = 0;

        foreach ($test_cases as $key => $tc) {


            $tc_data  = [
                'question_code' => $request->input('question_code'),
                'test_entry_id' => $request->input('test_entry_id'),
                'input' => $default_test_case[$key]->input,
                'expected_output' => $default_test_case[$key]->output,
                'executed_output' =>  $tc['stdout'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $trimmedExpectedOutput = implode('', explode("\n", str_replace("\r", '', trim($default_test_case[$key]->output))));
            $trimmedExecutedOutput = implode('', explode("\n", str_replace("\r", '', trim($test_cases[$key]['stdout']))));

            if ($trimmedExpectedOutput == $trimmedExecutedOutput) {
                $tc_data['matched_status'] = 1;
                $weightage += $default_test_case[$key]->weightage;
            } else {
                $tc_data['matched_status'] = 0;
            }

            DB::table('student_test_programming_test_cases')->insert($tc_data);
        }


        $marks  = $question->marks;

        $total_marks = $marks * ($weightage / 100);

        $data = [

            'question_code' => $request->input('question_code'),
            'student_code' => $request->input('code'),
            'test_entry_id' => $request->input('test_entry_id'),
            'student_reg_no' => $request->input('student_reg_no'),
            'mark_for_each_question' => $question->marks,
            'category_id' => $question->category,
            'test_code' => $request->input('test_code'),
            'course_id' => $request->input('course_id'),
            'mark_taken_for_this_question' => $total_marks,
            'created_at' => now(),
            'updated_at' => now(),

        ];

        DB::table('students_test_questions_answers_entry')->insert($data);
    }
}
