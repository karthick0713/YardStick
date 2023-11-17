<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $heading = "Dashboard";
        $sub_heading="";
        return view('students.student-dashboard',compact('heading','sub_heading'));
    }
}