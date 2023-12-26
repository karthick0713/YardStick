<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class MastersController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set("Asia/Kolkata");
    }

    //difficulty view page
    public function difficulty()
    {

        $data = DB::table('master_difficulties')->where('trash_key', 1)->get();
        $heading = "Masters";
        $sub_heading = "Manage Difficulty";
        return view('admin.masters.difficulty', compact('heading', 'sub_heading', 'data'));
    }

    // add new difficulty
    public function difficulty_add(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'difficulty' => 'required',
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->errors()->all();
            Session::flash('error', $errorMessages);
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = [
            'difficulty_name' => $request->input('difficulty'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if (DB::table('master_difficulties')->insert($data)) {
            Session::flash('success', 'Added successfully!');
            return response()->json(['message' => 'Inserted successfully!']);
        } else {
            Session::flash('error', 'Something went wrong!');
            return response()->json(['message' => 'Something went wrong!']);
        }
    }
    

    //edit difficulty status
    public function difficulty_status(Request $request)
    {
        $val =  DB::table('master_difficulties')->where('difficulty_id', $request->input('value'))->first();

        if ($val->is_active == 1) {
            $data['is_active'] = 2;
            $data['updated_at'] = now();
        } else {
            $data['is_active'] = 1;
            $data['updated_at'] = now();
        }

        DB::table('master_difficulties')->where('difficulty_id', $request->input('value'))->update($data);

        return response()->json(['message' => ' Updated successfully!']);
    }

    //edit difficulty
    public function edit_difficulty(Request $request)
    {

        $value = DB::table('master_difficulties')->where('difficulty_id', $request->input('id'))->update([
            'difficulty_name' => $request->input('difficulty'),
            'updated_at' => now(),
        ]);
        if ($value) {
            Session::flash('success', 'Updated successfully!');
        } else {
            Session::flash('error', 'Something went wrong!');
        }
    }

    // delete difficulty
    public function delete_difficulty(Request $request)
    {
        $value = DB::table('master_difficulties')->where('difficulty_id', $request->input('id'))->update(['trash_key' => 2]); // change the trash key to 2.
        if ($value) {
            Session::flash('success', 'Deleted successfully!');
        } else {
            Session::flash('error', 'Something went wrong!');
        }
    }



    //skill view page
    public function skills()
    {
        $data = DB::table('master_skills')->where('trash_key', 1)->get();
        $heading = "Masters";
        $sub_heading = "Manage Skills";
        return view('admin.masters.skills', compact('heading', 'sub_heading', 'data'));
    }

    //add new skill

    public function skills_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'skill_logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'skill_name' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
        }

        $imagePath = $request->file('skill_logo')->storeAs('assets/img/lang-icons', uniqid('', true) . '.' . $request->file('skill_logo')->getClientOriginalExtension(), 'public');

        $value = DB::table('master_skills')->insert([
            'logo' => $imagePath,
            'skill_name' => $request->input('skill_name'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($value) {
            Session::flash('success', 'Added successfully!');
            return response()->json(['message' => ' Updated successfully!']);
        } else {
            Session::flash('error', 'Something went wrong!');
        }
    }

    //edit skill

    public function edit_skills(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'skill_name' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
        }

        if ($request->hasFile('skill_logo') && $request->file('skill_logo')->isValid()) {
            $imagePath = $request->file('skill_logo')->storeAs('assets/img/lang-icons', uniqid('', true) . '.' . $request->file('skill_logo')->getClientOriginalExtension(), 'public');
            $value = DB::table('master_skills')->where('skill_id', $request->input('skill_id'))->update([
                'logo' => $imagePath,
                'skill_name' => $request->input('skill_name'),
                'updated_at' => now(),
            ]);
        } else {
            $value = DB::table('master_skills')->where('skill_id', $request->input('skill_id'))->update([
                'skill_name' => $request->input('skill_name'),
                'updated_at' => now(),
            ]);
        }
        if ($value) {
            Session::flash('success', 'Updated successfully!');
            return response()->json(['message' => ' Updated successfully!']);
        } else {
            Session::flash('error', 'Something went wrong!');
        }
    }

    // change skill status
    public function skill_status(Request $request)
    {

        $val =  DB::table('master_skills')->where('skill_id', $request->input('value'))->first();

        if ($val->is_active == 1) {
            $data['is_active'] = 2;
            $data['updated_at'] = now();
        } else {
            $data['is_active'] = 1;
            $data['updated_at'] = now();
        }

        DB::table('master_skills')->where('skill_id', $request->input('value'))->update($data);
        return response()->json(['message' => $request->input('value')]);
    }

    // Delete skills
    public function delete_skill(Request $request)
    {
        $value = DB::table('master_skills')->where('skill_id', $request->input('id'))->update(['trash_key' => 2]); // change the trash key to 2.
        if ($value) {
            Session::flash('success', 'Deleted successfully!');
        } else {
            Session::flash('error', 'Something went wrong!');
        }
    }


    // topic view page
    public function topics()
    {
        $fetch_skills = DB::table('master_skills')
            ->where('trash_key', 1)
            ->where('is_active', 1)
            ->get();

        $data = DB::table('master_topics')
            ->where('trash_key', 1)
            ->get();
        $heading = "Masters";
        $sub_heading = "Manage Topics";
        return view('admin.masters.topics', compact('heading', 'sub_heading', 'data', 'fetch_skills'));
    }


    // Add new topic

    public function add_topic(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'topic_name' => 'required',
            'skills' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
        }

        $skills = implode(',', $request->input('skills'));

        $value = DB::table('master_topics')->insert([
            'topic_name' => $request->input('topic_name'),
            'skills_id' => $skills,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($value) {
            Session::flash('success', 'Added successfully!');
            return response()->json(['message' => ' Added successfully!']);
        } else {
            Session::flash('error', 'Something went wrong!');
            return response()->json(['message' => $request->input('skills')]);
        }
    }

    // edit topic

    public function edit_topic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topic_name' => 'required',
            'skills' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
        }

        $skills = implode(',', $request->input('skills'));

        $value = DB::table('master_topics')->where('topic_id', $request->input('topic_id'))->update([
            'topic_name' => $request->input('topic_name'),
            'skills_id' => $skills,
            'updated_at' => now(),
        ]);

        if ($value) {
            Session::flash('success', 'Updated successfully!');
            return response()->json(['message' => 'Updated successfully!']);
        } else {
            Session::flash('error', 'Something went wrong!');
        }
    }


    // change topic status
    public function topic_status(Request $request)
    {

        $val =  DB::table('master_topics')->where('topic_id', $request->input('value'))->first();

        if ($val->is_active == 1) {
            $data['is_active'] = 2;
            $data['updated_at'] = now();
        } else {
            $data['is_active'] = 1;
            $data['updated_at'] = now();
        }

        DB::table('master_topics')->where('topic_id', $request->input('value'))->update($data);

        return response()->json(['message' => $request->input('value')]);
    }


    // delete topics
    public function delete_topic(Request $request)
    {
        $value = DB::table('master_topics')->where('topic_id', $request->input('topic_id'))->update(['trash_key' => 2]); // change the trash key to 2.
        if ($value) {
            Session::flash('success', 'Deleted successfully!');
            return response()->json(['message' => 'Deleted successfully!']);
        } else {
            Session::flash('error', 'Something went wrong!');
            return response()->json(['message' => 'Something went wrong!']);
        }
    }


    // department view page
    public function department()
    {
        $data = DB::table('master_departments')
            ->where('trash_key', 1)
            ->get();
        $heading = "Masters";
        $sub_heading = "Manage Departments";
        return view('admin.masters.department', compact('heading', 'data', 'sub_heading'));
    }

    // add new department
    public function add_department(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
        }

        $value = DB::table('master_departments')->insert([
            'department_name' => $request->input('department'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($value) {
            Session::flash('success', 'Added successfully!');
            return response()->json(['message' => 'Added successfully!']);
        } else {
            Session::flash('error', 'Something went wrong!');
            return response()->json(['message' => $request->input('department_name')]);
        }
    }

    // edit department status
    public function department_status(Request $request)
    {

        $val =  DB::table('master_departments')->where('department_id', $request->input('value'))->first();

        if ($val->is_active == 1) {
            $data['is_active'] = 2;
            $data['updated_at'] = now();
        } else {
            $data['is_active'] = 1;
            $data['updated_at'] = now();
        }

        DB::table('master_departments')->where('department_id', $request->input('value'))->update($data);

        return response()->json(['message' => $request->input('value')]);
    }

    // edit department 
    public function edit_department(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
        }

        $value = DB::table('master_departments')->where('department_id', $request->input('id'))->update([
            'department_name' => $request->input('department'),
            'updated_at' => now(),
        ]);

        if ($value) {
            Session::flash('success', 'Updated successfully!');
            return response()->json(['message' => 'Updated successfully!']);
        } else {
            Session::flash('error', 'Something went wrong!');
            return response()->json(['message' => $request->input('department_name')]);
        }
    }

    // delete  department
    public function delete_department(Request $request)
    {
        $value = DB::table('master_departments')->where('department_id', $request->input('id'))->update(['trash_key' => 2]); // change the trash key to 2.
        if ($value) {
            Session::flash('success', 'Deleted successfully!');
            return response()->json(['message' => 'Deleted successfully!']);
        } else {
            Session::flash('error', 'Something went wrong!');
            return response()->json(['message' => 'Something went wrong!']);
        }
    }

    // manage categories

    public function categories(Request $request)
    {
        $heading = "Masters";
        $sub_heading = "Categories";
        $data = DB::table('master_categories')->where('trash_key', 1)->get();
        return view('admin.masters.categories', compact('heading', 'sub_heading', 'data'));
    }


    public function category_add(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category' => 'required',
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->errors()->all();
            Session::flash('error', $errorMessages);
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = [
            'category_name' => $request->input('category'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if (DB::table('master_categories')->insert($data)) {
            Session::flash('success', 'Added successfully!');
            return response()->json(['message' => 'Inserted successfully!']);
        } else {
            Session::flash('error', 'Something went wrong!');
            return response()->json(['message' => 'Something went wrong!']);
        }
    }

    //edit category status
    public function category_status(Request $request)
    {

        $val =  DB::table('master_categories')->where('category_id', $request->input('value'))->first();

        if ($val->is_active == 1) {
            $data['is_active'] = 2;
            $data['updated_at'] = now();
        } else {
            $data['is_active'] = 1;
            $data['updated_at'] = now();
        }

        DB::table('master_categories')->where('category_id', $request->input('value'))->update($data);

        return response()->json(['message' => ' Updated successfully!']);
    }

    //edit category
    public function edit_category(Request $request)
    {

        $value = DB::table('master_categories')->where('category_id', $request->input('id'))->update([
            'category_name' => $request->input('category'),
            'updated_at' => now(),
        ]);
        if ($value) {
            Session::flash('success', 'Updated successfully!');
        } else {
            Session::flash('error', 'Something went wrong!');
        }
    }

    // delete category
    public function delete_category(Request $request)
    {
        $value = DB::table('master_categories')->where('category_id', $request->input('id'))->update(['trash_key' => 2]); // change the trash key to 2.
        if ($value) {
            Session::flash('success', 'Deleted successfully!');
        } else {
            Session::flash('error', 'Something went wrong!');
        }
    }
}