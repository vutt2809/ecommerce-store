<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPostCategory;
use App\Repositories\BlogPost\BlogPostInterface;
use App\Repositories\BlogPostCategory\BlogPostCategoryInterface;
use Illuminate\Http\Request;

class HomeBlogController extends Controller
{
    protected $blogPostCategoryRepository;
    protected $blogPostRepository;

    public function __construct(BlogPostCategoryInterface $blogPostCategoryRepository ,BlogPostInterface $blogPostRepository) {
        $this->blogPostCategoryRepository = $blogPostCategoryRepository;
        $this->blogPostRepository = $blogPostRepository;
    }

    public function list() {
        $blogCategories = $this->blogPostCategoryRepository->getAll();
        $blogPosts = $this->blogPostRepository->getAll();

        return view('frontend.blog.blog_list', compact('blogPosts', 'blogCategories'));
    }

    public function detail($id) {
        $blog = $this->blogPostRepository->find($id);
        $blogCategories = $this->blogPostCategoryRepository->getAll();

        return view('frontend.blog.blog_detail', compact('blog', 'blogCategories'));
    }

    public function homeBlogCategoryPost($categoryId) {
        $blogCategories = $this->blogPostCategoryRepository->getAll();
        $blogPosts = $this->blogPostRepository->getListBlogPostByCategory($categoryId);

        return view('frontend.blog.blog_by_category', compact('blogCategories', 'blogPosts'));
    }
}
