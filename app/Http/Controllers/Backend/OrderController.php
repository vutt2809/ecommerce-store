<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Repositories\Order\OrderInterface;
use App\Utils\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    protected $orderRepository;

    public function __construct(OrderInterface $orderRepository){
        $this->orderRepository = $orderRepository;
    }

    public function pendingOrders() {
        $orders = $this->orderRepository->getOrderByStatus('pending');
        return view('backend.orders.pending_orders', compact('orders'));
    }

    public function pendingOrderDetails($orderId) {
        $order = $this->orderRepository->getOrderAddress($orderId);
        $orderItem = $this->orderRepository->getProductItemInOrder($orderId);
        return view('backend.orders.pending_order_details', compact('order', 'orderItem'));
    }

    public function confirmedOrders() {
        $orders = $this->orderRepository->getOrderByStatus('confirmed');
        return view('backend.orders.confirmed_orders', compact('orders'));
    }

    public function processingOrders() {
        $orders = $this->orderRepository->getOrderByStatus('processing');
        return view('backend.orders.processing_orders', compact('orders'));
    }

    public function pickedOrders() {
        $orders = $this->orderRepository->getOrderByStatus('picked');
        return view('backend.orders.picked_orders', compact('orders'));
    }

    public function shippedOrders() {
        $orders = $this->orderRepository->getOrderByStatus('shipped');
        return view('backend.orders.shipped_orders', compact('orders'));
    }

    public function deliveredOrders() {
        $orders = $this->orderRepository->getOrderByStatus('delivered');
        return view('backend.orders.delivered_orders', compact('orders'));
    }

    public function cancelOrders() {
        $orders = $this->orderRepository->getOrderByStatus('cancel');
        return view('backend.orders.cancel_orders', compact('orders'));
    }

    public function pendingToConfirm ($orderId) {
        $this->orderRepository->changeStatus($orderId, 'Confirmed');
        $notify = Helpers::notification('The status of the order has been changed to confirmed', 'success');
        return redirect()->route('pending.orders')->with($notify);
    }

    public function confirmToProcessing ($orderId) {
        $this->orderRepository->changeStatus($orderId, 'Processing');
        $notify = Helpers::notification('The status of the order has been changed to Processing', 'success');
        return redirect()->route('pending.orders')->with($notify);
    }

    public function processingToPicked ($orderId) {
        $this->orderRepository->changeStatus($orderId, 'Picked');
        $notify = Helpers::notification('The status of the order has been changed to Picked', 'success');
        return redirect()->route('pending.orders')->with($notify);
    }

    public function pickedToShipped ($orderId) {
        $this->orderRepository->changeStatus($orderId, 'Shipped');
        $notify = Helpers::notification('The status of the order has been changed to Shipped', 'success');
        return redirect()->route('pending.orders')->with($notify);
    }

    public function shippedToDelivered ($orderId) {
        $this->orderRepository->changeStatus($orderId, 'Delivered');
        $notify = Helpers::notification('The status of the order has been changed to Delivered', 'success');
        return redirect()->route('pending.orders')->with($notify);
    }

    public function deliveredToCancel ($orderId) {
        $this->orderRepository->changeStatus($orderId, 'Cancel');
        $notify = Helpers::notification('The status of the order has been changed to Cancel', 'success');
        return redirect()->route('pending.orders')->with($notify);
    }

    public function downloadInvoice ($orderId) {
        $order = $this->orderRepository->getOrderAddressWithUser($orderId);
        $orderItems = $this->orderRepository->getProductItemInOrder($orderId);
        return view('backend.orders.order_invoice', compact('order', 'orderItem'));
    }

    public function returnOrder(Request $request, $orderId) {
        $this->orderRepository->returnOrder($orderId, $request->return_reason);
        $notify = Helpers::notification('Return request send sucessfully', 'success');
        return redirect()->route('my.orders')->with($notify);
    }

    public function myOrderReturn() {
        $orders = $this->orderRepository->getListReturnOrder(Auth::id());
        return view('frontend.user.order.order_return', compact('orders'));
    }

    public function myOrderCancel() {
        $orders = $this->orderRepository->getListCancelOrder(Auth::id());
        return view('frontend.user.order.order_cancel', compact('orders'));
    }
}
