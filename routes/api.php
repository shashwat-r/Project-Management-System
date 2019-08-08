<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/admin', 'UserController@make_admin');

Route::get('/users/', 'UserController@index')->middleware('basicAuth');
Route::post('/users/', 'UserController@store')->middleware('basicAuth');
Route::patch('/users/{user}', 'UserController@update')->middleware('basicAuth');

Route::post('/teams', 'TeamController@store')->middleware('basicAuth');
Route::get('/teams/{team}', 'TeamController@show')->middleware('basicAuth');
Route::patch('/teams/{team}', 'TeamController@update')->middleware('basicAuth');

Route::get('/projects', 'ProjectController@index')->middleware('basicAuth');
Route::post('/projects', 'ProjectController@store')->middleware('basicAuth');
Route::get('/projects/{project}', 'ProjectController@show')->middleware('basicAuth');

Route::get('/invitations', 'InvitationController@index')->middleware('basicAuth');
Route::post('/invitations', 'InvitationController@store')->middleware('basicAuth');
Route::patch('/invitations/{invitation}', 'InvitationController@update')->middleware('basicAuth');
