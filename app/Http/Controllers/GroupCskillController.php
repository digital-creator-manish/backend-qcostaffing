<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\GroupCskill;
use Illuminate\Http\Request;

class GroupCskillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupCskill = GroupCskill::all();
        return Helper::success_response($groupCskill);
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
        $groupCskill = new GroupCskill();
        $groupCskill->name = $request->name;
        $groupCskill->cskill_id = $request->cskill_id;
        $groupCskill->save();
        return Helper::success_response($groupCskill);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupCskill  $groupCskill
     * @return \Illuminate\Http\Response
     */
    public function show(GroupCskill $groupCskill)
    {
        return Helper::success_response($groupCskill);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupCskill  $groupCskill
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupCskill $groupCskill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupCskill  $groupCskill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupCskill $groupCskill)
    {
        // $groupCskill = new GroupCskill();
        $groupCskill->name = $request->name;
        $groupCskill->cskill_id = $request->cskill_id;
        $groupCskill->update();
        return Helper::success_response($groupCskill);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupCskill  $groupCskill
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupCskill $groupCskill)
    {
        $groupCskill->delete();
        return Helper::success_response([], 'delete-success');

    }
}
