<?php

use App\Http\Controllers\users\usersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::any('/get_users', [usersController::class, 'getusers']);
Route::any('/insert_user', [usersController::class, 'insertuser']);
Route::any('/update_user/{user_id}', [usersController::class, 'updateuser']);
Route::any('/delete_user/{user_id}', [usersController::class, 'deleteuser']);


