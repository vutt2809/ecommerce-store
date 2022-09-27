<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    public function addToCart(Request $request, $id) {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $product = Product::findOrFail($id);

        if ($product->discount_price == NULL) {
            Cart::add([
                'id' => hexdec(uniqid()),
                'name' => $request->product_name,
                'quantity' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'attributes' => [
                    'image' => $product->product_thumbnail, 
                    'size' => $request->size, 
                    'color' => $request->color
                ],
                'associatedModel' => $product
            ]);

            return response()->json(['success' => 'Successfully added your cart']);
        } else {
            Cart::add([
                'id' => hexdec(uniqid()),
                'name' => $request->product_name,
                'quantity' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'attributes' => [
                    'image' => $product->product_thumbnail, 
                    'size' => $request->size, 
                    'color' => $request->color
                ],
                'associatedModel' => $product
            ]);

            return response()->json(['success' => 'Successfully added your cart']);
        }
    }

    public function addMiniCart() {
        $carts = Cart::getContent();
        $cartQuantity = Cart::getTotalQuantity();
        $cartTotal = Cart::getTotal();

        return response()->json([
            'carts' => $carts,
            'cartQuantity' => $cartQuantity,
            'cartTotal' => $cartTotal,
        ]);
    }

    public function removeMiniCart($id) {
        Cart::remove($id);

        return response()->json(['success' => 'Product remove from cart']);
    }
    
    public function addToWishlist(Request $request, $product_id) {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            if(!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
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
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('status', 1)->where('coupon_validity' ,'>=', Carbon::now()->format('Y-m-d'))->first();
        
        if ($coupon) {
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => Cart::getTotal() * ($coupon->coupon_discount) / (100),
                'total_amount' => Cart::getTotal() - (Cart::getTotal() * (($coupon->coupon_discount) / 100)),
            ]);
            
            return response()->json(['success' => 'Coupon applied successfully']);
        }else {
            return response()->json(['error' => 'Invalid coupon']);
        }
    }

    public function calculationCoupon() {
        if (Session::has('coupon')) {
            return response()->json([
                'subtotal' => Cart::getTotal(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => Cart::getTotal() - (session()->get('coupon')['coupon_discount']) / 100,
                'total_amount' => Cart::getTotal() - (Cart::getTotal() * (session()->get('coupon')['coupon_discount']) / 100),
            ]);
        }else {
            return response()->json([
                'total' => Cart::getTotal(),
            ]);
        }
    }

    public function removeCoupon() {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon removed successfully']);
    }

    public function checkout() {
        if (Auth::check()) { 
            if (Cart::getTotal() > 0) {
                $carts = Cart::getContent();
                $cartQuantity = Cart::getTotalQuantity();
                $cartTotal = Cart::getTotal();

                $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
                $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();

                return view('frontend.checkout.checkout_view', compact('carts', 'cartQuantity', 'cartTotal', 'divisions', 'districts'));
            }else {
                $notification = [
                    'message' => 'Shoppping at least one product',
                    'alert-type' => 'warning'
                ];
                return redirect()->to('/')->with($notification);
            }
        }else {
            $notification = [
                'message' => 'You need to login first',
                'alert-type' => 'warning'
            ];
            return redirect()->route('login')->with($notification);
        }
    }








}
