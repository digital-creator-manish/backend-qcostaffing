<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;

class DisciplineController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ["name" => "required"]);
        if ($validator->fails()) {
            return response(['success' => 0, 'message' => implode($validator->messages()->all())], 422);
        }
        $discipline = Discipline::create(["name" => $request->name]);
        return response(['success' => 1, 'message' => 'discipline created successfully', 'data' => $discipline], 200);
    }

    public function index(Request $request)
    {
        $discipline = Helper::getRecords(Discipline::class, $request);
        return Helper::success_response($discipline);
    }

    public function show(Discipline $discipline)
    {
        // exit($discipline);
        return Helper::success_response($discipline);
    }

    public function update(Request $request, $id)
    {
        $discipline = Discipline::find(["id" => $id])->first();
        if ($discipline == NULL) {
            return response(['success' => 0, 'message' => 'record update fail, record not found']);
        }
        $discipline->update($request->all());
        return response(['success' => 1, 'message' => 'record update success', 'data' => $discipline], 200);
    }

    public function delete($id)
    {
        $discipline = Discipline::find(["id" => $id])->first();
        if ($discipline == NULL) {
            return response(['success' => 0, 'message' => 'delete fail, record not found']);
        }
        Discipline::destroy($id);
        return response(['success' => 1, 'message' => 'delete success']);
    }
}
