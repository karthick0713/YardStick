<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionBankController extends Controller
{
    public function index()
    {
        $heading = "Question Bank";
        return view("admin.question-bank", compact("heading"));
    }
}
