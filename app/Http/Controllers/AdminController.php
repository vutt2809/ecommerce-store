<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Repositories\Auth\AuthInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $authRepository;

    public function __construct(AuthInterface $authRepository) {
        $this->authRepository = $authRepository;
    }

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
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $this->authRepository->create($data);
        return redirect()->route('admin.login')->with('message', 'Your account have been created Successfully');
    }
}
