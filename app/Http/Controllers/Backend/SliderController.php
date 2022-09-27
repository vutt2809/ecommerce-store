<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function allSlider(){
        $sliders = Slider::latest()->get();

        return view('backend.slider.slider_view', compact('sliders'));
    }

    public function store(Request $request) {
        $request->validate([
            'slider_img' => 'required'
        ],[
            'slider_img.required' => 'Slider image is required',
        ]);

        $image = $request->file('slider_img');
        $make_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(870,370)->save('upload/slider/'.$make_name);
        $save_url = 'upload/slider/'.$make_name;

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'slider_img' => $save_url,
            'created_at' => Carbon::now()
        ]); 

        $notification = [
            'message' => 'Slider inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function edit($id) {
        $slider = Slider::findOrFail($id);

        return view('backend.slider.slider_edit', compact('slider'));
    }

    public function update(Request $request) {
        $sliderId = $request->id;

        if ($request->file('slider_img')){
            unlink($request->old_img);

            $image = $request->file('slider_img');
            $make_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(870,370)->save('upload/slider/'.$make_name);
            $save_url = 'upload/slider/'.$make_name;

            Slider::findOrFail($sliderId)->update([
                'title' => $request->title,
                'description' => $request->title,
                'slider_img' => $save_url
            ]);
        } else {
            Slider::findOrFail($sliderId)->update([
                'title' => $request->title,
                'description' => $request->description,
                'updated_at' => Carbon::now()
            ]);
        }

        $notification = [
            'message' => 'Slider updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('manage.slider')->with($notification);
    }

    public function delete($id) {
        $slider = Slider::findOrFail($id);
        $img = $slider->slider_img;
        unlink($img);

        $slider->delete();

        $notification = [
            'message' => 'Slider deleted successfully',
            'alert-type' => 'info'
        ];

        return redirect()->back()->with($notification);
    }

    public function active($id) {
        Slider::findOrFail($id)->update(['status' => 1]);
        $notification = [
            'message' => 'Slider is actived successfully',
            'alert-type' => 'info'
        ];

        return redirect()->back()->with($notification);
    }

    public function inactive($id){
        Slider::findOrFail($id)->update(['status' => 0]);
        $notification = [
            'message' => 'Slider is inactived successfully',
            'alert-type' => 'info'
        ];

        return redirect()->back()->with($notification);
    }
}
