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

Route::middleware('auth:api')->get('/api/user/{user}', 'api\AuthController@user') ;

Route::prefix('/user')->group(function(){
    Route::post('/', 'api\AuthController@signup');
    Route::post('/login', 'api\AuthController@login');
    Route::get('/', 'api\AuthController@details')->middleware('auth:api');
    Route::get('/logout', 'api\AuthController@logout')->middleware('auth:api');
    Route::middleware('auth:api')->get('/sent', 'api\AuthController@sentEmail');

});
Route::prefix('/emails')->group(function(){
    Route::get('/', 'api\EmailController@sentEmail')->middleware('auth:api');
    Route::post('/', 'api\EmailController@store')->middleware('auth:api');
    Route::get('/{email}', 'api\EmailController@show')->middleware('auth:api');
    Route::get('/reports', 'api\EmailController@report')->middleware('auth:api');
    Route::delete('/{email}', 'api\EmailController@delete')->middleware('auth:api');
});
Route::prefix('/reports')->group(function(){
    Route::get('/', 'api\EmailController@emailreports')->middleware('auth:api');
    Route::get('/{email}', 'api\EmailController@report')->middleware('auth:api');
});
