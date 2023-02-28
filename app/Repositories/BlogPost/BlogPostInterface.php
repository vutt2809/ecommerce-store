<?php
namespace App\Repositories\BlogPost;

use App\Repositories\RepositoryInterface;

interface BlogPostInterface extends RepositoryInterface {

    public function getAllBlogWithCategory();

    public function getListBlogPostByCategory($categoryId);
}
