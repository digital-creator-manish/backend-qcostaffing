<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use Illuminate\Http\Request;
use App\Helper\Helper;
use Illuminate\Support\Facades\Storage;

class TutorialController extends Controller
{
    public function index(Request $request)
    {
        return Helper::getRecords(Tutorial::class, $request);
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
        $validation_arr = [
            "title" => "required",
            "discipline_id" => ["array"],
            "discipline_id.*" => "exists:disciplines,id"
        ];

        if (($check_validation = Helper::check_validation($request, $validation_arr)) != 'pass') return $check_validation;

        $filename = "";
        if ($request->file('filename')) {
            $filename = $request->file('filename')->store('qcostaffing/tutorial');
        }

        $tutorial = new Tutorial();
        if ($request->title) $tutorial->title = $request->title;
        if ($request->description) $tutorial->description = $request->description;
        if ($filename) $tutorial->filename = $filename;
        $tutorial->created_by = $tutorial->updated_by = auth()->user()->id;
        $tutorial->save();

        if ($request->discipline_id && count($request->discipline_id)) {
            $tutorial->discipline()->attach($request->discipline_id);
        }

        $data = Tutorial::with('created_by', 'updated_by', 'discipline')->where('tutorials.id', '=', $tutorial->id)->get()->first();
        return Helper::success_response($data);
    }

    public function show(Tutorial $tutorial)
    {
        $data = $tutorial::with('created_by', 'updated_by', 'discipline')->where('tutorials.id', '=', $tutorial->id)->get()->first();
        return Helper::success_response($data);
    }

    public function update(Request $request, Tutorial $tutorial)
    {
        $validation_arr = [
            "discipline_id" => ["array"],
            "discipline_id.*" => "exists:disciplines,id"
        ];

        if (($check_validation = Helper::check_validation($request, $validation_arr)) != 'pass') return $check_validation;

        $filename = "";
        if ($request->file('filename')) {
            Storage::delete($tutorial->filename);
            $filename = $request->file('filename')->store('qcostaffing/tutorial');
        }

        if ($request->title) $tutorial->title = $request->title;
        if ($request->description) $tutorial->description = $request->description;
        if ($filename) $tutorial->filename = $filename;
        $tutorial->created_by = $tutorial->updated_by = auth()->user()->id;
        $tutorial->update();

        if ($request->exists('discipline_id')) {
            $tutorial->discipline()->detach(); //detach discipline if array present blank or filled
            if (count($request->discipline_id)) {
                $tutorial->discipline()->attach($request->discipline_id);
            }
        } 
        $data = Tutorial::with('created_by', 'updated_by', 'discipline')->where('tutorials.id', '=', $tutorial->id)->get()->first();
        return Helper::success_response($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tutorial  $tutorial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutorial $tutorial)
    {
        $tutorial->discipline()->detach(); //leave the detach function empty
        $tutorial->delete();
        return Helper::success_response([], 'delete-success');
    }
}
