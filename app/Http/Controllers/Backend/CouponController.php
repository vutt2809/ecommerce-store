<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Repositories\Coupon\CouponInterface;
use App\Utils\Helpers;

class CouponController extends Controller
{
    protected $couponRepository;

    public function __construct(CouponInterface $couponRepository) {
        $this->couponRepository = $couponRepository;
    }

    public function handleRequest(Request $request) {
        $data = $request->all();

        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required'
        ], [
            'coupon_name.required' => 'Coupon name is required',
            'coupon_discount.required' => 'Coupon discount is required',
            'coupon_validity.required' => 'Coupon validity is required'
        ]);

        $data['coupon_name'] = strtoupper($request->coupon_name);

        return $data;
    }

    public function couponView() {
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupon.coupon_view', compact('coupons'));
    }

    public function store(Request $request) {
        $data = $this->handleRequest($request);
        $this->couponRepository->create($data);

        $notify = Helpers::notification('Coupon was created successfully', 'success');
        return redirect()->back()->with($notify);
    }

    public function edit ($id) {
        $coupon = $this->couponRepository->find($id);
        return view('backend.coupon.coupon_edit', compact('coupon'));
    }

    public function update(Request $request, $id) {
        $data = $this->handleRequest($request);
        $this->couponRepository->update($id, $data);

        $notify = Helpers::notification('Coupon was updated successfully', 'success');
        return redirect()->route('manage.coupon')->with($notify);
    }

    public function delete($id){
        $this->couponRepository->delete($id);
        return redirect()->route('manage.coupon');
    }
}
