<?php

namespace App\Http\Controllers;

use App\Models\SiteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $SiteContent = SiteContent::all();
        if($SiteContent->first() == NULL)
        {
            return response(['success' => 0, 'message' => 'record not found'], 422);
        }
        return response(['success' => 1, 'message' => 'read all success', 'data' => $SiteContent], 200);
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
        //
        $validator = Validator::make($request->all(), ["name" => "required", 'title' => 'required', "description" => "required"]);
        if ($validator->fails()) {
            return response(['success' => 0, 'message' => implode($validator->messages()->all())], 422);
        }
        $SiteContent = SiteContent::create($request->all());
        return response(['success' => 1, 'message' => 'SiteContent create success', 'site_content' => $SiteContent], 422);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiteContent  $siteContent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $SiteContent = SiteContent::find(["id"=>$id])->first();
        if($SiteContent == NULL){
            return response(['success' => 0, 'message' => 'record not found'], 422);
        }
        return response(['success' => 1, 'message' => 'read success', 'data' => $SiteContent], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiteContent  $siteContent
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteContent $siteContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SiteContent  $siteContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $SiteContent = SiteContent::find(["id" => $id])->first();
        if ($SiteContent == NULL) {
            return response(['success' => 0, 'message' => 'update fail, record not found']);
        }
        $SiteContent->update($request->all());
        return response(['success' => 1, 'message' => 'update success', 'data' => $SiteContent], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiteContent  $siteContent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $SiteContent = SiteContent::find(["id" => $id])->first();
        if ($SiteContent == NULL) {
            return response(['success' => 0, 'message' => 'delete fail, record not found']);
        }
        SiteContent::destroy($id);
        return response(['success' => 1, 'message' => 'delete success']);
    }
}
