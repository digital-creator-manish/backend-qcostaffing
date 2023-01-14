<?php

namespace App\Http\Controllers;

use App\Models\QuizTutorial;
use Illuminate\Http\Request;
use App\Helper\Helper;

class QuizTutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quiztutorial = QuizTutorial::with('tutorial_id', 'created_by', 'updated_by')->get();
        return Helper::success_response($quiztutorial);
    }

    public function store(Request $request)
    {
        $validation_arr = [
            "tutorial_id" => ["required", "exists:tutorials,id"],
            "q" => "required",
            "q1" => "required",
            "q2" => "required",
            "q3" => "required",
            "q4" => "required",
            "ans" => "required"
        ];

        if (($check_validation = Helper::check_validation($request, $validation_arr)) != 'pass') return $check_validation;

        $quiztutorial = new QuizTutorial();

        if ($request->tutorial_id) $quiztutorial->tutorial_id = $request->tutorial_id;
        if ($request->q) $quiztutorial->q = $request->q;
        if ($request->q1) $quiztutorial->q1 = $request->q1;
        if ($request->q2) $quiztutorial->q2 = $request->q2;
        if ($request->q3) $quiztutorial->q3 = $request->q3;
        if ($request->q4) $quiztutorial->q4 = $request->q4;
        if ($request->ans) $quiztutorial->ans = $request->ans;
        $quiztutorial->created_by = $quiztutorial->updated_by = auth()->user()->id;

        $quiztutorial->save();
        $data = QuizTutorial::with('tutorial_id', 'created_by', 'updated_by')->where('quiz_tutorials.id', '=', $quiztutorial->id)->get()->first();
        return Helper::success_response($data);
    }

    public function show(QuizTutorial $quizTutorial)
    {
        $data = QuizTutorial::with('tutorial_id', 'created_by', 'updated_by')->where('quiz_tutorials.id', '=', $quizTutorial->id)->get()->first();
        return Helper::success_response($data);
    }

    public function update(Request $request, QuizTutorial $quizTutorial)
    {
        $validation_arr = [
            "tutorial_id" => ["exists:tutorials,id"]
        ];

        if (($check_validation = Helper::check_validation($request, $validation_arr)) != 'pass') return $check_validation;

        if ($request->tutorial_id) $quizTutorial->tutorial_id = $request->tutorial_id;
        if ($request->q) $quizTutorial->q = $request->q;
        if ($request->q1) $quizTutorial->q1 = $request->q1;
        if ($request->q2) $quizTutorial->q2 = $request->q2;
        if ($request->q3) $quizTutorial->q3 = $request->q3;
        if ($request->q4) $quizTutorial->q4 = $request->q4;
        if ($request->ans) $quizTutorial->ans = $request->ans;
        $quizTutorial->updated_by = auth()->user()->id;

        $quizTutorial->update();
        $data = QuizTutorial::with('tutorial_id', 'created_by', 'updated_by')->where('quiz_tutorials.id', '=', $quizTutorial->id)->get()->first();
        return Helper::success_response($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuizTutorial  $quizTutorial
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizTutorial $quizTutorial)
    {
        $quizTutorial->delete();
        return Helper::success_response([], 'delete-success');
    }
}
