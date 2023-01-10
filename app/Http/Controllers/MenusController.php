<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use App\Http\Requests\StoreMenusRequest;
use App\Http\Requests\UpdateMenusRequest;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataArr = Menus::all()->sortBy("priority");
        if($dataArr->first() == NULL)
        {
            return response(['success' => 0, 'message' => 'record not found'], 422);
        }
        return response(['success' => 1, 'message' => 'read all success', 'data' => $dataArr], 200);
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
     * @param  \App\Http\Requests\StoreMenusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function show(Menus $menus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function edit(Menus $menus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenusRequest  $request
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenusRequest $request, Menus $menus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menus $menus)
    {
        //
    }
}
