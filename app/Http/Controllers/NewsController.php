<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Helper::getRecords(News::class, $request);
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
        $check_validation = Helper::check_validation($request, ["title" => "required", "show" => "in:Y,N", "uploaded_date"=>"date"]);
        if ($check_validation != 'pass') return $check_validation;

        $filename = "";
        if ($request->file('filename')) {
            $filename = $request->file('filename')->store('qcostaffing/news');
        }

        $news = new News();
        if ($request->title) $news->title = $request->title;
        if ($request->description) $news->description = $request->description;
        if ($request->show) $news->show = $request->show;
        if ($request->uploaded_by) $news->uploaded_by = $request->uploaded_by;
        if ($request->uploaded_date) $news->uploaded_date = $request->uploaded_date;
        if ($filename) $news->filename = $filename;
        $news->created_by = $news->updated_by = auth()->user()->id;

        $news->save();
        $data = News::with('created_by', 'updated_by')->where('news.id', '=', $news->id)->get()->first();
        return Helper::success_response($data);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        $data = News::with('created_by', 'updated_by')->where('news.id', '=', $news->id)->get()->first();
        return Helper::success_response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $check_validation = Helper::check_validation($request, ["show" => "in:Y,N", "uploaded_date"=>"date"]);
        if ($check_validation != 'pass') return $check_validation;
        
        $filename = "";
        if ($request->file('filename')) {
            Storage::delete($news->filename);
            $filename = $request->file('filename')->store('qcostaffing/news');
        }

        if ($request->title) $news->title = $request->title;
        if ($request->description) $news->description = $request->description;
        if ($request->show) $news->show = $request->show;
        if ($request->uploaded_by) $news->uploaded_by = $request->uploaded_by;
        if ($request->uploaded_date) $news->uploaded_date = $request->uploaded_date;
        if ($filename) $news->filename = $filename;
        $news->updated_by = auth()->user()->id;
        $news->update();

        $data = News::with('created_by', 'updated_by')->where('news.id', '=', $news->id)->get()->first();
        return Helper::success_response($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        if($news->filename) Storage::delete($news->filename);
        $news->delete();
        return Helper::success_response($news, 'delete-success');
    }
}
