<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Order\OrderInterface;
use App\Repositories\OrderItem\OrderItemInterface;
use App\Utils\Helpers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CashController extends Controller
{
    protected $orderRepository, $orderItemRepository;

    public function __construct(OrderInterface $orderRepository, OrderItemInterface $orderItemRepository) {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
    }

    public function cashOrder (Request $request)
    {
        $cart = Session::get('cart');
        $totalAmount = isset($coupon) ? $coupon['total_amount'] : Helpers::getTotal();

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
            'amount' => $totalAmount,

            'invoice_no' => 'SROS'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now()
        ]);

        // Send Email
        $invoice = Order::findOrFail($orderId);

        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $totalAmount,
            'name' => $invoice->name,
            'email' => $invoice->email,
        ];

        Mail::to($request->email)->send(new OrderMail($data));

        foreach ($cart as $cartItem) {
            $data = [
                'order_id' => $orderId,
                'product_id' => $cartItem['product']['id'],
                'color' => $cartItem['attributes']['color'],
                'size' => $cartItem['attributes']['size'],
                'qty' => $cartItem['attributes']['quantity'],
                'price' => $cartItem['attributes']['price'],
                'created_at' => Carbon::now()
            ];

            OrderItem::insert([
                'order_id' => $orderId,
                'product_id' => $cartItem['product']['id'],
                'color' => $cartItem['attributes']['color'],
                'size' => $cartItem['attributes']['size'],
                'qty' => $cartItem['attributes']['quantity'],
                'price' => $cartItem['attributes']['price'],
                'created_at' => Carbon::now()
            ]);
        }

        if (Session::get('coupon')) {
            Session::forget('coupon');
        }

        Session::forget('cart');

        $notification = [
            'message' => 'Your Order Placed Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('user.dashboard')->with($notification);
    }
}
