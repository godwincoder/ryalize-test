<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * List all Users
     *
     * This method list all the users from the user table.
     *
     * @return \Illuminate\Http\JsonResponse Returns a JSON response with the list of users or no results.
     */
    public function listUser(){

        $userList  = User::select('id','name','email')
                            ->orderBy('id', 'desc')
                            ->get()->toArray();

        if( !empty($userList) ){
            return response()->json($userList, 200);
        }else{
            return response()->json(['message' => 'No user data available!' ], 200);
        }
       
    }

    /**
     * Create a new User
     *
     * This method validates the incoming request data and created a new user data in database.
     *
     * @param \Illuminate\Http\Request $request The incoming request containing user data.
     * @return \Illuminate\Http\JsonResponse Returns a JSON response with the success message.
     * @throws \Illuminate\Validation\ValidationException If validation fails.
     */

    public function addUser( Request $request ){

        $request->validate([
            'name'      => 'required|string', // Username validation
            'email'     => 'required|string|email|unique:users', // User email validation
            'password'  => 'required|string|min:6|confirmed', // Password and password confirm validation
        ]);

         // Create the user
         $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password), // Hash the password before saving
        ]);

        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user,
        ], 201); // 201 Created
    }

    /**
     * Delete a  User
     *
     * This method is to delete a user data from database.
     *
     * @param \Illuminate\Http\Request $request The incoming request containing user data.
     * @param $id a unique user id to delete a user.
     * @return \Illuminate\Http\JsonResponse Returns a JSON response with the success of failure message.
     */

    public function deleteUser( Request $request,  $id ){

        if (!is_numeric($id) || !User::find($id)) {
            return response()->json([
                'message' => 'Invalid user ID / ID should not be string.',
            ], 400);
        }

        // Proceed with deletion
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully.'], 200);

    }
}
