<?php
namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    // Report
    public function getOrderByDate($date) {
        $orders = Order::where('order_date', $date)->latest()->get();
        return $orders;
    }

    public function getOrderByMonth($month, $year) {
        $orders = Order::where('order_month', $month)->where('order_year', $year)->latest()->get();
        return $orders;
    }

    public function getOrderByYear($year) {
        $orders = Order::where('order_year', $year)->where('order_year', $year)->latest()->get();
        return $orders;
    }

    public function getTopBestSellerProduct($number) {
        $ids = OrderItem::select('product_id', DB::raw('count(qty) as total'))
                        ->groupBy('product_id')
                        ->orderByRaw('count(qty) DESC')
                        ->limit($number)
                        ->pluck('product_id', 'total');

        $products = Product::whereIn('id', $ids)->get();

        $listItems = json_decode($ids);

        return [
            'products' => $products,
            'listItems' => $listItems
        ];
    }

    // Return Order
    public function getReturnOrders() {
        $orders = Order::where('return_order', 1)->orderBy('id', 'DESC')->get();
        return $orders;
    }

    public function updateReturnOrderStatus($orderId) {
        Order::findOrFail($orderId)->update(['return_order' => 2]);
    }

    public function getListRequestReturnOrder() {
        $orders = Order::where('return_order', 2)->orderBy('id', 'DESC')->get();
        return $orders;
    }
}
