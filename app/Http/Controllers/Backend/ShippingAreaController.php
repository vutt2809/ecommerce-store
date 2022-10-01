<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    public function viewDivision() {
        $divisions = ShipDivision::orderBy('id', 'DESC')->get();

        return view('backend.ship.division.view_division', compact('divisions'));
    }

    public function storeDivision(Request $request){
        $request->validate([
            'division_name' => 'required'
        ], [
            'division_name.required' => 'Shipping division name is required'
        ]);

        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Shipping division inserted successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function editDivision($id) {
        $division = ShipDivision::findOrFail($id);

        return view('backend.ship.division.edit_division', compact('division'));
    }

    public function updateDivision(Request $request, $id) {
        ShipDivision::findOrFail($id)->update([
            'division_name' => $request->division_name
        ]);

        $notification = [
            'message' => 'Shipping division updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('manage.division')->with($notification);
    }

    public function deleteDivision($id) {
        ShipDivision::findOrFail($id)->delete();
        
        $notification = [
            'message' => 'Shipping division deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // ================Ship district================
    public function viewDistrict() {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::with('division')->orderBy('id', 'DESC')->get();    
        return view('backend.ship.district.view_district', compact('districts', 'divisions'));
    }

    public function storeDistrict(Request $request) {
        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required'
        ], [
            'division_id.required' => 'Division Name is required',
            'district_name.required' => 'District Name is required',
        ]);

        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now()
        ]);

        $notification = [
            'message' => 'Shipping district deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function editDistrict($id) {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistrict::findOrFail($id);

        return view('backend.ship.district.edit_district', compact('district', 'divisions'));
    }

    public function updateDistrict(Request $request, $id) {
        ShipDistrict::findOrFail($id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'updated_at' => Carbon::now()
        ]);

        $notification = [
            'message' => 'Shipping district updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('manage.district')->with($notification);
    }

    public function deleteDistrict($id) {
        ShipDistrict::findOrFail($id)->delete();

        $notification = [
            'message' => 'Shipping district deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // Ship State Section
    public function viewState() {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $states = ShipState::with('district', 'division')->orderBy('id', 'DESC')->get();

        return view('backend.ship.state.view_state', compact('districts', 'divisions', 'states'));
    }

    public function getDistrict ($division_id) {
        $districts = ShipDistrict::where('division_id', $division_id)->orderBy('district_name', 'DESC')->get();

        return json_encode($districts);
    }

    public function storeState(Request $request) {
        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
        ], [
            'division_id.required' => 'Division is required',
            'district_id.required' => 'District is required',
            'state_name.required' => 'State name is required',
        ]);

        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
        ]);

        $notification = [
            'message' => 'Shipping state inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function editState($id) {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('backend.ship.state.edit_state', compact('state', 'divisions', 'districts'));
    }

    public function updateState(Request $request, $id){
        ShipState::findOrFail($id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
        ]);

        $notification = [
            'message' => 'Shipping state updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('manage.state')->with($notification);
    }

    public function deleteState($id) {
        ShipState::findOrFail($id)->delete();

        $notification = [
            'message' => 'Shipping state deleted successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->route('manage.state')->with($notification);
    }


}
