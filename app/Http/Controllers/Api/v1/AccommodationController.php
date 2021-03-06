<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Monolog\Handler\ElasticSearchHandler;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Validator;

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
     *       in="query",
     *      name="country",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       in="query",
     *     name="city",
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
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="nbBathoom",
     *       in="query",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbBedroom",
     *       in="query",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbToilet",
     *       in="query",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbMaxBaby",
     *       in="query",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbMaxChild",
     *       in="query",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbMaxGuest",
     *       in="query",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="nbMaxAdult",
     *       in="query",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="animalsAllowed",
     *       in="query",
     *       description="0 for no, 1 for yes",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="smokersAllowed",
     *       in="query",
     *       description="0 for no, 1 for yes",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="hasInternet",
     *       in="query",
     *       description="0 for no, 1 for yes",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="propertySize",
     *       in="query",
     *       type="number"
     *     ),
     *     @SWG\Parameter(
     *       name="floor",
     *       in="query",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="minStay",
     *       in="query",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="maxStay",
     *       in="query",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="type",
     *       in="query",
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="checkinHour",
     *       in="query",
     *       type="string",
     *       description="DATE TIME"
     *     ),
     *     @SWG\Parameter(
     *       name="checkoutHour",
     *       in="query",
     *       type="string",
     *       description="DATE TIME"
     *     ),
     *     @SWG\Response(response="201", description="Create one accommodation"),
     * )
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }


        $accommodation = new Accommodation;

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        return $accommodation->create($input);
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
        return $accommodation->with(['pictures', 'host', 'missions'])->findOrFail($accommodationId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $accommodationId
     * @return \Illuminate\Http\Response
     *
     * @SWG\Put(
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
        $getOwnerOfAccommodation = $accommodation->findOrFail($accommodationId)->getUserId();
        $accommodation = $accommodation->with(['pictures', 'host', 'missions'])->findOrFail($accommodationId);

        $myId = Auth::user()->id;

        if(Auth::user()->roles == 1 || ($myId == $getOwnerOfAccommodation && Auth::user()->isActive != 0)){
            $input = $request->all();
            if(isset($input['address'])){
                if(!isset($input['longitude']) && !isset($input['latitude'])) {
                    return response()->json("You can't update the address without specifing both latitude and longitude!", 400);
                }
                $key = ['city', 'country', 'region'];
                foreach ($key as $value) {
                    if(!isset($input[$value])) {
                        $input[$value] = "";
                    }
                }
            } else {
                if(isset($input['city']) || isset($input['country']) || isset($input['region'])) {
                    return response()->json("You can't update the city or country or region without updating the address!", 400);
                }
                if(isset($input['longitude']) || isset($input['latitude'])) {
                    return response()->json("You can't update the longitude or latitude without updating the address!", 400);
                }
            }

            $accommodation->update($input);

            return $accommodation;
        } else {
            return abort(404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $accommodationId
     * @return \Illuminate\Http\Response
     *
     * @SWG\Delete(
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

        $getOwnerOfAccommodation = $accommodation->findOrFail($accommodationId)->getUserId();
        $myId = Auth::user()->id;

        if(Auth::user()->roles == 1 || ($myId == $getOwnerOfAccommodation && Auth::user()->isActive != 0)) {
            $accommodation->findOrFail($accommodationId)->delete();
        } else {
            abort(404);
        }

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

    public function searchAccommodationByLocation()
    {
        $accommodation = new Accommodation();
        $query =  Input::get('q');
        return $accommodation->with(['pictures', 'host'])
            ->where('country', 'LIKE', '%'. $query.'%')
            ->orWhere('city', 'LIKE', '%'.$query.'%')
            ->get();
    }

    public function searchAccommodation()
    {
        $accommodation = new Accommodation();
        $city =  Input::get('city');
        $country =  Input::get('country');
        $fromDate =  Input::get('fromDate');
        $toDate =  Input::get('toDate');

        $query = $accommodation->with(['pictures', 'host'])
                               ->leftJoin('mission', 'accommodation.id', '=', 'mission.accommodation_id');

        if($city){
            $query = $query->where('accommodation.city', 'LIKE', '%'.$city.'%');
        }

        if($country){
            $query = $query->where('accommodation.country', 'LIKE', '%'.$country.'%');
        }

       if($fromDate){
            $query = $query->whereBetween('mission.checkinDate', [$fromDate, $toDate]);
        }

        if($toDate){
            $query = $query->whereBetween('mission.checkoutDate', [$fromDate, $toDate]);
        }

        $get = ['accommodation.id',
            'accommodation.title',
            'accommodation.description',
            'accommodation.city',
            'accommodation.region',
            'accommodation.country',
            'accommodation.address',
            'accommodation.longitude',
            'accommodation.latitude',
            'accommodation.nbBedroom',
            'accommodation.nbBathroom',
            'accommodation.nbToilet',
            'accommodation.nbMaxBaby',
            'accommodation.nbMaxChild',
            'accommodation.nbMaxGuest',
            'accommodation.nbMaxAdult',
            'accommodation.animalsAllowed',
            'accommodation.smokersAllowed',
            'accommodation.hasInternet',
            'accommodation.propertySize',
            'accommodation.floor',
            'accommodation.minStay',
            'accommodation.maxStay',
            'accommodation.type',
            'accommodation.checkinHour',
            'accommodation.checkoutHour',
            'accommodation.user_id',
            ];

        return $query->get($get);
    }

    public function paginateAll()
    {
        $accommodation = new Accommodation;
        $itemsPerPage =  Input::get('itemsPerPage');
        return $accommodation->with(['pictures', 'host'])->paginate($itemsPerPage);
    }

}