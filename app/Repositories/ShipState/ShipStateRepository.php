<?php
namespace App\Repositories\ShipState;

use App\Models\ShipState;
use App\Repositories\EloquentRepository;
use App\Repositories\ShipState\ShipStateInterface;

class ShipStateRepository extends EloquentRepository implements ShipStateInterface
{
    public function getModel() {
        return ShipState::class;
    }

    public function getStateWithDivisionAndDistrict() {
        $data = ShipState::with('district', 'division')->orderBy('id', 'DESC')->get();
        return $data;
    }
    
}