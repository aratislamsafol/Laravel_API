<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users/{id?}',[UserApiController::class,'showUsers']);
// Add User
Route::post('add_users',[UserApiController::class,'addUsers']);
// Add Multiple User
Route::post('/multi_add_users',[UserApiController::class,'multiAddUsers']);
// Upadate User
Route::put('/user_update/{id}',[UserApiController::class,'userUpdate']);
