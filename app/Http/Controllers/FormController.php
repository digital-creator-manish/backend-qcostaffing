<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use App\Helper\Helper;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    public function index(Request $request)
    {
        return Helper::getRecords(Form::class, $request);
    }

    public function store(Request $request)
    {
        $validation_arr = [
            "title" => "required",
            "form_type_id" => ["required", "exists:form_types,id"],
            "discipline_id" => ["array"],
            "discipline_id.*" => "exists:disciplines,id"
        ];

        if (($check_validation = Helper::check_validation($request, $validation_arr)) != 'pass') return $check_validation;

        // $filename = "";
        // if ($request->file('filename')) {
        //     $filename = $request->file('filename')->store('qcostaffing/form');
        // }

        $form = new Form();
        if ($request->title) $form->title = $request->title;
        if ($request->form_type_id) $form->form_type_id = $request->form_type_id;
        if ($request->has('filename')) {
            $form->filename = Helper::addRemoveFile($request);
        }

        $form->created_by = $form->updated_by = auth()->user()->id;
        $form->save();

        if ($request->discipline_id && count($request->discipline_id)) {
            $form->discipline()->attach($request->discipline_id);
        }
        $data = Form::with('form_type_id', 'created_by', 'updated_by', 'discipline')->where('forms.id', '=', $form->id)->get()->first();
        return Helper::success_response($data);
    }

    public function show(Form $form)
    {
        $data = $form::with('form_type_id', 'created_by', 'updated_by', 'discipline')->where('forms.id', '=', $form->id)->get()->first();
        return Helper::success_response($data);
    }

    public function update(Request $request, Form $form)
    {
        $validation_arr = [
            "discipline_id" => ["array"],
            "discipline_id.*" => "exists:disciplines,id"
        ];

        if (($check_validation = Helper::check_validation($request, $validation_arr)) != 'pass') return $check_validation;

        // if ($request->file('filename')) {
        //     Storage::delete($form->filename);
        //     $filename = $request->file('filename')->store('qcostaffing/form');
        // }

        if ($request->title) $form->title = $request->title;
        if ($request->form_type_id) $form->form_type_id = $request->form_type_id;
        if ($request->has('filename')) {
            // exit("hi");
            $form->filename = Helper::addRemoveFile($request);
        }
        $form->updated_by = auth()->user()->id;
        $form->update();

        if ($request->exists('discipline_id')) {
            $form->discipline()->detach(); //detach discipline if array present blank or filled
            if (count($request->discipline_id) && $request->discipline_id[0]) {
                $form->discipline()->attach($request->discipline_id);
            }
        } 
        return Helper::success_response(Helper::process_data($form));
    }

    public function destroy(Form $form)
    {
        if($form->filename) Storage::delete($form->filename);
        $form->discipline()->detach(); //leave the detach function empty
        $form->delete();
        return Helper::success_response($form, 'delete-success');
    }
}
