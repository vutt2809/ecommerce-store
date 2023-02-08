<?php
namespace App\Repositories\Slider;

use App\Repositories\RepositoryInterface;

interface SliderInterface extends RepositoryInterface {
    public function active($id);
    public function inActive($id);
}