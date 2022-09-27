<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CartPageController extends Controller
{
    public function myCart() {
        return view('frontend.cart.view_mycart');
    }

    public function getCartProduct() {
        $carts = Cart::getContent();
        $cartQuantity = Cart::getTotalQuantity();
        $cartTotal = Cart::getTotal();

        return response()->json([
            'carts' => $carts,
            'cartQuantity' => $cartQuantity,
            'cartTotal' => $cartTotal
        ]);
    }

    public function removeProductFromCart($rowId) {
        Cart::remove($rowId);

        if (Session::has('coupon')){
            Session::forget('coupon');
        }

        return response()->json(['success' => 'Product have been removed from shopping cart']);
    }

    public function increaseQuantity($rowId) {
        Cart::update($rowId, ['quantity' => 1]);

        return response()->json(['increment']);
    }

    public function decreaseQuantity($rowId) {
        Cart::update($rowId, ['quantity' => -1]);
        
        return response()->json(['decrement']);
    }

}
