<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\ShipDistrict\ShipDistrictInterface;
use App\Repositories\ShipDivision\ShipDivisionInterface;
use App\Repositories\ShipState\ShipStateInterface;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    protected $divisionRepository;
    protected $districtRepository;
    protected $stateRepository;

    public function __construct(ShipDivisionInterface $divisionRepository, ShipDistrictInterface $districtRepository, ShipStateInterface $stateRepository) {
        $this->divisionRepository = $divisionRepository;
        $this->districtRepository = $districtRepository;
        $this->stateRepository = $stateRepository;
    }

    public function handleRequestDivision(Request $request) {
        $data = $request->all();
        $request->validate([
            'division_name' => 'required'
        ], [
            'division_name.required' => 'Shipping division name is required'
        ]);

        return $data;
    }

    public function handleRequestDistrict(Request $request) {
        $data = $request->all();

        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required'
        ], [
            'division_id.required' => 'Division Name is required',
            'district_name.required' => 'District Name is required',
        ]);

        return $data;
    }

    public function viewDivision() {
        $divisions = $this->divisionRepository->getAll();
        return view('backend.ship.division.view_division', compact('divisions'));
    }

    public function storeDivision(Request $request){
        $data = $this->handleRequestDivision($request);
        $this->divisionRepository->create($data);

        $notification = [
            'message' => 'Shipping division inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function editDivision($id) {
        $division = $this->divisionRepository->find($id);
        return view('backend.ship.division.edit_division', compact('division'));
    }

    public function updateDivision(Request $request, $id) {
        $data = $this->handleRequestDivision($request);

        $this->divisionRepository->update($id, $data);

        $notification = [
            'message' => 'Shipping division updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('manage.division')->with($notification);
    }

    public function deleteDivision($id) {
        $this->divisionRepository->delete($id);
        
        $notification = [
            'message' => 'Shipping division deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // ================Ship district================
    public function viewDistrict() {
        $divisions = $this->divisionRepository->getAll();
        $districts = $this->districtRepository->getAllWithDivision();   
        return view('backend.ship.district.view_district', compact('districts', 'divisions'));
    }

    public function storeDistrict(Request $request) {
        $data = $this->handleRequestDistrict($request);

        $this->districtRepository->create($data);

        $notification = [
            'message' => 'Shipping district deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function editDistrict($id) {
        $divisions = $this->divisionRepository->getAll();
        $district = $this->districtRepository->find($id);

        return view('backend.ship.district.edit_district', compact('district', 'divisions'));
    }

    public function updateDistrict(Request $request, $id) {
        $data = $this->handleRequestDistrict($request);

        $this->districtRepository->update($id, $data);

        $notification = [
            'message' => 'Shipping district updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('manage.district')->with($notification);
    }

    public function deleteDistrict($id) {
        $this->districtRepository->delete($id);

        $notification = [
            'message' => 'Shipping district deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // Ship State Section
    public function handleRequestState(Request $request) {
        $data = $request->all();

        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
        ], [
            'division_id.required' => 'Division is required',
            'district_id.required' => 'District is required',
            'state_name.required' => 'State name is required',
        ]);

        return $data;
    }

    public function viewState() {
        $divisions = $this->divisionRepository->getAll();
        $districts = $this->districtRepository->getAll();
        $states = $this->stateRepository->getStateWithDivisionAndDistrict();

        return view('backend.ship.state.view_state', compact('districts', 'divisions', 'states'));
    }

    public function getDistrict ($divisionId) {
        $districts = $this->districtRepository->getDistrictByDivision($divisionId);
        return json_encode($districts);
    }

    public function storeState(Request $request) {
        $data = $this->handleRequestState($request);

        $this->stateRepository->create($data);

        $notification = [
            'message' => 'Shipping state inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function editState($id) {
        $divisions = $this->divisionRepository->getAll();
        $districts = $this->districtRepository->getAll();
        $state = $this->stateRepository->find($id);
        return view('backend.ship.state.edit_state', compact('state', 'divisions', 'districts'));
    }

    public function updateState(Request $request, $id){
        $data = $this->handleRequestState($request);

        $this->stateRepository->update($id, $data);

        $notification = [
            'message' => 'Shipping state updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('manage.state')->with($notification);
    }

    public function deleteState($id) {
        $this->stateRepository->delete($id);

        $notification = [
            'message' => 'Shipping state deleted successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->route('manage.state')->with($notification);
    }


}
