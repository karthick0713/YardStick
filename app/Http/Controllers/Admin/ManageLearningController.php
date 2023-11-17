<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageLearningController extends Controller
{
    public function practice_set()
    {
        $heading = "Manage Learning";
        $sub_heading = "Practice Set";
        return view("admin.manage-learning.practice-set", compact('heading', 'sub_heading'));
    }

    public function lessions()
    {
        $heading = "Manage Learning";
        $sub_heading = "Lessions";
        return view("admin.manage-learning.lessions", compact('heading', 'sub_heading'));
    }
    public function videos()
    {
        $heading = "Manage Learning";
        $sub_heading = "Videos";
        return view("admin.manage-learning.videos", compact('heading', 'sub_heading'));
    }
}
