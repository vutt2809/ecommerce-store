<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Review\ReviewInterface;
use App\Utils\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    protected $reviewRepository;

    public function __construct(ReviewInterface $reviewRepository) {
        $this->reviewRepository = $reviewRepository;
    }

    public function handleRequest(Request $request) {
        $data = $request->all();

        $request->validate([
            'summary' => 'required',
            'comment' => 'required',
        ]);

        $data['user_id'] = Auth::id();
        $data['product_id'] = $request->product_id;

        return $data;
    }

    public function create() {
        return view('frontend.review.create_review');
    }

    public function send(Request $request) {
        $data = $this->handleRequest($request);
        $this->reviewRepository->create($data);

        $notify = Helpers::notification('Your feedback has been send to admin', 'success');
        return redirect()->back()->with($notify);
    }
}
