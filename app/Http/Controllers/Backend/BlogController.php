<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPostCategory;
use App\Repositories\BlogPost\BlogPostInterface;
use App\Repositories\BlogPostCategory\BlogPostCategoryInterface;
use App\Utils\Helpers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    protected $blogPostRepository;
    protected $blogPostCategoryRepository;

    public function __construct(BlogPostCategoryInterface $blogPostCategoryRepository ,BlogPostInterface $blogPostRepository) {
        $this->blogPostCategoryRepository = $blogPostCategoryRepository;
        $this->blogPostRepository = $blogPostRepository;
    }

    public function handleRequest(Request $request) {
        $request->validate([
            'category' => 'required',
            'post_title_en' => 'required',
            'post_title_vn' => 'required',
            'post_image' => 'required',
            'post_details_en' => 'required',
            'post_details_vn' => 'required',
        ]);

        $data = $request->all();
        $image = $request->file('post_image');

        if ($request->id) {
            if ($request->file('post_image')) {
                $oldImg = $request->old_image;
                unlink($oldImg);
                $saveUrl = Helpers::saveImage($image, 780, 433, 'upload/blog/');
                $data['post_image'] = $saveUrl;
            }
            unset($data['old_image']);
        } else {
            $saveUrl = Helpers::saveImage($image, 780, 433, 'upload/blog/');
            $data['post_image'] = $saveUrl;
        }

        $data['post_title_en'] = str_replace(' ', '_', $data['post_title_en']);
        $data['post_title_vn'] = str_replace(' ', '_', $data['post_title_vn']);


        return $data;
    }

    // Blog Post
    public function index() {
        $blogCategories = $this->blogPostCategoryRepository->getAll();
        $blogPosts = $this->blogPostRepository->getAllBlogWithCategory();

        return view('backend.blog.post.post_view', compact('blogPosts', 'blogCategories'));
    }

    public function add() {
        $blogCategories = $this->blogPostCategoryRepository->getAll();
        return view('backend.blog.post.post_add', compact('blogCategories'));
    }

    public function save(Request $request) {
        $data = $this->handleRequest($request);
        $this->blogPostRepository->create($data);

        $notify = Helpers::notification('Blog Post was created successfully', 'success');
        return redirect()->route('list.post')->with($notify);
    }

    public function edit($id) {
        $blogPost = BlogPost::findOrFail($id);
        $blogCategories = BlogPostCategory::latest()->get();

        return view('backend.blog.post.post_edit', compact('blogPost', 'blogCategories'));
    }

    public function update(Request $request) {
        $blogPostId = $request->id;
        $oldImg = $request->post_image;

        if ($request->hasFile('post_image')) {
            unlink($oldImg);

            $image = $request->file('post_image');
            $nameGeneration = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(780, 433)->save('upload/blog/' . $nameGeneration);
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

    public function delete($id) {
        BlogPost::findOrFail($id)->delete();

        $notification = [
            'alert-type' => 'success',
            'message' => 'Blog has been deleted sucecssfully',
        ];

        return redirect()->back()->with($notification);
    }
}
