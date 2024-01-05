<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class Login_controller extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password', 'role');

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|min:4',
            'role' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->input('role') == 1) {
            $user = DB::table('users')->where('email', $credentials['email'])->first();
            if ($user && Hash::check($credentials['password'], $user->password) && $user->role == $credentials['role']) {
                Session::put('userToken', $user->remember_token);
                Session::put('role', 1);
                Session::put('userId', $user->id);
                Session::put('userName', "Admin");
                return response()->json(['success' => true, 'message' => Session::get('userToken'), 'role' => $user->role]);
            }
        } else if ($request->input('role') == 3) {
            $user = DB::table('master_students')->where('email_id', $credentials['email'])->first();
            if ($user && $credentials['password'] == $user->register_no && $user->role == $credentials['role']) {
                Session::put('userId', $user->register_no);
                Session::put('role', 3);
                Session::put('userName', $user->student_name);
                return response()->json(['success' => true, 'message' => Session::get('userId'), 'role' => $user->role]);
            }
        }



        return response()->json(['success' => false, 'message' => $user], 401);
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}