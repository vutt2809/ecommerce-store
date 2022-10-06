<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    // public function allBrand() {
    //     $brands = Brand::latest()->get();
        
    //     return view('backend.brand.brand_view', compact('brands'));
    // }

    // public function store(Request $request) {
    //     $request->validate([
    //         'brand_name_en' => 'required',
    //         'brand_name_vn' => 'required',
    //         'brand_image' => 'required',
    //     ],[
    //         'brand_name_en.required' => 'Brand English name is required',
    //         'brand_name_vn.required' => 'Brand VietName name is required',
    //     ]);

    //     $image = $request->file('brand_image');
    //     $nameGeneration = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    //     Image::make($image)->resize(300, 300)->save('upload/brand/'.$nameGeneration);
    //     $save_url = 'upload/brand/'.$nameGeneration;
        
    //     Brand::insert([
    //         'brand_name_en' => $request->brand_name_en,
    //         'brand_name_vn' => $request->brand_name_vn,
    //         'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
    //         'brand_slug_vn' => strtolower(str_replace(' ', '-', $request->brand_name_vn)),
    //         'brand_image' => $save_url,
    //     ]);

    //     $notification = [
    //         'message' => 'Brand inserted successfully',
    //         'alert-type' => 'success'
    //     ];

    //     return redirect()->back()->with($notification);
    // }

    // public function edit($id) {
    //     $brand = Brand::findOrFail($id);
    //     return view('backend.brand.brand_edit', compact('brand'));
    // }

    // public function update(Request $request){
    //     $brandId = $request->id;
    //     $oldImg = $request->old_image;

    //     if($request->file('brand_image')){
    //         unlink($oldImg);
    //         $image = $request->file('brand_image');
    //         $nameGeneration = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    //         Image::make($image)->resize(300, 300)->save('upload/brand/'.$nameGeneration);
    //         $save_url = 'upload/brand/'.$nameGeneration;
            
    //         Brand::findOrFail($brandId)->update([
    //             'brand_name_en' => $request->brand_name_en,
    //             'brand_name_vn' => $request->brand_name_vn,
    //             'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
    //             'brand_slug_vn' => strtolower(str_replace(' ', '-', $request->brand_name_vn)),
    //             'brand_image' => $save_url,
    //         ]);

    //         $notification = [
    //             'message' => 'Brand updated successfully',
    //             'alert-type' => 'info',
    //         ];

    //         return redirect()->route('all.brand')->with($notification);
    //     }else {
    //         Brand::findOrFail($brandId)->update([ 
    //             'brand_name_en' => $request->brand_name_en,
    //             'brand_name_vn' => $request->brand_name_vn,
    //             'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
    //             'brand_slug_vn' => strtolower(str_replace(' ', '-', $request->brand_name_vn)),
    //         ]);

    //         $notification = [
    //             'message' => 'Brand updated successfully',
    //             'alert-type' => 'info',
    //         ];
            
    //         return redirect()->route('all.brand')->with($notification);
    //     }
    // }

    // public function delete($id) {
    //     $brand = Brand::findOrFail($id);
    //     $img = $brand->brand_image;
    //     unlink($img);

    //     Brand::findOrFail($id)->delete();

    //     return redirect()->back();
    // }

    private $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function index() {
        $brands = $this->brandRepository->all();

        return view('backend.brand.brand_view', compact('brands'));
    }

    public function create(Request $request) {
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_vn' => 'required',
            'brand_image' => 'required',
        ],[
            'brand_name_en.required' => 'Brand English name is required',
            'brand_name_vn.required' => 'Brand VietNamese name is required',
        ]);
    }

    public function edit($id) {
        $brand = $this->brandRepository->find($id);

        return view('backend.brand.brand_view', compact('brand'));
    }
}
