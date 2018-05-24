<?php

namespace App\Http\Controllers\Api\v1;

use App\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Mission;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\GET(
     *     path="/api/v1/missions",
     *     tags={"mission"},
     *     security={ {"passport": {} } },
     *     @SWG\Response(response="200", description="Get all missions"),
     * )
     */
    public function index()
    {
        $mission = new Mission;
        return $mission->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @SWG\POST(
     *     path="/api/v1/missions",
     *     tags={"mission"},
     *     security={ {"passport": {} } },
     *     @SWG\Response(response="200", description="Create one mission"),
     * )
     */
    public function store(Request $request)
    {
        $mission = new Mission;
        return $mission->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $missionId
     * @return \Illuminate\Http\Response
     *
     * @SWG\GET(
     *     path="/api/v1/missions/{id}",
     *     tags={"mission"},
     *     security={ {"passport": {} } },
     *     @SWG\Response(response="200", description="Get one mission by id"),
     * )
     */
    public function show($missionId)
    {
        $mission = new Mission;
        return $mission->findOrFail($missionId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $missionId
     * @return \Illuminate\Http\Response
     *
     * @SWG\PUT(
     *     path="/api/v1/missions/{id}",
     *     tags={"mission"},
     *     security={ {"passport": {} } },
     *     @SWG\Response(response="200", description="Update one mission by id"),
     * )
     */
    public function update(Request $request, $missionId)
    {
        $mission = new Mission;
        $mission = $mission->findOrFail($missionId);
        $mission->update($request->all());

        return $mission;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $missionId
     * @return \Illuminate\Http\Response
     *
     * @SWG\DELETE(
     *     path="/api/v1/missions/{id}",
     *     tags={"mission"},
     *     security={ {"passport": {} } },
     *     @SWG\Response(response="200", description="Delete one mission by id"),
     * )
     */
    public function destroy($missionId)
    {
        $mission = new Mission;
        $mission->findOrFail($missionId)->delete();

        return response()->json(null, 204);
    }


    public function apply(Request $request, $missionId)
    {
        $idUser = Auth::user()->id;
        //TODO : Verifier que l'user n'a pas déjà postulé
        $candidate = new Candidate();
        $candidate->setUser($idUser);
        $candidate->setMission($missionId);
        $candidate->setStatus(1);
        $candidate->setFromDate($request->fromDate);
        $candidate->setToDate($request->toDate);
        if($candidate->save()){
            return response()->json(null, 201);
        }
        return response()->json(null, 500);
    }
}