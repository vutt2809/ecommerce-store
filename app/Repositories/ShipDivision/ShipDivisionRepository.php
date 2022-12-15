<?php
namespace App\Repositories\ShipDivision;

use App\Models\ShipDivision;
use App\Repositories\EloquentRepository;
use App\Repositories\ShipDivision\ShipDivisionInterface;

class ShipDivisionRepository extends EloquentRepository implements ShipDivisionInterface
{
    public function getModel() {
        return ShipDivision::class;
    }
}