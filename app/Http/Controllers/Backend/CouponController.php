<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;
use PHPUnit\Framework\Constraint\Count;

class CouponController extends Controller
{
    public function couponView() {
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupon.coupon_view', compact('coupons'));
    }

    public function store(Request $request) {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required'
        ], [
            'coupon_name.required' => 'Coupon name is required',
            'coupon_discount.required' => 'Coupon discount is required',
            'coupon_validity.required' => 'Coupon validity is required'
        ]);

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now() 
        ]);

        $notification = [
            'message' => 'Coupon inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function edit ($id) {
        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.coupon_edit', compact('coupon'));
    }

    public function update(Request $request, $id) {
        Coupon::findOrFail($id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'updated_at' => Carbon::now()
        ]);

        $notification = [
            'message' => 'Coupon updated successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->route('manage.coupon')->with($notification);
    }

    public function delete($id){
        Coupon::findOrFail($id)->delete();
        return redirect()->route('manage.coupon');
    }
}
