<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoBankController extends Controller
{
    public function index()
    {
        $heading = "Video Bank";
        $sub_heading = "";
        return view('admin.video-bank', compact('heading','sub_heading'));
    }
}
