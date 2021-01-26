<?php

namespace App\Http\Controllers\Api;

use App\customer;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public $successStatus = 200;
    public $HTTP_FORBIDDEN = 403;
    public $HTTP_NOT_FOUND = 404;

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required |string | min:8',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed | min:6 | max:32',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'success' => false,
                'error' => $validator->errors()->messages(),
                'status' => $this->HTTP_FORBIDDEN,
            ], 403);
        } else {
            $user = new User([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            $user->save();

            $customer = new customer([
                'user_id' => $user->id,
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $customer->save();
            return response()->json([
                'message' => 'Successfully created user!',
                'success' => true,
                'error' => null,
                'status' => $this->successStatus,
            ], 200);
        }
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);

        $array = array();

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'User Login Fail',
                'status' => $this->HTTP_FORBIDDEN,
                'success' => false,
            ], 403);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        $array['token'] = $tokenResult->accessToken;
        return response()->json([
            'data' => $array,
            'token_type' => 'Bearer',
            'message' => 'User Login Successfully',
            'status' => $this->successStatus,
            'success' => true,
            'auth_info' => $user,
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
