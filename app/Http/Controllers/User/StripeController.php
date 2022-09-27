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

class StripeController extends Controller
{
    public function stripeOrder (Request $request) {

        if (Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = round(Cart::getTotal());
        }

        \Stripe\Stripe::setApiKey('sk_test_51Ksep3Da0BmhoVrE9pY4uirCu0fdlEvb9gvzFOcOEsRP0hsDPw2BtyIVCFnQI45Y1FJFXdCSbhZCioJ9ikWOsrtI004CnUkUoA');
        
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => $total_amount * 100,
            'currency' => 'usd',
            'description' => 'SnowRain Online Payment',
            'source' => $token,
            'statement_descriptor' => 'Custom descriptor',
            'metadata' => ['order_id' => uniqid()]
        ]);
        
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

            'payment_type' => 'Stripe',
            'payment_method' => 'Stripe',
            'payment_type' => $charge->payment_method,
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,

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

        if (Session::get('coupon')){
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
