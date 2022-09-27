<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class UserController extends Controller
{
    public function myOrder() {
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        
        return view('frontend.user.order.order_view', compact('orders'));
    }

    public function orderDetails($order_id) {
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
         
        return view('frontend.user.order.order_details', compact('order', 'orderItem'));
    }

    public function downloadInvoice($order_id) {
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
         
        return view('frontend.user.order.order_invoice', compact('order', 'orderItem'));
        // $pdf = PDF::loadView('frontend.user.order.order_invoice', compact('order', 'orderItem'));
        // return $pdf->download('invoice.pdf'); 
    }
}
