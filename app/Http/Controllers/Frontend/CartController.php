<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
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
}
