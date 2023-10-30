<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageTestController extends Controller
{
    public function index()
    {
        $heading = "Manage Tests";
        return view("admin.manage-test", compact('heading'));
    }
}
