<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPostCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

class BlogController extends Controller
{
    public function blogCategory() {
        $blogcategories = BlogPostCategory::latest()->get();
        return view('backend.blog.category.category_view', compact('blogcategories'));
    }

    public function store(Request $request) {
        $request->validate([
            'blog_category_name_en' => 'required',
            'blog_category_name_vn' => 'required',
        ], [
            'blog_category_name_en.required' => 'Blog category name English is required',
            'blog_category_name_vn.required' => 'Blog category name VietNamese is required',
        ]);

        BlogPostCategory::insert([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_name_vn' => $request->blog_category_name_vn,
            'blog_category_slug_en' => str_replace(' ', '-', $request->blog_category_name_en),
            'blog_category_slug_vn' => str_replace(' ', '-', $request->blog_category_name_vn),
            'created_at' => Carbon::now()
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Blog category is created successfully'
        ];

        return redirect()->back()->with($notification);
    }

    public function edit ($id) {
        $blogcategory = BlogPostCategory::findOrFail($id);
        return view('backend.blog.category.category_edit', compact('blogcategory'));
    }

    public function update(Request $request){
        $blogCategoryId = $request->id;

        BlogPostCategory::findOrFail($blogCategoryId)->update([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_name_vn' => $request->blog_category_name_vn,
            'blog_category_slug_en' => str_replace(' ', '-', $request->blog_category_name_en),
            'blog_category_slug_vn' => str_replace(' ', '-', $request->blog_category_name_vn),
            'updated_at' => Carbon::now()
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Blog category is created successfully'
        ];

        return redirect()->route('blog.category')->with($notification);
    }

    public function allBlogPost () {
        $blogcategories = BlogPostCategory::orderBy('blog_category_name_en', 'DESC')->get();
        $blogPosts = BlogPost::latest()->get();
        return view('backend.blog.post.post_view', compact('blogPosts', 'blogcategories'));
    }


}
