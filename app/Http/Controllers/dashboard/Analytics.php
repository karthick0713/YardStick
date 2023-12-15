<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;

class Analytics extends Controller
{
  public function index()
  {
    $heading = 'Dashboard';
    $sub_heading = '';
    $total_questions = DB::table('question_banks')->where('is_active', 1)->where('trash_key', 1)->get()->count();
    $total_students = DB::table('master_students')->where('is_active', 1)->where('trash_key', 1)->where('error_key', 0)->get()->count();
    $total_colleges = DB::table('master_colleges')->where('is_active', 1)->where('trash_key', 1)->where('error_key', 0)->get()->count();
    $total_duration = DB::table('test_creation')->where('is_active', 1)->sum('duration');
    $total_duration_in_minutes = $total_duration;
    $total_duration_in_hours = $total_duration_in_minutes / 60;
    $total_duration_in_hours_rounded = round($total_duration_in_hours, 2);
    $data = [
      'total_questions' => $total_questions,
      'total_students' => $total_students,
      'total_colleges' => $total_colleges,
      'total_duration' => $total_duration_in_hours_rounded,
    ];

    return view('content.dashboard.dashboards-analytics', compact('heading', 'sub_heading', 'data'));
  }
}
