<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function allWishlist() {
        return view('frontend.wishlist.view_wishlist');
    }

    public function getWishList() {
        $wishtlists = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();
        return response()->json($wishtlists);
    }

    public function removeWishlist($id) {
        Wishlist::where('user_id', Auth::id())->where('product_id', $id)->delete();
        return response()->json(['success' => 'Product has been removed from your wishlist']);
    }
}
