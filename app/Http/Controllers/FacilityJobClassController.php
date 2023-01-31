<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FacilityJobClass;
use App\Helper\Helper;

class FacilityJobClassController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        return Helper::getRecords(FacilityJobClass::class, $request);
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
//        exit("hello-world");
        $facility_job_class = new FacilityJobClass();
        $facility_job_class->title = $request->title;
        $facility_job_class->save();
        return Helper::success_response($facility_job_class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $facility_job_class = FacilityJobClass::where(["id" => $id])->get()->first();

        return Helper::success_response($facility_job_class);
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
        $facility_job_class = FacilityJobClass::where(["id" => $id])->get()->first();
        $facility_job_class->title = $request->title;
        $facility_job_class->update();
        return Helper::success_response($facility_job_class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $facility_job_class = FacilityJobClass::where(["id" => $id])->get()->first();
        $facility_job_class->delete();
    }

}
