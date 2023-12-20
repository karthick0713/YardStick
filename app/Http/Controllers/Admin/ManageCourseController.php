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
}
