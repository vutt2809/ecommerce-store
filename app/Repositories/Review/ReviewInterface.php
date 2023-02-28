<?php
namespace App\Repositories\Review;

use App\Repositories\RepositoryInterface;

interface ReviewInterface extends RepositoryInterface {

    public function getListPendingReview();

    public function getListPublishReview();

    public function updateStatus($id);

    public function checkReview($productId, $userId);
}
