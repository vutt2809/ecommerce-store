<?php
namespace App\Repositories\Slider;

use App\Models\Slider;
use App\Repositories\EloquentRepository;
use App\Repositories\Slider\SliderInterface;

class SliderRepository extends EloquentRepository implements SliderInterface
{
    public function getModel() {
        return Slider::class;
    }

    public function active($id) {
        Slider::findOrFail($id)->update(['status' => 1]);    
    }

    public function inActive($id) {
        Slider::findOrFail($id)->update(['status' => 0]);
    }
}