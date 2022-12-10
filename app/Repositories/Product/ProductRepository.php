<?php
namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\EloquentRepository;

class ProductRepository extends EloquentRepository implements ProductInterface
{
    public function getModel() {
        return Product::class;
    }
}