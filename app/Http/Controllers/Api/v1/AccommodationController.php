<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Accommodation;

class AccommodationController extends Controller
{
    /**
     * @SWG\Info(title="Accommodation CRUD", version="1.0")
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/api/v1/accommodations",
     *     tags={"accommodation"},
     *     security={ {"passport": {} } },
     *     summary="Get accommodations",
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
     *     tags={"accommodation"},
     *     security={ {"passport": {} } },
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
     *     tags={"accommodation"},
     *     security={ {"passport": {} } },
     *     @SWG\Response(response="200", description="Get one accommodation by id"),
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
     *     tags={"accommodation"},
     *     security={ {"passport": {} } },
     *     @SWG\Response(response="200", description="Update one accommodation by id"),
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
     *     tags={"accommodation"},
     *     security={ {"passport": {} } },
     *     @SWG\Response(response="200", description="Delete one accommodation by id"),
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