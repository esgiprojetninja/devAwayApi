<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Accommodation;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accommodation = new Accommodation;
        return $accommodation->with('pictures')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accommodation = new Accommodation;
        return $accommodation->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $accommodationId
     * @return \Illuminate\Http\Response
     */
    public function show($accommodationId)
    {
        $accommodation = new Accommodation;
        return $accommodation->with('pictures')->findOrFail($accommodationId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $accommodationId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $accommodationId)
    {
        $accommodation = new Accommodation;
        $accommodation = $accommodation->findOrFail($accommodationId);
        $accommodation->update($request->all());

        return $accommodation;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $accommodationId
     * @return \Illuminate\Http\Response
     */
    public function destroy($accommodationId)
    {
        $accommodation = new Accommodation;
        $accommodation->findOrFail($accommodationId)->delete();

        return response()->json(null, 204);
    }

    public function getPictures($accommodationId)
    {
        var_dump($accommodationId);
        return Accommodation::find($accommodationId)->pictures;;
    }
}