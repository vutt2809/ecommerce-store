<?php
namespace App\Repositories\ShipState;

use App\Repositories\RepositoryInterface;

interface ShipStateInterface extends RepositoryInterface {

    public function getStateWithDivisionAndDistrict();
    
}