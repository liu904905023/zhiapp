<?php
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


Route::middleware('auth:api')->post('/question/follower', 'QuestionFollowController@follower');


Route::middleware('auth:api')->post('/question/follow','QuestionFollowController@followThisQuestion');


Route::middleware('api')->get('/topics','TopicsController@index');

Route::middleware('auth:api')->post('/user/followers','FollowersController@index');
Route::middleware('auth:api')->post('/user/follow','FollowersController@follow');

Route::middleware('auth:api')->get('/answer/{id}/votes/user','VotesController@index');
Route::middleware('auth:api')->post('/answer/vote','VotesController@vote');

Route::middleware('auth:api')->post('/message/store', 'MessagesController@send');
Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.', 'middleware' => ['api']], function () {
    Route::get('/answer/{id}/comments','CommentsController@answer');
    Route::get('/question/{id}/comments','CommentsController@question');
});


Route::middleware('auth:api')->post('/comments/store', 'CommentsController@store');
