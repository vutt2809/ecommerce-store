<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login() {
        return view('auth.admin_login');
    }

    public function dashboard() {
        return view('admin.index');
    }

    public function loginOwner(Request $request) {
        
        $check = $request->all();
        if (Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']])){
            return redirect()->route('admin.dashboard')->with('message', 'Admin Login Successfully');
        } else{
            return back()->with('message', $check['password']);
        }
    }

    public function logout() {
        Auth::guard('admin')->logout();
        
        return redirect()->route('admin.login')->with('message', 'Admin Logout Successfully');
    }

    public function register(){
        return view('auth.admin_register');
    }

    public function registerCreate(Request $request){
        Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.login')->with('message', 'Your account have been created Successfully');
    }


}