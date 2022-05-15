<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function pendingOrders (){
        $orders = Order::where('status', 'Pending')->orderBy('id', 'DESC')->get();
        return view('backend.orders.pending_orders', compact('orders'));
    }

    public function pendingOrderDetails($order_id) {
        $order = Order::with('division', 'district', 'state')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('backend.orders.pending_order_details', compact('order', 'orderItem'));
    }

    public function confirmedOrders (){
        $orders = Order::where('status', 'confirmed')->orderBy('id', 'DESC')->get();
        return view('backend.orders.confirmed_orders', compact('orders'));
    }

    public function processingOrders (){
        $orders = Order::where('status', 'processing')->orderBy('id', 'DESC')->get();
        return view('backend.orders.processing_orders', compact('orders'));
    }

    public function pickedOrders (){
        $orders = Order::where('status', 'picked')->orderBy('id', 'DESC')->get();
        return view('backend.orders.picked_orders', compact('orders'));
    }

    public function shippedOrders (){
        $orders = Order::where('status', 'shipped')->orderBy('id', 'DESC')->get();
        return view('backend.orders.shipped_orders', compact('orders'));
    }

    public function deliveredOrders (){
        $orders = Order::where('status', 'delivered')->orderBy('id', 'DESC')->get();
        return view('backend.orders.delivered_orders', compact('orders'));
    }

    public function cancelOrders (){
        $orders = Order::where('status', 'cancel')->orderBy('id', 'DESC')->get();
        return view('backend.orders.cancel_orders', compact('orders'));
    }

    public function pendingToConfirm ($order_id){
        Order::findOrFail($order_id)->update(['status' => 'Confirmed']);
        $notification = [
            'message' => 'The status of the order has been changed to confirmed',
            'alert-type' => 'success',
        ];
        return redirect()->route('pending.orders')->with($notification);
    }

    public function confirmToProcessing ($order_id){
        Order::findOrFail($order_id)->update(['status' => 'Processing']);
        $notification = [
            'message' => 'The status of the order has been changed to Processing',
            'alert-type' => 'success',
        ];
        return redirect()->route('pending.orders')->with($notification);
    }

    public function processingToPicked ($order_id){
        Order::findOrFail($order_id)->update(['status' => 'Picked']);
        $notification = [
            'message' => 'The status of the order has been changed to Picked',
            'alert-type' => 'success',
        ];
        return redirect()->route('pending.orders')->with($notification);
    }
    
    public function pickedToShipped ($order_id){
        Order::findOrFail($order_id)->update(['status' => 'Shipped']);
        $notification = [
            'message' => 'The status of the order has been changed to Shipped',
            'alert-type' => 'success',
        ];
        return redirect()->route('pending.orders')->with($notification);
    }

    public function shippedToDelivered ($order_id){
        Order::findOrFail($order_id)->update(['status' => 'Delivered']);
        $notification = [
            'message' => 'The status of the order has been changed to Delivered',
            'alert-type' => 'success',
        ];
        return redirect()->route('pending.orders')->with($notification);
    }

    public function deliveredToCancel ($order_id){
        Order::findOrFail($order_id)->update(['status' => 'Cancel']);
        $notification = [
            'message' => 'The status of the order has been changed to Cancel',
            'alert-type' => 'success',
        ];
        return redirect()->route('pending.orders')->with($notification);
    }

    public function downloadInvoice ($order_id) {
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
         
        return view('backend.orders.order_invoice', compact('order', 'orderItem'));
    }
    

    public function returnOrder(Request $request, $order_id) {
        Order::findOrFail($order_id)->update([
            'return_reason' => $request->return_reason,
            'return_date' => Carbon::now()->format('d F Y'),
        ]);

        $notification = [
            'message' => 'Return request send sucessfully',
            'alert-type' => 'success',
        ];
        
        return redirect()->route('my.orders')->with($notification);
    }

    public function myOrderReturn() {
        $orders = Order::where('user_id', Auth::id())->where('return_date', '!=', NULL)->get();
        return view('frontend.user.order.order_return', compact('orders'));
    }

    public function myOrderCancel() {
        $orders = Order::where('user_id', Auth::id())->where('status', 'Cancel')->get();
        return view('frontend.user.order.order_cancel', compact('orders'));
    }

    

}
