<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schoologin;
use Illuminate\Support\Facades\Session;

class SchoolController extends Controller
{
    public function schoologin()
    {
        return view('school.schoollogin');
    }
    public function confirmlogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = Schoologin::where('user_name', $request->username)
                      ->where('password', $request->password)
                      ->first();
         if ($user) {
            // Login success: store session and redirect
            Session::put('school_user', $user->id);
            return redirect()->route('child.profile');
        } else {
            // Login failed
            return back()->with('error', 'Invalid username or password');
        }
       
    }
    public function logout()
    {
        Session::forget('school_user'); // Remove the session
        return redirect()->route('school-login')->with('success', 'Logged out successfully');
    }

}
