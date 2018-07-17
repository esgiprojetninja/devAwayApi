<?php

namespace App\Http\Controllers\Api\v1;

use App\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Mission;
use App\Accommodation;
use Validator;
use App\Http\Controllers\Api\v1\CandidateController;

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
        return $mission->with(['accommodation', 'travellers', 'accommodation.host', 'accommodation.pictures'=>function($query) {
            return $query->limit(1);
        }, 'travellers.user', 'pictures'])->get();
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
     *       name="accommodation_id",
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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'accommodation_id' => 'required|exists:accommodation,id',
            'checkinDate' => 'required|date',
            'checkoutDate' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $mission = new Mission();

        return response()->json(['success'=>$mission->create($request->all())], 200);

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
        return $mission->with(['accommodation', 'travellers', 'travellers.user', 'accommodation.host', 'accommodation.pictures'=>function($query) {
            return $query->limit(1);
        }, 'pictures'])->findOrFail($missionId);
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
     *       name="accommodation_id",
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
        $mission = $mission->with(['accommodation', 'travellers', 'travellers.user', 'accommodation.host', 'accommodation.pictures'=>function($query) {
            return $query->limit(1);
        }, 'pictures'])->findOrFail($missionId);
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

        $candidate = new Candidate();
        $mission = new Mission();
        $mission =$mission->findOrFail($missionId);

        if($mission->getIsBooked() == 1 || $mission->getIsActive() == 0){
            return response()->json("Sorry, this mission is no longer available!", 500);
        }

        if ($candidate->where('mission_id', '=', $missionId)
                                    ->where('user', '=', $idUser)
                        ->where('status', '=', 1)
                                    ->count() > 0 ){
            return response()->json("You allready applied on this mission!", 500);
        }

        if ($candidate->where('mission_id', '=', $missionId)
                ->where('user', '=', $idUser)
                ->where('status', '=', -1)
                ->count() > 0 ){
            return response()->json("The host reject your candidate you can't apply one more time!", 500);
        }

        if ($candidate->where('mission_id', '=', $missionId)
                ->where('user', '=', $idUser)
                ->where('status', '=', 0)
                ->count() > 0 ){
            $candidate = $candidate->where('mission_id', '=', $missionId)
                ->where('user', '=', $idUser)
                ->where('status', '=', 0)
                ->first();
            $candidate->setStatus(1);
            $candidate->setFromDate($request->fromDate);
            $candidate->setToDate($request->toDate);
            if($candidate->save()){
                return response()->json($this->show($missionId), 201);
            }
            return response()->json(null, 500);
        }

        $validator = Validator::make($request->all(), [
            'fromDate' => 'required|date',
            'toDate' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $candidate->setUser($idUser);
        $candidate->setMissionId($missionId);
        $candidate->setStatus(1);
        $candidate->setFromDate($request->fromDate);
        $candidate->setToDate($request->toDate);
        if($candidate->save()){
            return response()->json($this->show($missionId), 201);
        }
        return response()->json(null, 500);
    }

    public function leave(Request $request, $missionId)
    {
        $idUser = Auth::user()->id;
        $candidate = new Candidate();
        $candidateCheck = new Candidate();
        $mission = new Mission();
        $mission = $mission->findOrFail($missionId);

        if ($candidateCheck->where('mission_id', '=', $missionId)
                ->where('user', '=', $idUser)
                ->count() == 0 ){
            return response()->json("You didn't applied on this mission!", 500);
        }

        $candidate = $candidate->where('mission_id', '=', $missionId)
                  ->where('user', '=', $idUser)->first();

        if($mission->getIsBooked() == 1 && $candidate->getStatus() == 69){
            $mission->setIsBooked(0);
            $mission->setIsActive(1);
            $mission->save();
        } else if($mission->getIsBooked() == 1 ) {
            return response()->json("Sorry, this mission is no longer available!", 500);
        }

        $candidate->setStatus(0);
        if($candidate->save()){
            return response()->json($this->show($missionId), 201);
        }

        return response()->json(null, 500);
    }

    public function accept(Request $request, $missionId, $userId)
    {
        $idUser = Auth::user()->id;
        $mission = new Mission();
        $mission = $mission->findOrFail($missionId);
        $accommodation = new Accommodation();

        $getOwnerOfMission = $accommodation->findOrFail($mission->accommodation_id)->getUserId();

        if($mission->getIsActive() == 0){
            return response()->json("Sorry, this mission is no longer available!", 500);
        }

        if(Auth::user()->roles == 1 || $idUser == $getOwnerOfMission){
            if($mission->getIsBooked() == 1){
                return response()->json("You allready accept someone on this mission!", 500);
            }
            $candidate = new Candidate();
            $candidateCheck = new Candidate();

            if ($candidateCheck->where('mission_id', '=', $missionId)
                    ->where('user', '=', $userId)
                    ->count() == 0 ){
                return response()->json("There is no candidate with this id on this mission!", 500);
            }

            if ($candidateCheck->where('mission_id', '=', $missionId)
                    ->where('user', '=', $userId)
                    ->where('status', '=', '0')
                    ->count() == 1 ){
                return response()->json("Sorry, this candidate leave the mission!", 500);
            }

            $candidate = $candidate->where('mission_id', '=', $missionId)
                ->where('user', '=', $userId)->first();
            $candidate->setStatus(69);

            $mission->setIsBooked(1);
            $mission->setIsActive(0);
            $mission->save();
            if($candidate->save()){
                return response()->json($this->show($missionId), 201);
            }
        }

        return response()->json(null, 500);
    }

    public function refuse(Request $request, $missionId, $userId)
    {
        $idUser = Auth::user()->id;
        $mission = new Mission();
        $mission = $mission->findOrFail($missionId);
        $accommodation = new Accommodation();

        $getOwnerOfMission = $accommodation->findOrFail($mission->accommodation_id)->getUserId();

        if($mission->getIsActive() == 0){
            return response()->json("Sorry, this mission is no longer available!", 500);
        }

        if(Auth::user()->roles == 1 || $idUser == $getOwnerOfMission){
            if($mission->getIsBooked() == 1){
                return response()->json("You allready accept someone on this mission!", 500);
            }

            $candidate = new Candidate();
            $candidateCheck = new Candidate();

            if ($candidateCheck->where('mission_id', '=', $missionId)
                    ->where('user', '=', $userId)
                    ->count() == 0 ){
                return response()->json("There is no candidate with this id on this mission!", 500);
            }

            if ($candidateCheck->where('mission_id', '=', $missionId)
                    ->where('user', '=', $userId)
                    ->where('status', '=', '0')
                    ->count() == 1 ){
                return response()->json("Sorry, this candidate leave the mission!", 500);
            }

            $candidate = $candidate->where('mission_id', '=', $missionId)
                ->where('user', '=', $userId)->first();
            $candidate->setStatus(-1);
            if($candidate->save()){
                return response()->json($this->show($missionId), 201);
            }
        }

        return response()->json(null, 500);
    }

    public function getMyMissions()
    {
        $idUser = Auth::user()->id;
        $candidate = new Candidate();

        $candidate = $candidate->where('user', '=', $idUser)->get();
        $idMissionsImIn = [];

        foreach($candidate as $oneCandidate){
            $idMissionsImIn[] = $oneCandidate->mission_id;
        }


        return response()->json(Mission::with(['accommodation', 'travellers', 'travellers.user', 'accommodation.host', 'accommodation.pictures'=>function($query) {
            return $query->limit(1);
        }, 'pictures'])->whereIn('id', $idMissionsImIn)->get(), 200);
    }

}