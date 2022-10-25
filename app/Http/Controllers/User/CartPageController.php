<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Utils\CartHelper;
use App\Utils\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartPageController extends Controller
{
    public function myCart() {
        return view('frontend.cart.view_mycart');
    }

    public function getCartProduct() {
        $cart = Session::get('cart');

        if (isset($cart)) {
            $cartQuantity = Helpers::getTotalQuantity();
            $cartTotal = Helpers::getTotal();
    
            return response()->json([
                'cart' => $cart,
                'cartQuantity' => $cartQuantity,
                'cartTotal' => $cartTotal
            ]);
        }
    }

    public function removeProductFromCart($productId) {
        $cart = Session::get('cart');

        foreach ($cart as $key => $cartItem) {
            if ($cartItem['product']['id'] == $productId) {
                unset($cart[$key]);
            }
        }        

        Session::put('cart', $cart);

        $cartIsEmpty = empty($cart) ? true : false;

        return response()->json(['success' => 'Product have been removed from shopping cart', 'isEmpty' => $cartIsEmpty]);
    }

    public function increaseQuantity($productId) {
        $cart = Session::get('cart');

        foreach ($cart as $key => &$cartItem) {
            if ($cartItem['product']['id'] == $productId) {
                $cartItem['attributes']['quantity'] += 1;
            }
        }

        Session::put('cart', $cart);
        return response()->json(['increment']);
    }

    public function decreaseQuantity($productId) {
        $cart = Session::get('cart');

        foreach ($cart as $key => &$cartItem) {
            if ($cartItem['product']['id'] == $productId) {
                $cartItem['attributes']['quantity'] -= 1;

                if ($cartItem['attributes']['quantity'] == 0) {
                    unset($cart[$key]);
                }
            }
        }

        Session::put('cart', $cart);
        return response()->json(['decrement']);
    }

}
