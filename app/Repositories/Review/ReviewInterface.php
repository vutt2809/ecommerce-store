<?php
namespace App\Repositories\Review;

use App\Repositories\RepositoryInterface;

interface ReviewInterface extends RepositoryInterface {

    public function getListPendingReview();
}
