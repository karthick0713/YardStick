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

class ReportController extends Controller
{
    public function index()
    {

        $heading = "Result";
        $sub_heading = "";
        $where = [
            'test_code' => base64_decode(request()->segment(4))
        ];
        $test_details = DB::table('students_test_entries')->where($where)->first();
        $test_question_details = DB::table('students_test_questions_answers_entry')->where($where)->get();
        $section_wise_question = DB::table('test_section_wise_questions')->where($where)->get();

        $total_marks_taken = 0;
        foreach ($test_question_details as $test_d) {
            $total_marks_taken += $test_d->mark_taken_for_this_question;
        }

        $questions = array();
        $programming_test_case = [];
        $mcq_options = [];

        $totalMarks = 0;
        foreach ($section_wise_question as $swq) {
            $commonTestQuestion = array_filter(explode(',', $swq->common_test_question));
            $easy = array_filter(explode(',', $swq->easy));
            $medium = array_filter(explode(',', $swq->medium));
            $hard = array_filter(explode(',', $swq->hard));
            $veryHard = array_filter(explode(',', $swq->very_hard));
            $allQuestions = array_merge(
                $commonTestQuestion,
                $easy,
                $medium,
                $hard,
                $veryHard
            );
            $questions[] = $allQuestions;
            foreach ($allQuestions as $key => $questionId) {
                $question_details[] = DB::table('question_banks')->where('question_code', $questionId)->first();

                if ($question_details[$key]->category == 1) {
                    $programming_test_case[] = DB::table('programming_question_test_case')->where('question_code', $questionId)->get();
                } else if ($question_details[$key]->category == 2) {
                    $mcq_options[] = DB::table('question_bank_for_mcq')->where('question_code', $questionId)->get();
                }

                $marks = DB::table('question_banks')->where('question_code', $questionId)->value('marks');
                $totalMarks += $marks;
            }
        }

        $ts = DB::table('test_section_wise_questions')->where($where)->get();
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


        $data = [
            'total_marks' =>  $total_marks_taken,
            'total_question_marks' =>  $totalMarks,
            'question_details' => $question_details,
            'mcq_options' => $mcq_options,
            'programming_test_case' => $programming_test_case,
            'total_questions' => $total_questions
        ];

        return view('students.report', compact('heading', 'sub_heading', 'test_details', 'test_question_details', 'data'));
    }
}
