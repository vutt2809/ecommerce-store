<?php
namespace App\Repositories\Brand;

use App\Models\Brand;
use App\Repositories\EloquentRepository;

class BrandRepository extends EloquentRepository implements BrandInterface
{
    public function getModel() {
        return Brand::class;
    }

    public function getTopBrandByProduct() {
        return 1;
    }
}