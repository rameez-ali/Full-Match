<?php

namespace App\Http\Controllers\Api;

use App\customer;
use App\Http\Controllers\Controller;
use App\Mail\Auth\EmailVerificationNotification;
use Mail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

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
                'message' => $validator->errors()->messages()['email'][0],
                'success' => false,
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

            try {
                Mail::to($user)->send(new EmailVerificationNotification($user));
            } catch (\Exception $e) {
                echo "some error !";
            }
            return response()->json([
                'message' => 'Successfully created user!',
                'success' => true,
                'error' => null,
                'status' => $this->successStatus,
            ]);
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
            'message' => 'Successfully logged out',
            'success' => true,
            'status' => $this->successStatus,
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        $customer = customer::where('user_id',$request->user()->id)->first();

        $array = array();

            $array['id'] = $customer->user_id;
            $array['image'] = url($customer->user_image);
            $array['name'] = $customer->name;
            $array['email'] = $customer->email;
            $array['phone'] = $request->user()->phone;
            $array['status'] = $request->user()->status;

        return response()->json([
            'message' => 'User Details',
            'success' => true,
            'status' => $this->successStatus,
            'data' => $array
        ]);
    }

    public function googleRedirect(Request $request){
        return Socialite::driver('google')->redirect();
    }
    public function googlecCallback(Request $request){
        $user = Socialite::driver('google')->user();

        return $user->token;
    }

    public function socialLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email'
        ]);
        $array = array();
        if (User::where('email', $request->email)->first() != null) {
            $user = User::where('email', $request->email)->first();
        } else {
            $user = new User([
                'name' => $request->name,
                'phone' => 13245678,
                'email' => $request->email,
                'provider_id' => $request->provider,
                'email_verified_at' => Carbon::now()
            ]);
            $user->save();
            $customer = new customer([
                'user_id' => $user->id,
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $customer->save();
        }

        $tokenResult = $user->createToken('Personal Access Token');
        $user = $request->user();

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

}
