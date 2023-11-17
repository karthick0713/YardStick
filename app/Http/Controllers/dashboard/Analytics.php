<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {
    $heading = 'Dashboard';
    $sub_heading = '';
    return view('content.dashboard.dashboards-analytics', compact('heading', 'sub_heading'));
  }
}
