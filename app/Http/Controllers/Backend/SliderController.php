<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Repositories\Slider\SliderInterface;
use App\Utils\Helpers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $sliderRepository;

    public function __construct(SliderInterface $sliderRepository) {
        $this->sliderRepository = $sliderRepository;
    }

    public function handleRequest(Request $request) {
        $request->validate([
            'slider_img' => 'required'
        ],[
            'slider_img.required' => 'Slider image is required',
        ]);

        $data = $request->all();

        if ($request->file('slider_img')) {
            unlink($request->old_img);
            $saveUrl = Helpers::saveImage($request->file('slider_img'), 870, 370, 'upload/slider');
            $data['slider_img'] = $saveUrl;
        }
        return $data;
    }

    public function allSlider() {
        $sliders = $this->sliderRepository->getAll();
        return view('backend.slider.slider_view', compact('sliders'));
    }

    public function store(Request $request) {
        $data = $this->handleRequest($request);

        $this->sliderRepository->create($data);

        $notification = [
            'message' => 'Slider inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function edit($id) {
        $slider = $this->sliderRepository->find($id);
        return view('backend.slider.slider_edit', compact('slider'));
    }

    public function update(Request $request) {
        $sliderId = $request->id;

        if ($request->file('slider_img')){
            unlink($request->old_img); 
        } 

        $data = $this->handleRequest($request);
        $this->sliderRepository->update($data, $sliderId);

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
        $this->sliderRepository->active($id);

        $notification = [
            'message' => 'Slider is actived successfully',
            'alert-type' => 'info'
        ];

        return redirect()->back()->with($notification);
    }

    public function inactive($id) {
        $this->sliderRepository->inActive($id);

        $notification = [
            'message' => 'Slider is inactived successfully',
            'alert-type' => 'info'
        ];

        return redirect()->back()->with($notification);
    }
}
