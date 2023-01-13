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
    public function index()
    {
        $news = News::with('User')->get();
        return $news;
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
        $check_validation = Helper::check_validation($request, ["title" => "required", "show" => "in:Y,N"]);
        if ($check_validation != 'pass') return $check_validation;

        $filename = "";
        if ($request->file('filename')) {
            $filename = $request->file('filename')->store('qcostaffing/news');
        }

        // exit(var_dump($filename));
        $news = new News();
        $news->title = $request->title;
        $news->description = $request->description;
        if ($request->show) {
            $news->show = $request->show;
        }
        if ($filename) {
            $news->filename = $filename;
        }
        $news->created_by = auth()->user()->id;
        $news->save();

        return Helper::success_response($news);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (($news_with_user = News::with('User')->find(["id" => $id])->first()) == NULL) throw new ModelNotFoundException();

        return Helper::success_response($news_with_user);
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
    public function update(Request $request, $id)
    {
        if (($news = News::find(["id" => $id])->first()) == NULL) throw new ModelNotFoundException();

        $check_validation = Helper::check_validation($request, ["title" => "required", "show" => "in:Y,N"]);
        if ($check_validation != 'pass') return $check_validation;

        $filename = "";
        if ($request->file('filename')) {
            Storage::delete($news->filename);
            $filename = $request->file('filename')->store('qcostaffing/news');
        }

        if ($request->title) {
            $news->title = $request->title;
        }

        if ($request->description) {
            $news->description = $request->description;
        }

        if ($request->show) {
            $news->show = $request->show;
        }
        if ($filename) {
            $news->filename = $filename;
        }
        $news->updated_by = auth()->user()->id;
        $news->save();

        return Helper::success_response($news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        Storage::delete($news->filename);
        $news->delete();

        return Helper::success_response($news, 'delete-success');
    }
}
