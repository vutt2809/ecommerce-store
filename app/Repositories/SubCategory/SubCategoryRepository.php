<?php
namespace App\Repositories\SubCategory;

use App\Models\SubCategory;
use App\Repositories\EloquentRepository;

class SubCategoryRepository extends EloquentRepository implements SubCategoryInterface
{
    public function getModel() {
        return SubCategory::class;
    }
}