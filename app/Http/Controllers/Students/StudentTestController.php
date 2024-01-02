<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;

class StudentTestController extends Controller
{
    public function test_overview($id)
    {
        $heading = "Test OverView";
        $sub_heading = "";
        $tests = DB::table('course_test_parameters')->where('course_id', $id)->get();
        $test_params = [];
        $test_sections = [];
        foreach ($tests as $t) {
            $test_params[] = DB::table('test_creation')->where('test_code', $t->test_code)->first();
            $test_sections[] = DB::table('test_section_wise_questions')->where('test_code', $t->test_code)->get();
        }

        return view('students.tests.student-test-view', compact('heading', 'sub_heading', 'test_params', 'tests', 'test_sections'));
    }
}
