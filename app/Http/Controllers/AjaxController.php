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

    public function get_questions()
    {
        $questions = DB::table('question_banks')
            ->leftJoin('master_skills', 'master_skills.skill_id', '=', 'question_banks.skills_id')
            ->leftJoin('master_difficulties', 'master_difficulties.difficulty_id', '=', 'question_banks.difficulties_id')
            ->leftJoin('master_topics', 'master_topics.topic_id', '=', 'question_banks.topics_id')
            ->select('question_banks.question_code', 'question_banks.questions', 'question_banks.is_active', 'master_topics.topic_name', 'master_skills.skill_name', 'master_difficulties.difficulty_name')
            ->where('question_banks.trash_key', 1)
            ->get();

        return DataTables::of($questions)->toJson();
    }

    public function get_categories()
    {
        $categories = DB::table('master_categories')->where('trash_key', 1)->orderBy('category_id')->get();

        return DataTables::of($categories)->toJson();
    }
}