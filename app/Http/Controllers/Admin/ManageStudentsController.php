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

class ManageStudentsController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set("Asia/Kolkata");
    }

    public function students()
    {

        $skills = DB::table('master_skills')->where('trash_key', 1)->where('is_active', 1)->get();
        $colleges = DB::table('master_colleges')->where('trash_key', 1)->where('error_key', 0)->where('is_active', 1)->get();
        $departments = DB::table('master_departments')->where('trash_key', 1)->where('is_active', 1)->get();
        $data = DB::table('master_students')
            ->leftJoin('master_colleges', 'master_students.college_id', '=', 'master_colleges.college_id')
            ->select('master_colleges.college_name', 'master_students.*')
            ->where('master_students.trash_key', 1)
            ->where('master_students.error_key', 0)
            ->get();
        $heading = "Manage Students";
        $sub_heading = "Students";
        return view("admin.manage-students.students", compact("heading", "sub_heading", "skills", "departments", "colleges", "data"));
    }

    public function fetchData()
    {
        $query = DB::table('master_students')
            ->leftJoin('master_colleges', 'master_students.college_id', '=', 'master_colleges.college_id')
            ->select('master_colleges.college_name', 'master_students.*')
            ->where('master_students.trash_key', 1)
            ->where('master_students.error_key', 0)
            ->orderBy('master_students.created_at', 'desc')->get();

        return DataTables::of($query)->toJson();
    }

    public function add_students(Request $request)
    {

        $validator =  Validator::make($request->all(), [
            'college' =>  'required|integer',
            'department' =>  'required|integer',
            'email_id' =>  'required|email',
            'mobile_no' =>  'required|integer',
            'register_no' =>  'required',
            'semester' =>  'required|integer',
            'skills' =>  'required|array',
            'student_name' =>  'required',
            'year' =>  'required|integer',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->messages());
        }

        $skills_id = implode(',', $request->input('skills'));

        $data = [
            'student_name' => $request->input('student_name'),
            'register_no' => $request->input('register_no'),
            'department_id' => $request->input('department'),
            'mobile_no' => $request->input('mobile_no'),
            'semester' => $request->input('semester'),
            'college_id' => $request->input('college'),
            'skills_id' => $skills_id,
            'year' => $request->input('year'),
            'email_id' => $request->input('email_id'),
            'error_key' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ];


        $values = DB::table('master_students')->insert($data);

        // $user_data = DB::table('users')->insert([
        //     'name' => $request->input('student_name'),
        //     'email' => $request->input('email_id'),
        //     'password' => bcrypt($request->input('register_no')),
        //     'remember_token' => Str::random(60),
        //     'role' => 3,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);



        if ($values) {
            Session::flash('success', 'Student Added Successfully !');
        } else {
            Session::flash('error', 'Something went wrong');
        }
    }

    public function student_status(Request $request)
    {
        $value = DB::table('master_students')->where('student_id', $request->input('student_id'))->update([
            'is_active' => $request->input('is_active'),
            'updated_at' => now(),
        ]);

        if ($value) {
            return response()->json(['message' => 'Status Changed successfully!']);
        } else {
            return response()->json(['message' => 'Something Went Wrong!']);
        }
    }


    public function fetch_student_details(Request $request)
    {
        $value = DB::table('master_students')
            ->leftJoin('master_colleges', 'master_students.college_id', '=', 'master_colleges.college_id')
            ->leftJoin('master_departments', 'master_students.department_id', '=', 'master_departments.department_id')
            ->select('master_colleges.college_name', 'master_students.*', 'master_departments.department_name')
            ->where('master_students.student_id', $request->input('student_id'))
            ->first();

        switch ($value->year) {
            case 1:
                $year = '1st Year';
                break;
            case 2:
                $year = '2nd Year';
                break;
            case 3:
                $year = '3rd Year';
                break;
            case 4:
                $year = '4th Year';
                break;
        }

        switch ($value->semester) {
            case 1:
                $semester = '1st Semester';
                break;
            case 2:
                $semester = '2nd Semester';
                break;
            case 3:
                $semester = '3rd Semester';
                break;
            case 4:
                $semester = '4th Semester';
                break;
            case 5:
                $semester = '5th Semester';
                break;
            case 6:
                $semester = '6th Semester';
                break;
            case 7:
                $semester = '7th Semester';
                break;
            case 8:
                $semester = '8th Semester';
                break;
        }

        echo ' <tr><td>COLLEGE:</td><td class="fw-bold">' . $value->college_name . '</td></tr> 
                <tr><td>STUDENT NAME:</td><td class="fw-bold">' . $value->student_name . '</td></tr> 
                <tr><td>REGISTER NO:</td><td class="fw-bold">' . $value->register_no . '</td></tr> 
                <tr><td>DEPARTMENT:</td><td class="fw-bold">' . $value->department_name . '</td></tr> 
                <tr><td>YEAR:</td><td class="fw-bold">' . $year . '</td></tr> 
                <tr><td>SEMESTER:</td><td class="fw-bold">' . $semester . '</td></tr> 
                <tr><td>EMAIL ID:</td><td class="fw-bold">' . $value->email_id . '</td></tr> 
                <tr><td>MOBILE NO:</td><td class="fw-bold">' . $value->mobile_no . '</td></tr> ';
    }


    public function get_edit_data(Request $request)
    {
        $value = DB::table('master_students')
            ->leftJoin('master_colleges', 'master_students.college_id', '=', 'master_colleges.college_id')
            ->leftJoin('master_departments', 'master_students.department_id', '=', 'master_departments.department_id')
            ->select('master_colleges.college_name', 'master_students.*', 'master_departments.department_name')
            ->where('master_students.student_id', $request->input('student_id'))
            ->first();

        $colleges = DB::table('master_colleges')->where('trash_key', 1)->where('error_key', 0)->where('is_active', 1)->get();
        $skills = DB::table('master_skills')->where('trash_key', 1)->where('is_active', 1)->get();
        $departments = DB::table('master_departments')->where('trash_key', 1)->where('is_active', 1)->get();
        $student_skills = explode(',', $value->skills_id);
        $selectedSkills = json_encode($student_skills);
        echo '
        <link rel="stylesheet" href="';
        echo asset("assets/css/select2.css");
        echo '"></link>
        <script src="';
        echo asset("assets/js/select2.js");
        echo '"></script>
        <script src="';
        echo asset("assets/js/form-select.js");
        echo '"></script>
         <script>
        var selectedSkillIds = ';
        echo  $selectedSkills;
        echo '
        data2 = [];
        ';
        foreach ($skills as $skill) {
            echo ' 
            data2.push({
                id: "';
            echo $skill->skill_id;
            echo '",
                name: "';
            echo strtoupper($skill->skill_name);
            echo '",
            });
           ';
        }

        echo '</script>';
        echo '<div class="col-md-6 mb-3">
                    <label for="client" class="col-form-label">College:</label>
                    <select name="edit_college" class="form-control" required id="edit-college">';
        foreach ($colleges as $college) {
            echo '<option value="' . $college->college_id . '"';
            echo ($college->college_id == $value->college_id) ? ' selected' : '';
            echo '>' . $college->college_name . '</option>';
        }

        echo  '</select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="" class="col-form-label">Skills:</label>
                    <select name="edit_skills[]" id="select2Darks" class="select2 form-select" multiple>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                <label for="" class="col-form-label">Department:</label>
                <select name="edit_department" class="form-control" id="edit-department">
                    <option value="" disabled>SELECT</option>';
        foreach ($departments as $dept) {
            echo '<option value="' . $dept->department_id . '"';
            echo ($dept->department_id == $value->department_id) ? ' selected' : '';
            echo '>' . $dept->department_name . '</option>';
        }
        echo '
                </select>
            </div>

                <div class="col-md-6 mb-3">
                    <label for="edit-year" class="col-form-label">Year:</label>
                    <select name="edit_year" class="form-control" id="">
                        <option value="" disabled>SELECT</option>
                        <option value="1">1st Year</option>
                        <option value="2">2nd Year</option>
                        <option value="3">3rd Year</option>
                        <option value="4">4th Year</option>
                    </select>
                </div>
                <input type="hidden" name="student_id" id="student-id" >
                <div class="col-md-6 mb-3">
                    <label for="edit-semester" class="col-form-label">Semester:</label>
                    <select name="edit_semester" class="form-control" id="">
                        <option value="" disabled>SELECT</option>
                        <option value="1">First Semester</option>
                        <option value="2">Second Semester</option>
                        <option value="3">Third Semester</option>
                        <option value="4">Fourth Semester</option>
                        <option value="5">Fifth Semester</option>
                        <option value="6">Sixth Semester</option>
                        <option value="7">Seventh Semester</option>
                        <option value="8">Eighth Semester</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="edit-student-name" class="col-form-label">Student Name:</label>
                    <input type="text" class="form-control" value="" name="edit_student_name"
                        id="edit-student-name" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="edit-register-no" class="col-form-label">Register No:</label>
                    <input type="text" class="form-control"  name="edit_register_no"
                        id="edit-register-no" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="edit-email-id" class="col-form-label">Email Id:</label>
                    <input type="email" class="form-control" name="edit_email_id"
                        id="edit-email-id" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="edit-mobile-no" class="col-form-label">Mobile No:</label>
                    <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, ``)"
                        maxlength="10"  class="form-control" id="edit-mobile-no" name="edit_mobile_no"
                        required>
                </div>

                <script>
                    $("#edit-student-name").val(';
        echo "'$value->student_name'" . ')
                            $("#edit-register-no").val(';
        echo "'$value->register_no'" . ')
                            $("#edit-email-id").val(';
        echo "'$value->email_id'" . ')
                            $("#student-id").val(';
        echo "'$value->student_id'" . ')
                            $("#edit-mobile-no").val(';
        echo $value->mobile_no . ');

                     ';

        echo '  data2.map((item) => {
                        item.selected = selectedSkillIds.includes(item.id) ? true : false;
                        return item;
                    });
                    
                    data2.map((item) => {
                        var newOption = new Option(item.name, item.id, true, item.selected);
                        $("#select2Darks").append(newOption).trigger("change");
                    });
</script>
';
    }

    public function edit_students(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'edit_college' =>  'required|integer',
            'edit_department' =>  'required|integer',
            'edit_email_id' =>  'required|email',
            'edit_mobile_no' =>  'required|integer',
            'edit_register_no' =>  'required',
            'edit_semester' =>  'required|integer',
            'edit_skills' =>  'required|array',
            'edit_student_name' =>  'required',
            'edit_year' =>  'required|integer',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->messages());
        }

        $skills_id = implode(',', $request->input('edit_skills'));

        $values = DB::table('master_students')->where('student_id', $request->input('student_id'))->update([
            'student_name' => $request->input('edit_student_name'),
            'register_no' => $request->input('edit_register_no'),
            'department_id' => $request->input('edit_department'),
            'mobile_no' => $request->input('edit_mobile_no'),
            'semester' => $request->input('edit_semester'),
            'college_id' => $request->input('edit_college'),
            'skills_id' => $skills_id,
            'year' => $request->input('edit_year'),
            'email_id' => $request->input('edit_email_id'),
            'updated_at' => now()
        ]);

        if ($values) {
            Session::flash('success', 'Student Updated Successfully');
            return response()->json(['success' => true, 'message' => 'Updated Successfully']);
        } else {
            Session::flash('error', 'Something went wrong');
            return response()->json(['success' => false, 'message' => 'Something went wrong']);
        }
    }



    public function deleteStudent(Request $request)
    {
        $value = DB::table('master_students')->where('student_id', $request->input('student_id'))->update([
            'trash_key' => 2,
            'updated_at' => now(),
        ]);
        if ($value) {
            return response()->json(['message' => 'Status Changed successfully!']);
        } else {
            return response()->json(['message' => 'Something Went Wrong!']);
        }
    }



    public function importstudents()
    {
        $heading = "Manage Students";
        $sub_heading = "Import Students";
        return view("admin.manage-students.import-students", compact("heading", "sub_heading"));
    }

    public function excel_importstudents(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uploaded_file' => 'required|file|mimes:xls,xlsx,csv',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
        }
        if ($request->hasFile('uploaded_file') && $request->file('uploaded_file')->isValid()) {
            DB::table('master_students')
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
            $values3 = [];
            $db_val = DB::table('master_students')->where('trash_key', 1)->get();
            foreach ($row_range as $row) {
                $error_key = 0;
                $error_key1 = 1;
                if (
                    preg_match('/^(\d{10})$/', $sheet->getCell('J' . $row)->getValue()) &&
                    preg_match('/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/', $sheet->getCell('I' . $row)->getValue())
                ) {
                    foreach ($db_val as $val) {
                        if (
                            $val->register_no == $sheet->getCell('E' . $row)->getValue() ||
                            $val->email_id == $sheet->getCell('I' . $row)->getValue() ||
                            $val->mobile_no == $sheet->getCell('J' . $row)->getValue()
                        ) {
                            array_push($values3, $val->student_id);
                            $error_key = 2;
                        }
                    }

                    $data = [
                        'college_id' => $sheet->getCell('B' . $row)->getValue(),
                        'skills_id' => $sheet->getCell('C' . $row)->getValue(),
                        'student_name' => $sheet->getCell('D' . $row)->getValue(),
                        'register_no' => $sheet->getCell('E' . $row)->getValue(),
                        'department_id' => $sheet->getCell('F' . $row)->getValue(),
                        'year' => $sheet->getCell('G' . $row)->getValue(),
                        'semester' => $sheet->getCell('H' . $row)->getValue(),
                        'email_id' => $sheet->getCell('I' . $row)->getValue(),
                        'mobile_no' => $sheet->getCell('J' . $row)->getValue(),
                        'error_key' => $error_key, // correct data
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $values[] = DB::table('master_students')->insertGetId($data);
                } else {
                    foreach ($db_val as $val) {
                        if (
                            $val->register_no == $sheet->getCell('E' . $row)->getValue() ||
                            $val->email_id == $sheet->getCell('I' . $row)->getValue() ||
                            $val->mobile_no == $sheet->getCell('J' . $row)->getValue()
                        ) {
                            array_push($values3, $val->student_id);
                            $error_key1 = 2;
                        }
                    }
                    $data = [
                        'college_id' => $sheet->getCell('B' . $row)->getValue(),
                        'skills_id' => $sheet->getCell('C' . $row)->getValue(),
                        'student_name' => $sheet->getCell('D' . $row)->getValue(),
                        'register_no' => $sheet->getCell('E' . $row)->getValue(),
                        'department_id' => $sheet->getCell('F' . $row)->getValue(),
                        'year' => $sheet->getCell('G' . $row)->getValue(),
                        'semester' => $sheet->getCell('H' . $row)->getValue(),
                        'email_id' => $sheet->getCell('I' . $row)->getValue(),
                        'mobile_no' => $sheet->getCell('J' . $row)->getValue(),
                        'error_key' => $error_key1, // Incorrect data
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $values2[] = DB::table('master_students')->insertGetId($data);
                }
                $startcount++;
            }

            if (count($values2) > 0 || count($values3) > 0) {
                return redirect()->route('edit-imported-student-data');
            } else {
                Session::flash('success', 'Students Imported Successfully..!');
                return redirect()->route('manage-students-students');
            }
        } else {
            Session::flash('error', "No File Selected ..!");
            return redirect()->route('managestudents-importstudents');
        }
    }



    public function edit_import_student_data()
    {

        $heading = "Manage Students";
        $sub_heading = "Edit Imported Students Data";
        $students_data  =  DB::table('master_students')->where('trash_key', 1)->where('error_key', 0)->get();
        $data = DB::table('master_students')->where('error_key', 1)->get();
        $dup_data = DB::table('master_students')->where('error_key', 2)->get();
        return view("admin.manage-students.edit-import-student-data", compact("heading", "sub_heading", "dup_data", "data", "students_data"));
    }

    public function update_import_student_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'college_id' => 'required',
            'skills_id' => 'required',
            'student_name' => 'required',
            'register_no' => 'required',
            'email_id' => 'required',
            'mobile_no' => 'required',
            'department_id' => 'required',
            'year' => 'required',
            'semester' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
            return redirect()->back();
        }

        foreach ($request->input('student_name')  as $key => $students) {
            $insert_data = [
                'college_id' => $request->input('college_id')[$key],
                'skills_id' => $request->input('skills_id')[$key],
                'student_name' => $students,
                'email_id' => $request->input('email_id')[$key],
                'mobile_no' => $request->input('mobile_no')[$key],
                'register_no' => $request->input('register_no')[$key],
                'department_id' => $request->input('department_id')[$key],
                'year' => $request->input('year')[$key],
                'semester' => $request->input('semester')[$key],
                'error_key' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $value = DB::table('master_students')->insert($insert_data);
        }

        if ($value) {
            return redirect()->route('manage-students-students');
        }
    }

    public function studentsGroup()
    {
        $student_group = DB::table('student_group')
            ->leftJoin('master_departments', 'student_group.department_id', '=', 'master_departments.department_id')
            ->leftJoin('master_colleges', 'student_group.college_id', '=', 'master_colleges.college_id')
            ->select('student_group.*', 'master_colleges.college_name', 'master_departments.department_name')
            ->where('student_group.trash_key', 1)
            ->where('student_group.error_key', 0)
            ->get();
        $heading = "Manage Students";
        $sub_heading = "Students Group";
        return view("admin.manage-students.students-group", compact("heading", "sub_heading", "student_group"));
    }

    public function addnew_group()
    {

        $departments = DB::table('master_departments')->where('trash_key', 1)->where('is_active', 1)->get();
        $colleges = DB::table('master_colleges')->where('trash_key', 1)->where('is_active', 1)->where('error_key', 0)->get();
        $heading = "Manage Students";
        $sub_heading = "Add New Group";
        return view('admin.manage-students.add-students-group', compact('heading', 'sub_heading', 'colleges', 'departments'));
    }

    public function get_students_for_group(Request $request)
    {



        $value = DB::table('master_students')
            ->where('year', $request->input('year'))
            ->where('department_id', $request->input('department'))
            ->where('semester', $request->input('semester'))
            ->where('college_id', $request->input('college'))
            ->where('trash_key', 1)
            ->where('error_key', 0)
            ->where('is_active', 1)
            ->get();

        if (count($value) > 0) {
            echo ' <label class="mt-5 fw-bold">SELECT STUDENTS:</label>
            <div class="row col-12 mt-4">';
            foreach ($value as $val) {
                echo '
                    <div class="col-md-4">
                    <input type="checkbox" name="student_reg_no[]" value="' . $val->register_no . '" class="" id="">
                    <span class="checkbox-span">' . strtoupper($val->student_name) . '</span>
                </div>
                    ';
            }

            echo '</div>';
            echo ' 
            <script>
            $(".submit-btn").removeClass("d-none");
            </script>
            ';
        } else {
            echo '  
            <div class="row col-12 fw-bold text-center">
            <label class="mt-5">NO STUDENTS FOUND . . .</label>
            </div>  
            <script>
            $(".submit-btn").addClass("d-none");
            </script>
            ';
        }
    }


    public function save_group(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_name' => 'required',
            'college_id' => 'required|integer',
            'department_id' => 'required|integer',
            'year' => 'required|integer',
            'semester' => 'required|integer',
            'student_reg_no' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->all());
            return redirect()->back()->withInput();
        }

        $data = [
            'group_name' => $request->input('group_name'),
            'college_id' => $request->input('college_id'),
            'department_id' => $request->input('department_id'),
            'year' => $request->input('year'),
            'semester' => $request->input('semester'),
            'created_at' => now(),
            'updated_at' => now(),
            'error_key' => 0
        ];
        $groupId = DB::table('student_group')->insertGetId($data);

        foreach ($request->input('student_reg_no') as $val) {
            $student_data = DB::table('master_students')->where('register_no', $val)->where('error_key', 0)->first();
            $data = [
                'group_id' => $groupId,
                'students_name' => $student_data->student_name,
                'students_id' => $student_data->student_id,
                'register_no' => $val,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $values = DB::table('student_group_entry')->insert($data);
        }
        if ($values) {
            Session::flash('success', 'Group Added Successfully..!');
            return redirect()->back();
        }
    }


    public function get_group_students(Request $request)
    {
        $value = DB::table('student_group_entry')
            ->leftJoin('master_students', 'master_students.student_id', '=', 'student_group_entry.students_id')
            ->select('student_group_entry.*', 'master_students.*')
            ->where('student_group_entry.group_id', $request->input('id'))
            ->get();

        if (count($value) > 0) {
            foreach ($value as $key => $val) {
                echo '
                    <tr>
                        <td class="col">' . $key + 1 . '</td>
                        <td class="col">' . strtoupper($val->student_name) . '</td>
                    </tr>
                    ';
            }
        }
    }

    public function edit_students_group($id)
    {

        $departments = DB::table('master_departments')->where('trash_key', 1)->where('is_active', 1)->get();
        $colleges = DB::table('master_colleges')->where('trash_key', 1)->where('is_active', 1)->where('error_key', 0)->get();
        $group_data = DB::table('student_group')
            ->leftJoin('master_departments', 'student_group.department_id', '=', 'master_departments.department_id')
            ->leftJoin('master_colleges', 'student_group.college_id', '=', 'master_colleges.college_id')
            ->select('student_group.*', 'master_colleges.college_name', 'master_departments.department_name')
            ->where('student_group.group_id', $id)
            ->first();

        $heading = "Manage Students";
        $sub_heading = "Edit Group";
        return view("admin.manage-students.edit-students-group", compact("heading", "sub_heading", "group_data", "departments", "colleges"));
    }


    public function group_data_for_edit(Request $request)
    {

        $students = DB::table('master_students')
            ->where('trash_key', 1)
            ->where('error_key', 0)
            ->where('is_active', 1)
            ->get();

        $group_students = DB::table('student_group_entry')->where('group_id', $request->input('id'))->get();

        $data = [];
        foreach ($students as $stu) {
            $checked = $group_students->contains('students_id', $stu->student_id) ? 'checked' : '';
            $data[] = [
                'name' => strtoupper($stu->student_name),
                'register_no' => $stu->register_no,
                'checked' => $checked,
            ];
        }

        if (count($data) > 0) {
            foreach ($data as $keys) {
                echo '<div class="col-md-4">
                <input type="checkbox" name="student_reg_no[]" value="' . $keys['register_no'] . '" ' . $keys['checked'] . '  class="checkbox" id="">
                <span class="checkbox-span">' . strtoupper($keys['name']) . '</span>
            </div>';
            }
        } else {
            echo '
            <div class="row col-12 fw-bold text-center">
            <label class="mt-5">NO STUDENTS FOUND...</label>
            </div>  
            <script>
            $(".submit-btn").addClass("d-none");
            </script>';
        }
    }

    public function update_students_group(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'edit_group_name' => 'required',
            'student_reg_no' => 'required',
            'group_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error']);
        }
        $data = [
            'group_name' => $request->input('edit_group_name'),
            'updated_at' => now(),
        ];

        $values = DB::table('student_group')->where('group_id', $request->input('group_id'))->update($data);

        $db = DB::table('student_group_entry')->where('group_id', $request->input('group_id'))->delete();

        foreach ($request->input('student_reg_no') as $students) {

            $student_data = DB::table('master_students')->where('register_no', $students)->first();

            $value = [
                'group_id' => $request->input('group_id'),
                'students_id' => $student_data->student_id,
                'students_name' => $student_data->student_name,
                'register_no' => $students,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            DB::table('student_group_entry')->insert($value);
        }

        if ($value) {
            Session::flash('success', 'Updated Successfully');
            return response()->json(['status' => '200']);
        } else {
            Session::flash('error', 'Something went wrong');
            return response()->json(['status' => 'error']);
        }
    }


    public function group_status_update()
    {
        $id = $_POST['group_id'];
        $status = $_POST['is_active'];

        $data = [
            'is_active' => $status,
            'updated_at' => now(),
        ];

        $values = DB::table('student_group')->where('group_id', $id)->update($data);

        if ($values) {
            return response()->json(['status' => '200']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function delete_student_group(Request $request)
    {

        $values = DB::table('student_group')->where('group_id', $request->input('group_id'))->update(['trash_key' => 2, 'updated_at' => now()]);

        if ($values) {
            return response()->json(['status' => '200']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function import_students_group()
    {
        $heading = "Manage Students";
        $sub_heading = "Import Students Group";
        return view("admin.manage-students.import-students-group", compact("heading", "sub_heading"));
    }

    public function import_group_excel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uploaded_file' => 'required|file|mimes:xls,xlsx,csv',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
        }
        if ($request->hasFile('uploaded_file') && $request->file('uploaded_file')->isValid()) {

            $gd = DB::table('student_group')->where('error_key', 1)->get();
            foreach ($gd as $d) {
                DB::table('student_group_entry')->where('group_id', $d->group_id)->delete();
            }
            DB::table('student_group')->where('error_key', 1)->delete();

            $the_file = $request->file('uploaded_file');
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range = range(3, $row_limit);
            $column_range = range('F', $column_limit);
            $startcount = 2;
            $db_val = DB::table('student_group')->where('trash_key', 1)->get();
            $insert_id = [];
            foreach ($row_range as $row) {
                $error_key = 0;
                foreach ($db_val as $db) {
                    if ($db->group_name  == $sheet->getCell('B' . $row)->getValue()) {
                        $error_key = 1;
                    }
                }

                $data = [
                    'group_name' => $sheet->getCell('B' . $row)->getValue(),
                    'college_id' => $sheet->getCell('C' . $row)->getValue(),
                    'department_id' => $sheet->getCell('D' . $row)->getValue(),
                    'year' => $sheet->getCell('E' . $row)->getValue(),
                    'semester' => $sheet->getCell('F' . $row)->getValue(),
                    'error_key' => $error_key,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $value = DB::table('student_group')->insertGetId($data);
                $insert_id[] = $value;
                $students = explode(',', $sheet->getCell('G' . $row)->getValue());
                foreach ($students as  $stu) {
                    $student_details = DB::table('master_students')->where('register_no', trim($stu))->first();
                    $groups = [
                        'group_id' => $value,
                        'students_id' => $student_details->student_id,
                        'students_name' => $student_details->student_name,
                        'register_no' => $stu,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $value1 =  DB::table('student_group_entry')->insert($groups);
                }

                $startcount++;
            }

            $query = DB::table('student_group')->where('error_key', 1)->get();

            if (count($query) > 0) {
                return redirect()->route('edit-imported-group-data');
            } else {
                Session::flash('success', 'Imported Successfully');
                return redirect()->route('managestudents-studentsgroup');
            }
        } else {
            Session::flash('error', "No File Selected ..!");
            return redirect()->route('manageUser-importgroup');
        }
    }

    public function check_imported_group()
    {
        $org_group = DB::table('student_group')->where('error_key', 0)->get();
        $group_data = DB::table('student_group')->where('error_key', 1)->get();
        $heading = "Manage Students";
        $sub_heading = "Validate Students Group";
        return view("admin.manage-students.validate-student-group", compact("heading", "sub_heading", "group_data", "org_group"));
    }

    public function update_imported_validate_data(Request $request)
    {
        $validates = Validator::make($request->all(), [
            'group_name' => 'required',
            'college_id' => 'required',
            'department_id' => 'required',
            'year' => 'required',
            'semester' => 'required',
            'students' => 'required',
        ]);
        if ($validates->fails()) {
            Session::flash('error', 'All Fields are Required..!');
        }
        $groupNames = $request->input('group_name');
        $studentsArray = $request->input('students');

        $insertIds = [];

        foreach ($groupNames as $key => $group_name) {
            $data = [
                'group_name' => $group_name,
                'college_id' => $request->input('college_id')[$key],
                'department_id' => $request->input('department_id')[$key],
                'year' => $request->input('year')[$key],
                'semester' => $request->input('semester')[$key],
                'error_key' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $insertId = DB::table('student_group')->insertGetId($data);
            $insertIds[] = $insertId;

            $students = explode(', ', $studentsArray[$key]);

            foreach ($students as $stu) {
                $student_reg_no = trim($stu);
                $student_details = DB::table('master_students')->where('register_no', $student_reg_no)->first();

                if ($student_details) {
                    $studentGroups = [
                        'group_id' => $insertId,
                        'students_id' => $student_details->student_id,
                        'students_name' => $student_details->student_name,
                        'register_no' => $stu,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $value1 = DB::table('student_group_entry')->insert($studentGroups);
                }
            }
        }


        if (isset($value1)) {
            Session::flash('success', 'Successfully Inserted');
            return redirect()->route('managestudents-studentsgroup');
        } else {
            Session::flash('error', 'Something went wrong');
            return redirect()->route('managestudents-studentsgroup');
        }
    }
}
