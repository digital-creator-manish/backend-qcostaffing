<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\cskill;
use Illuminate\Http\Request;

class CskillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cskill = cskill::all();
        return Helper::success_response($cskill);

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
        $cskill = new cskill();
        $cskill->title = $request->title;
        $cskill->description = $request->description;
        $cskill->created_by = auth()->user()->id;
        $cskill->save();
        return Helper::success_response($cskill);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cskill  $cskill
     * @return \Illuminate\Http\Response
     */
    public function show(cskill $cskill)
    {
        return Helper::success_response($cskill);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cskill  $cskill
     * @return \Illuminate\Http\Response
     */
    public function edit(cskill $cskill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cskill  $cskill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cskill $cskill)
    {
        $cskill->title = $request->title;
        $cskill->description = $request->description;
        // $cskill->created_by = auth()->user()->id;
        $cskill->update();
        return Helper::success_response($cskill);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cskill  $cskill
     * @return \Illuminate\Http\Response
     */
    public function destroy(cskill $cskill)
    {
        $cskill->delete();
        return Helper::success_response([], 'delete-success');
    }
}
