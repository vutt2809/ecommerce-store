<?php
namespace App\Repositories\OrderItem;

use App\Models\OrderItem;
use App\Repositories\EloquentRepository;
use App\Repositories\OrderItem\OrderItemInterface;


class OrderItemRepository extends EloquentRepository implements OrderItemInterface
{
    public function getModel() {
        return OrderItem::class;
    }
}
