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
        $message = new Message;
        /*return $message->where('from', Auth::user()->id)
                       ->orWhere('to', Auth::user()->id)
                       ->with(['from', 'to'])
                       ->groupBy(['from', 'to'])
                       ->orderBy('created_at')
                       ->get();*/
        return DB::select("Select *
        From `message` As S
  where `from` = ".Auth::user()->id." or `to` = ".Auth::user()->id." AND(
 `from` < `to`
    Or Not Exists   (
                    Select 1
                    From `message` As S1
                    Where S1.`from` = S.`to`
                        And S1.`to` = S.`from`
                    ) )
GROUP BY `from`,`to`");
    }

    public function getMessageByCandidate($idCandidate)
    {
        $message = new Message;
        return $message->where('candidate', $idCandidate)->get();
    }
}