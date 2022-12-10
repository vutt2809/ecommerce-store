<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Repositories\Brand\BrandInterface;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\MultiImg\MultiImgInterface;
use App\Repositories\Product\ProductInterface;
use App\Utils\Helpers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $brandRepository;
    protected $multiImgRepository;

    public function __construct(ProductInterface $productRepository, CategoryInterface $categoryRepository, BrandInterface $brandRepository, MultiImgInterface $multiImgRepository) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        $this->multiImgRepository = $multiImgRepository;
    }

    public function handleImageSize($request) {
        $imgSize = $request->imgSize;

        $imgWidth = 0;
        $imgHeight = 0;

        if ($imgSize == '1200x800'){
            $imgWidth = 1200; $imgHeight = 800;
        }
        if ($imgSize == '917x1000'){
            $imgWidth = 917; $imgHeight = 1000;
        }
        if ($imgSize == '792x1056'){
            $imgWidth = 792; $imgHeight = 1056;
        }

        return [$imgWidth, $imgHeight];
    }

    public function handleRequest(Request $request) {
        $data = $request->all();

        $request->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',
            'product_name_en' => 'required',
            'product_name_vn' => 'required',
            'product_qty' => 'required',
            'selling_price' => 'required',
            'product_thumbnail' => 'required',
            'multi_img' => 'required',
            'short_descp_en' => 'required',
            'short_descp_vn' => 'required',
            'long_descp_en' => 'required',
            'long_descp_vn' => 'required',
            'image_size' => 'required'
        ]);

        [$imgWidth, $imgHeight] = $this->handleImageSize($request);
       
        $image = $request->file('product_thumbnail');
        $saveURL = Helpers::saveImage($image, [$imgWidth, $imgHeight], 'upload/product/thumbnail/');

        $data['product_thumbnail'] = $saveURL;
        $data['status'] = 1;
        $data['product_slug_vn'] = strtolower(str_replace(' ', '-', $request->product_name_vn));
        $data['product_slug_en'] = strtolower(str_replace(' ', '-', $request->product_name_en));

        return $data;
    }

    public function add() {
        $categories = $this->categoryRepository->getAll();
        $brands = $this->brandRepository->getAll();

        return view('backend.product.product_add', compact('categories' ,'brands'));
    }

    public function store(Request $request) {
        $data = $this->handleRequest($request);
        $product = $this->productRepository->create($data);
        $productId = $product->id;

        $images = $request->file('multi_img');

        [$imgWidth, $imgHeight] = $this->handleImageSize($request);

        foreach ($images as $image) {
            $uploadPath = Helpers::saveImage($image, [$imgWidth, $imgHeight], 'upload/product/multi-image/');
            // $this->multiImgRepository->create();
            

            MultiImg::insert([
                'product_id' => $productId,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now()
            ]);
        }

        $notification = [
            'message' => 'Product inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('manage.product')->with($notification);
    }

    public function manage() {
        $products = Product::latest()->get();

        return view('backend.product.product_view', compact('products'));
    }

    public function edit($id) {
        $multiImgs = MultiImg::where('product_id', $id)->get();

        $categories = Category::latest()->get();
        $subCategories = SubCategory::latest()->get();
        $subSubCategories = SubSubCategory::latest()->get();
        $brands = Brand::latest()->get();
        $product = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('product', 'brands', 'categories', 'subCategories', 'subSubCategories', 'multiImgs'));
    }

    public function update(Request $request){
        $productId = $request->id;

        Product::findOrFail($productId)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_vn' => $request->product_name_vn,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_vn' => strtolower(str_replace(' ', '-', $request->product_name_vn)),
            'product_code' => $request->product_code,

            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_vn' => $request->product_tags_vn, 
            'product_size_en' => $request->product_size_en,
            'product_size_vn' => $request->product_size_vn,
            'product_color_en' => $request->product_color_en,
            'product_color_vn' => $request->product_color_vn,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_vn' => $request->short_descp_vn,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_vn' => $request->long_descp_vn,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Product updated without image successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('manage.product')->with($notification);
    }

    public function updateMultiImage(Request $request) {
        $imgs = $request->multi_img;
        $image_size = $request->image_size;

        if ($image_size == '1200x800'){
            $w = 1200; $h = 800;
        }

        if ($image_size == '917x1000'){
            $w = 917; $h = 1000;
        }

        if ($image_size == '792x1056'){
            $w = 792; $h = 1056;
        }

        foreach ($imgs as $id => $img) {
            $existImg = MultiImg::findOrFail($id);
            unlink($existImg->photo_name);

            $makeName = hexdec(uniqid()). ' . '. $img->getClientOriginalExtension();
            Image::make($img)->resize($w, $h)->save('upload/product/multi-image/'.$makeName);
            $uploadPath = 'upload/product/multi-image/'. $makeName;

            MultiImg::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now()
            ]);
        }

        $notification = [
            'message' => 'Product image updated successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('manage.product')->with($notification);
    }

    public function updateThumbnailImage(Request $request) {
        $productId = $request->id;
        $existProduct = Product::findOrFail($productId);
        unlink($existProduct->product_thumbnail); 

        $image_size = $request->image_size;
        if ($image_size == '1200x800'){
            $w = 1200; $h = 800;
        }
        if ($image_size == '917x1000'){
            $w = 917; $h = 1000;
        }
        if ($image_size == '792x1056'){
            $w = 792; $h = 1056;
        }

        $img = $request->file('product_thumbnail');

        $makeName = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize($w, $h)->save('upload/product/thumbnail/'.$makeName);
        $uploadPath = 'upload/product/thumbnail/'.$makeName;

        Product::findOrFail($productId)->update([
            'product_thumbnail' => $uploadPath,
            'updated_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Product thumbnail image updated successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('manage.product')->with($notification);
    }

    public function deleteMultiImage($id) {
        $oldImg = MultiImg::findOrFail($id);
        unlink($oldImg->photo_name);

        MultiImg::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function inactiveProduct($id) {
        Product::findOrFail($id)->update([
            'status' => 0
        ]);

        $notification = [
            'message' => 'Product inactive successfully',
            'alert-type' => 'info'
        ];

        return redirect()->back()->with($notification);
    }

    public function activeProduct($id) {
        Product::findOrFail($id)->update([
            'status' => 1
        ]);

        $notification = [
            'message' => 'Product active successfully',
            'alert-type' => 'info'
        ];

        return redirect()->back()->with($notification);
    }

    public function deleteProductData($id){
        $product = Product::findOrFail($id);

        unlink($product->product_thumbnail);
        
        $multiImgs = MultiImg::where('product_id', $id)->get();
        foreach($multiImgs as $img){
            unlink($img->photo_name);
            $img->delete();
        }

        $product->delete();

        $notification = [
            'message' => 'Product deleted successfully',
            'alert-type' => 'info'
        ];

        return redirect()->back()->with($notification);
    }
}

