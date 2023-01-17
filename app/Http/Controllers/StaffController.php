<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Helper\Helper;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Helper::getRecords(Staff::class, $request);
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
    public function store(StaffRequest $request)
    {
        $validation_arr = ["title" => "required", "description"=>"required"];
        if (($check_validation = Helper::check_validation($request, $validation_arr)) != 'pass') return $check_validation;

        $staff = new Staff();
        if ($request->title) $staff->title = $request->title;
        if ($request->description) $staff->description = $request->description;
        $staff->save();
        return Helper::success_response($staff);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $Staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        return Helper::success_response($staff);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $Staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $Staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $Staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        if ($request->title) $staff->title = $request->title;
        if ($request->description) $staff->description = $request->description;
        $staff->update();
        return Helper::success_response($staff);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $Staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return Helper::success_response([], 'delete-success');
    }
}
