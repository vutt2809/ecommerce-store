<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPostCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function blogCategory() {
        $blogCategories = BlogPostCategory::latest()->get();

        return view('backend.blog.category.category_view', compact('blogCategories'));
    }

    public function saveBlogCategory(Request $request) {
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

    public function editBlogCategory($id) {
        $blogPostCategory = BlogPostCategory::findOrFail($id);

        return view('backend.blog.category.category_edit', compact('blogPostCategory'));
    }

    public function updateBlogCategory(Request $request) {
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

    // Blog Post
    public function listBlogPost() {
        $blogPosts = BlogPost::latest()->get();
        $blogCategories = BlogPostCategory::latest()->get();

        return view('backend.blog.post.post_view', compact('blogPosts', 'blogCategories'));
    }

    public function createBlogPost() {
        $blogCategories = BlogPostCategory::latest()->get();

        return view('backend.blog.post.post_add', compact('blogCategories'));
    }

    public function saveBlogPost(Request $request) {
        $request->validate([
            'post_title_en' => 'required',
            'post_title_vn' => 'required',
            'post_image' => 'required',
            'post_details_en' => 'required',
            'post_details_vn' => 'required',
        ],[
            'post_title_en.required' => 'English post title is required',
            'post_title_vn.required' => 'Vietnamese post title is required',
            'post_image.required' => 'Post image is required',
            'post_details_en.required' => 'English post details is required',
            'post_details_vn.required' => 'Vietnamese post details is required',
        ]);

        $image = $request->file('post_image');
        $nameGeneration = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(780,433)->save('upload/blog/' . $nameGeneration);
        $saveUrl = 'upload/blog/' . $nameGeneration;

        BlogPost::insert([
            'category_id' => $request->category_id,
            'post_title_en' => $request->post_title_en,
            'post_title_vn' => $request->post_title_vn,
            'post_slug_en' => str_replace(' ', '-', $request->post_title_en),
            'post_slug_vn' => str_replace(' ', '-', $request->post_title_vn),
            'post_image' => $saveUrl,
            'post_details_en' => $request->post_details_en,
            'post_details_vn' => $request->post_details_vn,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Blog Post is created successfully'
        ];

        return redirect()->route('list.post')->with($notification);
    }

    public function editBlogPost($id) {
        $blogPost = BlogPost::findOrFail($id);
        $blogCategories = BlogPostCategory::latest()->get();
        
        return view('backend.blog.post.post_edit', compact('blogPost', 'blogCategories'));
    }

    public function updateBlogPost(Request $request) {
        $blogPostId = $request->id;
        $oldImg = $request->post_image;

        if ($request->hasFile('post_image')) {
            unlink($oldImg);

            $image = $request->file('post_image');
            $nameGeneration = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(780,433)->save('upload/blog/' . $nameGeneration);
            $saveUrl = 'upload/blog/' . $nameGeneration;

            BlogPost::findOrFail($blogPostId)->update([
                'category_id' => $request->category_id,
                'post_title_en' => $request->post_title_en,
                'post_title_vn' => $request->post_title_vn,
                'post_slug_en' => str_replace(' ', '-', $request->post_title_en),
                'post_slug_vn' => str_replace(' ', '-', $request->post_title_vn),
                'post_image' => $saveUrl,
                'post_details_en' => $request->post_details_en,
                'post_details_vn' => $request->post_details_vn,
                'updated_at' => Carbon::now(),
            ]);

            $notification = [
                'alert-type' => 'success',
                'message' => 'Blog Post has been updated successfully'
            ];
    
            return redirect()->route('list.post')->with($notification);

        } else {
            BlogPost::findOrFail($blogPostId)->update([
                'category_id' => $request->category_id,
                'post_title_en' => $request->post_title_en,
                'post_title_vn' => $request->post_title_vn,
                'post_slug_en' => str_replace(' ', '-', $request->post_title_en),
                'post_slug_vn' => str_replace(' ', '-', $request->post_title_vn),
                'post_details_en' => $request->post_details_en,
                'post_details_vn' => $request->post_details_vn,
                'updated_at' => Carbon::now(),
            ]);

            $notification = [
                'alert-type' => 'success',
                'message' => 'Blog Post has been updated successfully'
            ];
    
            return redirect()->route('list.post')->with($notification);
        }
    }

    public function deleteBlogPost($id) {
        BlogPost::findOrFail($id)->delete();

        $notification = [
            'alert-type' => 'success',
            'message' => 'Blog has been deleted sucecssfully',
        ];

        return redirect()->back()->with($notification);
    }
}
