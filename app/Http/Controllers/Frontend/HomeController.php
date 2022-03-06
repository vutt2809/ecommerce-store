<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\User;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index (){
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $featured = Product::where('featured', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $hotdeals = Product::where('hot_deals', 1)->where('discount_price', '!=', NULL)->orderBy('id', 'DESC')->limit(6)->get();
        $specialOffer = Product::where('special_offer', 1)->orderBy('id', 'DESC')->limit(4)->get();
        $specialDeals = Product::where('special_deals', 1)->orderBy('id', 'DESC')->limit(4)->get();
        // =====Category 0=====
        $skipCategory0 = Category::skip(0)->first();
        $skipProduct0 = Product::where('status', 1)->where('category_id', $skipCategory0->id)->orderBy('id', 'DESC')->get();
        // =====Category 1=====
        $skipCategory1 = Category::skip(1)->first();
        $skipProduct1 = Product::where('status', 1)->where('category_id', $skipCategory1->id)->orderBy('id', 'DESC')->get();
        // =======Brand 1===========
        $skipBrand1 = Brand::skip(1)->first();
        $skipBrandProduct1 = Product::where('status', 1)->where('brand_id', $skipBrand1->id)->orderBy('id', 'DESC')->get();
    

        return view('frontend.index', compact('categories', 'sliders', 'products', 'featured', 'hotdeals', 'specialOffer', 'specialDeals'
                    , 'skipCategory0', 'skipProduct0', 'skipCategory1', 'skipProduct1', 'skipBrand1', 'skipBrandProduct1'));
    }

    public function logout() {
        Auth::logout();
        return Redirect()->route('login');
    }

    public function profile() {
        $user = User::find(Auth::user()->id);
        return view('frontend.profile.user_profile', compact('user'));
    }

    public function profileStore (Request $request){
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            //unlink(public_path('upload/user_images/'.$user->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $user['profile_photo_path'] = $filename;
        }

        $user->save();

        $noti = [
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('user.profile')->with($noti); 
    }

    public function changePassword (){
        $user = User::find(Auth::user()->id);
        return view('frontend.profile.change_password', compact('user'));
    }

    public function updatePassword(Request $request) {
        $id = Auth::user()->id;

        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = User::find($id)->password;
        if (Hash::check($request->oldpassword, $hashedPassword)){
            $user = User::find($id);
            $user->password = Hash::make($request->password);  
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        }
        $noti = [
            'message' => 'Update failed',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($noti);
    }

    public function productDetail($id, $slug){
        $product = Product::findOrFail($id);
        $multiImages = MultiImg::where('product_id', $id)->get();
        return view('frontend.product.product_detail', compact('product', 'multiImages')); 
    }

    public function tagWiseProduct($tag){
        $products = Product::where('status', 1)->where('product_tags_en', $tag)->where('product_tags_vn', $tag)->orderBy('id', 'DESC')->paginate(2);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('frontend.tags.tags_view', compact('products', 'categories')); 
    }
}
