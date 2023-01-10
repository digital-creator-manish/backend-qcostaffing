<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Staff = Staff::all();
        if ($Staff->first() == NULL) {
            return response(['success' => 0, 'message' => 'record not found'], 422);
        }
        return response(['success' => 1, 'message' => 'read all success', 'data' => $Staff], 200);
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
        //
        $validator = Validator::make($request->all(), ['title' => 'required', "description" => "required"]);
        if ($validator->fails()) {
            return response(['success' => 0, 'message' => implode($validator->messages()->all())], 422);
        }
        $Staff = Staff::create($request->all());
        return response(['success' => 1, 'message' => 'Staff create success', 'site_content' => $Staff], 422);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $Staff
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $Staff = Staff::find(["id" => $id])->first();
        if ($Staff == NULL) {
            return response(['success' => 0, 'message' => 'record not found'], 422);
        }
        return response(['success' => 1, 'message' => 'read success', 'data' => $Staff], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $Staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $Staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $Staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $Staff = Staff::find(["id" => $id])->first();
        if ($Staff == NULL) {
            return response(['success' => 0, 'message' => 'update fail, record not found']);
        }
        $Staff->update($request->all());
        return response(['success' => 1, 'message' => 'update success', 'data' => $Staff], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $Staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Staff = Staff::find(["id" => $id])->first();
        if ($Staff == NULL) {
            return response(['success' => 0, 'message' => 'delete fail, record not found']);
        }
        Staff::destroy($id);
        return response(['success' => 1, 'message' => 'delete success']);
    }

    public function upload(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                // 'user_id' => 'required',
                // 'file' => 'required|mimes:doc,docx,pdf,txt|max:2048',
                'file' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }


        if ($files = $request->file('file')) {

            //store file into document folder
            $file = $request->file('file')->store('apiDoc');

            //store your file into database
            // $document = new Document();
            // $document->title = $file;
            // $document->user_id = $request->user_id;
            // $document->save();

            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $file
            ]);
        }
    }
}
