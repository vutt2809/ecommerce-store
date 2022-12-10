<?php
namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;

class OrderRepository extends EloquentRepository implements OrderInterface
{
    public function getModel() {
        return Order::class;
    }

    public function getOrderByStatus($status) {
        $data = Order::where('status', $status)->orderBy('id', 'DESC')->get();
        return $data;
    }

    public function changeStatus($orderId, $status) {
        Order::findOrFail($orderId)->update(['status' => $status]);
    }

    public function getOrderAddressWithUser($orderId) {
        $order = Order::with('user', 'division', 'district', 'state')->where('id', $orderId)->first();
        return $order;
    }

    public function getOrderAddress($orderId) {
        $order = Order::with('division', 'district', 'state')->where('id', $orderId)->first();
        return $order;
    }

    public function getProductItemInOrder($orderId) {
        $orderItems = OrderItem::with('product')->where('order_id', $orderId)->orderBy('id', 'DESC')->get();
        return $orderItems;
    }

    public function returnOrder($orderId, $reason) {
        Order::findOrFail($orderId)->update([
            'return_reason' => $reason,
            'return_date' => Carbon::now()->format('d F Y')
        ]);
    }

    public function getListReturnOrder($userId) {
        $data = Order::where('user_id', $userId)->where('return_date', '!=', NULL)->get();
        return $data;
    }

    public function getListCancelOrder($userId) {
        $data = Order::where('user_id', $userId)->where('status', 'Cancel')->get();
        return $data;
    }
}