<?php
namespace App\Repositories\ShipDistrict;

use App\Models\ShipDistrict;
use App\Repositories\EloquentRepository;

class ShipDistrictRepository extends EloquentRepository implements ShipDistrictInterface
{
    public function getModel() {
        return ShipDistrict::class;
    }

    public function getAllWithDivision() {
        $data = ShipDistrict::with('division')->orderBy('id', 'DESC')->get(); 
        return $data;
    }

    public function getDistrictByDivision($divisionId) {
        $data = ShipDistrict::where('division_id', $divisionId)->orderBy('district_name', 'DESC')->get();
        return $data;
    }
}