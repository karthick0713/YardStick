<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{


    public function index()
    {
        // Setting heading and sub-heading
        $heading = "Result";
        $sub_heading = "";

        // Fetching test details based on course ID and test code
        $where = [
            'test_code' => base64_decode(request()->segment(4)),
            'course_id' => base64_decode(request()->segment(3))
        ];
        $test_details = DB::table('students_test_entries')->where($where)->where('student_reg_no', session('userId'))->first();

        // Fetching student's test details and section-wise questions
        $student_test_details = DB::table('students_test_questions_answers_entry')->where($where)->where('student_reg_no', session('userId'))->get();
        $section_wise_question = DB::table('test_section_wise_questions')->where('test_code', base64_decode(request()->segment(4)))->get();

        // Calculating total marks taken by the student
        $total_marks_taken = 0;
        foreach ($student_test_details as $test_d) {
            $total_marks_taken += $test_d->mark_taken_for_this_question;
        }

        // Initializing arrays for different question types
        $questions = array();
        $programming_test_case = [];
        $mcq_options = [];
        $grouping_questions = [];
        $grouping_mcq_options = [];
        $totalMarks = 0;

        // Processing section-wise questions
        foreach ($section_wise_question as $swq) {
            $allQuestions = array_filter(explode(',', $swq->common_test_question . ',' . $swq->easy . ',' . $swq->medium . ',' . $swq->hard . ',' . $swq->very_hard));
            foreach ($allQuestions as $key => $questionCode) {
                // Fetching question details from the database
                $question_detail = DB::table('question_banks')->where('question_code', $questionCode)->first();
                $question_details[] = $question_detail;

                // Processing different question categories
                if ($question_detail->category == 1) {
                    $programming_test_case[$questionCode] = DB::table('student_test_programming_test_cases')->where('question_code', $questionCode)->where('test_entry_id', $test_details->id)->get();
                } else if ($question_detail->category == 2) {
                    $mcq_options[] = DB::table('question_bank_for_mcq')->where('question_code', $questionCode)->get();
                } else if ($question_detail->category == 3) {
                    $grouping_questions[$questionCode] = DB::table('mcq_grouping_questions')->where('question_code', $questionCode)->get();
                    foreach ($grouping_questions[$questionCode] as $grouping_question) {
                        $grouping_mcq_options[$questionCode][$grouping_question->id] = DB::table('question_bank_for_mcq')
                            ->where('grouping_question_id', $grouping_question->id)
                            ->get();
                    }
                }


                // Calculating total marks
                $marks = DB::table('question_banks')->where('question_code', $questionCode)->value('marks');
                $totalMarks += $marks;

                // Associating section ID with question details
                $sec_id = DB::table('test_section_wise_questions')->where('test_code', base64_decode(request()->segment(4)))->where(function ($query) use ($questionCode) {
                    $query->where('common_test_question', 'like', '%' . $questionCode . '%')
                        ->orWhere('easy', 'like', '%' . $questionCode . '%')
                        ->orWhere('medium', 'like', '%' . $questionCode . '%')
                        ->orWhere('hard', 'like', '%' . $questionCode . '%')
                        ->orWhere('very_hard', 'like', '%' . $questionCode . '%');
                })->value('id');

                $question_details[count($question_details) - 1]->section_id = $sec_id;
            }
        }

        // dd($grouping_mcq_options);

        // Calculating counts and durations for different question types and sections
        $easyCount = 0;
        $mediumCount = 0;
        $hardCount = 0;
        $veryHardCount = 0;
        $common_test_questionCount = 0;
        $total_duration = 0;
        $total_sections = "";
        foreach ($section_wise_question as $record) {
            $easyCount += $record->easy ? count(explode(',', $record->easy)) : 0;
            $mediumCount += $record->medium ? count(explode(',', $record->medium)) : 0;
            $hardCount += $record->hard ? count(explode(',', $record->hard)) : 0;
            $veryHardCount += $record->very_hard ? count(explode(',', $record->very_hard)) : 0;
            $common_test_questionCount   += count(explode(',', $record->common_test_question));
            $total_duration += $record->duration;
            $total_sections .= $record->section_name . ',';
            $section_count = count(explode(',', $total_sections)) - 1;
        }

        // Calculating total number of questions
        $total_questions = $easyCount + $mediumCount + $hardCount + $veryHardCount + $common_test_questionCount;

        // Assembling data for the view
        $data = [
            'total_marks' =>  $total_marks_taken,
            'total_question_marks' =>  $totalMarks,
            'question_details' => $question_details,
            'mcq_options' => $mcq_options,
            'programming_test_case' => $programming_test_case,
            'total_questions' => $total_questions,
            'grouping_questions' => $grouping_questions,
            'grouping_mcq_options' => $grouping_mcq_options,
        ];

        // dd($programming_test_case);

        // Returning view with data
        return view('students.report', compact('heading', 'sub_heading', 'test_details', 'student_test_details', 'data'));
    }
}
