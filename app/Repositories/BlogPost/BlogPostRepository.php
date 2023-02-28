<?php
namespace App\Repositories\BlogPost;

use App\Models\Blog\BlogPost;
use App\Repositories\EloquentRepository;

class BlogPostRepository extends EloquentRepository implements BlogPostInterface
{
    public function getModel() {
        return BlogPost::class;
    }

    public function getAllBlogWithCategory() {
        $blogPosts = BlogPost::with('category')->orderBy('id', 'DESC')->get();
        return $blogPosts;
    }

    public function getListBlogPostByCategory($categoryId) {
        $blogPosts = BlogPost::where('category_id', $categoryId)->orderBy('id', 'DESC')->get();
        return $blogPosts;
    }
}
