<?php
namespace App\Repositories\ShipDistrict;

use App\Repositories\RepositoryInterface;

interface ShipDistrictInterface extends RepositoryInterface {

    public function getAllWithDivision();

    public function getDistrictByDivision($divisionId);
}