<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;
use Illuminate\Support\Facades\Storage;


class SkillController extends Controller
{
    public function index(Request $request)
    {
        return Helper::getRecords(Skill::class, $request);
    }

    public function store(Request $request)
    {
        $validation_arr = [
            "title" => "required",
            "filename" => "required",
            "discipline_id" => ["array"],
            "discipline_id.*" => "exists:disciplines,id"
        ];

        if (($check_validation = Helper::check_validation($request, $validation_arr)) != 'pass') return $check_validation;


        $skill = new Skill();
        $skill->title = $request->title;
        if ($request->has('filename')) {
            $skill->filename = Helper::addRemoveFile($request);
        }
        $skill->created_by = $skill->updated_by = auth()->user()->id;
        $skill->save();

        if ($request->has('discipline_id') && count($request->discipline_id)) {
            $skill->discipline()->attach($request->discipline_id);
        }
        return Helper::success_response();
    }

    public function show(Skill $skill)
    {
        $data = Skill::with('discipline')->whereRelation('discipline', 'skills.id', '=', $skill->id)->get()->first();
        
        return Helper::success_response(Helper::process_data($data));
    }

    public function update(Request $request, Skill $skill)
    {
        $validation_arr = [
            "discipline_id" => ["array"],
            "discipline_id.*" => "exists:disciplines,id"
        ];

        if (($check_validation = Helper::check_validation($request, $validation_arr)) != 'pass') return $check_validation;

        //assign update value
        $skill->title = $request->title;
        if ($request->has('filename')) {
            $skill->filename = Helper::addRemoveFile($request, $skill->filename);
        }
        $skill->update();

        if ($request->has('discipline_id')) {
            $skill->discipline()->detach(); //detach discipline if array present blank or filled
            if (count($request->discipline_id)) {
                $skill->discipline()->attach($request->discipline_id);
            }
        }

        return Helper::success_response();
    }

    public function destroy(Skill $skill)
    {
        if ($skill->filename) {
            Storage::delete($skill->filename);
        }
        $skill->discipline()->detach(); //leave the detach function empty
        $skill->delete();
        return Helper::success_response();
    }
}
