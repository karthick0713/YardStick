<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Str;

class StudentsReportController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set("Asia/Kolkata");
    }


    public function student_reports()
    {
        $heading = "Reports";
        $sub_heading = "";

        return view('admin.manage-reports.student-reports', compact('heading', 'sub_heading'));
    }
}