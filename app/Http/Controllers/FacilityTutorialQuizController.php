<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\FacilityTutorialQuiz;
use Illuminate\Http\Request;

class FacilityTutorialQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilityTutorialQuiz = FacilityTutorialQuiz::selectRaw("*, 
        CASE
        WHEN answer = 'opt1' THEN opt1
        WHEN answer = 'opt2' THEN opt2
        WHEN answer = 'opt3' THEN opt3
        WHEN answer = 'opt4' THEN opt4
        END as answer
        " )->get();
        return Helper::success_response($facilityTutorialQuiz);
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
        $FacilityTutorialQuiz = new FacilityTutorialQuiz();
        $FacilityTutorialQuiz->facility_tutorial_id = $request->facility_tutorial_id;
        $FacilityTutorialQuiz->question = $request->question;
        $FacilityTutorialQuiz->opt1 = $request->opt1;
        $FacilityTutorialQuiz->opt2 = $request->opt2;
        $FacilityTutorialQuiz->opt3 = $request->opt3;
        $FacilityTutorialQuiz->opt4 = $request->opt4;
        $FacilityTutorialQuiz->answer = $request->answer;
        $FacilityTutorialQuiz->created_by = auth()->user()->id;

        $FacilityTutorialQuiz->save();
        return Helper::success_response($FacilityTutorialQuiz);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FacilityTutorialQuiz  $facilityTutorialQuiz
     * @return \Illuminate\Http\Response
     */
    public function show(FacilityTutorialQuiz $facilityTutorialQuiz)
    {

        $facilityTutorialQuiz = FacilityTutorialQuiz::selectRaw("*, 
        CASE
        WHEN answer = 'opt1' THEN opt1
        WHEN answer = 'opt2' THEN opt2
        WHEN answer = 'opt3' THEN opt3
        WHEN answer = 'opt4' THEN opt4
        END as answer
        " )->where(["id"=>$facilityTutorialQuiz->id])->get()->first();
        return Helper::success_response($facilityTutorialQuiz);
        // return Helper::success_response($facilityTutorialQuiz);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacilityTutorialQuiz  $facilityTutorialQuiz
     * @return \Illuminate\Http\Response
     */
    public function edit(FacilityTutorialQuiz $facilityTutorialQuiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacilityTutorialQuiz  $facilityTutorialQuiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacilityTutorialQuiz $FacilityTutorialQuiz)
    {
        $FacilityTutorialQuiz->facility_tutorial_id = $request->facility_tutorial_id;
        $FacilityTutorialQuiz->question = $request->question;
        $FacilityTutorialQuiz->opt1 = $request->opt1;
        $FacilityTutorialQuiz->opt2 = $request->opt2;
        $FacilityTutorialQuiz->opt3 = $request->opt3;
        $FacilityTutorialQuiz->opt4 = $request->opt4;
        $FacilityTutorialQuiz->answer = $request->answer;

        $FacilityTutorialQuiz->update();
        return Helper::success_response($FacilityTutorialQuiz);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacilityTutorialQuiz  $facilityTutorialQuiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacilityTutorialQuiz $facilityTutorialQuiz)
    {
        $facilityTutorialQuiz->delete();
        return Helper::success_response([], 'delete-success');
    }
}
