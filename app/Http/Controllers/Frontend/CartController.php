<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\Wishlist;
use App\Utils\Helpers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    public function addToCart(Request $request, $productId) {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $product = Product::findOrFail($productId);
        $cart = Session::get('cart');

        $price = $product->discount_price == NULL ? $product->selling_price : $product->discount_price;

        $newCartItem = [
            'product' => $product,
            'attributes' => [
                'price' => $price,
                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity,
            ]
        ];

        if (isset($cart)) {
            $cartItemIndex = Helpers::checkProductInCart($newCartItem);

            if ($cartItemIndex >= 0) {
                $cart[$cartItemIndex]['attributes']['quantity'] += $request->quantity;
            } else {
                array_push($cart, $newCartItem);
            }
        }
        else {
            $cart = [ $newCartItem ];
        }

        Session::put('cart', $cart);
        return response()->json(['success' => 'Successfully added your cart']);
    }

    public function addMiniCart() {
        $cart = Session::get('cart');

        if (isset($cart)) {
            $cartQuantity = Helpers::getTotalQuantity();
            $cartTotal = Helpers::getTotal();

            return response()->json([
                'cart' => $cart,
                'cartQuantity' => $cartQuantity,
                'cartTotal' => $cartTotal,
            ]);
        }
    }

    public function removeMiniCart($productId) {
        $cart = Session::get('cart');

        foreach ($cart as $key => $cartItem) {
            if ($cartItem['product']['id'] == $productId) {
                unset($cart[$key]);
            }
        }

        Session::put('cart', $cart);
        return response()->json(['success' => 'Product remove from cart']);
    }

    public function addToWishlist(Request $request, $productId) {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $productId)->first();

            if(!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'created_at' => Carbon::now()
                ]);

                return response()->json(['success' => 'Successfully added on your wishlist']);
            }else {
                return response()->json(['error' => 'This product has already on your wishlist']);
            }
        }else {
            return response()->json(['error' => 'At first login your account']);
        }
    }

    public function applyCoupon(Request $request) {
        $coupon = Coupon::where('coupon_name', $request->couponName)
        ->where('status', 1)
        ->where('coupon_validity' ,'>=', Carbon::now()
        ->format('Y-m-d'))
        ->first();

        if ($coupon) {
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => Helpers::getTotal() * ($coupon->coupon_discount) / (100),
                'total_amount' => Helpers::getTotal() - (Helpers::getTotal() * (($coupon->coupon_discount) / 100)),
            ]);

            return response()->json(['success' => 'Coupon applied successfully']);
        }else {
            return response()->json(['error' => 'Invalid coupon']);
        };
    }

    public function calculationCoupon() {
        if (Session::has('coupon')) {
            return response()->json([
                'subtotal' => Helpers::getTotal(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => Helpers::getTotal() - (session()->get('coupon')['coupon_discount']) / 100,
                'total_amount' => Helpers::getTotal() - (Helpers::getTotal() * (session()->get('coupon')['coupon_discount']) / 100),
            ]);
        }else {
            return response()->json([
                'total' => Helpers::getTotal(),
            ]);
        }
    }

    public function removeCoupon() {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon removed successfully']);
    }

    public function checkout() {
        if (Auth::check()) {
            if (Helpers::getTotal() > 0) {
                $cart = Session::get('cart');
                $cartQuantity = Helpers::getTotalQuantity();
                $cartTotal = Helpers::getTotal();

                $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
                $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();

                return view('frontend.checkout.checkout_view', compact('cart', 'cartQuantity', 'cartTotal', 'divisions', 'districts'));
            }else {
                $notify = Helpers::notification('Shoppping at least one product', 'warning');
                return redirect()->to('/')->with($notify);
            }
        }else {
            $notify = Helpers::notification('You need to login first', 'warning');
            return redirect()->route('login')->with($notify);
        }
    }
}
