<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;
use Intervention\Image\ImageManagerStatic as Image;
use function PHPSTORM_META\type;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\GET(
     *     path="/api/v1/users",
     *     tags={"User"},
     *     security={ {"passport": {} } },
     *     summary="Get all users",
     *     @SWG\Response(response="200", description="Get all users"),
     * )
     */
    public function index()
    {
        $user = new User;
        return $user->with('accommodations')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @SWG\POST(
     *     path="/api/v1/users",
     *     tags={"User"},
     *     security={ {"passport": {} } },
     *     summary="Create one user",
     *     @SWG\Parameter(
     *       name="email",
     *       in="query",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="roles",
     *       in="query",
     *       description="0 for basic user, 1 for admin",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="username",
     *       in="query",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="password",
     *       in="query",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="c_password",
     *       in="query",
     *       required=true,
     *       description="Confirm password",
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="isActive",
     *       in="query",
     *       required=false,
     *       description="0 if is no longer available, 1 if still active",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="lastName",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="firstName",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="languages",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="skills",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Response(response="200", description="Create one user"),
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['username'] =  $user->username;

        return response()->json(['success'=>$success], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     *
     * @SWG\GET(
     *     path="/api/v1/users/{id}",
     *     tags={"User"},
     *     security={ {"passport": {} } },
     *     summary="Get one user by id",
     *     @SWG\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200", description="Get one user by id"),
     *     @SWG\Response(response="404", description="Not found"),
     * )
     */
    public function show($userId)
    {
        $user = new User;
        if (Auth::user()->id == $userId || Auth::user()->roles == 1){
            return  $user->findOrFail($userId);
        } else {
            return $user->select("username")->where('id', $userId)->get();
        }
        return response()->json(null, 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     *
     * @SWG\PUT(
     *     path="/api/v1/users/{id}",
     *     tags={"User"},
     *     security={ {"passport": {} } },
     *     summary="Update one user by id",
     *     @SWG\Parameter(
     *       name="email",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="roles",
     *       in="query",
     *       description="0 for basic user, 1 for admin",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="username",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="password",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="c_password",
     *       in="query",
     *       required=false,
     *       description="Confirm password",
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="isActive",
     *       in="query",
     *       required=false,
     *       description="0 if is no longer available, 1 if still active",
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="lastName",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="firstName",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="languages",
     *       in="query",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="skills",
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
     *     @SWG\Response(response="200", description="Update one user by id"),
     * )
     */
    public function update(Request $request, $userId)
    {

        $input = $request->all();
        if(isset($input['password'])){
            $validator = Validator::make($input, [
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }
            $input['password'] = bcrypt($input['password']);
        }

        $user = new User;
        $user = $user->findOrFail($userId);

        /*$file = $request->file('avatar');
        $thumbnail_path = public_path('img/avatar/thumbnail/');
        $original_path = public_path('img/avatar/original/');
        $file_name = 'user_'. $user->username . '.' . $file->getClientOriginalExtension();
        Image::make($file)
            ->resize(261,null,function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($original_path . $file_name)
            ->resize(90, 90)
            ->save($thumbnail_path . $file_name);
        $input['avatar'] = $file_name;*/

        $file = $request->file('avatar');
        $imagedata = file_get_contents($file);
        $base64 = base64_encode($imagedata);
        $input['avatar'] = $base64;

        $user->update($input);

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     *
     * @SWG\DELETE(
     *     path="/api/v1/users/{id}",
     *     tags={"User"},
     *     security={ {"passport": {} } },
     *     summary="Delete one user by id",
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
    public function destroy($userId)
    {
        $user = new User;
        $user->findOrFail($userId)->delete();

        return response()->json(null, 204);
    }

    public function getAccommodations($userId)
    {
        return User::find($userId)->accommodations;
    }

}