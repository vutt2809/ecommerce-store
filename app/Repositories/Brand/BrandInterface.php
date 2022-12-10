<?php
namespace App\Repositories\Brand;

use App\Repositories\RepositoryInterface;

interface BrandInterface extends RepositoryInterface {
    
    public function getTopBrandByProduct();
}