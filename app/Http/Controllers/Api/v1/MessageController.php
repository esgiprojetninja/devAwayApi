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
     */
    public function index()
    {
        $message = Message;
        return $message->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     */
    public function destroy($messageId)
    {
        $message = new Message;
        $message->findOrFail($messageId)->delete();

        return response()->json(null, 204);
    }
}