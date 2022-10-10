<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPostCategory;
use Illuminate\Http\Request;

class HomeBlogController extends Controller
{
    public function list() {
        $blogPosts = BlogPost::latest()->get();
        $blogCategories = BlogPostCategory::latest()->get();
        
        return view('frontend.blog.blog_list', compact('blogPosts', 'blogCategories'));
    }

    public function detail($id) {
        $blog = BlogPost::findOrFail($id);
        $blogCategories = BlogPostCategory::latest()->get();

        return view('frontend.blog.blog_detail', compact('blog', 'blogCategories'));
    }

    public function homeBlogCategoryPost($categoryId) {
        $blogCategories = BlogPostCategory::latest()->get();
        $blogPosts = BlogPost::where('category_id', $categoryId)->orderBy('id', 'DESC')->get();

        return view('frontend.blog.blog_by_category', compact('blogCategories', 'blogPosts'));
    }
}
