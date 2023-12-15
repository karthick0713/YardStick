<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageCourseController extends Controller
{
    public function manage_courses()
    {
        $heading = 'Manage Courses';
        $sub_heading = "Courses";
        return view('admin.manage-courses.courses', compact('heading', 'sub_heading'));
    }
}
