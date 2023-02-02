<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\FacilityTutorial;
use Illuminate\Http\Request;

class FacilityTutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilityTutorial = FacilityTutorial::all();
        return Helper::success_response($facilityTutorial);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $facilityTutorial = new FacilityTutorial();
        $facilityTutorial->cfacility_id = $request->cfacility_id;
        $facilityTutorial->title = $request->title;
        $facilityTutorial->description = $request->description;
        $facilityTutorial->save();
        return Helper::success_response($facilityTutorial);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FacilityTutorial  $facilityTutorial
     * @return \Illuminate\Http\Response
     */
    public function show(FacilityTutorial $facilityTutorial)
    {
        return Helper::success_response($facilityTutorial);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacilityTutorial  $facilityTutorial
     * @return \Illuminate\Http\Response
     */
    public function edit(FacilityTutorial $facilityTutorial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacilityTutorial  $facilityTutorial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacilityTutorial $facilityTutorial)
    {
        // $facilityTutorial = new FacilityTutorial();
        $facilityTutorial->cfacility_id = $request->cfacility_id;
        $facilityTutorial->title = $request->title;
        $facilityTutorial->description = $request->description;
        $facilityTutorial->update();
        return Helper::success_response($facilityTutorial);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacilityTutorial  $facilityTutorial
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacilityTutorial $facilityTutorial)
    {
        $facilityTutorial->delete();
        return Helper::success_response([], 'delete-success');
    }
}
