<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FacilityLocation;
use App\Helper\Helper;

class FacilityLocationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        return Helper::getRecords(FacilityLocation::class, $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $facility_location = new FacilityLocation();
        $facility_location->title = $request->title;
        $facility_location->save();
        return Helper::success_response($facility_location);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $facility_location = FacilityLocation::where(["id" => $id])->get()->first();

        return Helper::success_response($facility_location);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $facility_location = FacilityLocation::where(["id" => $id])->get()->first();
        $facility_location->title = $request->title;
        $facility_location->update();
        return Helper::success_response($facility_location);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $facility_location = FacilityLocation::where(["id" => $id])->get()->first();
        $facility_location->delete();
    }

}
