<?php

namespace App\Http\Controllers;

use App\Models\SiteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;

class SiteContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        return Helper::getRecords(SiteContent::class, $request);
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
        $validation_arr = ["name" => "required", 'title' => 'required', "description" => "required"];
        if (($check_validation = Helper::check_validation($request, $validation_arr)) != 'pass') return $check_validation;

        $sitecontent = new SiteContent();
        if ($request->name) $sitecontent->name = $request->name;
        if ($request->title) $sitecontent->title = $request->title;
        if ($request->description) $sitecontent->description = $request->description;
        $sitecontent->created_by = $sitecontent->updated_by = auth()->user()->id;
        $sitecontent->save();

        $data = SiteContent::with('created_by', 'updated_by')->where('site_contents.id', '=', $sitecontent->id)->get()->first();
        return Helper::success_response($data);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiteContent  $siteContent
     * @return \Illuminate\Http\Response
     */
    public function show(SiteContent $sitecontent)
    {
        $data = SiteContent::with('created_by', 'updated_by')->where('site_contents.id', '=', $sitecontent->id)->get()->first();
        return Helper::success_response($data);
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
    public function update(Request $request, SiteContent $sitecontent)
    {
        if ($request->name) $sitecontent->name = $request->name;
        if ($request->title) $sitecontent->title = $request->title;
        if ($request->description) $sitecontent->description = $request->description;
        $sitecontent->created_by = $sitecontent->updated_by = auth()->user()->id;
        $sitecontent->update();

        $data = SiteContent::with('created_by', 'updated_by')->where('site_contents.id', '=', $sitecontent->id)->get()->first();
        return Helper::success_response($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiteContent  $siteContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteContent $sitecontent)
    {
        $sitecontent->delete();
        return Helper::success_response($sitecontent, 'delete-success');
    }
}
