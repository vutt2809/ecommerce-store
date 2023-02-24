<?php
namespace App\Repositories\Review;

use App\Models\Review;
use App\Repositories\EloquentRepository;

class ReviewRepository extends EloquentRepository implements ReviewInterface
{
    public function getModel() {
        return Review::class;
    }

    public function getListPendingReview() {
        $reviews = Review::where('status', 1)->orderBy('id', 'DESC')->get();
        return $reviews;
    }
}
