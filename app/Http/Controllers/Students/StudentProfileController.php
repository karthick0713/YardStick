<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    public function index(){
        $heading = "Profile";
        $sub_heading = "";
        return view('students.student-profile',compact('heading','sub_heading'));
    }

    public function editProfile(){
        $heading = "Profile";
        $sub_heading = "Edit";
        return view('students.edit-student-profile',compact('heading','sub_heading'));
    }
}