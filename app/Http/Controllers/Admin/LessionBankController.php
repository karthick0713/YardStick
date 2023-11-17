<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LessionBankController extends Controller
{
    public function index()
    {
        $heading = "Lession Bank";
        $sub_heading = "";
        return view('admin.lession-bank', compact('heading','sub_heading'));
    }
}
