<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
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

        if ($questions && $questions->test_type == 1) {
            $sections = [];
            $testQuestions = [];
            $questionsData = [];

            $sectionQuestions = DB::table('test_section_wise_questions')->where('test_code', $questions->test_code)->get();

            foreach ($sectionQuestions as $key => $sectionQuestion) {
                $sections[] = $sectionQuestion->section_name;
                $testQuestions[] = explode(',', $sectionQuestion->common_test_question);
            }

            foreach ($testQuestions as $t) {
                foreach ($t as $questionCode) {
                    $ques = DB::table('question_banks')->where('question_code', $questionCode)->first();
                    if ($ques && $ques->category == 2) {
                        $mcq = DB::table('question_bank_for_mcq')->select('option_name', 'question_code', 'option_answer', 'id', 'correct_answer')->where('question_code', $questionCode)->get()->toArray();
                        $questionsData[] = [
                            'question_for_test' => $ques->questions,
                            'question_marks' => $ques->marks,
                            'mcq_options' => $mcq,
                        ];
                    }
                }
            }
            $data = [
                'sections' => $sections,
                'test_questions' => $testQuestions,
            ];

            return [$data, $questionsData];
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
            foreach ($testQuestions as $questionCode) {
                $ques = DB::table('question_banks')->where('question_code', $questionCode)->first();

                if ($ques && $ques->category == 2) {
                    $mcq = DB::table('question_bank_for_mcq')->select('option_name', 'question_code', 'option_answer', 'id', 'correct_answer')->where('question_code', $questionCode)->get()->toArray();
                    $questionsData[] = [
                        'question_for_test' => $ques->questions,
                        'question_marks' => $ques->marks,
                        'mcq_options' => $mcq,
                    ];
                }
            }

            $data = [
                'sections' => $sections,
                'test_questions' => $testQuestions,
            ];
            return [$data, $questionsData];
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
            'total_questions' => $request->input('total_questions'),
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
        if ($question->category == 2) {
            $selected_option = DB::table('question_bank_for_mcq')->where('question_code', $question->question_code)->where('id', $request->input('option_id'))->first();
            $correct_option = DB::table('question_bank_for_mcq')->where('question_code', $question->question_code)->where('correct_answer', 1)->first();

            if ($selected_option->correct_answer == $correct_option->correct_answer) {
                $ans = $question->marks;
            } else {
                $ans = 0;
            }
        }
        $data = [
            'student_reg_no' => $request->input('user_id'),
            'test_entry_id' => $request->input('test_entry_id'),
            'test_code' => $request->input('test_code'),
            'course_id' => $request->input('course_id'),
            'question_code' => $question_code,
            'mark_taken_for_this_question' => $ans,
            'mark_for_each_question' => $question->marks,
            'answer_selected' => $selected_option->id,
            'correct_answer' => $correct_option->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('students_test_questions_answers_entry')->insert($data);
    }
}