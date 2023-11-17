<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        $heading= "Report";
        $sub_heading="";
        return view('students.report',compact('heading','sub_heading'));
    }
}