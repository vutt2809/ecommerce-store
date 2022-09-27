<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CashController extends Controller
{
    public function cashOrder (Request $request){
        if (Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = round(Cart::getTotal());
        }

        $orderId = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'post_code' => $request->post_code,
            'notes' => $request->notes,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,

            'payment_type' => 'Cash On Delivery',
            'payment_method' => 'Cash On Delivery',
            'currency' => 'USD',
            'amount' => $total_amount,

            'invoice_no' => 'SROS'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now()
        ]);

        // Send Email 
        $invoice = Order::findOrFail($orderId);

        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
        ];

        Mail::to($request->email)->send(new OrderMail($data));

        $cart = Cart::getContent();

        foreach ($cart as $item) {
            OrderItem::insert([
                'order_id' => $orderId,
                'product_id' => $item->associatedModel->id,
                'color' => $item->attributes->color,
                'size' => $item->attributes->size,
                'qty' => $item->quantity,
                'price' => $item->price,
                'created_at' => Carbon::now()
            ]);
        }

        if (Session::get('coupon')) {
            Session::forget('coupon');
        }

        Cart::clear();

        $notification = [
            'message' => 'Your Order Placed Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('user.dashboard')->with($notification);
        
    }
}
