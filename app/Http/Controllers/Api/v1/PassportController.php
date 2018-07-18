<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailValidation;

class PassportController extends Controller
{

    public $successStatus = 200;

    /**
     * login api
     *
     * @SWG\POST(
     *     path="/api/login",
     *     tags={"Login"},
     *     @SWG\Response(response="200", description="Logged in"),
     *     @SWG\Parameter(
     *       name="email",
     *       in="query",
     *       description="Email",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="password",
     *       in="query",
     *       description="Password",
     *       required=true,
     *       type="string"
     *     ),
     *     security={ {"passport": {} } }
     * )
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorized'], 401);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userName' => 'required|unique:user',
            'email' => 'required|email|unique:user',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
       // $input['emailVerifiedToken'] = str_random(60);

        $user = User::create($input);

        //Mail::to($input['email'])->send(new EmailValidation($user));
        //Mail::to("lambot.rom@gmail.com")->send(new EmailValidation($user));

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['userName'] =  $user->userName;


        return response()->json(['success'=>$success], 200);
    }

    public function validateEmail(Request $request, $email, $token)
    {
        $user = new User();

        if ($user->where('email', '=', $email)
                ->where('emailVerifiedToken', '=', $token)
                ->where('emailVerified', '=', 1)
                ->count() == 1 ){
            return response()->json("You have allready verified your email!", 500);
        }

        if ($user->where('email', '=', $email)
                ->where('emailVerifiedToken', '=', $token)
                ->where('emailVerified', '=', 0)
                ->count() == 1 ){
            $user = $user->where('email', '=', $email)
                ->where('emailVerifiedToken', '=', $token)
                ->where('emailVerified', '=', 0)->first();
            $user->setEmailVerified(1);
            $user->save();
        }

        return redirect('home');

    }

}

