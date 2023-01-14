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
    public function index()
    {
        return Skill::with('discipline')->get();
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

        $document = "";
        if ($request->file('document')) {
            $document = $request->file('document')->store('qcostaffing/skill');
        }

        $skill = new Skill();
        $skill->title = $request->title;
        if ($document) $skill->document = $document;

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

        $document = "";
        if ($request->file("document")) {
            Storage::delete($skill->document);
            $document = $request->file('document')->store('qcostaffing/skill');
        }

        if ($request->title) $skill->title = $request->title;
        if ($document) $skill->document = $document;

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
        $skill->discipline()->detach(); //leave the detach function empty
        $skill->delete();
    }
}
