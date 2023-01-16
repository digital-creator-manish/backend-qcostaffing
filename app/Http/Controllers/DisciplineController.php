<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;

class DisciplineController extends Controller
{
    public function index(Request $request)
    {
        $discipline = Helper::getRecords(Discipline::class, $request);
        return Helper::success_response($discipline);
    }

    public function store(Request $request)
    {
        $validation_arr = ["name" => "required"];
        if (($check_validation = Helper::check_validation($request, $validation_arr)) != 'pass') return $check_validation;

        $discipline = new Discipline();
        if ($request->name) $discipline->name = $request->name;
        $discipline->save();
        return Helper::success_response($discipline);
    }


    public function show(Discipline $discipline)
    {
        return Helper::success_response($discipline);
    }

    public function update(Request $request, Discipline $discipline)
    {
        if ($request->name) $discipline->name = $request->name;
        $discipline->update();
        return Helper::success_response($discipline);
    }

    public function destroy(Discipline $discipline)
    {
        $discipline->delete();
        return Helper::success_response([], 'delete-success');
    }
}
