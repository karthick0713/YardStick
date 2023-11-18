<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

        $user = DB::table('users')->where('email', $credentials['email'])->first();

        if ($user && $credentials['password'] == $user->password && $user->role == $credentials['role']) {
            Session::put('userToken', $user->remember_token);
            return response()->json(['success' => true, 'message' => Session::get('userToken')]);
        }

        return response()->json(['success' => false, 'message' => $user], 401);
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
