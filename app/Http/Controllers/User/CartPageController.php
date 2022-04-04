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

        if (Session::has('coupon')){
            Session::forget('coupon');
        }
        return response()->json(['success' => 'Product have been removed from shopping cart']);
    }

    public function increaseQuantity($rowId) {
        $product = Cart::get($rowId);
        Cart::update($rowId, $product->qty + 1);

        // if (Session::has('coupon')){
        //     $couponName = Session::get('coupon')['coupon_name'];
        //     $coupon = Coupon::where('coupon_name', $couponName)->first();


        //     Session::put('coupon',[
        //         'coupon_name' => $couponName,
        //         'coupon_discount' => $coupon->coupon_discount,
        //         'discount_amount' => Cart::total()->multiply($coupon->coupon_discount)->divide(100),
        //         'total_amount' => Cart::total() - Cart::total()->multiply($coupon->coupon_discount)->divide(100),
        //     ]);

        // }

        return response()->json(['increment']);
    }

    public function decreaseQuantity($rowId) {
        $product = Cart::get($rowId);
        Cart::update($rowId, $product->qty - 1);

        // if (Session::has('coupon')){
        //     $couponName = Session::get('coupon')['coupon_name'];
        //     $coupon = Coupon::where('coupon_name', $couponName)->first();


        //     Session::put('coupon',[
        //         'coupon_name' => $couponName,
        //         'coupon_discount' => $coupon->coupon_discount,
        //         'discount_amount' => Cart::total()->multiply($coupon->coupon_discount)->divide(100),
        //         'total_amount' => Cart::total()->subtract(Cart::total()->multiply($coupon->coupon_discount)->divide(100)),
        //     ]);
            
        // }
        return response()->json(['decrement']);
    }

}
