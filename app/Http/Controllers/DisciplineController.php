<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DisciplineController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), ["name" => "required"]);
        if ($validator->fails()) {
            return response(['success' => 0, 'message' => implode($validator->messages()->all())], 422);
        }
        $discipline = Discipline::create(["name" => $request->name]);
        return response(['success' => 1, 'message' => 'discipline created successfully', 'data' => $discipline], 200);
    }

    public function read($id = null)
    {
        if ($id) {
            $discipline = Discipline::find(["id" => $id]);
        } else {
            $discipline = Discipline::all();
        }
        return response(['success' => 1, 'message' => 'discipline read success', 'data' => $discipline], 200);
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