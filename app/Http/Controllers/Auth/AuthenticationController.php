<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    /**
    * Creates a user that can be authenticated and de-authenticated.
    *
    * @param  App\Http\Requests\SignupRequest  $request
    * @return \Illuminate\Http\Response
    */
    public function signup(SignupRequest $request)
    {
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;

        $user = User::create([
            "first_name" => $first_name,
            "last_name" => $last_name,
            "username" => $username,
            "email" => $email,
            "password" => Hash::make($password),
        ]);

        if (!$user) {
            return error([], "Unable to create user");
        }

        $user->bearer_token = $user->createToken("User Bearer Token", ['server:create','server:read','server:update'])->plainTextToken;
        return success($user, "Account created successfully", 201);
    }

    /**
     * Authenticate a user.
     *
     * @param  App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $user = User::where("email", $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return error([], "Invalid Credentials", 401);
        }

        $token = $user->createToken("User Bearer Token", [
                'server:create',
                'server:read',
                'server:update',
                'gradient:create',
                'gradient:read',
                'gradient:update',
            ])->plainTextToken;
        return success(["bearer_token" => $token], "Logged in successfully");
    }

    /**
     * Logout authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $isLoggedOut = $request->user()->currentAccessToken()->delete();

        if ($isLoggedOut) {
            return success([], "Logged out successfully!");
        } else {
            return error([], "Unable to logout");
        }
    }

    /**
     * Verify if a auth token is valid.
     *
     * This function reads the token from the header
     * `Authorization: Bearer {{ token }}`
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyToken(Request $request)
    {
        $tokenAttatched = $request->bearerToken();
        if (!$tokenAttatched) {
            return error([], "Add bearer token authorization header");
        }

        $isValidToken = auth('sanctum')->check();
        if ($isValidToken) {
            return success([], "Valid Token");
        } else {
            return error([], "This is an invalid token");
        }
    }
}
