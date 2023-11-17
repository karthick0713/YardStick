<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageStudentsController extends Controller
{
    public function students()
    {
        $heading = "Manage Students";
        $sub_heading = "Students";
        return view("admin.manage-students.students", compact("heading", "sub_heading"));
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