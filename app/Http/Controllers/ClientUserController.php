<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\ClientUser;
use Illuminate\Http\Request;

class ClientUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientFacility = ClientUser::all();
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
        $client_user = new ClientUser();
        $client_user->first_name = $request->first_name;
        $client_user->last_name = $request->last_name;
        $client_user->user_id = $request->user_id;
        $client_user->password = $request->password;
        $client_user->email = $request->email;
        $client_user->facility_id = $request->facility_id;
        $client_user->department_id = $request->department_id;
        $client_user->location_id = $request->location_id;
        $client_user->job_id = $request->job_id;
        $client_user->ftype_id = $request->ftype_id;
        $client_user->created_by = auth()->user()->id;
        $client_user->save();

        // $client_user = ClientFacility::with('department', 'job', 'location', 'ftype')->where(["client_facilities.id"=>$clientFacility->id])->get()->first();
        return Helper::success_response($client_user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientUser  $clientUser
     * @return \Illuminate\Http\Response
     */
    public function show(ClientUser $clientUser)
    {
        return Helper::success_response($clientUser);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientUser  $clientUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientUser $clientUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientUser  $clientUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientUser $client_user)
    {
        // $client_user = new ClientUser();
        $client_user->first_name = $request->first_name;
        $client_user->last_name = $request->last_name;
        $client_user->user_id = $request->user_id;
        $client_user->password = $request->password;
        $client_user->email = $request->email;
        $client_user->facility_id = $request->facility_id;
        $client_user->department_id = $request->department_id;
        $client_user->location_id = $request->location_id;
        $client_user->job_id = $request->job_id;
        $client_user->ftype_id = $request->ftype_id;
        // $client_user->created_by = auth()->user()->id;
        $client_user->update();

        // $client_user = ClientFacility::with('department', 'job', 'location', 'ftype')->where(["client_facilities.id"=>$clientFacility->id])->get()->first();
        return Helper::success_response($client_user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientUser  $clientUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientUser $clientUser)
    {
        // $clientFacility = ClientUser::where(["id"=>$id])->get()->first();
        $clientUser->delete();
        return Helper::success_response([], 'delete-success');
    }
}
