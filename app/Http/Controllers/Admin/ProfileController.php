<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $heading = "Profile";
        $sub_heading = "";
        return view('admin.admin-profile',compact('heading','sub_heading'));
    }

    public function editProfile(){
        $heading = "Profile";
        $sub_heading = "Edit";
        return view('admin.edit-profile',compact('heading','sub_heading'));
    }
}
