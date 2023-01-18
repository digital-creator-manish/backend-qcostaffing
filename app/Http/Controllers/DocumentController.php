<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Helper\Helper;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        return Helper::getRecords(Document::class, $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validation_arr = [
            "filename" => "required",
            "discipline_id" => ["array"],
            "discipline_id.*" => "exists:disciplines,id"
        ];

        if (($check_validation = Helper::check_validation($request, $validation_arr)) != 'pass') {
            return $check_validation;
        }

        $filename = "";
        if ($request->file('filename')) {
            $filename = $request->file('filename')->store('qcostaffing/document');
        }

        $document = new Document();

        if ($request->document_type_id) {
            $document->document_type_id = $request->document_type_id;
        }
        if ($filename) {
            $document->filename = $filename;
        }

        $document->created_by = auth()->user()->id;
        $document->save();

        if ($request->discipline_id && count($request->discipline_id)) {
            $document->discipline()->attach($request->discipline_id);
            return Document::with('created_by', 'discipline')->whereRelation('discipline', 'documents.id', '=', $document->id)->get()->first();
        }
        return $document;

        // $data = Document::with('discipline', 'created_by')->where('documents.id', '=', $document->id)->get()->first();
        // return Helper::success_response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document) {
        $data = $document::with('created_by', 'discipline')->where('documents.id', '=', $document->id)->get()->first();
        return Helper::success_response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document) {
//                $check_validation = Helper::check_validation($request, ["show" => "in:Y,N", "uploaded_date" => "date|nullable"]);
//
//        if ($check_validation != 'pass') {
//            return $check_validation;
//        }
//           exit("1");
//        return $request;
        $filename = "";
        if ($request->has('filename')) {
//            exit("1");
            Storage::delete($document->filename);
        }
        if ($request->file('filename')) {
            $filename = $request->file('filename')->store('qcostaffing/document');
        }
        
        
//        $document->updated_by = auth()->user()->id;
        $document->filename = $filename;
        $document->update();
        if($request->has('discipline_id')){
            $document->discipline()->detach();
        }
        if ($request->discipline_id && count($request->discipline_id)) {
            $document->discipline()->attach($request->discipline_id);
            return Document::with('created_by', 'discipline')->whereRelation('discipline', 'documents.id', '=', $document->id)->get()->first();
        }
        return $document::with('created_by')->get()->first();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document) {
        $document->delete();
        return Helper::success_response([], 'delete-success');
    }

}
