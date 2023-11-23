<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        $data = DB::table('master_profile')->where('user_id', Session::get('userId'))->first();
        $heading = "Profile";
        $sub_heading = "";
        return view('admin.admin-profile', compact('heading', 'sub_heading', 'data'));
    }

    public function editProfile()
    {
        $data = DB::table('master_profile')->where('user_id', Session::get('userId'))->first();
        $skills = DB::table('master_skills')
            ->where('trash_key', 1)
            ->where('is_active', 1)
            ->get();

        $heading = "Profile";
        $sub_heading = "Edit";
        return view('admin.edit-profile', compact('heading', 'sub_heading', 'data', 'skills'));
    }

    public function admin_profile_edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'user_image' => 'image|mimes:jpeg,png,jpg,gif|max:6144',
            'email_id' => 'required',
            'password' => 'required',
            'contact_no' => 'required',
            'address' => 'required',
            'skills_id' => 'required',
            'certifications' => 'required',
            'projects_done' => 'required',
            'security_questions' => 'required',
            'primary_mobile_no' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors()]);
        }

        $skillsString = $request->input('skills_id');

        $skills_id = implode(',', $skillsString);;


        if ($request->hasFile('user_image') && $request->file('user_image')->isValid()) {

            $imagePath = $request->file('user_image')->storeAs('assets/img/profile', uniqid('', true) . '.' . $request->file('user_image')->getClientOriginalExtension(), 'public');
            $value = DB::table('master_profile')->where('user_id', Session::get('userId'))->update([
                'name' => $request->input('user_name'),
                'profile_image' => $imagePath,
                'email_id' => $request->input('email_id'),
                'password' => ($request->input('password')),
                'contact_no' => $request->input('contact_no'),
                'address' => $request->input('address'),
                'skills_id' => $skills_id,
                'certifications' => $request->input('certifications'),
                'projects_done' => $request->input('projects_done'),
                'security_questions' => $request->input('security_questions'),
                'primary_mobile_no' => $request->input('primary_mobile_no'),
            ]);
        } else {
            $value = DB::table('master_profile')->where('user_id', Session::get('userId'))->update([
                'name' => $request->input('user_name'),
                'email_id' => $request->input('email_id'),
                'password' => ($request->input('password')),
                'contact_no' => $request->input('contact_no'),
                'address' => $request->input('address'),
                'skills_id' => $skills_id,
                'certifications' => $request->input('certifications'),
                'projects_done' => $request->input('projects_done'),
                'security_questions' => $request->input('security_questions'),
                'primary_mobile_no' => $request->input('primary_mobile_no'),
            ]);
        }

        if ($value) {
            session()->flash('success', 'Updated Successfully!');
            return response(['message' => 'Updated Successfully']);
        } else {
            session()->flash('error', 'Something went wrong !');
            return response(['message' => "Something went wrong"]);
        }
    }
}