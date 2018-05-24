<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Accommodation;

class AccommodationController extends Controller
{
    /**
     * @SWG\Info(title="Dev Away Api", version="1.0")
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/api/v1/accommodations",
     *     tags={"Accommodation"},
     *     security={ {"passport": {} } },
     *     summary="Get all accommodations",
     *     @SWG\Response(response="200", description="Get all accommodations"),
     * )
     */
    public function index()
    {
        $accommodation = new Accommodation;
        return $accommodation->with(['pictures', 'host'])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @SWG\Post(
     *     path="/api/v1/accommodations",
     *     tags={"Accommodation"},
     *     security={ {"passport": {} } },
     *     summary="Insert one accommodation",
     *     @SWG\Parameter(
     *       name="title",
     *       in="query",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="description",
     *       in="query",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="city",
     *       in="query",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="country",
     *       in="query",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="address",
     *       in="query",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="longitude",
     *       in="query",
     *       required=true,
     *       type="number"
     *     ),
     *     @SWG\Parameter(
     *       name="latitude",
     *       in="query",
     *       required=true,
     *       type="number"
     *     ),
     *     @SWG\Parameter(
     *       name="region",
     *       in="query",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="nbBathoom",
     *       in="query",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbBedroom",
     *       in="query",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbToilet",
     *       in="query",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbMaxBaby",
     *       in="query",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbMaxChild",
     *       in="query",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbMaxGuest",
     *       in="query",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbMaxAdult",
     *       in="query",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="animalsAllowed",
     *       in="query",
     *       required=true,
     *       description="0 if for, 1 for yes",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="smokersAllowed",
     *       in="query",
     *       required=true,
     *       description="0 if for, 1 for yes",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="hasInternet",
     *       in="query",
     *       required=true,
     *       description="0 if for, 1 for yes",
     *       type="integer"
     *     ),
     *     @SWG\Response(response="201", description="Create one accommodation"),
     * )
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
     *
     * @SWG\Get(
     *     path="/api/v1/accommodations/{id}",
     *     tags={"Accommodation"},
     *     security={ {"passport": {} } },
     *     summary="Get one accommodation by id",
     *     @SWG\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200", description="Get one accommodation by id"),
     *     @SWG\Response(response="404", description="Not found"),
     * )
     */
    public function show($accommodationId)
    {
        $accommodation = new Accommodation;
        return $accommodation->with(['pictures', 'host'])->findOrFail($accommodationId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $accommodationId
     * @return \Illuminate\Http\Response
     *
     * @SWG\PUT(
     *     path="/api/v1/accommodations/{id}",
     *     tags={"Accommodation"},
     *     security={ {"passport": {} } },
     *     summary="Update one accommodation by id",
     *     @SWG\Parameter(
     *       name="title",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="description",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="city",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="country",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="address",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="longitude",
     *       in="query",
     *       required=false,
     *       type="number"
     *     ),
     *     @SWG\Parameter(
     *       name="latitude",
     *       in="query",
     *       required=false,
     *       type="number"
     *     ),
     *     @SWG\Parameter(
     *       name="region",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="nbBathoom",
     *       in="query",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbBedroom",
     *       in="query",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbToilet",
     *       in="query",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbMaxBaby",
     *       in="query",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbMaxChild",
     *       in="query",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbMaxGuest",
     *       in="query",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbMaxAdult",
     *       in="query",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="animalsAllowed",
     *       in="query",
     *       required=false,
     *       description="0 for no, 1 for yes",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="smokersAllowed",
     *       in="query",
     *       required=false,
     *       description="0 for no, 1 for yes",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="hasInternet",
     *       in="query",
     *       required=false,
     *       description="0 for no, 1 for yes",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200", description="Update one accommodation by id"),
     *     @SWG\Response(response="404", description="Not found"),
     * )
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
     *
     * @SWG\DELETE(
     *     path="/api/v1/accommodations/{id}",
     *     tags={"Accommodation"},
     *     security={ {"passport": {} } },
     *     summary="Delete one accommodation by id",
     *     @SWG\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="204", description="No content"),
     *     @SWG\Response(response="404", description="Not found"),
     * )
     */
    public function destroy($accommodationId)
    {
        $accommodation = new Accommodation;
        $accommodation->findOrFail($accommodationId)->delete();

        return response()->json(null, 204);
    }

    public function getPictures($accommodationId)
    {
        return Accommodation::find($accommodationId)->pictures;;
    }

    public function getHost($accommodationId)
    {
        return Accommodation::find($accommodationId)->host;
    }

}