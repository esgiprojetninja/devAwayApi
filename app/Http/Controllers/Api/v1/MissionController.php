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
     *     tags={"Mission"},
     *     security={ {"passport": {} } },
     *     summary="Get all missions",
     *     @SWG\Response(response="200", description="Get all missions"),
     * )
     */
    public function index()
    {
        $mission = new Mission;
        return $mission->with(['accommodation', 'traveller', 'accommodation.host'])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @SWG\POST(
     *     path="/api/v1/missions",
     *     tags={"Mission"},
     *     security={ {"passport": {} } },
     *     @SWG\Parameter(
     *       name="accommodation",
     *       in="query",
     *       required=true,
     *       description="Id of the accommodation",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="traveller",
     *       in="query",
     *       description="Id of the user",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="checkinDate",
     *       in="query",
     *       required=true,
     *       description="YYYY-MM-DD",
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="checkoutDate",
     *       in="query",
     *       description="YYYY-MM-DD",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="checkinHour",
     *       in="query",
     *       required=true,
     *       description="HH:MM",
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="checkoutHour",
     *       in="query",
     *       description="HH:MM",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="checkinDetails",
     *       in="query",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="checkoutDetails",
     *       in="query",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="nbNights",
     *       in="query",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbPersons",
     *       in="query",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="description",
     *       in="query",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="isBooked",
     *       in="query",
     *       required=true,
     *       description="0 if it's free, 1 if it's allready booked",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="isActive",
     *       in="query",
     *       required=true,
     *       description="0 if it's no longer active, 1 if it's still active",
     *       type="integer"
     *     ),
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
     *     tags={"Mission"},
     *     security={ {"passport": {} } },
     *     summary="Get one mission by id",
     *     @SWG\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200", description="Get one mission by id"),
     *     @SWG\Response(response="404", description="Not found"),
     * )
     */
    public function show($missionId)
    {
        $mission = new Mission;
        return $mission->with(['accommodation', 'traveller', 'accommodation.host'])->findOrFail($missionId);
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
     *     tags={"Mission"},
     *     security={ {"passport": {} } },
     *     summary="Update one mission by id",
     *     @SWG\Parameter(
     *       name="accommodation",
     *       in="query",
     *       required=false,
     *       description="Id of the accommodation",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="traveller",
     *       in="query",
     *       description="Id of the user",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="checkinDate",
     *       in="query",
     *       required=false,
     *       description="YYYY-MM-DD",
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="checkoutDate",
     *       in="query",
     *       description="YYYY-MM-DD",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="checkinHour",
     *       in="query",
     *       required=false,
     *       description="HH:MM",
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="checkoutHour",
     *       in="query",
     *       description="HH:MM",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="checkinDetails",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="checkoutDetails",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="nbNights",
     *       in="query",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbPersons",
     *       in="query",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="description",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="isBooked",
     *       in="query",
     *       required=false,
     *       description="0 if it's free, 1 if it's allready booked",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="isActive",
     *       in="query",
     *       required=false,
     *       description="0 if it's no longer active, 1 if it's still active",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200", description="Update one mission by id"),
     *     @SWG\Response(response="404", description="Not found"),
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
     *     tags={"Mission"},
     *     security={ {"passport": {} } },
     *     summary="Delete one mission by id",
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