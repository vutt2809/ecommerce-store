<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Brand\BrandInterface;
use App\Utils\Helpers;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    protected $brandRepository;

    public function __construct(BrandInterface $brandRepository) {
        $this->brandRepository = $brandRepository;
    }

    public function storeImage($request) {
        $data = $request->all();
        $image = $request->file('brand_image');

        $saveUrl = Helpers::saveImage($image, 300, 300, 'upload/brand/');
        $data['brand_image'] = $saveUrl;
    }

    public function preHandleRequest(Request $request) {
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_vn' => 'required',
            'brand_image' => 'required',
        ],[
            'brand_name_en.required' => 'Brand English name is required',
            'brand_name_vn.required' => 'Brand VietName name is required',
        ]);

        $data = $request->all();
        $image = $request->file('brand_image');

        if ($request->id) {
            if ($request->file('brand_image')) {
                $oldImg = $request->old_image;
                unlink($oldImg);
                $saveUrl = Helpers::saveImage($image, 300, 300, 'upload/brand/');
                $data['brand_image'] = $saveUrl;
            } 
            unset($data['old_image']);
            
        } else {
            $saveUrl = Helpers::saveImage($image, 300, 300, 'upload/brand/');
            $data['brand_image'] = $saveUrl;
        }

        $data['brand_slug_en'] = strtolower(str_replace(' ', '-', $request->brand_name_en));
        $data['brand_slug_vn'] = strtolower(str_replace(' ', '-', $request->brand_name_vn));

        return $data;
    }

    public function index() {
        $brands = $this->brandRepository->getAll();
        return view('backend.brand.brand_view', compact('brands'));
    }

    public function store(Request $request) {
        $data = $this->preHandleRequest($request);
        $this->brandRepository->create($data);

        $notification = [
            'message' => 'Brand inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function edit($id) {
        $brand = $this->brandRepository->find($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function update(Request $request){
        $brandId = $request->id;

        $data = $this->preHandleRequest($request);

        $this->brandRepository->update($brandId, $data);
       
        $notification = [
            'message' => 'Brand updated successfully',
            'alert-type' => 'info',
        ];
        
        return redirect()->route('all.brand')->with($notification);
    }

    public function delete($id) {
        $brand = $this->brandRepository->find($id);

        $img = $brand->brand_image;
        unlink($img);

        $this->brandRepository->delete($id);

        return redirect()->back();
    }
}
