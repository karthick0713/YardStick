<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ManageStudentsController extends Controller
{
    public function students()
    {
        $skills = DB::table('master_skills')->where('trash_key', 1)->where('is_active', 1)->get();
        $colleges = DB::table('master_colleges')->where('trash_key', 1)->where('is_active', 1)->get();
        $departments = DB::table('master_departments')->where('trash_key', 1)->where('is_active', 1)->get();
        $data = DB::table('master_students')
            ->leftJoin('master_colleges', 'master_students.college_id', '=', 'master_colleges.college_id')
            ->select('master_colleges.college_name', 'master_students.*')
            ->where('master_students.trash_key', 1)->get();
        $heading = "Manage Students";
        $sub_heading = "Students";
        return view("admin.manage-students.students", compact("heading", "sub_heading", "skills", "departments", "colleges", "data"));
    }

    public function add_students(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'college' =>  'required|integer',
            'department' =>  'required|integer',
            'email_id' =>  'required|email',
            'mobile_no' =>  'required|integer',
            'register_no' =>  'required',
            'semester' =>  'required|integer',
            'skills' =>  'required|array',
            'student_name' =>  'required',
            'year' =>  'required|integer',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->messages());
        }

        $skills_id = implode(',', $request->input('skills'));

        $values = DB::table('master_students')->insert([
            'student_name' => $request->input('student_name'),
            'register_no' => $request->input('register_no'),
            'department_id' => $request->input('department'),
            'mobile_no' => $request->input('mobile_no'),
            'semester' => $request->input('semester'),
            'college_id' => $request->input('college'),
            'skills_id' => $skills_id,
            'year' => $request->input('year'),
            'email_id' => $request->input('email_id'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($values) {
            Session::flash('success', 'Student Added Successfully !');
        } else {
            Session::flash('error', 'Something went wrong');
        }
    }

    public function studentsGroup()
    {
        $heading = "Manage Students";
        $sub_heading = "Students Group";
        return view("admin.manage-students.students-group", compact("heading", "sub_heading"));
    }


    public function importstudents()
    {
        $heading = "Manage Students";
        $sub_heading = "Import Students";
        return view("admin.manage-students.import-students", compact("heading", "sub_heading"));
    }

    public function import_students_group()
    {
        $heading = "Manage Students";
        $sub_heading = "Import Students Group";
        return view("admin.manage-students.import-students-group", compact("heading", "sub_heading"));
    }

    public function addnew_group()
    {
        $heading = "Manage Students";
        $sub_heading = "Add New Group";
        return view('admin.manage-students.add-students-group', compact('heading', 'sub_heading'));
    }

    public function edit_students_group()
    {
        $heading = "Manage Students";
        $sub_heading = "Edit Group";
        return view("admin.manage-students.edit-students-group", compact("heading", "sub_heading"));
    }
}
