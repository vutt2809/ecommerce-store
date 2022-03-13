<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Money\Money;

class CartController extends Controller
{
    public function addToCart(Request $request, $id) {
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
}
