<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FacilityDepartment;
use App\Helper\Helper;

class FacilityDepartmentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        return Helper::getRecords(FacilityDepartment::class, $request);
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
        $facility_department = new FacilityDepartment();
        $facility_department->title = $request->title;
        $facility_department->save();
        return Helper::success_response($facility_department);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $facility_department = FacilityDepartment::where(["id" => $id])->get()->first();

        return Helper::success_response($facility_department);
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
        $facility_department = FacilityDepartment::where(["id" => $id])->get()->first();
        $facility_department->title = $request->title;
        $facility_department->update();
        return Helper::success_response($facility_department);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $facility_department = FacilityDepartment::where(["id" => $id])->get()->first();
        $facility_department->delete();
    }

}
