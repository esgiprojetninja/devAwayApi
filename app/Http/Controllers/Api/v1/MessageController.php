<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Message;

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
     *     @SWG\Response(response="200", description="Get one message by id"),
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
     *     @SWG\Response(response="200", description="Delete one message by id"),
     * )
     */
    public function destroy($messageId)
    {
        $message = new Message;
        $message->findOrFail($messageId)->delete();

        return response()->json(null, 204);
    }
}