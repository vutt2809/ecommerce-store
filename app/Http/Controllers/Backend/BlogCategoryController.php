<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\BlogPost\BlogPostInterface;
use App\Repositories\BlogPostCategory\BlogPostCategoryInterface;
use App\Utils\Helpers;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    protected $blogPostCategoryRepository;

    public function __construct(BlogPostCategoryInterface $blogPostCategoryRepository ,BlogPostInterface $blogPostRepository) {
        $this->blogPostCategoryRepository = $blogPostCategoryRepository;
    }

    public function handleRequest(Request $request) {
        $request->validate([
            'blog_category_name_en' => 'required',
            'blog_category_name_vn' => 'required',
        ]);

        $data = $request->all();
        $data['blog_category_slug_en'] = str_replace(' ', '_', $data['blog_category_name_en']);
        $data['blog_category_slug_vn'] = str_replace(' ', '_', $data['blog_category_name_vn']);

        return $data;
    }

    public function index() {
        $blogCategories = $this->blogPostCategoryRepository->getAll();
        return view('backend.blog.category.category_view', compact('blogCategories'));
    }

    public function create(Request $request) {
        $data = $this->handleRequest($request);
        $this->blogPostCategoryRepository->create($data);

        $notify = Helpers::notification('Blog category was created successfully', 'success');
        return redirect()->back()->with($notify);
    }

    public function edit($id) {
        $blogPostCategory = $this->blogPostCategoryRepository->find($id);
        return view('backend.blog.category.category_edit', compact('blogPostCategory'));
    }

    public function update(Request $request) {
        $categoryId = $request->id;
        $data = $this->handleRequest($request);
        $this->blogPostCategoryRepository->update($categoryId, $data);

        $notify = Helpers::notification('Blog category was updated successfully', 'success');
        return redirect()->back()->with($notify);
    }
}
