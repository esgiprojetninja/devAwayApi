<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mission;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     */
    public function destroy($missionId)
    {
        $mission = new Mission;
        $mission->findOrFail($missionId)->delete();

        return response()->json(null, 204);
    }
}