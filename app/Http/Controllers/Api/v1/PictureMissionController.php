<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PictureMission;
use App\Http\Controllers\Api\v1\MissionController;

class PictureMissionController extends Controller
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
        $picture = new PictureMission;
        return $picture->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * @SWG\POST(
     *     path="/api/v1/pictures",
     *     tags={"picture"},
     *     security={ {"passport": {} } },
     *     summary="Create one picture",
     *     @SWG\Parameter(
     *       name="mission_id",
     *       in="query",
     *       description="Id of the mission",
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
        $picture = new PictureMission;
        return $picture->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $pictureId
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
        $picture = new PictureMission;
        return $picture->findOrFail($pictureId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $pictureId
     * @return \Illuminate\Http\Response
     *
     * @SWG\PUT(
     *     path="/api/v1/pictures/{id}",
     *     tags={"picture"},
     *     security={ {"passport": {} } },
     *     summary="Update one picture by id",
     *     @SWG\Parameter(
     *       name="mission_id",
     *       in="query",
     *       description="Id of the mission",
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
        $picture = new PictureMission;
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
        return $picture;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $pictureId
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
        $picture = new PictureMission;
        $picture->findOrFail($pictureId)->delete();

        return response()->json(null, 204);
    }

    public function addPicture(Request $request, $id_mission)
    {
        $getNbPictures = PictureMission::where('mission_id', "=", $id_mission)->count();

        if ($getNbPictures < 7) {

            $picture = new PictureMission;
            $picture->setMissionId($id_mission);

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

            $mission = new MissionController();
            return $mission->show($id_mission);
        } else {
            return response()->json("This mission allready has 7 pictures", 500);
        }
    }
}