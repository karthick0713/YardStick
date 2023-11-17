<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageCollegeController extends Controller
{
    public function colleges()
    {
        $heading = "Manage Colleges";
        $sub_heading = "Colleges";
        return view("admin.manage-colleges.colleges", compact("heading", "sub_heading"));
    }

    public function importcolleges()
    {
        $heading = "Manage Colleges";
        $sub_heading = "Import Colleges";
        return view("admin.manage-colleges.import-colleges", compact("heading", "sub_heading"));
    }
}
