<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Review\ReviewInterface;
use App\Utils\Helpers;

class ReviewController extends Controller
{
    protected $reviewRepository;

    public function __construct(ReviewInterface $reviewRepository) {
        $this->reviewRepository = $reviewRepository;
    }

    public function pendingList() {
        $reviews = $this->reviewRepository->getListPendingReview();
        return view('backend.review.pending_review', compact('reviews'));
    }

    public function publishList() {
        $reviews = $this->reviewRepository->getListPublishReview();
        return view('backend.review.publish_review', compact('reviews'));
    }

    public function adminApprove($id) {
        $this->reviewRepository->updateStatus($id);

        $notify = Helpers::notification('Review approved sucessfully', 'success');
        return redirect()->back()->with($notify);
    }
}
