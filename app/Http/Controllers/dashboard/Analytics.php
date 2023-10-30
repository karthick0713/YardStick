<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {
    $heading = 'Dashboard';
    return view('content.dashboard.dashboards-analytics', compact('heading'));
  }
}
