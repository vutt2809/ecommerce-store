<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartPageController extends Controller
{
    public function myCart() {
        return view('frontend.cart.view_mycart');
    }

    public function getCartProduct() {
        $carts = Cart::content();
        $cartQuantity = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'carts' => $carts,
            'cartQuantity' => $cartQuantity,
            'cartTotal' => $cartTotal
        ]);
    }

    public function removeProductFromCart($rowId) {
        Cart::remove($rowId);
        return response()->json(['success' => 'Product have been removed from shopping cart']);
    }

    public function increaseQuantity($rowId) {
        $product = Cart::get($rowId);
        Cart::update($rowId, $product->qty + 1);
        return response()->json(['increment']);
    }

    public function decreaseQuantity($rowId) {
        $product = Cart::get($rowId);
        Cart::update($rowId, $product->qty - 1);
        return response()->json(['decrement']);
    }

}
