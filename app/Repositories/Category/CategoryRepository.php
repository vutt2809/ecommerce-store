<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\EloquentRepository;

class CategoryRepository extends EloquentRepository implements CategoryInterface
{
    public function getModel() {
        return Category::class;
    }
}