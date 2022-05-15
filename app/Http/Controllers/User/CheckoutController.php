<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function getDistrict($division_id) {
        $districts = ShipDistrict::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($districts);
    }

    public function getState($district_id) {
        $states = ShipState::where('district_id', $district_id)->orderBy('state_name', 'ASC')->get();
        return json_encode($states);
    }

    public function storeCheckout(Request $request) {
        $data = [
            'shipping_name' => $request->shipping_name,
            'shipping_email' => $request->shipping_email,
            'shipping_phone' => $request->shipping_phone,
            'post_code' => $request->post_code,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'notes' => $request->notes,
            'created_at' => Carbon::now(),
        ];
        
        $cartTotal = Cart::getTotal();

        if ($request->payment_method == 'stripe') {
            return view('frontend.payment.stripe', compact('data', 'cartTotal'));
        }else if ($request->payment_method == 'card'){
            return 'card';
        }else{
            return view('frontend.payment.cash', compact('data', 'cartTotal'));
        }
    }

}
