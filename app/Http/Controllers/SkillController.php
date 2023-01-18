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
            "document" => "required",
            "discipline_id" => ["array"],
            "discipline_id.*" => "exists:disciplines,id"
        ];

        if (($check_validation = Helper::check_validation($request, $validation_arr)) != 'pass') return $check_validation;

        $filename = "";
        if ($request->file('filename')) {
            $filename = $request->file('filename')->store('qcostaffing/skill');
        }

        $skill = new Skill();
        $skill->title = $request->title;
        if ($filename) $skill->filename = $filename;
        $skill->created_by = $skill->updated_by = auth()->user()->id;

        $skill->save();

        if ($request->discipline_id && count($request->discipline_id)) {
            $skill->discipline()->attach($request->discipline_id);
            return Skill::with('discipline')->whereRelation('discipline', 'skills.id', '=', $skill->id)->get()->first();
        }
        return $skill;
    }

    public function show(Skill $skill)
    {
        return Skill::with('discipline')->whereRelation('discipline', 'skills.id', '=', $skill->id)->get()->first();
    }

    public function update(Request $request, Skill $skill)
    {
        $validation_arr = [
            "discipline_id" => ["array"],
            "discipline_id.*" => "exists:disciplines,id"
        ];

        if (($check_validation = Helper::check_validation($request, $validation_arr)) != 'pass') return $check_validation;

        $filename = "";
        if ($request->has('filename')) {
            Storage::delete($skill->filename);
        }
        if ($request->file('filename')) {
            $filename = $request->file('filename')->store('qcostaffing/skill');
        }
        if ($request->title) $skill->title = $request->title;
        if ($filename) $skill->filename = $filename;

        $skill->update();
        if ($request->discipline_id && count($request->discipline_id)) {
            $skill->discipline()->detach();
            $skill->discipline()->attach($request->discipline_id);
            return Skill::with('discipline')->whereRelation('discipline', 'skills.id', '=', $skill->id)->get()->first();
        }
        return $skill;
    }

    public function destroy(Skill $skill)
    {
        if ($skill->filename) {
            Storage::delete($skill->filename);
        }
        $skill->discipline()->detach(); //leave the detach function empty
        $skill->delete();
    }
}
