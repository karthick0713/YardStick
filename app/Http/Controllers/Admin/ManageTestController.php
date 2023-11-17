<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageTestController extends Controller
{
    public function createTest()
    {
        $heading = "Manage Tests";
        $sub_heading = "Create Contest";
        return view("admin.manage-test.manage-test", compact('heading', 'sub_heading'));
    }

    public function createQuiz()
    {
        $heading = "Manage Tests";
        $sub_heading = "Create Quiz";
        return view("admin.manage-test.create-quiz", compact('heading', 'sub_heading'));
    }

    public function addTest()
    {
        $heading = "Manage Tests";
        $sub_heading = "Create Contest";
        return view("admin.manage-test.add-test", compact('heading', 'sub_heading'));
    }

    public function create_new_test()
    {
        $heading = "Manage Tests";
        $sub_heading = "Create New Test";
        return view("admin.manage-test.create-test", compact('heading', 'sub_heading'));
    }
}