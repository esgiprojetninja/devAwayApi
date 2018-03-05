<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Picture;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $picture = new Picture;
        return $picture->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $picture = new Picture;
        return $picture->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $pictureId
     * @return \Illuminate\Http\Response
     */
    public function show($pictureId)
    {
        $picture = new Picture;
        return $picture->findOrFail($pictureId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $pictureId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pictureId)
    {
        $picture = new Picture;
        $picture = $picture->findOrFail($pictureId);
        $picture->update($request->all());

        return $picture;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $pictureId
     * @return \Illuminate\Http\Response
     */
    public function destroy($pictureId)
    {
        $picture = new Picture;
        $picture->findOrFail($pictureId)->delete();

        return response()->json(null, 204);
    }
}