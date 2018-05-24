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
     *
     * @SWG\GET(
     *     path="/api/v1/pictures",
     *     tags={"picture"},
     *     security={ {"passport": {} } },
     *     summary="Get all pictures",
     *     @SWG\Response(response="200", description="Get all pictures"),
     * )
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
     *
     * @SWG\POST(
     *     path="/api/v1/pictures",
     *     tags={"picture"},
     *     security={ {"passport": {} } },
     *     summary="Create one picture",
     *     @SWG\Parameter(
     *       name="accommodation_id",
     *       in="query",
     *       description="Id of the accommodation",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="url",
     *       in="query",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Response(response="200", description="Create one picture"),
     * )
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
     *
     * @SWG\GET(
     *     path="/api/v1/pictures/{id}",
     *     tags={"picture"},
     *     security={ {"passport": {} } },
     *     summary="Get one picture by id",
     *     @SWG\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200", description="Get one picture by id"),
     *     @SWG\Response(response="404", description="Not found"),
     * )
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
     *
     * @SWG\PUT(
     *     path="/api/v1/pictures/{id}",
     *     tags={"picture"},
     *     security={ {"passport": {} } },
     *     summary="Update one picture by id",
     *     @SWG\Parameter(
     *       name="accommodation_id",
     *       in="query",
     *       description="Id of the accommodation",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="url",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200", description="Update one picture by id"),
     *     @SWG\Response(response="404", description="Not found"),
     * )
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
     *
     * @SWG\DELETE(
     *     path="/api/v1/pictures/{id}",
     *     tags={"picture"},
     *     security={ {"passport": {} } },
     *     summary="Delete one picture by id",
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
    public function destroy($pictureId)
    {
        $picture = new Picture;
        $picture->findOrFail($pictureId)->delete();

        return response()->json(null, 204);
    }
}