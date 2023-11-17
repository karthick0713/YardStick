<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MastersController extends Controller
{
    public function difficulty(){
        $heading = "Masters";
        $sub_heading = "Manage Difficulty";
        return view('admin.masters.difficulty',compact('heading','sub_heading'));
    }

    public function skills(){
        $heading = "Masters";
        $sub_heading = "Manage Skills";
        return view('admin.masters.skills',compact('heading','sub_heading'));
    }

    public function department(){
        $heading = "Masters";
        $sub_heading = "Manage Department";
        return view('admin.masters.department',compact('heading','sub_heading'));
    }

    public function batch(){
        $heading = "Masters";
        $sub_heading = "Manage Batch";
        return view('admin.masters.batch',compact('heading','sub_heading'));
    }

    public function semester(){
        $heading = "Masters";
        $sub_heading = "Manage Semester";
        return view('admin.masters.semester',compact('heading','sub_heading'));
    }

    public function topics(){
        $heading = "Masters";
        $sub_heading = "Manage Topics";
        return view('admin.masters.topics',compact('heading','sub_heading'));
    }
}
