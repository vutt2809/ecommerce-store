<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Money\Money;

class CartController extends Controller
{
    public function addToCart(Request $request, $id) {
        if (Session::has('coupon')){
            Session::forget('coupon');
        }
        $product = Product::findOrFail($id);

        if ($product->discount_price == NULL){
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => (int)$request->quantity,
                'price' => Money::USD($product->selling_price),
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail, 
                    'size' => $request->size, 
                    'color' => $request->color
                ],
            ]);
            return response()->json(['success' => 'Successfully added your cart']);
        }else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => (int)$request->quantity,
                'price' => Money::USD($product->discount_price),
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail, 
                    'size' => $request->size, 
                    'color' => $request->color
                ],
            ]);
            return response()->json(['success' => 'Successfully added your cart']);
        }
    }

    public function addMiniCart(){
        $carts = Cart::content();
        $cartQuantity = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'carts' => $carts,
            'cartQuantity' => $cartQuantity,
            'cartTotal' => $cartTotal,
        ]);
    }

    public function removeMiniCart($id){
        Cart::remove($id);
        return response()->json(['success' => 'Product remove from cart']);
    }
    
    public function addToWishlist(Request $request, $product_id){

        if (Auth::check()){
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            if (!$exists){
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now()
                ]);
                return response()->json(['success' => 'Successfully added on your wishlist']);
            }else{
                return response()->json(['error' => 'This product has already on your wishlist']);            
            }
        }else{
            return response()->json(['error' => 'At first login your account']);
        }
    }

    public function applyCoupon(Request $request) {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('status', 1)->where('coupon_validity' ,'>=', Carbon::now()->format('Y-m-d'))->first();
        if ($coupon){
            $total = Cart::total();
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $total->multiply($coupon->coupon_discount)->divide(100),
                'total_amount' => $total->subtract($total->multiply($coupon->coupon_discount)->divide(100)),
                
            ]);
            return response()->json(['success' => 'Coupon applied successfully']);
        }else{
            return response()->json(['error' => 'Invalid coupon']);
        }
    }

    public function calculationCoupon() {
        if (Session::has('coupon')){
            return response()->json([
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => Cart::total()->multiply(session()->get('coupon')['coupon_discount'])->divide(100),
                'total_amount' => Cart::total()->subtract(Cart::total()->multiply(session()->get('coupon')['coupon_discount'])->divide(100)),
            ]);
        }else{
            return response()->json([
                'total' => Cart::total(),
            ]);
        }
    }

    public function removeCoupon(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon removed successfully']);
    }



}
