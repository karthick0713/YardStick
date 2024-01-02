<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;

class StudentController extends Controller
{
    public function index()
    {
        $heading = "Dashboard";
        $sub_heading = "";
        $stu_groups = DB::table('student_group')
            ->leftJoin('student_group_entry', 'student_group_entry.group_id', '=', 'student_group.group_id')
            ->where('student_group.is_active', 1)
            ->where('student_group.trash_key', 1)
            ->where('student_group_entry.register_no', Session::get('userId'))
            ->get();

        $courses = [];
        foreach ($stu_groups as $group) {
            $course_id = DB::table('course_allocate_to_students')
                ->whereRaw("FIND_IN_SET($group->group_id, groups_id)")
                ->get();
            foreach ($course_id as $c_id) {
                $courses[] = DB::table('course_creation')->where('course_id', $c_id->course_id)->first();
            }
        }
        return view('students.student-dashboard', compact('heading', 'sub_heading', 'courses'));
    }
}
