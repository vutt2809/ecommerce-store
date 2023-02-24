<?php
namespace App\Repositories\Order;

use App\Repositories\RepositoryInterface;

interface OrderInterface extends RepositoryInterface {

    public function getOrderByStatus($status);

    public function changeStatus($orderId, $status);

    public function getOrderAddress($orderId);

    public function getOrderAddressWithUser($orderId);

    public function getProductItemInOrder($orderId);

    public function returnOrder($orderId, $reason);

    public function getListReturnOrder($userId);

    public function getListCancelOrder($userId);

    public function getOrderByDate($date);

    public function getOrderByMonth($month, $year);

    public function getOrderByYear($year);

    public function getTopBestSellerProduct($number);

    public function getReturnOrders();
}
