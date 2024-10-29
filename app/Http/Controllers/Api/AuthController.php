<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    
    /**
     * Create authentication token for the user
     *
     * This method validates the incoming request data and returns a success response with the user token.
     *
     * @param \Illuminate\Http\Request $request The incoming request containing user data.
     * @return \Illuminate\Http\JsonResponse Returns a JSON response with the created user token for user authentication.
     * @throws \Illuminate\Validation\ValidationException If validation fails.
     */

    public function createToken( Request $request ){

        $request->validate([
            'email'         => 'required|email',
            'password'      => 'required',
            'device_name'   => 'required',
        ]);

        
        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }


        $token = $user->createToken($request->device_name)->plainTextToken;

        // Return the token as a JSON response
        return response()->json([ 
            'token'         => $token, 
            'message'       => 'Login Successfully',
            'user'          => $user 
        ], 200);
    }
}
