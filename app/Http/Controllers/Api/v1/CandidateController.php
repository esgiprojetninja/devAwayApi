<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Candidate;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\GET(
     *     path="/api/v1/candidates",
     *     tags={"Candidate"},
     *     security={ {"passport": {} } },
     *     summary="Get all candidates",
     *     @SWG\Response(response="200", description="Get all candidates"),
     * )
     */
    public function index()
    {
        $candidate = new Candidate;
        return $candidate->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @SWG\POST(
     *     path="/api/v1/candidates",
     *     tags={"Candidate"},
     *     security={ {"passport": {} } },
     *     @SWG\Parameter(
     *       name="fromDate",
     *       in="query",
     *       required=true,
     *       description="Beginning date YYYY-MM-DD",
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="toDate",
     *       in="query",
     *       required=true,
     *       description="Ending date YYYY-MM-DD",
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="user",
     *       in="query",
     *       description="Id of the user postuling",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="mission",
     *       in="query",
     *       description="Id of the mission",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200", description="Create one candidate"),
     * )
     */
    public function store(Request $request)
    {
        $candidate = new Candidate;
        return $candidate->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $candidateId
     * @return \Illuminate\Http\Response
     *
     * @SWG\GET(
     *     path="/api/v1/candidates/{id}",
     *     tags={"Candidate"},
     *     security={ {"passport": {} } },
     *     summary="Get one candidate by id",
     *     @SWG\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200", description="Get one candidate by id"),
     *     @SWG\Response(response="404", description="Not found"),
     * )
     */
    public function show($candidateId)
    {
        $candidate = new Candidate;
        return $candidate->findOrFail($candidateId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $candidateId
     * @return \Illuminate\Http\Response
     *
     * @SWG\PUT(
     *     path="/api/v1/candidates/{id}",
     *     tags={"Candidate"},
     *     security={ {"passport": {} } },
     *     @SWG\Parameter(
     *       name="fromDate",
     *       in="query",
     *       required=false,
     *       description="Beginning date YYYY-MM-DD",
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="toDate",
     *       in="query",
     *       required=false,
     *       description="Ending date YYYY-MM-DD",
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="user",
     *       in="query",
     *       description="Id of the user postuling",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="mission",
     *       in="query",
     *       description="Id of the mission",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200", description="Update one candidate by id"),
     * )
     */
    public function update(Request $request, $candidateId)
    {
        $candidate = new Candidate;
        $candidate = $candidate->findOrFail($candidateId);
        $candidate->update($request->all());

        return $candidate;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $candidateId
     * @return \Illuminate\Http\Response
     *
     * @SWG\DELETE(
     *     path="/api/v1/candidates/{id}",
     *     tags={"Candidate"},
     *     security={ {"passport": {} } },
     *     summary="Delete one candidate by id",
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
    public function destroy($candidateId)
    {
        $candidate = new Candidate;
        $candidate->findOrFail($candidateId)->delete();

        return response()->json(null, 204);
    }
}