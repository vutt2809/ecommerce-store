<?php
namespace App\Repositories\MultiImg;

use App\Models\MultiImg;
use App\Repositories\EloquentRepository;

class MultiImgRepository extends EloquentRepository implements MultiImgInterface
{
    public function getModel() {
        return MultiImg::class;
    }
}