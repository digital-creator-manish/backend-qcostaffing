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
        // return Helper::getRecords(ClientFacility::class, $request);
        $clientFacility = ClientFacility::with('department', 'job', 'location', 'ftype')->get();
        return Helper::success_response($clientFacility);
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

        if ($request->has('filename')) {
            // $clientFacility->filename = $request->filename;
            $clientFacility->filename = Helper::addRemoveFile($request);
        }
        
        // $clientFacility->facility_departments_id = $request->facility_departments_id;
        // $clientFacility->facility_locations_id = $request->facility_locations_id;
        // $clientFacility->facility_types_id = $request->facility_types_id;
        // $clientFacility->facility_job_classes_id = $request->facility_job_classes_id;
        // exit("hi-world");
        $clientFacility->save();
        // exit(var_dump($clientFacility->id));
        if ($request->has('department_id') && count($request->department_id)) {
            $clientFacility->department()->attach($request->department_id);
        }

        if ($request->has('job_id') && count($request->job_id)) {
            $clientFacility->job()->attach($request->job_id);
        }

        if ($request->has('location_id') && count($request->location_id)) {
            $clientFacility->location()->attach($request->location_id);
        }

        if ($request->has('ftype_id') && count($request->ftype_id)) {
            $clientFacility->ftype()->attach($request->ftype_id);
        }

        
        $clientFacility = ClientFacility::with('department', 'job', 'location', 'ftype')->where(["client_facilities.id"=>$clientFacility->id])->get()->first();
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
        $clientFacility = ClientFacility::with('department', 'job', 'location', 'ftype')->where(["id"=>$id])->get()->first();
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

        if ($request->has('filename')) {
            $clientFacility->filename = Helper::addRemoveFile($request, $clientFacility->filename);
        }

        // $clientFacility->filename = $request->filename;
//        $clientFacility->facility_departments_id = $request->facility_departments_id;
//        $clientFacility->facility_locations_id = $request->facility_locations_id;
//        $clientFacility->facility_types_id = $request->facility_types_id;
//        $clientFacility->facility_job_classes_id = $request->facility_job_classes_id;
        $clientFacility->update();
        
        if ($request->has('department_id')) {
            $clientFacility->department()->detach(); //detach discipline if array present blank or filled
            if (count($request->department_id)) {
                $clientFacility->department()->attach($request->department_id);
            }
        }

        if ($request->has('job_id')) {
            $clientFacility->job()->detach(); //detach discipline if array present blank or filled
            if (count($request->job_id)) {
                $clientFacility->department()->attach($request->job_id);
            }
        }

        if ($request->has('location_id')) {
            $clientFacility->location()->detach(); //detach discipline if array present blank or filled
            if (count($request->location_id)) {
                $clientFacility->department()->attach($request->location_id);
            }
        }

        if ($request->has('ftype_id')) {
            $clientFacility->ftype()->detach(); //detach discipline if array present blank or filled
            if (count($request->ftype_id)) {
                $clientFacility->department()->attach($request->ftype_id);
            }
        }

        $clientFacility = ClientFacility::with('department', 'job', 'location', 'ftype')->where(["client_facilities.id"=>$clientFacility->id])->get()->first();
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
