<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * @OA\Get(
     *     path="/messages",
     *     @OA\Response(response="200", description="Display a listing of messages.")
     *
     * )
     */
    public function messages(){
        $messages = Message::all();
        return response()->json(['data' => $messages], 200);
    }

    /**
     * @OA\Post(
     * path="/message/store",
     * summary="store message",
     * description="Store message",
     * operationId="authMessageStore",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"room_id","message"},
     *       @OA\Property(property="room_id", type="text", format="text", example="1"),
     *       @OA\Property(property="message", type="string", format="text", example="PassWord12345"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong room_id or message. Please try again")
     *        )
     *     )
     * )
     */
    public function store(Request $request){
        $rules = ['message' => 'required', 'room_id' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response()->json(['status' => false, 'errors' => $validator->messages()], 404);

        $messageRequest = $request->all();
        $messageRequest['user_id'] = Auth::user()->id;
        $message = Message::create($messageRequest);
        return response()->json(['status' => true, 'data' => $message], 200);
    }
}
