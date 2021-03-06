<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PictureAccommodation;
use App\Http\Controllers\Api\v1\AccommodationController;

class PictureAccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/api/v1/pictures/accommodations",
     *     tags={"picture accommodations"},
     *     security={ {"passport": {} } },
     *     summary="Get all pictures",
     *     @SWG\Response(response="200", description="Get all pictures"),
     * )
     */
    public function index()
    {
        $picture = new PictureAccommodation;
        return $picture->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * @SWG\Post(
     *     path="/api/v1/pictures/accommodations",
     *     tags={"picture accommodations"},
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
        $picture = new PictureAccommodation;
        return $picture->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $pictureId
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/api/v1/pictures/accommodations/{id}",
     *     tags={"picture accommodations"},
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
        $picture = new PictureAccommodation;
        return $picture->findOrFail($pictureId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $pictureId
     * @return \Illuminate\Http\Response
     *
     * @SWG\Put(
     *     path="/api/v1/pictures/accommodations/{id}",
     *     tags={"picture accommodations"},
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
        $picture = new PictureAccommodation;
        $picture = $picture->findOrFail($pictureId);

        if($request->hasFile('url')) {
            $file = $request->file('url');
            $extension = $file->getClientOriginalExtension();
            $extensionAllowed = ["png", "jpg", "jpeg"];
            if (!in_array($extension, $extensionAllowed)) {
                return response()->json(['error' => "Your file extension is not allowed, only JPEG, JPG and PNG."], 401);
            }
            $imagedata = file_get_contents($file);
            $base64 = base64_encode($imagedata);

            $picture->setUrl($base64);

        } else {
            $input = $request->all();
            $picture->setUrl($input['url']);
        }

        $picture->save();
        $accommodation = new AccommodationController();
        return $accommodation->show($picture->getAccommodationId());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $pictureId
     * @return \Illuminate\Http\Response
     *
     * @SWG\Delete(
     *     path="/api/v1/pictures/accommodations/{id}",
     *     tags={"picture accommodations"},
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
        $picture = new PictureAccommodation;
        $picture->findOrFail($pictureId)->delete();

        return response()->json(null, 204);
    }

    public function addPicture(Request $request, $id_accommodation)
    {
        $getNbPictures = PictureAccommodation::where('accommodation_id', "=", $id_accommodation)->count();

        if ($getNbPictures < 7) {

            $picture = new PictureAccommodation;
            $picture->setAccommodationId($id_accommodation);

            if($request->hasFile('url')) {
                $file = $request->file('url');
                $extension = $file->getClientOriginalExtension();
                $extensionAllowed = ["png", "jpg", "jpeg"];
                if (!in_array($extension, $extensionAllowed)) {
                    return response()->json(['error' => "Your file extension is not allowed, only JPEG, JPG and PNG."], 401);
                }
                $imagedata = file_get_contents($file);
                $base64 = base64_encode($imagedata);

                $picture->setUrl($base64);

            } else {
                $input = $request->all();
                $picture->setUrl($input['url']);
            }

            $picture->save();

            $accommodation = new AccommodationController();
            return $accommodation->show($id_accommodation);
        } else {
            return response()->json("This accommodation allready has 7 pictures", 500);
        }
    }
}