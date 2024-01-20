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

        $student_det = DB::table('master_students')->where('register_no', session('userId'))->first();

        $stu_groups = DB::table('student_group')
            ->leftJoin('student_group_entry', 'student_group_entry.group_id', '=', 'student_group.group_id')
            ->where('student_group.is_active', 1)
            ->where('student_group.trash_key', 1)
            ->where('student_group_entry.register_no', session('userId'))
            ->get();

        $courses = [];
        $course_params = [];

        if ($stu_groups->isEmpty()) {
            $course_ids = DB::table('course_allocate_to_students')
                ->where('college_id', $student_det->college_id)
                ->where(function ($query) use ($student_det) {
                    $query->where('department_id', $student_det->department_id)
                        ->orWhereNull('department_id');
                })
                ->where(function ($query) use ($student_det) {
                    $query->where('year', $student_det->year)
                        ->orWhereNull('year');
                })
                ->pluck('course_id');
        } else {
            foreach ($stu_groups as $group) {
                $course_ids = DB::table('course_allocate_to_students')
                    ->where('college_id', $student_det->college_id)
                    ->where(function ($query) use ($student_det) {
                        $query->where('department_id', $student_det->department_id)
                            ->orWhereNull('department_id');
                    })
                    ->where(function ($query) use ($student_det) {
                        $query->where('year', $student_det->year)
                            ->orWhereNull('year');
                    })
                    ->where(function ($query) use ($group) {
                        $query->whereRaw("FIND_IN_SET($group->group_id, groups_id)")
                            ->orWhereNull('groups_id');
                    })
                    ->pluck('course_id');
            }
        }
        foreach ($course_ids as $course_id) {
            $courses[] = DB::table('course_creation')->where('course_id', $course_id)->first();
            $course_params[] = DB::table('course_test_parameters')->where('course_id', $course_id)->count();
        }



        if (isset($course_params)) {
            $course_params = $course_params;
        } else {
            $course_params = "";
        }

        return view('students.student-dashboard', compact('heading', 'sub_heading', 'courses', 'course_params'));
    }
}
