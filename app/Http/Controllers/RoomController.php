<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * @OA\Get(
     *     path="/rooms",
     *     @OA\Response(response="200", description="Display a listing of rooms.")
     *
     * )
     */

    public function rooms(){
        $rooms = Room::all();
        return response()->json(['data' => $rooms], 200);
    }

    /**
     * @OA\Post(
     * path="/room/store",
     * summary="store room",
     * description="Store room",
     * operationId="authRoomStore",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", format="text", example="Room 2"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong name. Please try again")
     *        )
     *     )
     * )
     */

    public function store(Request $request){
        $rules = ['name' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response()->json(['status' => false, 'errors' => $validator->messages()], 404);

        $roomRequest = $request->all();
        $room = Room::create($roomRequest);
        return response()->json(['status' => true, 'data' => $room], 200);
    }
}
