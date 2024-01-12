<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class AjaxController extends Controller
{
    public function student_group_detail()
    {
        $data = DB::table('student_group')->where('is_active', 1)->where('trash_key', 1)->get();
        return $data;
    }

    public function get_skills()
    {
        $skills = DB::table('master_skills')->where('is_active', 1)->where('trash_key', 1)->orderBy('skill_name', 'asc')->get();
        return $skills;
    }

    public function get_department()
    {
        $departments = DB::table('master_departments')->where('is_active', 1)->where('trash_key', 1)->get();
        return $departments;
    }

    public function get_difficulties()
    {
        $difficulties = DB::table('master_difficulties')->where('is_active', 1)->where('trash_key', 1)->get();
        return $difficulties;
    }

    public function get_topics(Request $request)
    {
        $skill_id = $request->input('skill_id');
        $topics = DB::table('master_topics')
            ->where('is_active', 1)
            ->where('trash_key', 1)
            ->whereRaw("FIND_IN_SET($skill_id, skills_id)")
            ->orderBy('topic_name', 'asc')
            ->get();
        return $topics;
    }

    public function get_colleges()
    {
        $colleges = DB::table('master_colleges')->where('is_active', 1)->where('trash_key', 1)->where('error_key', 0)->get();
        return $colleges;
    }



    public function get_categories()
    {
        $categories = DB::table('master_categories')->where('trash_key', 1)->orderBy('category_id')->get();

        return DataTables::of($categories)->toJson();
    }

    public function get_tags()
    {
        $tags = DB::table('master_tags')->where('trash_key', 1)->orderBy('tag_id')->get();

        return DataTables::of($tags)->toJson();
    }


    public function get_questions()
    {
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

            $questionData = $query->where('category', $category)->get();

            foreach ($questionData as $question) {
                $question->questions = strip_tags($question->questions);
                $questions[] = $question;
            }

            $processedCategories[] = $category;
        }

        return Datatables::of($questions)->toJson();
    }


    public function get_sections(Request $request)
    {
        $section_name = DB::table('test_section_wise_questions')->where('test_code', $request->input('test_code'))->get();
        return $section_name;
    }
}