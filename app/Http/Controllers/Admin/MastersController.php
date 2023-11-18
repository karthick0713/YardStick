<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class MastersController extends Controller
{
    public function difficulty()
    {
        $heading = "Masters";
        $sub_heading = "Manage Difficulty";
        return view('admin.masters.difficulty', compact('heading', 'sub_heading'));
    }

    public function difficulty_add(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'difficulty' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $data = [
                'difficulty_name' => $request->input('difficulty'),
            ];

            if (DB::table('master_difficulties')->insert($data)) {
                return response()->json(['message' => 'Data inserted successfully']);
            } else {
                Log::error('Error inserting data into master_difficulties');
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function skills()
    {
        $heading = "Masters";
        $sub_heading = "Manage Skills";
        return view('admin.masters.skills', compact('heading', 'sub_heading'));
    }

    public function department()
    {
        $heading = "Masters";
        $sub_heading = "Manage Department";
        return view('admin.masters.department', compact('heading', 'sub_heading'));
    }

    public function batch()
    {
        $heading = "Masters";
        $sub_heading = "Manage Batch";
        return view('admin.masters.batch', compact('heading', 'sub_heading'));
    }

    public function semester()
    {
        $heading = "Masters";
        $sub_heading = "Manage Semester";
        return view('admin.masters.semester', compact('heading', 'sub_heading'));
    }

    public function topics()
    {
        $heading = "Masters";
        $sub_heading = "Manage Topics";
        return view('admin.masters.topics', compact('heading', 'sub_heading'));
    }
}
