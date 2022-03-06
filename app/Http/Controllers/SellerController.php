<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function login() {
        return view('auth.seller_login');
    }

    public function dashboard() {
        return view('seller.index');
    }

    public function loginOwner(Request $request) {
        
        $check = $request->all();
        if (Auth::guard('seller')->attempt(['email' => $check['email'], 'password' => $check['password']])){
            return redirect()->route('seller.dashboard')->with('message', 'Seller Login Successfully');
        } else{
            return back()->with('message', 'Invalid email or password');
        }
    }

    public function logout() {
        Auth::guard('seller')->logout();
        return redirect()->route('seller.login')->with('message', 'Seller Logout Successfully');
    }

    public function register(){
        return view('auth.seller_register');
    }

    public function registerCreate(Request $request){
        
        Seller::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('seller.login')->with('message', 'Your account have been created Successfully');
    }
}
