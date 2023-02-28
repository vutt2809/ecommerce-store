<?php
namespace App\Repositories\BlogPostCategory;

use App\Models\Blog\BlogPostCategory;
use App\Repositories\EloquentRepository;

class BlogPostCategoryRepository extends EloquentRepository implements BlogPostCategoryInterface
{
    public function getModel() {
        return BlogPostCategory::class;
    }
}
