<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LocationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('v1')->group(function () {
    Route::post('/create/token', [AuthController::class, 'createToken']); // Route to Authenticate the user
    Route::get('/list-user', [UserController::class, 'listUser']); //  Route to  get user list
    Route::post('/add-user', [UserController::class, 'addUser']); //  Route to  create new user
    Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']); //  Route to  delete a user
    Route::get('/get-location', [LocationController::class, 'index']); //  Route to  get Locations
    Route::post('/transaction/filter', [TransactionController::class, 'filterTransaction']); //  Route to  filter/sort the transaction list based on the inputs date, country.
});

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::get('/transaction/list', [TransactionController::class, 'listTransaction']); //  Route to list all transaction
});