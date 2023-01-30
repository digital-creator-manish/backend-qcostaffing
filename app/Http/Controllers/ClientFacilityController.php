<?php

namespace App\Http\Controllers;

use App\Models\ClientFacility;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Models\Discipline;

class ClientFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $clientFacility = ClientFacility::all();
        return Helper::getRecords(ClientFacility::class, $request);
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
        $clientFacility = new ClientFacility();
        $clientFacility->facility_name = $request->facility_name;
        $clientFacility->facility_code = $request->facility_code;
        $clientFacility->facility_address_1 = $request->facility_address_1;
        $clientFacility->facility_address_2 = $request->facility_address_2;
        $clientFacility->city = $request->city;
        $clientFacility->state = $request->state;
        $clientFacility->zipcode = $request->zipcode;
        $clientFacility->facility_type = $request->facility_type;
        $clientFacility->contact_person = $request->contact_person;
        $clientFacility->contact_phone = $request->contact_phone;
        $clientFacility->email = $request->email;
        $clientFacility->filename = $request->filename;
        $clientFacility->facility_departments_id = $request->facility_departments_id;
        $clientFacility->facility_locations_id = $request->facility_locations_id;
        $clientFacility->facility_types_id = $request->facility_types_id;
        $clientFacility->facility_job_classes_id = $request->facility_job_classes_id;
        $clientFacility->save();
        return Helper::success_response($clientFacility);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientFacility  $clientFacility
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clientFacility = ClientFacility::where(["id"=>$id])->get()->first();
        // exit($id);
        // return $clientFacility;
        return Helper::success_response($clientFacility);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientFacility  $clientFacility
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientFacility $clientFacility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientFacility  $clientFacility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $clientFacility = ClientFacility::where(["id"=>$id])->get()->first();
        $clientFacility->facility_name = $request->facility_name;
        $clientFacility->facility_code = $request->facility_code;
        $clientFacility->facility_address_1 = $request->facility_address_1;
        $clientFacility->facility_address_2 = $request->facility_address_2;
        $clientFacility->city = $request->city;
        $clientFacility->state = $request->state;
        $clientFacility->zipcode = $request->zipcode;
        $clientFacility->facility_type = $request->facility_type;
        $clientFacility->contact_person = $request->contact_person;
        $clientFacility->contact_phone = $request->contact_phone;
        $clientFacility->email = $request->email;
        $clientFacility->filename = $request->filename;
        $clientFacility->facility_departments_id = $request->facility_departments_id;
        $clientFacility->facility_locations_id = $request->facility_locations_id;
        $clientFacility->facility_types_id = $request->facility_types_id;
        $clientFacility->facility_job_classes_id = $request->facility_job_classes_id;
        $clientFacility->update();
        return Helper::success_response($clientFacility);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientFacility  $clientFacility
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clientFacility = ClientFacility::where(["id"=>$id])->get()->first();
        $clientFacility->delete();
        return Helper::success_response([], 'delete-success');
    }
}
