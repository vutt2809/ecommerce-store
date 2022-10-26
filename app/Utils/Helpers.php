<?php

namespace App\Utils;

use Illuminate\Support\Facades\Session;

class Helpers {
    
    public static function getTotal() {
        $cart = Session::get('cart');
        $total = 0;

        foreach ($cart as $cartItem) {
            $total += $cartItem['attributes']['price'] * $cartItem['attributes']['quantity'];
        }

        return (float)$total;
    }

    public static function getTotalQuantity() {
        $cart = Session::get('cart');
        $totalQuantity = 0;

        foreach ($cart as  $cartItem) {
            $totalQuantity += $cartItem['attributes']['quantity'];
        }

        return $totalQuantity;
    }

    public static function checkProductInCart($newCartItem) {
        $cart = Session::get('cart');

        foreach ($cart as $key => $cartItem) {
            if ($cartItem['product']['id'] == $newCartItem['product']['id'] 
                && $cartItem['attributes']['color'] == $newCartItem['attributes']['color']
                && $cartItem['attributes']['size'] == $newCartItem['attributes']['size']) {
                return $key;
            }
        }

        return -1;
    }
}