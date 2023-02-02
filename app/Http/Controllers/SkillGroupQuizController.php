<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\SkillGroupQuiz;
use Illuminate\Http\Request;

class SkillGroupQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skillGroupQuiz = SkillGroupQuiz::all();
        return Helper::success_response($skillGroupQuiz);
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
        $skillGroupQuiz = new SkillGroupQuiz();
        $skillGroupQuiz->group_id = $request->group_id;
        $skillGroupQuiz->question = $request->question;
        $skillGroupQuiz->save();
        return Helper::success_response($skillGroupQuiz);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SkillGroupQuiz  $skillGroupQuiz
     * @return \Illuminate\Http\Response
     */
    public function show(SkillGroupQuiz $skillGroupQuiz, $id)
    {
        // exit("hi-world");
        $skillGroupQuiz = SkillGroupQuiz::where(["id" => $id])->get()->first();
        return Helper::success_response($skillGroupQuiz);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SkillGroupQuiz  $skillGroupQuiz
     * @return \Illuminate\Http\Response
     */
    public function edit(SkillGroupQuiz $skillGroupQuiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SkillGroupQuiz  $skillGroupQuiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SkillGroupQuiz $skillGroupQuiz, $id)
    {
        $skillGroupQuiz = SkillGroupQuiz::where(["id" => $id])->get()->first();
        // return Helper::success_response($skillGroupQuiz);

        $skillGroupQuiz->group_id = $request->group_id;
        $skillGroupQuiz->question = $request->question;
        $skillGroupQuiz->update();
        return Helper::success_response($skillGroupQuiz);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SkillGroupQuiz  $skillGroupQuiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(SkillGroupQuiz $skillGroupQuiz, $id)
    {
        $skillGroupQuiz = SkillGroupQuiz::where(["id" => $id])->get()->first();

        $skillGroupQuiz->delete();
        return Helper::success_response([], 'delete-success');

    }
}
