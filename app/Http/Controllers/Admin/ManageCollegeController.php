<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ManageCollegeController extends Controller
{

    protected function validateMobileNumber($mobileNumber)
    {
        $mobileString = implode('', $mobileNumber);
        return preg_match('/^\d{10}$/', $mobileString);
    }

    public function colleges()
    {
        $states = DB::table('state_list')->get();
        $data = DB::table('master_colleges')
            ->leftJoin('state_list', 'state_list.id', '=', 'master_colleges.state_id')
            ->select('master_colleges.*', 'state_list.*')
            ->where('master_colleges.trash_key', 1)
            ->where('master_colleges.error_key', 0)
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
            'error_key' => 0,
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

    public function import_college_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uploaded_file' => 'required|file|mimes:xls,xlsx,csv',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
        }

        if ($request->hasFile('uploaded_file') && $request->file('uploaded_file')->isValid()) {

            DB::table('master_colleges')
                ->whereIn('error_key', [1, 2])
                ->delete();

            $the_file = $request->file('uploaded_file');
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range = range(3, $row_limit);
            $column_range = range('F', $column_limit);
            $startcount = 2;
            $values = [];
            $values2 = [];
            $db_val = DB::table('master_colleges')->where('trash_key', 1)->get();
            foreach ($row_range as $row) {
                $error_key = 0;
                $error_key1 = 1;
                if (
                    preg_match('/^(\d{10})$/', $sheet->getCell('D' . $row)->getValue()) &&
                    preg_match('/^(\d{10})$/', $sheet->getCell('E' . $row)->getValue()) &&
                    preg_match('/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/', $sheet->getCell('C' . $row)->getValue()) &&
                    preg_match('/^\d{1,2}$/', $sheet->getCell('I' . $row)->getValue()) &&
                    preg_match('/^[1-9][0-9]{5}$/', $sheet->getCell('K' . $row)->getValue())
                ) {
                    foreach ($db_val as $val) {
                        if (
                            $val->primary_mobile_no == $sheet->getCell('D' . $row)->getValue() ||
                            $val->alternate_mobile_no == $sheet->getCell('E' . $row)->getValue() ||
                            $val->email_id == $sheet->getCell('C' . $row)->getValue()
                        ) {
                            $error_key = 2;
                        }
                    }

                    $data = [
                        'college_name' => $sheet->getCell('B' . $row)->getValue(),
                        'email_id' => $sheet->getCell('C' . $row)->getValue(),
                        'primary_mobile_no' => $sheet->getCell('D' . $row)->getValue(),
                        'alternate_mobile_no' => $sheet->getCell('E' . $row)->getValue(),
                        'address_1' => $sheet->getCell('F' . $row)->getValue(),
                        'address_2' => $sheet->getCell('G' . $row)->getValue(),
                        'city' => $sheet->getCell('H' . $row)->getValue(),
                        'state_id' => $sheet->getCell('I' . $row)->getValue(),
                        'country' => $sheet->getCell('J' . $row)->getValue(),
                        'pincode' => $sheet->getCell('K' . $row)->getValue(),
                        'error_key' => $error_key, // correct data
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $values[] = DB::table('master_colleges')->insertGetId($data);
                } else {
                    foreach ($db_val as $val) {
                        if (
                            $val->primary_mobile_no == $sheet->getCell('D' . $row)->getValue() ||
                            $val->alternate_mobile_no == $sheet->getCell('E' . $row)->getValue() ||
                            $val->email_id == $sheet->getCell('C' . $row)->getValue()
                        ) {
                            $error_key1 = 2;
                        }
                    }
                    $data = [
                        'college_name' => $sheet->getCell('B' . $row)->getValue(),
                        'email_id' => $sheet->getCell('C' . $row)->getValue(),
                        'primary_mobile_no' => $sheet->getCell('D' . $row)->getValue(),
                        'alternate_mobile_no' => $sheet->getCell('E' . $row)->getValue(),
                        'address_1' => $sheet->getCell('F' . $row)->getValue(),
                        'address_2' => $sheet->getCell('G' . $row)->getValue(),
                        'city' => $sheet->getCell('H' . $row)->getValue(),
                        'state_id' => $sheet->getCell('I' . $row)->getValue(),
                        'country' => $sheet->getCell('J' . $row)->getValue(),
                        'pincode' => $sheet->getCell('K' . $row)->getValue(),
                        'error_key' => $error_key1, // Incorrect formatted data's
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];


                    $values2[] = DB::table('master_colleges')->insertGetId($data);
                }

                $startcount++;
            }

            if (count($values2) > 0) {
                return redirect()->route('edit-import-data');
            } else {
                return redirect()->route('managecolleges-colleges');
            }
        }
    }

    public function edit_import_data(Request $request)
    {
        $heading = "Manage Colleges";
        $sub_heading = "Import Colleges";
        $data = DB::table('master_colleges')->where('error_key', 1)->get();
        $dup_data = DB::table('master_colleges')->where('error_key', 2)->get();
        return view("admin.manage-colleges.error-data", compact("heading", "sub_heading", "data", 'dup_data'));
    }

    public function edit_data(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'college_name' => 'required',
            'email_id' => 'required',
            'primary_mobile_no' => 'required|max:15',
            'alternate_mobile_no' => 'required',
            'address_1' => 'required',
            'address_2' => 'required',
            'city' => 'required',
            'state_id' => 'required',
            'country' => 'required',
            'pincode' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
        }

        $update_data = array();

        for ($i = 0; $i < count($request->input('college_id')); $i++) {
            $update_data = [
                'college_name' => $request->input('college_name')[$i],
                'email_id' => $request->input('email_id')[$i],
                'primary_mobile_no' => $request->input('primary_mobile_no')[$i],
                'alternate_mobile_no' => $request->input('alternate_mobile_no')[$i],
                'address_1' => $request->input('address_1')[$i],
                'address_2' => $request->input('address_2')[$i],
                'city' => $request->input('city')[$i],
                'state_id' => $request->input('state_id')[$i],
                'country' => $request->input('country')[$i],
                'pincode' => $request->input('pincode')[$i],
                'error_key' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $college_id = $request->input('college_id')[$i];
            $value = DB::table('master_colleges')->where('college_id', $college_id)->update($update_data);
        }

        if ($value) {
            return redirect()->route('managecolleges-colleges');
        } else {
            return 'Something went wrong';
        }
    }
}
