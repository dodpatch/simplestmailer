<?php

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

Route::middleware('auth:api')->post('/api/user', 'api\AuthController@login') ;

// Route::prefix('/user')->group(function(){
//     Route::post('/login', 'api\AuthController@login')->middleware('auth:api');

// });
