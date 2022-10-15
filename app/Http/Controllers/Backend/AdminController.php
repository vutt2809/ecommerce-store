<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
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

        if (Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect()->route('admin.dashboard')->with('message', 'Admin Login Successfully');
        } else {
            return back()->with('message', 'Invalid email or password');
        }
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('message', 'Admin Logout Successfully');
    }

    public function register() {
        return view('auth.admin_register');
    }

    public function registerCreate(Request $request) {
        Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.login')->with('message', 'Your account have been created Successfully');
    }
    
    // Profile Section
    public function profile() {
        $admin = Admin::find(1);
        return view('admin.admin_profile_view', compact('admin'));
    }

    public function editProfile() {
        $admin = Admin::find(1);
        return view('admin.admin_profile_edit', compact('admin'));
    }

    public function updateProfile(Request $request) { 
        $admin = Admin::find(1);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');

            if ($admin->profile_photo_path) unlink(public_path('upload/admin_images/'.$admin->profile_photo_path));

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $admin['profile_photo_path'] = $filename;
        }

        $admin->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);  
    }

    public function changePassword() {
        return view('admin.admin_change_password');
    }

    public function updatePassword (Request $request) {
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Admin::find(1)->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);  
            $admin->save();
            Auth::logout();

            $notification = array(
                'message' => 'Password has been changed successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.logout')->with($notification);

        }else{
            $notification = array(
                'message' => 'Invalid Password',
                'alert-type' => 'danger'
            );
            
            return redirect()->back()->with($notification);
        }
    }

    public function allUser() {
        $users = User::latest()->get();
        return view('backend.user.all_user', compact('users'));
    }


}
