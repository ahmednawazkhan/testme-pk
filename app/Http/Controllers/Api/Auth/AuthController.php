<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\User as UserResource;
use App\Http\Requests\Api\Auth\LoginFormRequest;
use App\Http\Requests\Api\Auth\RegisterFormRequest;

class AuthController extends Controller
{
    public function register(RegisterFormRequest $request)
    {
        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->name = $request->name;
        $user->save();

        return response([
            'success' => true,
            'data' => $user
        ], 200);
    }

    /**
     * Login the user with JWT
     * @param  \App\Http\Requests\Api\Auth\RegisterFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginFormRequest $request)
    {
        // grab credentials from the request
        $credentials    = $request->only('email', 'password');
        User::$remember = $request->input('remember', false);

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->jsonErrorRespond('auth.failed', 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->jsonErrorRespond('auth.could_not_create_token', 500);
        }

        // all good so return the token
        return response()->json([
            'success'   => true,
            'token'      => $token
        ])->header('Authorization', "Bearer $token");
    }

    public function user(Request $request)
    {
        $user = $request->user();

        return response([
            'success'   => true,
            'user'      => new UserResource($user)
        ]);
    }

    public function refresh()
    {
        return response([
            'success' => true,
        ]);
    }

    public function logout()
    {
        JWTAuth::invalidate();
        return response([
            'success' => true,
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
}
