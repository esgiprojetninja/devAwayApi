<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Message;
use Illuminate\Support\Facades\DB;
use Validator;
use App\User;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/api/v1/messages",
     *     tags={"Message"},
     *     security={ {"passport": {} } },
     *     summary="Get all messages",
     *     @SWG\Response(response="200", description="Get all messages"),
     * )
     */
    public function index()
    {
        $message = new Message;
        return $message->all();
    }

    /**
     * Store a new message
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @SWG\Post(
     *     path="/api/v1/messages",
     *     tags={"Message"},
     *     security={ {"passport": {} } },
     *     @SWG\Parameter(
     *       name="to",
     *       in="query",
     *       description="user_id sending to",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="content",
     *       in="query",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Response(response="200", description="Create one message"),
     * )
     */
    public function store(Request $request)
    {
        $message = new Message;

        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'to' => 'required|exists:user,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $input = $request->all();
        $idUser = Auth::user()->id;
        $input['from'] = $idUser;

        $message = Message::create($input);

        return response()->json($this->getMyDiscutionWith($request->to), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $messageId
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/api/v1/messages/{id}",
     *     tags={"Message"},
     *     security={ {"passport": {} } },
     *     summary="Get one message by id",
     *     @SWG\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200", description="Get one message by id"),
     *     @SWG\Response(response="404", description="Not found"),
     * )
     */
    public function show($messageId)
    {
        $message = new Message;
        return $message->findOrFail($messageId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $messageId
     * @return \Illuminate\Http\Response
     *
     * @SWG\Put(
     *     path="/api/v1/messages/{id}",
     *     tags={"Message"},
     *     security={ {"passport": {} } },
     *     @SWG\Response(response="200", description="Update one message by id"),
     * )
     */
    public function update(Request $request, $messageId)
    {
        $message = new Message;

        $myId = Auth::user()->id;

        if(Auth::user()->roles == 1 || (Auth::user()->isActive != 0 && $message->where('id', '=', $messageId)->where(function($q) use ($myId){$q->where('from', '=', $myId)->orWhere('to', '=', $myId);})->count() >0)){
            $message = $message->findOrFail($messageId);
            $message->update($request->all());

            return $message;
        }

        abort(404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $messageId
     * @return \Illuminate\Http\Response
     *
     * @SWG\Delete(
     *     path="/api/v1/messages/{id}",
     *     tags={"Message"},
     *     security={ {"passport": {} } },
     *     summary="Delete one message by id",
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
    public function destroy($messageId)
    {
        $message = new Message;

        $myId = Auth::user()->id;

        if(Auth::user()->roles == 1 || (Auth::user()->isActive != 0 && $message->where('id', '=', $messageId)->where(function($q) use ($myId){$q->where('from', '=', $myId)->orWhere('to', '=', $myId);})->count() >0)){
            $message->findOrFail($messageId)->delete();

            return response()->json(null, 204);
        }

        abort(404);
    }

    /**
     * Display all the last message i have send or receive with one user
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/api/v1/messages/me/latest",
     *     tags={"Message"},
     *     security={ {"passport": {} } },
     *     summary="Get all the last message i have send or receive with one user",
     *     @SWG\Response(response="200", description="Get all messages"),
     * )
     */
    public function getMyMessages()
    {
        return $messages = Message::select()
            ->from('message As S')
            ->whereRaw('Not Exists (
                    Select 1
                    From `message` As S1
                    Where S1.`from` = S.`to` And S1.`to` = S.`from`
                    )')
            ->where('from', Auth::user()->id)
            ->orWhere('to', Auth::user()->id)
            ->with(['from', 'to'])
            ->groupBy(['from', 'to'])
            ->orderBy('created_at')
            ->get();
    }

    /**
     * Display all messages between me and one user by id
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/api/v1/messages/me/with/{idUser]",
     *     tags={"Message"},
     *     security={ {"passport": {} } },
     *     summary="Get all messages between me and one user by id",
     *     @SWG\Response(response="200", description="Get all messages"),
     * )
     */
    public function getMyDiscutionWith($idUser)
    {
        $message = new Message;
        $myId = Auth::user()->id;
        $return = [];
        $return['messages'] = $message->where(function($q) use ($myId, $idUser) {
                        $q->where('from', $myId)
                            ->where('to', $idUser);
                    })
                        ->orWhere(function($q) use ($myId, $idUser) {
                            $q->where('from', $idUser)
                                ->where('to', $myId);
                        })
                        ->orderBy('created_at', 'DESC')
                        ->get();
        $idUsers = [$myId, $idUser];
        $return['users'] = User::whereIn('id', $idUsers)->get();
        return $return;
    }

}