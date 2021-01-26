<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/users",
     *     @OA\Response(response="200", description="Display a listing of users.")
     *
     * )
     */

    public function users(){
        $users = User::all();
        return response()->json(['data' => $users], 200);
    }


    /**
     * @OA\Post(
     * path="/user/signup",
     * summary="Sign up",
     * description="Signup by name, email, password",
     * operationId="authSignup",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password","name"},
     *       @OA\Property(property="name", type="string", format="text", example="user1"),
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong name, or email address or password. Please try again")
     *        )
     *     )
     * )
     */
    public function signup(Request $request){
        $rules = [
            'name' => 'required',
            'password' => 'required|min:3',
            'email' => 'required|email|unique:users'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response()->json(['status' => false, 'errors' => $validator->messages()], 404);

        $email_exists = User::where('email', request('email'))->first();
        if ($email_exists)
            return response()->json(['status' => false, 'errors' => 'your email already exist!'], 404);

        $userRequest = $request->all();
        $userRequest['password'] = Hash::make($request->password);
        $user = User::create($userRequest);

        $accessToken = $user->createToken('authToken')->accessToken;
        return response()->json(['status' => true, 'data' => $user, 'access_token' => $accessToken], 200);
    }

    /**
     * @OA\Post(
     * path="/user/signin",
     * summary="Sign in",
     * description="Login by email, password",
     * operationId="authLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     */
    public function signin(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required|min:3'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response()->json(['status' => false, 'errors' => 'Enter username and password correctly.'], 404);

        $email = request('username');
        $password = request('password');

        $user = (Auth::attempt(['email' => $email, 'password' => $password])) ? Auth::getLastAttempted() : FALSE;
        if (!$user)
            return response()->json(['status' => false, 'errors' => 'Invalid Credentials'], 404);

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);

    }

}
