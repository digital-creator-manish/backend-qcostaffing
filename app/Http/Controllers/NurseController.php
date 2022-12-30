<?php

namespace App\Http\Controllers;

use App\Models\NurseData;
use Illuminate\Http\Request;

class NurseController extends Controller
{
    public function create(Request $request)
    {
        $nurse = new NurseData();
        $nurse->lname = $request->lname;
        $nurse->fname = $request->fname;
        $nurse->save();

        return response()->json($nurse);
    }

    public function get($id)
    {
        $nurse = NurseData::find($id);

        return response()->json($nurse);
    }

    public function getAll()
    {
        $nursedata = NurseData::all();

        return response()->json($nursedata);
    }
}
