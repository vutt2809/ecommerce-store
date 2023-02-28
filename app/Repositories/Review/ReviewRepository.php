<?php
namespace App\Repositories\Review;

use App\Models\Order;
use App\Models\Review;
use App\Repositories\EloquentRepository;

class ReviewRepository extends EloquentRepository implements ReviewInterface
{
    public function getModel() {
        return Review::class;
    }

    public function getListPendingReview() {
        $reviews = Review::where('status', 0)->orderBy('id', 'DESC')->get();
        return $reviews;
    }

    public function getListPublishReview() {
        $reviews = Review::where('status', 1)->orderBy('id', 'DESC')->get();
        return $reviews;
    }

    public function updateStatus($id) {
        Review::findOrFail($id)->update(['status' => 1]);
    }

    public function checkReview($productId, $userId) {
        $order = Order::where('product_id', $productId)->where('user_id', $userId)->get();
        return $order ? true : false;
    }
}
