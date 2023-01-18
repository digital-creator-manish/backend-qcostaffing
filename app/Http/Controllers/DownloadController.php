<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //exit("1");
          ///$path = storage_path('app/qcostaffing/news/dWjU0PS2soIYauNnhre1fj6oT9v2MhJWCdxFTxQx.pdf');
        
          echo $pathToFile = storage_path('app/qcostaffing/news/dWjU0PS2soIYauNnhre1fj6oT9v2MhJWCdxFTxQx.pdf');
        //   exit(var_dump(file_exists($pathToFile)));

          //PDF file is stored under project/public/download/info.pdf
    // $file= public_path(). "/download/info.pdf";

    $headers = array(
        'Content-Type' => 'application/pdf',
      );

    return Response::download($pathToFile, 'filename.pdf', $headers);
        //   return response()->download($pathToFile);
            //   return Storage::download($path);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
