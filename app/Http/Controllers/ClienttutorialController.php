<?php

namespace App\Http\Controllers;

use App\Models\Clienttutorial;
use Illuminate\Http\Request;
use App\Helper\Helper;

class ClienttutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return Helper::getRecords(Clienttutorial::class, $request);
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
        $clienttutorial = new Clienttutorial();
        $clienttutorial->title = $request->title;
        $clienttutorial->description = $request->description;
        $clienttutorial->facility = $request->facility;
        $clienttutorial->save();
        return Helper::success_response($clienttutorial);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clienttutorial  $clienttutorial
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $clienttutorial = Clienttutorial::where(["id"=>$id])->get()->first();
        // exit($id);
        // return $clientFacility;
        return Helper::success_response($clienttutorial);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clienttutorial  $clienttutorial
     * @return \Illuminate\Http\Response
     */
    public function edit(Clienttutorial $clienttutorial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clienttutorial  $clienttutorial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $clienttutorial = Clienttutorial::where(["id"=>$id])->get()->first();
        $clienttutorial->title = $request->title;
        $clienttutorial->description = $request->description;
        $clienttutorial->facility = $request->facility;
        $clienttutorial->update();
        return Helper::success_response(Helper::process_data($clienttutorial));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clienttutorial  $clienttutorial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clienttutorial = Clienttutorial::where(["id"=>$id])->get()->first();
        $clienttutorial->delete();
        return Helper::success_response([], 'delete-success');
    }
}
