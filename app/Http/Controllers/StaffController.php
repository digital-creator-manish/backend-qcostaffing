<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::all();
        return response(['success' => 1, 'message' => 'read all success', 'data' => $staff], 200);
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
        $validated = $request->validated();
        $Staff = Staff::create($validated);
        return response(['success' => 1, 'message' => 'Staff create success', 'site_content' => $Staff], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $Staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        return response()->json(['success' => 1, 'message' => 'read success', 'data' => $staff], 200);
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
        $staff->update($request->all());
        return response(['success' => 1, 'message' => 'update success', 'data' => $staff], 200);
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
        return response(['success' => 1, 'message' => 'delete success']);
    }
}
