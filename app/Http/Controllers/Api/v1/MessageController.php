<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Message;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\GET(
     *     path="/api/v1/messages",
     *     tags={"message"},
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @SWG\POST(
     *     path="/api/v1/messages",
     *     tags={"message"},
     *     security={ {"passport": {} } },
     *     @SWG\Response(response="200", description="Create one message"),
     * )
     */
    public function store(Request $request)
    {
        $message = new Message;
        return $message->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $messageId
     * @return \Illuminate\Http\Response
     *
     * @SWG\GET(
     *     path="/api/v1/messages/{id}",
     *     tags={"message"},
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
     * @SWG\PUT(
     *     path="/api/v1/messages/{id}",
     *     tags={"message"},
     *     security={ {"passport": {} } },
     *     @SWG\Response(response="200", description="Update one message by id"),
     * )
     */
    public function update(Request $request, $messageId)
    {
        $message = new Message;
        $message = $message->findOrFail($messageId);
        $message->update($request->all());

        return $message;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $messageId
     * @return \Illuminate\Http\Response
     *
     * @SWG\DELETE(
     *     path="/api/v1/messages/{id}",
     *     tags={"message"},
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
        $message->findOrFail($messageId)->delete();

        return response()->json(null, 204);
    }

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

    public function getMyDiscutionWith($idUser)
    {
        $message = new Message;
        $myId = Auth::user()->id;
        return $message->where(function($q) use ($myId, $idUser) {
                            $q->where('from', $myId)
                                ->where('to', $idUser);
                        })
                       ->orWhere(function($q) use ($myId, $idUser) {
                           $q->where('from', $idUser)
                               ->where('to', $myId);
                       })
                       ->with(['from', 'to'])
                       ->get();
    }

}