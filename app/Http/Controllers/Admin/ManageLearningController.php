<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageLearningController extends Controller
{
    public function index()
    {
        $heading = "Manage Learning";
        return view("admin.manage-learning", compact('heading'));
    }
}
