<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPostCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogCategory() {
        $blogCategories = BlogPostCategory::latest()->get();

        return view('backend.blog.category.category_view', compact('blogCategories'));
    }

    public function blogCategoryStore(Request $request) {
        $request->validate([
            'blog_category_name_en' => 'required',
            'blog_category_name_vn' => 'required',
        ],[
            'blog_category_name_en.required' => 'Blog category name English is required',
            'blog_category_name_vn.required' => 'Blog category name VietNamese is required',
        ]);

        BlogPostCategory::insert([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_name_vn' => $request->blog_category_name_vn,
            'blog_category_slug_en' => str_replace(' ', '_', $request->blog_category_name_en),
            'blog_category_slug_vn' => str_replace(' ', '_', $request->blog_category_name_vn),
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Blog category is created successfully'
        ];

        return redirect()->back()->with($notification);
    }

    public function blogCategoryEdit($id) {
        $blogPostCategory = BlogPostCategory::findOrFail($id);

        return view('backend.blog.category.category_edit', compact('blogPostCategory'));
    }

    public function blogCategoryUpdate(Request $request) {
        BlogPostCategory::findOrFail($request->id)->update([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_name_vn' => $request->blog_category_name_vn,
            'blog_category_slug_en' => str_replace(' ', '-', $request->blog_category_name_en),
            'blog_category_slug_vn' => str_replace(' ', '-', $request->blog_category_name_vn),
            'updated_at' => Carbon::now()
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Blog category is updated successfully'
        ];

        return redirect()->route('blog.category')->with($notification);
    }

    public function allBlogPost() {
        $blogPosts = BlogPost::latest()->get();
        $blogCategories = BlogPostCategory::latest()->get();

        return view('backend.blog.post.post_view', compact('blogPosts', 'blogCategories'));
    }

    public function blogPostStore(Request $request) {
        $request->validate([
            'post_title_en' => 'required',
            'post_title_en' => 'required',
            'post_title_vn' => 'required',
            'post_slug_en' => 'required',
            'post_slug_vn' => 'required',
            'post_image' => 'required',
            'post_details_en' => 'required',
            'post_details_vn' => 'required',
        ],[
            'post_title_en.required' => 'English post title is required',
            'post_title_vn.required' => 'Vietnamese post title is required',
            'post_slug_en.required' => 'English post is required',
            'post_slug_vn.required' => 'Vietnamese post is required',
            'post_image.required' => 'Post image is required',
            'post_details_en.required' => 'English post details is required',
            'post_details_vn.required' => 'Vietnamese post details is required',
        ]);

        BlogPostCategory::insert([
            'post_title_en' => $request->post_title_en,
            'post_title_en' => $request->post_title_en,
            'post_title_vn' => $request->post_title_vn,
            'post_slug_en' => $request->post_slug_en,
            'post_slug_vn' => $request->post_slug_vn,
            'post_image' => $request->post_image,
            'post_details_en' => $request->post_details_en,
            'post_details_vn' => $request->post_details_vn,
            'create_at' => Carbon::now(),
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Blog category is updated successfully'
        ];

        return redirect()->back()->with($notification);
    }

    public function addBlogPost(Request $request) {
        $request->validate([
            'category_id' => 'required',
            'post_title_en' => 'required',
            'post_title_vn' => 'required',
            'post_slug_en' => 'required',
            'post_slug_vn' => 'required',
            'post_image' => 'required',
            'post_details_en' => 'required',
            'post_details_vn' => 'required',
        ],[
            'category_id.required' => 'Blog post category is required !',
            'post_title_en.required' => 'English post title is required !',
            'post_title_vn.required' => 'Vietnamese post title is required !',
            'post_slug_en.required' => 'Enlish post slug is required !',
            'post_slug_vn.required' => 'Vietnamese slug is required !',
            'post_image.required' => 'Post image is required !',
            'post_details_en.required' => 'English post detail is required !',
            'post_details_vn.required' => 'Vietnamese post detail is required !',
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Blog post is created successfully'
        ];

        return redirect()->back()->with($notification);
    }
}
