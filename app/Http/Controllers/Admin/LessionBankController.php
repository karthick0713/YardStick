<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LessionBankController extends Controller
{
    public function index()
    {
        $heading = "Lession Bank";
        return view('admin.lession-bank', compact('heading'));
    }
}
