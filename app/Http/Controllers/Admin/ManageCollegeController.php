<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ManageCollegeController extends Controller
{
    public function colleges()
    {
        $states = DB::table('state_list')->get();
        $data = DB::table('master_colleges')
            ->leftJoin('state_list', 'state_list.id', '=', 'master_colleges.state_id')
            ->select('master_colleges.*', 'state_list.*')
            ->where('master_colleges.trash_key', 1)
            ->get();
        $heading = "Manage Colleges";
        $sub_heading = "Colleges";
        return view("admin.manage-colleges.colleges", compact("heading", "sub_heading", 'states', 'data'));
    }

    public function add_college(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'college_name' => 'required',
            'email_id' => 'required',
            'mobile_no' => 'required',
            'alternate_mobile' => 'required',
            'address_1' => 'required',
            'address_2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
        }

        $value = DB::table('master_colleges')->insert([
            'college_name' => $request->input('college_name'),
            'email_id' => $request->input('email_id'),
            'primary_mobile_no' => $request->input('mobile_no'),
            'alternate_mobile_no' => $request->input('alternate_mobile'),
            'address_1' => $request->input('address_1'),
            'address_2' => $request->input('address_2'),
            'city' => $request->input('city'),
            'state_id' => $request->input('state'),
            'country' => $request->input('country'),
            'pincode' => $request->input('pincode'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($value) {
            Session::flash('success', 'Added successfully!');
            return response()->json(['message' => 'Added successfully!']);
        } else {
            Session::flash('success', 'Something Went Wrong!');
            return response()->json(['message' => 'Something Went Wrong!']);
        }
    }


    public function edit_college(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'edit_college_name' => 'required',
            'edit_email' => 'required',
            'edit_mobile_no' => 'required',
            'edit_alternate_mobile' => 'required',
            'edit_address_1' => 'required',
            'edit_address_2' => 'required',
            'edit_city' => 'required',
            'edit_state' => 'required',
            'edit_country' => 'required',
            'edit_pincode' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
        }

        $value = DB::table('master_colleges')->where('college_id', $request->input('college_id'))->update([
            'college_name' => $request->input('edit_college_name'),
            'email_id' => $request->input('edit_email'),
            'primary_mobile_no' => $request->input('edit_mobile_no'),
            'alternate_mobile_no' => $request->input('edit_alternate_mobile'),
            'address_1' => $request->input('edit_address_1'),
            'address_2' => $request->input('edit_address_2'),
            'city' => $request->input('edit_city'),
            'state_id' => $request->input('edit_state'),
            'country' => $request->input('edit_country'),
            'pincode' => $request->input('edit_pincode'),
            'updated_at' => now(),
        ]);

        if ($value) {
            Session::flash('success', 'Updated successfully!');
            return response()->json(['message' => 'Updated successfully!']);
        } else {
            Session::flash('error', 'Something Went Wrong!');
            return response()->json(['message' => 'Something Went Wrong!']);
        }
    }

    public function college_status(Request $request)
    {
        $value = DB::table('master_colleges')->where('college_id', $request->input('college_id'))->update([
            'is_active' => $request->input('is_active'),
            'updated_at' => now(),
        ]);

        if ($value) {
            return response()->json(['message' => 'Status Changed successfully!']);
        } else {
            return response()->json(['message' => 'Something Went Wrong!']);
        }
    }

    public function delete_college(Request $request)
    {
        $value = DB::table('master_colleges')->where('college_id', $request->input('college_id'))->update([
            'trash_key' => 2,
            'updated_at' => now(),
        ]);
        if ($value) {
            Session::flash('success', 'Deleted successfully!');
            return response()->json(['message' => 'Deleted successfully!']);
        } else {
            Session::flash('error', 'Something Went Wrong!');
            return response()->json(['message' => $request->all()]);
        }
    }

    public function importcolleges()
    {
        $heading = "Manage Colleges";
        $sub_heading = "Import Colleges";
        return view("admin.manage-colleges.import-colleges", compact("heading", "sub_heading"));
    }
}
